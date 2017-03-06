<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="../../../resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../../../resources/css/base.css">
    <link rel="stylesheet" href="../../../resources/css/assembly.css">
    <link rel="stylesheet" href="../../../resources/css/ticket/lists.css">
</head>
<body>
<div class="all">
    <!--    head-->
    <?php echo $header; ?>
    <div class="contents">
        <!--导航-->
        <div s_nav>
            <h6>
                <a class="first_page" href="/ticket/index">海外景点</a><a href="JavaScript:;" class="destCityName">新加坡</a>
            </h6>
        </div>

        <!--搜索栏-->
        <div search_input>
            <input type="text" name="searchText" value="" placeholder=""/>
            <input type="button" id="search" value="搜索"/>
        </div>
        <!--筛选区-->
        <div class="filter_zone" filter_zone>
            <?php echo $themes; ?>
        </div>
        <div tour_list>
            <h4>
                    <span class="num_plass">
                       <strong><?php echo $results->success?$results->data->totalCount:0; ?></strong>个景点满足条件
                    </span>
            </h4>
        </div>
        <div class="order_div clearfix">
            <span class="order_span on fl" data-sort="">推荐</span>
            <span class="order_span  fl" data-sort="lowToHigh">价格<i></i></span>

            <div class="search_price fl">
                <div class="input_line">
                    <input type="text" name="price_start" class="price_input"/>
                    <i></i>
                    <input type="text" name="price_end" class="price_input"/>
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
</body>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="../../../resources/js/ticket/lists.js"></script>
</html>


