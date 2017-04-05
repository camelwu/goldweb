<?PHP
/****浏览记录录入****/
function cg_brower($data = array ()) {
	global $db, $uh_token;
	$data['uid'] = $uh_token;
	$data['titlelink'] = (!empty ($_SERVER['HTTP_X_REWRITE_URL'])) ? $_SERVER['HTTP_X_REWRITE_URL'] : $_SERVER['REQUEST_URI'];
	$db->replacetable("cg_browser", $data);
}
/******获取浏览记录******/
function get_cg_brower($count = 5) {
	global $db, $uh_token;
	$query = $db->query("select * from cg_browser where uid=$uh_token order by ts desc limit $count ");
	$data = array ();
	while ($row = $db->fetch_array($query)) {
		$data[] = $row;
	}
	return $data;
}
/*****销售排行榜*****/

function get_sale_top($count = 5) {
	global $db, $bid, $picserver;
	/*右侧销售排行*/
	if ($bid)
		$sqladd = " where bid=$bid";
	else
		$sqladd = " where 1=1";
	//hits点击，hots销售
	$orderbysql = ' order by hots desc';
	$limitsql = ' limit ' . $count;
	$sql = "select * from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,p.hots,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id) result" . $sqladd . $orderbysql . $limitsql;

	$query = $db->query($sql);
	while ($value = $db->fetch_array($query)) {
		if (!empty ($value['url'])) {
			$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
		}
		$price = $db->getOneInfo("select price from cg_product_route_do where id=" . $value['id'] . " and pass=0 order by price desc limit 0,1");
		if (!empty ($price)) {
			$value['price_2'] = (int) $value['price_2'] - (int) $price['price'];
		}
		$res[] = $value;
	}
	return $res;
}

/***客户验证****/
function login_user($uid = '', $email = '', $passwd = '') {
	global $db;
	$sqlwhere = "where 1";
	if (!empty ($uid)) {
		$sqlwhere .= " and uid = $uid";
	}
	if (!empty ($email)) {
		$sqlwhere .= " and (email = '" . $email . "' or username='$email')";
	}
	if (!empty ($passwd)) {
		$sqlwhere .= " and password = '" . md5($passwd) . "'";
	}
	$sql = "SELECT * FROM cg_client  " . $sqlwhere;
	$data = $db->getOneInfo($sql);
	if (!empty ($data)) {
		save_cookie('uid', $data['uid']);
		save_cookie('uh_token', $data['uh_token']);
		save_cookie('username', $data['username']);
	}
	return $data;
}
/**
 * @filesource
 * @types 0 国家 1 地区
 * @hits  1 热门
 * @classid1 地区分类
 * @classid 区域分类
 * @param:pid 国家分类
 **/

function cg_area($types = "", $hits = 0, $classid1 = 0, $classid = 0, $pid = 0) {
	global $db;
	$sqlwhere = '';
	if ($classid1) {
		$sqlwhere .= ' and classid1=' . $classid1;
	}
	if ($classid) {
		$sqlwhere .= ' and classid=' . $classid;
	}
	if ($pid) {
		$sqlwhere .= ' and pid=' . $pid;
	}
	if ($hits) {
		$sqlwhere .= ' and hits=1 ';
	}
	if ($types == '0' || !empty ($types)) {
		$sqlwhere .= ' and types=' . $types;
	}
	$query = $db->query("select * from cg_area where status=1 $sqlwhere order by id ");
	while ($row = $db->fetch_array($query)) {
		$data[$row['id']] = $row['title'];
	}
	return $data;
}

/*
 函数功能：一级分类数组
 参    数：$pid>>上级ID
 */
function cg_class($classtype = 0) {
	global $db;
	$sqlwhere = "and classtype=$classtype";
	$query = $db->query("select * from cg_class where pid=0 $sqlwhere order by hots");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row;
	}
	return $shop;
}
/**
 * @uses	线路出游目
 * @param	int	$type	0:over,1:inner
 * @return	array	TRUE on success or FALSE on failure
 */
function cg_dest($type = 0) {
	global $db;
	$sqlwhere = $type?"and id=65":"and (id>=57 and id<64)";
	$query = $db->query("select id,title from cg_class where pid=0 and classtype=5 $sqlwhere order by hots");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row;
	}
	return $shop;
}
/*
 * 函数功能：机构数组
 * type为空，同行和金桥内部机构；否则选取对应的参数
 */
