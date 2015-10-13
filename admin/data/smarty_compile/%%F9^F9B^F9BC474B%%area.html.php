<?php /* Smarty version 2.6.20, created on 2015-07-22 23:53:42
         compiled from ./area.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', './area.html', 53, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>

<table width="100%" border="0" cellpadding="2" cellspacing="1"
	class="table">
	<tbody>
		<tr>
			<th>ID</th>
			<th>图片</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
名称</th>
			<th>所属区域</th>
			<th>编辑者</th>
			<th>浏览</th>
			<th>管理</th>
		</tr>
		<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['contact']):
        $this->_foreach['outer']['iteration']++;
?>
		<tr align="center">
			<td><?php echo $this->_tpl_vars['contact']['id']; ?>
</td>
			<td><img src="<?php echo $this->_tpl_vars['contact']['url']; ?>
" width="210" height="120"
				border="0"></td>
			<td><?php echo $this->_tpl_vars['contact']['title']; ?>
<?php if ($this->_tpl_vars['contact']['hits'] == '1'): ?><font color=red>(热门)</font><?php endif; ?></td>
			<td><?php echo $this->_tpl_vars['contact']['classid']; ?>
<?php if ($this->_tpl_vars['contact']['pidname'] != ''): ?>=><?php echo $this->_tpl_vars['contact']['pidname']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['contact']['classid1'] != ''): ?>(<?php echo $this->_tpl_vars['contact']['classid1']; ?>
)<?php endif; ?></td>
			<td><?php echo $this->_tpl_vars['contact']['op_user']; ?>
</td>
			<td><?php echo $this->_tpl_vars['contact']['viewnum']; ?>
</td>
			<td><a
				href="?action=edit&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&id=<?php echo $this->_tpl_vars['contact']['id']; ?>
">编辑</a>
				<a href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&id=<?php echo $this->_tpl_vars['contact']['id']; ?>
"
				onClick="javascript:return del_nsort();">删除</a></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr class=tr1>
			<td colspan=7><?php echo $this->_tpl_vars['multipage']; ?>
</td>
		</tr>
</table>


<?php else: ?>

<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
	</tr>
	<form name=add_frm action='?action=handle' method='post' enctype="multipart/form-data">
		<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'> <input type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'>
		<tr>
			<td><?php echo $this->_tpl_vars['tit']; ?>
标题：</td>
			<td><input type=text name=title size=60 maxlength=40
				value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;<font class=red>*</font></td>
		</tr>
		<tr>
			<td><?php echo $this->_tpl_vars['tit']; ?>
分类：</td>
			<td><select name=classid> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['area'],'selected' => $this->_tpl_vars['info']['classid']), $this);?>

			</select>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['types'] != '0'): ?><select name=pid>
			</select><?php endif; ?><font class=red>*</font></td>
		</tr>
		<?php if ($this->_tpl_vars['types'] != '0'): ?>
		<tr>
			<td>所属地区：</td>
			<td><select name=classid1>
					<option value="0">无</option> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['area2'],'selected' => $this->_tpl_vars['info']['classid1']), $this);?>

			</select></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td valign=top><?php echo $this->_tpl_vars['tit']; ?>
说明：</td>
			<td><textarea name=word style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['word']; ?>
</textarea></td>
		</tr>
		<tr>
			<td valign=top>注意事项：</td>
			<td><textarea name=attention
					style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['attention']; ?>
</textarea></td>
		</tr>
		<tr>
			<td valign=top>旅游指南：</td>
			<td><textarea name=info style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['info']; ?>
</textarea></td>
		</tr>
		<tr>
			<td>上传图片：</td>
			<td><input type=file name=pic size=40><?php if ($this->_tpl_vars['info']['id'] == ''): ?><input type="hidden" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php else: ?>图片：<input type="text" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php endif; ?></td>
		</tr>

		<tr>
			<td>信息控制：</td>
			<td><input type="checkbox" name="status" <?php if ($this->_tpl_vars['info']['status'] == '1'): ?>checked<?php endif; ?> value='1'>开通&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hits" <?php if ($this->_tpl_vars['info']['hits'] == '1'): ?>checked<?php endif; ?> value="1">热门</td>
		</tr>
		<tr>
			<td></td>
			<td height=30><input type=submit value='提交添加'> <input
				type=reset value='重新填写'> <input type=button name=go_back
				value='返回上一页' onClick="javascript:history.back(1);"></td>
		</tr>
	</form>
</table>
<script language=javascript>
	var classid=$("select[name='classid']");
	var pid=$("select[name='pid']");
	function classtype_init(){
		pid.empty();
		$.ajax({
		    type: "GET",
		    dataType: "json",
		    url: "getajax.php?q=getarea",
		    data: "classid=" + classid.val(),
		    complete: function(){},
		    success: function(data,textStatus){
				var pid_select="<?php echo $this->_tpl_vars['info']['pid']; ?>
";
					$.each(data,function(index,item){
						if (pid_select==index){
							pid.append("<option value='"+index+"'  selected=\"selected\">"+item+"</option>");
						}else{
							pid.append("<option value='"+index+"'>"+item+"</option>");
						}
					});
					hots_init();
		        }
			});
	}
	classtype_init();
	classid.change(function(){
		classtype_init();
	});
	</script>

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