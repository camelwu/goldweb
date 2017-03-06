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
  <link rel="stylesheet" href="../../resources/css/base.css">
  <link rel="stylesheet" href="../../resources/css/layout.css">
  <link rel="stylesheet" href="../../resources/css/assembly.css">
  <link rel="stylesheet" href="../../resources/css/flight/order_fill.css">
  <link rel="stylesheet" href="../../resources/css/flight/verify.css">
</head>
<body>

<div class="all" fill>
  <!--topper  begin-->
  <?php echo $header; ?>

  <div class="contents">
    <!--填写流程图  4个步骤  begin-->
    <div class="contents" step-flow step-num4 step-fill>
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
    <div class="clearfix" container_rl order-mess >
      <div class="content fl">
        <!--注释-->
        <div warn="" class="warn_ie">
          <i class="icon_warn"></i><p class="warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
        </div>
        <!--信息显示-->
        <div class="message clearfix" icon_help>
          <p class="fl">
            <span>乘机人</span>
            <span class="adult">成人</span>
            <span>3人</span>
            <span class="child">儿童</span>
            <span>（2-12岁）</span>
            <i class="help"></i>
            <span>0人</span>
          </p>
          <a href="javascript:;" class="change_num fr">更改人数</a>
        </div>
        <!--联系人 选择-->
        <div class="pr" card-id>
          <p class="pa common">常用</p>
          <ul class="common_li clearfix">
            <li class="card_font fl pr cur">
              <p class="name">吴彦祖</p>
              <p class="num">110226199009090909</p>
              <i class="pa"></i>
            </li>
            <li class="card_font fl pr">
              <p class="name">吴彦祖</p>
              <p class="num">110226199009090909</p>
              <i class="pa"></i>
            </li>
            <li class="card_font fl pr">
              <p class="name">某某某</p>
              <p class="num">412312312312312</p>
              <i class="pa"></i>
            </li>
            <li class="card_font fl pr">
              <p class="name">某某某</p>
              <p class="num">412312312312312</p>
              <i class="pa"></i>
            </li>
          </ul>
        </div>
        <!--乘机人-->
        <div input-prompt add-people >
          <div class="passenger">
            <ul class="clearfix">
              <li btn-default>
                <span class="fl word_l">第一位乘机人</span>
                <p class="people fl">成人</p>
                <a href="javascript:;" class="empty fr">清空</a>
              </li>
              <li class="name" icon_help>
                <span class="fl word_l pdt10">姓名</span>
                <p class="fl">
                  <input class="public" type="text">
                  <i class="help fr"></i>
                </p>
              </li>
              <li search-index>
                <span class="word_l fl">性别</span>
                <div class="type">
                  <span><i class="cur"></i>男</span>
                  <span><i></i>女</span>
                </div>
              </li>
              <li class="card_id" select-div>
                <span class="fl word_l pdt10">证件类型</span>
                <div class="select_unit fl">
                  <p class="select_btn">港澳通行证<i></i></p>
                  <ul class="select_ul">
                    <li>身份证</li>
                    <li>护照</li>
                    <li>军人</li>
                  </ul>
                </div>
                <p class="card_num fl">
                  <span class="fl word_l word_card  pdt10">证件号</span>
                  <input class="public card_id2" type="text">
                </p>
              </li>
            </ul>

          </div>
          <p class="button">+ 添加乘机人</p>
        </div>
        <!--联系信息-->
        <div info input-prompt add-people order-fill>
          <h3 class="order_title">联系信息</h3>
          <ul class="contact clearfix">
            <li class="mes_li">
              <span class="fl word_l pdt10">姓名</span>
              <p class="fl">
                <input class="public" type="text">
              </p>
            </li>
            <li class="mes_li">
              <span class="fl word_l pdt10">手机号码</span>
              <p class="fl">
                <input class="public" type="text">
              </p>
            </li>
            <li class="mes_li">
              <span class="fl word_l pdt10">邮箱</span>
              <p class="fl">
                <input class="public" type="text">
              </p>
            </li>
          </ul>
        </div>
        <div btn-default>
          <p class="next btn1_hover next_button">下一步，核对信息</p>
        </div>
      </div>
      <!--右侧导航-->
      <div class="contain_screen_r fr">
        <!--更改航班-->
        <div class="border flight" flight_info>
          <div class = "info_title"><a href="#">更改航班</a><span class = "fr">航班的起飞和到达时间为当地时间</span></div>
          <div class = "info_content">
            <ul class = "info_direct">
              <li>
                <span class = "info_d_t">去程 <span>（直飞）</span></span>
                <span class = "info_air">海南航空</span>
                <span>HU7609</span>
                <span class = "info_d_num">787</span>
                <span>经济舱</span>
              </li>
              <li class = "info_day">
                <span class = "info_d_g">2016年10月12日</span>
                <span class = "fr info_d_a">2016年10月3日</span>
              </li>
              <li class = "info_time">
                <span class = "info_d_g info_play">北京<span>06:30</span></span>
                <span class = "icon_arrow"></span>
                <span class = "fr info_d_a">北京<span>06:30</span></span>
              </li>
              <li class = "info_airport">
                <span class = "info_d_g">北京首都机场</span>
                <span class = "fr info_d_a">仁川国际机场</span>
              </li>
            </ul>
            <ul class = "info_change">
              <li>
                <span class = "info_d_t">返程 <span>（中转）</span></span>
                <span class = "info_air">海南航空</span>
                <span>HU7609</span>
                <span class = "info_d_num">787</span>
                <span>经济舱</span>
              </li>
              <li class = "info_day">
                <span class = "info_d_g">2016年10月12日</span>
                <span class = "fr info_d_a">2016年10月12日</span>
              </li>
              <li class = "info_time">
                <span class = "info_d_g info_play">北京<span>06:30</span></span>
                <span class = "icon_arrow"></span>
                <span class = "fr info_d_a">北京<span>06:30</span></span>
              </li>
              <li class = "info_airport info_hub">
                <span class = "info_d_g">北京首都机场</span>
                <span class = "fr info_d_a">仁川国际机场</span>
              </li>
              <li class = "info_day">
                <span class = "info_d_g">2016年10月12日</span>
                <span class = "fr info_d_a">2016年10月12日</span>
              </li>
              <li class = "info_time">
                <span class = "info_d_g info_play">北京<span>06:30</span></span>
                <span class = "icon_arrow"></span>
                <span class = "fr info_d_a">北京<span>06:30</span></span>
              </li>
              <li class = "info_airport">
                <span class = "info_d_g">北京首都机场</span>
                <span class = "fr info_d_a">仁川国际机场</span>
              </li>
            </ul>
          </div>
          <div class="info_note"><span class="fr">购票说明</span><span class="fr">行李规定</span><span class="fr">退改规则</span></div>
        </div>
        <!--费用明细-->
        <div class="border detailed" cost_detail >
          <div class = "cost_title"><h3>费用明细</h3></div>
          <div class="cost_num clearfix">
            <div class = "fl cost_numtitle">应付总金额</div>
            <div class = "fr">
              <span class = "cost_sum">￥780</span>
              <span class = "cost_p_sum">（成人3人 儿童0人 ）</span>
            </div>
          </div>
          <div class = "cost_detail">
            <ul>
              <li class = "cost_list cost_first"><span class = "fl">成人</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">票价</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">机票税</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">燃油费</span><span class ="fr">￥980*1人</span></li>
            </ul>
            <ul>
              <li class = "cost_list cost_first"><span class = "fl">成人</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">票价</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">机票税</span><span class ="fr">￥980*1人</span></li>
              <li class = "cost_list"><span class = "fl">燃油费</span><span class ="fr">￥980*1人</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--右侧导航+左侧   end-->
  </div>

  <!--topper  begin-->
  <?php echo $footer; ?>
</div>
<script type="text/javascript" src="../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../../resources/js/lib/help.js"></script>
<script type="text/javascript" src="../../resources/js/flight/order.js"></script>

</body>

</html>


