<?php
//分支机构
$perpage = 6;
$start = ($page -1) * $perpage;
$table = "cg_branch";
switch ($action) {
	case "company" :// 车队
		$whe = "where types=0";
		$cnname = "车队";
		break;
	case "partner" :// 同行
		$whe = "where types=1";
		$cnname = "合作伙伴";
		break;
  case "ship" :// 邮轮公司
    $whe = "where types=2";
		$cnname = "邮轮公司";
    break;
  case "shop" :// 门市
		$whe = "where types=3";
		$cnname = "门市地址";
    break;
  default ://分公司
		$whe = "where types=4";
		$cnname = "分公司地址";
    break;
}
$sql = "select * from $table $whe order by id limit $start,$perpage";
$totalnum = $db->result($db->query("select count(*) from $table $whe"),0);
$comments = $db->getAll($sql);
$pagecount = ceil($totalnum / $perpage);
$multipage = pagecute($totalnum, $pagecount, $page, '/'.$module.'/'.$action, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('comments', $comments);
$smarty->assign('totalnum', $totalnum);
$smarty->assign('cnname', $cnname);
/***浏览记录**/
$smarty->assign("brower", get_cg_brower());
/***销售排行**/
$smarty->assign('hots', get_sale_top());
$smarty -> display(VIEWPATH . "/agency.html", $cache_id);
?>
