<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
require_once ('includes/func_line.php');
$action = postget('action');
$id = postget('id');
$types = isset($_GET['types']) ? intval($_GET['types']) : 0;
$ctype = isset($_GET['ctype']) ? intval($_GET['ctype']) : 0;
$action = (empty ($action)) ? "list" : $action;

$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$smarty->assign('ctype', $ctype);
$smarty->assign('id', $id);
$cid0 = empty ($_GET['cid0']) ? 0 : intval($_GET['cid0']);
$aid0 = empty ($_GET['aid0']) ? 0 : intval($_GET['aid0']);
$city0 = empty ($_GET['city0']) ? 0 : intval($_GET['city0']);
$smarty->assign('sel_area',sel_area("{$cid0},{$aid0},{$city0}",0));
if($types==1){
	$tit = "他人计划";
}else{
	$tit = "线路计划";
}
$smarty->assign('tit', $tit);

//地区
$area = cg_class(5);
$smarty->assign('area', $area);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);

//机构列表
$smarty->assign('cg_dj', cg_branch(0));
$smarty->assign('cg_yl', cg_branch(2));
//线路class
$class = cg_class(0);
$Allclass = cg_eclass(0);
$hotname = "线路分类";
$smarty->assign('hotname', $hotname);
$smarty->assign('class', $class);
$smarty->assign('Allclass', $Allclass);
$table = DBFIX . "product_route";

