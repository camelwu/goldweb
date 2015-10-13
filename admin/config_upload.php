<?php
require_once('includes/init.php');
require_once('includes/checklogin.php');
include_once('admin_tpl_head.php');

$action = isset($_GET['action'])?$_GET['action']:"";
$keyword = isset($_GET['keyword'])?$_GET['keyword']:"";
//$page = isset($_GET['page'])?$_GET['page']:1;
$tit = '上传日志';

	
	echo"<table cellspacing=1 cellpadding=3 class=table>
	<tr align=center>
	<th>管理员上传日志</th>
	</tr>
	<tr>
	<td>相关操作</td>
	</tr>
	</table>
	<table cellspacing=1 cellpadding=2 class=table>
	<tr>
		<th width=36%>图片</th>
		<th width=8%>类型</th>
		<th width=10%>大小(KB)</th>
		<th width=14%>栏目、ID</th>
		<th width=9%>上传人</th>
		<th width=17%>上传时间</th>
	</tr>";
	$sqlstr="select * from ".$dbfix."attached  order by addtime desc";
	$result=$db->query_select($sqlstr);
	$pagesize=25;//设置每页显示条数
	$totalnum=$db->num_rows($result);//总数
	$pagecount=getCount($totalnum,$pagesize);
	if(isset($_GET['page'])){
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
	
	if($totalnum>0){
		for ($m=0; $m<$pagesize; $m++){
			@mysql_data_seek($result,$start++);
			$data=@mysql_fetch_array($result);
			echo"<tr align=center><td align=left>".$data["filepath"]."</td><td>".$data["ext"]."</td><td>".$data["sizes"]."KB</td><td>".$data["sort"]."&nbsp;".$data["pid"]."</td><td>".$data['name']."</td><td>".$data['addtime']."</td></tr>";
		}
		if($start==$totalnum){break;}
		echo"<tr class=tr1>
	<td colspan=7>
	现有<font class=red>".$totalnum."</font>篇".$tit."，
	页次：<font class=red>".$nowpage."</font>/<font class=red>".$pagecount."</font>";
	if($pagecount>1){
		echo"分页：<a href=".$filename."?keyword=".$keyword."&page=1>首页</a> | 
		<a href=".$filename."?keyword=".$keyword."&page=".($nowpage-1).">上页</a> | 
		<a href=".$filename."?keyword=".$keyword."&page=".($nowpage+1).">下页</a> | 
		<a href=".$filename."?keyword=".$keyword."&page=".$pagecount.">尾页</a> </td></tr>";
	}
	}else{
		echo "<tr><td colspan=7>暂无信息！</td></tr>";
	}
	echo"</table>";
include_once('admin_tpl_foot.php');
?>