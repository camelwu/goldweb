<?php
/*
 * Created on 2015-5-1
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//_2:page,/1 id
/* 初始化数组参数 */
$table = "cg_scenic";
$op_types = array ("关闭","开通","特色","推荐","专题","微信","销售");
$ro_types = array('团体包价','特殊旅游','散客拼团','自驾游');
$go_types = array('每天发团','每周发团','每月发团','输入团期');
$eats = array(1=>'早餐',2=>'午餐',3=>'晚餐');
$traffics = array('null'=>'无','plane'=>'飞机','train'=>'火车','ship'=>'轮船','car'=>'汽车');
$r2 = array('否','是');
/*城市 查询 酒店、餐厅、景点、新闻等*/
function cg_sight($city = '',$types=3) {
	global $db;
	//$sqlstr = "select id,title from cg_scenic where find_in_set($city,id)";
	$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '".$city."')>0 $sql order by cg_scenic.hots";
	$query = $db->query($sqlstr);
	$data = $res = array ();
	while ($row = $db->fetch_array($query)) {
		$res[$row['id']] = $row['title'];
	}
	return $res;
}
/*根据id,table查到title*/
function cg_gettit($myid=0,$tab = '') {
	global $db;
	if($myid==0||$tab==''){
		return '无';
	}else{
		$res = $db->getOneInfo("select title from ".DBFIX.$tab." where id=$myid");
		return $res['title'];
	}
}
/*根据库表字段字符串,查到选中内容*/
function cg_getval($str='',$arr=array()) {
	global $db;
	$val = '';
	while (list($key, $value) = each($arr)) {//foreach ($arr as $key => $value) {
    	if(strpos($str, (string)$key)>-1) $val .= $value.',';//echo "Key: $key; Value: $value<br />\n";
	}
	if(substr($val,-1)===',') $val = substr($val,0,-1);
	return $val;
}
/*线路明细查询*/
$sqlstr = "select * from $table where id=" . $id;
$info = $db->getOneInfo($sqlstr);
if (!empty ($info)) {
	$info['ro_type'] = strpos($info['ro_type'],',')?explode(',',$info['ro_type']):$info['ro_type'];
	$info['op_type'] = strpos($info['op_type'],',')?explode(',',$info['op_type']):$info['op_type'];
	$query = $db->query("select * from ".$table."_stroke where id=".$id." order by num asc");
	$data = $comments = array ();
	while ($data = $db->fetch_array($query)) {
		$data['eats'] = explode(',',$data['eats']);
		$data['scenics'] = cg_sight(''.$data['departure'].','.$data['arrived'].'');
		$data['scenic'] = explode(',',$data['scenic']);
		$comments[] = $data;
	}
	$smarty->assign('stroke', $comments);
}else{
	
}
$smarty->assign('r_2', $r2);
$smarty->assign('ro_type', $ro_types);
$smarty->assign('go_type', $go_types);
$smarty->assign('op_type', $op_types);
$smarty->assign('eats', $eats);
$smarty->assign('traffic', $traffics);
//
$smarty->assign('info', $info);
$smarty->display(V_ROOT.'./templates/commodity_details.html',$cache_id);
?>