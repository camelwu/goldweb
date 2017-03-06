<?php /* Smarty version 2.6.20, created on 2017-03-05 17:48:05
         compiled from D:%5Clocal%5Cgoldweb/view/sitemap.html */ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['ktitle']; ?>
-免责声明</title>
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/global.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/about_us.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/index.js"></script>
</head>
<body>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


	<div class="wrapper about_box clrfix">
		<ul class="about_left">
		  <li><a href="aboutus.html">关于我们</a><span></span></li>
            <li><a href="contactus.html">联系我们</a><span></span></li>
            <li><a href="advise.html">投诉建议</a><span></span></li>
            <li><a href="advertising.html">广告服务</a><span></span></li>
            <li><a href="qualifications.html">旅游资质</a><span></span></li>
            <li><a href="duty.html">免责声明</a><span></span></li>
            <li><a href="partner.html">合作商家</a><span></span></li>
            <li><a href="sitemap.html">网站地图</a><span></span></li>
			<li><a href="insurance.html">旅游保险</a><span></span></li>
            <li><a href="/help.html">帮助中心</a><span></span></li>
			<li><a href="instructions.html">使用说明</a><span></span></li>
			<li><a href="statement.html">法律声明</a><span></span></li>
			<li><a href="agreement.html">用户协议</a><span></span></li>
		</ul>
		<div class="about_right">
		  <ul class="al_ul">
				<li class="abr_title">网站地图</li>
				<li>
					<div class="abr_hd">简介</div> 
                    
				</li>
			</ul>
		</div>
	</div>
<script type="text/javascript">
var al_num = <?php echo $this->_tpl_vars['al_num'][0]; ?>
;
$(".about_left li").eq(al_num).addClass("al_li");

</script>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./view/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


</body>
</html>