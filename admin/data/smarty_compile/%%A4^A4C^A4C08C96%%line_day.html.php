<?php /* Smarty version 2.6.20, created on 2015-08-12 17:02:30
         compiled from line_day.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'line_day.html', 80, false),array('function', 'html_checkboxes', 'line_day.html', 87, false),)), $this); ?>
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
		<td>&nbsp;<a href="?routeid=<?php echo $this->_tpl_vars['routeid']; ?>
&action=add">添加<?php echo $this->_tpl_vars['tit1']; ?>
</a>&nbsp;|&nbsp;<a
			href="?routeid=<?php echo $this->_tpl_vars['routeid']; ?>
"><?php echo $this->_tpl_vars['tit1']; ?>
管理</a></td>
	</tr>
</table>
<?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table width="100%" border="0" cellpadding="2" cellspacing="1"
	class="table">
	<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['web']):
        $this->_foreach['list']['iteration']++;
?>

	<tr>
		<td width="13%" align="right" class="style101">(<?php echo ($this->_foreach['list']['iteration']-1)+1; ?>
)</td>
		<td>第：<?php echo $this->_tpl_vars['web']['num']; ?>
天</td>
	</tr>
	<tr>
		<td align="right">显示图片:</td>
		<td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
"></td>
	</tr>
	<tr>
		<td align="right">详细内容：</td>
		<td><div id="d1">
				<strong>离城市：</strong><?php echo $this->_tpl_vars['web']['departure']; ?>
 <strong>时间：</strong><?php echo $this->_tpl_vars['web']['timd']; ?>

				<br> <strong>抵城市：</strong><?php echo $this->_tpl_vars['web']['arrived']; ?>
 <strong>时间：</strong><?php echo $this->_tpl_vars['web']['tima']; ?>

				<br> <strong>行：</strong><?php echo $this->_tpl_vars['Config']['traffic'][$this->_tpl_vars['web']['traffic']]; ?>
 : <?php echo $this->_tpl_vars['web']['tname']; ?>
 <br> <strong>食</strong>：<?php echo $this->_tpl_vars['web']['eats']; ?>

				<br> <strong>住：</strong><?php echo $this->_tpl_vars['web']['hotel']; ?>

				<br> <strong>娱：</strong><?php echo $this->_tpl_vars['web']['scenic']; ?>
 <br>
				<?php echo $this->_tpl_vars['web']['content']; ?>

			</div></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="button" name="button"
			onClick="javascript:window.location='?sid=<?php echo $this->_tpl_vars['web']['sid']; ?>
&routeid=<?php echo $this->_tpl_vars['routeid']; ?>
&action=add'"
			value="修 改"> <input name="delete" type="button" id="delete2"
			value="删 除"
			onClick="window.location='?sid=<?php echo $this->_tpl_vars['web']['sid']; ?>
&routeid=<?php echo $this->_tpl_vars['routeid']; ?>
&action=delete';"></td>

	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<form name="myform_1" method="post" action="?action=handle"
	enctype="multipart/form-data">
	<input type=hidden name="routeid" value="<?php echo $this->_tpl_vars['routeid']; ?>
"> <input
		type="hidden" name="sid" value="<?php echo $this->_tpl_vars['info']['sid']; ?>
">
	<table width="100%" border="0" cellpadding="2" cellspacing="1"
		class="table">
		<tr>
			<td width="13%" align="right" class="style101">第：</td>
			<td><input name="num" type="text" class="INPUT"
				value="<?php echo $this->_tpl_vars['info']['num']; ?>
" size="2">天</td>
		</tr>
		<tr>
			<td align="right">图片上传：</td>
			<td><input type=file name=pic size=40><input type=hidden
				name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
		</tr>
		<tr>
			<td align="right">详细行程：</td>
			<td>离城市：<input name="departure" type="text" class="INPUT"
				id="departure01" maxlength="10" value="<?php echo $this->_tpl_vars['info']['departure']; ?>
">
				时间：<input name="timd" type="text" class="INPUT"
				value="<?php echo $this->_tpl_vars['info']['timd']; ?>
"><br> 抵城市：<input name="arrived"
				type="text" id="arrived01" maxlength="60" value="<?php echo $this->_tpl_vars['info']['arrived']; ?>
">
				时间：<input name="tima" type="text" class="INPUT"
				value="<?php echo $this->_tpl_vars['info']['tima']; ?>
"> 注：可多个抵达城市，用|分隔<br> <strong>行</strong>：
				<select name=traffic>
					<option value="">无</option> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['traffic'],'selected' => $this->_tpl_vars['info']['traffic']), $this);?>

			</select> <input name="tnames" type="text"><input type="button"
				value="search" onclick="javascript:trasearch();" />
				参考航班、火车等交通信息，如无可不填写。
				<div id="tname"></div>
				<input type="hidden" name="tnamesh" value="<?php echo $this->_tpl_vars['info']['tname']; ?>
" />
				<strong>食</strong>：<?php echo smarty_function_html_checkboxes(array('options' => $this->_tpl_vars['Config']['eats'],'checked' => $this->_tpl_vars['info']['eats'],'name' => 'eats'), $this);?>
 <br> <strong>住</strong>：<input
				type="text" name="hotel"  value="<?php echo $this->_tpl_vars['info']['hotel']; ?>
"><br> 
				<strong>娱：</strong>
				<input name="scenics" type="text"> <input type="button" id="s0" value="search" onclick="searchscenic();">
				<div id="scenic"></div>
				<input type="hidden" name="scenicsh" value="<?php echo $this->_tpl_vars['info']['scenic']; ?>
" />
				
				<br> <textarea name="content" id="cont1"
					style="width: 500px; height: 120px;"><?php echo $this->_tpl_vars['info']['content']; ?>
</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="提  交"></td>
		</tr>
	</table>
</form>
<script language=javascript>
	trasearch();
	function trasearch() {
		var traffic = $("select[name='traffic']").val();
		var tnames = $("input[name='tnames']").val();
		var tnamesh = $("input[name='tnamesh']").val();
		$("#tname").load(
				"getajax.php?q=gettrasearch&traffic=" + traffic + "&tnames="
						+ tnames + "&tnamesh=" + tnamesh);
	}
	
	searchscenic();
	function searchscenic() {
		var scenics = $("input[name='scenics']").val();
		var scenicsh = $("input[name='scenicsh']").val();
		$("#scenic").load(
				"getajax.php?q=searchscenic&scenics="
						+ scenics + "&scenicsh=" + scenicsh);
	}
	
	
	function del_nsort() {
		var cf = window.confirm("是否确定该操作？");
		return cf;
	}
</script>
<?php endif; ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>