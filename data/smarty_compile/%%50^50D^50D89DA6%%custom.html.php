<?php /* Smarty version 2.6.20, created on 2017-03-12 23:16:41
         compiled from D:%5Clocal%5Cgoldweb/view/custom.html */ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['cnname']; ?>
_旅行社_<?php echo $this->_tpl_vars['ktitle']; ?>
_金桥</title>
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/global.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/index.css" rel="stylesheet" type="text/css">

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

	<div class="wrapper now_position">
		<!--当前位置-->
		<a href="index.html">首页</a>&gt;<a href="./<?php echo $this->_tpl_vars['enname']; ?>
/"><?php echo $this->_tpl_vars['cnname']; ?>
</a>
	</div>
	<div class="cruises_banner">
		<!--top-img-->
		<a href="#" class="cruises_top"><img
			src="images/privatecustom.jpg" width="1920" height="330" /></a>
	</div>

	<div class="wrapper">
		<ul class="db_title clrfix">
			<li class="db_hd1"><span>在线/电话提出需求</span></li>
			<li class="db_hd2"><span>专业旅游顾问制定行程、报价</span></li>
			<li class="db_hd3"><span>确认需求预约付款</span></li>
			<li class="db_hd4"><span>完成预定开始享受旅程</span></li>
		</ul>
		<div class="address_select clrfix privcust_box">
			<div class="pc_title">
				团队出游需求单<span>填写，提交出游需求单，我们的顾问会尽快和您联系</span>
			</div>
			<div class="pc_hd">需求信息：</div>
			<ul class="demand_box">
<script language="javascript">
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
function checkfrm(frm){
 if(document.frm.username.value==""){
	alert("请输入用户名");
	document.frm.username.focus();
	return false;
 }else if(document.frm.password.value==""){
	alert("请输入密码");
	document.frm.password.focus();
	return false;
 }/*else if(document.frm.code.value==""){
	alert("请输入验证");
	document.frm.code.focus();
	return false;
 }*/else{
	return true;
 }
}
</script>
				<!--需求信息--><form name="order_frm" action="?action=handle" method="post" onSubmit="return checkfrm(this);">
				<li><span><b>*</b>出游类型：</span> <select name="types">
						<option>团队旅游</option>
						<option>团队旅游</option>
				</select></li>
				<li><span><b>*</b>出游天数：</span> <select name="days">
						<option>1~2</option>
						<option>3~6</option>
				</select></li>
				<li><span><b>*</b>目的地：</span> <label> <input
						type="radio" name="ctype">周边
				</label> <label> <input type="radio" name="ctype">国内
				</label> <label> <input type="radio" name="ctype">出境 <input
						type="text" class="w90" name="arrived" />
				</label></li>
				<li class="db_input"><span><b>*</b>出游时间：</span> <input
					type="text" id="j_Date1" placeholder="yyyy-mm-dd" />——&nbsp;&nbsp;<input
					type="text" id="j_Date2" placeholder="yyyy-mm-dd" /> <a href="#"
					class="date_yes">确定</a></li>
				<li><span><b>*</b>出游人数：</span> <input type="text" / class="w90" name="go_num">人&nbsp;&nbsp;&nbsp;&nbsp;
					<label> <input type="checkbox" name="has">有儿童
				</label> <label> <input type="checkbox" name="has">有老人
				</label></li>
				<li><span>出游预算：</span> <input type="text" class="w90" name="price"/>元/人</li>
				<li><span>其他需求：</span> <textarea name="word" cols="" rows=""></textarea>
				</li>
			</ul>
			<div class="pc_hd">联系信息：</div>
			<ul class="demand_box contact_info">
				<li><span><b>*</b>联系人：</span><input type="text" name="names" /></li>
				<li><span><b>*</b>手机号码：</span><input type="text" name="mobile" /></li>
				<li><span>公司名称：</span><input type="text" name="company" /></li>
				<li><span><b>*</b>验证码：</span><input type="text" name="code" class="w90" />
					<a href="javascript:void(0);" onClick="return get_code();" class="db_ver_img"><img src="image.php" id="findcode" width="78" height="26" /></a> <a href="javascript:void(0);" onClick="get_code();" class="bd_ver_txt">看不清换一张</a>
				</li>
				<li><a href="#" class="con_sub">确认提交</a></li></form>
			</ul>
		</div>
	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./view/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>