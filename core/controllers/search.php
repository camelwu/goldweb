<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 搜索处理，
 * @Date: 2016/11/01
 * @Time: 16:40
 */
$id = (postget("id"));
$arrvied = (postget("arrvied"));
$url = (empty($_SERVER['HTTP_X_REWRITE_URL']))?$_SERVER['REQUEST_URI']:$_SERVER['HTTP_X_REWRITE_URL'];
$key = explode("/", $url);
$arrvied = $key[2];
$title = urldecode($key[3]);
$page = intval($key[4]);
$page = ($page < 1) ? 1 : $page;
$perpage = 6;
$start = ($page -1) * $perpage;
$arrviedhtml = 'tours';
if ('1' == $arrvied) {
	$arrviedhtml = 'detail';
	$totalnum = selectScenic(3, $title, false, 0, 1);
	$comments = selectScenic(3, $title, true, $start, $perpage);

} else {
	$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
	$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
}
$pagecount = ceil($totalnum / $perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $enname . '/' . $arrvied . '/' . $title, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('cnname', $title);
$smarty->assign('arrviedhtml', $arrviedhtml);
$smarty->display(V_ROOT . './templates/search.html', $cache_id);
?>