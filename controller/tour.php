<?php
/*
 * 线路处理
 *
 * 根据id进行判断，有id进入详情，否则进入列表
 */
/* 初始化数组参数 */
$table = "cg_product_route";
$op_types = array (
	"关闭",
	"开通",
	"特色",
	"推荐",
	"专题",
	"微信",
	"销售"
);
$ro_types = array (
	'团体包价',
	'特殊旅游',
	'散客拼团',
	'自驾游'
);
$go_types = array (
	'每天发团',
	'每周发团',
	'每月发团',
	'输入团期'
);

$traffics = array (
	'null' => '无',
	'plane' => '飞机',
	'train' => '火车',
	'ship' => '轮船',
	'car' => '汽车'
);
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
$match = $_GET['match'];
$order = $_GET['order'];
$match = (empty($match)) ? '------' : $match;
//list
if (!isset($_GET['id'])) {
	$cid = $db -> getOneInfo("select id,title from cg_class where html='" . $action . "' and pid=0");
	if (empty($cid)) {
		// vheader('/error.html');
		exit('error');
	}
	/*
	 * 地区列表，出境游必须cid!=65
	 */
	$area = array ();$stat = array ();
	if($action=="overseas"){//出境
		$sql = "select id,title,hots from cg_class where classtype=5 and pid=0 and id<65 order by hots";
	}else{//国内
		$sql = "select id,title,hots from cg_class where classtype=5 id=65";
	}
	$query = $db->query($sql);
	while ($row = $db->fetch_array($query)) {
		$sql = "select t.aid2 as id,p.title from cg_area p,cg_product_route t where t.classid={$cid['id']} and t.cid2={$row['id']} and t.aid2=p.id group by t.aid2";
		$res = $db->getAll($sql);
		// $res = array ();
		// while ($val = $db->fetch_array($query1)) {
		// 	$res[] = $val;
		// }
		if (count($res)) {
			$stat[] = $row['title'];
			$area[] = $res;
		}
	}
	//
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
	$smarty->assign('page', $page);

	$smarty->assign('stat', $stat);
	$smarty->assign('area', $area);

	$cnname = $cnname == '线路' ? $cnname : $cid['title'];
	$smarty -> assign('cnname', $cnname);
	//出发地
	$smarty -> assign('chufa', cg_search($cid['id'], 0));
	//目的
	$ct = $action == 'overseas' ? 0 : 1;
	$smarty -> assign('mudi', cg_dest($ct));
	//行程天数
	$smarty -> assign('xingcheng', cg_search($cid['id'], 3));
	//预算花费
	$smarty -> assign('huafei', cg_search($cid['id'], 4));
	//banner
	if ('overseas' == $action || 'cruises' == $action) {
		$num = 1;
	} else {
		$num = 7;
	}
	$smarty -> assign("banner", selectdatabanner($action, $num));

	//匹配一级页面 规则-分割 按照顺序站位

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

	$smarty->display(VIEWPATH . 'list_tours.html', $cache_id);
} else {
/*线路明细查询*/
$info = cg_tour($id);
//线路推荐
$tuijianinfo = selectRoleSale($info['classid'], true, 0, 4, '', '', '', '', '', '', '');
$smarty->assign("tuijianinfo", $tuijianinfo);

if (!empty ($info)) {
	/***浏览记录**/
	$smarty->assign("brower", get_cg_brower());
	/***销售排行**/
	$smarty->assign('hots', get_sale_top());
	$databrower = array (
		'id' => $info['id'],
		'title' => $info['title'],
		'titlelink' => $_SERVER['REQUEST_URI'],
		'price' => $info['price2']//计划价格，改为销售需调整
	);
	cg_brower($databrower);

	$info['ro_type'] = strpos($info['ro_type'], ',') ? explode(',', $info['ro_type']) : $info['ro_type'];
	$info['op_type'] = strpos($info['op_type'], ',') ? explode(',', $info['op_type']) : $info['op_type'];
	$prices = cg_price($id, $info['price2'], $info['go_type'], $info['go_time'], $info['go_reg']);
	$smarty->assign('prices', $prices);
	$query = $db->query("select * from " . $table . "_stroke where routeid=" . $info['id'] . " order by num asc");
	$data = $comments = array ();
	while ($data = $db->fetch_array($query)) {
		if($data["departure"]!=''&&$data["arrived"]!=''){
			$data["traffic"]=="plane"?$tra="/":"-";
			$data["dl"]=$data["departure"].$tra.$data["arrived"];
		}else{
			$data["dl"]=$data["departure"].$data["arrived"];
		}
		$data['eats'] = go_eat($data['eats']);
		$data['scenics'] = go_sight($data['scenic']);
		$comments[] = $data;
	}

	$smarty->assign('stroke', $comments);

	$query = $db->query("select * from " . $table . "_do where id=" . $info['id'] . " order by hid desc");
	$data = $comments = array ();
	while ($data = $db->fetch_array($query)) {
		if (!empty ($data['url'])) {
			$data['url'] = (stristr($data["url"], "http://") == '') ? $picserver . replaceSeps($data["url"]) : $data["url"];
		}
		$comments[] = $data;
	}
	if (empty ($comments)) {
		$info['url'] = $picserver . "/" . $info['url'];
		$comments[] = $info;
	}
	$smarty->assign('topimg', $comments);
} else {
	vheader("./");
}

$classinfo = cg_class();
$smarty->assign('cinfo', $classinfo[$info['classid']]);
$smarty->assign('traffic', $traffics);
$smarty->assign('info', $info);
$smarty->display(VIEWPATH.'/detail_tours.html',$cache_id);
}
/*
 *获取每日餐饮
*/
function go_eat($v) {
	if (empty ($v) || $v === '') {
		return '无餐';
	} else {
		$go_eat = '';
		if (strpos($v, '1') > -1||strpos($v, '早') > -1) {
			$go_eat .= '含早餐 ';
		} else {
			$go_eat .= 'X ';
		}
		if (strpos($v, '2')||strpos($v, '中') > -1) {
			$go_eat .= '含午餐 ';
		} else {
			$go_eat .= 'X ';
		}
		if (strpos($v, '3')||strpos($v, '晚') > -1) {
			$go_eat .= '含晚餐 ';
		} else {
			$go_eat .= 'X ';
		}
		return $go_eat;
	}
}
/*
 *获取每日景点
*/
function go_sight($c = '', $types = 3) {
	global $db;
	if (empty ($c))
		return '';
	$c = str_replace(",", "','", $c);
	//if(preg_replace("/([u4e00-u9fa5])/","",$c)) return $c;
	$res = array ();
	$sqlstr = "select id,title,url from cg_scenic where types=$types and title in('$c')";
	$query = $db->query($sqlstr);
	while ($row = $db->fetch_array($query)) {
		$res[] = $row;
	}
	return $res;
}
/*城市 查询 景点等*/
function cg_sight($city = '', $types = 3) {
	global $db;
	//$sqlstr = "select id,title from cg_scenic where find_in_set($city,id)";
	$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '" . $city . "')>0 $sql order by cg_scenic.hots";
	$query = $db->query($sqlstr);
	$data = $res = array ();
	while ($row = $db->fetch_array($query)) {
		$res[$row['id']] = $row['title'];
	}
	return $res;
}
/*根据id，查询产品信息*/
function cg_tour($myid = 0) {
	global $db;
	if ($myid === 0) {
		return '';
	}
	$area = cg_area();
		$sqlstr = "select * from cg_product_route where id=" . $myid;
		$info = $db->getOneInfo($sqlstr);
		$info['city1'] = $area[$info['city1']];
		$info['city2'] = $area[$info['city2']];
		return $info;

}
/**
 * 根据id，获取价格数组
 * 时间需有两次判断：1、报名截止日期；2、团期类型
 **/
