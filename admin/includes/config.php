<?php


// database host
$memcache_host = "localhost";
$db_host_select = $db_host_update = $db_host = "localhost";
$db_name = "jinqiao";
$db_user_select = $db_user_update = $db_user = "root";
$db_pass_select = $db_pass_update = $db_pass = 'mysql*()';
//
define('DBFIX', 'cg_'); //
define('MEMCACHE_SWITCH', 1); //开启memcache缓存
define('attachdir', 'attached');
define('attachurl', './attached');
define('reviews', 0);
define('VER', 'V4.2.0');
// Poster
$Config = array (
	'web' => array (
		'0' => '线路',
		'1' => '信息',
		'2' => '签证',
		'3' => '景点',
		'4' => '酒店',
		'5' => '区域',
		'6' => '地区',
		'7' => '语种',
		'8' => '餐厅',
		'9' => '商店'
	),
	'types' => array (
		'0' => '国家',
		'1' => '地区'
	),
	'guide' => array (
		'0' => '导游',
		'1' => '翻译'
	),
	'scenic' => array (
		'0' => '酒店',
		'1' => '商品',
		'2' => '签证',
		'3' => '景点',
		'4' => '餐厅',
		'5' => '信息',
		'6' => '租车'
	),
	'hotel' => array (
		'0' => '客房',
		'1' => '图片'
	),
	'line' => array (
		'0' => '线路计划',
		'1' => '线路行程',
		'2' => '线路价格',
		'3' => '线路图片',
		'4' => '线路调度'
	),
	'float' => array (
		'1' => '上调',
		'0' => '下降'
	),
	'pass' => array (
		'1' => '正常显示',
		'0' => '仅计调用'
	),
	'net' => array (
		'0' => '另外计费',
		'1' => '免费提供',
		'2' => '暂不提供'
	),
	'zao' => array (
		'0' => '另外计费',
		'1' => '包含一份',
		'2' => '包含双份',
		'3' => '包含三份',
		'4' => '暂不提供'
	),
	'vehicle' => array (
		'0' => '2~5座',
		'1' => '6~9座',
		'2' => '10座以上'
	),
	'company' => array (
		'0' => '车队',
		'1' => '同行机构',
		'2' => '游轮公司',
		'3' => '门市',
		'4' => '金桥'
	),
	'plane' => array (
		'0' => '单程',
		'1' => '往返',
		'2' => '联程'
	),
	//广告位
	'mid' => array (
		'1' => '首页banner(1920 X 430)',
		'2' => '首页左侧浮动广告',
		'3' => '首页右侧浮动广告',
		'4' => '首页最受欢迎',
		'overseas' => '出境游banner(1200 X 160)',
		'domestic' => '国内游banner(365 X 205)',
		'touraround' => '周边游banner(365 X 205)',
		'freeline' => '自由行banner(365 X 205)',
		'cruises' => '游轮banner(1920 X 330)',
		'scenic' => '景点门票banner(1920 X 330)',

		
	),
	'status' => array (
		'0' => '未启用',
		'1' => '启用',

		
	),
	'csearch' => array (
		'0' => '出发地',
		'1' => '目的地',
		'2' => '服务类型',
		'3' => '行程天数',
		'4' => '预算花费',
		'5' => '游轮品牌',

		
	),
	'cselected' => array (
		'1' => '国家/城市',
		'2' => '游轮',

		
	),
	'eats' => array (
		'早' => '早',
		'中' => '中',
		'晚' => '晚',

		
	),
	'traffic' => array (
		'plane' => '飞机',
		'train' => '火车',
		'ship' => '轮船',
		'car' => '汽车'
	),
	'orderstatus' => array (
		'0' => '未支付',
		'1' => '已支付'
	),
	'op_type' => array (
		'尚未处理',
		'有效订单',
		'无效订单',
		'成交订单',
		'未成订单'
	),
	'templates' => array (
		'index' => '默认模板',
		'branch' => '定制模板1'
	),
);
//op_types
$op_types = array (
	"关闭",
	"开通",
	"特色",
	"推荐",
	"专题",
	"销售",
	"分销"
);
//
$scriptname = explode('/', $_SERVER['SCRIPT_NAME']);
$filename = end($scriptname); //得到本页名称
?>