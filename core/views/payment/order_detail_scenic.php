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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/order_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/detail_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/order_detail_scenic.css">
</head>
<body>
<?php echo $header; ?>
<!--content部分-->
<div payment class = "all" >
    <div OrderDetail class ="contents">
        <!--面包屑导航  begin-->
        <div class="nav_bread">
            <a href="javascript:;">自由行</a>
            <i>&gt;</i>
            <a href="/ticket/index">景点</a>
            <i>&gt;</i>
            <span>订单详情</span>
        </div>
        <!--面包屑导航 end-->
        <!--警示部分-->
        <?php echo $order_info; ?>
<!--        景点信息-->
        <?php echo $scenic_info; ?>
<!--        景点接送-->
        <?php echo $scenic_shuttle; ?>
<!--        出游人信息-->
<!--        --><?php //echo $visitors_info; ?>
<!--        联系人信息-->
        <?php echo $link_info; ?>
        <!--导航-->
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/help.js"></script>
<script>
    $(function(){
        $(".charges").on("click",function(){
            $(".content_cost").slideToggle("slow");
            $(".icon_detail").toggleClass("icon_detail_cur");
        });
    });
</script>
</body>
</html>


