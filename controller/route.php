<?php
//分站线路
$perpage = 6;
//推荐
$order = "";
//销量
$boderby = 'desc';
$start = ($page -1) * $perpage;
$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '');
$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '');
$pagecount = ceil($totalnum / $perpage);
// var_dump($comments);exit;
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $enname . '/' . $match . '/' . $order . '/' . $orderby, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);

$smarty->display(VIEWPATH . '/route.html', $cache_id);
?>
