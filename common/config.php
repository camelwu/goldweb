<?php
 /**
  * @Copyright 2008 union voole Inc 
  * 配置文件
  *
  * Creater: nemo
  * Date: 2008-9-10
  */
//--------------- 数据库设置 ------------------------------
if(!defined('E_ENG')){
	die('This is not a valid link ');
}
$dbhost = 'localhost';//60.31.214.235
//voolesite数据库用户名
$dbuser = 'root';
//voolesite数据库密码
$dbpw = 'mysql*()';
//voolesite数据库名
$dbname = 'jinqiao';//

//数据库持久连接 0=关闭, 1=打开
$pconnect = 0;
//数据库字符集
$dbcharset = 'utf8';
//--------------- COOKIE设置 ------------------------------
//cookie 作用路径
$cookiepath = '/';
//--------------- 字符集设置 ------------------------------
//强制设置字符集
$headercharset = 1;
//页面字符集(可选 'gbk', 'big5', 'utf-8')
$charset = 'utf-8';
//gzip压缩
$gzipcompress = 0;   //1压缩,0不压缩
//图片服务器地址
$picserver = 'http://www.jingdushishang.com:8089/pic';
//$picserver = 'http://localhost:8889/pic';

//网站名称
$sitename='京都时尚医疗美容医院';
//tid
$tid=1;
//$sectionid_pex
$section_pex='jdss_';

$uploaddir = 'D:/dev2/website/WebRoot/pic';
?>