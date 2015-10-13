<?php

/*********************************************************
 函数功能：写文件
 参    数：filename>>文件名
 writetext>>要写入文件的内容字符串
 filemode>>文件的内容格式,默认是文本格式
 openmod>>打开文件的方式
 exit>>如果写文件失败,是否显示报错信息,默认是显示
 **********************************************************/
function writefile($filename, $writetext, $filemod = 'text', $openmod = 'w', $exit = 1) {
	if (!@ $fp = fopen($filename, $openmod)) {
		if ($exit) {
			exit ('File :<br>' . vrealpath($filename) . '<br>Have no access to write!');
		} else {
			return false;
		}
	} else {
		$text = '';
		if ($filemod == 'php') {
			$text = "<?php\r\n";
		}
		$text .= $writetext;
		if ($filemod == 'php') {
			$text .= "\r\n\r\n?>";
		}
		flock($fp, 2);
		fwrite($fp, $text);
		fclose($fp);
		return true;
	}
}

/**********************
 函数功能:格式化路径
 参    数:path>>文件路径
 ***********************/
function vrealpath($path) {
	$path = str_replace('./', '', $path);
	if (DIRECTORY_SEPARATOR == '\\') {
		$path = str_replace('/', '\\', $path);
	}
	elseif (DIRECTORY_SEPARATOR == '/') {
		$path = str_replace('\\', '/', $path);
	}
	return $path;
}

/*********************************
 函数功能: 截取md5加密字串
 参    数: str>>需要md5加密的字符串
 **********************************/
function vmd5($str) {
	return substr(md5($str), 8, 16);
}

/**************************************
 函数功能: 把内容的空格替换为半角字符
 后再把回车替换为换行
 参    数: message>>需要替换的内容字符串
 ***************************************/
function vnl2br($message) {
	return nl2br(str_replace(array (
		"\t",
		'   ',
		'  '
	), array (
		'&nbsp; &nbsp; &nbsp; &nbsp; ',
		'&nbsp; &nbsp;',
		'&nbsp;&nbsp;'
	), $message));
}
/**************************************
 函数功能: 全角转半角
 参    数: message>>需要替换的内容字符串
 ***************************************/
function vq2b($message) {
	//TODO
	return $message;
}
/**************************************
 函数功能：字符串截取
 参    数：string>>源字串
 length>>截取长度
 havedot>>截取后的字符串末
 尾是否需要...显示,默认不需要
 **************************************/
function cutstr($string, $length, $havedot = 0) {
	global $charset;

	//判断长度
	if (strlen($string) <= $length) {
		return $string;
	}

	$wordscut = '';
	//配置文件config.php里的变量charset
	if (strtolower($charset == 'utf-8')) {
		//utf8编码
		$n = 0;
		$tn = 0;
		$noc = 0;
		while ($n < strlen($string)) {
			$t = ord($string[$n]);
			if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1;
				$n++;
				$noc++;
			}
			elseif (194 <= $t && $t <= 223) {
				$tn = 2;
				$n += 2;
				$noc += 2;
			}
			elseif (224 <= $t && $t < 239) {
				$tn = 3;
				$n += 3;
				$noc += 2;
			}
			elseif (240 <= $t && $t <= 247) {
				$tn = 4;
				$n += 4;
				$noc += 2;
			}
			elseif (248 <= $t && $t <= 251) {
				$tn = 5;
				$n += 5;
				$noc += 2;
			}
			elseif ($t == 252 || $t == 253) {
				$tn = 6;
				$n += 6;
				$noc += 2;
			} else {
				$n++;
			}
			if ($noc >= $length) {
				break;
			}
		}
		if ($noc > $length) {
			$n -= $tn;
		}
		$wordscut = substr($string, 0, $n);
	} else {
		for ($i = 0; $i < $length -3; $i++) {
			if (ord($string[$i]) > 127) {
				$wordscut .= $string[$i] . $string[$i +1];
				$i++;
			} else {
				$wordscut .= $string[$i];
			}
		}
	}
	//省略号
	if ($havedot) {
		return $wordscut . '...';
	} else {
		return $wordscut . '.';
	}
}
function cutChineseStr($string, $sublen, $enddot, $start = 0, $code = 'UTF-8') {
	if ($code == 'UTF-8') {
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $string, $t_string);
		if (count($t_string[0]) - $start > $sublen)
			return join('', array_slice($t_string[0], $start, $sublen)) . $enddot;
		return join('', array_slice($t_string[0], $start, $sublen));
	} else {
		$start = $start * 2;
		$sublen = $sublen * 2;
		$strlen = strlen($string);
		$tmpstr = '';
		for ($i = 0; $i < $strlen; $i++) {
			if ($i >= $start && $i < ($start + $sublen)) {
				if (ord(substr($string, $i, 1)) > 129)
					$tmpstr .= substr($string, $i, 2);
				else
					$tmpstr .= substr($string, $i, 1);
			}
			if (ord(substr($string, $i, 1)) > 129)
				$i++;
		}
		if (strlen($tmpstr) < $strlen)
			$tmpstr .= "...";
		return $tmpstr;
	}
}
/**
 * 截取UTF-8字符
 * 汉字,大写字母,全角标点等长度为1
 * 阿拉伯数字,半角标点 等长度为0.5
 * $sourceStr长度小于$cutLen时,返回$sourceStr,否则进行截取
 * @author XuehuiHe
 * @param $sourceStr
 * @param $cutLen   要截取的长度
 * @param $endStr	
 * @return 
 */
