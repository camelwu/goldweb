<?php
/*
 * Created on 2015-4-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/
//介绍
$sort = $_GET['sort'];
$smarty->assign('info', $bidinfo);
/*右侧销售排行*/
if ($bid)
	$sqladd = " where bid=$bid";
else
	$sqladd = " where 1=1";
//hits点击，hots销售
$orderbysql = ' order by hots desc';
$limitsql = ' limit 5';
$sql = "select * from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,p.hots,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id) result". $sqladd. $orderbysql. $limitsql;

$query = $db->query($sql);
while ($value = $db->fetch_array($query)) {
	if (!empty ($value['url'])) {
		$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
	}
	$price = $db->getOneInfo("select price from cg_product_route_do where id=".$value['id']." and pass=0 order by price desc limit 0,1");
	if (!empty ($price)) {
		$value['price_2'] = (int)$value['price_2']-(int)$price['price'];
	}
	$res[] = $value;
}
$smarty->assign('hots', $res);
$smarty->assign('cnname', '团队介绍');
$smarty->assign('enname', $module);
$smarty -> display(VIEWPATH . "/about.html", $cache_id);
#$smarty->display(V_ROOT.'./templates/about.html',$cache_id);
?>
