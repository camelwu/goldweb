<?php /* Smarty version 2.6.20, created on 2016-01-20 16:49:25
         compiled from line_plan.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'line_plan.html', 130, false),array('function', 'html_checkboxes', 'line_plan.html', 176, false),array('function', 'html_options', 'line_plan.html', 182, false),array('function', 'html_radios', 'line_plan.html', 252, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_log.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script charset="utf-8" src="includes/func_area2js.php?act=outjs"></script>
	<table cellspacing=1 cellpadding=4 class=table>
		<tr>
			<th colspan=2><?php echo $this->_tpl_vars['tit']; ?>
管理</th>
		</tr>
		<tr>
			<td align=center colspan=2 height=30>
				<?php if ($this->_tpl_vars['types'] == 1): ?><?php else: ?><span style="margin-right: 10px;"><a href='?types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'><?php echo $this->_tpl_vars['tit']; ?>
列表</a></span>
				<span><a href='?action=add&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>添加<?php echo $this->_tpl_vars['tit']; ?>
<?php endif; ?></span>
			</td>
		</tr>
		<tr>
			<td align=center>
				<table border=0 cellspacing=0 cellpadding=2>
					<form action='?action=list' method=get>
						<input type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'> <input type=hidden name=ctype value='<?php echo $this->_tpl_vars['ctype']; ?>
'>
						<tr>
							<td>搜索（<?php echo $this->_tpl_vars['tit']; ?>
）</td>
							<td>目的地：<?php echo $this->_tpl_vars['sel_area']; ?>
</td>
							<td><input type=text name=keyword value='<?php echo $this->_tpl_vars['keyword']; ?>
' size=15 maxlength=20> 关键字</td>
							<td><input type=submit value='搜索'></td>
						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table><?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<form name=sel_form action='?action=operate' method=post>
		<tr>
			<th><input type="checkbox" onclick="select_all(this,'id[]');"></th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
图片</th>
			<th><?php echo $this->_tpl_vars['tit']; ?>
名称</th>
			<th>销售价格</th>
			<th>价格浮动</th>
			<th>团期</th>
			<th>离抵城市</th>
			<th><?php if ($this->_tpl_vars['types'] == 1): ?>发布人<?php else: ?>浏览|报名<?php endif; ?></th>
			<th>管理</th>
		</tr>
		<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
		<tr align=center>
			<td><input type="checkbox" name="id[]" value="<?php echo $this->_tpl_vars['web']['id']; ?>
" style="border:0"></td>
			<td><img src="<?php echo $this->_tpl_vars['web']['url']; ?>
" width="210"
				height="120" border="0"></td>
			<td><?php echo $this->_tpl_vars['web']['title']; ?>
<?php echo $this->_tpl_vars['web']['tips']; ?>
</td>
			<td>内部底价：<?php echo $this->_tpl_vars['web']['price1']; ?>
<br>网上售价：<?php echo $this->_tpl_vars['web']['price2']; ?>
<br>门市售价：<?php echo $this->_tpl_vars['web']['price3']; ?>
<br>同行分销：<?php echo $this->_tpl_vars['web']['price4']; ?>

			</td>
			<td><?php if ($this->_tpl_vars['types'] == 1): ?>浮动：<?php echo $this->_tpl_vars['web']['num']; ?>
图片：<?php echo $this->_tpl_vars['web']['num1']; ?>
行程：<?php echo $this->_tpl_vars['web']['num2']; ?>
<?php else: ?><a href="line_do.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=0&ctype=0">浮动</a><?php echo $this->_tpl_vars['web']['num']; ?>
&nbsp;<a
				href="line_do.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=0&ctype=1">图片</a><?php echo $this->_tpl_vars['web']['num1']; ?>
&nbsp;<a
				href="admin_plan_stroke.php?action=add&routeid=<?php echo $this->_tpl_vars['web']['id']; ?>
">行程(<?php echo $this->_tpl_vars['web']['num2']; ?>
)</a><?php endif; ?></td>
			<td><?php echo $this->_tpl_vars['web']['go_time']; ?>
</td>
			<td><?php echo $this->_tpl_vars['web']['city1']; ?>
-<?php echo $this->_tpl_vars['web']['city2']; ?>
</td>
			<td><?php if ($this->_tpl_vars['types'] == 1): ?><?php echo $this->_tpl_vars['web']['op_user']; ?>
<?php else: ?><?php echo $this->_tpl_vars['web']['hits']; ?>
|<?php echo $this->_tpl_vars['web']['hots']; ?>
<?php endif; ?></td>
			<td><?php if ($this->_tpl_vars['types'] == 1): ?><a href='?action=view&id=<?php echo $this->_tpl_vars['web']['id']; ?>
'>查看</a><?php else: ?><a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
'>编辑</a> <a href="?action=delete&types=<?php echo $this->_tpl_vars['contact']['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
" onclick="javascript:return del_nsort();">删除</a><?php endif; ?></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td colspan=2>&nbsp;操作：<select name="op_type" id="op_type"><?php if ($this->_tpl_vars['types'] == 1): ?><option value="copy">代销</option><?php else: ?><option value="copy">复制</option><option value="into">组合</option><?php endif; ?></select> <input type="submit" value="提交"></td>
    		<td colspan=7 align="right"><?php echo $this->_tpl_vars['multipage']; ?>
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
<?php else: ?>
<script type="text/javascript">var ary = [];</script>
<script charset="utf-8" src="includes/func_area2js.php?act=outjs"></script>
<form name="add_frm" method="post" action="?action=handle" enctype="multipart/form-data">
	<input type=hidden name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
	<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table">
		<tbody>
			<tr>
				<th colspan="2">信息操作</th>
			</tr>
			<tr>
				<td width="14%" align="right">线路类型：</td>
				<td width="86%"><?php echo smarty_function_html_checkboxes(array('name' => 'ro_type','options' => $this->_tpl_vars['ro_type'],'checked' => $this->_tpl_vars['info']['ro_type'],'separator' => ""), $this);?>
</td>
			</tr>
			<tr>
				<td align="right">线路类别：</td>
				<td><select name="classid" class="Select" id="classid"
					style="width: 157px"> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['class'],'selected' => $this->_tpl_vars['info']['classid']), $this);?>

				</select> <select name="classid2" class="Select" id="classid2"
					style="width: 157px">

				</select></td>
			</tr>
			<tr id="ships" style="display: none;">
				<td align="right">邮轮公司：</td>
				<td><select name="yl"><option value="0">无</option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cg_yl'],'selected' => $this->_tpl_vars['info']['yl']), $this);?>

				</select> &nbsp;&nbsp;<select name="sx"><option value="0">无</option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cg_sx'],'selected' => $this->_tpl_vars['info']['sx']), $this);?>

				</select></td>
			</tr>
			<tr>
				<td align="right">小标题：</td>
				<td><input name="biaoti" type="text" class="INPUT" id="price"
					value="<?php echo $this->_tpl_vars['info']['biaoti']; ?>
" size="30" maxlength="60">
					如：北京-西安-甘肃</td>
			</tr>
			<tr>
				<td align="right">标识关键字：</td>
				<td><input name="keywords" type="text" class="INPUT" id="price"
					value="<?php echo $this->_tpl_vars['info']['keywords']; ?>
" size="30" maxlength="60">
					如：厦门9月出行</td>
			</tr>
			<tr>
				<td align="right">产品编号：</td>
				<td><input name="info_id" type="text" class="INPUT"
					id="info_id" value="<?php echo $this->_tpl_vars['info']['info_id']; ?>
" size="30" maxlength="30"></td>
			</tr>
			<tr>
				<td align="right">线路名称：</td>
				<td><input name="title" type="text" class="INPUT" id="title"
					value="<?php echo $this->_tpl_vars['info']['title']; ?>
" size="80" maxlength="60"></td>
			</tr>
			<tr>
				<td align="right">主图上传：</td>
				<td><input type="file" name="pic" size="40"><?php if ($this->_tpl_vars['info']['id'] == ''): ?><input type="hidden" name="url"
					value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php else: ?>图片：<input type="text"
					name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php endif; ?></td>
			</tr>
			<tr>
				<td align="right">出发城市：</td>
				<td><?php echo $this->_tpl_vars['sel_area1']; ?>
</td>
			</tr>
			<tr>
				<td align="right">时间：</td>
				<td><input name="time" type="text" class="INPUT" id="time"
					value="<?php echo $this->_tpl_vars['info']['time']; ?>
" size="5" maxlength="5"></td>
			</tr>
			<tr>
				<td align="right">目的城市：</td>
				<td><?php echo $this->_tpl_vars['sel_area2']; ?>
</td>
			</tr>
			<tr>
				<td align="right">所需签证：</td>
				<td><select name='visa' id='visa'><option value="0">不需要</option></select></td>
			</tr>
			<tr>
				<td align="right">旅游天数：</td>
				<td><input name="go_day" type="text" class="INPUT" id="go_day"
					value="<?php echo $this->_tpl_vars['info']['go_day']; ?>
" size="10" maxlength="6"
					onKeyUp="this.value=this.value.replace(/\D/gi,'');get4day();">
					<span class="title3">天</span>&nbsp;成团人数： <input name="go_num"
					type="text" class="INPUT" id="go_num" value="<?php echo $this->_tpl_vars['info']['go_num']; ?>
"
					size="10" maxlength="8"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')"> <span
					class="title3">人</span>，儿童占座：<?php echo smarty_function_html_radios(array('name' => 'kid','options' => $this->_tpl_vars['r_2'],'checked' => $this->_tpl_vars['info']['kid'],'separator' => ""), $this);?>
</td>
			</tr>
			<tr>
				<td align="right">出团日期：</td>
				<td><?php echo smarty_function_html_radios(array('name' => 'go_type','id' => 'go_type','options' => $this->_tpl_vars['go_type'],'checked' => $this->_tpl_vars['info']['go_type'],'separator' => ""), $this);?>

					<fieldset>
						<legend>团期：</legend>
						<span id="mytime"><input name="go_time" type="text"
							class="INPUT" id="go_time" value="<?php echo $this->_tpl_vars['info']['go_time']; ?>
" size="60"
							maxlength="60"> </span>
					</fieldset>
					</div>
				</td>
			</tr>
			<tr>
				<td align="right">报名截止：</td>
				<td>团期前 <input name="go_reg" type="text" class="INPUT"
					id="go_reg" value="<?php echo $this->_tpl_vars['info']['go_reg']; ?>
" size="4" maxlength="2"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')"> 天
				</td>
			</tr>
			<!--  <tr>
				<td align="right">集合地点：</td>
				<td><input name="add" type="button" value="增加" id="add"><input
					name="del" type="button" value="减少" id="del">
					<ul id="location"></ul></td>
			</tr>-->
			<!--tr>
				<td align="right">是否地接：</td>
				<td><select name="dj"><option value="0" selected="">暂无地接</option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cg_dj'],'selected' => $this->_tpl_vars['info']['dj']), $this);?>

				</select></td>
			</tr-->
			<tr>
				<td align="right">报名须知：</td>
				<td><textarea name="content" id="content" style="width: 700px; height: 100px;"><?php echo $this->_tpl_vars['info']['content']; ?>
</textarea></td>
			</tr>
			<tr>
				<td align="right">行程特色：</td>
				<td><textarea name="feature" id="feature" style="width: 700px; height: 100px;"><?php echo $this->_tpl_vars['info']['feature']; ?>
</textarea></td>
			</tr>
			<tr>
				<td align="right">报价说明：</td>
				<td><textarea name="remark" id="remark" style="width: 700px; height: 100px;"><?php echo $this->_tpl_vars['info']['remark']; ?>
</textarea></td>
			</tr>
			<tr id="ttbj" style="display:;">
				<td align="right">团体包价：</td>
				<td><textarea name="info" style="width: 700px; height: 220px;"><?php echo $this->_tpl_vars['info']['info']; ?>
</textarea></td>
			</tr>
			<tr>
				<td align="right">信息控制：</td>
				<td><?php echo smarty_function_html_checkboxes(array('name' => 'op_type','options' => $this->_tpl_vars['op_type'],'checked' => $this->_tpl_vars['info']['op_type'],'separator' => ""), $this);?>
</td>
			</tr>
			<tr>
				<td align="right">成本价格：</td>
				<td>成人： <input name="price_adult" type="text" class="INPUT"
					id="price_adult" value="<?php echo $this->_tpl_vars['info']['price_adult']; ?>
" size="10"
					maxlength="8" onKeyUp="this.value=this.value.replace(/\D/gi,'')">&nbsp;&nbsp;|&nbsp;&nbsp;儿童：
					<input name="price_kid" type="text" class="INPUT" id="price_kid"
					value="<?php echo $this->_tpl_vars['info']['price_kid']; ?>
" size="10" maxlength="8"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')">&nbsp;&nbsp;+&nbsp;&nbsp;利润：
					<input name="price_profit" type="text" class="INPUT"
					id="price_profit" value="<?php echo $this->_tpl_vars['info']['price_profit']; ?>
" size="10"
					maxlength="8" onKeyUp="this.value=this.value.replace(/\D/gi,'')">&nbsp;&nbsp;=&nbsp;&nbsp;底价：<input
					name="price1" type="text" class="INPUT" id="price1"
					value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="10" maxlength="8"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')"> <span
					class="title3">元(底价为公司内部所见价格)</span></td>
			</tr>
			<tr>
				<td align="right">分销以及售价：</td>
				<td>本网： <input name="price2" type="text" class="input"
					id="price2" onKeyUp="this.value=this.value.replace(/\D/gi,'')"
					size="8" maxlength="8" value="<?php echo $this->_tpl_vars['info']['price2']; ?>
"> <span
					class="title3">元 （网站售价）</span> <br> 门市： <input name="price3"
					type="text" class="input" id="price3"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')" size="8"
					maxlength="8" value="<?php echo $this->_tpl_vars['info']['price3']; ?>
"> 元（门市售价）<br>
					同行： <input name="price4" type="text" class="input" id="price4"
					onKeyUp="this.value=this.value.replace(/\D/gi,'')" size="8"
					maxlength="8" value="<?php echo $this->_tpl_vars['info']['price4']; ?>
"> <span
					class="title3">元（同行分销价）</span><br></td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td><input type="submit" class="bt" value="提交信息" />
					&nbsp;&nbsp; <input type="reset" class="bt" value="重新填写">
					&nbsp;&nbsp; <input type="button" class="bt"
					onClick="window.location='?action=list';" value="返回操作"></td>
			</tr>
		</tbody>
	</table>
</form>



<script type="text/javascript">
//ajax插入visa
function get4visa(){
	visa2.empty();
	$.ajax({
		type : "GET",
		dataType : "json",
		url : "getajax.php?q=getvisa&types=2",
		data : "aid=" + aid2.val(),
		complete : function() {
		},
		success : function(data, textStatus) {
				var pid_select = "<?php echo $this->_tpl_vars['info']['visa']; ?>
";
				$.each(data,function(index, item) {
					if (pid_select == index) {
						visa2.append("<option value='"+index+"' selected='selected'>"+item+"</option>");
					} else {
						visa2.append("<option value='"+index+"'>" + item + "</option>");
					}
				});
		}
	});
}

function searcharea(_id,_iname){
	var s1 = $("input[name='"+_id+"']").val();
	$("#"+_id).load("getajax.php?q=getsearcharea&s1="+s1+"&iname="+_iname);
}
function del_nsort() {
	var cf = window.confirm("是否确定该操作？");
	return cf;
}
function ship_init(){
	if(ctype.val()==118){
		$("#ships").show();
	}else{
		$("#ships").hide();
	}
}
			var ctype = $("select[name='classid']");
			var ctype1 = $("select[name='classid2']");
			
			function ctype_init() {
				ctype1.empty();
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getclass",
							data : "pid=" + ctype.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['classid2']; ?>
";
								if(data!=null){
									$.each(data,function(index, item) {
										if (pid_select == index) {
											ctype1.append("<option value='"+index+"'  selected=\"selected\">"
															+ item
															+ "</option>");
										} else {
											ctype1.append("<option value='"+index+"'>"
															+ item
															+ "</option>");
										}
									});
								}//end if
							}
						});
			}
			ctype_init();
			ctype.change(function() {
				ctype_init();ship_init();
			});
//设定原值
var gt = ["","","",""];
$("input:radio[name='go_type']").click(function(){
	var val = parseInt($(this).val());
	val = val>gt.length?gt.length:val;
	var istr= '',v='',obj = _('mytime');
	switch(val){
		case 1:
			v = gt[val]!="" ? gt[val]:"";
			for(var i=1;i<8;i++){
				var cstr = v.indexOf(i)>-1?" checked":"";
				istr += '<label><input name="go_time" id="go_time'+i+'" type="checkbox" value="'+i+'"'+cstr+'>周'+i+'</label> ';
			}
			obj.innerHTML = istr;
		break;
		case 2:
			v = gt[val]!="" ? gt[val]:"";
			for(var i=1;i<32;i++){
				var cpos = v.indexOf(i);
				var cstr = cpos>-1?" checked":"";
				if(i<10&&cpos>-1){
					if(cpos==0){
						cstr = isNum(v.substring(cpos+1,cpos+2))?"":" checked";
					}else{
						cstr = isNum(v.substring(cpos+1,cpos+2))||isNum(v.substring(cpos-1,cpos))?"":" checked";
					}
					//alert(cpos+'&'+v.substring(cpos+1,cpos+2));
				}
				istr += '<label><input name="go_time" id="go_time'+i+'" type="checkbox" value="'+i+'"'+cstr+'>'+i+'号</label> ';
			}
			obj.innerHTML = istr;
		break;
		case 3:
			v = gt[val]!="" ? gt[val]:"";
			istr += '<input name="go_time" id="go_time" type="text" class="input" value="'+v+'" size="60" maxlength="60">';
			obj.innerHTML = istr;
		break;
		default:
			v = gt[val]!="" ? gt[val]:"";
			obj.innerHTML = '每天发团<input name="go_time" type="hidden" id="go_time" value="'+v+'" />';
	}
});
//行程输入
function next_departure(v,n){
	//var cf = window.confirm("自动输入下一天日程离城市？");
	var t = $("#go_day").val();
	if(n<t){
		//var v = d.value;
		if(v.indexOf('|')>0){
			arr_c = v.split('|');
		}else{
			arr_c = [v];
		}
		$("#departure0"+(n+1)).val(arr_c[arr_c.length-1]);
	}
}
//定义全局行程天数
var day = 0;
var stroke_field = $("fieldset[name='stroke_field']");
var hasstroke = <?php if ($this->_tpl_vars['stroke'] != ''): ?>1<?php else: ?>0<?php endif; ?>;
function get4day(){
	var gnum = parseInt($("#go_day").val());
	if(isNum(gnum)){
		var ary = new Array(gnum-1);
		var sstr='';
		var dep = $("#city1").val();
		var ari = $("#city2").val();
		var c1,c2;
		if(hasstroke==0){
		for(var i=1;i<=gnum;i++){
			
			if(i==1){
				c1 = dep;c2=ari;
			}else if(i==gnum){
				c1 = ari;c2=dep;
			}else{
				c1 = ari;c2=ari;
			}
			sstr += '\
			<div id="d'+i+'">第<input name="num[]" type="text" value="'+i+'" size="2" readonly>天<input type="hidden" name="sid[]" value=""><br>\
			离城市：<input name="departure[]" type="text" class="INPUT" id="departure0'+i+'" value="'+c1+'" maxlength="10"> 时间：<input name="timd[]" type="text" class="INPUT" value=""><br>\
			抵城市：<input name="arrived[]" type="text" id="arrived0'+i+'" value="'+c2+'" maxlength="60" onblur="next_departure(this.value,'+i+');"> 时间：<input name="tima[]" type="text" class="INPUT" value=""> 注：可多个抵达城市，用|分隔<br>\
			<strong>行</strong>：<select name="traffic[]" id="traffic0'+i+'"><option label="无" value="null" selected="selected">无</option><option value="plane">飞机</option><option value="train">火车</option><option value="ship">轮船</option><option value="car">汽车</option></select> <input name="tname[]" type="text" id="tid'+i+'" value=""> 参考航班、火车等交通信息，如无可不填写。<br>\
<strong>食</strong>：<label><input type="checkbox" name="eat'+i+'[]" value="1">早</label><label><input type="checkbox" name="eat'+i+'[]" value="2">中</label><label><input type="checkbox" name="eat'+i+'[]" value="3">晚</label><br>\
<strong>住</strong>：<input type="text" name="hotel[]" id="hotel0'+i+'" value=""><br>\
<strong>娱：</strong> <input type="button" name="s" id="s0'+i+'" value="查询" onClick="get4city('+i+',3);"><span id="scenic0'+i+'"></span><br>\
<textarea name="content[]" id="cont'+i+'" style="width:500px;height:120px;"></textarea><hr></div>\
';
		}//for
		stroke_field.html('<legend> 行程明细</legend>'+sstr);
		day = gnum;hasstroke=1;
		}else{//行程天数有变？
			var cf = window.confirm("是否确定‘行程天数’有变？");
			if(cf){//确认
				if(day>gnum){//原始记录比当前，删除
					for(var i=(gnum+1);i<=day;i++){
						$("div").detach("#d"+i);
					}
				}else{//alert(day+'=='+gnum);
					for(var i=(day+1);i<=gnum;i++){
						if(i==gnum){
							c1 = ari;c2=dep;
						}else{
							c1=i==1?dep:ari;
							c2=ari;
						}
						sstr = '\
			<div id="d'+i+'">第<input name="num[]" type="text" value="'+i+'" size="2" readonly>天<input type="hidden" name="sid[]" value=""><br>\
			离城市：<input name="departure[]" type="text" class="INPUT" id="departure0'+i+'" value="'+c1+'" maxlength="10"> 时间：<input name="timd[]" type="text" class="INPUT" value=""><br>\
			抵城市：<input name="arrived[]" type="text" id="arrived0'+i+'" value="'+c2+'" maxlength="60"> 时间：<input name="tima[]" type="text" class="INPUT" value=""> 注：可多个抵达城市，用|分隔<br>\
			<strong>行</strong>：<select name="traffic[]" id="traffic0'+i+'"><option label="无" value="null" selected="selected">无</option><option value="plane">飞机</option><option value="train">火车</option><option value="ship">轮船</option><option value="car">汽车</option></select> <input name="tname[]" type="text" id="tid'+i+'" value=""> 参考航班、火车等交通信息，如无可不填写。<br>\
<strong>食</strong>：<label><input type="checkbox" name="eat'+i+'[]" value="1">早</label><label><input type="checkbox" name="eat'+i+'[]" value="2">中</label><label><input type="checkbox" name="eat'+i+'[]" value="3">晚</label><br>\
<strong>住</strong>：<input type="text" name="hotel[]" id="hotel0'+i+'" value=""><br>\
<strong>娱：</strong> <input type="button" name="search" id="s0<?php echo $this->_tpl_vars['web']['num']; ?>
" value="查询" onClick="get4city('+i+',3);"><span id="scenic0'+i+'"></span><br>\
<textarea name="content[]" id="cont'+i+'" style="width:500px;height:120px;"></textarea><hr></div>\
';
						stroke_field.append(sstr);
					}
				}
				day = gnum;
			}else{
				$("#go_day").val(day);
			}
		}
	}else{
		alert("旅行天数请输入数字！");
		$("#go_day").focus();
	}
}

//ajax插入scenic&hotel
function get4city(n,t){
	var hotel = $("#star0"+n);
	var scenic = $("#scenic0"+n);
	var city2 = $("#arrived0"+n).val();
	if(t==0){//hotel
	
	$.ajax({
		type : "GET",
		dataType : "json",
		url : "getajax.php?q=city2&types=0",
		data : "city2=" + city2,
		complete : function() {
		},
		success : function(data, textStatus) {
			if(data!=null)
			{
			var pid_select = "<?php echo $this->_tpl_vars['info']['star']; ?>
";
			$.each(data,function(index, item) {
				if (pid_select == index) {
					hotel.append("<option value='"+index+"'  selected=\"selected\">"
									+ item
									+ "</option>");
				} else {
					hotel.append("<option value='"+index+"'>"
									+ item
									+ "</option>");
				}
			});
			}else{
				hotel.html('<option value="0">未查询到相关酒店</option>');
			}
		}
	});
	}else{//scenic
	
	$.ajax({
		type : "GET",
		dataType : "json",
		url : "getajax.php?q=city2&types=3",
		data : "city2=" + $("#departure0"+n).val()+"|"+$("#arrived0"+n).val(),//scenic->2city
		complete : function() {
		},
		success : function(data, textStatus) {
			if(data!=null)
			{
			scenic.html(" ");
			$.each(data,function(town, dat) {
				scenic.append('<br><strong>'+town+'：</strong><br>');
				if(isEmptyValue(dat)){
					$.each(dat,function(index,item){
						//checked？
						var ischk = in_array(ary[n],index)?'checked':'';
						scenic.append("<label><input name='scenic"+n+"[]' type='checkbox' value='"+index+"' '"+ischk+"'>" +item+ "</label>");
					});
				}else{scenic.append('<font color="red">未查询到相关景点信息</font>');}
			});
			}else{
				scenic.html("未查询到相关景点信息");
			}
		}
	});
	}
}
//行程类型选择
$("input:radio[name='d_type']").click(
	function () {
		if($(this).val()==1){//upload excel
			$("div[name='stroke_up']").show();
			$("fieldset[name='stroke_field']").hide();
		}else{
			$("fieldset[name='stroke_field']").show();
			$("div[name='stroke_up']").hide();
			if(!_("d1")){get4day();}
		}
	}
);
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
		$("#location").append('<li id="location_0'+snum+'">第'+snum+' 地点：<input name="addr[]" type="text" value="" size="10" maxlength="30"> 时间：<input name="tim[]" type="text" value="" size="3" maxlength="5"></li>');
	}
);
$("#del").click(function(){$("li").remove("#location_0"+snum);snum>=1?--snum:null;});
//
function _(id){
	return document.getElementById(id);
}
function isNum(str){
	var re = /^-{0,1}\d*\.{0,1}\d+$/;
    return (re.test(str));
}
//
function in_array(arr,n){ 
	// 判断参数是不是数组 
	var isArr = arr && console.log( typeof arr==='object' ? arr.constructor===Array ? arr.length ? arr.length===1 ? arr[0]:arr.join(','):'an empty array': arr.constructor: typeof arr );
	// 不是数组则抛出异常 
	if(!isArr){ 
		return false;
	}
	// 遍历是否在数组中 
	for(var i=0,k=arr.length;i<k;i++){ 
		if(n==arr[i]){ 
		return true; 
		} 
	}
	// 如果不在数组中就会返回false 
	return false; 
}
var isEmptyValue = function(obj){
	if (typeof obj === "object" && !(obj instanceof Array)){
		var hasProp = false;
		for (var prop in obj){
			hasProp = true;
			break;
		}
		if (hasProp){
			obj = [obj];return true;
		}else{
			//throw "It is empty object";
			return false;
		}
	}
}
</script>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>