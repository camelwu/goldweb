<?php /* Smarty version 2.6.20, created on 2017-03-05 16:42:27
         compiled from D:%5Clocal%5Cgoldweb./templates/index.html */ ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $this->_tpl_vars['ktitle']; ?>
</title>
		<meta name="Keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
		<meta name="Description" content="<?php echo $this->_tpl_vars['description']; ?>
" />
		<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/global.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $this->_tpl_vars['siteurl']; ?>
/css/index.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<div class="slideBox">
			<!--焦点图-->
			<div class="wrapper slide_search">
				<div class="banner_search" id="banner_search">
					<input type="text" placeholder="我要去..." />
					<a href="javascript:;"> </a>
				</div>
			</div>
			<div class="bd">
				<ul>
					<?php $_from = $this->_tpl_vars['banner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['banneritem']):
?>
					<li style="display: none;">
						<a href="<?php echo $this->_tpl_vars['banneritem']['mypath']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['banneritem']['url']; ?>
" /></a>
					</li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
			<a class="prev" href="javascript:void(0)"> </a><a class="next" href="javascript:void(0)"> </a>
		</div>

		<div class="wrapper recom_box">
			<!--推荐旅游-->
			<div class="recom_title">
				人生苦短，多走走没遗憾
				<ul class="clrfix">
					<li class="recom_on">
						<a href="/overseas/------/hits/desc" class="recom_on">当季最热</a>
					</li>
				</ul>
			</div>
			<div class="recom_main">
				<?php $_from = $this->_tpl_vars['hots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer01'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer01']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['contact']):
        $this->_foreach['outer01']['iteration']++;
?>
				<ul class="recom_bd<?php echo ($this->_foreach['outer01']['iteration']-1)+1; ?>
">
					<li class="rbd_img">
						<a href="tours/<?php echo $this->_tpl_vars['contact']['id']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['contact']['url']; ?>
" border="0" width="372"<?php if (($this->_foreach['outer01']['iteration']-1) == 1): ?>height="515"<?php else: ?>height="210"<?php endif; ?>></a>
					</li>
					<li class="rbd_txt">
						<div class="rbd_l_bg">
							<div class="fl_rbd_title">
								<a href="tours/<?php echo $this->_tpl_vars['contact']['id']; ?>
"><?php echo $this->_tpl_vars['contact']['title']; ?>
</a>
							</div>
							<div class="fl_rbd_hd">
								<a href="tours/<?php echo $this->_tpl_vars['contact']['id']; ?>
"><?php echo $this->_tpl_vars['contact']['content']; ?>
</a><!--<a href="search/<?php echo $this->_tpl_vars['contact']['departure']; ?>
"><?php echo $this->_tpl_vars['contact']['li']; ?>
</a>•<a href="search/<?php echo $this->_tpl_vars['contact']['di']; ?>
"><?php echo $this->_tpl_vars['contact']['city2']; ?>
</a>-->
							</div>
							<div class="rbd_r_bg">
								<?php echo $this->_tpl_vars['contact']['price2']; ?>

							</div>
						</div>
					</li>
				</ul>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
		<div class="wrapper hot_org clrfix">
			<!--热门跟团游-->
			<div class="index_main_title">
				<div class="hot_title">
					热门跟团游
				</div>
				<ul class="index_option hot_option">
					<li class="index_option_on">
						国内游
					</li>
					<li>
						出境游
					</li>
					<li>
						周边游
					</li>
				</ul>
			</div>
			<div id="gt_tours" class="div_option">
				<span>
					<ul class="city_box clrfix fl">
						<li class="city_li_on">
							<a href="/domestic/--33-------">西安</a>
						</li>
						<li>
							<a href="/domestic/--33-------">云南</a>
						</li>
						<li>
							<a href="/domestic/--33-------">桂林</a>
						</li>
						<li>
							<a href="/domestic/--33-------">厦门</a>
						</li>
						<li>
							<a href="/domestic/--33-------">丽江</a>
						</li>
						<li>
							<a href="/domestic/--33-------">华东</a>
						</li>
						<li>
							<a href="/domestic/--33-------">张家界</a>
						</li>
						<li>
							<a href="/domestic/--33-------">九寨沟</a>
						</li>
						<li>
							<a href="/domestic/--33-------">三亚</a>
						</li>
						<li>
							<a href="/domestic/--33-------">泰山</a>
						</li>
						<li>
							<a href="/domestic/--33-------">西藏</a>
						</li>
						<li>
							<a href="/domestic/--33-------">云台山</a>
						</li>
						<li>
							<a href="/domestic/--33-------">内蒙古</a>
						</li>
						<li>
							<a href="/domestic/--33-------">长白山</a>
						</li>
						<li>
							<a href="/domestic/--33-------">新疆</a>
						</li>
					</ul>
					<ul class="scenic_area fl">
						<ul class="sa_title clrfix">
							<div class="fl">
								热门目的地：
							</div>
							<li class="sa_title_on">
								<a href="/domestic/--33-------">云南</a>
							</li>
							<li>
								<a href="/domestic/--33-------">桂林</a>
							</li>
							<li>
								<a href="/domestic/--33-------">厦门</a>
							</li>
							<li>
								<a href="/domestic/--33-------">华东</a>
							</li>
							<li>
								<a href="/domestic/--33-------">西安</a>
							</li>
							<li>
								<a href="/domestic/--33-------">西藏</a>
							</li>
							<a href="/domestic">更多&gt;</a>
						</ul>
						<?php $_from = $this->_tpl_vars['gnroute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gtgn'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gtgn']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['xl']):
        $this->_foreach['gtgn']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['xl']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['xl']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['xl']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['xl']['word']; ?>
 </span>
							</div> </a><a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['xl']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class="scenic_recom fl">
						<a href="./tours/<?php echo $this->_tpl_vars['gnline']['id']; ?>
" target="_blank"><div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['gnline']['url']; ?>
)"></div></a>
						<a href="./tours/<?php echo $this->_tpl_vars['gnline']['id']; ?>
" class="sr_txt"><?php echo $this->_tpl_vars['gnline']['title']; ?>
</a>
					</div> </span>
				<!--跟团1-->
				<span style="display: none">
					<ul class="city_box clrfix fl">
						<li class="city_li_on">
							<a href="/overseas/--33-------">西安</a>
						</li>
						<li>
							<a href="/overseas/--33-------">云南</a>
						</li>
						<li>
							<a href="/overseas/--33-------">桂林</a>
						</li>
						<li>
							<a href="/overseas/--33-------">厦门</a>
						</li>
						<li>
							<a href="/overseas/--33-------">丽江</a>
						</li>
						<li>
							<a href="/overseas/--33-------">华东</a>
						</li>
						<li>
							<a href="/overseas/--33-------">张家界</a>
						</li>
						<li>
							<a href="/overseas/--33-------">九寨沟</a>
						</li>
						<li>
							<a href="/overseas/--33-------">三亚</a>
						</li>
						<li>
							<a href="/overseas/--33-------">泰山</a>
						</li>
						<li>
							<a href="/overseas/--33-------">西藏</a>
						</li>
						<li>
							<a href="/overseas/--33-------">云台山</a>
						</li>
						<li>
							<a href="/overseas/--33-------">内蒙古</a>
						</li>
						<li>
							<a href="/overseas/--33-------">长白山</a>
						</li>
						<li>
							<a href="/overseas/--33-------">新疆</a>
						</li>
					</ul>
					<ul class="scenic_area fl">
						<ul class="sa_title clrfix">
							<div class="fl">
								热门目的地：
							</div>
							<li class="sa_title_on">
								<a href="/overseas/--33-------">云南</a>
							</li>
							<li>
								<a href="/overseas/--33-------">桂林</a>
							</li>
							<li>
								<a href="/overseas/--33-------">厦门</a>
							</li>
							<li>
								<a href="/overseas/--33-------">华东</a>
							</li>
							<li>
								<a href="/overseas/--33-------">西安</a>
							</li>
							<li>
								<a href="/overseas/--33-------">西藏</a>
							</li>
							<a href="/overseas">更多&gt;</a>
						</ul>
						<?php $_from = $this->_tpl_vars['cjroute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gtcj'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gtcj']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['xl']):
        $this->_foreach['gtcj']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_img" target="_blank"> <img src="<?php echo $this->_tpl_vars['xl']['url']; ?>
" width="230" height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['xl']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['xl']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['xl']['word']; ?>
</span>
							</div> </a><a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['xl']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class="scenic_recom fl">
						<a href="./tours/<?php echo $this->_tpl_vars['cjline']['id']; ?>
" target="_blank"><div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['cjline']['url']; ?>
)"></div></a>
						<a href="./tours/<?php echo $this->_tpl_vars['cjline']['id']; ?>
" class="sr_txt" target="_blank"><?php echo $this->_tpl_vars['cjline']['title']; ?>
</a>
					</div> </span>
				<!--跟团2-->
				<span style="display: none">
					<ul class="city_box clrfix fl">
						<li class="city_li_on">
							<a href="/touraround/--33-------">西安</a>
						</li>
						<li>
							<a href="/touraround/--33-------">云南</a>
						</li>
						<li>
							<a href="/touraround/--33-------">桂林</a>
						</li>
						<li>
							<a href="/touraround/--33-------">厦门</a>
						</li>
						<li>
							<a href="/touraround/--33-------">丽江</a>
						</li>
						<li>
							<a href="/touraround/--33-------">华东</a>
						</li>
						<li>
							<a href="/touraround/--33-------">张家界</a>
						</li>
						<li>
							<a href="/touraround/--33-------">九寨沟</a>
						</li>
						<li>
							<a href="/touraround/--33-------">三亚</a>
						</li>
						<li>
							<a href="/touraround/--33-------">泰山</a>
						</li>
						<li>
							<a href="/touraround/--33-------">西藏</a>
						</li>
						<li>
							<a href="/touraround/--33-------">云台山</a>
						</li>
						<li>
							<a href="/touraround/--33-------">内蒙古</a>
						</li>
						<li>
							<a href="/touraround/--33-------">长白山</a>
						</li>
						<li>
							<a href="/touraround/--33-------">新疆</a>
						</li>
					</ul>
					<ul class="scenic_area fl">
						<ul class="sa_title clrfix">
							<div class="fl">
								热门目的地：
							</div>
							<li class="sa_title_on">
								<a href="/touraround/--33-------">云南</a>
							</li>
							<li>
								<a href="/touraround/--33-------">桂林</a>
							</li>
							<li>
								<a href="/touraround/--33-------">厦门</a>
							</li>
							<li>
								<a href="/touraround/--33-------">华东</a>
							</li>
							<li>
								<a href="/touraround/--33-------">西安</a>
							</li>
							<li>
								<a href="/touraround/--33-------">西藏</a>
							</li>
							<a href="/touraround">更多&gt;</a>
						</ul>
						<?php $_from = $this->_tpl_vars['zbroute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gtzb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gtzb']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['xl']):
        $this->_foreach['gtzb']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['xl']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['xl']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['xl']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['xl']['word']; ?>
 </span>
							</div> </a><a href="./tours/<?php echo $this->_tpl_vars['xl']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['xl']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class="scenic_recom fl">
						<a href="./tours/<?php echo $this->_tpl_vars['zbline']['id']; ?>
" target="_blank"><div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['zbline']['url']; ?>
)"></div></a>
						<a href="./tours/<?php echo $this->_tpl_vars['zbline']['id']; ?>
