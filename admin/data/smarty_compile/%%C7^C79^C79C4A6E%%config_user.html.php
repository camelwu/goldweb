<?php /* Smarty version 2.6.20, created on 2015-04-26 14:34:51
         compiled from config_user.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'config_user.html', 63, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<form name=sel_form action='?action=delete' method=post>
		<tr>
			<th>ID</th>
			<th>USERID</th>
			<th>人员姓名</th>
			<th>级别</th>
			<th>所属机构</th>
			<th>登录次数</th>
			<th>上次登录时间</th>
			<th>上次登录IP</th>
			<th>状态</th>
			<th>管理</th>
		</tr>
		<?php if ($this->_tpl_vars['totalnum'] == 0): ?>
		<tr>
			<td colspan=9>没有数据</td>
		</tr>
		<?php else: ?> <?php unset($this->_sections['web']);
$this->_sections['web']['name'] = 'web';
$this->_sections['web']['loop'] = is_array($_loop=$this->_tpl_vars['comments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['web']['show'] = true;
$this->_sections['web']['max'] = $this->_sections['web']['loop'];
$this->_sections['web']['step'] = 1;
$this->_sections['web']['start'] = $this->_sections['web']['step'] > 0 ? 0 : $this->_sections['web']['loop']-1;
if ($this->_sections['web']['show']) {
    $this->_sections['web']['total'] = $this->_sections['web']['loop'];
    if ($this->_sections['web']['total'] == 0)
        $this->_sections['web']['show'] = false;
} else
    $this->_sections['web']['total'] = 0;
if ($this->_sections['web']['show']):

            for ($this->_sections['web']['index'] = $this->_sections['web']['start'], $this->_sections['web']['iteration'] = 1;
                 $this->_sections['web']['iteration'] <= $this->_sections['web']['total'];
                 $this->_sections['web']['index'] += $this->_sections['web']['step'], $this->_sections['web']['iteration']++):
$this->_sections['web']['rownum'] = $this->_sections['web']['iteration'];
$this->_sections['web']['index_prev'] = $this->_sections['web']['index'] - $this->_sections['web']['step'];
$this->_sections['web']['index_next'] = $this->_sections['web']['index'] + $this->_sections['web']['step'];
$this->_sections['web']['first']      = ($this->_sections['web']['iteration'] == 1);
$this->_sections['web']['last']       = ($this->_sections['web']['iteration'] == $this->_sections['web']['total']);
?>
		<tr align=center>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['username']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['position']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['bid']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['login_num']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['time2']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['login_ip']; ?>
</td>
			<td><?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['state']; ?>
</td>
			<td><a href='?action=edit&id=<?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['id']; ?>
'>编辑</a> <?php if ($this->_tpl_vars['comments'][$this->_sections['web']['index']]['id'] != $this->_tpl_vars['adminid'] && $this->_tpl_vars['comments'][$this->_sections['web']['index']]['id'] != '1'): ?><a
				href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&id=<?php echo $this->_tpl_vars['comments'][$this->_sections['web']['index']]['id']; ?>
"
				onclick="javascript:return del_nsort();">删除</a><?php endif; ?></td>
		</tr>
		<?php endfor; endif; ?> <?php endif; ?>
		<tr class=tr1>
			<td colspan=10><?php echo $this->_tpl_vars['multipage']; ?>
</td>

		</tr>
</table>
<?php else: ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<td class=td colspan=2><?php if ($this->_tpl_vars['info']['id'] > 0): ?>编辑<?php else: ?>添加<?php endif; ?>人员</td>
	</tr>
	<form name="section" action='?action=handle' method=post>
		<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'>
		<tr>
			<td>用户名：</td>
			<td><input type=text name=username size=20
				value='<?php echo $this->_tpl_vars['info']['username']; ?>
'<?php if ($this->_tpl_vars['info']['id'] > 0): ?>readonly<?php endif; ?>>&nbsp;<font class=red id="tishi">*</font></td>
		</tr>
		<tr>
			<td>人员姓名：</td>
			<td><input type=text name=name size=20 value='<?php echo $this->_tpl_vars['info']['name']; ?>
'>&nbsp;<font
				class=red>*</font></td>
		</tr>
		<tr>
			<td>所属机构：</td>
			<td><select name=bid>
					<option value='0'>无</option> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cg_branch'],'selected' => $this->_tpl_vars['info']['bid']), $this);?>

			</select></td>
		</tr>
		<tr>
			<td>登陆密码：</td>
			<td><input type=password name=password size=20>&nbsp;<font
				class=red><?php if ($this->_tpl_vars['info']['id'] == ''): ?>*<?php endif; ?></font></td>
		</tr>
		<tr>
			<td>确认密码：</td>
			<td><input type=password name=topassword size=20>&nbsp;<font
				class=red><?php if ($this->_tpl_vars['info']['id'] == ''): ?>*<?php else: ?>不修改密码可留空<?php endif; ?></font></td>
		</tr>
		<tr>
			<td>人员职位：</td>
			<td><input type=text name=position size=40
				value='<?php echo $this->_tpl_vars['info']['position']; ?>
'></td>
		</tr>
		<tr>
			<td>联系方式：</td>
			<td>Q&nbsp;Q：<input type=text name=qq size=20
				value='<?php echo $this->_tpl_vars['info']['qq']; ?>
'>&nbsp;邮箱：<input type=text name=email
				size=20 value='<?php echo $this->_tpl_vars['info']['email']; ?>
'><br /> 电话：<input type=text
				name=tel size=20 value='<?php echo $this->_tpl_vars['info']['tel']; ?>
'>&nbsp;传真：<input
				type=text name=fax size=20 value='<?php echo $this->_tpl_vars['info']['fax']; ?>
'>&nbsp;手机：<input
				type=text name=mobile size=20 value='<?php echo $this->_tpl_vars['info']['mobile']; ?>
'>&nbsp;<font
				class=red>*</font></td>
		</tr>
		<tr>
			<td>人员负责人：</td>
			<td><select name=uid> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['data'],'selected' => $this->_tpl_vars['info']['uid']), $this);?>

			</select>&nbsp;<font class=red>*</font></td>
		</tr>
		<tr>
			<td>人员权限：</td>
			<td><?php echo $this->_tpl_vars['menu']; ?>
</td>
		</tr>
		<tr>
			<td valign=top>备注说明：</td>
			<td><textarea name=note style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['note']; ?>
</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td height=30><input id="submit_query" type=button
				onclick="sub_frm();" value='提交添加'> <input type=reset
				value='重新填写'> <input type=button name=go_back value='返回上一页'
				onclick="javascript:history.go(-1);"></td>
		</tr>
	</form>
</table>

<script type="text/javascript">
var username_id=$("input[name='username']");
$(function(){
	<?php if ($this->_tpl_vars['info']['id'] == ''): ?>
		checkform();
		username_id.blur(checkform);
	<?php endif; ?>
})

function checkform() {
	var username = username_id.val();
	$("#submit_query").attr('disabled',true).css('background','#d4d0c8');
	var url='getajax.php?q=checkusername&username='+encodeURI(username);
	$.getJSON(url,function(data){
		if(data.status=='1'){
			$("#tishi").html(data.desc);
			return false;
		}else{
			$("#tishi").empty();
			$("#submit_query").attr('disabled',false).css('background','');
		}
	});

	
}

function sub_frm(){
	if(document.section.username.value == ''){
		 alert("请输入用户名");
	     document.section.username.focus();
	  	 return false;
	}
	else if(document.section.name.value == ''){
		 alert("请输入人员姓名");
	     document.section.name.focus();
	  	 return false;
	}
<?php if ($this->_tpl_vars['info']['id'] == ''): ?>
	else if(document.section.password.value == ''){
		 alert("请输入登录密码");
	     document.section.password.focus();
	  	 return false;
	}
<?php endif; ?>
	else if(document.section.password.value != document.section.topassword.value){
		 alert("两次输入密码不一样，请重新输入");
	     document.section.topassword.focus();
	  	 return false;
	}else{
		document.section.submit();
	}
	
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