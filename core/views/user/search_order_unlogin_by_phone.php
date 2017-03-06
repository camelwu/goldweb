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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list_login.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list_order.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <div class="contents">
        <div style = "display: block" id = "search">
        <div class = "login_content" order_title>
            <div class="login_title"><a href= "/user/search_order?type=0"><i class = "icon icon_cur"></i>用手机号查询</a></div>
        </div>
        <form  login id = "signupForm" method="get" >
            <ul input-prompt class = "login_list clearfix">
                <li><span>手机号</span><input autocomplete="on"  class="public" type="text" name="phone" placeholder="请输入手机号" id="phone" required></li>
                <li class = "code_title fl"><span>验证码</span><input class="public code" type="text" name = "agree" placeholder="请输入验证码" id="agree" required><label id = "error" class="error" style="display:none;">验证码错误</label></li>
                <li class = "code_warn fl"  id = "changeImage"><span class = "v_code"><img src="<?php echo $code_image_url?>" id = "change_img"></span><span class = "icon_submit">换一张</span></li>
                <li class = "code_title fl"><span>动态码</span><input class="public code" type="text" name = "active" placeholder="请输入动态码" id="active" required></li>
                <li class = "code_warn code_active fl"><span id = "send_code">发送动态码</span></li>
                <li  btn-default><input class="btn btn1_hover cur" type="submit" value="提交"></li>
            </ul>
        </form>
         </div>
    </div>
    <div id = "list" style = "display: none;">
    </div>
    <!--底部-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/search_order_unlogin_by_phone.js"></script>
</body>
</html>