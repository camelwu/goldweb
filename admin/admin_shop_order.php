<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');

if(!empty($_GET['types'])){
$types=trim($_GET['types']);
}else{
$types=0;
}
if(!empty($_GET['action'])){
$action=$_GET['action'];
}else{
$action="";
}
?>
<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>订单管理</td></tr>
<tr><td align=center colspan=2 height=30>
  <table border=0>
  <tr>
  <td><a href='?types=0'<?php if($types==0){echo" class=red";}?>>未处理订单</a></td>
  <td width=10></td>
  <td><a href='?types=1'<?php if($types==1){echo" class=red";}?>>有问题订单</a></td>
  <td width=10></td>
  <td><a href='?types=5'<?php if($types==5){echo" class=red";}?>>已处理订单</a></td>
  </tr>
  </table>
</td></tr>
<tr>
<td></td>
<td></td>
</tr>
</table>
<table width='90%' height=2><tr class=bg><td></td></tr></table>
<?php
switch ($action){
case "view"://
$sqlstr="select * from shop_orders where id=".$_GET['id']."";
$result=mysql_query($sqlstr);
if($data=mysql_fetch_array($result)){
	$ordernum=$data['ordernum'];
	$nname=$data['nname'];
	$email=$data['email'];
	$phone=$data['phone'];
	$address=$data['address'];
	$code=$data['code'];
	$tim=$data['tim'];
	$remark=$data['remark'];
	$prices=$data['prices'];
	$carry=$data['carry'];
	$types=$data['types'];
	$payment=$data['payment'];
	$ispay=$data['ispay'];
	$dis_tim=$data['dis_tim'];
	$dis_remark=$data['dis_remark'];
}
@mysql_free_result($result);
	print"<table cellspacing=1 cellpadding=4 class=table>
<tr class=bg height=0><td width='20%'></td><td width='80%'></td></tr>
<tr><td class=td colspan=2>浏览订单（".$ordernum."）</td></tr>
<tr>
<td>运送方式：</td>
<td>".$carry."&nbsp;（免费）</td>
</tr>
<tr>
<td>订单总金额：</td>
<td><font class=red>".$prices.".00</font>&nbsp;元</td>
</tr>
<tr>
<td>付款方式：</td>
<td>".$payment."</td>
</tr>
<tr>
<td>收货人姓名：</td>
<td>".$nname."</td>
</tr>
<tr>
<td>收货人地址：</td>
<td>".$address."</td>
</tr>
<tr>
<td>邮政编码：</td>
<td>".$code."</td>
</tr>
<tr>
<td>联系电话：</td>
<td>".$phone."</td>
</tr>
<tr>
<td>电子信箱：</td>
<td>".$email."</td>
</tr>
<tr>
<td>备注信息：</td>
<td>
  <table border=0 width='100%' class=tf>
  <tr><td class=bw>".$remark."</td></tr>
  </table>
</td>
</tr>
<form action='?action=handle' method=post>
<tr>
<td>订单类型：</td>
<td><select name=types>
<option value='0'";if($types==0){echo" selected";}echo">未处理订单</option>
<option value='1'";if($types==1){echo" selected";}echo">有问题订单</option>
<option value='5'";if($types==5){echo" selected";}echo">已处理订单</option>
</select>&nbsp;&nbsp;上次处理时间：".$dis_tim."</td>
</tr>
<tr>
<td valign=top><br>处理信息：<br><=250</td>
<td><textarea name=dis_remark cols=50 rows=5>".$dis_remark."</textarea></td>
</tr>
<tr class=tr1><td colspan=2 align=center height=30><input type=submit value='处理该订单'>　　　<input type=reset value='重新填写'></td></tr>
<input type=hidden name=id value='".$_GET['id']."'>
</form>
</table>";
$sqlstr="select id,pid,name,num,price,discount from shop_oorders where oid=".$_GET['id']."";
$result=mysql_query($sqlstr);
if($result!=""){
print"<table cellspacing=1 cellpadding=4 class=table>
<tr><td colspan=7 align=center>以下是订单（<font class=red>".$ordernum."</font>）的货品清单</td></tr>
<tr height=22 align=center> 
<td width='7%' class=td>序号</td>
<td width='52%' class=td>货品名称</td>
<td width='7%' class=td>数量</td>
<td width='13%' class=td>原价（元）</td>
<td width='8%' class=td>折扣</td>
<td width='13%' class=td>购买（元）</td>
</tr>";
while($data=mysql_fetch_array($result)){
	echo"<tr align=center>
	<td>1</td>
	<td align=left><a href='shop_view.php?id=".$data[1]."' alt='点击浏览货品详细信息' target=_blank>".$data[2]."</a></td>
	<td>".$data[3]."</td>
	<td align=right>".$data[4].".00</td>
	<td>
	<font class=gray>".$data[5]."%</font>
	</td>
	<td align=right><font class=blue>".(($data[4])*($data[5])/100).".00</font></td>
	</tr>";
}
print"<tr class=tr1><td colspan=7 height=30 align=right>订单（<font class=red>".$ordernum."</font>）总的有效金额：<font class=red>".$prices.".00</font>&nbsp;元&nbsp;</td></tr>
</table>";
}
@mysql_free_result($result);
	break;
case "delete"://
	$sel_ids=$_POST['sel_ids'];
	$temp=explode(',',$sel_ids);
	mysql_query("delete from shop_orders where id in(".$sel_ids.")");
	mysql_query("delete from shop_oorders where oid in(".$sel_ids.")");
	print "<script language=javascript>window.alert('已成功的删除了".count($temp)."个订单！');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	break;
case "handle"://
	if(!empty($_POST['id'])){
		$sqlstr="update shop_orders set dis_remark ='".$_POST['dis_remark']."',dis_tim='".date("Y-m-d H:i:s")."',types=".$_POST['types']." where id=".$_POST['id'];
		mysql_query($sqlstr);
		$info="成功";
	}else{
		$info="失败";
	}
	print "<script language=javascript>window.alert('订单处理".$info."！');location.href='".$filename."';</script>";
	break;
default://
	print"<table cellspacing=1 cellpadding=4 class=table>
<form name=sel_form action='?action=delete' method=post>
<tr align=center>
<td class=td width='6%'>序号</td>
<td class=td width='23%'>订 单 号</td>
<td class=td width='15%'>收货人</td>
<td class=td width='16%'>订购时间</td>
<td class=td width='12%'>订购金额</td>
<td class=td width='12%'>支付方式</td>
<td class=td width='10%'>支付否</td>
<td class=td width='6%'><input type=checkbox name=sel_all value='yes' onClick=\"javascript:select_all(this.form);\"></td>
</tr>";
$query="select id,ordernum,nname,tim,prices,payment,ispay from shop_orders where types=".$types." order by id desc";
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
	echo "<tr><td colspan=7>没有数据</td></tr>";
}else{
	for ($m=0; $m<$pagesize; $m++){//按照每页显示条数的设定进行循环
	@mysql_data_seek($result,$start++);
	$data=@mysql_fetch_array($result);
	echo "<tr align=center>
	<td class=tims>".$start."</td>
	<td align=left><a href='?action=view&types=".$types."&id=".$data[0]."'>".$data[1]."</a></td>
	<td align=left>".$data[2]."</td>
	<td><font alt='".$data[3]."' class=tims>".date("m-d h:m",strtotime($data[3]))."</td>
	<td align=right>".$data[4]."</td>
	<td>".$data[5]."</td><td class=gray>";
	if($data[6]==0){
		echo"未支付";
	}else{
		echo"已支付";
	}
	print"</td><td><input type=checkbox name=sel_id value='".$data[0]."'></td>
	</tr>";
	if($start==$totalnum){break;}
	}
}
	print"<tr class=tr1>
	<td colspan=5>
	现有<font class=red>".$pagecount."</font>个订单，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
if($pagecount>1){
	echo"分页：<a href=".$filename."?types=".$types."&page=1>首页</a> | 
<a href=".$filename."?types=".$types."&page=".($nowpage-1).">上页</a> | 
<a href=".$filename."?types=".$types."&page=".($nowpage+1).">下页</a> | 
<a href=".$filename."?types=".$types."&page=".$pagecount.">尾页</a>";
}
	print"</td>
	<td colspan=3 align=center>
	执行
	<select name=sel_type size=1>
	<option value='1'>删除</option>
	</select><input type=hidden name=sel_ids>
	<input type=submit value='操作' onclick=\"return sel_click(this.form)\";>
	</td>
	</tr>
</form></table>";
	break;
}
include_once('admin_tpl_foot.php');
?>