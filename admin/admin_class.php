<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');

$action = isset ($_GET['action']) ? $_GET['action'] : 'list';
$nsort = postget('nsort');
$types = isset($_GET['types']) ? $_GET['types'] : 0;
if (isset($_GET['classtype'])) {
	$classtype = $_GET['classtype'];
}else{
	$classtype = $types;
}
if (isset($_GET['pid'])) {
	$tit = $Config['web'][$classtype] . "二级分类";
	$pid = $_GET['pid'];
} else {
	$tit = $Config['web'][$classtype] . "一级分类";
	$pid = 0;
}
$smarty->assign('action', $action);
$smarty->assign('tit', $tit);
$smarty->assign('pid', $pid);
$smarty->assign('classtype', $classtype);
$smarty->assign('types', $classtype);
$smarty->assign('nsort', $nsort);
switch ($action) {
	case 'list' :
		//左侧列表
		$class = $data = array ();
		foreach ($Config['web'] as $key => $value) {
			if ($nsort != '') {
				if ($key == $nsort) {

					$class['id'] = $key;
					$class['name'] = $value;
					$class['p'] = cg_class($key);
					$data[] = $class;
					break;
				}
			} else {
				$class['id'] = $key;
				$class['name'] = $value;
				$class['p'] = cg_class($key);
				$data[] = $class;
			}
		}
		$smarty->assign('data', $data);
		//列表
		$sqlstr = "select * from " . DBFIX . "class where pid=$pid and classtype=$classtype order by hots asc";
		$query = $db->query($sqlstr);
		while ($row = $db->fetch_array($query)) {
			$resu[] = $row;
		}
		$smarty->assign('resu', $resu);

		$smarty->display('config_class.html');
		break;
	case "up" :
		$db->query("update " . DBFIX . "class set hots=if(hots>0,hots-1,0) where id=" . $_GET['id']);
		do_daily('class', $_GET['id'], 3);
		vheader("?classtype={$classtype}&pid={$pid}&nsort=$nsort");
		break;
	case "down" :
		$db->query("update " . DBFIX . "class set hots=hots+1 where id=" . $_GET['id']);
		do_daily('class', $_GET['id'], 3);
		vheader("?classtype={$classtype}&pid={$pid}&nsort=$nsort");
		break;
	case "del" :
		$sqlstr = "delete from " . DBFIX . "class where id=" . $_GET['id'] . "";
		$sqlstr2 = "delete from " . DBFIX . "class where pid=" . $_GET['id'] . "";
		$db->query($sqlstr);
		$db->query($sqlstr2);
		do_daily('class', $_GET['id'], 2);
		print "删除成功！<a href='?classtype={$classtype}&pid={$pid}&nsort=$nsort'>返回</a>";
		break;
	case "addc" :
		$id = postget('id');
		$data = array (
			'title' => $_POST['title'],
			'html' => $_POST['html'],
			'classtype' => $_POST['classtype'],
			'hots' => $_POST['hots'],
			'pid' => 0,
			'userid' => $_SESSION['id']
		);
		$do = 1;
		$pid = $_POST['pid'];
		if (!empty ($pid)) {
			$data['pid'] = $_POST['pid'];
		}
		if (empty ($id)) { //add
			$db->inserttable('cg_class', $data);
			$id = $db->insert_id();
		} else { //edit
			$db->updatetable('cg_class', $data, array (
				'id' => $id
			));
			$do = 0;
		}
		do_daily('class', $id, $do);
		vheader("?classtype=".$_POST['classtype']."&pid=$pid");
		break;
	default:
		$id = $_GET['id'];
		$info = array ();
		if (!empty ($id)) {
			$info = $db->fetch_array($db->query('select * from cg_class where id=' . $id));
		} else {
			$info['html'] = check_html();
			$info['classtype'] = $classtype;
			$info['pid'] = $pid;
		}
		//分类
		$classarr = (!empty ($pid)) ? cg_class($pid) : $Config['web'];
		$smarty->assign('classarr', $classarr);
		$smarty->assign('info', $info);
		$smarty->display('config_class.html');
		break;
}
echo "</table>";
?>
