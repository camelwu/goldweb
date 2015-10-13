<?php
include_once('./common/inc/main.inc.php');
startVooleSmarty(true);
$smarty->display(V_ROOT.'./error.html',$cache_id);
?>
