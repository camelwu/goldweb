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
    <link rel="shortcut icon" href="<?php $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/per_ct.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/passenger.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/login.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>

    <div class="contents clearfix">
        <!--左边菜单列表-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part list_information fr" security password traveller_lists>
            <div class="list_b_title"><i></i>常用旅客信息</div>
            <div search-div  class="input-prompt clearfix">
                <div class="row clearfix">
                    <div class="fl col">
                        <span class="col_tilte">旅客姓名</span>
                    </div>
                    <div input-prompt class="fl col">
                        <input class="public txtpassengerName" type="text" placeholder="中文/英文">
                    </div>
                    <div btn-default class="fl col">
                        <p class="search s_index btn1_hover">搜索</p>
                    </div>
                    <div btn-default class="fl col">
                        <a href="/user/passenger_add">添加常用旅客</a>
                    </div>
                </div>
            </div>

            <?php echo $o_travellers_list; ?>
        </div>
    </div>

    <!--底部-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php $this->config->item('resources_url')?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php $this->config->item('resources_url')?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php $this->config->item('resources_url')?>/resources/js/user/passenger.js"></script>
</body>
</html>
