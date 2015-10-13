<?php /* Smarty version 2.6.20, created on 2015-07-06 17:46:45
         compiled from allow.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr><th colspan=2><?php echo $this->_tpl_vars['tit']; ?>
管理</th></tr>
	<tr><td align=center colspan=2 height=30>
	<table border=0>
	<tr>
	<td><a href='?action=list&types=0'>线路列表</a></td>
	<td width=10></td>
	<td><a href='?action=list&types=1'>产品列表</a></td>
	</tr>
	</table>
	</td></tr>
	<tr><td align=center>
	<table border=0 cellspacing=0 cellpadding=2>
	<form action='?action=list' method=get>
	<input type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'>
	<tr>
	<td>搜索（<?php echo $this->_tpl_vars['tit']; ?>
列表） 关键字：</td>
	<td><input type=text name=keyword value='<?php echo $this->_tpl_vars['keyword']; ?>
' size=15 maxlength=20></td>
	<td><input type=submit value='搜索'></td>
	</tr>
	</form>
	</table>
	</td></tr>
</table>
		<?php if ($this->_tpl_vars['action'] == 'list'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<form name=sel_form action='?action=delete' method=post>
				<tr>
					<th>ID</th>
					<th>产品名称</th>
					<th>价格</th>
					<th>操作人</th>
					<th>管理</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
					<td align="left"><?php echo $this->_tpl_vars['web']['title']; ?>
 <font color="#FF0000">[当前<?php if ($this->_tpl_vars['web']['status'] == 1): ?>在线<?php else: ?>下线<?php endif; ?>]</font></td>
					<td><?php echo $this->_tpl_vars['web']['price2']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['op_user']; ?>
</td>
					<td><?php if ($this->_tpl_vars['web']['status'] == 0): ?><a href='?action=handle&types=<?php echo $this->_tpl_vars['types']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&status=1'>通过</a><?php else: ?><a href='?action=handle&types=<?php echo $this->_tpl_vars['types']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&status=0'>下线</a><?php endif; ?></td>
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