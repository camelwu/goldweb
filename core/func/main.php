<?php
/**
 * @Copyright 2008 be-member Inc
 * 网站前端展示函数
 *
 * Creater: Wusongbo
 * Date: 2008-9-10
 */
//开始session
function startSession() {
	session_start();
}
//清除session
function destroySession() {
	session_destroy();
}
//cookie存储 $history 0 临时 1 永久
function save_cookie($name, $value, $history = 0) {
	if (empty ($history)) {
		setcookie($name, $value, 0, '/');
	} else {
		setcookie($name, $value, time() + 3600 * 24 * 30, '/');
	}
}
//清理cookie
function destroy_cookie() {
	foreach ($_COOKIE as $key => $value) {
		setcookie($key, '', time() - 3600 * 24, '/');
	}
}
//随机UID获取
function getHiddenUIDfromCookie() {
	//第一次浏览随机一个用户ID 注册后此ID绑定用户
	if (!isset ($_COOKIE['uh_token'])) {
		SetCookie('uh_token', time(), time() + 3600 * 24 * 360, "/");
	}
	return $_COOKIE['uh_token'];
}
//设置页面缓存时间
function startHttpCacheHeader($s = 1800) {
	global $timestamp;
	//TODO
	return;
	header('Cache-Control: max-age=' . $s); //默认缓存半小时
	header('Expires: ' . gmdate('D, M d Y H:i:s', $timestamp + $s) . ' GMT'); //指定过期时间
	header('Last-Modified: ' . gmdate('D, M d Y H:i:s', $timestamp) . ' GMT');
}
//启动smarty
function startSmarty($iscached = true) {
	global $config, $smarty, $siteurl, $source_path, $picserver, $uploadir, $ktitle, $kname, $keywords, $description;

	if (empty ($smarty)) {
		include_once (BASEPATH . '/libraries/Smarty/Smarty.class.php');
		$smarty = new Smarty;
		$smarty->template_dir = V_ROOT;
		mkdirs(V_ROOT . '/data/smarty_config');
		$smarty->config_dir = V_ROOT . '/data/smarty_config';
		mkdirs(V_ROOT . '/data/smarty_cache');
		$smarty->cache_dir = V_ROOT . '/data/smarty_cache/';
		mkdirs(V_ROOT . '/data/smarty_compile');
		$smarty->compile_dir = V_ROOT . '/data/smarty_compile';
		$smarty->left_delimiter = '<{';
		$smarty->right_delimiter = '}>';
		//模板赋值：当前引用地址
		$smarty->assign('referurl', strtolower($_SERVER["HTTP_REFERER"]));
		//模板赋值：网站当前网址
		$smarty->assign('siteurl', $config['resources_url']);
		//模板赋值：网站title
		$smarty->assign('ktitle', $ktitle);
		//模板赋值：网站名称
		$smarty->assign('kname', $kname);
		//模板赋值：网站keywords
		$smarty->assign('keywords', $keywords);
		//模板赋值：网站description
		$smarty->assign('description', $description);
		//模板赋值：图片服务器
		$smarty->assign('picserver', $picserver);
		//用户身份
		$smarty->assign('uid', $_COOKIE['uid']);
		$smarty->assign('username', $_COOKIE['username']);
		//是否缓存
		if ($iscached) {
			$smarty->caching=1;
		}
	}
}
//建立数据库连接
function dbconnect() {
	global $db, $DB;
	if (empty ($db)) {
		include_once (BASEPATH . '/libraries/database/ConnectMysqli.php');
		$db = ConnectMysqli::getIntance($DB['default']);
	}
}
/*
 *函数功能：生成分页URL地址集合
 *@param	num>>记录总数
			perpage>>每页记录数
			curpage>>当前记页数
			mpurl>>URL参数集合
			maxpages>>
 */
