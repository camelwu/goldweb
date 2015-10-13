<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');

if(!empty($_GET['action'])){
$action=$_GET['action'];
}else{
$action="";
}
?>
<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>执行SQL</td></tr>
<?php
switch ($action){
case "chk":
	$sqlstr="".$_POST['sqls']."";
	if ($sqlstr==""){
		print"<script language=javascript>window.alert('SQL不能为空！');location.href='admin_sql.php';</script>";
	}else{
		mysql_query($sqlstr);
		print"<script language=javascript>window.alert('成功执行SQL！');location.href='admin_sql.php';</script>";
	}
break;
default:
?>
<form action='?action=chk' method=post>
<tr>
<td>输入说明：</td>
<td>多句SQL语句时请以换行的行式每行输入一条SQL语句</td>
</tr>
<tr>
<td>SQL语句：</td>
<td><textarea name=sqls rows=8 cols=60></textarea></td>
</tr>
<tr>
<td></td>
<td><input type=submit value=' 提 交 执 行 '>　　<input type=reset value='重新填写'></td>
</tr>
</form>
<?php }?>
</table>