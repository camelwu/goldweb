<?php
switch ($module) {
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

$smarty -> assign('al_num', array_keys($shtm, $module));
$smarty -> display(VIEWPATH . "/$module.html", $cache_id);