function cg_price($myid = 0, $price = 0, $gotype = 0, $gotime = '', $go_reg = 0) {
	global $db;
	if ($myid === 0) {
		return;
	}
	$row = array ();
	$art = strpos($gotime, ',') ? explode(',', $gotime) : array (
		$gotime
	);
	//报名截止，确认两个月的时间
	$last = strtotime("+$go_reg day");
	$y = date('Y',$last);
	$n = date('m',$last);
	$m = $n +1;
	$s = date('d',$last);

	$d = date('j', mktime(0, 0, 1, ($m == 12 ? 1 : $m +1), 1, ($m == 12 ? $y +1 : $y)) - 24 * 3600);

	$start = $y . '-' . $n . '-'.$s;
	$end = $y . '-' . $m . '-' . $d;
	$startday = strtotime($start);
	$endday = strtotime($end);
	//未加报名前几天判断
	switch ($gotype) {
		case 0 : //每天

			for ($i = $n; $i <= $m; $i++) {
				$d = date('j', mktime(0, 0, 1, ($i == 12 ? 1 : $i +1), 1, ($i == 12 ? $y +1 : $y)) - 24 * 3600);
				$f = $i == $n ? $s : 1;
				for ($j = $f; $j <= $d; $j++) {
					$row[$y . '-' . $i . '-' . $j] = $price;
				}
			}
			break;
		case 1 : //每周
			/*if (intval(date('W', $endday)) == '7'){
				$endday = strtotime("last sunday", strtotime($end));
			}*/
			$week0 = (int) date('w', $startday);
			$week1 = (int) date('w', $endday);
			$week4 = (int) date('W', $startday);
			$week2 = (int) date('W', $endday);
			$mnum = $week2 - $week4;
			for ($i = 0; $i <= $mnum; $i++) {
				foreach ($art as $val) {
					$dnum = $val - $week0;
					if ($i == 0 && $dnum < 0) {
						$my = false;
					}
					elseif ($i == $mnum && $dnum > 0) {
						$my = false;
					} else {
						$my = true;
					}
					if ($my)
						$row[date('Y-m-d', strtotime($start .
						"+$i week $dnum days"))] = $price;
				}
			}
			break;
		case 2 : //每月
			for ($i = $n; $i <= $m; $i++) {
				foreach ($art as $val) {
					$row[$y . '-' . $i . '-' . $val] = $price;
				}
			}
			break;
		default : //电询等，无价格
			if (checkDateIsValid($gotime))
				$row[date('Y-m-d', strtotime($gotime))] = $price;
			else
				$row[date('Y-m-d', $startday)] = "电询";
			break;
	}

	$sqlstr = "select time,price,pass from cg_product_route_do where ctype=0 and id=$myid and time>'" . date('Y-m-d') . "' order by time asc";
	$query = $db->query($sqlstr);
	while ($data = $db->fetch_array($query)) {
		$row[$data['time']] = $data['pass'] ? $price + $data['pass'] : $price - $data['pass'];
		//$row[] = $data;
	}
	return $row;
}
/**
 * 校验日期格式是否正确
 *
 * @param string $date 日期
 * @param string $formats 需要检验的格式数组
 * @return boolean
 */
function checkDateIsValid($date, $formats = array (
	"Y-m-d",
	"Y/m/d",
	"Y年m月d日"
)) {
	$unixTime = strtotime($date);
	if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
		return false;
	}
	//校验日期的有效性，只要满足其中一个格式就OK
	foreach ($formats as $format) {
		if (date($format, $unixTime) == $date) {
			return true;
		}
	}

	return false;
}
?>
