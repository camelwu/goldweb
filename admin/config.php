<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');

$action = isset ($_GET['action']) ? $_GET['action'] : "edit";
$tit = "网站";
$table = DBFIX . "config";
//
switch ($action) {
	case "handle" :
		$sqlstr = "update $table set name='" . $_POST['name'] . "',weburl='" . $_POST['weburl'] . 
		    "',qq='" . $_POST['qq'] . "',email='" . $_POST['email'] . "',pswd='" . $_POST['pswd'] .
		     "',tel='" . $_POST['tel'] . "',fax='" . $_POST['fax'] . "',mobile='" . $_POST['mobile'] . "'," .
		    "address='" . $_POST['address'] . "',zip='" . $_POST['zip'] . "',keyes='" . $_POST['keyes'] .
		    "',contents='" . killbad($_POST['contents']) ."' , picserver='{$_POST['picserver']}', uploadir='{$_POST['uploadir']}' where id=".$_POST['id'] ;
		$db->query($sqlstr);
		do_daily('config');
		vheader("?action=edit");
		break;
	default :
		$id = isset ($_GET['id']) ? $_GET['id'] : 1;
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->fetch_array($db->query($sqlstr));
		if (!empty ($info)) {
		}
		$smarty->assign('id', $id);
		$smarty->assign('tit', $tit);
		$smarty->assign('action', $action);
		$smarty->assign('info', $info);
		$smarty->display('config_set.html');
		
		break;
}
?>