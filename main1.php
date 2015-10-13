<?PHP
include_once ('./common/inc/main.inc.php');
$enname = $_GET['enname'];
$id = $_GET['id'];
$match = $_GET['match'];
$page = intval($_GET['page']);
$page = (empty ($page)) ? 1 : $page;
$smarty->assign('enname', $enname);
$smarty->assign('id', $id);
$smarty->assign('page', $page);
$shtml = array (
	"aboutus",
	"contactus",
	"advise",
	"advertising",
	"qualifications",
	"duty",
	"partner",
	"sitemap",
	"insurance",
	"help",
	"instructions",
	"statement",
	"agreement",
	"company"
);
$sphp = array (
	"aboutus",
	"contactus",
	"advise",
	"advertising",
	"qualifications",
	"duty",
	"partner",
	"sitemap",
	"insurance",
	"help",
	"instructions",
	"statement",
	"agreement",
	"company"
);
if (in_array($enname, $shtml)) {
	$smarty->assign('al_num', array_keys($shtml, $enname));
	switch ($enname) {
		case "qualifications" : //资质
			break;
		case "partner" : //合作
			break;
		case "sitemap" : //网站地图
			break;
		case "help" : //FAQ
			break;
		case "company" : //分公司
			break;
		default :
			break;
	}
	$smarty->display(V_ROOT . "./html/$enname.html", $cache_id);
} else {
	if (empty ($id)) {
		$cid = $db->getOneInfo("select id,title from cg_class where html='" . $enname . "' and pid=0");
		if (!empty ($cid)) {
			//出发地
			$smarty->assign('chufa', cg_search($cid['id'], 0));
			//目的
			$smarty->assign('mudi', cg_search($cid['id'], 1));
			//行程天数
			$smarty->assign('xingcheng', cg_search($cid['id'], 3));
			//预算花费
			$smarty->assign('huafei', cg_search($cid['id'], 4));
		}
	}
	//匹配一级页面 规则-分割 按照顺序站位
	if (!empty ($match)) {
		$matchy = explode('-', $match);
		//出发
		$go_start = $matchy[0];
		$smarty->assign('go_start', $go_start);
		//目的1
		$go_end = $matchy[1];
		$smarty->assign('go_end', $go_end);

		//目的2
		$go_end2 = $matchy[2];
		$smarty->assign('go_end2', $go_end2);

		//行程天数
		$go_days = $matchy[3];
		$smarty->assign('go_days', $go_days);

		//出游时间1(格式YYYYMMDD)
		$go_starttime = $matchy[4];
		$smarty->assign('go_starttime', $go_starttime);

		//出游时间2(格式YYYYMMDD)
		$go_endtime = $matchy[5];
		$smarty->assign('go_endtime', $go_endtime);

		//预算花费
		$go_money = $matchy[6];
		$smarty->assign('go_money', $go_money);

		//推荐
		$go_tuijian = $matchy[7];
		$smarty->assign('go_tuijian', $go_tuijian);

		//销量
		$go_sall = $matchy[8];
		$smarty->assign('go_sall', $go_sall);
		//热度
		$go_hot = $matchy[9];
		$smarty->assign('go_hot', $go_hot);
	}

	if (empty ($cid)) {
		include_once (V_ROOT . '/index/' . $enname . '.php');
	} else {
		include_once (V_ROOT . '/index/list_tours.php');
	}
}
?>