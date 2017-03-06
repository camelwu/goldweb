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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/color.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/payment.css">
</head>
<body>
<!--content部分-->
<div class = "all" >
    <!--header  begin-->
    <?php echo $header; ?>
    <div class="contents" payment>
        <!--单独中间模块  begin-->
        <?php if($_GET["type"]=="Flight"):?>
            <div  class = "nav_box">
                <div class = "price_num clearfix">
                    <span class = "fl span_first">
                        <?php if(property_exists($lists->data->flightInfo,'segmentsReturn') ):  ?>
                            <span>往返机票：</span>
                        <?php else: ?>
                            <span>单程机票：</span>
                        <?php endif; ?>
                        <span>
                            <?php echo $lists->data->flightInfo->cityNameFrom?></span>- <span><?php echo $lists->data->flightInfo->cityNameTo?></span></span>
                    <span class = "fr">订单金额：<span class = "price">￥<span class="priceAccount"><?php echo $lists->data->totalFlightPrice?></span></span></span>
                </div>
                <div class = "flight_information">
                    <?php if(property_exists($lists->data->flightInfo,'segmentsReturn') ):  ?>
                        <p>
                        <?php if(sizeof($lists->data->flightInfo->segmentsLeave) > 1): ?>
                            <span>去程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom?></span> -
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[1]->airportNameTo;?></span>
                            <span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                            <p>
                                <span>返程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsReturn[0]->airportNameFrom?></span> - <span><?php echo $lists->data->flightInfo->segmentsReturn[1]->airportNameTo;?></span><span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                            <?php else: ?>
                            <span>去程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom?></span> -
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameTo;?></span>
                            <span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                        <p>
                        <span>返程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsReturn[0]->airportNameFrom?></span> - <span><?php echo $lists->data->flightInfo->segmentsReturn[0]->airportNameTo;?></span><span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                        <?php endif;?>
                    <?php else: ?>
                        <p>
                        <?php if(sizeof($lists->data->flightInfo->segmentsLeave) > 1): ?>
                                <span>去程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom?></span> - <span><?php echo $lists->data->flightInfo->segmentsLeave[1]->airportNameTo;?></span><span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                            <?php else: ?>
                            <span>去程</span>&nbsp;&nbsp;&nbsp;<span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom?></span> - <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameTo;?></span><span>&nbsp;&nbsp;&nbsp;出发日期：</span><span><?php echo formate_date($lists->data->flightInfo->flightLeaveStartDate,"Y-m-d");?></span></p>
                            <?php endif;?>

                        <?php endif; ?>
    <!--                <p>去程 <span>首都国际机场</span>- <span>仁川国际机场</span>  出发日期： <span>2016-01-19</span></p>-->
                </div>
            </div>
            <div Warn class = "warn_ie">
                <i class = "icon_warn"></i><p class = "warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
            </div>
        <?php elseif($_GET["type"]=="Ticket"):?>
            <div  class = "nav_box">
                <div class = "price_num clearfix">
                <span class = "fl span_first">
                    <span><?php echo $Tlist->data->packageName;?></span>
                    </span>
                    <span class = "fr">订单金额：<span class = "price">￥<span class="priceAccount"><?php echo $Tlist->data->totalAmount?></span></span></span>
                </div>
                <div class = "flight_information">
                    <p>
                        <span>游玩时间：</span>&nbsp;&nbsp;&nbsp;<span><?php echo formate_date( $Tlist->data->tours[0]->travelDate,"Y-m-d");?></span>
                    </p>
                </div>
            </div>
            <div class = "white_paddng"></div>
            <?php elseif($_GET["type"]=="HotelTicket"):?>
                <div  class = "nav_box">
                    <div class = "price_num clearfix">
                    <span class = "fl span_first">
                        <span><?php echo $HTlist->data->packageName;?></span>
                        </span>
                        <span class = "fr">订单金额：<span class = "price">￥<span class="priceAccount"><?php $amount=0; for($i=0;$i<=count($HTlist->data->chargeDetails)-1;$i++){$amount=$amount+$HTlist->data->chargeDetails[$i]->totalAmount;};echo $amount;?></span></span></span>
                    </div>
                    <div class = "flight_information">
                        <p>
                            <span>游玩时间：</span>&nbsp;&nbsp;&nbsp;<span><?php echo formate_date( $HTlist->data->hotelDetails->checkinDate,"Y-m-d");?></span>
                        </p>
                    </div>
                </div>
                <div class = "white_paddng"></div>
            <?php elseif($_GET["type"]=="Hotel"):?>
                <div  class = "nav_box">
                    <div class = "price_num clearfix">
                    <span class = "fl span_first">
                        <span><?php echo $Hlist->hotelNameLocale;?>(<?php echo $Hlist->hotelName;?>)</span>
                        </span>
                        <span class = "fr">订单金额：<span class = "price">￥<span class="priceAccount"><?php echo $Hlist->totalAmount;?></span></span></span>
                    </div>
                    <div class = "flight_information">
                        <p>
                            <span>入住日期：</span>&nbsp;&nbsp;&nbsp;<span><?php echo formate_date( $Hlist->checkInDate,"Y-m-d");?></span>
                        </p>
                        <p><span>离店日期：</span>&nbsp;&nbsp;&nbsp;<span><?php echo formate_date( $Hlist->checkOutDate,"Y-m-d");?></span></p>
                    </div>
                </div>
            <div class = "white_paddng"></div>
        <?php endif;?>
        <div payMethod class = "container">
            <ul class="tabs" id = "Tabs">
