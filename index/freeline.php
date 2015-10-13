<?php
/*
 * Created on 2015-4-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/
//出境
$sort = $_GET['sort'];
//$cid = array(112,113,114,117,118,148);
$cid = $db->getOneInfo("select id,title from cg_class where html='".$enname."' and pid=0");
$classid = intval($cid['id']);
$cname = $cid['title'];
$type = '1';
$perpage = 6;
$start = ($page -1) * $perpage;
$sqlfrom = "from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id) result";
if ($bid)
	$sqladd = " where bid=$bid";
else
	$sqladd = " where 1=1";
$sqladd .= " and find_in_set('".$type."',optype)";
$sqldataid = ' and classid=' . $classid;
switch($sort){
	case "s"://all
	$orderbysql = ' order by hits desc';//add
	break;
	case "rq":
	$orderbysql = ' order by hits desc';
	break;
	case "new":
	$orderbysql = ' order by hid desc';
	break;
	case "d"://sales
	$orderbysql = ' order by hots desc';
	break;
	default://price
	$orderbysql = ' order by price2 asc';
	break;
}

$limitsql = " limit $start,$perpage";
$sql = "select * ".$sqlfrom. $sqladd. $sqldataid . $orderbysql . $limitsql;
//echo $sql;
$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqladd. $sqldataid), 0); //总数;
$query = $db->query($sql);
while ($value = $db->fetch_array($query)) {
	if (!empty ($value['url'])) {
		$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
	}
	$price = $db->getOneInfo("select price from cg_product_route_do where id=".$value['id']." and pass=0 order by price desc limit 0,1");
	if (!empty ($price)) {
		$value['price_2'] = (int)$value['price_2']-(int)$price['price'];
	}
	$comments[] = $value;
}
$pagecount = ceil($totalnum/$perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, $enname, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('cnname', $cname);
$smarty->assign('enname', $enname);
$smarty->display(V_ROOT.'./templates/'.$enname.'.html',$cache_id);
?>
