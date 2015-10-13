<?php /* Smarty version 2.6.20, created on 2015-06-18 02:15:57
         compiled from admin_pws.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<table cellspacing=1 cellpadding=4 class=table>
        <tr>
            <th colspan=2>修改<?php echo $this->_tpl_vars['tit']; ?>
</th>
        </tr>
        <form name='admin_frm' action='?action=handle' method='post' onsubmit="return checkfrm(this);">
        <tr>
		<td width='20%'>用户：</td>
		<td width='80%'><?php echo $this->_tpl_vars['name']; ?>
</td>
		</tr>
		<tr>
		<td>旧密码：</td>
		<td><input type=password name=oldpwd size=30 maxlength=16 value=''>&nbsp;<font class=red>*</font></td>
		</tr>
        <tr>
		<td>新密码：</td>
		<td><input type=password name=newpwd size=30 maxlength=16 value=''>&nbsp;<font class=red>*</font></td>
		</tr>
        <tr>
		<td>确认密码：</td>
		<td><input type=password name=toldpwd size=30 maxlength=16 value=''>&nbsp;<font class=red>*</font></td>
		</tr>
		<tr>
		<td></td>
		<td height=30><input type='submit' value='提交修改'>　　<input type='reset' value='重新填写'></td>
		</tr>
		</form>
	</table>
<script language=javascript>
function checkfrm(frm){
 if(frm.oldpwd.value==""){
	alert("请输入旧密码");
	frm.oldpwd.focus();
	return false;
 }else if(frm.newpwd.value==""){
	alert("请输入新密码");
	frm.newpwd.focus();
	return false;
 }else if(frm.newpwd.value!=frm.toldpwd.value){
	alert("两次输入的密码不一致，请重新输入");
	frm.toldpwd.focus();
	return false;
 }else{
	return true;
 }
}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>