<!--                <li  class = "wechat_tab cur" data-paymentmode="Wechat">微信支付</li>-->
                <li class="alipay_tab cur" data-paymentmode="AliPayCNY">支付宝支付</li>
<!--                <li class="unionpay_tab" data-paymentmode="UnionPayCNY">银联支付</li>-->
                <li class="credit_tab" data-paymentmode="CreditCard">信用卡支付</li>
            </ul>
            <div class = "tabsConten">
                <div wechat-module  class="tab_div" data-paymentmode="Wechat" style = "display: none">
                    <div class = "wechat">
                        <div class = "clearfix">
                            <div class = "fl prompt clearfix"><img src="../../../resources/images/payment/pay2.gif" alt="">
                                <p>请打开手机微信的“扫一扫”，扫描二维码</p></div>
                            <div class = "fl quickMark clearfix"><img src="../../../resources/images/payment/pay.gif" alt=""></div>
                        </div>
                        <div btn-default>
                            <p class="next btn1_hover wechatPay">支付</p>
                        </div>
                    </div>

                </div>
                <div alipay-module  class="tab_div" data-paymentmode="AliPayCNY" style = "display: block">
                    <div>
                        <div class = "alipay"><img src="../../../resources/images/payment/alipay.png" alt=""></div>
                    </div>
                    <div btn-default class = "alipayPay">
                        <p class="next btn1_hover ">支付</p>
                    </div>

                </div>
                <div unionpay-module class="tab_div" data-paymentmode="UnionPayCNY"></div>
                <div credit-module input-prompt class="tab_div" style = "display: none;" data-paymentmode="CreditCard">
                    <form  name="form1" id="form">
                       <ul class="credit">
                        <li class = "content_first" search-index>
                            <div class = "content_title">支付方式</div>
                            <div class="type">
                                <span class = "type_w"><i data-cardType="Master"></i><span class = "icon_pay icon_wans" ></span></span>
                                <span><i class="curs" data-cardType="Visa"></i><span class = "icon_pay icon_visa" ></span></span>
