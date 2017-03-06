<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $title;?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list_order.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
</head>
<body>
<div class = "all">
    <?php echo $header?>
    <div class = "contents clearfix" >
        <div class="content_l fl" content_left>
            <ul class = "list">
                <li class = "list_my"><i></i>我的亚程首页</li>
                <li class = "list_order"><i></i>我的订单</li>
            </ul>
        </div>
        <div class="right_part list_information fr" content_right order_lists traveller_lists>
            <?php echo $order_list; ?>
        </div>
    </div>
    <?php echo $footer;?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>

