<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="<?php echo $this->config->item("resources_url")?>/resources/images/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/base.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/hotel_ticket/lists.css">
</head>
<body>
<div class="all">
  <!--    head-->
  <?php echo $header; ?>

  <div class="contents">
    <!--导航-->
    <div s_nav>
      <h6>
        <a class="first_page" href="/hotelticket/index">出境游</a><a href="/hotelticket/index">酒+景</a><a href="/hotelticket/index"><?php echo $destCity?></a></h6>
    </div>
    <!--搜索栏-->
    <div search_input>
      <input type="text" name="searchText" value="" placeholder="输入搜索条件" />
      <input type="button" id="search" value="搜索"/>
    </div>
    <!--游玩天数-->
    <div class="play_days pr" filter_zone play_days>
      <p class="filter_title pa">游玩天数：</p>
      <div class="filter_box clearfix">
        <p class="filter_p cur" data-days="">
          <i class="filter_i"></i>
          <span>全部</span>
        </p>
        <?php foreach($results->data->durations as $item): ?>
          <p class="filter_p" data-days="<?php echo $item->value; ?>">
            <i class="filter_i"></i>
            <span><?php echo $item->text; ?></span>
          </p>
        <?php endforeach; ?>
      </div>
    </div>
    <!--筛选区-->
    <div class="filter_zone" filter_zone>
      <?php echo $themes; ?>
    </div>
    <div tour_list>
      <h4><strong><?php echo $results->data->totalCount;?></strong>个景点满足条件</h4>
    </div>
    <div class="order_div clearfix">
      <span class="chooseRecommend order_span fl">推荐</span>
      <span class="choosePrice down fl">价格<i></i></span>
      <div class="search_price fl">
        <div class="input_line">
          <input type="text" name="price_start" class="price_input" />
          <i></i>
          <input type="text" name="price_end" class="price_input" />
        </div>
        <p>
          <a href="javascript:void(0);" class="clear_price">清空价格</a>
          <button class="sure">确定</button>
        </p>
      </div>
    </div>
    <div class="tour_list" tour_list>
      <!-- ==== loading等待状态开始 ==== -->
      <div class="tour_list_bg">
        <div class="e_load_img"><img src="../../../resources/images/ico_loading.gif" alt=""></div>
        <div class="e_load_msg js-loading_tip">正在加载数据，请稍等...</div>
      </div>
      <!-- loading等待状态结束 -->
      <div class="tour_list_info"><?php echo $lists; ?></div>

    </div>
  </div>
  <!--底部-->
  <?php echo $footer; ?>
</div>

<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/hotel_ticket/lists.js"></script>



</body>
</html>
