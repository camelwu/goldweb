<?php /* Smarty version 2.6.20, created on 2015-07-22 15:11:45
         compiled from admin_left.html */ ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旅行计调分销管理平台</title>
<base target=mainFrame>
<style type="text/css">
<!--
body {
	margin: 0;
	background-color: #d4d0c8;
}

body,p,td {
	font-family: Verdana, Arial, Helvetica, sans-serif, 宋体;
	font-size: 12px;
	color: #000000;
}

a {
	color: #000000;
	text-decoration: none;
}

a:hover {
	color: #ff3300;
	text-decoration: underline;
}

.menu_title {
	width: 158px;
	line-height: 25px;
	margin: 3px auto;
	background-color: #40afa6;
	border: 1px solid #ffffff;
	overflow-x: hidden;
}

.menu_title .tit {
	width: 156px;
	line-height: 25px;
	margin: 3px auto;
	color: #fff;
	cursor: hand;
	text-align: center;
	font-weight: bold;
}

.menu_title .welc {
	width: 158px;
	line-height: 25px;
	text-align: center;
	background: #e7e7e7;
}

.menu_title strong {
	margin-left: 36px;
	color: #fff;
	cursor: hand;
	text-align: center;
}

.menu_title ul {
	background: #e7e7e7;
	overflow: hidden;
	border: 0px 1px 1px #FFF solid;
	width: 158px;
	margin: 0px;
	padding: 6px 0px 3px 0px;
}

.menu_title ul li {
	list-style: none;
	line-height: 21px;
	height: 21px;
	padding-left: 10px;
}

.menu_title ul.top li {
	background: url(css/images/s_left.gif) no-repeat left 20px center;
	padding-left: 28px;
}

.myfont3 {
	FONT-SIZE: 12px;
	COLOR: #878787;
	LINE-HEIGHT: 18px;
	LINE-HEIGHT: 23px;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>
	<script language=javascript>function show(meval)
{
  var left_n=document.getElementById(meval);
  if (left_n.style.display=="none")
  { document.getElementById(meval).style.display='';}
  else
  { document.getElementById(meval).style.display='none';}
}
-->
</script>
	<!--管理员信息-->
	<div class="menu_title">
		<strong>当前管理员信息</strong>
		<ul class="top">
			<li>用户：<b><font color="#FF3300"><?php echo $this->_tpl_vars['info']['username']; ?>
</font></b></li>
			<li>姓名：<?php echo $this->_tpl_vars['info']['name']; ?>
</li>
			<li>身份：<?php echo $this->_tpl_vars['info']['id']; ?>
</li>
			<li>登录：<?php echo $this->_tpl_vars['info']['login_num']; ?>
次</li>
			<li><a href="admin_pws.php" target="right">修改登录密码</a></li>
			<li><a href="admins_login.php?action=logout" target="_top">注销退出</a></li>
			<!-- <li><a href="admin_info.php">修改个人信息</a></li> -->
			<?php if ($this->_tpl_vars['info']['id'] == '1'): ?>
			<li><a href="config.php" target="right">网站配置</a></li>
			<li><a href="data.php">数据备份</a></li> <?php endif; ?>
			<li title="上次登陆时间"><?php echo $this->_tpl_vars['info']['time2']; ?>
</li>
		</ul>
	</div>
	<!--网站配置-->
	<?php echo $this->_tpl_vars['tree']; ?>

</body>
</html>