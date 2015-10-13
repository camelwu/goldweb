<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');
?>
<?php
if(!empty($_GET['action'])){
$action=$_GET['action'];
}else{
$action="list";
}
$tit="案例";
$nsort="gallery";
$sqladd=" where types='".$types."'";
if(!empty($_GET['c_id'])){
	$c_id=$_GET['c_id'];
	$sqladd.=" and c_id=".$c_id."";
}else{
	$c_id=0;
}
if(!empty($_GET['jk_mod'])){
$jk_mod=$_GET['jk_mod'];
	if($sqladd==""){
	$sqladd=" where istop<>0";
	}else{
	$sqladd.=" and istop<>0";
	}
}
echo list_top($tit,$types,$types,$c_id);
?>
<?php
switch ($action){
case "delete":
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	if($_POST['sel_type']==2){
		$sqlstr="delete from ".$dbfix."gallery where id in(".$sel_ids.")";
		$opea="删除";
	}else{
		$sqlstr="update ".$dbfix."gallery set istop=".$_POST['sel_type']." where id in(".$sel_ids.")";
		$opea="修改";
	}
	mysql_query($sqlstr);
	print "<script language=javascript>window.alert('已成功的".$opea."了".count($temp)."条".$tit."！');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
break;
case "handle":
	if(empty($_POST['istop']))$_POST['istop']=0;
	
	if($_POST['upid']==0){//add
		$sqlstr="insert into ".$dbfix."gallery(c_id,p_id,name,profile,pic,word,tim) values(".$_POST['c_id'].",'".$_POST['p_id']."','".$_POST['topic']."','".killbad($_POST['profile'])."','".killbad($_POST['pic'])."','".killbad($_POST['word'])."','".date("Y-m-d H:i:s")."')";
	}else{//edit
		$sqlstr="update ".$dbfix."gallery set c_id=".$_POST['c_id'].",p_id='".$_POST['p_id']."',name='".$_POST['topic']."',profile='".killbad($_POST['profile'])."',pic='".killbad($_POST['pic'])."',word='".killbad($_POST['word'])."' where id=".$_POST['upid'];
	}
	mysql_query($sqlstr);
	print"<script language=javascript>window.alert('提交成功！');location.href='?types=".$_POST['types']."&c_id=".$_POST['c_id']."';</script>";
break;
case "list":
	echo"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr valign=top align=center>
<td>
  <table class=table2>
  <tr><td><img border=0 src='images/s_left_sort.gif' align=absmiddle> <a href='?types=".$types."'>".$tit."列表</a></td></tr>
  <tr><td height=5></td></tr>
  <tr><td class=htd>";
$sqlstr="select c_id,c_name from ".$dbfix."class where nsort='".$types."' order by c_order";
$result=mysql_query($sqlstr);
while($data=mysql_fetch_array($result)){
	if($data[0]==$c_id){
	print"<img border=0 src='images/s_left_sort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."&types=".$types."' class='red2'>".$data[1]."</a><br>";
	}else{
	print"<img border=0 src='images/s_nsort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."&types=".$types."'>".$data[1]."</a><br>";
	}
}
@mysql_free_result($result);
echo"</td></tr>
  </table>
</td>
<td>
  <table cellspacing=1 cellpadding=3 class=table0>
<form name=sel_form action='?action=delete&types=".$types."' method=post>
<tr align=center>
<td class=td width='7%'>序号</td>
<td class=td width='66%'>".$tit."标题及整理时间</td>
<td class=td width='22%'>相关属性</td>
<td class=td width='5%'><input type=checkbox name=sel_all value='yes' onClick=\"javascript:select_all(this.form);\"></td>
</tr>";
if(!empty($_GET['keyword'])){//keywords
$sqladd.=" and name like '%".$_GET['keyword']."%'";
}
$query="select id,name,pic,tim,istop from ".$dbfix."gallery".$sqladd." order by id desc";
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
	<td align=left height='20px;'><span style='float:left'><a href='?action=edit&types=".$types."&id=".$data[0]."'>".$data[1]."</a></span>
	<span class=tims alt='".$data[3]."' style='float:right'>".date("Y-m-d",strtotime($data[3]))."</span></td>
	<td align=left><a href='?action=edit&types=".$types."&id=".$data[0]."'><img border=0 src='images/edit.gif' alt='编辑该信息' align=absmiddle></a>";
	if($data[2]!=""){
		echo"&nbsp;<img border=0 src='images/ispic.gif' alt='图片' align=absmiddle>";
	}
	if($data[4]<>0){
		echo"&nbsp;<img border=0 src='images/istop.gif' alt='推荐' align=absmiddle>";
	}
	print"</td>
	<td><input type=checkbox name=sel_id value='".$data[0]."'></td>
	</tr>";
	if($start==$totalnum){break;}
	}
}
	echo"<tr class=tr1>
	<td colspan=2>
	现有<font class=red>".$pagecount."</font>篇".$tit."，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
