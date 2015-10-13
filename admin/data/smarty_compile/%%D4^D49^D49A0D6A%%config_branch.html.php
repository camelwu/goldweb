<?php /* Smarty version 2.6.20, created on 2015-09-04 18:38:09
         compiled from config_branch.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'config_branch.html', 60, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<form name=sel_form action='?action=delete' method=post>
		<tr>
			<th>ID</th>
			<th>机构名称</th>
			<th>联系人</th>
			<th>联系信息</th>
			<th>地区</th>
			<th>类型</th>
			<th>网址</th>
			<th>管理</th>
		</tr>
		<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
		<tr align=center>
			<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['names']; ?>
</td>
			<td>电话：<?php echo $this->_tpl_vars['web']['tel']; ?>
<br>传真：<?php echo $this->_tpl_vars['web']['fax']; ?>
<br>手机：<?php echo $this->_tpl_vars['web']['mobile']; ?>

			</td>
			<td><?php echo $this->_tpl_vars['area'][$this->_tpl_vars['web']['cid']]; ?>
-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['aid']]; ?>
-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['city']]; ?>
</td>
			<td><?php echo $this->_tpl_vars['Config']['company'][$this->_tpl_vars['web']['types']]; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['myurl']; ?>
</td>
			<td><a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
'>编辑</a> <a
				href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
"
				onclick="javascript:return del_nsort();">删除</a></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr class=tr1>
			<td colspan=8><?php echo $this->_tpl_vars['multipage']; ?>
</td>
		</tr>
	</form>
</table>
<table width='90%' height=2>
	<tr class=bg>
		<td></td>
	</tr>
</table>
<?php else: ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<td class=td colspan=2>添加机构</td>
	</tr>
	<form name=add_frm action='?action=handle' method=post
		enctype="multipart/form-data">
		<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'>
		<tr>
			<td>机构名称：</td>
			<td><input type=text name=title size=60 value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;<font
				class=red>*</font></td>
		</tr>
		<tr>
			<td>机构网址：</td>
			<td>http://<input type=text name=myurl size=20
				value='<?php echo $this->_tpl_vars['info']['myurl']; ?>
'>如：xxx.cgbt.net
			</td>
		</tr>
		<tr>
			<td>机构类型：</td>
			<td><select name='types' id='types'> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['company'],'selected' => $this->_tpl_vars['info']['types']), $this);?>

			</select>&nbsp;<font class=red>*</font></td>
		</tr>
		<tr>
			<td>机构地区：</td>
			<td><select name='cid' id='cid'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['area'],'selected' => $this->_tpl_vars['info']['cid']), $this);?>

			</select>&nbsp;&nbsp;&nbsp;&nbsp;<select name=aid>
			</select> <select name=city>
			</select></td>
		</tr>
		<tr>
			<td>机构地址：</td>
			<td><input type=text name=addr size=20 value='<?php echo $this->_tpl_vars['info']['addr']; ?>
'>&nbsp;邮编：<input
				type=text name=zip size=20 value='<?php echo $this->_tpl_vars['info']['zip']; ?>
'></td>
		</tr>
		<tr>
			<td>机构方位：</td>
			<td><input type=text name=pos size=20 value='<?php echo $this->_tpl_vars['info']['pos']; ?>
'></td>
		</tr>
		<tr>
			<td>联 系 人：</td>
			<td><input type=text name=names size=20 value='<?php echo $this->_tpl_vars['info']['names']; ?>
'>&nbsp;<font
				class=red>*</font></td>
		</tr>
		<tr>
			<td>联系方式：</td>
			<td>Q&nbsp;Q：<input type=text name=qq size=20
				value='<?php echo $this->_tpl_vars['info']['qq']; ?>
'>&nbsp;邮箱：<input type=text name=email
				size=20 value='<?php echo $this->_tpl_vars['info']['email']; ?>
'><br /> 电话：<input type=text
				name=tel size=20 value='<?php echo $this->_tpl_vars['info']['tel']; ?>
'>&nbsp;传真：<input
				type=text name=fax size=20 value='<?php echo $this->_tpl_vars['info']['fax']; ?>
'>&nbsp;手机：<input
				type=text name=mobile size=20 value='<?php echo $this->_tpl_vars['info']['mobile']; ?>
'>&nbsp;<font
				class=red>*</font></td>
		</tr>
	<tr>
		<td>机构主图：</td>
		<td><input type=file name=pic size=40><input type=hidden
			name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
	</tr>
	<tr>
		<td><?php echo $this->_tpl_vars['tit']; ?>
网站title：</td>
		<td><input type=text name=ktitle size=60 maxlength=40
			value='<?php echo $this->_tpl_vars['info']['ktitle']; ?>
'></td>
	</tr>
	<tr>
		<td><?php echo $this->_tpl_vars['tit']; ?>
关键字：</td>
		<td><input type=text name=keywords size=60 maxlength=40
			value='<?php echo $this->_tpl_vars['info']['keywords']; ?>
'></td>
	</tr>
	<tr>
		<td valign=top><?php echo $this->_tpl_vars['tit']; ?>
描述：</td>
		<td><textarea rows="5" cols="60" name=description><?php echo $this->_tpl_vars['info']['description']; ?>
</textarea></td>
	</tr>
	<tr>
		<td>备注介绍：</td>
		<td><textarea name=contents style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['contents']; ?>
</textarea></td>
	</tr>
	<tr>
		<td valign=top>服务项目：</td>
		<td><textarea name=word style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['word']; ?>
</textarea></td>
	</tr>
	<tr>
		<td></td>
		<td height=30><input type=submit value='提交添加'> <input
			type=reset value='重新填写'> <input type=button name=go_back
			value='返回上一页' onclick="javascript:location.href='?c_id=0';"></td>
	</tr>
	</form>
</table>

<script language=javascript>
	var cid = $("select[name='cid']");
	var aid = $("select[name='aid']");
	var city = $("select[name='city']");
	function cid_init() {
		aid.empty();
		$
				.ajax({
					type : "GET",
					dataType : "json",
					url : "getajax.php?q=getarea",
					data : "classid=" + cid.val(),
					complete : function() {
					},
					success : function(data, textStatus) {
						var pid_select = "<?php echo $this->_tpl_vars['info']['aid']; ?>
";
						$
								.each(
										data,
										function(index, item) {
											if (pid_select == index) {
												aid
														.append("<option value='"+index+"'  selected=\"selected\">"
																+ item
																+ "</option>");
											} else {
												aid
														.append("<option value='"+index+"'>"
																+ item
																+ "</option>");
											}
										});
						aid_init();
					}
				});
	}
	cid_init();
	cid.change(function() {
		cid_init();
	});
	aid.change(function() {
		aid_init();
	});
	function aid_init() {
		city.empty();
		$
				.ajax({
					type : "GET",
					dataType : "json",
					url : "getajax.php?q=getarea&types=1",
					data : "classid=" + cid.val() + "&pid=" + aid.val(),
					complete : function() {
					},
					success : function(data, textStatus) {
						var pid_select = "<?php echo $this->_tpl_vars['info']['city']; ?>
";
						$
								.each(
										data,
										function(index, item) {
											if (pid_select == index) {
												city
														.append("<option value='"+index+"'  selected=\"selected\">"
																+ item
																+ "</option>");
											} else {
												city
														.append("<option value='"+index+"'>"
																+ item
																+ "</option>");
											}
										});
					}
				});
	}
</script>

<?php endif; ?>

<script language=javascript>
	function del_nsort() {
		var cf = window.confirm("是否确定该操作？");
		return cf;
	}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>