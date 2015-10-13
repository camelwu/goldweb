<?php /* Smarty version 2.6.20, created on 2015-08-27 18:49:55
         compiled from product_order.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'product_order.html', 129, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing="1" cellpadding="4" class="table">
	<tr>
		<th colspan="2"><?php echo $this->_tpl_vars['tit']; ?>
订单管理</th>
	</tr>
	<tr>
		<td align="center" colspan="2" height="30">
			<table border="0">
				<tr>
					<td><a href="?action=list&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=0">未处理<?php echo $this->_tpl_vars['tit']; ?>
订单</a></td>
					<td width="10"></td>
					<td><a href="?action=list&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=1">已处理<?php echo $this->_tpl_vars['tit']; ?>
订单</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="0" cellspacing="0" cellpadding="2">
				<form action="?action=list" method="get"></form>
				<input type="hidden" name="types" value="<?php echo $this->_tpl_vars['types']; ?>
">
				<input type="hidden" name="ctype" value="<?php echo $this->_tpl_vars['ctype']; ?>
">
				<tbody>
					<tr>
						<td>搜索（订单） 关键字：</td>
						<td><input type="text" name="keyword" value="" size="15"
							maxlength="20"></td>
						<td><input type="submit" value="搜索"></td>
					</tr>

				</tbody>
			</table>
		</td>
	</tr>
</table>
<table cellspacing=1 cellpadding=4 class=table>
	<form name=sel_form action='?action=delete' method=post>
		<tr>
			<th>用户</th>
			<th>订单编号</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
名称</th>
			<th>数量</th>
			<th>预订时间</th>
			<th>预订人信息</th>
			<th>提交时间</th>
			<th>状态</th>
			<th>管理</th>
		</tr>
		<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
		<tr align=center>
			<td><?php echo $this->_tpl_vars['web']['uid']; ?>
:(<?php echo $this->_tpl_vars['web']['username']; ?>
)</td>
			<td><?php echo $this->_tpl_vars['web']['orderNo']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['ordernum']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['ordertime']; ?>
</td>
			<td>联系人：<?php echo $this->_tpl_vars['web']['name']; ?>
<br> 手机：<?php echo $this->_tpl_vars['web']['tel']; ?>
<br>
				email：<?php echo $this->_tpl_vars['web']['email']; ?>
<br> 特殊需求：<?php echo $this->_tpl_vars['web']['info']; ?>
<br></td>
			<td><?php echo $this->_tpl_vars['web']['createtime']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Config']['op_type'][$this->_tpl_vars['web']['ctype']]; ?>
<br><?php echo $this->_tpl_vars['Config']['orderstatus'][$this->_tpl_vars['web']['status']]; ?>
</td>
			<td><a href='?action=edit&orderNo=<?php echo $this->_tpl_vars['web']['orderNo']; ?>
'>处理</a> <a
				href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&orderNo=<?php echo $this->_tpl_vars['web']['orderNo']; ?>
"
				onclick="javascript:return del_nsort();">删除</a></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr class=tr1>
			<td colspan=9><?php echo $this->_tpl_vars['multipage']; ?>
</td>
		</tr>
	</form>
</table>
<table width='90%' height=2>
	<tr class=bg>
		<td></td>
	</tr>
</table>
<?php elseif ($this->_tpl_vars['action'] == 'edit'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<td class=td colspan=2>处理订单</td>
	</tr>
	<form name=add_frm action='?action=handle' method=post
		enctype="multipart/form-data">
		<input type=hidden name=orderNo value='<?php echo $this->_tpl_vars['info']['orderNo']; ?>
'>
		<tr>
			<td width="14%" align="right">订单编号：</td>
			<td width="86%"><?php echo $this->_tpl_vars['info']['orderNo']; ?>
</td>
		</tr>
		<tr>
			<td width="14%" align="right">用户：</td>
			<td width="86%"><?php echo $this->_tpl_vars['info']['uid']; ?>
:(<?php echo $this->_tpl_vars['info']['username']; ?>
)</td>
		</tr>
		<tr>
			<td align="right">产品名称：</td>
			<td><input name="title" type="text" size="20" maxlength="20"
				value="<?php echo $this->_tpl_vars['info']['title']; ?>
"></td>
		</tr>
	<tr>
		<td align="right">预订人数：</td>
		<td><input name="ordernum" type="text" size="20" maxlength="10"
			value="<?php echo $this->_tpl_vars['info']['ordernum']; ?>
"
			onKeyUp='this.value=this.value.replace(/\D/gi,"")'></td>
	</tr>
	<tr>
		<td align="right">出行时间：</td>
		<td><input name="ordertime" type="text"
			value="<?php echo $this->_tpl_vars['info']['ordertime']; ?>
" size="20" maxlength="10"></td>
	</tr>
	<tr>
		<td align="right">联系人：</td>
		<td><input name="name" type="text" value="<?php echo $this->_tpl_vars['info']['name']; ?>
"
			size="20" maxlength="10"></td>
	</tr>
	<tr>
		<td align="right">联系邮箱：</td>
		<td><input name="email" type="text" size="20" maxlength="20"
			value="<?php echo $this->_tpl_vars['info']['email']; ?>
"></td>
	</tr>
	<tr>
		<td align="right">联系电话：</td>
		<td><input name="tel" type="text" size="20" maxlength="20"
			value="<?php echo $this->_tpl_vars['info']['tel']; ?>
"></td>
	</tr>
	<tr>
		<td align="right">特殊需求：</td>
		<td><input name="info" type="text" size="70"
			value="<?php echo $this->_tpl_vars['info']['info']; ?>
"></td>
	</tr>
	<tr>
		<td align="right">支付状态：</td>
		<td><select name="status" id="status"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['orderstatus'],'selected' => $this->_tpl_vars['info']['status']), $this);?>

		</select>汇款单号：<input name="bankorder" type="text" size="50" maxlength="50"
			value="<?php echo $this->_tpl_vars['info']['bankorder']; ?>
"></td>
	</tr>
	<tr>
		<td align="right">下单时间：</td>
		<td><?php echo $this->_tpl_vars['info']['createtime']; ?>
</td>
	</tr>
	<tr>
		<td align="right">订单状态：</td>
		<td><select name="ctype" id="ctype" style="width: 120"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['op_type'],'selected' => $this->_tpl_vars['info']['ctype']), $this);?>

		</select></td>
	</tr>
	<tr>
		<td align="right">留言备注：</td>
		<td><textarea name="op_info" cols="134" rows="4" class="textarea"
				id="op_info"><?php echo $this->_tpl_vars['info']['op_info']; ?>
</textarea></td>
	</tr>
	<!-- <tr>
		<td align="right">邮件通知：</td>
		<td><label><input type="radio" name="send" value="1"
				checked="checked">是</label><label><input type="radio"
				name="send" value="0">否</label></td>
	</tr> -->
	<tr>
		<td align="right">处理信息:</td>
		<td><?php if ($this->_tpl_vars['info']['op_user'] != ''): ?>
			管理员:“<?php echo $this->_tpl_vars['info']['op_user']; ?>
”，处理时间:"<?php echo $this->_tpl_vars['info']['ts']; ?>
<?php endif; ?></td>
	</tr>
	<tr>
		<td></td>
		<td height=30><input type=submit value='提交添加'> <input
			type=reset value='重新填写'> <input type=button name=go_back
			value='返回上一页' onClick="javascript:location.history.go(-1);"></td>
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