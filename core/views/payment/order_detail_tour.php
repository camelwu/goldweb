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
            <a href="javascript:;">自由行</a>
            <i>&gt;</i>
            <a href="/hotelticket/index">酒店+景点</a>
            <i>&gt;</i>
            <span>订单详情</span>
        </div>
        <!--面包屑导航 end-->
        <!--警示部分-->
        <?php echo $order_info; ?>
        <div TourName>
            <div class = "order_title">
                <h3 class="T_N_title t_n_ie">酒+景产品名称</h3>
                <span><?php echo formate_date($lists->data->hotelDetails->checkinDate,"m月d日")?></span>
                <span>至</span>
                <span><?php echo formate_date($lists->data->hotelDetails->checkoutDate,"m月d日")?></span>
                <span>（可游玩<?php echo diff_date($lists->data->hotelDetails->checkoutDate,$lists->data->hotelDetails->checkinDate,"D")+1; ?>天</span>
                <span>住宿<?php echo diff_date($lists->data->hotelDetails->checkoutDate,$lists->data->hotelDetails->checkinDate,"D"); ?>晚）</span>
            </div>
            <ul class = "t_title">
                <li class = "t_name"><span><?php echo $lists->data->packageName;?></span></li>
                <li class = "t_detail"><span>游客信息：</span>
                    <?php $i=0; foreach($lists->data->travelers as $items):?>
                        <?php if($items->travelerType==0):?>
                        <?php $i++;endif;?>
                    <?php endforeach;?>
                    <span><?php echo $i;?>成人</span>
                    <?php $j=0;foreach($lists->data->travelers as $items):?>
                    <?php if($items->travelerType==1):?>
                      <?php $j++; endif;?>
                    <?php endforeach;?>
                    <?php if($j>0):?>
                    <span><?php echo $j;?>儿童</span><span>（2岁，11岁）</span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div TourDetial>
            <div class = "order_title">
                <h3 class="T_N_title">酒店信息</h3>
                <span>入店 <?php echo formate_date($lists->data->hotelDetails->checkinDate,"m月d日")?></span>
                <span>至</span>
                <span>离店 <?php echo formate_date($lists->data->hotelDetails->checkoutDate,"m月d日")?></span>
                <span>（<?php echo diff_date($lists->data->hotelDetails->checkoutDate,$lists->data->hotelDetails->checkinDate,"D"); ?>晚）</span>
            </div>
            <ul class = "hotel_title">
                <li class = "hotel_name"><span><?php echo $lists->data->hotelDetails->hotelName;?></span></li>
                <?php foreach(($hotel_info->data) as $items):?>
                <li class = "h_score"><span><strong><?php echo $items->hotelReviewScore?></strong> / 5分</span><span><?php echo $items->hotelReviewCount?>位住宿点评</span><?php if($items->isFreeWiFi):?>
                    <i class = "icon_t icon_wifi"></i>
                        <?php endif;?>
<!--                    <i class = "icon_t icon_park"></i>-->
                </li>
                <?php endforeach;?>
                <li class = "h_order"><span><?php echo $lists->data->hotelDetails->rooms[0]->roomName;?></span></li>
                <?php if($lists->data->hotelDetails->rooms[0]->includedBreakfast):?>
                <li class = "h_detail"><span><?php echo $lists->data->hotelDetails->rooms[0]->roomSeqNo;?>间 双早</span>
                    <?php $i=1; foreach($lists->data->hotelDetails->rooms as $item):?>
                        <span  class= "h_num">
                        房间<?php echo $i;?>：
                        <span> <?php echo $item->totalAdult;?>成人</span>
                            <?php if(($item->totalChild)>0):?>
                        <span><?php echo $item->totalChild;?>儿童（2岁，11岁）</span>
                            <?php endif; ?>
                    </span>
                    <?php $i++;endforeach;?>
                        </li>
                <?php else:?>
                    <li class = "h_detail"><span><?php echo $lists->data->hotelDetails->rooms[0]->roomSeqNo;?>间</span>
                        <span  class= "h_num">
                            房间<?php echo $i;?>：
                            <span> <?php echo $lists->data->hotelDetails->rooms[0]->totalAdult;?>成人</span>
                    <?php if(($lists->data->hotelDetails->rooms[0]->totalChild)>0):?>
                            <span><?php echo $lists->data->hotelDetails->rooms[0]->totalChild;?>儿童（2岁，11岁）</span>
                    <?php endif; ?>
                        </span>
                    </li>
                <?php endif;?>
            </ul>
        </div>
        <!--        景点信息-->
        <?php echo $scenic_info; ?>
   <!--        景点接送-->
        <?php echo $scenic_shuttle;?>
      <!--        出游人信息-->
        <?php echo $visitors_info; ?>
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
        $(".charges1").on("click",function(){
            $("#voucher_link").slideToggle("slow");
        });
    });
</script>
</body>
</html>


