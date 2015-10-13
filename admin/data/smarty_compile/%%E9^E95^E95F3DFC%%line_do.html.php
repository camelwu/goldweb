<?php /* Smarty version 2.6.20, created on 2015-04-19 14:50:49
         compiled from line_do.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'line_do.html', 78, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table width="100%" border="0" cellpadding="2" cellspacing="1"
			class="table">
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['tit1']; ?>
管理</th>
			</tr>
			<tr>
				<td width="13%" align="right"><?php echo $this->_tpl_vars['tit']; ?>
名称：</td>
				<td width="87%"><?php echo $this->_tpl_vars['scenicinfo']['title']; ?>
&nbsp;|&nbsp;<a
					href="admin_plan.php?types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
">返回列表</a></td>
			</tr>
			<tr>
				<td align="right">管理操作：</td>
				<td>&nbsp;<a href="?id=<?php echo $this->_tpl_vars['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
&action=add">添加<?php echo $this->_tpl_vars['tit1']; ?>
</a>&nbsp;|&nbsp;<a
					href="?id=<?php echo $this->_tpl_vars['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
"><?php echo $this->_tpl_vars['tit1']; ?>
管理</a></td>
			</tr>
		</table>
		<?php if ($this->_tpl_vars['action'] == 'list'): ?>
				<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
			<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hotel'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hotel']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['web']):
        $this->_foreach['hotel']['iteration']++;
?>
	
				<tr>
					<td width="13%" align="right" class="style101">(<?php echo ($this->_foreach['hotel']['iteration']-1)+1; ?>
)<?php echo $this->_tpl_vars['tit1']; ?>
<?php if ($this->_tpl_vars['types'] == '4' && $this->_tpl_vars['ctype'] == '0'): ?>人等<?php else: ?>名称<?php endif; ?>：</td>
					<td ><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
                </tr>
				<?php if ($this->_tpl_vars['ctype'] == '1'): ?>
                <tr>
					<td align="right" class="style100">显示图片:</td>
					<td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
"></td>
				</tr>
				<?php elseif ($this->_tpl_vars['ctype'] == '0'): ?>
				<tr>
					<td align="right" class="style100">报价变动：</td>
					<td><?php echo $this->_tpl_vars['Config']['float'][$this->_tpl_vars['web']['pass']]; ?>
￥<?php echo $this->_tpl_vars['web']['price']; ?>
</td>
				</tr>
				<tr>
					<td align="right" class="style100">变动时间：</td>
					<td height="25"><?php echo $this->_tpl_vars['web']['time']; ?>
</td>
				</tr>
				<?php endif; ?>
				<tr>
					<td></td>
					<td><input type="button" name="button" onClick="javascript:window.location='?hid=<?php echo $this->_tpl_vars['web']['hid']; ?>
&id=<?php echo $this->_tpl_vars['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
&action=add'" value="修 改"> <input
						name="delete" type="button" id="delete2" value="删 除"
						onClick="window.location='?hid=<?php echo $this->_tpl_vars['web']['hid']; ?>
&id=<?php echo $this->_tpl_vars['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
&action=delete';"></td>
					
				</tr>
			
		<?php endforeach; endif; unset($_from); ?>
		</table>
		<?php else: ?>
		<form name="myform_1" method="post"
			action="?action=handle" enctype="multipart/form-data">
			<input type=hidden name="types" value="<?php echo $this->_tpl_vars['types']; ?>
"> 
			<input type=hidden name="ctype" value="<?php echo $this->_tpl_vars['ctype']; ?>
"> 
			<input type=hidden name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
			<input type=hidden name="hid" value="<?php echo $this->_tpl_vars['info']['hid']; ?>
">

			<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
                <tr>
					<td width="13%" align="right" class="style101"><?php echo $this->_tpl_vars['tit1']; ?>
<?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '0'): ?>原因<?php else: ?>名称<?php endif; ?>：</td>
					<td ><input name="title" type="text" class="INPUT"
						 value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="20"><?php if ($this->_tpl_vars['types'] == '4'): ?>例如：1或者2~5<?php endif; ?></td>
				</tr><?php if ($this->_tpl_vars['ctype'] == '1'): ?>
				<tr>
					<td align="right">图片上传：</td>
					<td><input type=file name=pic size=40><input
						type=hidden name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
				</tr>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['ctype'] == '0'): ?>
				<tr>
					<td align="right">发团时间：</td>
					<td><?php if ($this->_tpl_vars['scenicinfo']['go_type'] == '0'): ?>每天<?php elseif ($this->_tpl_vars['scenicinfo']['go_type'] == '1'): ?>每周<?php echo $this->_tpl_vars['scenicinfo']['go_time']; ?>
<?php elseif ($this->_tpl_vars['scenicinfo']['go_type'] == '1'): ?>每月<?php echo $this->_tpl_vars['scenicinfo']['go_time']; ?>
<?php else: ?><?php echo $this->_tpl_vars['scenicinfo']['go_time']; ?>
<?php endif; ?></td>
				</tr>
                <tr>
					<td width="13%" align="right" class="style100">浮动差价：</td>
					<td height="25"><script type="text/javascript" src="js/DatePicker.js"></script><?php echo smarty_function_html_radios(array('name' => 'pass','options' => $this->_tpl_vars['r_2'],'checked' => $this->_tpl_vars['info']['pass'],'separator' => ""), $this);?>
 <input name="price" type="text" class="INPUT" id="price" onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="15"> 元&nbsp;&nbsp;浮动时间： <input name="time" type="text" class="INPUT" value="<?php echo $this->_tpl_vars['info']['time']; ?>
" onFocus="setday(this)" readonly="readonly" size="10"></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td></td>
					<td><input type="submit"  value="提  交"> </td>
				</tr>
			</table>
		</form>

		

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