function cut_utf8($sourceStr, $cutLen, $endStr = '..') {
	$sourceStrLen = strlen_utf8($sourceStr);
	if ($sourceStrLen <= $cutLen) {
		return $sourceStr;
	} else {
		$cutLen -= strlen_utf8($endStr);
	}
	$returnStr = '';
	$i = 0;
	$sourceBytes = strlen($sourceStr);
	$tmpCutLen = 0;
	while ($tmpCutLen <> $cutLen) {
		$tmpCutLen = $cutLen;
		$ascFirst = ord(substr($sourceStr, $i, 1));
		if ($ascFirst >= 224 && $cutLen >= 1) { //3个字节
			$returnStr .= substr($sourceStr, $i, 3);
			$i += 3;
			$cutLen -= 1;
		}
		elseif ($ascFirst >= 192 && $cutLen >= 1) { //2个字节
			$returnStr .= substr($sourceStr, $i, 2);
			$i += 2;
			$cutLen -= 1;
		}
		elseif ($ascFirst >= 65 && $ascFirst <= 90 && $cutLen >= 1) { //大写字母,一个字节
			$returnStr .= substr($sourceStr, $i, 1);
			$i += 1;
			$cutLen -= 1;
		}
		elseif ($ascFirst <= 127 && $cutLen >= 0.5) { //其他半个字符长度,一个字节
			$returnStr .= substr($sourceStr, $i, 1);
			$i += 1;
			$cutLen -= 0.5;
		}
	}
	return $returnStr . $endStr;
}
/**
 * 获得utf8编码的字符长度
 * 汉字,大写字母,全角标点等长度为1
 * 阿拉伯数字,半角标点 等长度为0.5
 * @author XuehuiHe
 * @param $str
 * @return 字符长度
 */
function strlen_utf8($str) {
	$i = 0;
	$tempLen = 0;
	$sourceBytes = strlen($str);
	while ($i < $sourceBytes) {
		$ascFirst = ord(substr($str, $i, 1));
		if ($ascFirst >= 224) { //3个字节
			$returnStr .= substr($str, $i, 3);
			$i += 3;
			$tempLen++;
		}
		elseif ($ascFirst >= 192) { //2个字节
			$returnStr .= substr($str, $i, 2);
			$i += 2;
			$tempLen++;
		}
		elseif ($ascFirst >= 65 && $ascFirst <= 90) { //大写字母,一个字节
			$returnStr .= substr($str, $i, 1);
			$i += 1;
			$tempLen++;
		} else { //其他半个字符长度,一个字节
			$returnStr .= substr($str, $i, 1);
			$i += 1;
			$tempLen += 0.5;
		}
	}
	return $tempLen;
}

/*************************************
 函数功能：替换字符串中的特殊字符
 去掉指定字符串中\\或\'前的\
 参    数：string>>字符串或数组
 **************************************/
