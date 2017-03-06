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
    <link rel="stylesheet" href="../../../resources/css/plugin/jquery-ui-1.10.3.css">
    <link rel="stylesheet" href="../../../resources/css/hotel/order.css">
    <link rel="stylesheet" href="../../../resources/css/plugin/validate.css">
</head>
<body>
<div class="all" fill>
    <div class="shdow_circle">
        <img class="load_img order_bg" src="../../../resources/images/bg_loading.gif" />
    </div>
    <!--topper  begin-->
    <?php echo $header; ?>

    <div class="contents">
        <!--填写流程图-->
        <div class="contents fix_f_p" step-flow step-num4 step-fill>
            <div class="step_flow_img clearfix">
                <i class="cur">1</i>
                <span></span>
                <i>2</i>
                <span></span>
                <i>3</i>
                <span></span>
                <i>4</i>
            </div>
            <div class="step_flow_word clearfix">
                <p class="cur">信息填写</p>
                <p class="pd">信息核对</p>
                <p class="pd2">支付</p>
                <p>完成</p>
            </div>
        </div>

         <!--填写+详情-->
        <div class="content_wrap clearfix" container_rl>
              <div class="content fl" fill_l>
                 <div class="item_info">
                     <h4>预订信息</h4>
                     <p class="order_info_p"><span class="p_title">房型信息</span><?php echo $targetRoom->roomName; ?></p></p>
                     <p class="order_info_p"><span class="p_title">入离日期</span><span class="o_date"><?php echo string_cut($user_info['parameters']['checkInDate'],0,10); ?></span> <span class="o_week"><?php echo get_week($user_info['parameters']['checkInDate']); ?></span>  至  <span class="o_date"><?php echo string_cut($user_info['parameters']['checkOutDate'],0,10); ?></span> <span class="o_week"><?php echo get_week($user_info['parameters']['checkOutDate']); ?></span>    <span class="night_num"><?php echo diff_date($user_info['parameters']['checkInDate'],$user_info['parameters']['checkOutDate'],'D'); ?></span>晚</p>
                     <p class="order_info_p"><span class="p_title">预订间数</span><?php echo $user_info['parameters']['numOfRoom']; ?> 间</p>
                     <p class="order_info_p price"><span class="p_title">房费总计</span>¥<span class="price_num"><?php echo $targetRoom->totalPriceCNY*$user_info['parameters']['numOfRoom']; ?></span></p>
                 </div>
                  <form class="form_one" name="form1" id="orderForm" novalidate="novalidate" input-prompt>
                      <div class="item_info">
                          <h4>入住信息</h4>
                          <?php echo $userlist_html;?>
                          <!--<div class="often_user clearfix">
                              <span class="o_u_title fl">常用</span>
                              <ul class="users_ul fl">
                                  <li>
                                      <p class="">杰森鲍威尔</p>
                                      <p class="id">555777234566</p>
                                      <i class="choose_tag"></i>
                                  </li>
                                  <li>
                                      <p class="">杰森鲍威尔</p>
                                      <p class="id">555777234566</p>
                                      <i class="choose_tag"></i>
                                  </li>
                              </ul>
                         </div>-->
                          <ul class="room_users clearfix">
                              <?php
                              for ($x=0; $x<$user_info['parameters']['numOfRoom']; $x++) {
                                  echo '<li class="mes_li clearfix">
                             <span class="fl word_l">房间'.($x+1).'</span>
                              <p class="fl">
                                 <input name="name'.$x.'" class="public room" type="text">
                              </p>'.($x == 0 ? '<span class="fl word_l word_r word_r_f">姓名，只需填写一位</span>' : '').'</li>';
                              }
                              ?>
                          </ul>
