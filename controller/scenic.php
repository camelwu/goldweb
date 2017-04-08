<?php
/* 初始化参数 */
$table = "cg_scenic";
$types = 3;
$type = '1';
$perpage = 6;
if (!empty ($bidinfo)) {
	$sqladd = " and aid=" . $bidinfo["aid"];
}
//2017-4-6 重置路由后的参数修改
if(empty($action)){
	$match = '---';
}else {
	$match = $action;
}
if(isset($_GET['order'])){
	$order = $_GET['order'];
}else {
	$order = '--';
}
//武松：2015-9-15 境外分站只显示本国景点
// $query = $db->query("select id,brand from $table where types=$types $sqladd group by brand");
// $go_types = $db->getAll("select id,brand from $table where types=$types $sqladd group by brand");

/*
 * 地区列表
 */
$area = array ();
$sql="select id,title,hots from cg_class where classtype=5 and pid=0 order by hots";
// if($action=="overseas"){//出境
// 	$sql = "select id,title,hots from cg_class where classtype=5 and pid=0 and id<65 order by hots";
// }else{//国内
// 	$sql = "select id,title,hots from cg_class where classtype=5 id=65";
// }
$query = $db->query($sql);
while ($row = $db->fetch_array($query)) {
	$sql = "select t.aid as id,p.title from cg_area p,cg_scenic t where t.types=$types and t.cid={$row['id']} and t.aid=p.id group by t.aid ";
	$query1 = $db->query($sql);
	$res = array ();
	while ($val = $db->fetch_array($query1)) {
		$res[] = $val;
	}
	if (count($res)) {
		$stat[] = $row['title'];
		$area[] = $res;
	}
}

$smarty->assign('stat', $stat);
$smarty->assign('area', $area);
/*
 * 景点列表查询
 */

$sqlfrom = "from $table";
$sqladd = " where types=$types";
$sqladd .= " and find_in_set('" . $type . "',op_type)";

if (!empty ($bidinfo)) {
	$sqladd .= " and aid=" . $bidinfo["aid"];
	$jingwai = 1;
}
//武松：2015-9-15 境外分站只显示本国景点
if (!empty ($match)) {
	$sqldataid = '';
	$matchy = explode('-', $match);
	//目的1
	$go_end = $matchy[0];
	$sqldataid .= !empty ($go_end) && $go_end != 0 ? ' and cid=' . (int) $go_end : "";
	$smarty->assign('go_end', $go_end);
	//目的2
	$go_end2 = $matchy[1];
	$sqldataid .= !empty ($go_end2) && $go_end2 != 0 ? ' and aid=' . (int) $go_end2 : "";
	$smarty->assign('go_end2', $go_end2);
	//主题类型
	$go_type = $matchy[2];
	$sqladd .= !empty ($go_type) ? " and find_in_set('" . $go_type . "',brand)" : "";
	$smarty->assign('go_type', $go_type);
	//景点级别
	$go_item = $matchy[3];
	$sqladd .= !empty ($go_item) ? " and ctype=" . $go_item . "" : "";
	$smarty->assign('go_item', $go_item);
	//价格区间
	$go_money = $matchy[4];
	if (!empty ($go_money)) {
		if ($go_money == '50') {
			$sqladd .= " and price1<50 and price1>=0";
		}
		elseif ($go_money == '100') {
			$sqladd .= " and price1<100 and price1>=50";
		} else {
			$sqladd .= " and price1>=100";
		}
	}
	$smarty->assign('go_money', $go_money);

	//推荐
	// $go_tuijian = $matchy[5];
	// $orderbysql = !empty ($go_tuijian) ? ' order by id desc,hots desc' : ' order by id desc,hots desc';
	// $smarty->assign('go_tuijian', $go_tuijian);
	//销量
	$go_sall = $matchy[6];
	$orderbysql = !empty ($go_sall) ? ' order by hots desc' : $orderbysql;
	$smarty->assign('go_sall', $go_sall);
	//热度
	$go_hot = $matchy[7];
	$orderbysql = !empty ($go_hot) ? ' order by price1 asc' : $orderbysql;
	$smarty->assign('go_hot', $go_hot);
}

$totalnum = $db->result($db->query("select count(*) " . $sqlfrom . $sqladd . $sqldataid), 0); //总数;
$pagecount = ceil($totalnum / $perpage); //页数
$page = $page > $pagecount ? 1 : $page;
$start = ($page -1) * $perpage;
$limitsql = " limit $start,$perpage";

$sql = "select * " . $sqlfrom . $sqladd . $sqldataid . $orderbysql . $limitsql;
$test = !empty ($go_end) && $go_end != 0 ? "1" : "0";
$query = $db->query($sql);
while ($value = $db->fetch_array($query)) {
	if (!empty ($value['url'])) {
		$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
	}else{
		$value['url'] = $picserver . "/attached/nopic.gif";
	}
	$value['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($value['word'])), 55, '...');
	$comments[] = $value;
}

//$nowpage = empty ($match) ? "/" . $module : "/" . $module . "/" . $match;
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, '/' . $module . '/' . $match . '/' . $order, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('jingwai', $jingwai);
$smarty->assign('cnname', '景点门票');
$smarty->assign('enname', $module);
$smarty->assign('go_types', cg_class(6));
$smarty->assign('vtype', cg_class(3));
//头部广告
$smarty->assign('banner', selectdatabanner(6, 7));
$smarty->assign('info', $info);
$smarty->display(VIEWPATH . '/scenic.html', $cache_id);

/*城市 查询 酒店、餐厅、景点、新闻等*/
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
?>