function vstripslashes($string) {

	if (is_array($string)) {
		foreach ($string as $key => $val) {
			$string[$key] = vstripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}

/***********************************
 函数功能：处理字符串,把指定字符转
 变为实体字符.
 参    数: string>>字符串或字符串数组
 ************************************/
function vhtmlspecialchars($string) {
	if (is_array($string)) {
		foreach ($string as $key => $val) {
			$string[$key] = vhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1', str_replace(array (
			'&',
			'"',
			'<',
			'>'
		), array (
			'&amp;',
			'&quot;',
			'&lt;',
			'&gt;'
		), $string));
	}
	return $string;
}

/*************************
 函数功能：url跳转
 参    数：url>>要跳转到的
 url地址.
 *************************/
function vheader($url) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $url");
	exit ();
}

/**************************
 函数功能：获取文件名后缀
 参    数：filename>>文件名
 **************************/
function fileext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1)));
}

/***************************
 函数功能：获得内容里的图片
 参    数：message>>内容信息
 ***************************/
function getmessagepic($message) {
	$pic = '';
	preg_match("/src\=[\"\']*([^\>\s]{25,105})\.(jpg|gif|png)/i", $message, $mathes);
	if (!empty ($mathes[1]) || !empty ($mathes[2])) {
		$pic = "{$mathes[1]}.{$mathes[2]}";
	}
	return $pic;
}

/******************************
 函数功能：检查邮件格式是否正确
 参    数：email>>E-mail地址
 ******************************/
