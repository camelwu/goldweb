<?php


/*
 * Created on 2015-5-1
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//_2:page,/1 id
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
		'price' => $info['price_2']
	);
	cg_brower($databrower);

	$info['ro_type'] = strpos($info['ro_type'], ',') ? explode(',', $info['ro_type']) : $info['ro_type'];
	$info['op_type'] = strpos($info['op_type'], ',') ? explode(',', $info['op_type']) : $info['op_type'];
	$prices = cg_price($id, $info['price2'], $info['go_type'], $info['go_time']);
	$smarty->assign('prices', $prices);
	$query = $db->query("select * from " . $table . "_stroke where routeid=" . $info['id'] . " order by num asc");
	$data = $comments = array ();
	while ($data = $db->fetch_array($query)) {
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
#var_dump($info);exit;
$smarty->display(V_ROOT.'./templates/details.html',$cache_id);
/*
 *获取每日餐饮
*/
function go_eat($v) {
	if (empty ($v) || $v === '') {
		return '无餐';
	} else {
		$go_eat = '';
		if (strpos($v, '1') > -1) {
			$go_eat .= '含早餐 ';
		} else {
			$go_eat .= 'X ';
		}
		if (strpos($v, '2')) {
			$go_eat .= '含午餐 ';
		} else {
			$go_eat .= 'X ';
		}
		if (strpos($v, '3')) {
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
	$area = cg_area();
	if ($myid === 0) {
		return '';
	} else {
		$sqlstr = "select p.remark,p.feature,p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid " .
		"from cg_product_route_sale t,cg_product_route p where t.id=p.id and t.hid=" . $myid;
		$info = $db->getOneInfo($sqlstr);
		$info['departure'] = $area[$info['departure']];
		$info['city2'] = $area[$info['city2']];
		return $info;
	}
}
/*根据id，获取价格数组*/
function cg_price($myid = 0, $price = 0, $gotype = 0, $gotime = '', $go_reg = 0) {
	global $db;
	$row = array ();
	$art = strpos($gotime, ',') ? explode(',', $gotime) : array (
		$gotime
	);
	//确认两个月的时间
	$y = date('Y');
	$n = date('m');
	$m = $n +1;
	$s = date('d');
	$d = date('j', mktime(0, 0, 1, ($m == 12 ? 1 : $m +1), 1, ($m == 12 ? $y +1 : $y)) - 24 * 3600);

	$start = $y . '-' . $n . '-1';
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
			break;
	}

	if ($myid === 0) {
		$row = '';
	} else {
		$sqlstr = "select time,price,pass from cg_product_route_do where ctype=0 and id=$myid and time>'" . date('Y-m-d') . "' order by time asc";
		$query = $db->query($sqlstr);
		while ($data = $db->fetch_array($query)) {
			$row[$data['time']] = $data['pass'] ? $price + $data['pass'] : $price - $data['pass'];
			//$row[] = $data;
		}
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