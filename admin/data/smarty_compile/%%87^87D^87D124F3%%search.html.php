<?php /* Smarty version 2.6.20, created on 2015-08-15 20:36:58
         compiled from search.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'search.html', 52, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<th>搜索匹配值</th>
		<th>搜索标题</th>
		<th>所属分类</th>
		<th>搜索key值</th>
		<th>排序</th>
		<th>管理</th>
	</tr>
	<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
	<tr align=center>
		<td><?php echo $this->_tpl_vars['web']['ckey']; ?>
</td>
		<td><?php echo $this->_tpl_vars['web']['ctitle']; ?>
</td>
		<td><?php echo $this->_tpl_vars['web']['ctype']; ?>
=><?php echo $this->_tpl_vars['web']['csearch']; ?>
</td>
		<td><?php echo $this->_tpl_vars['web']['cmin']; ?>
</td>
		<td><?php echo $this->_tpl_vars['web']['display']; ?>
</td>
		<td><a href='?action=edit&ckey=<?php echo $this->_tpl_vars['web']['ckey']; ?>
'>编辑</a> <a
			href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&ckey=<?php echo $this->_tpl_vars['web']['ckey']; ?>
"
			onclick="javascript:return del_nsort();">删除</a></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr class=tr1>
		<td colspan=8><?php echo $this->_tpl_vars['multipage']; ?>
</td>
	</tr>
</table>
<table width='90%' height=2>
	<tr class=bg>
		<td></td>
	</tr>
</table>
<?php else: ?>
<form name=add_frm action='?action=handle' method=post>
	<table cellspacing=1 cellpadding=4 class=table>
		<tr>
			<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
		</tr>
		<input type=hidden name='ckeys' value='<?php echo $this->_tpl_vars['info']['ckey']; ?>
'>
		<tr>
			<td width="14%" align="right">搜索匹配值：</td>
			<td width="86%"><input name="ckey" type="text" class="INPUT"
				id="ckey" value="<?php echo $this->_tpl_vars['info']['ckey']; ?>
" size="20" maxlength="20"<?php if ($this->_tpl_vars['info']['ckey'] != ''): ?>readonly<?php endif; ?>></td>
		</tr>
		<tr>
			<td width="14%" align="right">搜索标题：</td>
			<td width="86%"><input name="ctitle" type="text" class="INPUT"
				id="title" value="<?php echo $this->_tpl_vars['info']['ctitle']; ?>
" size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td align="right">所属分类：</td>
			<td><select name=ctype> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['ctype'],'selected' => $this->_tpl_vars['info']['ctype']), $this);?>

			</select> <select name=csearch> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['csearch'],'selected' => $this->_tpl_vars['info']['csearch']), $this);?>

			</select></td>
		</tr>
		<tr>
			<td align="right">排序：</td>
			<td><input name="display" type="text" value="<?php echo $this->_tpl_vars['info']['display']; ?>
"
				size="10"></td>
		</tr>
		<tr>
			<td align="right">key值：</td>
			<td><input name="keyname" type="text" class="INPUT" size="10"
				maxlength="10"><select name=cselected>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['cselected'],'selected' => $this->_tpl_vars['info']['cselected']), $this);?>

			</select><input type=button value="search"
				onclick="javascript:cselected_init();" />
				<div id="content"></div> <input name="cmin" type="text"
				class="INPUT" id="cmin" value="<?php echo $this->_tpl_vars['info']['cmin']; ?>
" size="40">(可手工输入：价格范围中间用,隔开)</td>
		</tr>


		<tr>
			<td></td>
			<td height=30><input type=button value='提交添加'
				onclick="tijiao();"> <input type=reset value='重新填写'>
				<input type=button name=go_back value='返回上一页'
				onClick="javascript:location.href='?c_id=0';"></td>
		</tr>

	</table>

	<script language=javascript>
		var ckey = $("input[name='ckey']");
		ckey_init();
		ckey.blur(ckey_init);
		function ckey_init() {
			$.getJSON("getajax.php?q=getsearchhtml&ckeys=<?php echo $this->_tpl_vars['info']['ckey']; ?>
&ckey="
					+ ckey.val(), function(data) {
				ckey.attr('value', data.html);
			});
		}

		function cselected_init() {
			var keyname = $("input[name='keyname']");
			var cselected = $("select[name='cselected']");
			var url = "getajax.php?q=getcmin&cmin=<?php echo $this->_tpl_vars['info']['cmin']; ?>
&cselected="
					+ cselected.val()+"&keyname="+keyname.val();
			$("#content").load(url);
		}

		var ctitle = $("input[name='ctitle']");
		var cmin = $("input[name='cmin']");

		function tijiao() {
			if (ckey.val() == "") {
				alert("搜索匹配值不能为空");
				return false;
			}
			if (ctitle.val() == "") {
				alert("请输入标题");
				return false;
			} else {
				$("form[name='add_frm']").submit();
			}

		}
	</script>

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