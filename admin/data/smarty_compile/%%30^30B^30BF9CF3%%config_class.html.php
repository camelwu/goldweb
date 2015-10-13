<?php /* Smarty version 2.6.20, created on 2015-04-19 12:45:47
         compiled from config_class.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'config_class.html', 94, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table cellspacing="1" cellpadding="4" class="table">
	<tbody><tr><th colspan="2"><?php echo $this->_tpl_vars['tit']; ?>
管理</th></tr>
	<tr><td align="center" colspan="2" height="30">
	<table border="0">
	<tbody><tr>
	<td><a href="?classtype=<?php echo $this->_tpl_vars['classtype']; ?>
&pid=<?php echo $this->_tpl_vars['pid']; ?>
"><?php echo $this->_tpl_vars['tit']; ?>
列表</a></td>
	<td width="10"></td>
	<td><a href="?action=add&amp;classtype=<?php echo $this->_tpl_vars['classtype']; ?>
&amp;pid=<?php echo $this->_tpl_vars['pid']; ?>
">添加<?php echo $this->_tpl_vars['tit']; ?>
</a></td>
	</tr>
	</tbody></table>
	</td></tr>
	<tr><td align="center">
	<table border="0" cellspacing="0" cellpadding="2">
	<form action="?action=list" method="get"></form>
	<input type="hidden" name="classtype" value="<?php echo $this->_tpl_vars['classtype']; ?>
">
	<input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['pid']; ?>
">
	<tbody><tr>
	<td>搜索（<?php echo $this->_tpl_vars['tit']; ?>
） 关键字：</td>
	<td><input type="text" name="keyword" value="" size="15" maxlength="20"></td>
	<td><input type="submit" value="搜索"></td>
	</tr>
	
	</tbody></table>
	</td></tr>
</tbody></table>
        <?php if ($this->_tpl_vars['action'] == 'list'): ?>
		<table cellspacing=1 cellpadding=4 class=table>
			<tr>
				<th colspan="2">分类管理</th>
			</tr>
			<tr valign="top">
				<td width="20%">
					<table class="table2" align="center">
						<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['contact']):
        $this->_foreach['outer']['iteration']++;
?>
						<tr>
							<td colspan=2><img border=0 src='css/images/s_nsort.gif' align=absmiddle>&nbsp;<a href='?classtype=<?php echo $this->_tpl_vars['contact']['id']; ?>
&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
'<?php if ($this->_tpl_vars['classtype'] == $this->_tpl_vars['contact']['id']): ?>class='red2'<?php endif; ?>><?php echo $this->_tpl_vars['contact']['name']; ?>
</a></td>
						</tr>
						<tr>
							<td width=15></td>
							<td><?php $_from = $this->_tpl_vars['contact']['p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?> <img
								border=0 src='css/images/s_left_sort.gif' align=absmiddle>&nbsp;<a
								href='?classtype=<?php echo $this->_tpl_vars['contact']['id']; ?>
&pid=<?php echo $this->_tpl_vars['key']; ?>
&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
'<?php if ($this->_tpl_vars['pid'] == $this->_tpl_vars['key']): ?>class='red2'<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</a><br> <?php endforeach; endif; unset($_from); ?>
							</td>
						</tr>
						<?php endforeach; endif; unset($_from); ?>

					</table>
				</td>
				<td>
					<table cellspacing=1 cellpadding=3 class=table0>
						<tr align=center>
							<td class=td>排序</td>
							<td class=td width='70%'><?php echo $this->_tpl_vars['tit']; ?>
名称</td>
							<td class=td>相关操作</td>
						</tr>
						<?php $_from = $this->_tpl_vars['resu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
						<tr>
						<td align=center><?php echo $this->_tpl_vars['web']['hots']; ?>
</td>
							<td>&nbsp;<img border=0 src='css/images/s_left.gif'
								align=absmiddle>&nbsp;<font class=red2><b><?php echo $this->_tpl_vars['web']['title']; ?>
</b></font></td>
							<td>&nbsp;<a href='?classtype=<?php echo $this->_tpl_vars['web']['classtype']; ?>
&pid=<?php echo $this->_tpl_vars['web']['pid']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&action=editc&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
'>编辑</a> &nbsp;
							<a href='?classtype=<?php echo $this->_tpl_vars['web']['classtype']; ?>
&pid=<?php echo $this->_tpl_vars['web']['pid']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&action=del&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
' onclick="javascript:return del_nsort('<?php echo $this->_tpl_vars['web']['title']; ?>
','<?php echo $this->_tpl_vars['web']['pid']; ?>
');">删除</a>
								&nbsp;<a href='?classtype=<?php echo $this->_tpl_vars['web']['classtype']; ?>
&pid=<?php echo $this->_tpl_vars['web']['pid']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&action=up&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
'><img border=0
									src='css/images/up_1.gif' alt='向上移动此主分类' align=absmiddle></a>
								&nbsp;<a href='?classtype=<?php echo $this->_tpl_vars['web']['classtype']; ?>
&pid=<?php echo $this->_tpl_vars['web']['pid']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&action=down&nsort=<?php echo $this->_tpl_vars['nsort']; ?>
'><img border=0
									src='css/images/down_1.gif' alt='向下移动此主分类' align=absmiddle></a>
							</td>
						</tr>
						<?php endforeach; endif; unset($_from); ?>
					</table>
				</td>
			</tr>
		</table>
		<?php else: ?>
		<table cellspacing=1 cellpadding=3 class=table>
			<tr>
				<td class=td width='20%'></td>
				<td class=td width='80%'><?php echo $this->_tpl_vars['tit']; ?>
分类</td>
			</tr>
			<form name=add_frm action='?action=addc' method=post>
				<input type=hidden name='id' value='<?php echo $this->_tpl_vars['info']['id']; ?>
'>
				<input type=hidden name='pid' value='<?php echo $this->_tpl_vars['pid']; ?>
'>
				<tr>
					<td><?php echo $this->_tpl_vars['tit']; ?>
名称：</td>
					<td><input type=text name=title size=30
						value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;<font class=red>*</font>&nbsp;</td>
				</tr>
				<tr>
					<td>上级分类：</td>
					<td><select name=classtype> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['Config']['web'],'selected' => $this->_tpl_vars['info']['classtype']), $this);?>

					</select>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['pid'] != '0'): ?><select name=pid>
					</select><?php endif; ?></td>
				</tr>
				<tr>
					<td>排序：</td>
					<td><input type=text name=hots size=12 value='<?php echo $this->_tpl_vars['info']['hots']; ?>
'></td>
				</tr>
				<tr>
					<td>静态化页面前缀：</td>
					<td><input type=text name=html size=30 value='<?php echo $this->_tpl_vars['info']['html']; ?>
'>&nbsp;<font
						class=red>*</font>(前缀重复系统自动赋值)</td>
				</tr>
				<tr>
					<td></td>
					<td height=30><input type=submit value='提交添加'> <input
						type=reset value='重新填写'> <input type=button name=go_back
						value='返回上一页' onclick=javascript:history.back(1);></td>
				</tr>
			</form>
		</table>
		</table>
		<?php endif; ?>
	<script language=javascript>
	var classtype=$("select[name='classtype']");
	var pid=$("select[name='pid']");
	var id=$("input[name='id']");
	var hots=$("input[name='hots']");
	var html=$("input[name='html']");
	function classtype_init(){
		pid.empty();
		$.ajax({
		    type: "GET",
		    dataType: "json",
		    url: "getajax.php?q=getclasstype",
		    data: "classtype=" + classtype.val(),
		    complete: function(){},
		    success: function(data,textStatus){
				var pid_select="<?php echo $this->_tpl_vars['pid']; ?>
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
	classtype.change(function(){
		classtype_init();
	});
	pid.change(function(){
		hots_init();
	});
	
	function hots_init(){
		$.getJSON("getajax.php?q=gethot&classtype="+classtype.val()+"&pid="+pid.val()+"&hots="+hots.val()+"&id="+id.val(), function(data){
			hots.attr('value',data.hots);	
		});
	}
	
	html_init();
	html.blur(html_init);
	function html_init(){
		$.getJSON("getajax.php?q=gethtml&id="+id.val()+"&html="+html.val(), function(data){
			html.attr('value',data.html);
		});
	}
function del_nsort(t2,t3){
 if (t3=="0")
 {
   var cf=window.confirm("您确定要删除主分类（"+t2+"）吗？\n其下的二级分类也将一并删除！\n\n删除后将不可恢复！是否确定该操作？");
   if (cf)
   { return true; }
   else
   { return false; }
 }
 else
 {
   var cf1=window.confirm("您确定要删除二级分类（"+t2+"）吗？\n\n删除后将不可恢复！是否确定该操作？");
   if (cf1)
   { return true; }
   else
   { return false; }
 }
 return false;
}
-->
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>