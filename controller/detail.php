<?php
//_2:page,/1 id
/* 初始化参数 */
$table = "cg_scenic";
$scenic = array (
	'酒店',
	'商品',
	'签证',
	'景点',
	'餐厅',
	'信息',
	'租车',
	'邮轮'
);
$links = array (
	'hotel',
	'shop',
	'visa',
	'scenic',
	'restaurent',
	'news',
	'car',
	'ship'
);
/*城市 查询 酒店、餐厅、景点、新闻等*/
function cg_sight($city = '', $types = 3) {
	global $db;
	$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '" . $city . "')>0 $sql order by cg_scenic.hots";
	$query = $db->query($sqlstr);
	$data = $res = array ();
	while ($row = $db->fetch_array($query)) {
		$res[$row['id']] = $row['title'];
	}
	return $res;
}
/*根据id,table查到title*/
function cg_gettit($myid = 0, $tab = '') {
	global $db;
	if ($myid == 0 || $tab == '') {
		return '无';
	} else {
		$res = $db->getOneInfo("select title from cg_" . $tab . " where id=$myid");
		return $res['title'];
	}
}
/*根据库表字段字符串,查到选中内容*/
function cg_getval($str = '', $arr = array ()) {
	global $db;
	$val = '';
	while (list ($key, $value) = each($arr)) { //foreach ($arr as $key => $value) {
		if (strpos($str, (string) $key) > -1)
			$val .= $value . ','; //echo "Key: $key; Value: $value<br />\n";
	}
	if (substr($val, -1) === ',')
		$val = substr($val, 0, -1);
	return $val;
}


/*产品明细查询*/
$sqlstr = "select * from $table where id=" . $id;
$info = $db->getOneInfo($sqlstr);

if (!empty ($info)) {
	//更新点击量
	set_hits($table,$id);
	/***浏览记录**/
	$smarty->assign("brower", get_cg_brower());
	/***销售排行**/
	$smarty->assign('hots', get_sale_top());
	$databrower = array (
		'id' => $info['id'],
		'title' => $info['title'],
		'titlelink' => $_SERVER['REQUEST_URI'],
		'price' => $info['price1']
	);
	cg_brower($databrower);
	//类型
	$smarty->assign('enname', $links[$info['types']]);
	$smarty->assign('cnname', $scenic[$info['types']]);
	//所在地
	$stat = $db->getOneInfo("select id,title from cg_area where id=" . $info['aid']);
	$city = $db->getOneInfo("select id,title from cg_area where id=" . $info['city']);
	$smarty->assign('stat', $stat);
	$smarty->assign('city', $city);
	//图片、房间等明细
	$query = $db->query("select * from cg_hotel where id=" . $id . " order by hid asc");
	while ($data = $db->fetch_array($query)) {
		//$data['scenics'] = cg_sight(''.$data['departure'].','.$data['arrived'].'');
		$pic[] = $data; //ctype==1?pic
	}
	$smarty->assign('pic', $pic);
	//同城、同省 同类和其他产品，增加随机功能？
	if ($info['city'] != 0) {
		$sqlfrom = "select id,title,url,price1,word,info,keyword from cg_scenic where city=" . $info['city'] . "";
		$area = $city['title'];
	} else {
		$sqlfrom = "select id,title,url,price1,word,info,keyword from cg_scenic where aid=" . $info['aid'] . "";
		$area = $stat['title'];
	}
	if (0 == $info['types']) { //hotel
		$sqladd0 = " and types = 0 and id!=" . $info['id'] . " order by rand() limit 4";
		$sqladd1 = " and types = 3 order by rand() limit 4";
		//$sqladd2 = " and types = 4 order by rand() limit 4";
	}
	elseif (3 == $info['types']) { //scenic
		$sqladd0 = " and types = 3 and id!=" . $info['id'] . " order by rand() limit 4";
		//$sqladd1 = " and types = 4 order by rand() limit 4";
		$sqladd1 = " and types = 0 order by rand() limit 4";
	} else { //restaurant 4

	}
	//同类
	//$totalnum = $db->result($db->query("select count(*) " . $sqlfrom . $sqladd0), 0); //总数;
	$query = $db->query($sqlfrom . $sqladd0);
	while ($data = $db->fetch_array($query)) {
		$res0[] = $data;
	}
	$smarty->assign('res0', $res0);
	//他类1
	$query = $db->query($sqlfrom . $sqladd1);
	while ($data = $db->fetch_array($query)) {
		$res1[] = $data;
	}
	$smarty->assign('res1', $res1);
	$sqlfrom = " from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.classid=112 and (p.aid2=".$info['aid']." or p.city2=".$info['city'].")";
	$limitsql = "order by rand() limit 4";
	$sqlstr = "select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid $sqlfrom $limitsql";
	#echo $sqlstr;
	$query = $db->query($sqlstr);
	while ($data = $db->fetch_array($query)) {
		$price = $db->getOneInfo("select price from cg_product_route_do where id=" . $data['id'] . " and pass=0 order by price desc limit 0,1");
		if (!empty ($price)) {
			$data['price_2'] = (int) $data['price_2'] - (int) $price['price'];
		}
		$result[] = $data;
	}
	//$result = $comments = selectRoleSale(112, true, 0, 1, '', $go_end2, '','','','', '', '','');
	$smarty->assign('template', $template);//模板判断
	$smarty->assign('lines', $result);
} else {
	vheader("./");
}

$smarty->assign('info', $info);
$smarty->display(VIEWPATH . '/commodity_details.html', $cache_id);
?>
