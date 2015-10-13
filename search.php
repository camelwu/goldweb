<?php
include_once ('./common/inc/main.inc.php');
$id = (postget("id"));
$key = explode("/", $id);
$title = $key[0];
$page = intval($key[1]);
$page = ($page < 1) ? 1 : $page;
$perpage = 6;
$start = ($page -1) * $perpage;
$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
$pagecount = ceil($totalnum / $perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $enname . '/' . $title, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('cnname', $cname);
$smarty->display(V_ROOT . './templates/search.html', $cache_id);
?>