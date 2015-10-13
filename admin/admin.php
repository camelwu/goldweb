<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旅行计调分销管理平台</title>
<?php
$action=isset($_GET['action'])?$_GET['action']:"";

switch ($action){
case "left":
	break;
case "main":
 	$arr=array();
	$ary=array();
	echo admin_main($arr,$ary);
	break;
case "top":
	echo admin_top();
	break;
default:
	echo admin_frame();
	break;
}
//右部文件
function admin_main($arr,$ary){
?>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script language=javascript>
function re_load() { location.reload(); }
</script>
</head>
<body>
<table cellspacing=1 cellpadding=4 class=table>
<tr><th colspan=2>网站统计信息</th></tr>
<tr>
<td width='20%'>网站基本信息：</td>
<td width='80%'><?php
foreach ($ary as $value)
{
  echo $value." ";
}
?>
</td>
</tr>
<tr>
<td>产品库存信息：</td>
<td><?php
foreach ($arr as $value)
{
  echo $value." ";
}
?></td>
</tr>
<tr class=tr3>
<td height=30>系统更新信息：</td>
<td>
  <table border=0 cellspacing=0 cellpadding=0 width='100%'>
  <tr class=tr3>
  <td><a href="http://www.be-member.com" target="_blank">系统升级信息</a></td>
  <td align=right><a class=read alt='正在开发'>相关说明</a>&nbsp;</td>
  </tr>
  </table>
</td>
</tr>
</table>

<table cellspacing=1 cellpadding=4 class=table>
  <tr><th colspan=2>服务器参数</th></tr>
  <tr><td width='20%'>服务器名：</td><td width='80%'>&nbsp;<?php echo $_SERVER["SERVER_NAME"]?></td></tr>
  <tr><td>服务器IP：</td><td>&nbsp;<?php echo $_SERVER["SERVER_ADDR"];?></td></tr>
  <tr><td>服务器端口：</td><td>&nbsp;<?php echo $_SERVER["SERVER_PORT"]?></td></tr>
  <tr><td>服务器时间：</td><td>&nbsp;<?php echo date("Y-m-d H:i:s");?></td></tr>
  <tr><td>服务器版本：</td><td>&nbsp;<?php echo $_SERVER["SERVER_SOFTWARE"];?></td></tr>
  <tr><td>脚本超时时间：</td><td>&nbsp;30 秒</td></tr>
  <tr><td>站点物理路径：</td><td>&nbsp;<?php echo $_SERVER["DOCUMENT_ROOT"]?></td></tr>
  <tr><td>管理员邮箱：</td><td>&nbsp;<?php echo $_SERVER["SERVER_ADMIN"];?></td></tr>
</table>

<table cellspacing=1 cellpadding=4 class=table>
<tr><th colspan=2>网站快捷管理操作</th></tr>
<tr>
<td>快捷管理链接：</td>
<td>
<!--
  <table border=0 cellspacing=0 cellpadding=2>
  <tr>
  <td><img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='admin_order.php'>订单管理</a></td>
  <td>&nbsp;<img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='admin_class.php'>分类管理</a></td>
  <td>&nbsp;<img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='admin_shop_stock.php'>库存管理</a></td>
  <td>&nbsp;<img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='admin_sql.php'>执行SQL</a></td>
  <td>&nbsp;<img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='config.php' class=red2>配置管理</a></td>
  <td>&nbsp;<img border=0 src='css/images/s_.gif' alt='' align=absmiddle>&nbsp;<a href='config_log.php?action=log'>管理日记</a></td>
  </tr>
  </table>
  -->
</td>
</tr>
</table>
</body>
<?php
}//右部文件

function admin_top(){
?>
<style type="text/css">
a:link { color:#FF3300;text-decoration:none}
a:hover {color:#FF3300;;text-decoration:underline;}
a:visited {color:#FF3300;text-decoration:underline;}

body {background-color: #d4d0c8; margin:0px;}
body,td,th {
	font-size: 12px;
	
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
<script type="text/JavaScript">
function preloadImg(src){
	var img=new Image();
	img.src=src
}
preloadImg("css/images/admin_open.gif");
//
var displayBar=true;
function switchBar(obj){
	if (displayBar){
		parent.frame.cols="0,*";
		displayBar=false;
		obj.src="css/images/admin_open.gif";
		obj.title="打开左边管理导航菜单";
	}else{
		parent.frame.cols="180,*";
		displayBar=true;
		obj.src="css/images/admin_close.gif";
		obj.title="关闭左边管理导航菜单";
	}
}
//
var today=new Date();

var d=Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
var today_y = (today.getYear() < 1900) ? (1900 + today.getYear()) : today.getYear();
var today_m = today.getMonth()+1;
var today_d = today.getDate();
//document.write("<font color=#FFFFFF>",today_year,"<font color=#FFFFFF>年","<font color=#FFFFFF>",today.getMonth()+1,"<font color=#FFFFFF>月","<font color=#FFFFFF>",today.getDate(),"<font color=#FFFFFF>日 </FONT>"); 
var today_day  = d[today.getDay()];
//alert(today_y+"年"+today_m+"月"+today_d+"日"+today_day);
//
function outclock(){
	var Digital=new Date();
	var hours=Digital.getHours();
	var minutes=Digital.getMinutes();
	var seconds=Digital.getSeconds();
	if(minutes<=9)
	minutes="0"+minutes;
	if(seconds<=9)
	seconds="0"+seconds;
	myclock=hours+":"+minutes+":"+seconds;
	document.getElementById("liveclock").innerHTML = today_y+"年"+today_m+"月"+today_d+"日 "+today_day+" "+myclock;
	setTimeout("outclock()",1000);
}
window.onload = function(){outclock();}
</script>
</head>
<body>
<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td width="40"><img onClick="switchBar(this)" src="css/images/admin_close.gif" title="关闭左边管理导航菜单" style="cursor:hand">
    </td>
    <td width="490">时间：<span id="liveclock">2015年1月7日 星期三 21:46:19</span></td>
    <td align="right"><a href="http://www.cgbt.net/" target="_blank">浏览网站</a> </td>
  </tr>
</tbody></table>
</body>
<?php
}
//全部文件
function admin_frame(){
	echo '</head>

<frameset rows="*" cols="185,*" framespacing="0" frameborder="1" border="false" id="frame" scrolling="yes">
  <frame name="leftFrame" id="leftFrame" scrolling="yes" marginwidth="0" marginheight="0" src="admin_left.php">
  <frameset framespacing="0" border="false" rows="35,*" frameborder="0" scrolling="yes">
    <frame name="topFrame" scrolling="no" src="admin.php?action=top">
    <frame name="right" scrolling="yes" src="admin.php?action=main">
  </frameset>
</frameset>
<noframes>
  <body margin="2">
  <p>本页采用框架技术，您的浏览器不支持框架！</p>
  </body>
</noframes>';

}//全部文件
?>
</html>