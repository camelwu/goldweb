<?php /* Smarty version 2.6.20, created on 2015-07-22 15:21:02
         compiled from admins_main.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旅行计调分销管理平台</title>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
<script type="text/JavaScript">
function re_load() { location.reload(); }
</script>
</head>

<body>
<table cellspacing=1 cellpadding=4 class=table>
<tr><th colspan=2>统计信息</th></tr>
<tr>
<td width='20%'>用户数量：</td>
<td width='80%'><?php echo $this->_tpl_vars['usernum']; ?>
</td>
</tr>
<tr>
<td>发送数量：</td>
<td><?php echo $this->_tpl_vars['sendnum']; ?>
</td>
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
  <tr><td width='20%'>服务器名：</td><td width='80%'>&nbsp;<?php echo $this->_tpl_vars['SERVER_NAME']; ?>
</td></tr>
  <tr><td>服务器IP：</td><td>&nbsp;<?php echo $this->_tpl_vars['SERVER_ADDR']; ?>
</td></tr>
  <tr><td>服务器端口：</td><td>&nbsp;<?php echo $this->_tpl_vars['SERVER_PORT']; ?>
</td></tr>
  <tr><td>服务器时间：</td><td>&nbsp;<?php echo $this->_tpl_vars['times']; ?>
</td></tr>
  <tr><td>服务器版本：</td><td>&nbsp;<?php echo $this->_tpl_vars['SERVER_SOFTWARE']; ?>
</td></tr>
  <tr><td>脚本超时时间：</td><td>&nbsp;<?php echo $this->_tpl_vars['timeo']; ?>
</td></tr>
  <tr><td>站点物理路径：</td><td>&nbsp;<?php echo $this->_tpl_vars['DOCUMENT_ROOT']; ?>
</td></tr>
  <tr><td>系统默认邮箱：</td><td>&nbsp;<?php echo $this->_tpl_vars['SERVER_ADMIN']; ?>
</td></tr>
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
</html>