<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item("resources_url")?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/user/success.css">
</head>
<body>
<div class="all">
    <!--topper  begin-->
    <?php echo $header; ?>
    <div class="contents" pay_success>
        <div class="pay_content">
            <div class = "pay_center">
                <i class="icon_success"></i>
                <p><?php echo isset($errorDIY['errorMsgTraveller'])?$errorDIY['errorMsgTraveller']:"密码重置成功，请使用新密码登录!";?></p>
                <div class="success"><span class = "success_one">5 </span>秒后跳转到登录页，或者点击 <span class = "success_two">手动跳转</span></div>
            </div>
        </div>
        <div class = "pay_ad"><img src="../../../../resources/images/pay_su.png" alt=""></div>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="../../../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../../../../resources/js/plugin/jquery.validate-1.13.1.js"></script>
</body>
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
    $(".success_two").on("click",function(){
        window.location.href="./login";
    })
</script>
</html>


