<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created on 2015-4-26
 * 
 * 出境，国内，周边，自由行
 * 
*/
$perpage = 6;
$start = ($page -1) * $perpage;

$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby);
$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby);
$pagecount = ceil($totalnum / $perpage);
// var_dump($comments);exit;
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $module . '/' . $match . '/' . $order . '/' . $orderby, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);

$smarty->display(VIEWPATH . '/list_tours.html', $cache_id);
?>