" class="sr_txt" target="_blank"><?php echo $this->_tpl_vars['zbline']['title']; ?>
</a>
					</div> </span>
				<!--跟团3-->
			</div>
		</div>

		<div class="wrapper hotel_box clrfix">
			<!--游轮签证-->
			<div class="index_main_title">
				<div class="cv_title">
					游轮签证
				</div>
				<ul class="index_option cv_option">
					<li class="index_option_on">
						签证
					</li>
					<li>
						游轮
					</li>
				</ul>
			</div>
			<div id="cv_tours" class="div_option">
				<!--游轮签证1-->
				<span> <a href="#" class="city_box fl"><img src="images/city_box1.jpg" width="230" height="394" /></a>
					<ul class="scenic_area fl">
						<ul class="cvh_title clrfix">
							<div class="fl">
								热门国家：
							</div>
							<?php $_from = $this->_tpl_vars['pass']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pass'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pass']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['gj']):
        $this->_foreach['pass']['iteration']++;
?>
							<li>
								<a href="./visa/<?php echo $this->_tpl_vars['gj']['id']; ?>
_1"><?php echo $this->_tpl_vars['gj']['title']; ?>
</a>
							</li>
							<?php endforeach; endif; unset($_from); ?>
							<li>
								<a href="./visa">更多&gt;</a>
							</li>
						</ul>
						<?php $_from = $this->_tpl_vars['visa']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['qz'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['qz']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['qz']):
        $this->_foreach['qz']['iteration']++;
