<?php /* Smarty version 2.6.20, created on 2017-03-05 16:42:28
         compiled from D:%5Clocal%5Cgoldweb./view/common/header.html */ ?>

<div class="top_box">
	<!--头部-->
	<div class="top wrapper">
		<a href="<?php echo $this->_tpl_vars['siteurl']; ?>
" class="logo"></a>
		<!--logo-->
		<div class="top_area_box">
			<div class="this_area">
				<span><?php echo $this->_tpl_vars['ipfrom']; ?>
</span>
				<ul class="area_box1">
					<li class="area_name">热门城市</li>
					<li class="area_bd"><?php $_from = $this->_tpl_vars['hitareas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hitareaskey'] => $this->_tpl_vars['hitareasitem']):
?><?php if ($this->_tpl_vars['cg_branch'][$this->_tpl_vars['hitareaskey']] != ''): ?><a href="http://<?php echo $this->_tpl_vars['cg_branch'][$this->_tpl_vars['hitareaskey']]; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['hitareasitem']; ?>
<?php if ($this->_tpl_vars['cg_branch'][$this->_tpl_vars['hitareaskey']] != ''): ?></a><?php endif; ?> <?php endforeach; endif; unset($_from); ?>
					</li> <?php $_from = $this->_tpl_vars['dataarea']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dataareaitem']):
?>
					<li class="clrfix area_bd_box">
						<div class="fl area_bd_left"><?php echo $this->_tpl_vars['dataareaitem']['title']; ?>
</div>
						<div class="fl area_bd_right">
							<?php $_from = $this->_tpl_vars['dataareaitem']['dataarr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dataareakey2'] => $this->_tpl_vars['dataareaitem2']):
?> <?php if ($this->_tpl_vars['cg_branch'][$this->_tpl_vars['dataareakey2']] != ''): ?><a href="http://<?php echo $this->_tpl_vars['cg_branch'][$this->_tpl_vars['dataareakey2']]; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['dataareaitem2']; ?>
<?php if ($this->_tpl_vars['cg_branch'][$this->_tpl_vars['dataareakey2']] != ''): ?></a><?php endif; ?><?php endforeach; endif; unset($_from); ?>
					</li> <?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>

			<div class="top_area_crm">本地分公司</div>
		</div>
		<div class="search_box">
			<!--搜索-->
			<select name="tt" style="border: 0;"><option value="arrvied"
					classid="1">目的地</option>
				<option value="scenic" classid="3">景点</option>
				<option value="blog" classid="5">攻略</option>
				<option value="tour" classid="0">线路</option></select> <input type="text"
				name="keyvalue" placeholder="搜目的地/景点/攻略/线路" /><a
				href="javascript:tijiao();"></a>

		</div>
		<?php if ($this->_tpl_vars['uid'] == ''): ?>
		<div class="log_reg">
			<!--登录注册-->
			<a href="<?php echo $this->_tpl_vars['siteurl']; ?>
/login">登录</a>|<a href="<?php echo $this->_tpl_vars['siteurl']; ?>
/registered">注册</a>
		</div>
		<?php else: ?>
		<div class="after_login clrfix">
			<!--登录后-->
			<div class="log_user">
				用户：<a href="/MemberCenter"><?php echo $this->_tpl_vars['username']; ?>
</a>
			</div>
			<a href="/MemberCenter" class="user_news"><div class="news_num">0</div></a>
			<a href="javascript:logout();">退出&nbsp;&nbsp;</a>
		</div>
		<?php endif; ?>
	</div>
</div>
<script language=javascript>
	function tijiao() {
		var keyvalue = $("input[name='keyvalue']");
		if (keyvalue.val() != "") {
			window.location.href = "/search/" + encodeURI(keyvalue.val());
		}
	}
	function logout() {
		var url = "/getajax.php?action=logout";
		$.getJSON(url, function(json) {
			window.location.reload()
		});
	}
</script>
<div class="nav_box">
	<!--导航-->
	<div class="nav_bg wrapper">
		<ul class="menu_box">
			出游目的地 <?php $_from = $this->_tpl_vars['layermax']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layeritems']):
?>
			<li class="menu_box2 mb2_a">
				<!--周边游--> <span class="mb2_icon"><?php echo $this->_tpl_vars['layeritems']['title']; ?>
</span>
				<div class="mb2_txt">
					<?php $_from = $this->_tpl_vars['layeritems']['layer1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layer11']):
?> <a href="/<?php echo $this->_tpl_vars['layeritems']['html']; ?>
/--<?php echo $this->_tpl_vars['layer11']['id']; ?>
-------"><?php echo $this->_tpl_vars['layer11']['title']; ?>
</a>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				<div class="menu_box3">
				<?php $_from = $this->_tpl_vars['layeritems']['layer2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layer22']):
?>
					<dl class="clrfix">
						<dt><?php echo $this->_tpl_vars['layer22']['title']; ?>
</dt>
						<dd>
						<?php $_from = $this->_tpl_vars['layer22']['area']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layer33']):
?>
							<a href="/<?php echo $this->_tpl_vars['layeritems']['html']; ?>
/--<?php echo $this->_tpl_vars['layer33']['id']; ?>
-------"><?php echo $this->_tpl_vars['layer33']['title']; ?>
</a> <?php endforeach; endif; unset($_from); ?>
						</dd>
					</dl>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			</li> <?php endforeach; endif; unset($_from); ?>

		</ul>
		<ul class="nav_main clrfix">
			<li<?php if ($this->_tpl_vars['enname'] == ''): ?> class="nav_on"<?php endif; ?>><a
				href="<?php echo $this->_tpl_vars['siteurl']; ?>
">首页</a></li> <?php $_from = $this->_tpl_vars['layer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layeritem']):
?>
			<li<?php if ($this->_tpl_vars['enname'] == $this->_tpl_vars['layeritem']['html']): ?> class="nav_on"<?php endif; ?>><a
				href="<?php echo $this->_tpl_vars['siteurl']; ?>
/<?php echo $this->_tpl_vars['layeritem']['html']; ?>
"><?php echo $this->_tpl_vars['layeritem']['title']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			<li <?php if ($this->_tpl_vars['enname'] == 'custom'): ?> class="nav_on"<?php endif; ?>><a
				href="<?php echo $this->_tpl_vars['siteurl']; ?>
/custom">私人定制</a></li>
			<li <?php if ($this->_tpl_vars['enname'] == 'scenic'): ?> class="nav_on"<?php endif; ?>><a
				href="<?php echo $this->_tpl_vars['siteurl']; ?>
/scenic">景点门票</a></li>
		</ul>
	</div>
</div>