//权限
$adminsql = '';
if($types==1){//out local
	$adminsql = " and userid!={$adminid} and bid!={$adminbid} and locate('1',op_type) ";//开通&销售
}else{//local branch
	if ($adminid) {
		$adminsql = " and (userid={$adminid} or bid={$adminbid}) ";
	}
}
#echo $types.'&'.$adminsql;
switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		$sqlstr = "delete from {$table}_stroke where routeid =" . $id;
		$db->query($sqlstr);
		do_daily('line', $id, 2, 'line', 0);
		vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "operate" :
		//操作：合并、复制
		$sel_ids=postget('id');
		$ids=is_array($sel_ids)?implode(',',$sel_ids):$sel_ids;
		$op =postget("op_type");
		$query = $db->query("select * from {$table} where id in($ids)");
		if("copy" == $op){
			while ($data = $db->fetch_array($query)) {
				$data['userid'] = $_SESSION['id'];
				$data['bid'] = $_SESSION["bid"];
				$data['op_user'] = $_SESSION['username'];
				$oldid = $data['id'];
				unset ($data['id']);
				$id = $db->inserttable($table, $data, 1);//复制一条线路获取id号
				$sql="insert into {$table}_stroke(num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips) select num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips from {$table}_stroke where routeid=".$oldid;
				$res = $db->query($sql);//copy stroke
				//
				$db->query("update {$table}_stroke set routeid={$id}, userid={$_SESSION['id']}, op_user='{$_SESSION['username']}' where routeid=0");//update routeid
			}
		do_daily('line', $id, 1, 'line', 0);//新增一条
		vheader("?action=list&types=$types&ctype=$ctype");
		}else{//合并
			$new = array();
			while ($data = $db->fetch_array($query)) {
				$new["title"] .= $data["title"];
				$new["biaoti"] .= $data["biaoti"];
				$new["remark"] .= $data["remark"];
			}
			$new['userid'] = $_SESSION['id'];
			$new['bid'] = $_SESSION["bid"];
			$new['op_user'] = $_SESSION['username'];
			$id = $db->inserttable($table, $new, 1);//复制一条线路获取id号
			$sql="insert into {$table}_stroke(num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips) select num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips from {$table}_stroke where routeid in($ids)";
			$res = $db->query($sql);//copy stroke
			//
			$db->query("update {$table}_stroke set routeid={$id}, userid={$_SESSION['id']}, op_user='{$_SESSION['username']}' where routeid=0");//update routeid
			do_daily('line', $id, 1, 'line', 0);//新增一条
		//vheader("?action=list&types=$types&ctype=$ctype");
		}
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$id = $_POST['id'];
		$do = 0;

		$_POST["addr"] = is_array($_POST["addr"]) ? implode(',', $_POST["addr"]) : $_POST["addr"];
		$_POST["tim"] = is_array($_POST["tim"]) ? implode(',', $_POST["tim"]) : $_POST["tim"];
		$_POST["ro_type"] = isset ($_POST["ro_type"]) ? $_POST["ro_type"] : "";
		$_POST["ro_type"] = is_array($_POST["ro_type"]) ? implode(',', $_POST["ro_type"]) : $_POST["ro_type"];
		$_POST["op_type"] = isset ($_POST["op_type"]) ? $_POST["op_type"] : "";
		$_POST["op_type"] = is_array($_POST["op_type"]) ? implode(',', $_POST["op_type"]) : $_POST["op_type"];
		unset ($_POST['citys1']);
		unset ($_POST['citys2']);
		/*post plan*/
		if (empty ($id)) { //add
			//insert power info
			$_POST['userid'] = $_SESSION['id'];
			$_POST['bid'] = $_SESSION["bid"];
			$_POST['op_user'] = $_SESSION['username'];
			//power end
			unset ($_POST['id']);
			$do = 1;
			$id = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'id' => $id
			));
		}
		
		do_daily('line', $id, $do, 'line', 0);
		unset ($strokes);
		vheader("?action=edit&id=$id");
		break;
	case "list" :
		$sqladd = " where 1 " . $adminsql;
		if(isset($_GET['cid0'])){
			if($_GET['cid0'])
				$sqladd .= " and cid2=".$_GET['cid0'];
		}
		if(isset($_GET['aid0'])){
			if($_GET['aid0'])
				$sqladd .= " and aid2=".$_GET['aid0'];
		}
		if(isset($_GET['city0'])){
			if($_GET['city0'])
				$sqladd .= " and city2=".$_GET['city0'];
		}
		if (!empty ($_GET['keyword'])) { //keywords
			$sqladd .= " and keyword like '%" . $_GET['keyword'] . "%'";
		}
		$sqlfrom = "from (select *, concat_ws(',',title,IFNULL(keywords,' '),IFNULL(remark,' '),op_user) keyword from $table) result" . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by id desc limit $start,$perpage");
		#echo "select * " . $sqlfrom . " order by id desc limit $start,$perpage";
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['go_time'] = go_tim($data['go_type'], $data['go_time']);
			$data['city1'] = $areatt[$data['city1']];
			$data['city2'] = $areatt[$data['city2']];
			$data['tips'] = cg_optype($data['op_type']);
			if (!empty ($data['url'])) {
				$data['url'] = (stristr($data["url"], "http://") == '') ? $picserver . replaceSeps($data["url"]) : $data["url"];
			}
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_plan.html');
		break;
	case "view" :
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {
			$info['go_time'] = go_tim($info['go_type'], $info['go_time']);
			$info['ro_type'] = cg_getval($info['ro_type'], $ro_types);
			$info['op_type'] = cg_getval($info['op_type'], $op_types);
			$info['visa'] = cg_gettit($info['visa'], 'visa');
			$info['dj'] = cg_gettit($info['dj'], 'branch');
			$data = $comments = array ();
			if ($info['d_type'] == 0) { //
				$query = $db->query("select * from " . $table . "_stroke where id=" . $info['id'] . " order by num asc");
				while ($data = $db->fetch_array($query)) {
					$data['eats'] = cg_getval($data['eats'], $eats);
					$data['traffic'] = cg_getval($data['traffic'], $traffics);
					$comments[] = $data;
				}
			} //
			$smarty->assign('stroke', $comments);
			$class1 = $db->getOneInfo("select title from cg_class where id=" . $info['classid'] . "");
			$smarty->assign('class1', $class1['title']);
			$class2 = $db->getOneInfo("select title from cg_class where id=" . $info['classid2'] . "");
			$smarty->assign('class2', $class2['title']);
		}

		$smarty->assign('info', $info);
		$smarty->display('line_plan.html');
		break;
	default :
		//edit need area
		require_once ('includes/func_area2js.php');
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {
			$info['ro_type'] = strpos($info['ro_type'], ',') ? explode(',', $info['ro_type']) : $info['ro_type'];
			$info['op_type'] = strpos($info['op_type'], ',') ? explode(',', $info['op_type']) : $info['op_type'];
			$query = $db->query("select * from " . $table . "_stroke where routeid=" . $id . " order by num asc");
			$data = $comments = array ();
			while ($data = $db->fetch_array($query)) {
				$data['eats'] = explode(',', $data['eats']);
				$data['scenics'] = cg_sight('' . $data['departure'] . ',' . $data['arrived'] . '');
				$data['scenic'] = explode(',', $data['scenic']);
				$comments[] = $data;
			}
			$smarty->assign('stroke', $comments);
			$smarty->assign('sel_area1',sel_area($info["cid1"].",".$info["aid1"].",".$info["city1"],1));
			$smarty->assign('sel_area2',sel_area($info["cid2"].",".$info["aid2"].",".$info["city2"],2));
		} else {
			$info['go_type'] = 3;
			$info['d_type'] = 0;
			$smarty->assign('sel_area1',sel_area('0,0,0',1));
			$smarty->assign('sel_area2',sel_area('0,0,0',2));
		}
		$smarty->assign('r_2', $r2);
		$smarty->assign('ro_type', $ro_types);
		$smarty->assign('go_type', $go_types);
		$smarty->assign('op_type', $op_types);
		$smarty->assign('eats', $eats);
		$smarty->assign('traffic', $traffics);
		//
		$smarty->assign('info', $info);
		$smarty->display('line_plan.html');
		break;
}
?>