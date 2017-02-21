<?php /* Smarty version 2.6.20, created on 2015-10-14 14:12:49
         compiled from ./admin_allow.html */ ?>
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
	<td><a href='?types=0'>线路列表</a></td>
	<td width=10></td>
	<td><a href='?types=1'>产品列表</a></td>
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
		<?php if ($this->_tpl_vars['action'] == ''): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<form name="sel_form" action="?action=handle" method="post">
            <input type="hidden" name="types" value="<?php echo $this->_tpl_vars['types']; ?>
">
            <input type="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
				<tr>
					<th><input type="checkbox" id="chkall" onclick="select_all(this,'id[]');" style="border:0"></th>
					<th>图片</th>
                    <th>产品名称</th>
					<th>价格</th>
					<th>发布人</th>
					<th>状态</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><input type="checkbox" name="id[]" value="<?php echo $this->_tpl_vars['web']['id']; ?>
" style="border:0"></td>
					<td width="200"><img src="http://pic.cgbt.net<?php echo $this->_tpl_vars['web']['url']; ?>
" width="180" height="100" /></td>
                    <td align="left"><?php echo $this->_tpl_vars['web']['title']; ?>
  <?php if ($this->_tpl_vars['web']['status'] == '1'): ?>[<font color="#FF0000">通过</font>]<?php endif; ?></td>
					<td><?php echo $this->_tpl_vars['web']['price2']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['op_user']; ?>
</td>
					<td><?php if ($this->_tpl_vars['web']['status'] == 0): ?><a href='?action=handle&types=<?php echo $this->_tpl_vars['types']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&op_type=pass' title='点击通过，可在主站上浏览'>通过</a><?php else: ?><a href='?action=handle&types=<?php echo $this->_tpl_vars['types']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&op_type=down' title='点击下线，从主站上将不再能访问'>下线</a><?php endif; ?></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr>
					<td colspan=8><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%">&nbsp;操作：<select name="op_type" id="op_type"><option value="pass">通过</option><option value="down">下线</option></select> <input type="submit" value="提交"></td>
    <td><?php echo $this->_tpl_vars['multipage']; ?>
</td>
  </tr>
</table></td>
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
				<th colspan=2>浏览信息</th>
			</tr>
			<tr>
				<td><?php echo $this->_tpl_vars['tit']; ?>
：</td>
				<td><?php echo $this->_tpl_vars['info']['title']; ?>
</td>
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
		</table>
		<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>