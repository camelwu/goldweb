<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/reset_result.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <!--内容-->
    <div class="contents clearfix" reset_result>
            <div class="re_wrap">
                 <div class="result_pic"></div>
                 <div class="word_explain">
                    <p class="title_order">密码重置成功，请使用新密码<span>登陆</span></p>
                    <p class="tip_s_word"><span class = "success_one">5</span>秒后跳转到登录页，或者点击<a href="./login">手动跳转</a></p>
                </div>
            </div>

        <div class="banner">
            <img src="<?php $this->config->item('resources_url')?>/resources/images/pay_su.png" />
        </div>

    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script>
    (function(){
        var time=5;
        var timer=setInterval;
        setInterval(function(){
            $(".success_one").html(time);
            time--;
            if(time==0){
                window.location.href="./login";
                clearInterval(timer);
            }
        },1000)
    })();
</script>
</body>
</html>


