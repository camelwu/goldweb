<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$banner = selectdatabanner($module, 1);
$smarty->assign("banner", $banner[0]);
$smarty->assign('action', $action);
$smarty->assign('cnname', '邮轮');
$smarty->assign('enname', $module);
$smarty->display(VIEWPATH.'/cruises.html',$cache_id);
?>
