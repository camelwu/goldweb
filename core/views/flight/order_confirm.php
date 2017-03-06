<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="../../../resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../../../resources/css/base.css">
    <link rel="stylesheet" href="../../../resources/css/layout.css">
    <link rel="stylesheet" href="../../../resources/css/assembly.css">
    <link rel="stylesheet" href="../../../resources/css/flight/verify.css">
    <link rel="stylesheet" href="../../../resources/css/order_info.css">
</head>
<body>

<div class="all">
    <!--topper  begin-->
    <?php echo $header; ?>

    <div class="contents">
        <!--填写流程图  4个步骤  begin-->
        <div class="contents con_mar" step-flow step-num4>
            <div class="step_flow_img clearfix">
                <i class="cur">1</i>
                <span class="cur"></span>
                <i class="cur">2</i>
                <span></span>
                <i>3</i>
                <span></span>
                <i>4</i>
            </div>
            <div class="step_flow_word clearfix">
                <p class="cur">信息填写</p>
                <p class="pd cur">信息核对</p>
                <p class="pd2">支付</p>
                <p>完成</p>
            </div>
        </div>
        <!--填写流程图  4个步骤  end-->

        <!--右侧导航+左侧   begin-->
        <div class="clearfix" container_rl order-fill content_l>
            <div class="content fl">
                <!--注释-->
                <div warn="" class="warn_ie">
                    <i class="icon_warn"></i><p class="warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
                </div>
                <!--信息显示-->
                <div class="v_title clearfix v_t_title">乘机人</div>
                <div>
                    <div btn-default>
                        <?php $aa=array(1=>"一",2=>"二",3=>"三",4=>"四",5=>"五",6=>"六",7=>"七",8=>"八",9=>"九",10=>"十");?>
                        <?php $i=1;foreach ($lists->data->travelers as $item): ?>
                        <ul class = "v_container v_first">
                            <li class = "v_num">
                                <span class = "v_content_num fl">第<?php echo $aa[$i];?>位乘机人</span>
                                <?php if($item->passengerType===1):?>
                                <p class="people fl">成人</p>
                                <?php else: ?>
                                    <p class="people fl">儿童</p>
                                <?php endif;?>
                            </li>
                            <li class = "v_list">
                                <span class = "v_name">姓名</span>
                                <span class = "v_righ"><?php echo $item->travelerName; ?>/<?php echo $item->lastName; ?></span>
                                <span class = "v_righ"><?php echo substr($item->dob,0,10); ?></span>
                                <?php if($item->passengerType===1):?>
                                    <span>(成人)</span>
                                <?php else: ?>
                                    <span>(儿童)</span>
                                <?php endif;?>
                            <?php if($item->sexCode === 1): ?>
                                <span>男</span>
                                <?php else: ?>
                                <span>女</span>
                                <?php endif; ?>
                            </li>
                            <li>
<!--                                <span class = "v_name">证件类型</span>-->
<!--                                <span>中国大陆</span>-->
                                <?php if($item->idType === 1):  ?>
                                <span class = "v_name">护照</span>
                                <?php elseif ($item->idType === 2):  ?>
                                <span class = "v_name">身份证</span>
                                <?php else:  ?>
                                <span class = "v_name">港澳通行证</span>
                                <?php endif;  ?>
                                <span><?php echo $item->idNumber; ?></span>
                            </li>
                        </ul>
                        <?php $i=$i+1;endforeach; ?>
                    </div>
                </div>
                <div class="v_title clearfix">联系信息</div>
                <div class = "v_com">
                    <ul class="v_list">
                        <li><span class = "v_name">姓名</span><span><?php echo $lists->data->firstName; ?>/<?php echo $lists->data->lastName; ?></span></li>
                        <li><span class = "v_name">手机号码</span><span><?php echo $lists->data->contactNumber; ?></span></li>
                        <li><span class = "v_name">Email </span><span><?php echo $lists->data->email; ?></span></li>
                    </ul>
                </div>
<!--                <div class="v_title clearfix">报销凭证</div>-->
<!--                <div class = "v_com">-->
<!--                    <ul class="v_list">-->
<!--                        <li><span class = "v_name">姓名</span><span>WU/YUHU</span></li>-->
<!--                        <li><span class = "v_name">手机号码</span><span>18612312321</span></li>-->
<!--                        <li><span class = "v_name">Email </span><span>wyh@123.com</span></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
            <!--右侧导航-->
            <div class="contain_screen_r fr">
                <?php echo $order_flight;?>
                <div class="info_note help_tip_box" tip>
                <?php echo $order_back;?>
                <?php echo $order_bag;?>
                </div>
                <?php echo $order_fee;?>
            </div>
        </div>
        <!--右侧导航+左侧   end-->
        <div btn-default class = "btn_default">
            <p class="next btn1_hover next_a" onclick="javascript:window.location.href='/payment/index?bookingRefNo=<?php echo $_GET['bookingRefNo'];?>&type=Flight'">下一步，去支付</a></p>
        </div>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="../../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/help.js"></script>
<script type="text/javascript" src="../../../resources/js/flight/order_confirm.js"></script>
<!--<script type="text/javascript" src="../../../resources/js/assembly.js"></script>-->
</body>

</html>


