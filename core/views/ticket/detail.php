<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>景点详情</title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/ticket/detail.css">
</head>
<body>
<div class="all">
    <!--    head-->
    <?php echo $header; ?>
    <div class="contents">
        <?php if($result->success): ?>
            <!--导航-->
            <div s_nav="">
                <h6>
                    <a class="first_page" href="/ticket/index">出境游</a><a href="/ticket/lists?destCityCode=<?php echo $package->destCityCode;?>&destCityName=<?php echo $package->destCity;?>"><?php echo $package->destCity;?></a><a href="JavaScript:;"><?php echo $package->packageName;?></a>
                </h6>
            </div>
            <!--轮播-->
            <div class="article1 pr clearfix" btn-default="" article1="">
                <!--slide-->
                <?php echo $slide; ?>
                <!--右侧-->
                <div class="message fr">
                    <h3><?php echo $package->packageName;?></h3>
                    <ul class="out">
                        <li class="clearfix">
                            <span class="lf_word fl">套餐包括</span>
                            <div class="fl">
                                <?php echo $package->inclusiveItem;?>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="lf_word fl">旅行时间</span>
                            <div class="fl">
                                <p><span><?php echo string_cut($package->salesFrom, 0, 4) . '年' . string_cut($package->salesFrom, 5, 2) . '月' . string_cut($package->salesFrom, 8, 2) . '日'; ?></span>&nbsp;至&nbsp;
                                    <span><?php echo string_cut($package->departValidTo, 0, 4) . '年' . string_cut($package->departValidTo, 5, 2) . '月' . string_cut($package->departValidTo, 8, 2) . '日'; ?></span></p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="lf_word fl">产品编号</span>
                            <div class="fl">
                                <p><?php echo $package->packageRefNo;?></p>
                            </div>
                        </li>
                        <li class="price_li clearfix">
                            <span class="lf_word fl">预订价格</span>
                            <div class="fl price">
                                <span>￥</span><i><?php echo isset($package->priceInfo['0']->price)?$package->priceInfo['0']->price:$_GET["price"]?></i><span>起/人</span><!--<a href="javascript:;">起价说明</a>-->
                            </div>
                        </li>
                        <li class="clearfix">
                            <input type="button" class="btn" value="立即预订" />
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix" detail_content="">
                <div class="hotel_tabs_box pr" id="hotel_tabs_box">
                    <!--<a rel="nofollow"  class="book_btn hidden" onclick="window.scrollBy(0,document.getElementById('book').getBoundingClientRect().top);return false;" href="javascript:void(0);">立即预订</a>-->
<!--                    <a class="book_btn">立即预订</a>-->
                    <input type="button" class="book_btn hidden" value="立即预订" />
                    <ul class="nav_ul clearfix" id="nav_ul">
                        <li class="cur"><a href="javascript:;" class="wa">套餐简介</a></li>
                        <li><a href="javascript:;" class="wa">预定须知</a></li>
                        <li><a href="javascript:;" class="wa">服务条款</a></li>
                    </ul>
                </div>

                <div class="detail_part_wrap" id="detail_part_wrap">
                    <div class="detail_part">
                        <a class="pos_a" name="1F" id="1F" ></a>
                        <h3><i></i>套餐简介</h3>
                        <?php foreach ( $package->tours as $k1 => $v1):?>
                            <?php echo $v1->overview;?>
                        <?php endforeach;?>
                        <!-- --><?php /*echo $package->tours['0']->overview;*/?>
                    </div>
                    <div class="detail_part" style="display: none;">
                        <a class="pos_a" name="2F" id="2F" ></a>
                        <h3><i></i>预订须知</h3>
                        <?php foreach ( $package->tours as $k1 => $v1):?>
                            <?php echo $v1->importantNotes;?>
                        <?php endforeach;?>
                        <!-- --><?php /*echo $package->tours['0']->importantNotes;*/?>
                    </div>
                    <div class="detail_part service_items" style="display: none;">
                        <a class="pos_a" name="3F" id="3F" ></a>
                        <h3><i></i>服务条款</h3>
                        <?php echo $package->termsConditions;?>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="sub_contents">
                <p><?php echo $result->message;?></p>
            </div>
        <?php endif ?>
    </div>
    <!--底部-->
    <?php echo $footer; ?>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/ticket/detail.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>