<!--                                <span class="type_more">选择其他支付方式</span>-->
                            </div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">持卡人姓名</div>
                            <div class="content_text"><input name="cardHolderName" class="public cardHolderName" type="text" placeholder="输入持卡人姓名" /></div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">信用卡卡号</div>
                            <div class="content_text"><input name="cardNumber" class="public cardNumber"  type="tel"placeholder="输入信用卡卡号" /></div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">发卡银行</div>
                            <div class="content_text">
                                <input name="bankName" class="public bankName" type="text" placeholder="招商银行" />
                            </div>
                        </li>
                        <li class="row" select-div>
                            <div  class = "content_title">发卡国家</div>
                            <div class="select_unit countrylist">
                                <p class="select_btn cardCountryCode"><span data-id="cn">中国</span><i></i></p>
                                <ul class="select_ul" style="display: none;">
                                    <?php  foreach($country as $item): ?>
                                        <li><?php echo $item["chineseName"]?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">有效期</div>
                            <input name="cardExpiry_month" class = "validDate public cardExpiryDate cardExpiry_month" type="text"/>月 <input name="cardExpiry_year" class = "validDate public cardExpiry_year" type="text"/>年 <span class="demo">如：07月/17年</span>
                        </li>
                        <li class="row">
                            <div  class = "content_title">CVV2/CVC2号</div>

                            <div class="content_text safe_code">
                                <input name="cardSecurityCode"  class="public cardSecurityCode" type="tel" placeholder="请输入签名栏末尾最后3位" />
                            </div>
                        </li>
                        <li class="row" select-div>
                            <div  class = "content_title">持卡人手机号</div>
                            <div class="select_unit select_uni countryNumber">
                                <p class="select_btn"><span>+86</span><i></i></p>
                                <ul class="select_ul" style="display: none;">
                                    <?php  foreach($country as $item): ?>
                                        <li>+<?php echo $item["phoneCode"]?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div  class="content_text">
                                <input name="mobilePhone" class = "nation public mobilePhone"type="tel" placeholder="用于接收通知">
                            </div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">账单地址</div>
                            <div><input name="cardAddress" class="public cardAddress"  type="tel" placeholder="请输入账单地址"/></div>
                        </li>
                        <li class="row">
                            <div  class = "content_title">邮政编码</div>
                            <div class="content_text"><input name="cardAddressPostalCode " class="public cardAddressPostalCode"  type="tel" placeholder="请输入邮政编码"/></div>
                        </li>
                        <li class="row" select-div>
                            <div   class = "content_title">持卡人国家</div>
                            <div class="select_unit countrylist cardAddressCountryCode">
                                <p class="select_btn"><span data-id="cn">中国</span><i></i></p>
                                <ul class="select_ul">
                                    <?php  foreach($country as $item): ?>
                                        <li><?php echo $item["chineseName"]?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
<!--                        <li class = "service_agreement">-->
<!--                            <i class="icon" checkbox-icon="">-->
<!--                                <a href="javascript:void(0);" class="checkbox_icon">-->
<!--                                    <input type="checkbox" name="agree">-->
<!--                                </a>-->
<!--                            </i>-->
<!--                            同意 <a a href="#">《服务支付协议》<a/>-->
<!--                        </li>-->
                        <div btn-default class="btn_ok">
                            <!--                            onclick="javascript:window.location.href='/payment/order_detail?bookingRefNo=CNBJSFT0004324&type=Flight'-->
                            <p class="next btn1_hover next_button btn_pay" "><input type="submit" name="btnSubmit" value="确认支付" class="btnSubmit""></p>
                        </div>
                    </ul>
                    <form>
                </div>
            </div>
        </div>
        <!--单独中间模块  end-->
    </div>
    <?php echo $footer; ?>
</div>

<script type="text/javascript" src="../../../resources/js/lib/jquery-1.10.2.min.js"></script>
<!--<script type="text/javascript" src="../../../resources/js/plugin/validate.js"></script>-->
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src ="<?php echo $this->config->item("resources_url")?>/resources/js/payment/payment.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/assembly.js"></script>


</body>

</html>


