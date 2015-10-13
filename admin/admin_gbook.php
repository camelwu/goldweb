<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');
?>
<?php
if(!empty($_GET['action'])){
$action=$_GET['action'];
}else{
$action="";
}
?>
<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>留言管理</td></tr>
<tr><td align=center colspan=2 height=30>
  <table border=0>
  <tr>
  <td><a href='?'>留言管理</a></td>
  <td width=10></td>
  <td><a href='?action=clear' onclick="javascript:return click_return('清空所有留言',0);">清空所有留言</a></td>

  </tr>
  </table>
</td></tr>
</table>
<table width='90%' height=2><tr class=bg><td></td></tr></table>
<?php
switch ($action){
case "delete":
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	$sqlstr="delete from gbook where id in(".$sel_ids.")";
	mysql_query($sqlstr);
	print "<script language=javascript>window.alert('已成功的删除了".count($temp)."条评论！');location.href='?page=".$_POST['page']."';</script>";
break;
case "clear":
	$sqlstr="delete from gbook";
	mysql_query($sqlstr);
	print "<script language=javascript>window.alert('已成功的删除了所有评论！');location.href='".$filename."';</script>";
break;
case "view":
$sqlstr="select nname,sex,tel,email,topic,word,tim from gbook where id=".$_GET['id'];
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	print"<table cellspacing=1 cellpadding=4 class=table>
<form name=viewfrm action='?action=delete' method=post>
<input type=hidden name=sel_ids value='".$_GET['id']."'>
<input type=hidden name=page value='1'>
<tr>
<td width='20%' class=td></td>
<td width='80%' class=td>留言内容</td>
</tr>
<tr>
<td>留言作者：</td>
<td>".$data[0]."--".$data[1]."</td>
</tr>
<tr>
<td>留言电话：</td>
<td>".$data[2]."</td>
</tr>
<tr>
<td>留言信箱：</td>
<td>".$data[3]."</td>
</tr>
<tr>
<td>留言主题：</td>
<td>".$data[4]."</td>
</tr>
<tr>
<td>留言内容：</td>
<td>".$data[5]."</td>
</tr>
<tr>
<td>留言时间：</td>
<td>".$data[6]."</td>
</tr>
<tr>
<td>相关操作：</td>
<td><input type=submit value='删除'>　　<input type=button name=go_back value='返回上一页' onclick=javascript:history.back(1);></td>
</tr>
</form>
</table>";
}
break;
default:////////////////////////
?>
<table cellspacing=1 cellpadding=4 class=table>
<form name=sel_form action='?action=delete' method=post>
<tr align=center>
<td class=td width='6%'>序号</td>
<td class=td width='69%'>留言主题 和 留言时间</td>
<td class=td width='20%'>留言IP及发布人</td>
<td class=td width='5%'><input type=checkbox name=sel_all value='yes' onclick="javascript:select_all(this.form);"></td>
</tr>
<?php
$query="select id,nname,xuyao,tim,ip,topic,word from gbook order by id desc";
$result=mysql_query($query);
$pagesize=15;//设置每页显示条数
$totalnum=@mysql_num_rows($result);//总数
$pagecount=getCount($totalnum,$pagesize);

if(!empty($_GET['page'])){
	if($_GET['page']<=0){
	$nowpage=1;
	$start=0;
	}elseif($_GET['page']>$pagecount){
	$nowpage=$pagecount;
	$start=($pagecount-1)*$pagesize;
	}else{
	$nowpage=$_GET['page'];
	$start=($nowpage-1)*$pagesize;
	}
}else{
	$nowpage=1;
	$start=0;
}

if($totalnum==0){//防止数据库为空
	echo "<tr><td colspan=4>没有数据</td></tr>";
}else{
	for ($m=0; $m<$pagesize; $m++){
	@mysql_data_seek($result,$start++);
	$data=@mysql_fetch_array($result);
	echo"<tr align=center>
	<td class=tims>".$start."</td>
	<td>
	  <table border=0 cellspacing=0 cellpadding=0 width='100%'>
	  <tr>
	  <td><a href='?action=reply&id=".$data[0]."'>".$data[2]."->>".wordscut($data[6],50)."</a></td>
	  <td align=right><font class=tims alt='".$data[3]."'>".date("m-d h:m",strtotime($data[3]))."</font></td>
	  </tr>
	  </table>
	</td>
	<td align=left><a href='?action=view&id=".$data[0]."'><img src='images/reply.gif' border='0' alt='察看此留言'></a>&nbsp;&nbsp;<img src='images/ip.gif' alt='".$data["ip"]."'>&nbsp;&nbsp;".$data[1]."</td>
	<td><input type=checkbox name=sel_id value='".$data[0]."'></td>
	</tr>";
	if($start==$totalnum){break;}
	}
}
echo"<tr class=tr1>
	<td colspan=2>
	现有<font class=red>".$pagecount."</font>篇留言，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
if($pagecount>1){
	echo"分页：<a href=".$filename."?page=1>首页</a> | 
<a href=".$filename."?page=".($nowpage-1).">上页</a> | 
<a href=".$filename."?page=".($nowpage+1).">下页</a> | 
<a href=".$filename."?page=".$pagecount.">尾页</a>";
}
	echo"</td>
	<td colspan=2 align=center>
	执行
	<select name=sel_type size=1>
	<option value='删除'>删除</option>
	</select><input type=hidden name=sel_ids><input type=hidden name=page value=".$nowpage.">
	<input type=submit value='操作' onclick='return sel_click(this.form)';>
	</td>
	</tr>";
break;
}
?>
</form>
</table>