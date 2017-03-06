<?php /* Smarty version 2.6.20, created on 2017-03-05 20:11:58
         compiled from D:%5Clocal%5Cgoldweb/view/list_tours.html */ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['cnname']; ?>
_旅行社_<?php echo $this->_tpl_vars['ktitle']; ?>
_金桥</title>
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/global.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/index.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/index.js"></script>
</head>
<body>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


	<div class="wrapper now_position">
		<!--当前位置-->
		<a href="/">首页</a>&gt;<a href="/<?php echo $this->_tpl_vars['enname']; ?>
/"><?php echo $this->_tpl_vars['cnname']; ?>
</a>
	</div>
	<!--根据不同列表做变化-->
	<?php if ($this->_tpl_vars['enname'] == 'cruises'): ?>
	<div class="cruises_banner">
		<!--top-img-->
		<?php unset($this->_sections['web']);
$this->_sections['web']['name'] = 'web';
$this->_sections['web']['loop'] = is_array($_loop=$this->_tpl_vars['banner']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['web']['show'] = true;
$this->_sections['web']['max'] = $this->_sections['web']['loop'];
$this->_sections['web']['step'] = 1;
$this->_sections['web']['start'] = $this->_sections['web']['step'] > 0 ? 0 : $this->_sections['web']['loop']-1;
if ($this->_sections['web']['show']) {
    $this->_sections['web']['total'] = $this->_sections['web']['loop'];
    if ($this->_sections['web']['total'] == 0)
        $this->_sections['web']['show'] = false;
} else
    $this->_sections['web']['total'] = 0;
if ($this->_sections['web']['show']):

            for ($this->_sections['web']['index'] = $this->_sections['web']['start'], $this->_sections['web']['iteration'] = 1;
                 $this->_sections['web']['iteration'] <= $this->_sections['web']['total'];
                 $this->_sections['web']['index'] += $this->_sections['web']['step'], $this->_sections['web']['iteration']++):
$this->_sections['web']['rownum'] = $this->_sections['web']['iteration'];
$this->_sections['web']['index_prev'] = $this->_sections['web']['index'] - $this->_sections['web']['step'];
$this->_sections['web']['index_next'] = $this->_sections['web']['index'] + $this->_sections['web']['step'];
$this->_sections['web']['first']      = ($this->_sections['web']['iteration'] == 1);
$this->_sections['web']['last']       = ($this->_sections['web']['iteration'] == $this->_sections['web']['total']);
?> <a href="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['mypath']; ?>
"
			class="cruises_top" target="_blank"><img
			src="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['url']; ?>
" width="1920" height="330" /></a> <?php endfor; endif; ?>
	</div>
	<?php else: ?>
	<div class="wrapper">
		<!--top-img-->
		<?php if ($this->_tpl_vars['enname'] == 'overseas' || $this->_tpl_vars['enname'] == 'route'): ?> <?php unset($this->_sections['web']);
$this->_sections['web']['name'] = 'web';
$this->_sections['web']['loop'] = is_array($_loop=$this->_tpl_vars['banner']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['web']['show'] = true;
$this->_sections['web']['max'] = $this->_sections['web']['loop'];
$this->_sections['web']['step'] = 1;
$this->_sections['web']['start'] = $this->_sections['web']['step'] > 0 ? 0 : $this->_sections['web']['loop']-1;
if ($this->_sections['web']['show']) {
    $this->_sections['web']['total'] = $this->_sections['web']['loop'];
    if ($this->_sections['web']['total'] == 0)
        $this->_sections['web']['show'] = false;
} else
    $this->_sections['web']['total'] = 0;
if ($this->_sections['web']['show']):

            for ($this->_sections['web']['index'] = $this->_sections['web']['start'], $this->_sections['web']['iteration'] = 1;
                 $this->_sections['web']['iteration'] <= $this->_sections['web']['total'];
                 $this->_sections['web']['index'] += $this->_sections['web']['step'], $this->_sections['web']['iteration']++):
$this->_sections['web']['rownum'] = $this->_sections['web']['iteration'];
$this->_sections['web']['index_prev'] = $this->_sections['web']['index'] - $this->_sections['web']['step'];
$this->_sections['web']['index_next'] = $this->_sections['web']['index'] + $this->_sections['web']['step'];
$this->_sections['web']['first']      = ($this->_sections['web']['iteration'] == 1);
$this->_sections['web']['last']       = ($this->_sections['web']['iteration'] == $this->_sections['web']['total']);
?> <a href="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['mypath']; ?>
" class="overseas_top" target="_blank"><img
			src="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['url']; ?>
" width="1200" height="160" /></a> <?php endfor; endif; ?>
		<?php else: ?>
		<ul class="domestic_top">
			<?php unset($this->_sections['web']);
$this->_sections['web']['name'] = 'web';
$this->_sections['web']['loop'] = is_array($_loop=$this->_tpl_vars['banner']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['web']['show'] = true;
$this->_sections['web']['max'] = $this->_sections['web']['loop'];
$this->_sections['web']['step'] = 1;
$this->_sections['web']['start'] = $this->_sections['web']['step'] > 0 ? 0 : $this->_sections['web']['loop']-1;
if ($this->_sections['web']['show']) {
    $this->_sections['web']['total'] = $this->_sections['web']['loop'];
    if ($this->_sections['web']['total'] == 0)
        $this->_sections['web']['show'] = false;
} else
    $this->_sections['web']['total'] = 0;
if ($this->_sections['web']['show']):

            for ($this->_sections['web']['index'] = $this->_sections['web']['start'], $this->_sections['web']['iteration'] = 1;
                 $this->_sections['web']['iteration'] <= $this->_sections['web']['total'];
                 $this->_sections['web']['index'] += $this->_sections['web']['step'], $this->_sections['web']['iteration']++):
$this->_sections['web']['rownum'] = $this->_sections['web']['iteration'];
$this->_sections['web']['index_prev'] = $this->_sections['web']['index'] - $this->_sections['web']['step'];
$this->_sections['web']['index_next'] = $this->_sections['web']['index'] + $this->_sections['web']['step'];
$this->_sections['web']['first']      = ($this->_sections['web']['iteration'] == 1);
$this->_sections['web']['last']       = ($this->_sections['web']['iteration'] == $this->_sections['web']['total']);
?>
			<li class="dom_t<?php echo $this->_sections['web']['index']+1; ?>
"><a
				href="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['mypath']; ?>
" target="_blank"><img
					src="<?php echo $this->_tpl_vars['banner'][$this->_sections['web']['index']]['url']; ?>
"<?php if ($this->_sections['web']['index']+1 == '4'): ?> width="240" height="330"<?php elseif ($this->_sections['web']['index']+1 == '7'): ?> width="444" height="160" <?php else: ?> width="240"
					height="160"<?php endif; ?> /></a></li> <?php endfor; endif; ?>
		</ul>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="wrapper">
		<?php if ($this->_tpl_vars['template'] != 'branch'): ?><!--出发地目的地筛选-->
		<div class="address_select clrfix">
			<ul class="set_out_box clrfix">
				<!--出发地-->
				<li>出发地：</li>
				<li><span<?php if ($this->_tpl_vars['go_start'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span></li>

				<?php $_from = $this->_tpl_vars['chufa']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['chufaitem']):
?>
				<li><span<?php if ($this->_tpl_vars['go_start'] == $this->_tpl_vars['key']): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['key']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['chufaitem']; ?>
</a></span></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul class="dest_zhou_box clrfix">
				<!--目的地-洲-->
				<div class="dest_hd">目的地：</div>
				<li<?php if ($this->_tpl_vars['go_end'] == ''): ?> class="dest_zhou_on"<?php endif; ?>><a
					href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
--<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></li>
				<?php $_from = $this->_tpl_vars['mudi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mudikey'] => $this->_tpl_vars['mudiitem']):
?>
				<li<?php if ($this->_tpl_vars['go_end'] == $this->_tpl_vars['mudikey']): ?> class="dest_zhou_on"<?php endif; ?>><a
					href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['mudikey']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['mudiitem']['title']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul class="dest_guo_box">
				<!--目的地-国家-->
				<li class="clrfix dest_guo_on" id="dest_guo_on"></li>
				<script language=javascript>
					loadcontent('<?php echo $this->_tpl_vars['enname']; ?>
', '<?php echo $this->_tpl_vars['go_end']; ?>
', '<?php echo $this->_tpl_vars['go_end2']; ?>
');
					function loadcontent(_enname, _end, _end2) {
						var url = '/getajax.php?action=getend&end='
								+ _end
								+ '&end2='
								+ _end2
								+ '&enname='
								+ _enname
								+ "&go_start=<?php echo $this->_tpl_vars['go_start']; ?>
&go_days=<?php echo $this->_tpl_vars['go_days']; ?>
&go_starttime=<?php echo $this->_tpl_vars['go_starttime']; ?>
&go_endtime=<?php echo $this->_tpl_vars['go_endtime']; ?>
&go_money=<?php echo $this->_tpl_vars['go_money']; ?>
&go_tuijian=<?php echo $this->_tpl_vars['go_tuijian']; ?>
&go_sall=<?php echo $this->_tpl_vars['go_sall']; ?>
&go_hot=<?php echo $this->_tpl_vars['go_hot']; ?>
";
						$("#dest_guo_on").load(url)
					}
				</script>
			</ul>
			<ul class="number_days clrfix">
				<!--行程天数-->
				<li>行程天数：</li>
				<li><span<?php if ($this->_tpl_vars['go_days'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
--<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span></li>
				<?php $_from = $this->_tpl_vars['xingcheng']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['xingchengkey'] => $this->_tpl_vars['xingchengitem']):
?>
				<li><span<?php if ($this->_tpl_vars['go_days'] == $this->_tpl_vars['xingchengkey']): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['xingchengkey']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['xingchengitem']; ?>
</a>
				</span></li> <?php endforeach; endif; unset($_from); ?>

			</ul>
			<ul class="travel_time clrfix">
				<!--出游时间-->
				<li class="tt_hd">出游时间：</li>
				<li class="tt_input"><input type="text" id="j_Date1"
					placeholder="yyyy-mm-dd" /></li>
				<li class="tt_input"><input type="text" id="j_Date2"
					placeholder="yyyy-mm-dd" /></li>
			</ul>
			<ul class="sob_box clrfix">
				<!--预算花费-->
				<li>预算花费：</li>
				<li><span<?php if ($this->_tpl_vars['go_money'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
--<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span></li>
				<?php $_from = $this->_tpl_vars['huafei']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['huafeikey'] => $this->_tpl_vars['huafeiitem']):
?>
				<li><span<?php if ($this->_tpl_vars['go_money'] == $this->_tpl_vars['huafeikey']): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_days']; ?>
-<?php echo $this->_tpl_vars['go_starttime']; ?>
-<?php echo $this->_tpl_vars['go_endtime']; ?>
-<?php echo $this->_tpl_vars['huafeikey']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['huafeiitem']; ?>
</a>
				</span></li> <?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<ul class="recom_select clrfix">
			<!--强力推荐-->
			<li><a
				href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['match']; ?>
/hits/<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">强力推荐<?php if ($this->_tpl_vars['order'] == 'hits'): ?>&nbsp;<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>↑<?php else: ?>↓<?php endif; ?><?php else: ?><span class="rs_icon"></span><?php endif; ?>
			</a></li>
			<li><a
				href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['match']; ?>
/hots/<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">销量<?php if ($this->_tpl_vars['order'] == 'hots'): ?>&nbsp;<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>↑<?php else: ?>↓<?php endif; ?><?php else: ?><span class="rs_icon"></span><?php endif; ?>
			</a></li>
			<li><a
				href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['match']; ?>
/price2/<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">价格<?php if ($this->_tpl_vars['order'] == 'price2'): ?>&nbsp;<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>↑<?php else: ?>↓<?php endif; ?><?php else: ?><span class="rs_icon"></span><?php endif; ?>
			</a></li>
		</ul><?php endif; ?>

		<!--内容区-->
		<div class="dm_box">
			<ul class="domestic_main clrfix">
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tour'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tour']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tour']['iteration']++;
?>
				<li><a class="dm_img" href="/tours/<?php echo $this->_tpl_vars['tour']['hid']; ?>
"
					target="_blank"><img src="<?php echo $this->_tpl_vars['tour']['url']; ?>
" width="374"
						height="230" /></a>
					<div class="dm_bd">
						<a href="/tours/<?php echo $this->_tpl_vars['tour']['hid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['tour']['name']; ?>
</a><?php echo $this->_tpl_vars['tour']['title']; ?>

					</div> <a href="/tours/<?php echo $this->_tpl_vars['tour']['hid']; ?>
" class="dm_more" target="_blank">更多团期</a>
					<!--根据栏目改变样式-->
					<div class="dm_price">
						￥<span><?php echo $this->_tpl_vars['tour']['price_2']; ?>
</span>
					</div></li><?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<!--内容区-->
	</div>
	<div class="wrapper clrfix">
		<!--页码-->
		<ul class="page_box clrfix"><?php echo $this->_tpl_vars['multipage']; ?>

		</ul>
	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./view/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!--除邮轮、私人定制都需要加上广告-->
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/right.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/Calendar.js"></script>