function cg_branch($types='') {
	global $db;
	if($types==''){
		$sql = "select * from cg_branch where (myurl<>'' and myurl<>'http://') and (types=1 or types=4) order by types";
	}else{
		$sql = "select * from cg_branch where types=$types order by id";
	}
	$query = $db->query($sql);
	$result = array();
	while ($row = $db->fetch_array($query)) {
		$row['myurl'] = (stristr($row["myurl"], "http://") == '') ? "http://".$row["myurl"] : $row["myurl"];
		$result[] = $row;
	}
	return $result;
}
function cg_hotd() {
	global $db;
	$query = $db->query("select a.title,b.myurl from cg_branch b left join cg_area a on(a.id=b.city) where b.city>0 and b.myurl<>'' and LOCATE('cgbt.net',b.myurl) order by b.id");
	$result = array();
	while ($row = $db->fetch_array($query)) {
		$row['myurl'] = (stristr($row["myurl"], "http://") == '') ? "http://".$row["myurl"] : $row["myurl"];
		$result[] = $row;
	}
	return $result;
}
/**
 * 搜索条件
 * @param $ctype:enname
 * @param $csearch:'0' => '出发地',
		'1' => '目的地',
		'2' => '服务类型',
		'3' => '行程天数',
		'4' => '预算花费',
		'5' => '游轮品牌',
 **/
function cg_search($ctype, $csearch) {
	global $db;
	$sql = "select * from cg_search where ctype=$ctype and csearch=$csearch order by display";
	$query = $db->query($sql);
	$resu = array ();
	while ($row = $db->fetch_array($query)) {
		$resu[$row['ckey']] = $row['ctitle'];
	}
	return $resu;
}

/**
 * @param $ckey
 * **/
function cg_search_cmin($ckey) {
	global $db;
	$query = $db->query("select cmin from cg_search where ckey='$ckey'");
	return $db->result($query,0);
}
/*
 * 获取广告数据
 * */
function selectdatabanner($sectionID, $count) {
	global $db, $picserver, $siteurl, $bid;
	$orderbysql = ' order by hots ';
	if ($sectionID)
		$sqldataid .= " and mid='" . $sectionID . "'";
	if ($bid)
		$sqldataid .= ' and bid=' . $bid;
	if ($count)
		$limitsql = ' limit ' . $count;
	$sql = 'select * from cg_banner where status=1' . $sqldataid . $orderbysql . $limitsql;
	$query = $db->query($sql);
	while ($value = $db->fetch_array($query)) {
		if (!empty ($value['url'])) {
			$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
		}
		if (!empty ($value['mypath'])&&$sectionID==4) {//当季最热的广告需要有价格，暂时只考虑线路产品
			$tid = preg_replace('/\D/','',$value['mypath']);
			$value['price2'] = cg_tour_price($tid);
		}
		$re[] = $value;
	}
	return $re;
}

/*
 * 获取友情链接数据
 * */
function selectdatalink($count) {
	global $db, $picserver, $siteurl, $bid;
	$orderbysql = ' order by hots ';

	if ($bid)
		$sqldataid .= ' and bid=' . $bid;
	if ($count)
		$limitsql = ' limit ' . $count;
	$sql = 'select * from cg_link where status=1' . $sqldataid . $orderbysql . $limitsql;
	$query = $db->query($sql);
	while ($value = $db->fetch_array($query)) {
		if (!empty ($value['url'])) {
			$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
		}
		$re[] = $value;
	}
	return $re;
}

/*
 * 获取线路数据
 * */