?>
						<li>
							<a href="./visa/<?php echo $this->_tpl_vars['qz']['id']; ?>
" class="sa_img"> <img
							src="<?php echo $this->_tpl_vars['qz']['url']; ?>
" width="230" height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['qz']['price1']; ?>

							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['qz']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['qz']['word']; ?>
 </span>
							</div> </a><a href="./visa/<?php echo $this->_tpl_vars['qz']['id']; ?>
" class="sa_txt"><?php echo $this->_tpl_vars['qz']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul> </span>
				<!--游轮签证2-->
				<span style="display: none"> <a href="#" class="city_box fl"><img
					src="images/city_box2.jpg" width="230" height="394" /></a>
					<ul class="scenic_area fl">
						<ul class="cvh_title clrfix">
							<div class="fl">
								精选航次：
							</div>
							<li>
								<a href="#">东南亚</a>
							</li>
							<li>
								<a href="#">济州岛</a>
							</li>
							<li>
								<a href="#">日本</a>
							</li>
							<li>
								<a href="#">韩国</a>
							</li>
							<li>
								<a href="./cruises">更多&gt;</a>
							</li>
						</ul>
						<?php $_from = $this->_tpl_vars['ylroute']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['yl'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['yl']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['yl']):
        $this->_foreach['yl']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['yl']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['yl']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['yl']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['yl']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['yl']['word']; ?>
 </span>
							</div> </a><a href="<?php echo $this->_tpl_vars['yl']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['yl']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul> </span>
			</div>
		</div>

		<div class="wrapper hotel_box clrfix">
			<!--景点门票-->
			<div class="index_main_title">
				<div class="hotel_title">
					景点门票
				</div>
			</div>
			<a href="./detail/<?php echo $this->_tpl_vars['sight']['id']; ?>
