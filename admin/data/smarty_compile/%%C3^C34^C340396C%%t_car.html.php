<?php /* Smarty version 2.6.20, created on 2015-04-24 11:35:31
         compiled from t_car.html */ ?>
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
					<th>出发城市</th>
					<th>目的城市/地点</th>
					<th>人等</th>
					<th>报价</th>
					<th>公里数</th>
					<th>管理</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['scity']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['ecity']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['num']; ?>
</td>
					<td>￥<?php echo $this->_tpl_vars['web']['price']; ?>
元</td>
					<td><?php echo $this->_tpl_vars['web']['distance']; ?>
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
					<td width="14%" align="right">标题名称：</td>
					<td width="86%"><input name="title" type="text" class="INPUT"
						id="title" value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">出发城市：</td>
					<td><input name="scity" type="text" class="INPUT"
						id="departure" value="<?php echo $this->_tpl_vars['info']['scity']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">到达城市：</td>
					<td><input name="ecity" type="text" class="INPUT" id="arrived"
						value="<?php echo $this->_tpl_vars['info']['ecity']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">途中时间：</td>
					<td><input name="times" type="text" class="INPUT" id="times"
						value="<?php echo $this->_tpl_vars['info']['times']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">公 里 数：</td>
					<td><input name="distance" type="text" class="INPUT"
						id="distance" value="<?php echo $this->_tpl_vars['info']['distance']; ?>
" size="20" maxlength="20">
						<span class="title3">km</span></td>
				</tr>
				<tr>
					<td align="right">人数/价格：</td>
					<td><input name="price1" type="text" class="INPUT"
						value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="10" maxlength="10"> <span
						class="title3">1人/元</span><input name="price2_5" type="text" class="INPUT"
						value="<?php echo $this->_tpl_vars['info']['price2_5']; ?>
" size="10" maxlength="10"><span class="title3">2-5人/元</span><input name="price6_9" type="text" class="INPUT"
						value="<?php echo $this->_tpl_vars['info']['price6_9']; ?>
" size="10" maxlength="10"><span class="title3">6-9人/元</span><input name="price10" type="text" class="INPUT"
						value="<?php echo $this->_tpl_vars['info']['price10']; ?>
" size="10" maxlength="10"><span class="title3">10人/元</span></td>
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