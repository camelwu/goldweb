<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');

if(!empty($_GET['action'])){
$action=$_GET['action'];
}else{
$action="list";
}
if(!empty($_GET['c_id'])){
$c_id=$_GET['c_id'];
$sqladd=" where c_id=".$c_id."";
}else{
$c_id=0;
$sqladd="";
}
$tit="客户";
$nsort="works";
echo list_top($tit,$nsort,$nsort,0);
?>
<?php
switch ($action){
case "delete":
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	if($_POST['sel_type']==2){
		$sqlstr="delete from ".$dbfix."client where id in(".$sel_ids.")";
		$opea="删除";
	}else{
		$sqlstr="update ".$dbfix."client set istop=".$_POST['sel_type']." where id in(".$sel_ids.")";
		$opea="修改";
	}
	mysql_query($sqlstr);
	print "<script language=javascript>window.alert('已成功的".$opea."了".count($temp)."条".$tit."！');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
break;
case "handle":
	$htmlData = '';
	if (!empty($_POST['word'])) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($_POST['word']);
		} else {
			$htmlData = $_POST['word'];
		}
	}else{
		var_dump($_POST);
	}
	if($_POST['upid']==0){//add
		$sqlstr="insert into ".$dbfix."client(uid,identity,position,address,name,mobile,tel,fax,email,word,status) values(".$_POST['uid'].",'".$_POST['identity']."','".$_POST['position']."','".$_POST['address']."','".$_POST['topic']."','".$_POST['mobile']."','".$_POST['tel']."','".$_POST['fax']."','".$_POST['email']."','".$htmlData."','".$_POST['status']."')";
	}else{//edit
		$sqlstr="update ".$dbfix."client set uid=".$_POST['uid'].",identity='".$_POST['identity']."',position='".$_POST['position']."',address='".$_POST['address']."',name='".$_POST['topic']."',mobile='".$_POST['mobile']."',tel='".$_POST['tel']."',fax='".$_POST['fax']."',email='".$_POST['email']."',word='".$htmlData."',status='".$_POST['status']."' where id=".$_POST['upid'];
	}
	mysql_query($sqlstr);
	print"<script>alert('提交成功！');location.href='?action=list';</script>";
break;
case "list";
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr valign=top align=center>
<td>
  <table class=table2>
  <tr><td><img border=0 src='images/s_left_sort.gif' align=absmiddle> <a href='?jk_mod='>客户列表</a></td></tr>
  <tr><td height=5></td></tr>
  <tr><td class=htd>";
$query="select c_id,c_name from ".$dbfix."class where nsort='".$nsort."' order by c_order";
$result=mysql_query($query);
if($result!=""){
while($data=mysql_fetch_array($result)){
	if($data[0]==$c_id){
		print"<img border=0 src='images/s_left_sort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."' class='red2'>".$data[1]."</a><br>";
	}else{
		print"<img border=0 src='images/s_nsort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."'>".$data[1]."</a><br>";
	}
}
}
	print"</td></tr>
  </table>
</td>
<td>
  <table cellspacing=1 cellpadding=3 class=table0>
<form name=sel_form action='?action=delete' method=post>
<tr align=center>
<td class=td width='7%'>序号</td>
<td class=td width='66%'>".$tit."标题及整理时间</td>
<td class=td width='22%'>联系方式</td>
<td class=td width='5%'><input type=checkbox name=sel_all value='yes' onClick=\"javascript:select_all(this.form);\"></td>
</tr>";
if(!empty($_GET['keyword'])){//keywords
	if($sqladd==""){
		$sqladd=" where name like '%".$_GET['keyword']."%'";
	}else{
		$sqladd.=" and name like '%".$_GET['keyword']."%'";
	}
}
$query="select * from ".$dbfix."client".$sqladd." order by id desc";
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
	echo "<tr align=center>
	<td class=tims>".$start."</td>
	<td align=left height='20px;'><span style='float:left'><a href='?action=edit&id=".$data[0]."'>".$data["name"]."</a></span>
	<span class=tims alt='".$data["time1"]."' style='float:right'>".date("Y-m-d",strtotime($data["time1"]))."</span></td>
	<td align=left>".$data["identity"]."&nbsp;".$data["position"]."：".$data["mobile"]."</td>
	<td><input type=checkbox name=sel_id value='".$data[0]."'></td>
	</tr>";
	if($start==$totalnum){break;}
	}
}
	echo"<tr class=tr1>
	<td colspan=2>
	现有<font class=red>".$totalnum."</font>篇".$tit."，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
