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
		$totalnum = $db->result($db->query("select count(*) from cg_area where title='".$title."'"),0);
		if(intval($totalnum)<1){
			$query = $db->query("select * from cg_area where title like '%".$title."%'");
			$comments = array ();
			while ($row = $db->fetch_array($query)) {
				$comments[] = $row;
			}
			$arrviedhtml = '目的地';$links = '/guide';
		}else{
			$sql = "select * from cg_area where title='".$title."'";
			$info = $db->getOneInfo($sql);
			if($info['classid']==57||$info['classid']==65){
				$cid = 113;
			}else{
				$cid = 112;
			}
			//线路推荐
			$tuijianinfo = selectRoleSale($cid, true, 0, 4, '', '', '', '', '', '', '');
			$smarty->assign("tuijianinfo", $tuijianinfo);
			//景点推荐
			if($info['pid']==0){//国家,shengs
				$str = "select * from cg_scenic where types=3 and aid=".$info['id']." limit 0,4";
			}else{
				$str = "select * from cg_scenic where types=3 and city=".$info['id']." limit 0,4";
			}
			$query = $db->query($str);
			$locate = array();
			while ($row = $db->fetch_array($query)) {
				if (!empty ($row['url'])) {
					$row['url'] = (stristr($row["url"], "http://") == '') ? $picserver . replaceSeps($row["url"]) : $row["url"];
				}else{
					$row['url'] = '/resources/images/nopic.png';
				}
				$row['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($row['word'])), 30, '...');
				$locate[] = $row;
			}
			$smarty->assign("locate", $locate);
			/***浏览记录**/
			$smarty->assign("brower", get_cg_brower());
			/***销售排行**/
			$smarty->assign('hots', get_sale_top());
			$smarty->assign('info', $info);
			$smarty->assign('arrvied', $arrvied);
			$smarty->assign('arrviedhtml', $arrviedhtml);
			$smarty->assign('cnname', $title);
			$smarty->assign('links', $links);
			$views = 'guide.html';
		}
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
$smarty->display(VIEWPATH . $views, $cache_id);
?>
