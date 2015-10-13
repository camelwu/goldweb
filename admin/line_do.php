<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$id = postget('id');
$types = postget('types');
$ctype = postget('ctype');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$smarty->assign('id', $id);
$smarty->assign('ctype', $ctype);
if($types=='0'){
	$Config['hotel'][0]='价格';
}
$tit = $Config['line'][$types];
$tit1 = $Config['hotel'][$ctype];
$smarty->assign('tit', $tit);
$smarty->assign('tit1', $tit1);
$scenicinfo = $db->getOneInfo("select * from ".DBFIX."product_route where id=$id");
//$scenicinfo['go_time'] = go_tim($scenicinfo['go_type'],$scenicinfo['go_time']);
$smarty->assign('scenicinfo',$scenicinfo);
//上调下降
$smarty->assign('r_2', array("下降","上调"));
//地区
$area = cg_class(5);
$smarty->assign('area', $area);
$areatt = cg_area();
$smarty->assign('areatt', $areatt);

$table = DBFIX . "product_route_do";

switch ($action) {
	case "delete" :
		$hid = $_GET['hid'];
		$sqlstr = "delete from $table where hid =" . $hid;
		$db->query($sqlstr);
		do_daily('line', $hid, 2, 'line', intval($ctype)+2);
		$db->query("update ". DBFIX ."product_route set num=(select count(*) from $table where id=$id and ctype=0) where id=$id");
		$db->query("update ". DBFIX ."product_route set num1=(select count(*) from $table where id=$id and ctype=1) where id=$id");
		vheader("?types=$types&ctype=$ctype&id=$id");
		
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$hid = $_POST['hid'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];
		$_POST['types'] = $types;

		if (empty ($hid)) { //add
			unset ($_POST['hid']);
			$do = 1;
			$hid = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'hid' => $hid
			));
		}
		$db->query("update ". DBFIX ."product_route set num=(select count(*) from $table where id=$id and ctype=0) where id=$id");
		$db->query("update ". DBFIX ."product_route set num1=(select count(*) from $table where id=$id and ctype=1) where id=$id");
		do_daily('line', $hid, 2, 'line', intval($ctype)+2);
		vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "list" :
		$sqladd = ' where types=' . $types . ' and ctype=' . $ctype . ' and id=' . $id;

		$sqlfrom = " from " . $table . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by hid ");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_do.html');
		break;
	default :
		if (!empty ($_GET['hid'])) {
			$hid = $_GET['hid'];
		} else {
			$hid = 0;
		}
		$sqlstr = "select * from $table where hid=" . $hid;
		$info = $db->fetch_array($db->query($sqlstr));
		if (!empty ($info)) {
		}
		$smarty->assign('info', $info);
		$smarty->display('line_do.html');
		break;
}

/*
function displaybox($css,$cont){
	$nowdate=date("Y-m-d");//is_time();
	$timestamp=strtotime($nowdate);
	$y=date("Y");
	$d=date("d");
	$j=date("m");
	$firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1).'-01'));
	$lastdate=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
	$nextdate=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
	for($m=$j;$m<$j+1;$m++){
		$lasty=date('Y',$lastdate);
		$lastm=date('m',$lastdate);
	
		nextdate=dateadd("m",1,nowdate);
		nexty=year(nextdate);
		nextm=month(nextdate);
		//2013-06-27修改为出团日期的月份。
		thismonth=y&"-"&m&"-1";//当前月的第一天
		nextmonth=dateadd("m",1,thismonth); //下个月的第一天
		num=datediff("d",thismonth,nextmonth); //当前月的天数
		firstday=weekday(thismonth)-1;//得到当前月第一天的星期
		
		nn=""
		nn = nn&"<h4>"&m&"月</h4>" & vbCrlf
		nn = nn&"<table class='calendar'>" & vbCrlf
		nn = nn&"<thead>" & vbCrlf
		nn = nn&"<tr>" & vbCrlf
		nn = nn&"<td>Su</td><td>Mn</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td>" & vbCrlf
		nn = nn&"</tr>" & vbCrlf
		nn = nn&"</thead>" & vbCrlf
		//需要参数：当前月第一天的星期firstday，当前月的天数num
		for n=1 to 6
			nn = nn&"<tr>" & vbCrlf
				for i=1 to 7
				thisday=0
				if i>firstday then thisday=i-firstday
				if n>1 then thisday=7*(n-1)+i-firstday
				if thisday>num then thisday=0
				if thisday=0 then
					display="&nbsp;"
				else
					if thisday=d and j=m then
						display="<font color='green'>"&thisday&"</font>"
					else
						display=thisday
					end if
				end if
				week = i-1
				if week=0 then week=7
				nn = nn&"<td id="""&m&"-"&thisday&""" week='"&week&"'><span>"&display&"</span></td>"
				next
			if n=5 and (thisday=num or thisday=0) then n=n+1
			nn = nn&"</tr>" & vbCrlf
		next
		nn = nn&"</table>" & vbCrlf
		if(m=j){
			displaybox("width:310px;margin-right:10px;",nn)
		}else{
			displaybox("width:310px;",nn)
		}
	
	}
	$bstr = "<div class='box' style='".$css."'><div class='border-top'><div class='border-right'><div class='border-bot'><div class='border-left'><div class='left-top-corner'><div class='right-top-corner'><div class='right-bot-corner'><div class='left-bot-corner'><div class='inner'>".$cont."</div></div></div></div></div></div></div></div></div></div><!-- /.box -->";
}*/
?>