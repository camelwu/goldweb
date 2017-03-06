<?php /* Smarty version 2.6.20, created on 2017-03-06 16:27:17
         compiled from D:%5Clocal%5Cgoldweb/view/visa.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'D:\\local\\goldweb/view/visa.html', 39, false),)), $this); ?>
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
<script type="text/javascript">
function search_visa(){
	var linkstr = "/visa/"+$("#country").val()+"-"+$("#vtype").val();
	//alert(encodeURI(linkstr));
	window.location = encodeURI(linkstr);
}
</script>
</head>
<body>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div class="wrapper now_position"><!--当前位置-->
    <a href="/">首页</a>&gt;<a href="/visa"><?php echo $this->_tpl_vars['cnname']; ?>
</a>
</div>
<div class="wrapper"><!--top-img-->
    <a href="#" class="overseas_top"><img src="/images/domestic_top.jpg" width="1200" height="160"/></a>
</div>

<div class="wrapper clrfix visa_wapper"><!--出发地目的地筛选-->
  <div class="visa_left">  	
  	 <?php if ($this->_tpl_vars['templates'] == 'index'): ?><div class="visal_box">
		<form name="search_frm" method="post" action="/visa"><h6>签证办理查询</h6>
		<div class="visa_guo">
			<span>签证国家</span>
			<input type="text" name="country" id="country"/>
		</div>
		<div class="visa_guo">
			<span>签证类型</span>
			<select name="vtype" id="vtype"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['vtype'],'selected' => $this->_tpl_vars['go_type']), $this);?>
</select>
		</div>
		<input type="submit" class="visa_search" name="submit" value="搜索"/></form>
    </div>
      <div class="visal_box">
          <h6>最新公告</h6>
          <ul class="visa_gg">
          	<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['news'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['news']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['news']):
        $this->_foreach['news']['iteration']++;
?><li>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['news']['title']; ?>
</li><?php endforeach; endif; unset($_from); ?>
          </ul>
      </div><?php endif; ?>
      <div class="visal_box">
          <h6>金桥更有优势</h6>
          <ul class="visa_ys">
          	<li><span>性价比高 更实惠</span>享最周全的服务</li>
            <li class="visa_ys2"><span>专业服务 更快捷</span>更高的出签率</li>
            <li class="visa_ys3"><span>产品丰富 覆盖广</span>支持5大领区办理</li>
          </ul>
      </div>
      <div class="visal_box">
          <h6>签证办理常见问题</h6>
          <ul class="visa_gg">
          	<?php $_from = 'faqs'; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['faq'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['faq']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['news']):
        $this->_foreach['faq']['iteration']++;
?><li><a href="/details/<?php echo $this->_tpl_vars['news']['id']; ?>
"><?php echo $this->_tpl_vars['news']['title']; ?>
</a></li><?php endforeach; endif; unset($_from); ?>
          </ul>
      </div>
  </div>
  <div class="visa_right">
  	<?php if ($this->_tpl_vars['templates'] != 'branch'): ?><div class="visar_img"><img src="/images/visa.jpg" width="100%"></div>
    <div class="visar_box address_select clrfix ">
    	<div class="visar_box_title">签证国家</div>
			<ul class="number_days clrfix"><li>全部：</li><li class="clrfix dest_guo_on visa_dest"><span<?php if ($this->_tpl_vars['go_start'] == ''): ?> class="sob_on"<?php endif; ?>><a href="/visa/-<?php echo $this->_tpl_vars['go_end']; ?>
/hid/desc/<?php echo $this->_tpl_vars['page']; ?>
">全部</a></span></li></ul>
        <?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['area']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><ul class="number_days clrfix">
			<li><?php echo $this->_tpl_vars['stat'][$this->_sections['a']['index']]; ?>
：</li>
			<li class="clrfix dest_guo_on visa_dest">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['area'][$this->_sections['a']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><span<?php if ($this->_tpl_vars['go_start'] == $this->_tpl_vars['area'][$this->_sections['a']['index']][$this->_sections['i']['index']]['id']): ?> class="sob_on"<?php endif; ?>><a href="/visa/<?php echo $this->_tpl_vars['area'][$this->_sections['a']['index']][$this->_sections['i']['index']]['id']; ?>
-<?php echo $this->_tpl_vars['go_end']; ?>
/hid/desc/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['area'][$this->_sections['a']['index']][$this->_sections['i']['index']]['title']; ?>
</a></span><?php endfor; endif; ?>
			</li>
			
        </ul><?php endfor; endif; ?>
        <ul class="number_days clrfix"><li>签证类型：</li><li><span<?php if ($this->_tpl_vars['go_end'] == ''): ?> class="sob_on"<?php endif; ?>><a href="/visa/<?php echo $this->_tpl_vars['go_start']; ?>
-/hid/desc/<?php echo $this->_tpl_vars['page']; ?>
">全部</a></span></li><?php $_from = $this->_tpl_vars['vtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['vs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['vs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['vs']):
        $this->_foreach['vs']['iteration']++;
?><li><span<?php if ($this->_tpl_vars['go_end'] == $this->_tpl_vars['key']): ?> class="sob_on"<?php endif; ?>><a href="/visa/<?php echo $this->_tpl_vars['go_start']; ?>
-<?php echo $this->_tpl_vars['key']; ?>
/hid/desc/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['vs']; ?>
</a></span></li><?php endforeach; endif; unset($_from); ?></ul>
       </div><?php endif; ?>
       <div class="visar_box address_select clrfix ">
       	<div class="visar_box_title">签证列表</div>
        <ul class="visa_bd">
        	<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['data']['iteration']++;
?><li class="clrfix">
            	<div class="visali_img"><a href="/visa/<?php echo $this->_tpl_vars['data']['id']; ?>
" title="<?php echo $this->_tpl_vars['data']['title']; ?>
"><img src="<?php echo $this->_tpl_vars['data']['url']; ?>
" width="100%" height="62"></a></div>
                <div class="visali_txt"><span><a href="/visa/<?php echo $this->_tpl_vars['data']['id']; ?>
"><?php echo $this->_tpl_vars['data']['title']; ?>
</a></span><span class="orange">￥<?php echo $this->_tpl_vars['data']['price1']; ?>
</span></div>
            </li><?php endforeach; endif; unset($_from); ?>
        </ul>
       </div>
       <div style="position: relative;height: 48px;margin-top: 6px;"><ul class="page_box clrfix"><?php echo $this->_tpl_vars['multipage']; ?>
</ul></div>
       <div class=" address_select visar_note">
       		<h6>签证订购注意事项</h6>
            <p> 1）签证官有权要求任何申请人面谈或补充其他材料，申请人需无条件配合；<br/><br/>
                2） 您所申请的签证是否可以成功，取决于相关国家使领馆签证官的直接审核结果；若最终发生拒签状况，申请人应自然接受此结果，同时放弃追究本公司任何责任的权利；<br/><br/>
                3）"办理时长"为使馆签发签证时，正常情况下的处理时间；若遇特殊原因如假期、使馆内部人员调整、签证打印机故障等，则有可能会产生延迟出签的情况；对申请人根据签证预计日期提示，而进行的后续旅程安排所造成的可能经济损失，本公司不承担任何相关责任；<br/><br/>
                4）有关签证资料上公布的签证有效期和停留天数，仅做参考而非任何法定承诺，一切均以签证官签发的签证内容，为唯一依据；<br/><br/>
                5）申请人如在"出签前"前预定了酒店和航班而最终因拒签产生的损失与本公司无关；<br/><br/>
                6）如因申请人材料问题导致拒签，本公司不承担任何责任，并不退还签证费用；
			</p>
       </div>
    </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./view/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/right.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>