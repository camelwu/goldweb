<?php
require_once (ROOT_PATH . './includes/func_area2js.php');

/*根据op_type返回情况*/
function cg_optype($str = '') {
	global $op_types;
	$cg_optype = "";
	if($str===''){
		return '';
	}else{
		$arr = strpos($str,',')?explode(',',$str):$str;
		if(is_array($arr)){
			foreach($arr as $val){
				$cg_optype .= "<font color=red>[".$op_types[(int)$val]."]</font> ";
			}
			return $cg_optype;
		}else{
			return "<font color=red>[".$op_types[(int)$arr]."]</font>";
		}
		
	}
}
/**
 * 负责人
 * ***/
function cg_user($parentid = 0) {
	global $db;
	$sqlwhere = '';
	if (!empty ($parentid)) {
		$sqlwhere .= " where id=$parentid ";
	}
	$query = $db->query("select * from cg_user $sqlwhere  order by id ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['username'];
	}
	return $shop;
}
/*
 函数功能：一级分类数组
 参    数：$pid>>上级ID
 */
function cg_class($classtype = 0) {
	global $db;
	$sqlwhere = " and classtype=$classtype ";
	$query = $db->query("select * from cg_class where pid=0 $sqlwhere  order by hots ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}

/*
 函数功能：分类数组
 参    数：$pid>>上级ID
 */
function cg_eclass($classtype = 0) {
	global $db;
	$sqlwhere = " and classtype=$classtype and pid!=0";
	$query = $db->query("select * from cg_class where 1 $sqlwhere  order by hots ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}

/*
 函数功能：地区数组
 参    数：$pid>>上级ID
 */
function cg_area($classtype = 0) {
	global $db;
	$query = $db->query("select * from cg_area order by id ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}
/*
 函数功能：国家数组
 参    数：$pid>>上级ID
 */
function cg_stat($cid = 0) {
	global $db;
	$sqladd = $cid?'and classid='.$cid:'and classid!=65';
	$query = $db->query("select * from cg_area where pid=0 $sqladd order by id ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}
/*
 函数功能：地区数组
 参    数：$pid>>上级ID
 */
function cg_area_pid() {
	global $db;
	$query = $db->query("select * from cg_area where pid>0   order by region ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {

		$shop[$row['id']] = strtoupper(getFirstCharter($row['title'])) . $row['title'];
	}
	return $shop;
}

/*
 函数功能：地区数组
 参    数：$pid>>上级ID
 */
function cg_line_port($type = 0) {
	global $db;
	$query = $db->query("select * from cg_air where types=$type order by id ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}

/*
 函数功能：机构数组
 参    数：$pid>>上级ID
 */
function cg_branch($classtype = "") {
	global $db, $adminbid;
	$sqlwhere = ' where 1 ';
	if ($classtype == '0' || !empty ($classtype)) {
		$sqlwhere .= ' and types=' . $classtype;
	}
	if (!empty ($adminbid)) {
		$sqlwhere .= ' and id=' . $adminbid;

	}
	$query = $db->query("select * from cg_branch $sqlwhere  order by id ");
	$shop = array ();
	while ($row = $db->fetch_array($query)) {
		$shop[$row['id']] = $row['title'];
	}
	return $shop;
}
/*
 函数功能:验证分类静态化的唯一性
 @return $id为空时 返回唯一字符串 否则 返回 0 唯一 1 不唯一
 * */
function check_html($html = '', $id = 0) {
	global $db;
	$html = (empty ($html)) ? createRandomStr() : $html;
	$sql = "select * from cg_class where html='{$html}' limit 1";
	$info = $db->fetch_array($db->query($sql));
	if (empty ($id)) {
		if (empty ($info)) {
			return $html;
		} else {
			return check_html('', 0);
		}
	} else {
		if (empty ($info) || $info['id'] == $id) {
			return $html;
		} else {
			return check_html('', $id);
		}
	}
}

/*
 函数功能:验证分类静态化的唯一性
 @return $id为空时 返回唯一字符串 否则 返回 0 唯一 1 不唯一
 * */
function check_search_html($ckey = '') {
	global $db;
	$ckey = (empty ($ckey)) ? createRandomStr() : $ckey;
	$sql = "select * from cg_search where ckey='{$ckey}' limit 1";
	$info = $db->fetch_array($db->query($sql));
	if (empty ($info)) {
		return $ckey;
	} else {
		return check_search_html('');
	}
}

/*
 函数功能：记录操作日志
 参    数：remark>>日志表名后缀
 id>>数据ID
 $do>> insert 操作行为 0:update 1 :insert  2:delete
 */
function do_daily($remark, $id = 0, $do = 0, $config = '', $key = 0) {
	global $db, $Config;
	$title = DBFIX . $remark;
	$message = '修改了';
	if ($do == '1') {
		$message = '添加了';
	}
	elseif ($do == '2') {
		$message = '删除了';
	}
	elseif ($do == '3') {
		$message = '排序了';
	}
	if ('config' == $remark) {
		$message .= '网站配置';
	}
	elseif ('class' == $remark) {
		$message .= "1条分类数据,ID为：" . $id;
	}
	elseif ('search' == $remark) {
		$message .= "1条搜索数据,ID为：" . $id;
	}
	elseif ('area' == $remark) {
		$message .= "1条地域数据,ID为：" . $id;
	}
	elseif ('branch' == $remark) {
		$message .= "1条机构数据,ID为：" . $id;
	}
	elseif ('user' == $remark) {
		$message .= "1条人员数据,ID为：" . $id;
	}
	elseif ('air_line' == $remark) {
		$message .= "1条航空公司数据,ID为：" . $id;
	}
	elseif ('air_port' == $remark) {
		$message .= "1条机场数据,ID为：" . $id;
	}
	elseif ('cost_tra_car' == $remark) {
		$message .= "1条汽车数据,ID为：" . $id;
	}
	elseif ('cost_tra_ship' == $remark) {
		$message .= "1条轮船数据,ID为：" . $id;
	}
	elseif ('cost_tra_train' == $remark) {
		$message .= "1条火车数据,ID为：" . $id;
	}
	elseif ('cost_tra_plane' == $remark) {
		$message .= "1条机票数据,ID为：" . $id;
	}
	elseif ('guide' == $remark) {
		$message .= "1条" . $Config[$config][$key] . "数据,ID为：" . $id;
	}
	elseif ('line' == $remark) {
		$message .= "1条" . $Config[$config][$key] . "数据,ID为：" . $id;
	}
	elseif ('scenic' == $remark) {
		$message .= "1条" . $Config[$config][$key] . "数据,ID为：" . $id;
	}
	elseif ('hotel' == $remark) {
		$message .= "1条" . $Config[$config][$key] . "数据,ID为：" . $id;
	}
	$data = array (
		'title' => $title,
		'remark' => $message,
		'userid' => $_SESSION["id"],
		'name' => $_SESSION["username"],
		'ip' => real_ip(),
		'sys' => $_SERVER['HTTP_USER_AGENT']
	);
	$db->inserttable(DBFIX . "daily", $data);
}

/*
 函数功能：记录图片上传日志
 参    数：remark>>日志表名后缀
 id>>数据ID
 */
function do_attached($filepath, $filetype, $filesize = 0) {
	global $db;
	$data = array (
		'filepath' => $filepath,
		'ext' => $filetype,
		'sizes' => $filesize / 1024,
		'userid' => $_SESSION["id"],
		'name' => $_SESSION["username"]
	);
	$db->inserttable(DBFIX . "attached", $data);
}
/*
 函数功能：生成随机字符
 参    数：$length>>字符长度
 */
function createRandomStr($length = 4) {
	$str = array_merge(range('a', 'z'));
	shuffle($str);
	$str = implode('', array_slice($str, 0, $length));
	return $str;
}
/*
 函数功能：生成目录
 参    数：dirname>>目录名称
 ismkindex>>是否创建
 静态文件,默认创建
 */
function vmkdir($dirname, $ismkindex = 1) {
	$mkdir = false;
	if (!is_dir($dirname)) {
		if (@ mkdir($dirname, 0777)) {
			$mkdir = true;
		}
	} else {
		$mkdir = true;
	}
	return $mkdir;
}

/*
 函数功能：获取文件名后缀
 参    数：filename>>文件名
 */
function fileext($filename) {
	return strtolower(substr(strrchr($filename, '.'), 1));
}

/*
 * 函数功能：上传图片
 * 上传图片 $FilePath 
 * 相对路径 $FilePara post参数
 * **/

function UploadFile($FilePath, $FilePara, $types = 0) {
	global $uploadir;
	$pic1File = $_FILES[$FilePara]['name'];
	if (!empty ($pic1File)) {
		//创建目录
		vmitimkdir($uploadir . '/' . $FilePath);
		$file1name = "/$FilePath/" . time() . rand(1, 1000) . '.' . fileext($pic1File);
		move_uploaded_file($_FILES[$FilePara]['tmp_name'], $uploadir . $file1name);
		/**生成缩略图***/
		if ($types != '2') {
			get_spec_image($uploadir . $file1name, 360, 200, 0, "big");
			get_spec_image($uploadir . $file1name, 200, 200, 0, "small");
		}

		//记录上传日志
		do_attached($file1name, $_FILES[$FilePara]['type'], $_FILES[$FilePara]['size']);
	}

	return $file1name;
}

/**
* 遍历目录
* */
function showDir($filedir) {
	//打开目录  
	$dir = @ dir($filedir);
	//列出目录中的文件  
	while (($file = $dir->read()) !== false) {
		if (($file != ".") && ($file != "..")) {
			$icon[$file] = $file;
		}
	}
	$dir->close();
	return $icon;
}

//创建多级目录
function vmitimkdir($path) {
	if (!file_exists($path)) {
		vmitimkdir(dirname($path));

		mkdir($path, 0777);
	}
}
function xcopy($dir, $dir2) {
	$handle = opendir($dir);
	while (false != ($file = readdir($handle))) {
		if ($file != '.' && $file != '..') {
			if (is_file($dir . '/' . $file)) {
				copy($dir . '/' . $file, $dir2 . $file);
			} else {
				mkdir($dir2 . $file . "/", 0755);
				xcopy($dir . '/' . $file . "/", $dir2 . $file . "/");
			}
		}
	}
	closedir($handle);
}
function my_del_dir($directory) {
	if (is_dir($directory) == true) {
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false) {
			if ($file != "." && $file != "..") {
				is_dir("$directory/$file") ? my_del_dir("$directory/$file") : unlink("$directory/$file");
			}
		}
		if (readdir($handle) == false) {
			closedir($handle);
			rmdir($directory);
		}
	}

}
/****
 * 生成缩略图(缩略图保存原图片根目录下)
 * $img_path图片绝对地址
 * $width 图宽
 * $height 图高
 * //gen=0:保持比例缩放，不剪裁,如高为0，则保证宽度按比例缩放  gen=1：保证长宽，剪裁 
 * $priex 新图名称后缀默认 如123.jpg => 123_small.jpg
 * ***/
function get_spec_image($img_path, $width = 0, $height = 0, $gen = 0, $priex = "small") {
	global $uploadir;
	$priex = (empty ($priex)) ? "small" : $priex;
	if ($width == 0)
		$new_path = $img_path;
	else {
		$img_name = substr($img_path, 0, -4);
		$img_ext = substr($img_path, -3);

		$new_path = $img_name . "_" . $priex . "." . $img_ext;
		if (!file_exists($new_path)) {
			require_once ROOT_PATH . "./includes/imagecls.php";
			$imagec = new imagecls();
			$thumb = $imagec->thumb($img_path, $width, $height, $gen, true, $priex, true);
			$paths = pathinfo($new_path);
			$path = str_replace("./", "", $paths['dirname']);
			$filename = $paths['basename'];
			$pathwithoupublic = str_replace("public/", "", $path);
			$file_data = @ file_get_contents($path);
			$img = @ imagecreatefromstring($file_data);
			if ($img !== false) {
				$save_path = "public/" . $path;
				if (!is_dir($save_path)) {
					@ mk_dir($save_path);
				}
				@ file_put_contents($save_path, $file_data);
			}

		}
	}
	return $new_path;
}

function read_excel2007($excelfile) {
	header("content-Type: text/html; charset=UTF-8");
	require_once (ROOT_PATH . './includes/PHPExcel.php');
	require_once (ROOT_PATH . './includes/PHPExcel/Reader/Excel5.php');
	require_once (ROOT_PATH . './includes/PHPExcel/Reader/Excel2007.php');

	$PHPExcel = new PHPExcel();
	$PHPReader = new PHPExcel_Reader_Excel2007();
	$PHPExcel = $PHPReader->load($excelfile);
	$sheet = $PHPExcel->getActiveSheet();
	$allRow = PHPExcel_Cell :: columnIndexFromString($sheet->getHighestColumn());
	$allCol = $sheet->getHighestRow();
	$xlsresult = array ();
	for ($col = 1; $col <= $allCol; $col++) {
		$sheetvalue = $sheet->getCellByColumnAndRow(0, $col)->getValue();
		if (strpos($sheetvalue, "第") !== false) {
			$data = array ();
			for ($row = 0; $row < $allRow; $row++) {
				$value = $sheet->getCellByColumnAndRow($row, $col)->getValue();
				if ($row == 2) {
					$covalue = explode(" ", $value);
					$data['departure'] = $covalue[0];
					$data['timd'] = $covalue[1];
				}
				elseif ($row == 3) {
					$covalue = explode(" ", $value);
					$data['arrived'] = $covalue[0];
					$data['tima'] = $covalue[1];
				}
				elseif ($row == 4) {
					$covalue = explode(" ", $value);
					$data['traffic'] = $covalue[0];
					$data['tname'] = $covalue[1];
				}
				elseif ($row == 5) {
					$data['content'] = $value;
				}
				elseif ($row == 7) {
					$data['eats'] = $value;
				}
				elseif ($row == 8) {
					$data['hotel'] = $value;
				}
			}
			$xlsresult[] = $data;
		}
	}
	return $xlsresult;
}
?>
