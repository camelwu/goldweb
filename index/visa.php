<?php
/*
 * Created on 2015-5-1
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

/* 初始化数组参数 */
$table = "cg_scenic";
$types = 2;
//
$smarty->assign('news',sel_product(6,"",1,96,103));
$smarty->assign('faqs',sel_product(6,"",1,96,102));
$smarty->assign('vtype',cg_vtype(2));
/*获取具体ID的签证信息*/
$smarty->assign('cnname', '签证');
$smarty->assign('enname', $enname);
if (!empty($id)) {
	$res = $db->getOneInfo("select * from $table where types=$types and id=$id");
	if(!empty($res)){
		if (!empty ($res['url'])){
			$res['url'] = (stristr($res["url"], "http://") == '') ? $picserver . replaceSeps($res["url"]) : $res["url"];
		}
		$vurl = $db->getOneInfo("select url from cg_area where id=".$res['aid']);
		if (!empty ($vurl['url'])){
			$vurl['url'] = (stristr($vurl["url"], "http://") == '') ? $picserver . replaceSeps($vurl["url"]) : $vurl["url"];
		}
		$res['pic'] = $vurl['url'];
		$smarty->assign('info', $res);
		$smarty->display(V_ROOT.'./templates/VisaDetails.html',$cache_id);
	}else{
		//vheader('./');
	}
} else {

	if ($_SERVER['REQUEST_METHOD']=="POST"){
		$match = $_POST['country'].'-'.$_POST['vtype'];
		$matchy = explode('-', $match);
		$go_start = tit2id($_POST['country']);
		$go_end = $_POST['vtype'];
		$smarty->assign('go_start', $go_start);
		$smarty->assign('go_end', $go_end);
	}
	if (!empty ($match)) {
		if($go_start) $sqldataid .= ' and aid=' . (int)$go_start;
		if($go_end) $sqldataid .= ' and ctype=' . (int)$go_end;
	}
	$area = array();
	$query = $db->query("select title,hots from cg_class where classtype=5 and pid=0 order by hots limit 8");
	while ($row = $db->fetch_array($query)) {
		
		$cid = (int)$row['hots']+1;
		$sql = "select t.aid as id,p.title from cg_area p,cg_scenic t where t.types=2 and t.cid=$cid and p.id=t.aid group by t.aid ";
		$query1 = $db->query($sql);
		$res = array();
		
		while ($val = $db->fetch_array($query1)) {
			$res[] = $val;
		}
		
		if(count($res)){$stat[] = $row['title'];$area[] = $res;}
	}
	$smarty->assign('stat', $stat);
	$smarty->assign('area', $area);
/*
 * 景点列表查询
 */

$type = '1';
$perpage = 30;

$sqlfrom = "from cg_area p,$table t";
/*if ($bid)
	$sqladd = " where bid=$bid";
else*/
	$sqladd = " where t.types=$types and t.aid=p.id";
$sqladd .= " and find_in_set('".$type."',t.op_type)";

$orderbysql = " order by t.id desc";

$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqladd. $sqldataid), 0); //总数;
$pagecount = ceil($totalnum/$perpage);//页数
$page = $page>$pagecount?1:$page;
$start = ($page -1) * $perpage;
$limitsql = " limit $start,$perpage";
$sql = "select t.id,t.title,t.price1,p.url ".$sqlfrom. $sqladd. $sqldataid . $orderbysql . $limitsql;
//echo $sql;
$query = $db->query($sql);
while ($value = $db->fetch_array($query)) {
	if (!empty ($value['url'])) {
		$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
	}
	$value['word'] = cut_utf8(str_replace("&nbsp;","",strip_tags($value['word'])), 55, '...');
	$comments[] = $value;
}

$nowpage = empty($match)?"/".$enname:"/".$enname."/".$match;
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $enname . '/' . $match . '/' . $order . '/' . $orderby, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('page',$page);


$smarty->assign('info', $info);
$smarty->display(V_ROOT.'./templates/Visa.html',$cache_id);
}
function tit2id($tit){
	global $db;
	if(empty($tit)||$tit=='') return '';
	$val = $db->getOneInfo("select id from cg_area where title='".$tit."'");
	if(!empty($val)){
		return $val['id'];
	}else{
		return '';
	}
}

function cg_vtype($classtype = 0) {
	global $db;
	$sqlwhere = " and classtype=$classtype ";
	$query = $db->query("select id,title from cg_class where pid=0 $sqlwhere  order by hots");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}
?>