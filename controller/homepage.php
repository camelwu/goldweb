<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//首页横幅广告位
$smarty -> assign('banner', selectdatabanner(1, 3));
/*首页推荐广告位*/
$smarty -> assign('hots', selectdatabanner(4, 5));
//当季最热
$smarty -> assign('received', selectdataroute(5, "2"));
//出境
$smarty -> assign('cjroute', selectdataroute(6, "3", 112));
$smarty -> assign('cjline', selectdataroute(1, "2", 112));
//国内
$smarty -> assign('gnroute', selectdataroute(6, "3", 113));
$smarty -> assign('gnline', selectdataroute(1, "2", 113));
//周边
$smarty -> assign('zbroute', selectdataroute(6, "3", 114));
$smarty -> assign('zbline', selectdataroute(1, "2", 114));
//出境自由行
$smarty -> assign('cjfree', selectdataroute(6, "3", 117, 148));
$smarty -> assign('cfree', selectdataroute(1, "2", 117, 148));
//国内自由行
$smarty -> assign('gnfree', selectdataroute(6, "3", 117, 149));
$smarty -> assign('gfree', selectdataroute(1, "2", 117, 149));
//邮轮
$smarty -> assign('ylroute', selectdataroute(4, "3", 118));
//$smarty->assign('ylline', selectdataroute(1, "2", 118));
/*线路外其它产品
 *param[1]:"3"&&"2"
 *param[2]:@types 0：酒店,1:商品,2:签证,3:门票,4:餐厅,5:新闻
 */

//$smarty->assign('hotel',sel_product(8,"3",0));

/*精选景点：1，3，热门1,2+随机一个图*/
//$smarty->assign('menpiao',sel_product(6,"4",3));
// var_dump(sel_product(8, "3", 3));
$smarty -> assign('scenic', sel_product(8, "3", 3));
$smarty -> assign('sight', sel_product(1, "2", 3));
/*签证*/
if ($template == "branch") {
	$smarty -> assign('visa', sel_product(4, "3", 2));
} else {
	$smarty -> assign('visa', sel_product(8, "3", 2));
}
//热门国家
$sql = "select t.aid as id,p.title from cg_area p,cg_scenic t where t.types=2 and locate('1',t.op_type) and locate('2',t.op_type) and p.id=t.aid group by t.aid order by t.hots desc limit 8";
$query1 = $db -> query($sql);
$res = array();
while ($val = $db -> fetch_array($query1)) {
	$res[] = $val;
}
$smarty -> assign('pass', $res);
//游记
$smarty -> assign('news', sel_product(8, "3", 5, 98));
$smarty -> assign('newl', sel_product(1, "2", 5, 98));
//首页新闻广告位
$smarty -> assign('link', selectdatalink(15));
//热门目的地,热门线路的目的地？

$smarty -> display(VIEWPATH . $template . '.html', $cache_id);
exit;
