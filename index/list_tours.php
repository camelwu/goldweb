<?php


/*
 * Created on 2015-4-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/
//出境
$perpage = 6;
$start = ($page -1) * $perpage;

$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby);
$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby);
$pagecount = ceil($totalnum / $perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $enname . '/' . $match . '/' . $order . '/' . $orderby, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);

$smarty->display(V_ROOT . './templates/list_tours.html', $cache_id);
?>
