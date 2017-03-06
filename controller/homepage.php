<?php
/*
 * 重写数据获取
 * 展示最后调用
 * */
//首页横幅广告位
$banner = selectdatabanner(1, 3);
/*首页推荐广告位*/
$received = selectdatabanner(4, 5);
//当季最热
//var_dump(selectdataroute(5, "2");exit;
$hots = selectdataroute(5, "2");
//出境
$cjroute = selectdataroute(6, "3", 112);
$cjline = selectdataroute(1, "2", 112);

//国内
$gnroute = selectdataroute(6, "3", 113);
$gnline = selectdataroute(1, "2", 113);
//周边
$zbroute = selectdataroute(6, "3", 114);
$zbline = selectdataroute(1, "2", 114);
//出境自由行
$cjfree = selectdataroute(6, "3", 117, 148);
$cfree = selectdataroute(1, "2", 117, 148);
//国内自由行
$gnfree = selectdataroute(6, "3", 117, 149);
$gfree = selectdataroute(1, "2", 117, 149);
//邮轮
$ylroute = selectdataroute(4, "3", 118);
//$ylline = selectdataroute(1, "2", 118);
/*线路外其它产品
 *@param[1]:"3"&&"2"
 *@param[2]:@types 0：酒店,1:商品,2:签证,3:门票,4:餐厅,5:新闻
*/

//$hotel',sel_product(8,"3",0);

/*精选景点：1，3，热门1,2+随机一个图*/
//$menpiao',sel_product(6,"4",3);
#var_dump(sel_product(8, "3", 3);
$scenic = sel_product(8, "3", 3);
$sight = sel_product(1, "2", 3);
/*签证*/
//var_dump(sel_product(4, "3", 2);exit;
if($template == "branch"){
	$visa = sel_product(4, "3", 2);
}else {
	$visa = sel_product(8, "3", 2);
}
//热门国家
$sql = "select t.aid as id,p.title from cg_area p,cg_scenic t where t.types=2 and locate('1',t.op_type) and locate('2',t.op_type) and p.id=t.aid group by t.aid order by t.hots desc limit 8";
$query1 = $db->query($sql);
$res = array ();
while ($val = $db->fetch_array($query1)) {
	$res[] = $val;
}
$pass = $$res;
//游记
$news = sel_product(8, "3", 5, 98);
$newl = sel_product(1, "2", 5, 98);
//首页新闻广告位
$link = selectdatalink(15);
//热门目的地,热门线路的目的地？
$sql = "";
//;
//if('elsi.cgbt.net'==$_SERVER['HTTP_HOST']||'eluosi.cgbt.net'==$_SERVER['HTTP_HOST']){
//	$smarty->display(V_ROOT.'./'.$template.'/branch.html',$cache_id);
//}else{
//	
//	$smarty->display(V_ROOT.'./'.$template.'/index.html',$cache_id);
//}
include_once(V_ROOT . '/view/homepage.php');
?>