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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/color.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/pay_success.css">
</head>
<body>
<div class="all">
    <!--topper  begin-->
    <?php echo $header; ?>
    <div class="contents" pay_success>
        <div class="pay_content">
            <div class = "pay_center">
                <i class="icon_fail"></i>
                <p>很抱歉，支付失败！</p>
                <a href="<?php echo "/payment/index?bookingRefNo=".$_GET["bookingRefNo"]."&type=".$_GET["type"]?>" >重新支付 <i class = "icon_next icon_next3"></i></a>
                <a href="<?php echo  "/payment/order_detail?bookingRefNo=".$_GET["bookingRefNo"]."&type=".$_GET["type"]?>">查看订单详情<i class = "icon_next icon_next2"></i></a>
            </div>
        </div>
        <div class = "pay_ad"><img src="../../../resources/images/pay_su.png" alt=""></div>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/help.js"></script>
<script src = "<?php echo $this->config->item("resources_url")?>/resources/js/payment/payment.js"></script>
</body>

</html>


