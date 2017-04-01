<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 搜索处理，
 * @date: 2016/11/01
 * @param arrvied
 * <option value="arrvied" classid="1">目的地</option>
 * <option value="scenic" classid="3">景点</option>
 * <option value="blog" classid="5">攻略</option>
 * <option value="tour" classid="0" selected>线路</option>
 */
// $id = (postget("id"));
// $arrvied = (postget("arrvied"));
$url = (empty($_SERVER['HTTP_X_REWRITE_URL']))?$_SERVER['REQUEST_URI']:$_SERVER['HTTP_X_REWRITE_URL'];
$key = explode("/", $url);
$arrvied = $key[2];
$title = urldecode($key[3]);
$page = intval($key[4]);
$page = ($page < 1) ? 1 : $page;
$perpage = 3;
$start = ($page -1) * $perpage;
$links = '/detail';
$views = 'search.html';
switch ($arrvied) {
	case 'blog':/*攻略*/
		$totalnum = selectScenic(5, $title, false, 0, 1);
		$comments = selectScenic(5, $title, true, $start, $perpage);
		$arrviedhtml = '攻略';
		break;
	case 'guide':/*地区导航*/
		$query = $db->query("select * from cg_area where title like '%".$title."%'");
		$res = array ();
		while ($row = $db->fetch_array($query)) {
			var_dump($row);// $shop[$row['id']] = $row;
		}
		exit;

		$arrviedhtml = '目的地';
		break;
	case 'scenic':
		$totalnum = selectScenic(3, $title, false, 0, 1);
		$comments = selectScenic(3, $title, true, $start, $perpage);
		$arrviedhtml = '景点';
		break;
	case 'tour':
		$totalnum = selectRoleSale($cid['id'], false, 0, 1, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
		$comments = selectRoleSale($cid['id'], true, $start, $perpage, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title, $order, $orderby);
		$arrviedhtml = '线路';
		$links = '/tours';
		break;
	default:/*scenic,blog*/
		$totalnum = 0;
		$comments = array();
		$arrviedhtml = 'error';
		break;
}
$pagecount = ceil($totalnum / $perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $module . '/' . $arrvied . '/' . $title, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('arrvied', $arrvied);
$smarty->assign('arrviedhtml', $arrviedhtml);
$smarty->assign('cnname', $title);
$smarty->assign('links', $links);
$smarty->display(VIEWPATH.$views, $cache_id);
?>
