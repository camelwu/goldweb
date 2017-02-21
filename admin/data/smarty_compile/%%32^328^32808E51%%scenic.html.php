<?php /* Smarty version 2.6.20, created on 2015-10-28 13:43:40
         compiled from scenic.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'scenic.html', 99, false),array('function', 'html_radios', 'scenic.html', 340, false),array('function', 'html_checkboxes', 'scenic.html', 397, false),)), $this); ?>
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
				<table border=0>
					<tr>
						<td><a href='?types=<?php echo $this->_tpl_vars['types']; ?>
'><?php echo $this->_tpl_vars['tit']; ?>
列表</a></td>
						<td width=10></td>
						<td><a href='?action=add&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>添加<?php echo $this->_tpl_vars['tit']; ?>
</a></td>
					</tr>
				</table>
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
列表）</td>
							<td><?php echo $this->_tpl_vars['sel_area']; ?>
</td>
							<td><input type=text name=keyword value='<?php echo $this->_tpl_vars['keyword']; ?>
' size=15 maxlength=20> 关键字</td>
							<td><input type=submit value='搜索'></td>
						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
<?php if ($this->_tpl_vars['action'] == 'list'): ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<th>ID</th>
		<th><?php if ($this->_tpl_vars['types'] == '6'): ?>车牌号：座位数<?php else: ?><?php echo $this->_tpl_vars['tit']; ?>
名称<?php endif; ?></th> <?php if ($this->_tpl_vars['types'] == '2'): ?>
		<th>签证国家</th><?php elseif ($this->_tpl_vars['types'] == '5'): ?>
		<th><?php echo $this->_tpl_vars['tit']; ?>
类别</th><?php else: ?>
		<th>图片</th><?php endif; ?> <?php if ($this->_tpl_vars['types'] != '5'): ?>
		<th>报价&信息</th>
		<th>所在地区</th> <?php else: ?>
		<th>编辑</th> <?php endif; ?>
		<th>管理</th>
	</tr>
	<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['web']):
?>
	<tr align=center>
		<td><?php echo $this->_tpl_vars['web']['id']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['web']['title']; ?>
<?php if ($this->_tpl_vars['types'] == '6'): ?>:<?php echo $this->_tpl_vars['Config']['vehicle'][$this->_tpl_vars['web']['vehicle']]; ?>
<?php endif; ?><?php echo $this->_tpl_vars['web']['tips']; ?>
</td> <?php if ($this->_tpl_vars['types'] == '2'): ?>
		<td><?php echo $this->_tpl_vars['web']['stock']; ?>
</td><?php elseif ($this->_tpl_vars['types'] == '5'): ?>
		<td><?php echo $this->_tpl_vars['hotel'][$this->_tpl_vars['web']['ctype']]; ?>
 -> <?php echo $this->_tpl_vars['Allclass'][$this->_tpl_vars['web']['ctype1']]; ?>
</td> <?php else: ?>
		<td><img src="<?php echo $this->_tpl_vars['picserver']; ?>
<?php echo $this->_tpl_vars['web']['url']; ?>
" width=150 height="150"></td><?php endif; ?>
		<?php if ($this->_tpl_vars['types'] != '5'): ?>
		<td><?php if ($this->_tpl_vars['types'] == '6'): ?> 包车底价：￥<?php echo $this->_tpl_vars['web']['price']; ?>
元<br />
			包车门市：￥<?php echo $this->_tpl_vars['web']['price1']; ?>
元<br /> 接送底价：￥<?php echo $this->_tpl_vars['web']['price2']; ?>
元<br />
			接送门市：￥<?php echo $this->_tpl_vars['web']['price3']; ?>
元<br /> <?php elseif ($this->_tpl_vars['types'] == '1' || $this->_tpl_vars['types'] == '2' || $this->_tpl_vars['types'] == '3'): ?> 底价：￥<?php echo $this->_tpl_vars['web']['price']; ?>
元<br />门市：￥<?php echo $this->_tpl_vars['web']['price1']; ?>
元<br />
			<?php else: ?> <a href="hotel.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=0"><?php if ($this->_tpl_vars['types'] == '4'): ?>餐费<?php else: ?>客房<?php endif; ?></a><span class="title3">(<?php echo $this->_tpl_vars['web']['num']; ?>
)</span>
			<?php endif; ?> <?php if ($this->_tpl_vars['types'] != '2' && $this->_tpl_vars['types'] != '6'): ?> &nbsp; <a
			href="hotel.php?id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=1">图片</a><span
			class="title3">(<?php echo $this->_tpl_vars['web']['num1']; ?>
)</span> <?php endif; ?>
		</td>
		<td><?php echo $this->_tpl_vars['area'][$this->_tpl_vars['web']['cid']]; ?>
-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['aid']]; ?>
<?php if ($this->_tpl_vars['types'] != '2'): ?>-<?php echo $this->_tpl_vars['areatt'][$this->_tpl_vars['web']['city']]; ?>
<?php endif; ?></td> <?php else: ?>
		<td><?php echo $this->_tpl_vars['web']['op_user']; ?>
</td> <?php endif; ?>
		<td><a href='?action=edit&id=<?php echo $this->_tpl_vars['web']['id']; ?>
&types=<?php echo $this->_tpl_vars['web']['types']; ?>
'>编辑</a>
			<?php if ($this->_tpl_vars['web']['userid'] == $this->_tpl_vars['adminid'] || $this->_tpl_vars['adminid'] == ""): ?><a
			href="?action=delete&types=<?php echo $this->_tpl_vars['web']['types']; ?>
&id=<?php echo $this->_tpl_vars['web']['id']; ?>
"
			onclick="javascript:return del_nsort();">删除</a><?php endif; ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr class=tr1>
		<td colspan=8><?php echo $this->_tpl_vars['multipage']; ?>
</td>
	</tr>
</table>
<table width='90%' height=2>
	<tr class=bg>
		<td></td>
	</tr>
</table>
<?php else: ?>
<table cellspacing=1 cellpadding=4 class=table>
	<tr>
		<td class=td colspan=2>添加<?php echo $this->_tpl_vars['tit']; ?>
</td>
	</tr>
	<form name=add_frm action='?action=handle' method=post
		enctype="multipart/form-data">
		<input type=hidden name=id value='<?php echo $this->_tpl_vars['info']['id']; ?>
'> <input
			type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['tit']; ?>
<?php if ($this->_tpl_vars['types'] == '6'): ?>牌号<?php else: ?>名称<?php endif; ?>：</td>
			<td><input type=text name=title size=30 value='<?php echo $this->_tpl_vars['info']['title']; ?>
'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['hotname']; ?>
:<select
				name='ctype' id='ctype'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['hotel'],'selected' => $this->_tpl_vars['info']['ctype']), $this);?>

			</select><?php if ($this->_tpl_vars['types'] == '5'): ?>&nbsp;&nbsp;<select name='ctype1' id='ctype1'></select><?php endif; ?><font
				class=red>*</font></td>
		</tr>
		<tr>
			<td align="right">产品编号：</td>
			<td><input name="info_id" type="text" class="INPUT" id="info_id"
				value="<?php echo $this->_tpl_vars['info']['info_id']; ?>
" size="30" maxlength="30"></td>
		</tr>
		<?php if ($this->_tpl_vars['types'] != '5'): ?>
		<tr>
			<td align="right">所在地区：</td>
			<td><select name='cid' id='cid'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['area'],'selected' => $this->_tpl_vars['info']['cid']), $this);?>

			</select>&nbsp;&nbsp;&nbsp;&nbsp;<select name=aid>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['types'] != '2'): ?><select name=city></select><?php endif; ?></td>
		</tr>
		<?php endif; ?> <?php if ($this->_tpl_vars['types'] != '2'): ?>
		<tr>
			<td align="right">图片上传：</td>
			<td><input type=file name=pic size=40><?php if ($this->_tpl_vars['info']['id'] == ''): ?><input type="hidden" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php else: ?>图片：<input
				type="text" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php endif; ?></td>
		</tr>
		<?php endif; ?> <?php if ($this->_tpl_vars['types'] == '0'): ?>
		<!-- 酒店 -->
		<tr>
			<td align="right">特殊早餐：</td>
			<td>中早:<input name="price" type="text" class="INPUT" id="price"
				value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="12" maxlength="10"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
				class="title3">元</span> 美早:<input name="price1" type="text"
				class="INPUT" id="price1" value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="12"
				maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
				<span class="title3">元</span> 日早:<input name="price2" type="text"
				class="INPUT" id="price2" value="<?php echo $this->_tpl_vars['info']['price2']; ?>
" size="12"
				maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
				<span class="title3">元</span> 它早:<input name="price3" type="text"
				class="INPUT" id="price3" value="<?php echo $this->_tpl_vars['info']['price3']; ?>
" size="12"
				maxlength="10" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
				<span class="title3">元</span>
			</td>
		</tr>
		<tr>
			<td align="right">酒店地址：</td>
			<td><input name="address" type="text" class="INPUT" id="address"
				value="<?php echo $this->_tpl_vars['info']['address']; ?>
" size="15">&nbsp;&nbsp;所在方位：<input
				name="pos" type="text" class="INPUT" id="pos" value="<?php echo $this->_tpl_vars['info']['pos']; ?>
"
				size="15" /></td>
		</tr>
		<tr>
			<td align="right">联系电话：</td>
			<td><input name="tel" type="text" class="INPUT" id="tel"
				value="<?php echo $this->_tpl_vars['info']['tel']; ?>
" size="15">&nbsp;&nbsp;传真号码：<input
				name="fax" type="text" class="INPUT" id="fax" value="<?php echo $this->_tpl_vars['info']['fax']; ?>
"
				size="15"></td>
		</tr>
		<tr>
			<td align="right">联 系 人：</td>
			<td><input name="names" type="text" class="INPUT" id="names"
				value="<?php echo $this->_tpl_vars['info']['names']; ?>
" size="15" />&nbsp;&nbsp;手机号码：<input
				name="mobile" type="text" class="INPUT" id="mobile"
				value="<?php echo $this->_tpl_vars['info']['mobile']; ?>
" size="15"></td>
		</tr>
		<?php elseif ($this->_tpl_vars['types'] == '1'): ?>
		<!-- 商品 -->
		<tr>
			<td align="right">商品编号：</td>
			<td><input name="serial" type="text" class="INPUT" id="serial"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['serial']; ?>
" size="15"> &nbsp;&nbsp;条形码： <input
				name="codes" type="text" class="INPUT" id="codes"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['codes']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td width="14%" align="right">商品材质：</td>
			<td><input name="material" type="text" class="INPUT"
				id="material" value="<?php echo $this->_tpl_vars['info']['material']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">所属品牌：</td>
			<td><input name="brand" type="text" class="INPUT" id="brand"
				value="<?php echo $this->_tpl_vars['info']['brand']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">商品特色：</td>
			<td><input name="item" type="text" class="INPUT" id="item"
				value="<?php echo $this->_tpl_vars['info']['item']; ?>
" size="15" /></td>
		</tr>
		<tr>
			<td align="right">规格参数：</td>
			<td><input name="size" type="text" class="INPUT" id="size"
				value="<?php echo $this->_tpl_vars['info']['size']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">销售底价：</td>
			<td><input name="price" type="text" class="INPUT" id="price"
				value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="10" maxlength="8"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
				class="title3">元</span>&nbsp;门市价格： <input name="price1" type="text"
				class="INPUT" id="price1" value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="10"
				maxlength="8" onKeyUp='this.value=this.value.replace(/\D/gi,"")'>
				<span class="title3">元</span></td>
		</tr>
		<tr>
			<td align="right">库存：</td>
			<td><input name="stock" type="text" class="INPUT" id="stock"
				value="<?php echo $this->_tpl_vars['info']['stock']; ?>
" size="15"> <label for="stock">有货/紧张/缺货</label></td>
		</tr>
		<?php elseif ($this->_tpl_vars['types'] == '2'): ?>
		<!-- 签证 -->
		<tr>
			<td align="right">受理时间：</td>
			<td><input name="brand" type="text" class="INPUT" id="brand" value="<?php echo $this->_tpl_vars['info']['brand']; ?>
" size="15"> <span class="title3">个工作日</span></td>
		</tr>
		<tr>
			<td align="right">有 效 期：</td>
			<td><input name="item" type="text" class="INPUT" id="item" value="<?php echo $this->_tpl_vars['info']['item']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">停 留 期：</td>
			<td><input name="size" type="text" class="INPUT" id="size"
				value="<?php echo $this->_tpl_vars['info']['size']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">领区名称：</td>
			<td><input name="stock" type="text" class="INPUT" id="stock"
				value="<?php echo $this->_tpl_vars['info']['stock']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">资料文档：</td>
			<td><input type=file name=pic size=40><?php if ($this->_tpl_vars['info']['id'] == ''): ?><input type="hidden" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php else: ?>资料地址：<input
				type="text" name="url" value="<?php echo $this->_tpl_vars['info']['url']; ?>
"><?php endif; ?></td>
		</tr>
		<tr>
			<td align="right">销售底价：</td>
			<td><input name="price" type="text" class="INPUT" id="price"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="15"><span class="title3">
					元(￥)</span></td>
		</tr>
		<tr>
			<td align="right">门市价格：</td>
			<td><input name="price1" type="text" class="INPUT" id="price1"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="15"> <span class="title3">
					元(￥)</span></td>
		</tr>
		<?php elseif ($this->_tpl_vars['types'] == '3'): ?>
		<!-- 景点 -->
		<tr>
			<td align="right">主题类型：</td>
			<td><input name="brand" type="text" class="INPUT" id="brand"
				value="<?php echo $this->_tpl_vars['info']['brand']; ?>
" size="60">亲子、滑雪等</td>
		</tr>
		<tr>
			<td align="right">游览时间：</td>
			<td><input name="item" type="text" class="INPUT" id="item"
				value="<?php echo $this->_tpl_vars['info']['item']; ?>
" size="15"></td>
		</tr>
		<tr>
			<td align="right">江湖索道：</td>
			<td><input name="price2" type="text" class="INPUT" id="price2"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['price2']; ?>
" size="15"> <span class="title3">元(￥)</span></td>
		</tr>
		<tr>
			<td align="right">货币类型：</td>
			<td><input name="material" type="text" class="INPUT" id="material" value="<?php echo $this->_tpl_vars['info']['material']; ?>
" size="15"><span class="title3">(美元、欧元、人民币等)</span></td>
		</tr>
		<tr>
			<td align="right">销售底价：</td>
			<td><input name="price" type="text" class="INPUT" id="price" onKeyUp='this.value=this.value.replace(/\D/gi,"")' value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="15"><span class="title3">元</span></td>
		</tr>
		<tr>
			<td align="right">门市价格：</td>
			<td><input name="price1" type="text" class="INPUT" id="price1"
				onKeyUp='this.value=this.value.replace(/\D/gi,"")'
				value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="15"> <span class="title3">
					元(￥)</span></td>
		</tr>
		<tr>
			<td align="right">特色亮点：</td>
			<td><textarea name="keyword" cols="70" rows="12"><?php echo $this->_tpl_vars['info']['keyword']; ?>
</textarea></td>
		</tr>
		<!-- <tr>
			<td align="right">所在地址：</td>
			<td><input name="address" type="text" class="INPUT" id="address"
				value="<?php echo $this->_tpl_vars['info']['address']; ?>
" size="80"></td>
		</tr> -->
		<tr>
			<td align="right">交通信息：</td>
			<td><textarea name="pos" cols="70" rows="12" class="INPUT"
					id="pos"><?php echo $this->_tpl_vars['info']['pos']; ?>
</textarea></td>
		</tr>

		<?php elseif ($this->_tpl_vars['types'] == '4'): ?>
		<!-- 餐厅 -->
	<tr>
		<td align="right">餐厅地址：</td>
		<td><input name="address" type="text" class="INPUT" id="address"
			value="<?php echo $this->_tpl_vars['info']['address']; ?>
" size="15">&nbsp;&nbsp;所在方位：<input
			name="pos" type="text" class="INPUT" id="pos" value="<?php echo $this->_tpl_vars['info']['pos']; ?>
"
			size="15" />&nbsp;&nbsp;营业时间：<input name="times" type="text"
			class="INPUT" id="times" value="<?php echo $this->_tpl_vars['info']['times']; ?>
" size="15"></td>
	</tr>
	<tr>
		<td align="right">联系电话：</td>
		<td><input name="tel" type="text" class="INPUT" id="tel"
			value="<?php echo $this->_tpl_vars['info']['tel']; ?>
" size="15">&nbsp;&nbsp;传真号码：<input
			name="fax" type="text" class="INPUT" id="fax" value="<?php echo $this->_tpl_vars['info']['fax']; ?>
"
			size="15"></td>
	</tr>
	<tr>
		<td align="right">联 系 人：</td>
		<td><input name="names" type="text" class="INPUT" id="names"
			value="<?php echo $this->_tpl_vars['info']['names']; ?>
" size="15" />&nbsp;&nbsp;手机号码：<input
			name="mobile" type="text" class="INPUT" id="mobile"
			value="<?php echo $this->_tpl_vars['info']['mobile']; ?>
" size="15"></td>
	</tr>
	<tr>
		<td align="right">停 车 位：</td>
		<td><input name="post" type="text" class="INPUT" id="post"
			value="<?php echo $this->_tpl_vars['info']['post']; ?>
" size="15"
			onKeyUp="this.value=this.value.replace(/\D/gi,&quot;&quot;)" />个</td>
	</tr>
	<?php elseif ($this->_tpl_vars['types'] == '5'): ?>
	<tr>
		<td height="25" align="right">关 键 字：</td>
		<td><input name="keyword" type="text" class="INPUT" id="keyword"
			value="<?php echo $this->_tpl_vars['info']['keyword']; ?>
" size="90" maxlength="60"> <span
			class="title3">注：多个用“|”分开
				</th>
	</tr>

	<?php elseif ($this->_tpl_vars['types'] == '6'): ?>
	<tr>
		<td align="right">租车规格：</td>
		<td><?php echo smarty_function_html_radios(array('name' => 'vehicle','options' => $this->_tpl_vars['Config']['vehicle'],'checked' => $this->_tpl_vars['info']['vehicle'],'separator' => "&nbsp;"), $this);?>
</td>
	</tr>
	<tr>
		<td align="right">联系电话：</td>
		<td><input name="tel" type="text" class="INPUT" id="tel"
			value="<?php echo $this->_tpl_vars['info']['tel']; ?>
" size="15"></td>
	</tr>
	<tr>
		<td align="right">接送底价：</td>
		<td><input name="price" type="text" class="INPUT" id="price"
			onKeyUp='this.value=this.value.replace(/\D/gi,"")'
			value="<?php echo $this->_tpl_vars['info']['price']; ?>
" size="8" maxlength="8"> <span
			class="title3">元/次</span>&nbsp;&nbsp;&nbsp;&nbsp;门市价格： <input
			name="price1" type="text" class="INPUT" id="price1"
			value="<?php echo $this->_tpl_vars['info']['price1']; ?>
" size="8" maxlength="8"
			onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
			class="title3">元/次</span></td>
	</tr>
	<tr>
		<td align="right">包车底价：</td>
		<td><input name="price2" type="text" class="INPUT" id="price2"
			onKeyUp='this.value=this.value.replace(/\D/gi,"")'
			value="<?php echo $this->_tpl_vars['info']['price2']; ?>
" size="8" maxlength="8"> <span
			class="title3">元/天</span>&nbsp;&nbsp;&nbsp;&nbsp;门市价格： <input
			name="price3" type="text" class="INPUT" id="price3"
			value="<?php echo $this->_tpl_vars['info']['price3']; ?>
" size="8" maxlength="8"
			onKeyUp='this.value=this.value.replace(/\D/gi,"")'> <span
			class="title3"> 元/天</span></td>
	</tr>

	<?php endif; ?>
	<tr>
		<td align="right"><?php echo $this->_tpl_vars['tit']; ?>
介绍：</td>
		<td><textarea name=word style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['word']; ?>
</textarea></td>
	</tr>
	<tr>
		<td align="right"><?php if ($this->_tpl_vars['types'] == '0'): ?>服务项目<?php else: ?>备注<?php endif; ?>：</td>
		<td><textarea name=info style='width: 670px; height: 220px;'><?php echo $this->_tpl_vars['info']['info']; ?>
</textarea></td>
	</tr>
	<?php if ($this->_tpl_vars['types'] == '5'): ?>
	<tr>
		<td height="12" align="right">文章来源：</td>
		<td>网站名称： <input name="op_name" type="text" class="INPUT"
			id="op_name" size="20" maxlength="25" value="<?php echo $this->_tpl_vars['info']['op_name']; ?>
">
			&nbsp;&nbsp;&nbsp; 网站地址： <input name="op_url" type="text"
			class="INPUT" id="op_url" size="35" maxlength="60"
			value="<?php echo $this->_tpl_vars['info']['op_url']; ?>
"></td>
	</tr>
	<tr>
		<td height="12" align="right">编辑人员：</td>
		<td><input name="op_user" type="text" class="INPUT" id="op_user"
			size="18" maxlength="30" value="<?php echo $this->_tpl_vars['info']['op_user']; ?>
"></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td align="right">信息控制：</td>
		<td><?php echo smarty_function_html_checkboxes(array('name' => 'op_type','options' => $this->_tpl_vars['op_type'],'checked' => $this->_tpl_vars['info']['op_type'],'separator' => ""), $this);?>
</td>
	</tr>
	<tr>
		<td></td>
		<td height=30><input type=submit value='提交添加'> <input
			type=reset value='重新填写'> <input type=button name=go_back
			value='返回上一页' onClick="javascript:location.href='?action=list&types=<?php echo $this->_tpl_vars['types']; ?>
';"></td>
	</tr>
	</form>
</table>

<script language=javascript>
			var cid = $("select[name='cid']");
			var aid = $("select[name='aid']");
			var city = $("select[name='city']");
			var ctype = $("select[name='ctype']");
			var ctype1 = $("select[name='ctype1']");
			
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
								var pid_select = "<?php echo $this->_tpl_vars['info']['ctype1']; ?>
";
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
							}
						});
			}
			ctype_init();
			ctype.change(function() {
				ctype_init();
			});
			
			function cid_init() {
				aid.empty();
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getarea",
							data : "classid=" + cid.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['aid']; ?>
";
								$.each(data,function(index, item) {
													if (pid_select == index) {
														aid.append("<option value='"+index+"'  selected=\"selected\">"
																		+ item
																		+ "</option>");
													} else {
														aid.append("<option value='"+index+"'>"
																		+ item
																		+ "</option>");
													}
												});
								aid_init();
							}
						});
			}
			cid_init();
			cid.change(function() {
				cid_init();
			});
			aid.change(function() {
				aid_init();
			});
			function aid_init() {
				city.empty();
				$.ajax({
							type : "GET",
							dataType : "json",
							url : "getajax.php?q=getarea&types=1",
							data : "classid=" + cid.val() + "&pid=" + aid.val(),
							complete : function() {
							},
							success : function(data, textStatus) {
								var pid_select = "<?php echo $this->_tpl_vars['info']['city']; ?>
";
								$.each(data,function(index, item) {
													if (pid_select == index) {
														city.append("<option value='"+index+"'  selected=\"selected\">"
																		+ item
																		+ "</option>");
													} else {
														city.append("<option value='"+index+"'>"
																		+ item
																		+ "</option>");
													}
												});
							}
						});
			}
		</script>

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_tpl_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>