function isemail($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function i_isEmail($email) ///判断是否email
{
	if (ereg("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
		return 1;
	} else {
		return 0;
	}
}

/************************************
 函数功能：把数组的键值对转变为字符串,
 以'/'字符连接.
 参    数：array>>要被转变的数组
 dot>>连接字符,默认是'/'
 ************************************/
function arraytostring($array, $dot = '/') {
	$result = $comma = '';
	foreach ($array as $key => $value) {
		$value = trim($value);
		if ($value != '') {
			$result .= $comma . $key . $dot . rawurlencode($value);
			$comma = $dot;
		}
	}
	return $result;
}

/************************************
 函数功能：将数组加上单引号,并整理成串
 参    数：varr>>要被整理的数组
 comma>>连接字符,默认是','
 ************************************/
function vimplode($varr, $comma = ',') {
	return '\'' . implode('\'' . $comma . '\'', $varr) . '\'';
}

/********************************
 函数功能：用post,get方法获得参数
 参    数：var>>要获得的参数值
 ********************************/
function postget($var) {
	$value = '';
	if (isset ($_POST[$var])) {
		$value = $_POST[$var];
	}
	elseif (isset ($_GET[$var])) {
		$value = $_GET[$var];
	}
	return $value;
}

function replaceSeps($str) {
	if (!empty ($str)) {
		$firstStr = substr($str, 0, 1);
		if ($firstStr == "/" || $firstStr == "\\") {
			return $str;
		} else
			return $str = "/" . $str;
		;
	} else {
		return "";
	}
}
/*********************************
 函数功能：屏蔽内容中的危险htm代码
 参    数：html>>要被屏蔽的内容
 *********************************/
function checkhtml($html) {
	$html = preg_replace("/(\<|\s+)o([a-z]+\s?=)/is", "\\1\\2", $html);
	$html = preg_replace("/(script|frame|form|meta|behavior|style)([\s|:|>])+/i", "\\1.\\2", $html);
	return $html;
}

/***************************
 函数功能：获取链接的域名信息
 参    数：url>>url地址
 ***************************/
function getdomain($url) {
	$urlarr = parse_url($url);
	$domain = empty ($urlarr['host']) ? '' : $urlarr['host'];
	return $domain;
}

/***************************
 函数功能：生成目录
 参    数：dirname>>目录名称
 ismkindex>>是否创建
 静态文件,默认创建
 ***************************/
function vmkdir($dirname, $ismkindex = 1) {
	$mkdir = false;
	if (!is_dir($dirname)) {
		if (@ mkdir($dirname, 0777)) {
			//	if($ismkindex) {
			//		@fclose(@fopen($dirname.'/index.htm', 'w'));
			//	}
			$mkdir = true;
		}
	} else {
		$mkdir = true;
	}
	return $mkdir;
}

/*************************
 函数功能：获得文件的文件名
 参    数：filename>>文件
 *************************/
function filemain($filename) {
	return trim(substr($filename, 0, strrpos($filename, '.')));
}

/*************************
 函数功能：写日志文件
 参    数：file>>
 log>>
 *************************/
function writelog($file, $log) {
	global $timestamp, $_DCACHE;
	$yearmonth = gmdate('Ym', $timestamp + $_DCACHE['settings']['timeoffset'] * 3600);
	$logdir = V_ROOT . './logs/';
	$logfile = $logdir . $yearmonth . '_' . $file . '.php';
	if (@ filesize($logfile) > 2048000) {
		$dir = opendir($logdir);
		$length = strlen($file);
		$maxid = $id = 0;
		while ($entry = readdir($dir)) {
			if (strexists($entry, $yearmonth . '_' . $file)) {
				$id = intval(substr($entry, $length +8, -4));
				$id > $maxid && $maxid = $id;
			}
		}
		closedir($dir);

		$logfilebak = $logdir . $yearmonth . '_' . $file . '_' . ($maxid +1) . '.php';
		@ rename($logfile, $logfilebak);
	}
	if ($fp = @ fopen($logfile, 'a')) {
		@ flock($fp, 2);
		$log = is_array($log) ? $log : array (
			$log
		);
		foreach ($log as $tmp) {
			fwrite($fp, "<?PHP exit;?>\t" . str_replace(array (
				'<?',
				'?>'
			), '', $tmp) . "\n");
		}
		fclose($fp);
	}
}

/*************************
 函数功能：获得IP

 *************************/
function get_real_ip() {
	$ip = false;
	if (!empty ($_SERVER["HTTP_CLIENT_IP"])) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty ($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) {
			array_unshift($ips, $ip);
			$ip = FALSE;
		}
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

/*
 函数功能：返回指定日期的秒数
 参    数: days>>距离指定时间的天数
 method>>操作方式加或减
 time>>指定时间,默认当前时间
 可以是时间秒数也可以是
 日期时间形式
 author:  zhuxiangzhen
 */
function changetime($days, $method = '+', $time = "time()") {
	$seconds = (!is_int($days) || $days < 0) ? 0 : $days * 86400;
	switch (trim($method)) {
		case '+' :
			$time = is_numeric($time) ? $time : strtotime($time);
			return $time + $seconds;
			break;
		case '-' :
			$time = is_numeric($time) ? $time : strtotime($time);
			return $time - $seconds;
			break;
	}

}
/*
 函数功能:分割字符串,字符串类型 5:演员1 | 6:演员2 | 7：演员3
 返回一维数组
 参    数:要被分割的字符串
 author  :fanbo
 */
function splitstr($str, $sign = '|') {
	$tmp = explode($sign, $str);
	foreach ($tmp as $key => $value) {
		$tmp1[] = explode(':', $value);
		$returnarr[$tmp1[$key][0]] = $tmp1[$key][1];
	}
	return $returnarr;

}

/*
 函数功能:分割字符串,字符串类型 5:演员1 | 6:演员2 | 7：演员3
 返回二维数组
 参    数:要被分割的字符串
 author  :zhuxiangzhen
 */
function othersplitstr($str, $sign = '|') {
	$firstsplitarr = explode($sign, $str);
	foreach ($firstsplitarr as $value) {
		$value = trim($value);
		$totallen = strlen($value);
		$sublen = strlen(strstr($value, ':'));
		$substr = substr($value, - ($sublen -1));
		$subkey = intval(substr($value, 0, $totallen - $sublen));
		$returnarr[] = array (
			$subkey => $substr
		);
	}
	return $returnarr;
}

/*
 函数功能：返回以前选择过的checkbox
 参    数: totalitemarr>>所有供选择的checkbox
 checkedarr>>以前已选择过的checkbox
 checkarrname>>生成的checkbox复选框
 名称
 author : zhuxiangzhen
 */
function checkitem($totalitemarr, $checkedarr, $checkarrname) {
	if (empty ($totalitemarr) || empty ($checkarrname) || !is_array($totalitemarr) || !is_string($checkarrname))
		return false;

	foreach ($totalitemarr as $value) {
		$checked = in_array($value, $checkedarr) ? 'checked' : '';
		$returnstr .= '<b><input name="' . $checkarrname . '[]" type="checkbox" value="' . $value . '" ' . $checked . ' />' . $value . '</b>';
	}
	return $returnstr;
}

/*
 函数功能：判断一个数组是否是另一个数组的子集
 参	  数: subarr>>子集数组
 arr>>子集的父数组
 返 回 值：如果subarr是arr的子集返回真,否则返回假
 author:   zhuxiangzhen
 */
function arraysubclass($subarr, $arr) {
	if (!is_array($subarr) || !is_array($arr) || empty ($subarr) || empty ($arr)) {
		return false;
	}
	foreach ($subarr as $value) {
		if (!in_array($value, $arr)) {
			return false;
			break;
		} else {
			return true;
			break;
		}
	}
}
/*
 函数功能：在不知HTTP请求是POST还是GET方式时，此方法先按POST方式处理，如果为空再按GET方式处理，以确保传递的变量值，
 已知提交方式时，不建议使用此方法
 参	  数: $param>>传递的变量
 返 回 值：string
 author:   joe
 */
function _POST_GET($param) {
	$temValue = '';
	$temValue = $_POST[$param];
	if (empty ($temValue) || $temValue == '') {
		$temValue = $_GET[$param];
		if (empty ($temValue)) {
			return $temValue;
		}
		return $temValue;
	} else
		return $temValue;
}

/*
 * author:joe
 * 获得最小和最大值之间随机数，位数不足补零
 */
function getRandNumber($fMin, $fMax) {
	srand((double) microtime() * 1000000);
	$fLen = "%0" . strlen($fMax) . "d";
	Return sprintf($fLen, rand($fMin, $fMax));
}
/*
 * author:joe
 * 获得流水号
 */
function getFlowNum() {
	return date('YmdHms', time()) . getRandNumber(100000, 999999);
}
/*
 *函数功能: 获得给定时间截的当天的开始时间截和结束时间截
 *author :  zhuxiangzhen
 */
function gettodayverge($time) {
	$todaytime = localtime($time, 1);
	$startoffset = $todaytime['tm_hour'] * 3600 + $todaytime['tm_min'] * 60 + $todaytime['tm_sec'];

	$todaystarttime = $time - $startoffset;
	$todayendtime = $time + (86400 - $startoffset);

	$todaytime = array (
		'starttime' => $todaystarttime,
		'endtime' => $todayendtime
	);
	return $todaytime;
}
/*
 * author:hexuehui
 *
 * 获得时间差
 */
function getSubtractTime($lastTime) {
	$now = time();
	$dis = $now - $lastTime;
	$disDays = floor($dis / (24 * 60 * 60));
	if ($disDays < 1) {
		$disHour = floor($dis / 3600);
		$disMin = floor(($dis -3600 * $disHour) / 60);
		$disSec = $dis -3600 * $disHour - $disMin * 60;
		if ($disHour < 10) {
			$disHour = '0' . $disHour;
		}
		if ($disMin < 10) {
			$disMin = '0' . $disMin;
		}
		if ($disSec < 10) {
			$disSec = '0' . $disSec;
		}
		return "$disHour:$disMin:{$disSec}前";
	}
	elseif ($disDays < 7) {
		return $disDays . '天前';
	} else {
		return '一星期前';
	}
}

/*过滤不健康的字*/
function replace_bad_word($str, $new) {
	return $str;
}
/*过滤二维数组中的html代码*/
function replace_array_word($arr) {
	if (is_array($arr)) {
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][intro] = strip_tags($arr[$i]['intro']);
		}
	}
	return $arr;
}
//字符串替换，只替换一次
function str_replace_once($needle, $replace, $haystack) {
	// Looks for the first occurence of $needle in $haystack
	// and replaces it with $replace.
	$pos = strpos($haystack, $needle);
	if ($pos === false) {
		// Nothing found
		return $haystack;
	}
	return substr_replace($haystack, $replace, $pos, strlen($needle));
}
?>