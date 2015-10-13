<?php /* Smarty version 2.6.20, created on 2015-08-04 20:06:41
         compiled from t_plane.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 't_plane.html', 62, false),)), $this); ?>
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
					<th>航班号</th>
					<th>机票类型</th>
					<th>航空公司</th>
					<th>机场</th>
					<th>出发城市</th>
					<th>到达城市</th>
					<th>出发时间</th>
					<th>抵达时间</th>
					<th>报价</th>
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
					<td><?php echo $this->_tpl_vars['Config']['plane'][$this->_tpl_vars['web']['type']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['line'][$this->_tpl_vars['web']['lid']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['port'][$this->_tpl_vars['web']['pid']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['scity']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['ecity']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['times']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['timee']; ?>
</td>
					<td>经济舱：￥<?php echo $this->_tpl_vars['web']['price']; ?>
元<br> 商务舱：￥<?php echo $this->_tpl_vars['web']['price1']; ?>
元<br>
						头等舱：￥<?php echo $this->_tpl_vars['web']['price2']; ?>
元
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
					<td colspan=11><?php echo $this->_tpl_vars['multipage']; ?>
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
					<td width="14%" align="right">航班号：</td>
					<td width="86%"><input name="title" type="text" class="INPUT"
						id="title" value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="40"></td>
				</tr>
				<tr>
					<td align="right">机票类型：</td>
					<td><select name='type' id='type'> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['plane'],'selected' => $this->_tpl_vars['info']['type']), $this);?>

					</select></td>
				</tr>
				<tr>
					<td align="right">航空公司：</td>
					<td><select name='lid' id='lid'> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['line'],'selected' => $this->_tpl_vars['info']['lid']), $this);?>

					</select></td>
				</tr>
				<tr>
					<td align="right">机场：</td>
					<td><select name='pid' id='pid'> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['port'],'selected' => $this->_tpl_vars['info']['pid']), $this);?>

					</select></td>
				</tr>
				<tr>
					<td align="right">出发城市：</td>
					<td><input name="scity" type="text" class="INPUT" id="scity"
						value="<?php echo $this->_tpl_vars['info']['scity']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">中转城市：</td>
					<td><input name="city" type="text" class="INPUT" id="scity"
						value="<?php echo $this->_tpl_vars['info']['city']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">到达城市：</td>
					<td><input name="ecity" type="text" class="INPUT" id="ecity"
						value="<?php echo $this->_tpl_vars['info']['ecity']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">出发时间：</td>
					<td><input name="times" type="text" class="INPUT" id="times"
						value="<?php echo $this->_tpl_vars['info']['times']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">抵达时间：</td>
					<td><input name="timee" type="text" class="INPUT" id="timee"
						value="<?php echo $this->_tpl_vars['info']['timee']; ?>
" size="20" maxlength="20"></td>
				</tr>
				<tr>
					<td align="right">运行时间：</td>
					<td><input name="num" type="text" class="INPUT" id="num"
						value="<?php echo $this->_tpl_vars['info']['num']; ?>
" size="2" maxlength="2"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")'><span
						class="title3"> 如第二天抵达请输入1，第三天抵达请输入2；前台自动增加“+”</span></td>
				</tr>
				<tr>
					<td align="right">预订价格：</td>
					<td>经济舱:<input name="price" type="text" class="INPUT"
						id="price" value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="20" maxlength="10"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
						class="title3">元</span> 商务舱:<input name="price1" type="text"
						class="INPUT" id="price1" value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="20"
						maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
						<span class="title3">元</span> 头等舱:<input name="price2" type="text"
						class="INPUT" id="price2" value="<?php echo $this->_tpl_vars['info']['price2']; ?>
" size="20"
						maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
						<span class="title3">元</span>
					</td>
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
						value='返回上一页' onclick="javascript:location.href='?c_id=0';"></td>
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