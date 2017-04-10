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
//$url = (empty($_SERVER['HTTP_X_REWRITE_URL']))?$_SERVER['REQUEST_URI']:$_SERVER['HTTP_X_REWRITE_URL'];
//$key = explode("/", $url);
if(strpos($key,"/")){
	$url = explode("/", $key);
	$title = urldecode($url[0]);
	$page = intval($url[1]);
}else{
	$title = $key;
}

$page = ($page < 1) ? 1 : $page;
$perpage = 6;
$start = ($page -1) * $perpage;
$links = '/detail';
$views = 'search.html';

$num = $db->result($db->query("select count(*) from cg_area where title='".$title."'"),0);
switch ($action) {
	case 'blog':/*攻略*/
		$totalnum = selectScenic(5, $title,'', false, 0, 1);
		$comments = selectScenic(5, $title,'', true, $start, $perpage);

		$arrviedhtml = '攻略';
		break;
	case 'guide':/*地区导航*/

		if(intval($num)<1){
			$query = $db->query("select * from cg_area where title like '%".$title."%'");
			$comments = array ();
			while ($row = $db->fetch_array($query)) {
				$comments[] = $row;
			}
			$arrviedhtml = '目的地';
			$links = '/guide';
		}else{
			$sql = "select * from cg_area where title='".$title."'";
			$info = $db->getOneInfo($sql);
			vheader("/guide/{$info['id']}");
		}
		break;
	case 'scenic':

		if(intval($num)<1){
			$totalnum = selectScenic(3, $title,'', false, 0, 1);
			$comments = selectScenic(3, $title,'', true, $start, $perpage);
		}else{
			$sql = "select id,pid from cg_area where title='".$title."'";
			$info = $db->getOneInfo($sql);
			$totalnum = selectScenic(3, '',$info['id'], false, 0, 1);
			$comments = selectScenic(3, '',$info['id'], true, $start, $perpage);

			/*if($info['classid']==57||$info['classid']==65){
				$cid = 113;
			}else{
				$cid = 112;
			}
			$sql = "select *";
			$sqlfrom = " from cg_scenic where types=3";
			//景点推荐
			if($info['pid']==0){//国家,shengs
				$sqladd = " and aid=".$info['id']."";
			}else{
				$sqladd = " and city=".$info['id']."";
			}
			$totalnum = $db->result($db->query("select count(*)" . $sqlfrom. $sqladd), 0);
			$limitsql = " limit $start,$perpage";
			$comments = $db->getAll("select *" . $sqlfrom. $sqladd. $limitsql);*/
		}
		$arrviedhtml = '景点';
		break;
	case 'tour':
		$num = $db->result($db->query("select count(*) from cg_area where title='".$title."'"),0);
		if(intval($num)<1){
			$totalnum = selectRoleSale(0, false, 0, 1, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title);
			$comments = selectRoleSale(0, true, $start, $perpage, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, $title);
		}else{
			$sql = "select id,pid from cg_area where title='".$title."'";
			$info = $db->getOneInfo($sql);
			$go_end=$info['id'];
			$totalnum = selectRoleSale(0, false, 0, 1, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, '');
			$comments = selectRoleSale(0, true, $start, $perpage, $go_start, $go_end, $go_days, $go_starttime, $go_endtime, $go_money, '');
		}
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
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $module . '/' . $action . '/' . $title, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('arrvied', $action);
$smarty->assign('arrviedhtml', $arrviedhtml);
$smarty->assign('cnname', $title);
$smarty->assign('links', $links);
$smarty->display(VIEWPATH . $views, $cache_id);
?>
