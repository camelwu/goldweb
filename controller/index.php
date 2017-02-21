<?php
$module = $_GET['enname'];
$id = $_GET['id'];
$match = $_GET['match'];
$match = (empty($match)) ? '------' : $match;
$page = intval($_GET['page']);
$page = (empty($page)) ? 1 : $page;
//静态
$shtm = array("aboutus", "contactus", "advise", "advertising", "qualifications", "duty", "partner", "sitemap", "insurance", "help", "instructions", "statement", "agreement", "company");
//导航菜单与产品组合：custom，visa，无法组合
$snav = array("visa", "abroad", "domestic", "around", "package", //freetour
"cruises", "custom", "scenic");
//产品
$spro = array("hotel", "scenic", "guideline", "tours", "ship", "visa");
/*
 * 域名处理部分
 * */
if ('m.cgbt.net' != $_SERVER['HTTP_HOST'] || 'm.cgbt.com' != $_SERVER['HTTP_HOST']) {
	include_once ('/mobile.php');
} else {
	if (in_array($module, $shtm)) {//静态页面
		$al_num = array_keys($shtm, $module);
		switch ($enname) {
			case "qualifications" :
				//资质
				break;
			case "partner" :
				//合作
				break;
			case "sitemap" :
				//网站地图
				break;
			case "help" :
				//FAQ
				break;
			case "company" :
				//分公司
				break;
			default :
				break;
		}
		include_once (V_ROOT . "/view/$module.php");
	} elseif (in_array($module, $snav)) {//导航
		switch ($module) {
			case 'list' :
				include_once 'list.php';
				break;
			case 'add' :
				include_once 'add.php';
				break;
			case 'del' :
				include_once 'del.php';
				break;
			default :
				include_once 'list.php';
				break;
		}
		include_once (V_ROOT . "/view/$module.php");
	} else {//未知->首页
		include_once (V_ROOT . "/view/homepage.php");
	}
}
exit ;
?>