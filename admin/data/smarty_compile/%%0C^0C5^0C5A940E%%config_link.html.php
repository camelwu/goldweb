<?php /* Smarty version 2.6.20, created on 2015-04-26 09:26:32
         compiled from config_link.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'config_link.html', 54, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<form name=sel_form action='?action=delete' method=post>
		<tr>
			<th>ID</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
图片</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
名称</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
网址</th>
			<th>关键字</th>
			<th>排序</th>
			<th>状态</th>
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
" width="210"
				height="120" border="0"></td>
			<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['web_url']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['web_key']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['hots']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['status']; ?>
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
		<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
	</tr>
	<form name=add_frm action='?action=handle' method=post
		enctype="multipart/form-data">
		<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'>
		<tr>
			<td width="14%" align="right">链接名称：</td>
			<td width="86%"><input name="title" type="text" class="INPUT"
				id="title" value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td align="right">状态：</td>
			<td><select name=status> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['status'],'selected' => $this->_tpl_vars['info']['status']), $this);?>

			</select></td>
		</tr>
		<tr>
			<td align="right">所属机构：</td>
			<td><select name=bid> <?php if ($this->_tpl_vars['adminid'] == ''): ?>
					<option value='0'>无</option><?php endif; ?> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cg_branch'],'selected' => $this->_tpl_vars['info']['bid']), $this);?>

			</select></td>
		</tr>
		<tr>
			<td align="right">关 键 字：</td>
			<td><input name="web_key" type="text" class="INPUT" id="web_key"
				value="<?php echo $this->_tpl_vars['info']['web_key']; ?>
" size="40" maxlength="60"></td>
		</tr>
		<tr>
			<td align="right">网站网址：</td>
			<td><input name="web_url" type="text" class="INPUT" id="web_url"
				value="<?php echo $this->_tpl_vars['info']['web_url']; ?>
" size="40" maxlength="40"></td>
		</tr>
		<tr>
			<td align="right">联系邮箱：</td>
			<td><input name="email" type="text" class="INPUT" id="email"
				value="<?php echo $this->_tpl_vars['info']['email']; ?>
" size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td align="right">图片上传：</td>
			<td><input type=file name=pic size=40><input type=hidden
				name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
		</tr>
		<tr>
			<td align="right">位置控制：</td>
			<td><input name="hots" type="text" class="INPUT" id="hots"
				value="<?php echo $this->_tpl_vars['info']['hots']; ?>
" size="20" maxlength="10"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'></td>
		</tr>
		<tr>
			<td align="right">备注说明：</td>
			<td><textarea name="content" cols="60" rows="4" class="INPUT"
					id="content"><?php echo $this->_tpl_vars['info']['content']; ?>
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