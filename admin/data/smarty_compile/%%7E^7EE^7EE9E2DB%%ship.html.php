<?php /* Smarty version 2.6.20, created on 2015-05-31 02:20:15
         compiled from ship.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'ship.html', 46, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['action'] == 'list'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<tr>
				<th>ID</th>
				<th><?php echo $this->_tpl_vars['tit']; ?>
图片</th>
				<th><?php echo $this->_tpl_vars['tit']; ?>
名称&amp;星级</th>
				<th>载客量&amp;吨位</th>
				<th>长度×宽度</th>
				<th>航速</th>
				<th>报价&amp; 信息</th>
                <th>编辑</th>
			  <th>管理</th>
			</tr>
			<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
			<tr align=center>
				<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
              <td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
" width=210 height="120"></td>
				<td><?php echo $this->_tpl_vars['web']['title']; ?>
&amp;<?php echo $this->_tpl_vars['web']['star']; ?>
</td>
				<td><?php echo $this->_tpl_vars['web']['serial']; ?>
&amp;<?php echo $this->_tpl_vars['web']['codes']; ?>
</td>
				<td><?php echo $this->_tpl_vars['web']['material']; ?>
×<?php echo $this->_tpl_vars['web']['brand']; ?>
</td>
				<td><?php echo $this->_tpl_vars['web']['post']; ?>
节</td> 
				<td><a href="hotel.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=0">客房</a><span class="title3">(<?php echo $this->_tpl_vars['web']['num']; ?>
)</span>
					&nbsp; <a href="hotel.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=1">图片</a><span class="title3">(<?php echo $this->_tpl_vars['web']['num1']; ?>
)</span></td>
				<td><?php echo $this->_tpl_vars['web']['op_user']; ?>
</td>
  <td><a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['web']['types']; ?>
'>编辑</a>
					<a href="?action=delete&types=<?php echo $this->_tpl_vars['web']['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
" onclick="javascript:return del_nsort();">删除</a></td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
			<tr>
				<td colspan=9><?php echo $this->_tpl_vars['multipage']; ?>
</td>
			</tr>
		</table>
		<?php else: ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<tr>
				<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
			</tr>
			<form name=add_frm action='?action=handle' method=post
				enctype="multipart/form-data">
				<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'> <input
					type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'>
				<tr>
					<td align="right"><?php echo $this->_tpl_vars['tit']; ?>
名称：</td>
					<td><input type=text name=title size=30
						value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['hotname']; ?>
:<select name='ctype' id='ctype'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['hotel'],'selected' => $this->_tpl_vars['info']['ctype']), $this);?>

					</select><font class=red>*</font></td>
				</tr>
                <tr>
                <td align="right">产品编号：</td>
                <td><input name="info_id" type="text" class="INPUT" id="info_id" value="<?php echo $this->_tpl_vars['info']['info_id']; ?>
" size="30" maxlength="30"></td>
                </tr>
				<tr>
					<td align="right">图片上传：</td>
					<td><input type=file name=pic size=40><input
						type=hidden name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
				</tr>
				<tr>
					<td align="right">载客：</td>
					<td><input name="serial" type="text" class="INPUT" id="serial"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")'
						value="<?php echo $this->_tpl_vars['info']['serial']; ?>
" size="15"> &nbsp;&nbsp;吨位： <input
						name="codes" type="text" class="INPUT" id="codes"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")'
						value="<?php echo $this->_tpl_vars['info']['codes']; ?>
" size="15"></td>
				</tr>
				<tr>
					<td width="14%" align="right">船长：</td>
					<td><input name="material" type="text" class="INPUT"
						id="material" value="<?php echo $this->_tpl_vars['info']['material']; ?>
" size="15"></td>
				</tr>
				<tr>
					<td align="right">船宽：</td>
					<td><input name="brand" type="text" class="INPUT" id="brand"
						value="<?php echo $this->_tpl_vars['info']['brand']; ?>
" size="15"></td>
				</tr>
			<tr>
				<td align="right">航速：</td>
				<td><input name="post" type="text" class="INPUT" id="post"
					value="<?php echo $this->_tpl_vars['info']['post']; ?>
" size="15"
					onKeyUp="this.value=this.value.replace(/\D/gi,&quot;&quot;)" />节</td>
			</tr>
			<tr>
				<td align="right"><?php echo $this->_tpl_vars['tit']; ?>
介绍：</td>
				<td><textarea name=word style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['word']; ?>
</textarea></td>
			</tr>
			<tr>
				<td align="right">服务项目：</td>
				<td><textarea name=info style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['info']; ?>
</textarea></td>
			</tr>
			<tr>
			<td></td>
			<td height=30><input type=submit value='提交添加'> <input
				type=reset value='重新填写'> <input type=button name=go_back
				value='返回上一页' onClick="javascript:location.href='?c_id=0';"></td>
			</tr>
			</form>
		</table>

<script language=javascript>
			var cid = $("select[name='cid']");
			var aid = $("select[name='aid']");
			var city = $("select[name='city']");
			var ctype = $("select[name='ctype']");
			var ctype1 = $("select[name='ctype1']");
			
			function ctype_init() {
				ctype1.empty();
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getclass",
							data : "pid=" + ctype.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['ctype1']; ?>
";
								$.each(data,function(index, item) {
													if (pid_select == index) {
														ctype1.append("<option value='"+index+"'  selected=\"selected\">"
																		+ item
																		+ "</option>");
													} else {
														ctype1.append("<option value='"+index+"'>"
																		+ item
																		+ "</option>");
													}
												});
							}
						});
			}
			ctype_init();
			ctype.change(function() {
				ctype_init();
			});
			
			function cid_init() {
				aid.empty();
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getarea",
							data : "classid=" + cid.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['aid']; ?>
";
								$.each(data,function(index, item) {
													if (pid_select == index) {
														aid.append("<option value='"+index+"'  selected=\"selected\">"
																		+ item
																		+ "</option>");
													} else {
														aid.append("<option value='"+index+"'>"
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
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getarea&types=1",
							data : "classid=" + cid.val() + "&pid=" + aid.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['city']; ?>
";
								$.each(data,function(index, item) {
													if (pid_select == index) {
														city.append("<option value='"+index+"'  selected=\"selected\">"
																		+ item
																		+ "</option>");
													} else {
														city.append("<option value='"+index+"'>"
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