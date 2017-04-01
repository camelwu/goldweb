<?php
defined('BASEPATH') OR exit('No direct script access allowed');



//定位&区域
$smarty -> assign('ipfrom', $province);
$smarty -> assign('mycountry', $mycountry);

if (empty($module)) {
	include_once ('homepage.php');exit;
} else {
	if (in_array($module, $shtm)) {//静态页面
		switch ($module) {
			case "qualifications" :
				//资质
				break;
			case "partner" :
				//合作
				break;
			case "sitemap" :
				//网站地图
				break;
			case "help" :
				//FAQ
				break;
			case "company" :
				//分公司
				break;
			default :
				break;
		}
		if (B_TEMP) {
			$smarty -> assign('al_num', array_keys($shtm, $module));
			$smarty -> display(VIEWPATH . "/$module.html", $cache_id);
		} else {
			include_once ("static.php");
		}
	} else {//排序
$orderarr = array (
	'hits', //推进
	'hid', //最新
	'hots', //销量
	'price2' //价格
);
$orderbyarr = array (
	'desc',
	'asc'
);
$order = $_GET['order'];
if (empty ($order) || !in_array($order, $orderarr)) {
	$order = 'id';
}
$orderby = $_GET['orderby'];
if (empty ($orderby) || !in_array($orderby, $orderbyarr)) {
	$orderby = 'desc';
}
$smarty->assign('order', $order);
$smarty->assign('orderby', $orderby);
$smarty->assign('template',$template);
$smarty->assign('enname', $module);
$smarty->assign('match', $match);
$smarty->assign('id', $id);
$smarty->assign('page', $page);
		if (empty($id)) {
			if ('route' == $module) {
				$module = $template == 'branch' ? 'overseas' : $module;
				$cnname = '线路';
			}
			$cid = $db -> getOneInfo("select id,title from cg_class where html='" . $module . "' and pid=0");
			if (!empty($cid)) {
				$cnname = $cnname == '线路' ? $cnname : $cid['title'];
				$smarty -> assign('cnname', $cnname);
				//出发地
				$smarty -> assign('chufa', cg_search($cid['id'], 0));
				//目的
				$ct = $module == 'overseas' ? 0 : 1;
				$smarty -> assign('mudi', cg_dest($ct));
				//行程天数
				$smarty -> assign('xingcheng', cg_search($cid['id'], 3));
				//预算花费
				$smarty -> assign('huafei', cg_search($cid['id'], 4));
				//banner
				$num = 1;
				if ('overseas' == $module || 'cruises' == $module) {
					$num = 1;
				} else {
					$num = 7;
				}
				$smarty -> assign("banner", selectdatabanner($module, $num));
			}
		}
		//匹配一级页面 规则-分割 按照顺序站位
		if (!empty($match)) {
			$matchy = explode('-', $match);
			//出发
			$go_start = $matchy[0];
			$smarty -> assign('go_start', $go_start);
			//目的1
			$go_end = $matchy[1];
			$smarty -> assign('go_end', $go_end);

			//目的2
			$go_end2 = $matchy[2];
			$smarty -> assign('go_end2', $go_end2);

			//行程天数
			$go_days = $matchy[3];
			$smarty -> assign('go_days', $go_days);

			//出游时间1(格式YYYYMMDD)
			$go_starttime = $matchy[4];
			$smarty -> assign('go_starttime', $go_starttime);

			//出游时间2(格式YYYYMMDD)
			$go_endtime = $matchy[5];
			$smarty -> assign('go_endtime', $go_endtime);

			//预算花费
			$go_money = $matchy[6];
			$smarty -> assign('go_money', $go_money);

			//推荐
			$go_tuijian = $matchy[7];
			$smarty -> assign('go_tuijian', $go_tuijian);

			//销量
			$go_sall = $matchy[8];
			$smarty -> assign('go_sall', $go_sall);
			//热度
			$go_hot = $matchy[9];
			$smarty -> assign('go_hot', $go_hot);
		}
		if (empty($cid)) {
			include_once ($module . '.php');
		} else {
			include_once ('list_tours.php');
		}
	}
}
?>