if($pagecount>1){
	echo"分页：<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=1>首页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".($nowpage-1).">上页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".($nowpage+1).">下页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".$pagecount.">尾页</a>";
}
	echo"</td>
	<td colspan=2 align=center>
	执行
	<select name=sel_type size=1>
<option value='2'>删除</option>
	</select><input type=hidden name=sel_ids>
	<input type=submit value='操作' onclick=\"return sel_click(this.form)\";>
	</td>
	</tr>
</form>
</table>
</td>
</tr>
</table>";
break;
default:
if(!empty($_GET['id'])){
	$id=$_GET['id'];
}else{
	$id=0;
}
$query="select uid,name,identity,position,tel,fax,email,mobile,address,word,status from ".$dbfix."client where id=".$id."";
$result=mysql_query($query);
if($data=mysql_fetch_array($result)){
	$uid=$data[0];
	$name=$data[1];
	$identity=$data[2];
	$position=$data[3];
	$tel=$data[4];
	$fax=$data[5];
	$email=$data[6];
	$mobile=$data[7];
	$address=$data[8];
	$word=$data[9];
	$status=$data[10];
}else{
	$uid="";
	$name="";
	$identity="";
	$position="";
	$tel="";
	$fax="";
	$email="";
	$mobile="";
	$address="";
	$word="";
	$status="";
}
//if($pic==""){$upname=randnum("works");}else{$upname=$pic;}
@mysql_free_result($result);
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>添加".$tit."</td></tr>
<form name=add_frm action='?action=handle' method=post>
<input type=hidden name=upid value='".$id."'>
<input type=hidden name=types value='".$types."'>
<tr>
<td>".$tit."公司：</td>
<td><input type=text name=topic size=60 value='".$name."'>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td>".$tit."地址：</td>
<td><input type=text name=address size=60 value='".$address."'>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td>".$tit."联系人：</td>
<td><input type=text name=identity size=20 value='".$identity."'>&nbsp;<font class=red>*</font>&nbsp;邮件：<input type=text name=email size=20 value='".$email."'></td>
</tr>
<tr>
<td>".$tit."电话：</td>
<td><input type=text name=tel size=20 value='".$tel."'>&nbsp;传真：<input type=text name=fax size=20 value='".$fax."'>&nbsp;手机：<input type=text name=mobile size=20 value='".$mobile."'>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."负责人：</td>
<td><select name=uid>";
$sqlstr="select id,name from ".$dbfix."user order by username";
$result=mysql_query($sqlstr);
while($data=mysql_fetch_array($result)){
	if($data[0]==$uid){
		print"<option value='".$data[0]."' selected>".$data[1]."</option>";
	}else{
		print"<option value='".$data[0]."'>".$data[1]."</option>";
	}
}
@mysql_free_result($result);
	print"</select>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."职位：</td>
<td><input type=text name=position size=20 value='".$position."'>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td>".$tit."状态：</td>
<td><input type=text name=status size=20 value='".$status."'>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td valign=top>".$tit."详细说明：</td>
<td><textarea name=word style='width:670px;height:220px;visibility:hidden;'>".htmlspecialchars($word)."</textarea></td>
</tr>
<tr>
<td></td>
<td height=30><input type=submit value='提交添加'>　　<input type=reset value='重新填写'>　　<input type=button name=go_back value='返回上一页' onclick=\"javascript:location.href='?acion=list';\"></td>
</tr></form>
</table>";
break;
}	
include_once('admin_tpl_foot.php');
?>