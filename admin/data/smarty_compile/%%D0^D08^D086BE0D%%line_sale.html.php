<?php /* Smarty version 2.6.20, created on 2015-08-04 11:00:15
         compiled from line_sale.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'line_sale.html', 124, false),array('function', 'html_options', 'line_sale.html', 217, false),array('function', 'html_checkboxes', 'line_sale.html', 230, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table cellspacing="1" cellpadding="4" class="table">
	<tbody><tr><th colspan="2">线路<?php echo $this->_tpl_vars['tit']; ?>
管理</th></tr>
	<tr><td align="center" colspan="2" height="30">
	<table border="0">
	<tbody><tr>
	<td><a href="?types=0&ctype=0"<?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '0'): ?>class="red"<?php endif; ?>>我的<?php echo $this->_tpl_vars['tit']; ?>
列表</a></td>
    <td width="10"></td>
	<td><a href="?types=1&ctype=0"<?php if ($this->_tpl_vars['types'] == '1' && $this->_tpl_vars['ctype'] == '0'): ?>class="red"<?php endif; ?>>他人<?php echo $this->_tpl_vars['tit']; ?>
列表</a></td>
	<td width="10"></td>
	<td><a href="?types=0&ctype=1"<?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '1'): ?>class="red"<?php endif; ?>>我的转销列表</a></td>
	</tr>
	</tbody></table>
	</td></tr>
	<tr><td align="center">
	<table border="0" cellspacing="0" cellpadding="2">
	<form action="?action=list" method="get">
	<input type="hidden" name="types" value="<?php echo $this->_tpl_vars['types']; ?>
"><input type="hidden" name="ctype" value="<?php echo $this->_tpl_vars['ctype']; ?>
">
	<tr>
	<td>搜索（<?php echo $this->_tpl_vars['tit']; ?>
） 关键字：</td>
	<td><input type="text" name="keyword" value="" size="15" maxlength="20"></td>
	<td><input type="submit" value="搜索"></td>
	</tr>
	</form>
	</table>
	</td></tr>
</tbody></table>
        <?php if ($this->_tpl_vars['action'] == 'list'): ?>
			<table cellspacing=1 cellpadding=4 class=table>
			<form name=sel_form action='?action=delete' method=post>
				<tr>
					<th>ID</th>
					<?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '1'): ?><th>线路销售名称</th><?php else: ?><th><?php echo $this->_tpl_vars['tit']; ?>
图片</th><?php endif; ?>
					<th>线路计划名称</th>
					<th>销售价格</th>
					<th>价格浮动</th>
					<th>团期</th>
                    <th>离抵城市</th>
                    <th>发布人</th>
					<th>操作</th>
				</tr>
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
				<tr align=center>
					<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
					<td><?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '1'): ?><?php echo $this->_tpl_vars['web']['name']; ?>
<?php else: ?><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
" width="210" height="120" border="0"><?php endif; ?></td>
					<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
					<td>计划底价：<?php echo $this->_tpl_vars['web']['price1']; ?>
<br>计划售价：<?php echo $this->_tpl_vars['web']['price2']; ?>
<?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '1'): ?><br>销售利润：<?php echo $this->_tpl_vars['web']['price_1']; ?>
<br>转销价格：<?php echo $this->_tpl_vars['web']['price_2']; ?>
<?php endif; ?></td>
					<td><a href="?action=price&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
">浮动</a><?php echo $this->_tpl_vars['web']['num']; ?>
</td>
					<td><?php echo $this->_tpl_vars['web']['go_time']; ?>
</td>
					<td><?php if ($this->_tpl_vars['types'] == '0' && $this->_tpl_vars['ctype'] == '1'): ?><?php echo $this->_tpl_vars['web']['departure']; ?>
-><?php endif; ?><?php echo $this->_tpl_vars['web']['city1']; ?>
-<?php echo $this->_tpl_vars['web']['city2']; ?>
</td><td><?php echo $this->_tpl_vars['web']['op_user']; ?>
</td>
					<td><a href='?action=view&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>浏览</a><?php if ($this->_tpl_vars['types'] == '1'): ?> <a href='?action=add&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>转销</a><?php else: ?> <a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&hid=<?php echo $this->_tpl_vars['web']['hid']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>编辑</a><?php endif; ?></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr>
					<td colspan=9><?php echo $this->_tpl_vars['multipage']; ?>
</td>
				</tr>
			</form>
		</table>
		<?php elseif ($this->_tpl_vars['action'] == 'view'): ?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
  <tbody><tr>
    <th colspan="2">信息浏览</th>
  </tr>
  <tr>
    <td align="right">线路类型：</td>
    <td><?php echo $this->_tpl_vars['info']['ro_type']; ?>
</td>
  </tr>
  <tr>
    <td align="right">线路类别：</td>
    <td><?php echo $this->_tpl_vars['class1']; ?>
-<?php echo $this->_tpl_vars['class2']; ?>
</td>
  </tr>
  <tr>
    <td align="right">标识字段：</td>
    <td><?php echo $this->_tpl_vars['info']['keywords']; ?>
</td>
  </tr>
  <tr>
    <td width="14%" align="right">线路名称：</td>
    <td width="86%"><?php echo $this->_tpl_vars['info']['title']; ?>
</td>
  </tr>
  <tr>
    <td align="right">旅游天数：</td>
    <td><?php echo $this->_tpl_vars['info']['go_day']; ?>
<span class="title3">天</span>&nbsp;成团人数<?php echo $this->_tpl_vars['info']['go_num']; ?>
 <span class="title3">人</span>，儿童占座：<?php if ($this->_tpl_vars['info']['kid'] == '1'): ?>是<?php else: ?>否<?php endif; ?>
      </td>
  </tr>
  <tr>
    <td align="right">出发城市：</td>
    <td><?php echo $this->_tpl_vars['info']['city1']; ?>
</td>
  </tr>
  <tr>
    <td align="right">目的城市：</td>
    <td><?php echo $this->_tpl_vars['info']['city2']; ?>
</td>
  </tr>
  <tr>
    <td align="right">所需签证：</td>
    <td><?php echo $this->_tpl_vars['info']['visa']; ?>
</td>
  </tr>
  <tr>
    <td align="right">出团日期：</td>
    <td><?php echo $this->_tpl_vars['info']['go_time']; ?>
</td>
  </tr>
  <tr>
    <td align="right">报名截止：</td>
    <td>团期前<?php echo $this->_tpl_vars['info']['go_reg']; ?>
天</td>
  </tr>
  <tr>
    <td align="right">集合地点：</td>
    <td><ul id="location"></ul></td>
  </tr>
  <tr>
    <td align="right">主图上传：</td>
    <td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['info']['url']; ?>
"></td>
  </tr>
  <tr valign="top">
    <td align="right">行程内容：</td>
    <td><?php if ($this->_tpl_vars['info']['d_type'] == '1'): ?><?php echo $this->_tpl_vars['info']['file']; ?>
<?php else: ?><fieldset name="stroke_chk">
<legend> 行程明细</legend>
	<?php $_from = $this->_tpl_vars['stroke']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['stroke'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['stroke']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['web']):
        $this->_foreach['stroke']['iteration']++;
?>
    第 <?php echo $this->_tpl_vars['web']['num']; ?>
 天<br>
	<strong>行</strong>：<?php echo $this->_tpl_vars['web']['timd']; ?>
离<?php echo $this->_tpl_vars['web']['departure']; ?>
 -<?php echo $this->_tpl_vars['web']['traffic']; ?>
- <?php echo $this->_tpl_vars['web']['tima']; ?>
抵<?php echo $this->_tpl_vars['web']['arrived']; ?>
<br>
      <strong>食</strong>：
      <?php echo $this->_tpl_vars['web']['eats']; ?>
<br>
	  <strong>住</strong>：<?php echo $this->_tpl_vars['web']['hotel']; ?>
<br>
      <strong>娱：</strong><?php echo $this->_tpl_vars['web']['scenic']; ?>
<br>
    <strong>行程：</strong><?php echo ((is_array($_tmp=$this->_tpl_vars['web']['content'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<hr>
	<?php endforeach; endif; unset($_from); ?>
    </fieldset><?php endif; ?></td>
  </tr>
  <tr>
    <td align="right">是否地接：</td>
    <td><?php echo $this->_tpl_vars['info']['dj']; ?>
</td>
  </tr>
  <tr>
    <td align="right">线路说明：</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['remark'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
  </tr>
  <tr>
    <td align="right">行程特色：</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['feature'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
  </tr>
  <tr>
    <td align="right">团体包价：</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['info'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
  </tr>
  <tr>
    <td align="right">信息控制：</td>
    <td><?php echo $this->_tpl_vars['info']['op_type']; ?>
</td>
  </tr>
  <tr>
    <td align="right">销售价格：</td>
    <td>本网：<?php echo $this->_tpl_vars['info']['price2']; ?>
<br>门市：<?php echo $this->_tpl_vars['info']['price3']; ?>
<br>分销：<?php echo $this->_tpl_vars['info']['price4']; ?>
<br></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</tbody>
</table>
<script type="text/javascript">
//集合地点
var snum = 0;
var sadd = '<?php echo $this->_tpl_vars['info']['addr']; ?>
';var stim = '<?php echo $this->_tpl_vars['info']['tim']; ?>
';
var cadd = sadd.split(',');var catt = stim.split(',');
if(cadd.length>0){
	snum = cadd.length;
	for(var i=0;i<snum;i++){
		$("#location").append('<li>第'+(i+1)+' 地点：'+cadd[i]+'， 时间：'+catt[i]+'</li>');
	}
}
</script>
<?php elseif ($this->_tpl_vars['action'] == 'price'): ?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
<tr>
<th colspan="2"><?php echo $this->_tpl_vars['route']['title']; ?>
-价格浮动表</th>
</tr>
<tr>
    <td width="13%" align="right">出团信息：</td>
    <td width="87%"><font color="red"><?php echo $this->_tpl_vars['route']['go_num']; ?>
</font>人成团， <?php echo $this->_tpl_vars['route']['go_time']; ?>
发团， 出团前 <font color="red"><?php echo $this->_tpl_vars['route']['go_reg']; ?>
</font> 天截止报名</td>
  </tr>
			<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hotel'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hotel']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['web']):
        $this->_foreach['hotel']['iteration']++;
?>
				<tr>
					<td align="right" class="style101">(<?php echo ($this->_foreach['hotel']['iteration']-1)+1; ?>
)原因说明：</td>
					<td><?php echo $this->_tpl_vars['web']['title']; ?>
</td>
                </tr>
				<tr>
					<td align="right" class="style100">报价变动：</td>
					<td><?php echo $this->_tpl_vars['Config']['float'][$this->_tpl_vars['web']['pass']]; ?>
￥<?php echo $this->_tpl_vars['web']['price']; ?>
</td>
				</tr>
				<tr>
					<td align="right" class="style100">变动时间：</td>
					<td><?php echo $this->_tpl_vars['web']['time']; ?>
</td>
				</tr>			
		<?php endforeach; endif; unset($_from); ?>
		</table>
<?php else: ?>
<form name="myform_1" method="post" action="?action=handle" onsubmit="return checkfrm(this);">
<input type=hidden name="id" value="<?php echo $this->_tpl_vars['route']['id']; ?>
"><input type=hidden name="hid" value="<?php echo $this->_tpl_vars['info']['hid']; ?>
"><input name="ctype" type=hidden id="ctype" value="1">
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
  <tbody><tr>
    <th colspan="2"><?php echo $this->_tpl_vars['route']['title']; ?>
-分销操作</th>
  </tr>
  <tr>
    <td align="right">出团信息：</td>
    <td><font color="red"><?php echo $this->_tpl_vars['route']['go_num']; ?>
</font>人成团， <?php echo $this->_tpl_vars['route']['go_time']; ?>
发团， 出团前 <font color="red"><?php echo $this->_tpl_vars['route']['go_reg']; ?>
</font> 天截止报名</td>
  </tr>
  <tr>
    <td align="right">出发城市：</td>
    <td><input name="departures" type="text" class="INPUT"  size="12" maxlength="8"><input type=button value="search"
					onclick="javascript:searcharea('departures','departure');" /> <br>
					<div id="departures"><?php echo $this->_tpl_vars['info']['departure']; ?>
</div> </td>
  </tr>
  <tr>
    <td align="right">出发时间：</td>
    <td><input name="time" type="text" class="INPUT" id="time" value="<?php echo $this->_tpl_vars['info']['time']; ?>
" size="5" maxlength="5"></td>
  </tr>
  <tr>
    <td align="right">交通工具：</td>
    <td><select name="traffic" id="traffic"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['traffic'],'selected' => $this->_tpl_vars['info']['traffic']), $this);?>
</select>
      参考航班或车次：<input name="tname" type="text" id="tname" value="<?php echo $this->_tpl_vars['info']['tname']; ?>
"> </td>
  </tr>
  <tr>
    <td width="14%" align="right">线路名称：</td>
    <td width="86%"><input name="title" type="text" class="INPUT" id="title" value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="80" maxlength="60"></td>
  </tr>
  <tr>
    <td align="right">集合地点：</td>
    <td><input name="add" type="button" value="增加" id="add"><input name="del" type="button" value="减少" id="del"><ul id="location"></ul></td>
  </tr>
  <tr>
    <td align="right">信息控制：</td>
    <td><?php echo smarty_function_html_checkboxes(array('name' => 'op_type','options' => $this->_tpl_vars['op_type'],'checked' => $this->_tpl_vars['info']['op_type'],'separator' => ""), $this);?>
</td>
  </tr>
  <tr>
    <td align="right">销售价格：</td>
    <td>成本：<?php echo $this->_tpl_vars['route']['price2']; ?>
元 &nbsp;+ &nbsp; 利润：<input name="price1" type="text" class="INPUT" id="price1" value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="10" maxlength="8" onKeyUp="this.value=this.value.replace(/\D/gi,'');set_price(this);"> = <input name="price2" type="text" class="input" id="price2" onKeyUp="this.value=this.value.replace(/\D/gi,'')" size="8" maxlength="8" value="<?php echo $this->_tpl_vars['info']['price2']; ?>
">
       <span class="title3">元 （网站售价）</span></td>
  </tr>
  <tr>
    <td align="right"></td>
    <td><input type="submit" class="bt" value="提交信息" />      &nbsp;&nbsp;
      <input type="reset" class="bt" value="重新填写">
      &nbsp;&nbsp;
      <input type="button" class="bt" onClick="window.location='?action=list';" value="返回操作"></td>
  </tr>
</tbody>
</table>
</form>
<script language=javascript>

function searcharea(_id,_iname){
	var s1 = $("input[name='"+_id+"']").val();
	$("#"+_id).load("getajax.php?q=getsearcharea&s1="+s1+"&iname="+_iname);
}

function checkfrm(frm){
	if(frm.departure.value==''){
		alert("请输入出发城市");
		frm.departure.focus();
		return false;
	}else if(frm.time.value==''||!isTime(frm.time.value)){
		alert("请输入“00:00”格式的出发时间");
		frm.time.focus();
		return false;
	}else if(frm.title.value==''){
		alert("请输入线路名称");
		frm.title.focus();
		return false;
	}else if(frm.price1.value==''){
		alert("请输入利润，可为0");
		frm.price1.focus();
		return false;
	}else if(frm.price2.value==''){
		alert("请输入售价");
		frm.price2.focus();
		return false;
	}else{
		return true;
	}
}
//
var t0 = '<?php echo $this->_tpl_vars['route']['title']; ?>
';var p0 = <?php echo $this->_tpl_vars['route']['price2']; ?>
;
function set_title(id){
	var v = id.value+'-'+t0;
	$("#title").val(v);
}
function set_price(id){
	var p1 = p0+parseInt(id.value);
	$("#price2").val(p1);
}
//集合地点
var snum = 0;
var sadd = '<?php echo $this->_tpl_vars['info']['addr']; ?>
';var stim = '<?php echo $this->_tpl_vars['info']['tim']; ?>
';
var cadd = sadd.split(',');var catt = stim.split(',');
if(cadd.length>0){
	snum = cadd.length;
	for(var i=0;i<snum;i++){
		$("#location").append('<li id="location_0'+(i+1)+'">第'+(i+1)+' 地点：<input name="addr[]" type="text" value="'+cadd[i]+'" size="10" maxlength="30"> 时间：<input name="tim[]" type="text" value="'+catt[i]+'" size="3" maxlength="5"></li>');
	}
}else{
	
}
$("#add").click(
	function(){
		++snum;
		$("#location").append('<li id="location_0'+snum+'">第'+snum+' 地点：<input name="addr[]" type="text" class="INPUT" id="addr0'+snum+'" value="" size="30" maxlength="60"> 时间：<input name="tim[]" type="text" class="INPUT" id="tim0'+snum+'" value=""></li>');
	}
);
$("#del").click(function(){$("li").remove("#location_0"+snum);snum>=1?--snum:null;});
/////////////////////////////////////////
function _(id){
	return document.getElementById(id);
}
function isNum(str){
	var re = /^-{0,1}\d*\.{0,1}\d+$/;
    return (re.test(str));
}
function isTime(str){
	var re=/[0-2][0-9](:|：)[0-5][0-9]$/;
	return (re.test(str));
}
</script>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>