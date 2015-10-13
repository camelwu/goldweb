<?php /* Smarty version 2.6.20, created on 2015-04-09 06:15:42
         compiled from config_log.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table cellspacing="1" cellpadding="4" class="table">
<tbody><tr><th colspan="2"><?php echo $this->_tpl_vars['tit']; ?>
</th></tr>
<tr><td align="center">
  <table border="0" cellspacing="0" cellpadding="2">
  <form action="?" method="get">
  <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
">
  <tbody><tr>
  <td>搜索（人员列表） 关键字：</td>
  <td><input type="text" name="keyword" value="" size="15" maxlength="20"></td>
  <td><input type="submit" value="搜索"></td>
  </tr>
  </form>
  </table>
</td></tr>
</tbody></table>
        <?php if ($this->_tpl_vars['action'] == 'log'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
				<tr>
					<th>操作日志</th>
					<th>数据表</th>
					<th>IP地址</th>
					<th>系统信息</th>
					<th>操作时间</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><?php echo $this->_tpl_vars['web']['name']; ?>
:<?php echo $this->_tpl_vars['web']['remark']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['ip']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['system']; ?>
<br><?php echo $this->_tpl_vars['web']['broswer']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['addtime']; ?>
</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr class=tr1>
					<td colspan=5><?php echo $this->_tpl_vars['multipage']; ?>
</td>
				</tr>
		</table>
		<?php else: ?>
		<table cellspacing=1 cellpadding=4 class=table>
				<tr>
					<th>图片</th>
					<th>类型</th>
					<th>大小</th>
					<th>操作人</th>
					<th>操作时间</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><?php echo $this->_tpl_vars['web']['filepath']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['ext']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['sizes']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['name']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['addtime']; ?>
</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr class=tr1>
					<td colspan=8><?php echo $this->_tpl_vars['multipage']; ?>
</td>
				</tr>
		</table>
		<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>