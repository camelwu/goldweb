<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');

if(!empty($_GET['action'])){
	$action=$_GET['action'];
}else{
	$action="";
}

if(!empty($_GET['nsort'])){
	$nsort=$_GET['nsort'];
}else{
	$nsort='news';
}
$tit=$web[$nsort];//nsort没有，会报错
?>
<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>分类管理</td></tr>
<tr><td align=center colspan=2 height=30>
<?php
  echo"<table border=0><tr>
  <td><a href='?nsort=".$nsort."'>".$tit."分类管理</a></td>
  <td width=10></td>
  <td><a href='?nsort=".$nsort."&action=editc'>添加".$tit."分类</a></td>
  </tr></table>";
?>
</td></tr>
<tr>
<td></td>
<td></td>
</tr>
</table>

<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>栏目分类</td></tr>
<tr align=center valign=top><td>
<table class=table2>
<tr><td width=15></td><td></td></tr>
<?php
while (list($key,$value) = each($web)) {
echo "<tr><td align=center><img border=0 src='images/s_nsort.gif' align=absmiddle></td><td><a href='?nsort=$key'>$value</a></td></tr>";
}
?>
</table>
</td><td>
<?php
switch ($action){
case "del":
	$sqlstr="delete from ".DBFIX."class where c_id=".$_GET['c_id']."";
	echo $sqlstr;
	mysql_query($sqlstr);
	print"<script language=javascript>alert('删除成功！');location.href='?nsort=".$_GET['nsort']."&c_id=".$_GET['c_id']."';</script>";
break;
case "addc":
	if($_POST['c_id']==0){//add
		$sqlstr="insert into ".DBFIX."class(nsort,c_name,c_note,c_order) values('".$_GET['nsort']."','".$_POST['c_name']."','".$_POST['c_note']."',".$_POST['c_order'].")";
	}else{//edit
		$sqlstr="update ".DBFIX."class set nsort='".$_GET['nsort']."',c_name='".$_POST['c_name']."',c_note='".$_POST['c_note']."',c_order=".$_POST['c_order']." where c_id=".$_POST['c_id'];
	}
	echo $sqlstr;
	mysql_query($sqlstr);
	print"<script language=javascript>location.href='?nsort=".$_GET['nsort']."&c_id=".$_POST['c_id']."';</script>";
break;
case "editc":
if(!empty($_GET['c_id'])){
	$c_id=$_GET['c_id'];
}else{
	$c_id=0;
	$sqlstr="select c_order from ".DBFIX."class where nsort='".$nsort."' order by c_id desc limit 0,1";
	$result=mysql_query($sqlstr);
	if($data=mysql_fetch_array($result)){
		$c_order=$data[0]+1;
	}else{
		$c_order=1;
	}
}
$sqlstr="select c_name,c_note,c_order from ".DBFIX."class where c_id=".$c_id."";
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	$c_name=$data[0];
	$c_note=$data[1];
	$c_order=$data[2];
}else{
	$c_name='';$c_note='';
}
print"<table cellspacing=1 cellpadding=3 class=table0>
<tr>
<td class=td width='20%'></td>
<td class=td width='80%'>".$tit."分类（编辑一级分类）</td>
</tr>
<form name=add_frm action='?nsort=".$nsort."&action=addc' method=post>
<input type=hidden name=c_id value='".$c_id."'>
<input type=hidden name=c_order value='".$c_order."'>
<tr>
<td>一级分类名称：</td>
<td><input type=text name=c_name size=30 value='".$c_name."'>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>一级分类说明：</td>
<td><textarea name='c_note' rows=10 cols=65>".$c_note."</textarea>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td></td>
<td height=30><input type=submit value='提交添加'>　　<input type=reset value='重新填写'>　　<input type=button name=go_back value='返回上一页' onclick=javascript:history.back(1);></td>
</tr></form></table>";
break;
default:
	echo"<table cellspacing=1 cellpadding=3 class=table0>
<tr align=center>
<td class=td width='70%'>分类名称</td>
<td class=td width='30%'>相关操作</td>
</tr>";
$sqlstr="select * from ".DBFIX."class where nsort='".$nsort."' order by c_order asc";
$result=mysql_query($sqlstr);
if($result!=""){
	while($data=mysql_fetch_array($result)){
	echo"<tr><td>&nbsp;<img border=0 src='images/s_left.gif' align=absmiddle>&nbsp;<font class=red2><b>".$data[3]."</b></font></td><td>";
	echo"&nbsp;<a href='?nsort=".$nsort."&c_id=".$data[0]."&action=editc'>编辑</a>";
	//echo"&nbsp;<a href='?nsort=".$nsort."&c_id=".$data[0]."&action=up'><img border=0 src='images/up_1.gif' alt='向上移动此主分类' align=absmiddle></a>";
	//echo"&nbsp;<a href='?nsort=".$nsort."&c_id=".$data[0]."&action=down'><img border=0 src='images/down_1.gif' alt='向下移动此主分类' align=absmiddle></a>";
	echo"&nbsp;<a href='?nsort=".$nsort."&c_id=".$data[0]."&action=del' onclick=return del_nsort(3,'sort','yes');>删除</a>";
	echo"</td></tr>";
	}
}else{
	echo "暂无分类，请<A HREF='?nsort=".$nsort."&action=editc'>添加</A>！";
}
}
	echo"</table>";
?>
<script language=javascript>
<!--
function del_nsort(t1,t2,t3)
{
  if (t3=="yes")
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
</td></tr>
</table>