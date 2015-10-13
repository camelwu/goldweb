<?php /* Smarty version 2.6.20, created on 2015-05-31 03:47:46
         compiled from hotel.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'hotel.html', 119, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['tit1']; ?>
管理</th>
			</tr>
			<tr>
				<td width="13%" align="right"><?php echo $this->_tpl_vars['tit']; ?>
名称：</td>
				<td width="87%"><?php echo $this->_tpl_vars['scenicinfo']['title']; ?>
&nbsp;|&nbsp;<a
					href="scenic.php?types=<?php echo $this->_tpl_vars['types']; ?>
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
				<table width="100%" border="0" cellpadding="2" cellspacing="1"
				class="table">
			<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hotel'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hotel']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['web']):
        $this->_foreach['hotel']['iteration']++;
?>
	
				<tr>
					<td align="right" class="style101">(<?php echo ($this->_foreach['hotel']['iteration']-1)+1; ?>
)<?php echo $this->_tpl_vars['tit1']; ?>
<?php if ($this->_tpl_vars['types'] == '4' && $this->_tpl_vars['ctype'] == '0'): ?>人等<?php else: ?>名称<?php endif; ?>：</td>
					<td ><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
					<?php if ($this->_tpl_vars['ctype'] == '1'): ?>
					<td colspan=2><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
"></td>
					<?php elseif ($this->_tpl_vars['types'] == '0'): ?>
					<td align="right" class="style100">显示:</td>
					<td><?php echo $this->_tpl_vars['Config']['pass'][$this->_tpl_vars['web']['pass']]; ?>
</td>
					<?php endif; ?>
				</tr>
				<?php if ($this->_tpl_vars['ctype'] == '0'): ?>
				<?php if ($this->_tpl_vars['types'] == '4'): ?>
    <td align="right"><span class="style100">一 等 餐： </span> </td>
    <td>旺午：
      <?php echo $this->_tpl_vars['web']['ywn']; ?>

      &nbsp;&nbsp;旺晚：
      <?php echo $this->_tpl_vars['web']['ywd']; ?>

      &nbsp;&nbsp;淡午：
      <?php echo $this->_tpl_vars['web']['ydn']; ?>

      &nbsp;&nbsp;淡晚：
      <?php echo $this->_tpl_vars['web']['ydd']; ?>
</td>
  </tr>
  <tr>
    <td align="right" class="style100">二 等 餐：</td>
    <td>旺午：
      <?php echo $this->_tpl_vars['web']['ewn']; ?>

      &nbsp;&nbsp;旺晚：
     <?php echo $this->_tpl_vars['web']['ewd']; ?>

      &nbsp;&nbsp;淡午：
      <?php echo $this->_tpl_vars['web']['edn']; ?>

      &nbsp;&nbsp;淡晚：
     <?php echo $this->_tpl_vars['web']['edd']; ?>
</td>
  </tr>
  <tr>
    <td align="right" class="style100">三 等 餐：</td>
    <td>旺午：
      <?php echo $this->_tpl_vars['web']['swn']; ?>

      &nbsp;&nbsp;旺晚：
      <?php echo $this->_tpl_vars['web']['swd']; ?>

      &nbsp;&nbsp;淡午：
      <?php echo $this->_tpl_vars['web']['sdn']; ?>

      &nbsp;&nbsp;淡晚：
      <?php echo $this->_tpl_vars['web']['sdd']; ?>
</td>
  </tr>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['web']['url'] != '' && $this->_tpl_vars['web']['url'] != null): ?><tr>
					<td align="right">图片：</td><td colspan="3"><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
"></td>
				</tr><?php endif; ?>
				<tr>
					<td align="right" class="style100">团队报价：</td>
					<td >旺季： <?php echo $this->_tpl_vars['web']['tw']; ?>
 &nbsp;&nbsp;平季：<?php echo $this->_tpl_vars['web']['tp']; ?>
 &nbsp;&nbsp;淡季：<?php echo $this->_tpl_vars['web']['td']; ?>
</td>
					<td align="right" class="style100">宽带：</td>
					<td><?php echo $this->_tpl_vars['Config']['net'][$this->_tpl_vars['web']['net']]; ?>
</td>
				</tr>
				<tr>
					<td width="13%" align="right" class="style100">散客报价：</td>
					<td height="25">旺季： <?php echo $this->_tpl_vars['web']['sw']; ?>
 &nbsp;&nbsp;平季： <?php echo $this->_tpl_vars['web']['sp']; ?>
 &nbsp;&nbsp;淡季： <?php echo $this->_tpl_vars['web']['sd']; ?>
</td>
					<td align="right"><span class="style100">早餐：</span></td>
					<td><?php echo $this->_tpl_vars['Config']['zao'][$this->_tpl_vars['web']['zao']]; ?>
</td>
				</tr>
				<tr>
					<td align="right" class="style100">客房介绍：</td>
					<td> <?php echo $this->_tpl_vars['web']['info']; ?>
</td>
					<td align="right" class="style100">温馨提示：</td>
					<td> <?php echo $this->_tpl_vars['web']['info1']; ?>
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
					<?php if ($this->_tpl_vars['types'] != '4'): ?>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<?php endif; ?>
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
					<td align="right" class="style101"><?php echo $this->_tpl_vars['tit1']; ?>
<?php if ($this->_tpl_vars['types'] == '4' && $this->_tpl_vars['ctype'] == '0'): ?>人等<?php else: ?>名称<?php endif; ?>：</td>
					<td ><input name="title" type="text" class="INPUT"
						 value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="20"><?php if ($this->_tpl_vars['types'] == '4'): ?>例如：1或者2~5<?php endif; ?></td>
						<?php if ($this->_tpl_vars['ctype'] == '0' && $this->_tpl_vars['types'] != '4'): ?>
					<td  align="right" class="style100">显示:</td>
					<td ><select name="pass" class="input" id="pass"
						style="width: 92px;">
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['pass'],'selected' => $this->_tpl_vars['info']['pass']), $this);?>

					</select></td>
					<?php endif; ?>
					
				</tr>
				<tr>
					<td align="right">图片上传：</td>
					<td colspan="3"><input type=file name=pic size=40><input
						type=hidden name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
				</tr>
				
				<?php if ($this->_tpl_vars['ctype'] == '0'): ?>
				<?php if ($this->_tpl_vars['types'] == '4'): ?>
				  <tr>
    <td align="right"><span class="style100">一 等 餐： </span> </td>
    <td>旺午：
      <input name="ywn" type="text" class="INPUT" id="ywn" size="15" value="<?php echo $this->_tpl_vars['info']['ywn']; ?>
">
      &nbsp;&nbsp;旺晚：
      <input name="ywd" type="text" class="INPUT" id="ywd" size="15" value="<?php echo $this->_tpl_vars['info']['ywd']; ?>
">
      &nbsp;&nbsp;淡午：
      <input name="ydn" type="text" class="INPUT" id="ydn" size="15" value="<?php echo $this->_tpl_vars['info']['ydn']; ?>
">
      &nbsp;&nbsp;淡晚：
      <input name="ydd" type="text" class="INPUT" id="ydd" size="15" value="<?php echo $this->_tpl_vars['info']['ydd']; ?>
"></td>
  </tr>
  <tr>
    <td align="right" class="style100">二 等 餐：</td>
    <td>旺午：
      <input name="ewn" type="text" class="INPUT" id="ewn" size="15" value="<?php echo $this->_tpl_vars['info']['ewn']; ?>
">
      &nbsp;&nbsp;旺晚：
      <input name="ewd" type="text" class="INPUT" id="ewd" size="15" value="<?php echo $this->_tpl_vars['info']['ewd']; ?>
">
      &nbsp;&nbsp;淡午：
      <input name="edn" type="text" class="INPUT" id="edn" size="15" value="<?php echo $this->_tpl_vars['info']['edn']; ?>
">
      &nbsp;&nbsp;淡晚：
      <input name="edd" type="text" class="INPUT" id="edd" size="15" value="<?php echo $this->_tpl_vars['info']['edd']; ?>
"></td>
  </tr>
  <tr>
    <td align="right" class="style100">三 等 餐：</td>
    <td>旺午：
      <input name="swn" type="text" class="INPUT" id="swn" size="15" value="<?php echo $this->_tpl_vars['info']['swn']; ?>
">
      &nbsp;&nbsp;旺晚：
      <input name="swd" type="text" class="INPUT" id="swd" size="15" value="<?php echo $this->_tpl_vars['info']['swd']; ?>
">
      &nbsp;&nbsp;淡午：
      <input name="sdn" type="text" class="INPUT" id="sdn" size="15" value="<?php echo $this->_tpl_vars['info']['sdn']; ?>
">
      &nbsp;&nbsp;淡晚：
      <input name="sdd" type="text" class="INPUT" id="sdd" size="15" value="<?php echo $this->_tpl_vars['info']['sdd']; ?>
"></td>
  </tr>
				
				<?php else: ?>
				<tr>
					<td width="13%" align="right" class="style100">团队报价：</td>
					<td height="25">旺季： <input name="tw" type="text" class="INPUT"
						id="tw" onKeyUp='this.value=this.value.replace(/\D/gi,"")'
						value="<?php echo $this->_tpl_vars['info']['tw']; ?>
" size="15"> &nbsp;&nbsp;平季： <input name="tp"
						type="text" class="INPUT" id="tp"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['tp']; ?>
"
						size="15"> &nbsp;&nbsp;淡季： <input name="td" type="text"
						class="INPUT" id="td"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['td']; ?>
"
						size="15"></td>
					<td align="right" class="style100">宽带：</td>
					<td><select name="net" class="input" id="net"
						style="width: 92px;">
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['net'],'selected' => $this->_tpl_vars['info']['net']), $this);?>

					</select></td>
				</tr>
				<tr>
					<td width="13%" align="right" class="style100">散客报价：</td>
					<td height="25">旺季： <input name="sw" type="text" class="INPUT"
						id="sw" onKeyUp='this.value=this.value.replace(/\D/gi,"")'
						value="<?php echo $this->_tpl_vars['info']['sw']; ?>
" size="15"> &nbsp;&nbsp;平季： <input name="sp"
						type="text" class="INPUT" id="sp"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['sw']; ?>
"
						size="15"> &nbsp;&nbsp;淡季： <input name="sd" type="text"
						class="INPUT" id="sd"
						onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['sd']; ?>
"
						size="15"></td>
					<td align="right"><span class="style100">早餐：</span></td>
					<td><select name="zao" class="input" id="zao"
						style="width: 92">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['zao'],'selected' => $this->_tpl_vars['info']['zao']), $this);?>

					</select></td>
				</tr>
				<tr>
					<td align="right" class="style100">客房介绍：</td>
					<td><textarea name="info" cols="65" rows="3" class="INPUT"
							id="info"><?php echo $this->_tpl_vars['info']['info']; ?>
</textarea></td>
					<td align="right" class="style100">温馨提示：</td>
					<td><textarea name="info1" cols="50" rows="3" class="INPUT"
							id="info1"><?php echo $this->_tpl_vars['info']['info1']; ?>
</textarea></td>
				</tr>
				<?php endif; ?>
				<?php endif; ?>
				<tr>
					<td></td>
					<td><input type="submit"  value="提  交"> </td>
					<?php if ($this->_tpl_vars['ctype'] == '0' && $this->_tpl_vars['types'] != '4'): ?>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<?php endif; ?>
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