function selectdataroute($count, $type = '1', $classid = 0, $classid2 = 0) {
	global $db, $picserver, $siteurl, $bid;

	if ($count)
		$limitsql = ' limit ' . $count;
	if ($bid)
		$sqladd = " where bid=$bid";
	else
		$sqladd = " where 1=1";
	$sqladd .= " and locate('1',op_type) and locate('" . $type . "',op_type)";
	if ($classid)
		$sqladd .= " and classid=" . $classid;
	if ($classid2)
		$sqladd .= " and classid2=" . $classid2;
	if ($type == '1,2,3' && $classid == 0 && $classid2 == 0)
		$orderbysql = ' order by rand()';
	else
		$orderbysql = ' order by id desc';
	//$sql = "select * from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid,t.status from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.url is not Null and p.id) result" . $sqladd . $orderbysql . $limitsql;
	$sql = "select * from cg_product_route ". $sqladd . $orderbysql . $limitsql;
	//return $sql;
	$query = $db->query($sql);
	while ($value = $db->fetch_array($query)) {
		if(is_numeric($value['city1'])) $value['li'] = cg_area_tit($value['city1']);
		if(is_numeric($value['city2'])) $value['di'] = cg_area_tit($value['city2']);
		if (!empty ($value['url'])) {
			$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
		}
		$price = $db->getOneInfo("select price from cg_product_route_do where id=" . $value['id'] . " and pass=0 order by price desc limit 0,1");
		if (!empty ($price)) {
			$value['price2'] = (int) $value['price2'] - (int) $price['price'];
		}
		$re[] = $value;
	}
	return $count == 1 ? $re[0] : $re;
}

/*
 * 获取产品数据--武松
 * @types 0：酒店,1:商品,2:签证,3:门票,4:餐厅,5:新闻
 * */