function multi($num, $perpage, $curpage, $mpurl, $view = '', $maxpages = 0, $page = 10, $autogoto = TRUE, $simple = FALSE) {
	global $maxpage;
	$ajaxtarget = !empty ($_GET['ajaxtarget']) ? " ajaxtarget=\"" . dhtmlspecialchars($_GET['ajaxtarget']) . "\" " : '';

	$multipage = '';
	//$mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
	$realpages = 1;
	if ($num > $perpage) {
		$offset = 2;

		$realpages = @ ceil($num / $perpage);
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if ($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page -1;
			if ($from < 1) {
				$to = $curpage +1 - $from;
				$from = 1;
				if ($to - $from < $page) {
					$to = $page;
				}
			}
			elseif ($to > $pages) {
				$from = $pages - $page +1;
				$to = $pages;
			}
		}

		$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="' . $mpurl . '_1.html">1</a>' : '') .
		 ($curpage > 1 && !$simple ? '<a href="' . $mpurl . '_' . ($curpage -1) . '.html" class="a1">上一页</a>' : '');
		for ($i = $from; $i <= $to; $i++) {
			$multipage .= $i == $curpage ? '<span>' . $i . '</span>' : '<a href="' .
			$mpurl . '_' . $i . '.html">' . $i . '</a>';
		}

		$multipage .= ($curpage < $pages && !$simple ? '<a href="' . $mpurl . '_' . ($curpage +1) . '.html" class="a1">下一页</a>' : '') .
		 ($to < $pages ? '<a href="' . $mpurl . '_' . $pages . '.html" class="a1">...' . $realpages . '</a>' : '');

		$multipage = $multipage ? '<div class="text_c"><a class="a1">' . $num . '条</a>' . $multipage . '</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}
/*数字型的分页*/
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
function pagecute($maxpage, $pagecount, $viewpage = 1, $pageurl, $pp = 6, $class) {
	$pagecute = "";
	if ($pagecount == 0) {
		$pagecute = "<li class=" . $class . ">1</li>";
	} else {
		$i = 1;
		$ppp = ceil($pp / 2);
		if (is_even($pp))
			$ppp = $ppp -1;
		$pl = $viewpage - $ppp;
		$pr = $pl + $pp -1;
		if ($pl < 1) {
			$pr = $pr - $pl +1;
			$pl = 1;
			if ($pr > $pagecount)
				$pr = $pagecount;
		}
		if ($pr > $pagecount) {
			$pl = $pl + $pagecount - $pr;
			$pr = $pagecount;
			if ($pl < 1)
				$pl = 1;
		}
		if ($pl > 1) {
			$pagecute .= "<li><a href='" . $pageurl . "' title='第一页'>|&lt;</a></li><li><a href='" . $pageurl . "/" . ($pl -1) . "' title='上一页'>&lt;</a></li>";
		}

		for ($i = $pl; $i <= $pr; $i++) {
			if ($viewpage == $i) {
				$pagecute .= "<li class=" . $class . ">" . $i . "</li>";
			} else {
				$pagecute .= "<a href='" . $pageurl . "/" . $i . "' title='第 " . $i . " 页'><li>" . $i . "</li></a>";
			}
		}
		if ($pr < $pagecount) {
			$pagecute .= "<li><a href='" . $pageurl . "/" . $i . "' title='后一页'>&gt;</a></li><li><a href='" . $pageurl . "/" . $pagecount . "' title='最后一页'>&gt;|</a></li>";
		}
	}
	return $pagecute;
}
/**
 * 初始化常量
 * */
function init_config() {
	global $db, $bid, $bidinfo, $picserver, $uploadir, $ktitle, $kname, $keywords, $description;
	$webconfig = $db->fetch_array($db->query('select * from cg_config'));
	$picserver = $webconfig['picserver']; //图片服务器
	$uploadir = $webconfig['uploadir']; //图片目录
	if (empty ($bidinfo)) {
		$ktitle = $webconfig['name'];
		$kname = $webconfig['title'];
		$keywords = $webconfig['keyes'];
		$description = $webconfig['contents'];
	} else {
		$ktitle = $bidinfo['ktitle'];
		$kname = $bidinfo['title'];
		$keywords = $bidinfo['keywords'];
		$description = $bidinfo['description'];
	}
}
?>
