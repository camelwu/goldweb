<?php /* Smarty version 2.6.20, created on 2017-03-06 16:28:05
         compiled from D:%5Clocal%5Cgoldweb/view/scenic.html */ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['cnname']; ?>
_旅行社_<?php echo $this->_tpl_vars['ktitle']; ?>
_金桥</title>
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/global.css" rel="stylesheet"
	type="text/css">
<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/index.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/index.js"></script>
</head>
<body>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="wrapper now_position">
		<!--当前位置-->
		<a href="./">首页</a>&gt;<a href="./<?php echo $this->_tpl_vars['enname']; ?>
/"><?php echo $this->_tpl_vars['cnname']; ?>
</a>
	</div>
	<?php if ($this->_tpl_vars['banner'] != ''): ?><div class="wrapper">
		<!--top-img-->
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
	</div><?php endif; ?>
	<div class="wrapper">
		<?php if ($this->_tpl_vars['jingwai'] != '1'): ?><!--条件筛选-->
		<div class="address_select clrfix">
			<ul class="dest_zhou_box clrfix">
				<!--目的地-洲-->
				<div class="dest_hd">所在地：</div>
				<li<?php if ($this->_tpl_vars['go_end'] == ''): ?> class="dest_zhou_on"<?php endif; ?>>全部</li>
				<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['stat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
				<li<?php if ($this->_tpl_vars['go_end'] == $this->_sections['a']['index']+1): ?>
					class="dest_zhou_on"<?php endif; ?>><?php echo $this->_tpl_vars['stat'][$this->_sections['a']['index']]; ?>
</li><?php endfor; endif; ?>
			</ul>
			<ul class="dest_guo_box">
				<!--目的地-国家-->
				<li class="clrfix<?php if ($this->_tpl_vars['go_end'] == ''): ?> dest_guo_on<?php endif; ?>">
					<!--全部--> <span<?php if ($this->_tpl_vars['go_end2'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/--<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span>
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['area']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?><?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['area'][$this->_sections['i']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?><span<?php if ($this->_tpl_vars['go_end2'] == $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['id']): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/-<?php echo $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['id']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['title']; ?>
</a>
				</span><?php endfor; endif; ?><?php endfor; endif; ?>
				</li> <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['area']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
				<li
					class="clrfix<?php if ($this->_tpl_vars['go_end'] == $this->_sections['i']['index']+1): ?> dest_guo_on<?php endif; ?>"><?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['area'][$this->_sections['i']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?><span<?php if ($this->_tpl_vars['go_end2'] == $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['id']): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_sections['i']['index']+1; ?>
-<?php echo $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['id']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['area'][$this->_sections['i']['index']][$this->_sections['j']['index']]['title']; ?>
</a>
				</span><?php endfor; endif; ?>
				</li><?php endfor; endif; ?>

			</ul>
			<ul class="service_mold clrfix">
				<li>主题类型：</li>
				<li><span<?php if ($this->_tpl_vars['go_type'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
--<?php echo $this->_tpl_vars['go_item']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span></li>
				<?php $_from = $this->_tpl_vars['go_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gotype'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gotype']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['types']):
        $this->_foreach['gotype']['iteration']++;
?>
				<li><span<?php if ($this->_tpl_vars['go_type'] == $this->_tpl_vars['types']['id']): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['types']['id']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['types']['title']; ?>
</a>
				</span></li><?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul class="number_days clrfix">
				<li>景点级别：</li>
				<li><span<?php if ($this->_tpl_vars['go_item'] == ''): ?> class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
--<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">全部</a></span></li>
				<?php $_from = $this->_tpl_vars['vtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['goitem'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goitem']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['goitem']['iteration']++;
?>
				<li><span<?php if ($this->_tpl_vars['go_item'] == $this->_tpl_vars['item']['id']): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['item']['id']; ?>
-<?php echo $this->_tpl_vars['go_money']; ?>
-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a>
				</span></li><?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul class="sob_box clrfix">
				<li>价格区间：</li>
				<li><span<?php if ($this->_tpl_vars['go_money'] == ''): ?> class="sob_on"<?php endif; ?>>全部</span></li>
				<li><span<?php if ($this->_tpl_vars['go_money'] == '0，50'): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-0，50-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">50以内</a>
				</span></li>
				<li><span<?php if ($this->_tpl_vars['go_money'] == '50，100'): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-50，100-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">50-100
				</span></li>
				<li><span<?php if ($this->_tpl_vars['go_money'] == '100'): ?>
						class="sob_on"<?php endif; ?>><a
						href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['go_end']; ?>
-<?php echo $this->_tpl_vars['go_end2']; ?>
-<?php echo $this->_tpl_vars['go_type']; ?>
-<?php echo $this->_tpl_vars['go_item']; ?>
-100-<?php echo $this->_tpl_vars['go_tuijian']; ?>
-<?php echo $this->_tpl_vars['go_sall']; ?>
-<?php echo $this->_tpl_vars['go_hot']; ?>
">100以上
				</span></li>
			</ul>
		</div>
		<ul class="recom_select clrfix">
			<!--强力推荐-->
			<li><a
				href="/<?php echo $this->_tpl_vars['enname']; ?>
/<?php echo $this->_tpl_vars['match']; ?>
/hits/<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">点击<?php if ($this->_tpl_vars['order'] == 'hits'): ?>&nbsp;<?php if ($this->_tpl_vars['orderby'] == 'asc'): ?>↑<?php else: ?>↓<?php endif; ?><?php else: ?><span class="rs_icon"></span><?php endif; ?>
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
		<div class="dm_box">
			<ul class="domestic_main clrfix">
				<!--内容区-->
				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['data']['iteration']++;
?>
				<li><a class="dm_img" href="/detail/<?php echo $this->_tpl_vars['data']['id']; ?>
" target="_blank"><img
						src="<?php echo $this->_tpl_vars['data']['url']; ?>
" width="374" height="230" /></a>
					<div class="dm_bd">
						<a href="/detail/<?php echo $this->_tpl_vars['data']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['data']['title']; ?>
</a><?php echo $this->_tpl_vars['data']['word']; ?>

					</div>

					<?php if ($this->_tpl_vars['jingwai'] != '1'): ?><!--条件筛选--><div class="dm_price">
						<?php if ($this->_tpl_vars['data']['cid'] == 57 || $this->_tpl_vars['data']['cid'] == 65): ?>￥<?php else: ?>$<?php endif; ?><span><?php echo $this->_tpl_vars['data']['price2']; ?>
</span>
					</div><?php endif; ?></li><?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
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
 ?> <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/right.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<script type="text/javascript">
		$(".dest_zhou_box li").click(function() {//筛选洲/城市
			var dz_num = $(this).index(".dest_zhou_box li");
			$(this).siblings().removeClass("dest_zhou_on");
			$(this).addClass("dest_zhou_on");
			$(".dest_guo_box li").siblings().removeClass("dest_guo_on");
			$(".dest_guo_box li").eq(dz_num).addClass("dest_guo_on");
			$(".dest_guo_box li span").removeClass("dga_on");
		});
	</script>
</body>
</html>