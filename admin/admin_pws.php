<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');

$action = isset($_GET['action'])?$_GET['action']:"";
$tit = "密码";
switch ($action) {
	case "handle" :
		$oldpwd = md5(killbad($_POST["oldpwd"]));
		$newpwd = md5(killbad($_POST["newpwd"]));
		if ($oldpwd != $_SESSION["password"]) {
			echo "<script language=javascript>alert('旧密码输入错误，请重新输入！');location.href='admin_pws.php';</script>";
		} else {
			$sqlstr = "update cg_user set password='" . $newpwd . "' where username='" . $_SESSION["username"] . "'";
			$db->query($sqlstr);
			$_SESSION["password"] = $newpwd;
			echo "<script language=javascript>alert('修改成功！');location.href='admin_pws.php';</script>";
		}
		break;
	default :
		$smarty->assign('tit', $tit);
		$smarty->assign('name', $_SESSION["username"]);
		$smarty->display('admin_pws.html');
		break;
}
?>