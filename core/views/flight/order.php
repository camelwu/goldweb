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
<link rel="stylesheet" href="../../../resources/css/flight/order_fill.css">
<link rel="stylesheet" href="../../../resources/css/order_info.css">
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
    <!--填写流程图  4个步骤  begin-->
    <div class="contents" step-flow step-num4 step-fill>
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
    <!--填写流程图  4个步骤  end-->

    <!--右侧导航+左侧   begin-->
    <div class="clearfix" container_rl order-mess >
      <div class="content fl">
        <!--注释-->
        <form class="form_one clearfloat" name="form1" id="orderForm">
          <div warn="" class="warn_ie">
            <i class="icon_warn"></i><p class="warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
          </div>
          <!--信息显示-->
          <div class="message clearfix" icon_help tip>
            <div class="fl">
              <span>乘机人</span>
              <span class="adult">成人</span>
              <span><?php echo $numofAdult;?>人</span>
              <span class="child">儿童</span>
              <span>（2-12岁）</span>
              <div class="pr help_tip_box fl">
                <i class="help tip_btn_i"></i>
                <div class="tip_box tip_child">
                  <span class="tip_icon"></span>
                  <p class="tip_word">儿童年龄限制为大于等于2周岁，小于12周岁。</p>
                </div>
              </div>
              <span><?php echo $numofChild;?>人</span>
            </div>
            <a href="javascript:window.history.go(-1);" class="change_num fr">更改人数</a>
          </div>
          <!--联系人 选择-->
           <?php echo $userlist_html?>
          <!--乘机人-->
          <div input-prompt add-people fii-international>
            <div class="passenger">
              <?php echo $personul;?>
            </div>
  <!--          <p class="button">+ 添加乘机人</p>-->
          </div>
          <!--联系信息-->
          <div info input-prompt add-people order-fill>
            <h3 class="order_title">联系信息</h3>
            <ul class="contact clearfix">
              <li class="mes_li">
                <span class="fl word_l pdt10">姓名</span>
                <p class="fl">
                   <input name="c_first_last_name" class="public" type="text">
                </p>
              </li>
              <li class="mes_li">
                <span class="fl word_l pdt10">手机号码</span>
                <p class="fl">
                  <input name="c_mobile_phone" class="public" type="text">
                </p>
              </li>
              <li class="mes_li">
                <span class="fl word_l pdt10">邮箱</span>
                <p class="fl">
                  <input name="c_email" class="public" type="text">
                </p>
              </li>
            </ul>
          </div>
          <div btn-default>
            <p class="next btn1_hover next_button"><input type="submit"  value="下一步，核对信息" class="btnSubmit""></a></p>
          </div>
          <div  class="b_loadding">
            <div class="e_load_img"><img src="../../../resources/images/ico_loading.gif" alt=""></div>
            <div class="e_load_msg js-loading_tip">正在提交订单，请稍等，<br>不要关闭浏览器窗口</div>
          </div>
        </form>
      </div>
      <!--右侧导航-->
      <div class="contain_screen_r fr">
        <!--更改航班-->
        <?php echo $flightinfo_html; ?>
        <div class="info_note help_tip_box" tip>
          <?php echo $order_back;?>
        </div>
        <!--费用明细-->
        <?php echo $free_html; ?>
      </div>
    </div>
    <!--右侧导航+左侧   end-->
  </div>
  <!--topper  begin-->
  <?php echo $footer; ?>
</div>
<div id="loading-div" style="display: none;">
  <img src="../../../resources/images/ico_loading.gif" alt="">
</div>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="../../../resources/js/assembly.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/calendar_v1.0.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="../../../resources/js/flight/order.js"></script>
</body>
</html>


