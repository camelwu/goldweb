<?php
require_once('includes/init.php');
require_once('includes/common.inc.php');
include_once('admin_tpl_head.php');
$action = postget("action");

if($action=="send"){
	$email = postget("email");
	$sub = postget("subject");
	$cont = postget("cont");
$emails=array('camelwu963@126.com');
array_push($emails,$email);
$subject=$sub==""?'测试邮件头':$sub;
$content=$cont==""?'测试内容<br>换行<br><strong>加粗</strong>':$cont;
$tag='';
$echo='';
sendmail($emails,$subject,$content);
}else{
$py = new PinYin();
echo $py->getAllPY("输出汉字所有拼音");
$query = $db->query("select * from cg_area");
	while ($info = $db->fetch_array($query)) {
		mysql_query("update cg_area set region='".$py->getAllPY($info['title'])."' where id=".$info['id']);
	}
//$db->query();
?>
<table cellspacing=1 cellpadding=4 class=table>
<tr><th colspan=2>测试邮件</th></tr>
<form action='?action=send' method=post>
<tr>
<td width='20%'>输入邮件：</td>
<td><input type="text" name="email"></td>
</tr>
<tr>
<td>输入标题：</td>
<td><input type="text" name="subject"></td>
</tr>
<tr>
<td>语句：</td>
<td><textarea name=cont rows=8 cols=60></textarea></td>
</tr>
<tr>
<td></td>
<td><input type=submit value=' 提 交 执 行 '>　　<input type=reset value='重新填写'></td>
</tr>
</form>
<?php
}
include_once('admin_tpl_foot.php');
?>