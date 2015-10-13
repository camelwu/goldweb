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
if(!empty($_GET['c_id'])){
	$c_id=$_GET['c_id'];
	$sqladd=" where c_id=".$c_id."";
}else{
	$c_id=0;
	$sqladd="";
}
if(!empty($_GET['jk_mod'])){
$jk_mod=$_GET['jk_mod'];
	if($sqladd==""){
	$sqladd=" where istop<>0";
	}else{
	$sqladd.=" and istop<>0";
	}
}
$tit="库存";
$nsort="shop";
echo list_top($tit,$nsort,$nsort,$c_id);
?>
<?php
switch ($action){
case "delete":
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	if($_POST['sel_type']==2){
		$sqlstr="delete from ".$dbfix."shop_stock where id in(".$sel_ids.")";
		$opea="删除";
	}else{
		$sqlstr="update ".$dbfix."shop_stock set istop=".$_POST['sel_type']." where id in(".$sel_ids.")";
		$opea="修改";
	}
	mysql_query($sqlstr);
	print "<script language=javascript>window.alert('已成功的".$opea."了".count($temp)."条".$tit."！');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
break;
case "handle":
	if(empty($_POST['istop']))$_POST['istop']=0;	
	if($_POST['upid']==0){//add
		$sqlstr="insert into ".$dbfix."shop_stock(c_id,mac,serial,brand,stock,remark,word,spic,pic,lpic,istop,cod,price,discount) values(".$_POST['c_id'].",'".$_POST['mac']."','".$_POST['serial']."','".$_POST['brand']."','".$_POST['stock']."','".$_POST['remark']."','".killbad($_POST['word'])."','".killbad($_POST['spic'])."','".killbad($_POST['pic'])."','".killbad($_POST['leftpic'])."',".$_POST['istop'].",".$_POST['cod'].",".$_POST['price'].",".$_POST['discount'].")";
	}else{//edit
		$sqlstr="update ".$dbfix."shop_stock set c_id=".$_POST['c_id'].",mac='".$_POST['mac']."',serial='".killbad($_POST['serial'])."',brand='".killbad($_POST['brand'])."',stock='".killbad($_POST['stock'])."',remark='".killbad($_POST['remark'])."',word='".killbad($_POST['word'])."',spic='".killbad($_POST['spic'])."',pic='".killbad($_POST['pic'])."',lpic='".killbad($_POST['leftpic'])."',counter=".$_POST['counter'].",buy_counter=".$_POST['buy_counter'].",istop=".$_POST['istop'].",cod=".$_POST['cod'].",price='".$_POST['price'].",discount=".$_POST['discount']." where id=".$_POST['upid'];
	}
	mysql_query($sqlstr);
	print"<script language=javascript>window.alert('提交成功！');location.href='?types=".$_POST['types']."&c_id=".$_POST['c_id']."';</script>";
break;
case "list":
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr valign=top align=center>
<td>
  <table class=table2>
  <tr><td><img border=0 src='images/s_left_sort.gif' align=absmiddle> <a href='?'>".$tit."分类</a></td></tr>
  <tr><td height=5></td></tr>
  <tr><td class=htd>";
$sqlstr="select id,name from ".$dbfix."shop_product order by name";
$result=mysql_query($sqlstr);
while($data=mysql_fetch_array($result)){
	if($data[0]==$c_id){
	print"<img border=0 src='images/s_left_sort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."' class='red2'>".$data[1]."</a><br>";
	}else{
	print"<img border=0 src='images/s_nsort.gif' align=absmiddle>&nbsp;<a href='?jk_mod=&c_id=".$data[0]."'>".$data[1]."</a><br>";
	}
}
@mysql_free_result($result);
echo"</td></tr>
  </table>
</td>
<td>
  <table cellspacing=1 cellpadding=3 class=table0>
<form name=sel_form action='?action=delete' method=post>
<tr align=center>
<td class=td width='7%'>序号</td>
<td class=td width='48%'>".$tit."SN及整理时间</td>
<td class=td width='10%'>MAC</td>
<td class=td width='8%'>来源</td>
<td class=td width='22%'>相关属性</td>
<td class=td width='5%'><input type=checkbox name=sel_all value='yes' onClick=\"javascript:select_all(this.form);\"></td>
</tr>";
if(!empty($_GET['keyword'])){//keywords
	if($sqladd==""){
		$sqladd=" where sn like '%".$_GET['keyword']."%'";
	}else{
		$sqladd.=" and sn like '%".$_GET['keyword']."%'";
	}
}
$query="select id,c_id,sn,mac,mac2,fw,time1,from,status from ".$dbfix."shop_stock".$sqladd." order by id desc";
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
	echo "<tr><td colspan=6>没有数据</td></tr>";
}else{
	for ($m=0; $m<$pagesize; $m++){
	@mysql_data_seek($result,$start++);
	$data=@mysql_fetch_array($result);
	echo "<tr align=center>
	<td class=tims>".$start."</td>
	<td align=left height='20px;'><span style='float:left'><a href='?action=edit&id=".$data[0]."'>".$data[2]."</a></span>
	<span class=tims alt='".$data[6]."' style='float:right'>".date("Y-m-d",strtotime($data[6]))."</span></td>
	<td>".$data[3]."<br />".$data[4]."</td>
	<td>".$data[7]."</td>
	<td align=left><a href='?action=edit&id=".$data[0]."'><img border=0 src='images/edit.gif' alt='编辑该信息' align=absmiddle></a></td>
	<td><input type=checkbox name=sel_id value='".$data[0]."'></td>
	</tr>";
	if($start==$totalnum){break;}
	}
}
	echo"<tr class=tr1>
	<td colspan=4>
	现有<font class=red>".$pagecount."</font>篇".$tit."，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
