<?php
require_once('includes/init.php');
require_once ('includes/checklogin.php');

$action=trim(postget('action'));
$types =postget('types')===""?0:(int)postget('types');
$templates = '';

$perpage = 15;
$page =postget('page')===""?1:(int)postget('page');
$start = ($page -1) * $perpage;
$tablb = DBFIX."product_route";
if($types==0){
	$tit = "线路产品";
	$table = DBFIX."product_route_sale";
}else{
	$tit = "旅游产品";
	$table = DBFIX."scenic";
}
$smarty->assign('tit', $tit);
$smarty->assign('action', $action);
$smarty->assign('types', $types);

switch ($action) {
	case "handle" :
		$sel_ids=postget('id');
		$ids=is_array($sel_ids)?implode(',',$sel_ids):$sel_ids;
		$op =postget("op_type");
		if($op=="pass"){
			$db->query("update $table set status=1 where id in($ids)");
			echo "<script>alert('成功通过，线路可在主站访问！');location.href='?types=".$types."&page=".$page."';</script>";
		}else{
			$db->query("update $table set status=0 where id in($ids)");
			echo "<script>alert('成功下线！');location.href='?types=".$types."&page=".$page."';</script>";
		}
		//vheader("?types=$types&page=$page");
		break;
	case "view":
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->fetch_array($db->query($sqlstr));
		$smarty->assign('info', $info);
		$smarty->display('./admin_allow.html');
		break;
	default:
		if($types===0){// and locate('6',p.op_type)
			$sqladd = " where locate('1',p.op_type)";
		}else{
			$sqladd = " where locate('1',p.op_type)";
		}
		if (!empty ($_GET['keyword'])) { //keywords
			if ($sqladd == "") {
				$sqladd .= " and p.title like '%" . $_GET['keyword'] . "%'";
			} else {
				$sqladd .= " and p.title like '%" . $_GET['keyword'] . "%'";
			}
		}
		$sqlfrom = " from $table p ". $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by p.id desc limit $start,$perpage");
		
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			if($types===0){
				$myurl = $db->getOne("select url from $tablb where id=".$data['id']." limit 0,1");
				$data['url']=$myurl;
			}
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->assign('page', $page);
		$smarty->display('./'.$templates.'admin_allow.html');
		break;
}
?>