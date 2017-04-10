<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($_GET);exit;
$sql = "select * from cg_area where id=".$id."";
$info = $db->getOneInfo($sql);
if($info['classid']==57||$info['classid']==65){
  $cid = 113;
}else{
  $cid = 112;
}
//线路推荐
$tuijianinfo = selectRoleSale($cid, true, 0, 4, '', '', '', '', '', '', '');

//景点推荐
if($info['pid']==0){//国家,shengs
  $str = "select * from cg_scenic where types=3 and aid=".$info['id']." limit 0,4";
}else{
  $str = "select * from cg_scenic where types=3 and city=".$info['id']." limit 0,4";
}
$query = $db->query($str);
$locate = array();
while ($row = $db->fetch_array($query)) {
  if (!empty ($row['url'])) {
    $row['url'] = (stristr($row["url"], "http://") == '') ? $picserver . replaceSeps($row["url"]) : $row["url"];
  }else{
    $row['url'] = $picserver.'/attached/nopic.gif';
  }
  $row['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($row['word'])), 30, '...');
  $locate[] = $row;
}
$smarty->assign("locate", $locate);
$smarty->assign("tuijianinfo", $tuijianinfo);
/***浏览记录**/
$smarty->assign("brower", get_cg_brower());
/***销售排行**/
$smarty->assign('hots', get_sale_top());
$smarty->assign('info', $info);
$smarty->assign('cnname', "目的地指南");
$views = 'guide.html';

$smarty->display(VIEWPATH . $views, $cache_id);
