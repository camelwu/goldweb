<?php /* Smarty version 2.6.20, created on 2017-03-05 17:43:13
         compiled from D:%5Clocal%5Cgoldweb/view/advise.html */ ?>
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
<script language="javascript">
function indentify_img_onload(){}
var validate = true;
function get_code(){
	if(validate==true){
		document.getElementById("findcode").src="image.php?"+Math.random();
		validate = false;
		return false;
	}else{
		document.getElementById("findcode").src="image.php?"+Math.random();
		validate = true;
		return false;
	}
}
function checkfrm(){
 if(document.admin_frm.username.value==""){
	alert("请输入用户名");
	document.admin_frm.username.focus();
	return false;
 }else if(document.admin_frm.password.value==""){
	alert("请输入密码");
	document.admin_frm.password.focus();
	return false;
 }/*else if(document.admin_frm.code.value==""){
	alert("请输入验证");
	document.admin_frm.code.focus();
	return false;
 }*/else{
	return true;
 }
}
</script>
				<li class="abr_title">投诉建议</li>
				<li>
					<div class="suggest_w">
		<div class="suggest_i">
			<dl class="suggest_form">
				<dt><h3>您的参与将帮助我们改进产品及服务。</h3></dt>
					<dd>非常感谢您使用金桥旅游网，如果您有提议、投诉及相关建议，可以通过以下方式联系我们。</dd>
					<dd>
						<div class="suggestion">
							<ul>
								<li><span>1、</span>联系之前为您服务的客服</li>
								<li><span>2、</span>拨打金桥投诉电话<label>400-061-5880</label></li>
								<li><span>3、</span>发送邮件到金桥信箱 <a href="mailto:xiaohua@xiaohua.net">xiaohua@xiaohua.net</a></li>
								<li><span>4、</span>给我们在线留言</li>
							</ul>
						</div>
					</dd>
<dd>
反馈类型：<br>
<form id="advise_form" action="/main.php?do=advise" method="post" target="_myfrm" onsubmit="return false;">
<table cellspacing="0">
<tbody><tr>
<td><input type="radio" name="yj_type" id="yj_type1" checked="checked" value="1"><label for="yj_type1">功能不好用</label></td>
<td><input type="radio" name="yj_type" id="yj_type2" value="2"><label for="yj_type2">没有合适的线路</label></td>
<td><input type="radio" name="yj_type" id="yj_type3" value="3"><label for="yj_type3">线路介绍不清楚</label></td>
<td><input type="radio" name="yj_type" id="yj_type4" value="4"><label for="yj_type4">网站不好看</label></td>
<td><input type="radio" name="yj_type" id="yj_type5" value="5"><label for="yj_type5">客服</label></td>
</tr>
<tr>
<td><input type="radio" name="yj_type" id="yj_type6" value="6"><label for="yj_type6">导游</label></td>
<td><input type="radio" name="yj_type" id="yj_type7" value="7"><label for="yj_type7">旅行社</label></td>
<td><input type="radio" name="yj_type" id="yj_type8" value="8"><label for="yj_type8">线路</label></td>
<td><input type="radio" name="yj_type" id="yj_type9" value="9"><label for="yj_type9">其他</label></td>
</tr>
</tbody></table><br><br>
</dd>
<dd>
相关页面链接：<br>
<input id="rlink" name="rlink" type="text" class="input_w1"><br><br>
</dd>
<dd>
请详细描述您的建议、意见、问题等：<br>
<textarea id="rdes" name="rdes" rows="5" class="input_w1" style="height:180px;"></textarea><br><br>
</dd>
<dd>
电子邮箱：<br>
<input id="email" name="email" type="text" class="input_w2">
</dd>
<dd>
电话号码：<br>
<input id="phone" name="phone" type="text" class="input_w2">
</dd>
<!--<dd>
验证码：<br />
<input id="check_code" name="check_code" type="text" class="input_w3" style="margin-right:3px;" /><img id="identify_img" src="/identify2.php?flag=0" align="absmiddle" /> <a href="javascript:void(0)" id="changecode" onclick="changeImg();">看不清楚？</a>
</dd>-->
<dd>
验证码：<br>
<input type="text" onblur="login.checkIdentify();" onfocus="login.changeClass(3,1,2);" id="identify" name="check_code" style="width: 55px;" tabindex="3">
        <img id="wait_identify" style="position: relative; top: 4px; display: none;" src="/ui/user/images/movie_2.gif"> <img src="http://img1.tuniucdn.com/u/user/img/loading.gif" height="24" width="24" align="absmiddle" id="img_loading" style="display: none;"><a href="javascript:void(0);" title="如验证码无法辨别，点击即可刷新。" onclick="return false;"><img height="24" width="80" id="identify_img" alt="如验证码无法辨别，点击即可刷新。" align="absmiddle" src="/view/common/scode.php?flag=0&amp;cache=0.7879558310378343" onclick="get_code();" onload="indentify_img_onload();" style=""></a>
</dd>
<dd>
<input type="submit" style="padding:0;margin-top:10px;" value="提交" >
</form>
</dd>
</dl>
</div>
</div>
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