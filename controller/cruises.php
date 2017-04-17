<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$num = 1;
$smarty->assign("banner", selectdatabanner($action, $num));
$smarty->assign('action', $action);
$smarty->assign('cnname', '邮轮');
$smarty->assign('enname', $module);
$smarty->display(VIEWPATH.'/cruises.html',$cache_id);
?>