if($pagecount>1){//防止数据库为空
print"分页：<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&types=".$types."&page=1>首页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&types=".$types."&page=".($nowpage-1).">上页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&types=".$types."&page=".($nowpage+1).">下页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&types=".$types."&page=".$pagecount.">尾页</a>";
}
	echo"</td>
	<td colspan=3 align=center>
	执行
	<select name=sel_type size=1>
<option value='1'>推荐</option>
<option value='0'>取消推荐</option>
<option value='2'>删除</option>
	</select><input type=hidden name=sel_ids>
	<input type=submit value='操作' onclick='return sel_click(this.form)';>
	</td>
	</tr>";
echo"</form>
</table>
</td>
</tr>
</table>";
break;
default://add,edit
if(!empty($_GET['id'])){
	$id=$_GET['id'];
}else{
	$id=0;
}
$sqlstr="select c_id,name,profile,pic,word,tim,p_id from ".$dbfix."gallery where id=".$id."";
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	$c_id=$data[0];
	$name=$data[1];
	$profile=$data[2];
	$pic=$data[3];
	$word=$data[4];
	$tim=$data[5];
	$p_id=$data[6];
}else{
	$c_id="";
	$name="";
	$profile="";
	$pic="";
	$word="";
	$tim=date("Y-m-d H:i:s");
	$p_id="";
}
if($pic==""){$upname=randnum("gallery");}else{$upname=$pic;}
@mysql_free_result($result);
print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>添加".$tit."</td></tr>
<form name=add_frm action='?action=handle' method=post>
<input type=hidden name=upid value='".$id."'>
<input type=hidden name=types value='".$types."'>
<tr>
<td>".$tit."标题：</td>
<td><input type=text name=topic size=60 value='".$name."'>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td>".$tit."分类：</td>
<td><select name=c_id size=1>";
$sqlstr="select c_id,c_name from ".$dbfix."class where nsort='".$nsort."' order by c_order";
$result=mysql_query($sqlstr);
while($data=mysql_fetch_array($result)){
	if($data[0]==$c_id){
		print"<option value='".$data[0]."' class=bg_2 selected>".$data[1]."</option>";
	}else{
		print"<option value='".$data[0]."' class=bg_2>".$data[1]."</option>";
	}
}
	print"</select>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."简介：</td>
<td><textarea name=profile style='width:670px;height:180px;'>".$profile."</textarea>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>关联产品：</td>
<td>";
$sqlstr="select id,name from ".$dbfix."shop_product order by name";
$result=mysql_query($sqlstr);
$number=@mysql_num_rows($result);//总数
if($number>0){
while($data=mysql_fetch_array($result)){
	if(instr($data[0],$p_id)>-1){
		print"<input name=p_id value='".$data[0]."' type=checkbox checked>".$data[1]." ";
	}else{
		print"<input name=p_id value='".$data[0]."' type=checkbox>".$data[1]." ";
	}
}
}
@mysql_free_result($result);
echo"</td>
</tr>
<tr>
<td valign=top>".$tit."内容：</td>
<td><textarea name=word style='width:670px;height:220px;'>".$word."</textarea></td>
</tr>
<tr>
<td>".$tit."图片：</td>
<td><input type=text name=pic value='".$pic."' size=40 maxlength=100>&nbsp;&nbsp;&nbsp;<a href='upload.php?uppath=gallery&upname=".$upname."&uptext=pic' target=upload_frame>上传图片</a></td>
</tr>
<tr>
<td>上传图片：</td>
<td><iframe frameborder=0 name=upload_frame width='100%' height=30 scrolling=no src='upload.php?uppath=gallery&upname=".$upname."&uptext=pic'></iframe></td>
</tr>
<tr>
<td></td>
<td height=30><input type=submit value='提交添加'>　　<input type=reset value='重新填写'>　　<input type=button name=go_back value='返回上一页' onclick=\"javascript:history.back(1);\"></td>
</tr></form>
</table>";
break;
}	
include_once('admin_tpl_foot.php');
?>