function sel_product($count, $type = "1", $types = 0, $ctype = 0, $ctype1 = 0) {
	global $db, $picserver, $siteurl, $bid, $bidinfo;

	$sqlwhere = " where 1=1";
	if ($types == 0 || !empty ($types)) {
		$sqlwhere .= " and types=" . $types;
	}
	if ($ctype) {
		$sqlwhere .= ' and ctype=' . $ctype;
	}
	if ($ctype1) {
		$sqlwhere .= ' and ctype1=' . $ctype1;
	}
	if ($type) {
		$sqlwhere .= " and FIND_IN_SET('1',op_type) and FIND_IN_SET('" . $type . "',op_type)";
	}
	if ($bid) {
		if ($types != 2 and $types != 3)
			$sqlwhere .= " and bid=" . $bid;
		//else
	}else{
		//$sqlwhere.=" and 1=1";
	}
	if ($types == 2 || $types == 3) {
		if ($bid && $bidinfo["cid"] != 9){
			$sqlwhere .= " and FIND_IN_SET(aid, '{$bidinfo['op_stat']}')";
		}
	}
	if ($count == 1)
		$orderbysql = ' order by rand()';
	else
		$orderbysql = ' order by id desc';
	if ($count)
		$limitsql = ' limit 0,' . $count;

	if ($types == 2) {
		$sql = "select aid,id,title,info_id,cid,url,price1,price2,word,info,keyword,bid from cg_scenic" . $sqlwhere . " group by aid" . $limitsql;
	}else{
		$sql = "select id,title,info_id,url,price1,price2,word,info,keyword,bid from cg_scenic" . $sqlwhere . $orderbysql . $limitsql;
	}

	$query = $db->query($sql);
	while ($row = $db->fetch_array($query)) {
		if($row['aid']&&$types == 2){//签证，并且有国家
			$vurl = $db->result($db->query("select url from cg_area where id=".$row['aid']), 0);
			$row['url'] = $vurl;
		}
		if (!empty ($row['url'])) {
			$row['url'] = (stristr($row["url"], "http://") == '') ? $picserver . replaceSeps($row["url"]) : $row["url"];
		}
		$row['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($row['word'])), 70, '...');
		$data[] = $row;
	}
	return $count == 1 ? $data[0] : $data;
}

/**
 * 获取线路数据
 * @param
 * classid 线路类别
 * city1 出发城市
 * city2 目的城市
 * go_day 行程天数
 * go_time 出游时间
 * go_time1 出游结束时间
 * go_money 花费 (,隔开)
 *
 **/
function selectRoleSale($classid, $count = false, $start = 0, $perpage = 1, $city1, $city2, $go_day, $go_time, $go_time1, $go_money, $title, $order = 'id', $orderby = 'desc') {
	global $db, $picserver, $siteurl, $bid;

	$sqlfrom = " from cg_product_route p where 1=1 ";
	if ($classid) {
		$sqlfrom .= " and p.classid=" . $classid;
	}
	if ($city1) {
		$city = cg_search_cmin($city1);
		//URL映射
		if ($city) {
			$city1 = $city;
		}
		if (strpos($city1, ',') === false) {
			$sqlfrom .= " and (p.aid1=$city1 or p.city1=$city1)";
		} else {
			$sqlfrom .= " and (FIND_IN_SET(p.aid1,'" . $city1 . "') or FIND_IN_SET(p.city1,'" . $city1 . "'))";
		}

	}
	if ($city2) {
		$city = cg_search_cmin($city2);
		//URL映射
		if ($city) {
			$city2 = $city;
		}
		if (strpos($city2, ',') === false) {
			$sqlfrom .= " and (p.aid2=$city2 or p.city2=$city2) ";
		} else {
			$sqlfrom .= " and (FIND_IN_SET(p.aid2,'" . $city2 . "') or FIND_IN_SET(p.city2,'" . $city2 . "'))";
		}
	}
	//天数
	if ($go_day) {
		$goday = cg_search_cmin($go_day);
		//URL映射
		if ($goday) {
			$go_day = $goday;
		}
		if (strpos($go_day, ',') === false) {
			$sqlfrom .= " and p.go_day =$go_day ";
		} else {
			$arr = explode(',', $go_day);
			$sqlfrom .= " and p.go_day>=" . $arr[0] . " and p.go_day<=" . $arr[1];
		}
	}
	//时间
	if ($go_time1) {
		$sqlfrom .= " and p.go_type in (0,3)";
	}
	//花费
	if ($go_money) {
		$city = cg_search_cmin($go_money);
		//URL映射
		if ($city) {
			$city2 = $city;
		}
		if (strpos($city2, ',') === false) {
			$sqlfrom .= " and t.price2 like '%" . $city2 . "%' ";
		} else {
			$sqlfrom .= " and FIND_IN_SET(p.price2,'" . $city2 . "'";
		}
	}

	//标题
	if ($title) {
		$sqlfrom .= " and p.title like '%" . $title . "%' ";
	}
	if ($bid) {
		$sqlfrom .= " and p.bid=$bid";
	}else{
		$sqlfrom .= " and 1=1";
	}
	$orderbysql = " order by $order $orderby ";
	if (!$count) {
		return $db->result($db->query("select count(*) $sqlfrom "), 0);
	} else {
		$limitsql = ' limit ' . $start . ',' . $perpage;
		$sql = "select * $sqlfrom $orderbysql $limitsql";
		// return $sql;
		$query = $db->query($sql);
		while ($value = $db->fetch_array($query)) {
			if (!empty ($value['url'])) {
				$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
			}
			$price = $db->getOneInfo("select price from cg_product_route_do where id=" . $value['id'] . " and pass=0 order by price desc limit 0,1");
			if (!empty ($price)) {
				$value['price2'] = (int) $value['price2'] - (int) $price['price'];
			}
			$value['hid'] = $value['id'];
			$re[] = $value;
		}
	}
	return $re;
}

/**景点**/
function selectScenic($types = 0, $title = "", $count = false, $start = 0, $perpage = 1) {
	global $db, $picserver, $siteurl, $bid, $bidinfo;
	$sqlfrom = " from cg_scenic where types=$types ";
	if (!empty ($bidinfo)) {
		$sqlfrom .= " and aid=" . $bidinfo["aid"];
	}
	//标题
	if ($title) {
		$sqlfrom .= " and title like '%" . $title . "%' ";
	}
	$orderbysql = "  order by id desc,hots desc ";
	if (!$count) {
		return $db->result($db->query("select count(*) $sqlfrom "), 0);
	} else {
		$limitsql = ' limit ' . $start . ',' . $perpage;
		$sql = "select * $sqlfrom $orderbysql $limitsql";
		$query = $db->query($sql);
		while ($value = $db->fetch_array($query)) {
			if (!empty ($value['url'])) {
				$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
			}
			$value['price_2'] = $value['price2'];
			$value['hid'] = $value['id'];
			$value['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($value['word'])), 55, '...');
			$re[] = $value;
		}
	}
	return $re;
}
/*线路计划价格查询*/
function cg_tour_price($id) {
	global $db;
	$query = $db->query("select price2 from cg_product_route where id=$id");
	if($db->result($query,0)===NULL){
		return '0';
	}else{
		return $db->result($query,0);
	}
}

/*查询 地区名称*/
function cg_area_tit($id) {
	global $db;
	$res = $db->getOneInfo("select title from cg_area where id=" . $id);
	return $res['title'];
}
?>
