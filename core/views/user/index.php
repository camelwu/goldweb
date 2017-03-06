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
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/per_ct.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/assembly.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <!--内容-->
    <div class="contents clearfix">
        <!--左边菜单列表-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part fr">
            <!--头像行-->
            <div class="top_part">
                <a href="/user/info">
                    <div class="face_out">
                        <img src="<?php echo empty($memberData[0]->bigHeadImageUrl)?'../../../resources/images/user/default_img_90.png':$memberData[0]->bigHeadImageUrl?>" />
                    </div>
                </a>
                <span class="per_no"><?php echo $memberData[0]->memberId?>&nbsp;, <span>欢迎你&nbsp;!</span></span><i class="icon_line"></i><i class="icon_tel"></i><span><?php echo number_handler($memberData[0]->mobileNo,9)?></span><a class="change_face" href="/user/modify_phone">修改</a>
            </div>
            <!--列表信息-->
            <div class="list_information" order_lists traveller_lists>
                <!--订单-->
                <div class="list_b_title"><i></i>我的订单  <a href="/user/order">查看全部订单</a></div>
                <?php echo $order_list; ?>
                <!--常旅-->
                <p class="list_o_title"><i></i>常用旅客信息  <a href="/user/passenger">查看全部</a></p>
                <?php echo $o_travellers_list; ?>
            </div>
            <div class="banner">
                <img src='../../../resources/images/pay_su.png' />
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/personal_ct.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>


