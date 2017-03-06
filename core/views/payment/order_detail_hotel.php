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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/order_detail_scenic.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/detail_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/order_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/order_detail_tour.css">
</head>
<body>
<?php echo $header; ?>
<!--content部分-->
<div payment class = "all" >
    <div OrderDetail class ="contents">
        <!--面包屑导航  begin-->
        <div class="nav_bread">
            <a href="javascript:;">国际酒店</a>
            <i>&gt;</i>
            <a href="/hotel/index?hotelType=inter">酒店</a>
            <i>&gt;</i>
            <span>订单详情</span>
        </div>
        <!--面包屑导航 end-->
        <!--警示部分-->
        <?php foreach($lists->data as $items):?>
        <?php echo $Horderinfo; ?>
        <div TourDetial>
            <div class = "order_title">
                <h3 class="T_N_title">酒店信息</h3>
                <span>入店 <?php echo formate_date($items->checkInDate,"m月d日")?></span>
                <span>至</span>
                <span>离店 <?php echo formate_date($items->checkOutDate,"m月d日")?></span>
                <span>（<?php echo diff_date($items->checkInDate,$items->checkOutDate,"D"); ?>晚）</span>
            </div>
            <ul class = "hotel_title">
                <li class = "hotel_name"><span><?php echo $items->hotelName;?></span></li>
<!--                    <li class = "h_score"><span><strong>4.6</strong> / 5分</span><span>176位住宿点评</span>-->
<!--                            <i class = "icon_t icon_wifi"></i>-->
<!--                        <!--                    <i class = "icon_t icon_park"></i>-->
<!--                    </li>-->
                <li class = "h_order"><span><?php echo $items->hotelAddress;?></span></li>
<!--                2-3-1 Yoyogi,Shibuya-ku(新宿/中野)-->
                    <li class = "h_detail"><span><?php echo $items->roomName;?>（<?php echo $items->noOfRooms;?>间）</span>
                            <span  class= "h_num">
                        房间1：
                        <span> <?php echo $items->noOfAdults;?>成人</span>
                                <?php if($items->noOfChild):?>
                                    <span><?php echo $items->noOfChild;?>儿童（2岁，11岁）</span>
                                <?php endif;?>
                                    </span>
                    </li>
            </ul>
        </div>
        <?php endforeach;?>
        <!--        酒店接送-->
        <!--        游客信息-->
        <?php echo $visitors_info;?>
        <!--导航-->
        <?php echo $link_info;?>
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


