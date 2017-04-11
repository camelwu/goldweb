<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$num = 1;
$smarty -> assign("banner", selectdatabanner($action, $num));
$smarty->display(V_ROOT.'/cruises.html',$cache_id);
?>
