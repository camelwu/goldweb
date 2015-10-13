<?php /* Smarty version 2.6.20, created on 2015-04-09 07:20:25
         compiled from air.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['action'] == 'list'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<form name=sel_form action='?action=delete' method=post>
				<tr>
					<th>ID</th>
					<th><?php echo $this->_tpl_vars['tit']; ?>
</th>
					<th>英文名称</th>
					<th>三位码</th>
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
					<td><?php echo $this->_tpl_vars['web']['code']; ?>
</td>
					<td><a href='?action=edit&types=<?php echo $this->_tpl_vars['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
'>编辑</a> <a
						href="?action=delete&types=<?php echo $this->_tpl_vars['types']; ?>
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
				<td class=td colspan=2>添加信息</td>
			</tr>
			<form name=add_frm action='?action=handle' method=post
				enctype="multipart/form-data">
				<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'>
				<tr>
					<td><?php echo $this->_tpl_vars['tit']; ?>
：</td>
					<td><input type=text name=title size=60
						value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;<font class=red>*</font></td>
				</tr>
				<tr>
					<td>英文名称：</td>
					<td><input type=text name=names size=60
						value='<?php echo $this->_tpl_vars['info']['names']; ?>
'>&nbsp;<font class=red>*</font></td>
				</tr>
				<tr>
					<td>三位码：</td>
					<td><input type=text name=code size=60
						value='<?php echo $this->_tpl_vars['info']['code']; ?>
'>&nbsp;<font class=red>*</font></td>
				</tr>
			<tr>
				<td></td>
				<td height=30><input type=submit value='提交添加'> <input
					type=reset value='重新填写'> <input type=button name=go_back
					value='返回列表' onClick="javascript:location.href='?types=<?php echo $this->_tpl_vars['types']; ?>
';"></td>
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