<!--                          <div class="mes_li tel_line clearfix">-->
<!--                              <span class="fl word_l">手机号码</span>-->
<!--                              <p class="fl">-->
<!--                                  <input name="phone_num" class="public" type="text">-->
<!--                              </p>-->
<!--                              <span class="fl word_r">订单确认后会给您发送短信通知</span>-->
<!--                          </div>-->

                      </div>
                      <div class="item_info">
                          <h4>联系人信息</h4>
                          <div class="mes_li clearfix">
                              <span class="fl word_l">姓名</span>
                              <p class="fl">
                                  <input name="fln" class="public link_firstname" type="text">
                              </p>
                              <span class="fl word_r">请填写真实联系人姓名</span>
                          </div>
                          <div class="mes_li clearfix">
                              <span class="fl word_l">手机号码</span>
                              <p class="fl">
                                  <input name="c_phone_num" class="public" type="text">
                              </p>
                              <span class="fl word_r">订单确认后会给您发送短信通知</span>
                          </div>
                          <div class="mes_li clearfix">
                              <span class="fl word_l">邮箱</span>
                              <p class="fl">
                                  <input name="c_email" class="public" type="text">
                              </p>
                              <span class="fl word_r">接收确认邮件，获得出行资讯</span>
                          </div>
                          <div class="mes_li clearfix">
                              <span class="fl word_l">居住国家</span>
                              <div class="country_slider fl">
                                  <i></i>
                                  <input name="country" class="public" type="text" data-code="CN" value="中国">
                                  <?php echo $country_ul; ?>
                              </div>
                              <span class="fl word_r">填写当前真实居住国家</span>
                          </div>

                          <div class="mes_li tel_line clearfix">
                              <span class="fl word_l">国籍</span>
                              <div class="country_slider fl">
                                  <i></i>
                                  <input name="nationality" class="public" type="text" data-number="86" value="中国">
                                   <?php echo $country_ul; ?>
                              </div>
                              <span class="fl word_r">填写护照上的国籍信息</span>
                          </div>
                      </div>
                 <div class="item_info cancel_rule">
                      <h4>
                         <span class="cancel_title">取消规则</span>
                          <p>取消申请必须在您入住前的一个工作日前通知我们（不包括休息日），已避免一晚的罚金，如果预定后未入住也会扣相同的违约金。</p>
                     </h4>

                      <div class="order_wrap">
                          <input type="submit" value="下一步,支付订单" />
                      </div>
                 </div>
                  </form>
            </div>

              <div class="contain_screen_r fr" info_r>
                    <h4>费用明细</h4>
                    <div class="sub_info_out">
                           <div class="img">
                              <img src="<?php echo $hotel_gen->hotelImage; ?>" />
                           </div>
                       <h5>
                           <?php echo $hotel_gen->hotelNameLocale; ?><span><strong><?php echo $hotel_gen->hotelReviewScore; ?></strong>/5分</span>
                       </h5>
                      <div class="room_info_part">
                           <p class="room_line address_p"><?php echo $hotel_gen->hotelAddress; ?></p>
                          <p class="room_line">
                              <span class="s_out"> <span class="title">房型:</span><?php echo $targetRoom->roomTypeName; ?></span>
                              <span class="s_out"> <span class="title">床型:</span>大床 </span>
                              <?php if($targetRoom->isFreeWiFi): ?>
                                  <span class="s_out"> <span class="title">WiFi:</span>免费WiFi </span>
                              <?php endif;?>
                          </p>
                          <p class="room_line">
                              <span class="s_out"> <span class="title">最多可住:</span><?php echo $targetRoom->maxOccupancy; ?>人 </span>
                          </p>
                      </div>
                      <div class="price_info_part">
                          <h5>需在线支付</h5>
                          <p>
                              房费<span class="fr">¥<?php echo ($targetRoom->avgPriceCNY)*diff_date($user_info['parameters']['checkInDate'],$user_info['parameters']['checkOutDate'],'D')*$user_info['parameters']['numOfRoom']; ?></span>
                          </p>
                         <!--<p>
                              房费优惠<span class="fr">¥210</span>
                          </p>-->
                          <p>
                              税和服务费<span class="fr">¥<?php echo ($targetRoom->taxChargesCNY)*diff_date($user_info['parameters']['checkInDate'],$user_info['parameters']['checkOutDate'],'D')*$user_info['parameters']['numOfRoom'];; ?></span>
                          </p>
                           <p class="total_cost">
                             应付总金额<span class="price fr">¥<strong id="price_value"><?php echo $targetRoom->totalPriceCNY*$user_info['parameters']['numOfRoom']; ?></strong></span>
                          </p>
                       </div>
                    </div>
              </div>
        </div>
     </div>
        <?php echo $footer;?>
</div>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="../../../resources/js/assembly.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/calendar_v1.0.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="../../../resources/js/hotel/order.js"></script>
</body>
</html>


