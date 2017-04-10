<?php
global $smarty;
//开通+热门+推荐 1,2,3
$rtours = selectdataroute(5,'1,2,3');
if(count($rtours)>0&&!empty($rtours)){
	$smarty->assign('rtours', $rtours);
	$smarty->display(VIEWPATH .'/common/right.html',$cache_id);
}
?>
