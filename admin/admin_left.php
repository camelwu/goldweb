<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$id =  $_SESSION["id"];
$info = $db->getOneInfo("select * from cg_user where id=".$id);
$smarty->assign('info',$info);
$smarty->assign('tree',getLeftTree($info['allowstr']));
$smarty->display('./admin_left.html');
?>