<?php
 /**
  * @Copyright 2008 be-member Inc
  * 配置文件
  *
  * Creater: WuSongBo
  * Date: 2008-9-10
  */

if(!defined('E_ENG')){
	die('This is not a valid link ');
}
//--------------- 数据库设置 ------------------------------
$dbhost = 'localhost';
$dbuser = 'root';
$dbpw = 'mysql*()';
$dbname = 'jinqiao';
$dbcharset = 'utf8';
//数据库持久连接 0=关闭, 1=打开
$pconnect = 0;
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
//--------------- 网站信息 ------------------------------
//图片服务器地址
$picserver = 'http://';
//$picserver = 'http://localhost:8889/pic';
//网站名称
$sitename='旅游网站';
//$sectionid_pex
$prefix='cg_';
$uploaddir = '/';
?>