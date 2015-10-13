<?php
/*
 * Created on 2015-4-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/
//定制
$sort = $_GET['sort'];
//$cid = array(112,113,114,117,118,148);


$smarty->assign('cnname', '私人定制');
$smarty->assign('enname', $enname);
$smarty->display(V_ROOT.'./templates/'.$enname.'.html',$cache_id);
?>
