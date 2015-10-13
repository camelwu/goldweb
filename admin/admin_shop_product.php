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
$sqladd="";
$c_id=0;$tit="产品";
$nsort="shop";
echo list_top($tit,$nsort,$nsort,$c_id);
?>
<?php
switch ($action){
case "delete":
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	if($_POST['sel_type']==2){
		$sqlstr="delete from ".$dbfix."shop_product where id in(".$sel_ids.")";
		$opea="删除";
	}else{
		$sqlstr="update ".$dbfix."shop_product set status=".$_POST['sel_type']." where id in(".$sel_ids.")";
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
		$sqlstr="insert into ".$dbfix."shop_product(name,brand,stock,content,word,pic) values('".$_POST['name']."','".$_POST['brand']."','".$_POST['content']."','".$htmlData."','".killbad($_POST['pic'])."')";
	}else{//edit
		$sqlstr="update ".$dbfix."shop_product set name='".$_POST['name']."',brand='".killbad($_POST['brand'])."',content='".killbad($_POST['content'])."',word='".$htmlData."',pic='".killbad($_POST['pic'])."' where id=".$_POST['upid'];
	}
	echo($sqlstr);mysql_query($sqlstr);
break;
case "list":
	print"<table cellspacing=1 cellpadding=4 class=table>
<form name=sel_form action='?action=delete' method=post>
<tr align=center>
<td class=td width='7%'>序号</td>
<td class=td width='66%'>".$tit."名字及库存</td>
<td class=td width='22%'>相关属性</td>
<td class=td width='5%'><input type=checkbox name=sel_all value='yes' onClick=\"javascript:select_all(this.form);\"></td>
</tr>";
if(!empty($_GET['keyword'])){//keywords
	if($sqladd==""){
		$sqladd=" where name like '%".$_GET['keyword']."%'";
	}else{
		$sqladd.=" and name like '%".$_GET['keyword']."%'";
	}
}
$query="select id,name,stock,pic,content from ".$dbfix."shop_product".$sqladd." order by id desc";
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
	<td align=left height='20px;'><span style='float:left'><a href='?action=edit&id=".$data[0]."' title='".$data[4]."' alt='".$data[4]."'>".$data[1]."</a></span>
	<span class=tims alt='".$data[2]."' style='float:right'>".$data[2]."</span></td>
	<td align=left><a href='?action=edit&id=".$data[0]."'><img border=0 src='images/edit.gif' alt='编辑该信息' align=absmiddle></a>";
	if($data[3]!=""){
		echo"&nbsp;<img border=0 src='images/ispic.gif' alt='图片' align=absmiddle>";
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
<option value='2'>删除</option>
	</select><input type=hidden name=sel_ids>
	<input type=submit value='操作' onclick='return sel_click(this.form)';>
	</td>
	</tr>
</form>
</table>
";
break;
default:
if(!empty($_GET['id'])){
	$id=$_GET['id'];
}else{
	$id=0;
}
$sqlstr="select * from ".$dbfix."shop_product where id=".$id."";
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	$name=$data["name"];
	$brand=$data["brand"];
	$stock=$data["stock"];
	$content=$data["content"];
	$word=$data["word"];
	$pic=$data["pic"];
}else{
	$name="";
	$brand="Arec";
	$stock="0";
	$content="";
	$word="";
	$pic="";
}
if($pic==""){$upname=randnum("big");}else{$upname=$pic;}
@mysql_free_result($result);
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>添加".$tit."</td></tr>
<form name='add_frm' action='?action=handle' method='post'>
<input type=hidden name=upid value='".$id."'>
<input type=hidden name=types value='".$types."'>
<tr>
<td>".$tit."名称：</td>
<td><input type=text name=name value='".$name."' size=60 maxlength=50>&nbsp;<font class=red>*</font>&nbsp;</td>
</tr>
<tr>
<td>".$tit."品牌：</td>
<td><input type=text name=brand value='".$brand."' size=20 maxlength=20></td>
</tr>
<tr>
<td valign=top>".$tit."简单说明：</td>
<td><textarea name=content style='width:670px;height:120px;'>".$content."</textarea></td>
</tr><tr>
<td valign=top>".$tit."详细说明：</td>
<td><textarea name=word style='width:670px;height:220px;visibility:hidden;'>".htmlspecialchars($word)."</textarea></td>
</tr>
<tr>
<td>".$tit."图片：</td>
<td><input type=text name=pic value='".$pic."' size=40 maxlength=100>&nbsp;&nbsp;&nbsp;<a href='upload.php?uppath=shop&upname=".$upname."&uptext=pic' target=upload_frame>上传图片</a></td>
</tr>
<tr>
<td>上传图片：</td>
<td><iframe frameborder=0 name=upload_frame width='100%' height=30 scrolling=no src='upload.php?uppath=shop&upname=".$upname."&uptext=pic'></iframe></td>
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