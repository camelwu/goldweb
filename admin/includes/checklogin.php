<?php
$admin = false;

if (!isset ($_SESSION["admin"]) || $_SESSION["admin"] != true) {
	$_SESSION["admin"] = false;
	$_SESSION["username"] = "";
	header("location:./admins_login.php");
} else {
	//权限
	if ($_SESSION["id"] != 1) {
		$adminid = $_SESSION["id"];
		$adminbid = $_SESSION["bid"];
	} else {
		$adminid = $adminbid = 0;
	}
	$smarty->assign('adminid', $adminid);
	$smarty->assign('adminbid', $adminbid);
}
?>