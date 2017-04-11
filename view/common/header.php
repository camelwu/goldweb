<?php
/*
 * Created on 2013-4-20
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
global $smarty,$bid,$bidinfo;
$smarty->assign('cg_branch', cg_branch());
////一级菜单
$layer = cg_class(0);
$smarty->assign('layer', $layer);
foreach ($layer as $key => $value) {
	$layer[$key]['layer1'] = cg_layer1($key);
	$layer[$key]['layer2'] = cg_layer2($key);
	foreach ($layer[$key]['layer2'] as $key2 => $value2) {
		$layer[$key]['layer2'][$key2]['area'] = cg_layer3($key, $value2['id']);
	}

}
$smarty->assign('layermax', $layer);

function cg_layer1($id) {
	global $db;
	$sql = "SELECT a.id,a.title FROM cg_product_route t ,cg_area a where t.city2=a.id and t.classid=" . $id . ' limit 3';
	$query = $db->query($sql);
	$result = array ();
	while ($row = $db->fetch_array($query)) {
		$result[] = $row;
	}
	return $result;
}
function cg_layer2($id) {
	global $db;
	$sql = "SELECT c.id,c.title FROM cg_product_route t ,cg_area a,cg_class c where t.city2=a.id and a.classid = c.id and t.classid=" . $id . " group by c.id  limit 20";
	$query = $db->query($sql);
	$result = array ();
	while ($row = $db->fetch_array($query)) {
		$result[] = $row;
	}
	return $result;
}
function cg_layer3($id, $classid) {
	global $db;
	$sql = "SELECT a.id,a.title FROM cg_product_route t ,cg_area a where t.city2=a.id  and t.classid=$id and a.classid=$classid group by a.classid  limit 20";
	$query = $db->query($sql);
	$result = array ();
	while ($row = $db->fetch_array($query)) {
		$result[] = $row;
	}
	return $result;
}

//
////三级菜单
//$smarty->assign('layer4',select_con_tag(1,4));
//

if($bid&&$bidinfo["cid"]!=9){
	$smarty->display(VIEWPATH .'/common/nav.html', $cache_id);
}else{
	$smarty->display(VIEWPATH .'/common/header.html', $cache_id);
}
?>
