<?php /* Smarty version 2.6.20, created on 2015-04-09 07:14:27
         compiled from guide.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'guide.html', 51, false),array('function', 'html_checkboxes', 'guide.html', 59, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['action'] == 'list'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<tr>
				<th>ID</th>
				<th><?php echo $this->_tpl_vars['tit']; ?>
姓名</th>
				<th>图片</th>
				<th>电话</th>
				<th>服务语种</th>
				<th>所在地区</th>
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
				<td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
" width=150 height="150"></td>
				<td><?php echo $this->_tpl_vars['web']['tel']; ?>
</td>
				<td><?php echo $this->_tpl_vars['web']['language']; ?>
</td>
				<td><?php echo $this->_tpl_vars['area'][$this->_tpl_vars['web']['cid']]; ?>
-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['aid']]; ?>
-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['city']]; ?>
</td>
				<td><a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['web']['types']; ?>
'>编辑</a>
					<a href="?action=delete&types=<?php echo $this->_tpl_vars['web']['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
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
		<table cellspacing=1 cellpadding=4 class=table>
			<tr>
				<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
			</tr>
			<form name=add_frm action='?action=handle' method=post
				enctype="multipart/form-data">
				<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'> <input
					type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'>
				<tr>
					<td><?php echo $this->_tpl_vars['tit']; ?>
姓名：</td>
					<td><input type=text name=title size=60
						value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;<font class=red>*</font></td>
				</tr>
			<tr>
				<td>所在地区：</td>
				<td><select name='cid' id='cid'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['area'],'selected' => $this->_tpl_vars['info']['cid']), $this);?>

				</select>&nbsp;&nbsp;&nbsp;&nbsp;<select name=aid>
				</select> <select name=city>
				</select></td>
			</tr>
			<tr>
				<td>服务语种：</td>
				<td><?php echo smarty_function_html_checkboxes(array('name' => 'language','options' => $this->_tpl_vars['language'],'checked' => $this->_tpl_vars['info']['language'],'separator' => "&nbsp;"), $this);?>
</td>
			</tr>
			<tr>
				<td>联系电话：</td>
				<td><input type=text name=tel size=20 value='<?php echo $this->_tpl_vars['info']['tel']; ?>
'></td>
			</tr>
			<tr>
				<td>销售底价：</td>
				<td><input name="price" type="text" class="INPUT" id="price"
					value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="12" maxlength="10"
					onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
					class="title3">元/天</span> 门市价格:<input name="price1" type="text"
					class="INPUT" id="price1" value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="12"
					maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
					<span class="title3">元/天</td>
			</tr>
			<tr>
				<td>图片上传：</td>
				<td><input type=file name=pic size=40><input
					type=hidden name=url value="<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
			</tr>
			<tr>
				<td><?php echo $this->_tpl_vars['tit']; ?>
介绍：</td>
				<td><textarea name=contents
						style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['contents']; ?>
</textarea></td>
			</tr>

			<td></td>
			<td height=30><input type=submit value='提交添加'> <input
				type=reset value='重新填写'> <input type=button name=go_back
				value='返回上一页' onclick="javascript:location.href='?c_id=0';"></td>
			</tr>
			</form>
		</table>

		<script language=javascript>
	var cid=$("select[name='cid']");
	var aid=$("select[name='aid']");
	var city=$("select[name='city']");
	function cid_init(){
		aid.empty();
		$.ajax({
		    type: "GET",
		    dataType: "json",
		    url: "getajax.php?q=getarea",
		    data: "classid=" + cid.val(),
		    complete: function(){},
		    success: function(data,textStatus){
				var pid_select="<?php echo $this->_tpl_vars['info']['aid']; ?>
";
					$.each(data,function(index,item){
						if (pid_select==index){
							aid.append("<option value='"+index+"'  selected=\"selected\">"+item+"</option>");
						}else{
							aid.append("<option value='"+index+"'>"+item+"</option>");
						}
					});
					aid_init();
		        }
			});
	}
	cid_init();
	cid.change(function(){
		cid_init();
	});
	aid.change(function(){
		aid_init();
	});
	function aid_init(){
		city.empty();
		$.ajax({
		    type: "GET",
		    dataType: "json",
		    url: "getajax.php?q=getarea&types=1",
		    data: "classid=" + cid.val()+"&pid="+aid.val(),
		    complete: function(){},
		    success: function(data,textStatus){
				var pid_select="<?php echo $this->_tpl_vars['info']['city']; ?>
";
					$.each(data,function(index,item){
						if (pid_select==index){
							city.append("<option value='"+index+"'  selected=\"selected\">"+item+"</option>");
						}else{
							city.append("<option value='"+index+"'>"+item+"</option>");
						}
					});
		        }
			});
	}
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