" class="city_box fl" title="<?php echo $this->_tpl_vars['sight']['title']; ?>
" target="_blank"> <div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['sight']['url']; ?>
);" alt="<?php echo $this->_tpl_vars['sight']['title']; ?>
"></div> </a>
			<ul class="scenic_area fl clrfix">
				<ul class="cvh_title clrfix">
					<div class="fl">
						精选景点门票：
					</div>
					<?php $_from = $this->_tpl_vars['menpiao']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['jd'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['jd']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['jd']):
        $this->_foreach['jd']['iteration']++;
?>
					<li>
						<a href="./detail/<?php echo $this->_tpl_vars['jd']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['jd']['title']; ?>
</a>
					</li>
					<?php endforeach; endif; unset($_from); ?>
					<li>
						<a href="./scenic" target="_blank">更多&gt;</a>
					</li>
				</ul>
				<?php $_from = $this->_tpl_vars['scenic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['scenic'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['scenic']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['scenic']):
        $this->_foreach['scenic']['iteration']++;
?>
				<li>
					<a href="./detail/<?php echo $this->_tpl_vars['scenic']['id']; ?>
" class="sa_img"
					target="_blank"> <img src="<?php echo $this->_tpl_vars['scenic']['url']; ?>
" width="230"
					height="138" />
					<div class="sa_price">
						￥<?php echo $this->_tpl_vars['scenic']['price1']; ?>
起
					</div>
					<div class="sa_mask">
						<span><?php echo $this->_tpl_vars['scenic']['title']; ?>

							<br>
							<?php echo $this->_tpl_vars['scenic']['word']; ?>
 </span>
					</div> </a><a href="<?php echo $this->_tpl_vars['scenic']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['scenic']['title']; ?>
</a>
				</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>

		<div class="wrapper free_box clrfix">
			<!--人气自由行-->
			<div class="index_main_title">
				<div class="free_title">
					人气自由行
				</div>
				<ul class="index_option free_travel">
					<li class="index_option_on">
						出境自由行
					</li>
					<li>
						国内自由行
					</li>
				</ul>
			</div>
			<div id="zy_tours" class="div_option">
				<span>
					<ul class="city_box clrfix fl">
						<li class="city_li_on">
							<a href="/freeline/------/hits/desc">香港</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">马尔代夫</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">韩国</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">澳门</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">毛里求斯</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">塞舌尔</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">斯里兰卡</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">长滩岛</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">斐济</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">日本</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">泰国</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">沙巴</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">新加坡</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">清迈</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">普吉岛</a>
						</li>
					</ul>
					<ul class="scenic_area fl">
						<ul class="sa_title clrfix">
							<div class="fl">
								热门目的地：
							</div>
							<li class="sa_title_on">
								<a href="/freeline/------/hits/desc">马尔代夫</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">毛里求斯</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">塞舌尔</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">泰国</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">夏威夷</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">日韩</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">香港</a>
							</li>
							<a href="/freeline/">更多&gt;</a>
						</ul>
						<?php $_from = $this->_tpl_vars['cjfree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['zycj'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['zycj']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['zycj']):
        $this->_foreach['zycj']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['zycj']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['zycj']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['zycj']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['zycj']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['zycj']['word']; ?>
 </span>
							</div> </a><a href="<?php echo $this->_tpl_vars['zycj']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['zycj']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class="scenic_recom fl">
						<a href="./tours/<?php echo $this->_tpl_vars['cfree']['id']; ?>
" target="_blank"><div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['cfree']['url']; ?>
)"></div></a>
						<a href="./tours/<?php echo $this->_tpl_vars['cfree']['id']; ?>
" class="sr_txt" target="_blank"><?php echo $this->_tpl_vars['cfree']['title']; ?>
<span>.<?php echo $this->_tpl_vars['cfree']['info']; ?>
</span></a>
					</div> </span>
				<!--free1-->
				<span style="display: none">
					<ul class="city_box clrfix fl">
						<li class="city_li_on">
							<a href="/freeline/------/hits/desc">北京</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">马尔代夫</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">韩国</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">澳门</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">毛里求斯</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">塞舌尔</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">斯里兰卡</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">长滩岛</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">斐济</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">日本</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">泰国</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">沙巴</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">新加坡</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">清迈</a>
						</li>
						<li>
							<a href="/freeline/------/hits/desc">普吉岛</a>
						</li>
					</ul>
					<ul class="scenic_area fl">
						<ul class="sa_title clrfix">
							<div class="fl">
								热门目的地：
							</div>
							<li class="sa_title_on">
								<a href="/freeline/------/hits/desc">西藏</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">青海</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">卡塔尔</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">云南</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">杭州</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">厦门</a>
							</li>
							<li>
								<a href="/freeline/------/hits/desc">北京</a>
							</li>
							<a href="/freeline/">更多&gt;</a>
						</ul>
						<?php $_from = $this->_tpl_vars['gnfree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['zygn'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['zygn']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['zyx']):
        $this->_foreach['zygn']['iteration']++;
?>
						<li>
							<a href="./tours/<?php echo $this->_tpl_vars['zyx']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['zyx']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_price">
								￥<?php echo $this->_tpl_vars['zyx']['price2']; ?>
起
							</div>
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['zyx']['title']; ?>

									<br>
									<?php echo $this->_tpl_vars['zyx']['word']; ?>
 </span>
							</div> </a><a href="<?php echo $this->_tpl_vars['zyx']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['zyx']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class="scenic_recom fl">
						<a href="./tours/<?php echo $this->_tpl_vars['gfree']['id']; ?>
" target="_blank"><div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['gfree']['url']; ?>
)"></div></a>
						<a href="./tours/<?php echo $this->_tpl_vars['gfree']['id']; ?>
" class="sr_txt" target="_blank"><?php echo $this->_tpl_vars['gfree']['title']; ?>
<span>.<?php echo $this->_tpl_vars['gfree']['info']; ?>
</span></a>
					</div> </span>
				<!--free2-->
			</div>
		</div>

		<div class="wrapper">
			<!--旅行攻略-->
			<div class="index_main_title">
				<div class="traveling_title">
					综合浏览
				</div>
			</div>
			<ul class="traveling_box clrfix">
				<!--热门攻略-->
				<li class="tra_recom">
					<a href="./read/<?php echo $this->_tpl_vars['newl']['id']; ?>
" target="_blank"> <div class="cover_bg" style="background-image: url(<?php echo $this->_tpl_vars['newl']['url']; ?>
)"></div></a>
					<div class="tra_recom_txt">
						<a href="./read/<?php echo $this->_tpl_vars['newl']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['newl']['title']; ?>
</a>
						<span><?php echo $this->_tpl_vars['newl']['info']; ?>
</span>
					</div>
				</li>
				<!--推荐攻略-->
				<li class="tra_bd">
					<ul class="scenic_area fl clrfix">
						<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['yj'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['yj']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['yj']):
        $this->_foreach['yj']['iteration']++;
?>
						<li>
							<a href="./read/<?php echo $this->_tpl_vars['yj']['id']; ?>
" class="sa_img"
							target="_blank"> <img src="<?php echo $this->_tpl_vars['yj']['url']; ?>
" width="230"
							height="138" />
							<div class="sa_mask">
								<span><?php echo $this->_tpl_vars['yj']['title']; ?>
/<?php echo $this->_tpl_vars['yj']['word']; ?>
</span>
							</div> </a><a href="./read/<?php echo $this->_tpl_vars['yj']['id']; ?>
" class="sa_txt" target="_blank"><?php echo $this->_tpl_vars['yj']['title']; ?>
</a>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</li>
			</ul>
		</div>
		<div class="wrapper">
			<!--合作商家-->
			<div class="coop_title">
				合作伙伴
			</div>
			<ul class="coop_img clrfix">
				<?php $_from = $this->_tpl_vars['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['linkitem']):
?>
				<li>
					<a href="<?php echo $this->_tpl_vars['linkitem']['web_url']; ?>
"
					title="<?php echo $this->_tpl_vars['linkitem']['web_key']; ?>
" target="_blank"><img
					src="<?php echo $this->_tpl_vars['linkitem']['url']; ?>
" width="240" height="80" /></a>
				</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<div class="commitment_box">
			<!--金桥五大承诺-->
			<ul class="wrapper clrfix">
				<li class="comm_title">
					金桥五大承诺&nbsp;&nbsp;让你旅游放心
				</li>
				<li class="comm_cq">
					产品优质
				</li>
				<li class="comm_jg">
					价格最新
				</li>
				<li class="comm_bz">
					预约价格保证
				</li>
				<li class="comm_qy">
					维护权益
				</li>
				<li class="comm_pf">
					先行赔付
				</li>
			</ul>
		</div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './view/common/footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./view/common/right.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</body>
	<script src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/jquery.SuperSlide.2.1.1.js"></script>
	<script>
		$(function() {
			$(".scenic_area>li").mouseenter(function() {
				$(this).find(".sa_mask").stop(false).animate({
					bottom : 0
				}, 300);
			});
			$(".scenic_area>li").mouseleave(function() {
				$(this).find(".sa_mask").stop(false).animate({
					bottom : -138
				}, 200);
			});
			$(".index_option li").click(function() {//热门跟团游title单击事件
				$(this).siblings().removeClass("index_option_on");
				$(this).addClass("index_option_on");
				var al_num = $(".index_option li").index(this);
				var al_dom = "#" + $(this).parent().parent().next().attr("id");
				if (al_num == 4 || al_num == 3) {
					al_num = al_num - 3;
				} else if (al_num == 5 || al_num == 6) {
					al_num = al_num - 5;
				}
				$(al_dom).children("span").hide();
				//alert($(al_dom+" span").eq(1).html());
				$(al_dom).children("span").eq(al_num).show(0);
			});
			$(".sa_title li").click(function() {//热门跟团游二级title单击事件
				$(this).siblings().removeClass("sa_title_on");
				$(this).addClass("sa_title_on");
			});
			$(".recom_box ul li").click(function() {//推荐旅游导航单击事件
				$(this).siblings().removeClass("recom_on");
				$(this).addClass("recom_on");
			});
			$(".city_box li").click(function() {//热门跟团游左侧景区
				$(this).siblings().removeClass("city_li_on");
				$(this).addClass("city_li_on");
			});
			$(".slideBox").slide({
				mainCell : ".bd ul",
				effect : "fold",
				autoPlay : true,
				easing : "easeOutCirc",
				delayTime : 800
			});
		});
	</script>
	<script src="<?php echo $this->_tpl_vars['siteurl']; ?>
/js/index.js"></script>
</html>
