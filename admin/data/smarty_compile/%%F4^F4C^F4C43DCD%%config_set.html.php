<?php /* Smarty version 2.6.20, created on 2015-04-26 14:35:30
         compiled from config_set.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<table cellspacing=1 cellpadding=4 class=table>
        <tr><th colspan=2><?php echo $this->_tpl_vars['tit']; ?>
信息</th></tr>
        <form name=add_frm action='?action=handle' method=post>
        <input type=hidden name=id value='<?php echo $this->_tpl_vars['id']; ?>
'>
        <tr>
        <td width='20%'><?php echo $this->_tpl_vars['tit']; ?>
标题：</td>
        <td><input type=text name=name size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['name']; ?>
'></td>
        </tr>
        <tr>
        <td><?php echo $this->_tpl_vars['tit']; ?>
域名：</td>
        <td><input type=text name=weburl size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['weburl']; ?>
'></td>
        </tr>
            <tr>
        <td><?php echo $this->_tpl_vars['tit']; ?>
图片域名：</td>
        <td><input type=text name=picserver size=60 value='<?php echo $this->_tpl_vars['info']['picserver']; ?>
'></td>
        </tr>
                <tr>
        <td><?php echo $this->_tpl_vars['tit']; ?>
图片目录：</td>
        <td><input type=text name=uploadir size=60 value='<?php echo $this->_tpl_vars['info']['uploadir']; ?>
'></td>
        </tr>
        <tr>
        <td><?php echo $this->_tpl_vars['tit']; ?>
qq：</td>
        <td><input type=text name=qq size=40 maxlength=40 value='<?php echo $this->_tpl_vars['info']['qq']; ?>
'></td>
        </tr>
        <tr>
        <td>联系邮件：</td>
        <td><input type=text name=email size=40 maxlength=40 value='<?php echo $this->_tpl_vars['info']['email']; ?>
'></td>
        </tr>
        <tr>
        <td>邮件密码：</td>
        <td><input type=text name=pswd value='<?php echo $this->_tpl_vars['info']['pswd']; ?>
' size=40 maxlength=40></td>
        </tr>
        <tr>
        <td>联系电话：</td>
        <td><input type=text name=tel size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['tel']; ?>
'></td>
        </tr>
        <tr>
        <td>联系传真：</td>
        <td><input type=text name=fax size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['fax']; ?>
'></td>
        </tr>
        <tr>
        <td>联系手机：</td>
        <td><input type=text name=mobile size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['mobile']; ?>
'></td>
        </tr>
        <tr>
        <td>联系地址：</td>
        <td><input type=text name=address size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['address']; ?>
'></td>
        </tr>
        <tr>
        <td>邮政编码：</td>
        <td><input type=text name=zip size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['zip']; ?>
'></td>
        </tr>
        <tr>
        <td><?php echo $this->_tpl_vars['tit']; ?>
关键字：</td>
        <td><input type=text name=keyes size=60 maxlength=40 value='<?php echo $this->_tpl_vars['info']['keyes']; ?>
'></td>
        </tr>
        <tr>
        <td valign=top><?php echo $this->_tpl_vars['tit']; ?>
描述：</td>
        <td><textarea rows="5" cols="60" name=contents><?php echo $this->_tpl_vars['info']['contents']; ?>
</textarea></td>
        </tr>
        <tr>
        <td></td>
        <td height=30><input type=submit value='提交添加'>　　<input type=reset value='重新填写'></td>
        </tr></form>
	</table>
<script language=javascript>
function checkfrm(frm){
	return true;
}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>