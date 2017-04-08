<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$num = 1;
$smarty -> assign("banner", selectdatabanner($action, $num));
$smarty->display(V_ROOT.'/error.html',$cache_id);
?>
