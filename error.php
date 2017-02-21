<?php
include_once('./common/inc/main.inc.php');
startSmarty(true);
$smarty->display(V_ROOT.'./error.html',$cache_id);
?>