if($pagecount>1){
	echo"分页：<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=1>首页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".($nowpage-1).">上页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".($nowpage+1).">下页</a> | 
<a href=".$filename."?keyword=".$keyword."&c_id=".$c_id."&page=".$pagecount.">尾页</a>";
}
	print"</td>
	<td colspan=2 align=center>
	执行
	<select name=sel_type size=1>
<option value='1'>推荐</option>
<option value='0'>取消推荐</option>
<option value='2'>删除</option>
	</select><input type=hidden name=sel_ids>
	<input type=submit value='操作' onclick='return sel_click(this.form)';>
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
$sqlstr="select * from ".$dbfix."shop_stock where id=".$id."";
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	$c_id=$data["c_id"];
	$uid=$data["uid"];
	$cid=$data["cid"];
	$sn=$data["sn"];
	$mac=$data["mac"];
	$mac2=$data["mac2"];
	$fw=$data["fw"];
	$time1=$data["time1"];
	$time2=$data["time2"];
	$word=$data["word"];
	$from=$data["from"];
	$status=$data["status"];
}else{
	$c_id="";
	$uid=0;
	$cid=0;
	$sn="";
	$mac="";
	$mac2="";
	$fw="";
	$time1="";
	$time2="";
	$word="";
	$from="";
	$status="";
}
@mysql_free_result($result);
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>添加".$tit."</td></tr>
<form name=add_frm action='?action=handle' method=post>
<input type=hidden name=upid value='".$id."'>
<input type=hidden name=types value='".$types."'>
<tr>
<td>".$tit."分类：</td>
<td><select name=c_id size=1>";
$sqlstr="select id,name from ".$dbfix."shop_product order by name";
$result=mysql_query($sqlstr);
while($data=mysql_fetch_array($result)){
	if($data[0]==$c_id){
		print"<option value='".$data[0]."' class=bg_2 selected>".$data[1]."</option>";
	}else{
		print"<option value='".$data[0]."' class=bg_2>".$data[1]."</option>";
	}

}
@mysql_free_result($result);
	print"</select>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."MAC：</td>
<td><input type=text name=mac value='".$mac."' size=60 maxlength=50>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."MAC2：</td>
<td><input type=text name=mac2 value='".$mac2."' size=60 maxlength=50></td>
</tr>
<tr>
<td>".$tit."固件：</td>
<td><input type=text name=fw value='".$fw."' size=20 maxlength=20>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td>".$tit."来源：</td>
<td><input type=text name=from value='".$from."' size=15 maxlength=10>&nbsp;<font class=red>*</font></td>
</tr>
<tr>
<td valign=top>".$tit."详细说明：</td>
<td><textarea name=word style='width:670px;height:220px;'>".$word."</textarea></td>
</tr>
<tr>
<td>".$tit."状态：</td>
<td><select name=status>
<option value='在库' selected>在库</option>
<option value='出货'>出货</option>
<option value='借出'>借出</option>
<option value='损坏'>损坏</option></select></td>
</tr>
<tr>
<td>".$tit."负责人：</td>
<td><input type=text name=uid value='".$uid."' size=5 maxlength=10></td>
</tr>
<tr>
<td>".$tit."客户：</td>
<td><input type=text name=cid value='".$cid."' size=5 maxlength=10></td>
</tr>
<tr>
<td></td>
<td height=30><input type=submit value='提交修改'>　　<input type=reset value='重新填写'>　　<input type=button name=go_back value='返回上一页' onclick=\"javascript:history.back(1);\"></td>
</tr></form>
</table>";
break;
}	
include_once('admin_tpl_foot.php');
?>