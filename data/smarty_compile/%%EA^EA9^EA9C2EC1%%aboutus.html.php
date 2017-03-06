<?php /* Smarty version 2.6.20, created on 2017-03-05 16:43:55
         compiled from D:%5Clocal%5Cgoldweb/view/aboutus.html */ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['ktitle']; ?>
-关于我们</title>
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
smarty_core_smarty_include_php(array('smarty_file' => "/view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


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
				<!--关于我们-->
				<li class="abr_title">关于我们</li>
				<li>
					<div class="abr_hd">简介</div> 
                    <p><br>&nbsp;&nbsp;&nbsp;&nbsp;准特许经营大陆居民赴台旅游业务。<br>
<br>
　　中国金桥旅游有限公司以其经营实力先后加入中国旅游协会、中国旅行协会、北京市旅游行业协会等国内外知名行业协会，并从首届起成为中国旅行社协会常务理事成员单位至今。<br>
<br>
　　中国金桥旅游有限公司以“中国金桥旅游”为品牌，全面落实科学发展观，坚持走规模化、集团化、品牌化、网络化、连锁化经营发展之路。成立二十多年来，以“为人们认识世界，加深理解，增进友情而架设金桥”为企业的崇高使命，全方位开拓入境旅游、国内旅游、出境旅游及商务旅游、各种国际交流、国际会议、国际展览、奖励旅游等专项特色旅游市场，从招徕到接待，为旅游者提供全面的优质服务。公司长期拥有一支训练有素、业务精通、经验丰富的外联、销售队伍和多语种的翻译、导游队伍。公司“以人为本”，精心策划编制适合不同年龄、不同职业、不同兴趣人群的特色旅游产品供旅游消费者选择。除传统旅游线路外，公司还推出了国内外的文物古迹、宗教文化、民俗风情、自驾车旅游等各具特色、精彩纷呈的旅游线路，赢得海内外宾客的青睐。 随着公司自身建设不断加强，品牌扩张不断加快，经营理念和管理机制不断创新，一个以中国金桥旅游有限公司为龙头，多元化的跨国、跨地区、跨行业的旅游销售、接待、服务网络已经形成并得到不断完善。<br>
<br>
　　中国金桥旅游有限公司全体同仁，以“游客至上、质量第一、诚信为本”为宗旨，自尊自强，敬业尽职，勇于开拓，竭诚服务；为旅游事业的发展做出项献。</p><br />
					<br />
					<div class="abr_hd">发展历程</div> 1995年3月，中国金桥旅游有限公司跻身于中国一、二类旅行社百强行列<br />
					<br /> <br /> 1997年6月，进入全国百强国际旅行社排行榜；<br /> <br /> <br />
					2000年9月，成为北京市国际旅行社二十强；<br /> <br /> <br />
					2007年12月，北京市旅游局授予公司“诚信旅行社”荣誉称号；<br /> <br /> <br />
					2008年4月，公司荣获北京市旅游局授予4A国际旅行社称号
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