<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$sort = $_GET['sort'];
//$cid = array(112,113,114,117,118,148);

$smarty -> assign('cnname', '私人定制');
$smarty -> assign('enname', $module);
$smarty -> display(VIEWPATH . '/' . $module . '.html', $cache_id);
?>