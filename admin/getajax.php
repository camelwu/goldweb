<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$q = postget('q');
if ('getclasstype' == $q) {
	$classtype = postget('classtype');
	echo json_encode(cg_class($classtype));
} elseif ('gettrasearch' == $q) {
	$traffic = $_GET['traffic'];
	$tnames = $_GET['tnames'];
	$tnamesh = explode(',', $_GET['tnamesh']);
	if (empty($traffic)) {
		exit ;
	}
	$sqlwhere = ' where 1 ';
	if (!empty($tnames)) {
		$sqlwhere .= " and title like '%{$tnames}%' ";
	}
	$table = "cg_cost_tra_" . $traffic;
	$query = $db -> query("select * from $table $sqlwhere ");
	$htmls = "";
	while ($info = $db -> fetch_array($query)) {
		$htmls .= "<input type='checkbox' name='tname[]' value='{$info['title']}' " . (in_array($info['title'], $tnamesh) ? "checked" : "") . ">" . $info['title'] . "&nbsp;&nbsp;";
	}
	echo $htmls;
	exit ;
} elseif ('searchscenic' == $q) {
	$departure = $_GET['departure'];
	$arrived = $_GET['arrived'];
	$scenicsh = explode(',', $_GET['scenicsh']);
	$htmls = "";
	$sqlwhere = ' where t.city=a.id and t.types=3 ';
	if (!empty($arrived) && empty($departure)) {
		$sqlwhere .= " and a.title like '%{$arrived}%' ";
	} elseif (empty($arrived) && !empty($departure)) {
		$sqlwhere .= " and a.title like '%{$departure}%' ";
	} elseif (!empty($arrived) && !empty($departure)) {
		$sqlwhere .= " and (a.title like '%{$departure}%' or a.title like '%$arrived%') ";
	} else {
		exit('请输入抵离城市！');
	}

	$table = "cg_scenic";
	$query = $db -> query("select t.title from $table t,cg_area a $sqlwhere  ");

	while ($info = $db -> fetch_array($query)) {
		$htmls .= "<input type='checkbox' name='scenic[]' value='{$info['title']}' " . (in_array($info['title'], $scenicsh) ? "checked" : "") . ">" . $info['title'] . "&nbsp;&nbsp;";
	}
	if ('' !== $htmls) {
		echo $htmls;
	} else {
		echo('未能查询到' . $departure . '～' . $arrived . '的景点信息！');
	}
	exit ;
} elseif ('getsearcharea' == $q) {
	$s1 = $_GET['s1'];
	$iname = $_GET['iname'];
	$query = $db -> query("select * from cg_area where title like '%{$s1}%' limit 10 ");
	$htmls = "";
	while ($info = $db -> fetch_array($query)) {
		$htmls .= "<input type='radio' name='$iname' value='{$info['id']}'>" . $info['title'] . "&nbsp;&nbsp;";
	}
	echo $htmls;
	exit ;
} elseif ('getcmin' == $q) {
	$cmin = $_GET['cmin'];
	$cselected = $_GET['cselected'];
	$keyname = $_GET['keyname'];
	if ('2' == $cselected) {
		$query = $db -> query("select id,title from cg_cost_tra_ship where title like '%{$keyname}%' limit 10 ");
	} else {
		$query = $db -> query("select id,title from cg_area where title like '%{$keyname}%' limit 10 ");
	}
	$htmls = "";
	while ($info = $db -> fetch_array($query)) {
		$htmls .= "<input type='checkbox' name='cminarr[]' value='{$info['id']}'>" . $info['title'] . "&nbsp;&nbsp;";
	}
	echo $htmls;
	exit ;
} elseif ('gethtml' == $q) {
	$id = $_GET['id'];
	$html = $_GET['html'];
	$htmls = check_html($html, $id);
	$data = array();
	if ($htmls == $html) {
		$data['status'] = 0;
		$data['html'] = $htmls;
	} else {
		$data['status'] = 1;
		$data['html'] = check_html('', $id);
	}
	echo json_encode($data);
} elseif ('getsearchhtml' == $q) {
	$ckey = $_GET['ckey'];
	$ckeys = $_GET['ckeys'];
	$htmls = check_search_html($ckey);
	$data = array();
	if ($htmls != $ckeys) {
		$data['html'] = $htmls;
	} else {
		$data['html'] = check_search_html();
	}
	echo json_encode($data);
} elseif ('gethot' == $q) {
	$classtype = $_GET['classtype'];
	$pid = intval($_GET['pid']);
	$id = intval($_GET['id']);
	if ($pid) {
		$sqlwhere = ' and pid=' . $pid;
	}
	$hots = $_GET['hots'];
	if (empty($hots) || empty($id)) {
		$hots = $db -> result($db -> query("select max(hots)+1 from cg_class where classtype=$classtype $sqlwhere"), 0);
	}
	if (empty($hots)) {
		$hots = 0;
	}
	echo json_encode(array('hots' => $hots));
} elseif ('getarea' == $q) {
	$classid = $_GET['classid'];
	$types = $_GET['types'];
	$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
	$sql = " and pid=$pid";

	$types = (empty($types)) ? 0 : 1;
	$query = $db -> query("select * from cg_area where classid=$classid $sql order by region");
	while ($info = $db -> fetch_array($query)) {
		$resu[$info['id']] = strtoupper(getFirstCharter($info['title'])) . $info['title'];
	}
	echo json_encode($resu);
} elseif ('getclass' == $q) {
	$pid = $_GET['pid'];
	$query = $db -> query("select * from cg_class where pid=$pid  $sql order by hots");
	while ($info = $db -> fetch_array($query)) {
		$resu[$info['id']] = $info['title'];
	}
	echo json_encode($resu);
} elseif ('checkusername' == $q) {
	$username = postget('username');
	if (!ctype_alnum($username)) {
		echo json_encode(array('status' => 1, 'desc' => '用户名需由数字或字母组成'));
		exit ;
	}
	$membernum = $db -> result($db -> query(" select count(*) from cg_user where username = '$username'"), 0);
	if ($membernum) {
		echo json_encode(array('status' => 1, 'desc' => '用户名已存在'));
		exit ;
	} else {
		echo json_encode(array('status' => 0));
		exit ;
	}
} elseif ('city2' == $q) {
	$city2 = postget('city2');
	$types = postget('types');
	//h:0,s:3
	if (0 == $types) {

		if (strpos($city2, '|') > -1) {
			$arc = explode('|', $city2);
			$city2 = end($arc);
		}
		$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '" . $city2 . "')>0
																																		 $sql order by cg_scenic.hots";
		$query = $db -> query($sqlstr);
		$data = $resu = array();
		while ($data = $db -> fetch_array($query)) {
			$resu[$data['id']] = $data['title'];
		}
	} else {
		if (strpos($city2, '|') > -1) {
			$arc = explode('|', $city2);
			$resu = array();
			foreach ($arc as $key => $val) {
				$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '" . $val . "')>0 
																																																																			$sql order by cg_scenic.hots";
				$query = $db -> query($sqlstr);
				$data = $res = array();
				while ($data = $db -> fetch_array($query)) {
					$res[$data['id']] = $data['title'];
				}
				$resu[$val] = $res;
			}
			/*
			 $sqlstr = "Select cg_area.title as city,cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '".$city2."')>0 			$sql";
			 $query = $db->query($sqlstr);
			 $data = $resu = $res = array ();
			 $cache = "";
			 $s = 0;
			 while($data = $db->fetch_array($query)){
			 if($cache=="") $cache = $data['city'];
			 if($cache!=$data['city']){
			 $resu[$cache] = $res;
			 $cache = $data['city'];$res = array ();
			 }
			 $res[$data['id']] = $data['title'];
			 }
			 $resu[$cache] = $res;*/
		} else {
			$sqlstr = "Select cg_scenic.id,cg_scenic.title from cg_scenic Left JOIN cg_area ON (cg_scenic.aid = cg_area.id or cg_scenic.city = cg_area.id) where cg_scenic.types=$types and locate(cg_area.title, '" . $city2 . "')>0 
																																																			$sql order by cg_scenic.hots";
			$query = $db -> query($sqlstr);
			$data = $resu = $res = array();
			while ($data = $db -> fetch_array($query)) {
				$res[$data['id']] = $data['title'];
			}
			$resu[$city2] = $res;

		}
	}
	echo json_encode($resu);
} elseif ('getvisa' == $q) {
	$aid = postget('aid');
	$types = $_GET['types'];
	$query = $db -> query("select * from cg_scenic where types=$types and aid=$aid");
	$resu[0] = '无';
	while ($info = $db -> fetch_array($query)) {
		$resu[$info['id']] = $info['title'];
	}
	echo json_encode($resu);
} elseif ('getsale' == $q) {
	$urls = array(1 => '/tours/', 2 => '/visa/', 3 => '/detail/', 5 => '/read/');
	$keyword = postget('keys');
	$types = $_GET['ctype'];
	if (1 != $types) {
		$query = $db -> query("select id,title,price2 from cg_scenic where types=$types and locate('" . $keyword . "',title) and locate('1',op_type)");
	} else {
		$query = $db -> query("select id,title,go_time,price2 from cg_product_route where locate('" . $keyword . "',title) and locate('1',op_type)");
	}
	while ($info = $db -> fetch_array($query)) {
		$info['url'] = $urls[$types] . '' . $info["id"];
		$res[] = $info;
	}
	echo json_encode($res);

} elseif ('instroke' == $q) {
	$id = postget('id');
	$oldid = postget('oldid');
	$types = postget('types');
	$sql = "insert into {$table}_stroke(num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips) select num,departure,timd,arrived,tima,traffic,tname,eats,hotel,url,scenic,content,tips from {$table}_stroke where routeid=" . $oldid;
	$res = $db -> query($sql);
	//copy stroke
	$db -> query("update {$table}_stroke set routeid={$id}, userid={$_SESSION['id']}, op_user='{$_SESSION['username']}' where routeid=0");
	echo json_encode($res);
} else {
}
