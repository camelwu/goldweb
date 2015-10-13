<?php
include_once('./common/inc/main.inc.php');
include_once('./common/weixin/wechat.php');
//if($_SERVER['QUERY_STRING']!=""){
	$wechatObj = new wechatCallbackapiTest();
	//$wechatObj->valid();
traceHttp();
exit;

//$sql = "SELECT * FROM config ";
//$query1 = $db->query($sql);
//while($row=$db->fetch_array($query1)){
//	$smarty->assign($row['keyid'],$row['value']);
//}
//
//
////首页新闻广告位
//$smarty->assign('indexnews',selectdata('index_news',3));
////首页京都十大经典项目广告位
//$smarty->assign('indexdepart',selectdata('index_depart',10));
//
////首页视频中心广告位
//$smarty->assign('indexvideo',selectdata('index_video',2));
//
////首页专家团队广告位
//$smarty->assign('indexzhuanjia',selectdata('index_zhuanjia',11));
////首页荣誉展示广告位
//$smarty->assign('indexrongyu',selectdata('index_rongyu',11));
////首页环境展示广告位
//$smarty->assign('indexhuanjing',selectdata('index_huanjing',11));
////首页设备展示广告位
//$smarty->assign('indexshebei',selectdata('index_shebei',11));
////首页国际顶尖技术项目广告位
//$smarty->assign('indexguoji',selectdata('index_guoji',3));
//
////首页底部专题广告位
//$smarty->assign('indexsubject',selectdata('index_subject',5));
////首页合作伙伴广告位
//$smarty->assign('indexpartner',selectdata('index_partner',20));
////首页友情链接广告位
//$smarty->assign('indexlink',selectdata('index_link',20));
////首页网站标签广告位
//$smarty->assign('indextag',selectdata('index_tag',20));
//
//
////媒体报道
//$smarty->assign('meititop',selectmessage('436','','','',false,0,1,'istop'));
//$smarty->assign('meitits',selectmessage('436','','','',false,0,5,'ts'));

$template = 'moban';
$smarty->display(V_ROOT.'./moban/index.html',$cache_id);
?>