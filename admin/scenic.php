<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$types = postget('types');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$tit = $Config['scenic'][$types];
$smarty->assign('tit', $tit);
//信息控制
$op_types = array ("关闭","开通","热门","推荐","专题","微信");
$smarty->assign('op_type', $op_types);
//地区
$area = cg_class(5);
$smarty->assign('area', $area);
$areatt = cg_area();
$smarty->assign('areatt', $areatt);
$cid0 = empty ($_GET['cid0']) ? 0 : intval($_GET['cid0']);
$aid0 = empty ($_GET['aid0']) ? 0 : intval($_GET['aid0']);
$city0 = empty ($_GET['city0']) ? 0 : intval($_GET['city0']);
$smarty->assign('sel_area',sel_area("{$cid0},{$aid0},{$city0}",0));
//分类
$Allclass = array ();
if ($types == '2') {

	$hotname = "签证类型";
	$hotel = cg_class(2);
}
elseif ($types == '3') {

	$hotname = "景区级别";
	$hotel = cg_class(3);
}
elseif ($types == '4') {
	$hotname = "餐厅类型";
	$hotel = cg_class(8);
}
elseif ($types == '5') {
	$hotname = "所属分类";
	$hotel = cg_class(1);
	$Allclass = cg_eclass(1);
}
elseif ($types == '6') {
	$hotname = "所属车队";
	$hotel = cg_branch(0);
}
elseif ($types == '7') {
	$hotname = "邮轮公司";
	$hotel = cg_branch(2);
} else {
	$hotname = "酒店星级";
	$hotel = cg_class(4);
}
$smarty->assign('hotname', $hotname);
$smarty->assign('hotel', $hotel);
$smarty->assign('Allclass', $Allclass);

$table = DBFIX . "scenic";

//权限
$adminsql = '';
if ($adminid) {
	if($types==2){
		$adminsql = " and (userid={$adminid} or bid={$adminbid})  ";
	}
}

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id . $adminsql;
		$db->query($sqlstr);
		do_daily('scenic', $id, 2, 'scenic', $types);
		vheader("?types=" . $_GET['types']);
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$id = $_POST['id'];
		$do = 0;
		$_POST['op_user'] = (empty ($_POST['op_user'])) ? ($_SESSION['username']) : ($_POST['op_user']);
		$_POST['types'] = $types;
		$_POST["op_type"] = is_array($_POST["op_type"])?implode(',',$_POST["op_type"]):$_POST["op_type"];//var_dump($_POST);exit;
		if (empty ($id)) { //add
			unset ($_POST['id']);
			$_POST['userid'] = $_SESSION['id'];
			$_POST['bid'] = $adminbid;
			$do = 1;
			$id = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'id' => $id
			));
		}
		do_daily('scenic', $id, $do, 'scenic', $types);
		vheader("?types=$types&ctype=$ctype");
		break;
	case "list" :
		$sqladd = ' where types=' . $types;
		if(isset($_GET['cid0'])){
			if($_GET['cid0'])
				$sqladd .= " and cid=".$_GET['cid0'];
		}
		if(isset($_GET['aid0'])){
			if($_GET['aid0'])
				$sqladd .= " and aid=".$_GET['aid0'];
		}
		if(isset($_GET['city0'])){
			if($_GET['city0'])
				$sqladd .= " and city=".$_GET['city0'];
		}
		if (!empty ($_GET['keyword'])) {
			$sqladd .= " and title like '%" . $_GET['keyword'] . "%'";
		}
		$sqlfrom = " from " . $table . $sqladd ;
		//echo $sqlfrom;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by id desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['tips'] = cg_optype($data['op_type']);
			
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('scenic.html');
		break;
	default :
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$sqlstr = "select * from $table where id=" . $id . $adminsql;
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {
			$info['op_type'] = strpos($info['op_type'],',')?explode(',',$info['op_type']):$info['op_type'];
		}else{
			#echo"<script>alert('您无权编辑!');history.go(-1);</script>";exit;
		}
		$smarty->assign('info', $info);
		$smarty->display('scenic.html');
		break;
}
?>