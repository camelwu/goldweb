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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/ScanPay.css">
</head>
<body>
<!--content部分-->
<div class = "all" >
    <?php echo $header; ?>
    <div class ="contents">
        <?php if($_GET["type"]=="Flight"):?>
        <div class = "Scen_title">
            <?php if(property_exists($lists->data->flightInfo,'segmentsReturn') ):  ?>
            <span>往返机票：</span>
            <?php else: ?>
                <span>单程机票：</span>
            <?php endif; ?>
            <span><?php echo $lists->data->flightInfo->cityNameFrom?></span>- <span><?php echo $lists->data->flightInfo->cityNameTo?></span></div>
        <div class = "Scan_content">
            <p>订单金额：<span>￥<?php echo $lists->data->totalFlightPrice?>&nbsp;</span>请使用微信扫描下方二维码完成支付</p>
            <div><img src="../../../resources/images/payment/wechat.gif" alt=""></div>
        </div>
        <?php elseif($_GET["type"]=="Ticket"):?>
            <div class = "Scen_title">
                <span><?php echo $Tlistscan->data->packageName;?></span>
            </div>
            <div class = "Scan_content">
                <p>订单金额：<span>￥<?php echo $Tlistscan->data->totalAmount?>&nbsp;</span>请使用微信扫描下方二维码完成支付</p>
                <div><img src="../../../resources/images/payment/wechat.gif" alt=""></div>
            </div>
        <?php elseif($_GET["type"]=="HotelTicket"):?>

            <div class = "Scen_title">
                <span><?php echo $Hlistscan->data->packageName;?></span>
            </div>
            <div class = "Scan_content">
                <p>订单金额：<span>￥<?php echo $HTlistscan->data->chargeDetails[0]->totalAmount;?>&nbsp;</span>请使用微信扫描下方二维码完成支付</p>
                <div><img src="../../../resources/images/payment/wechat.gif" alt=""></div>
            </div>
            <?php elseif($_GET["type"]=="Hotle"):?>
            <?php foreach($Hlistscan->data as $items):?>
            <div class = "Scen_title">
                <span><?php echo $items->hotelName;?></span>
            </div>
            <div class = "Scan_content">
                <p>订单金额：<span>￥<?php echo $items->totalAmount;?>&nbsp;</span>请使用微信扫描下方二维码完成支付</p>
                <div><img src="../../../resources/images/payment/wechat.gif" alt=""></div>
            </div>
            <?php endforeach;?>
        <?php endif;?>
        <div btn-default>
            <p class="next btn1_hover">确认支付</p>
        </div>
    </div>
    <?php echo $footer; ?>
</div>

<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/help.js"></script>
</body>
</html>


