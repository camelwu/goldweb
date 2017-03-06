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
  <link rel="stylesheet" href="../../../resources/css/flight/flight_list.css">
</head>
<body>
<div class="all">
  <!--    head-->
  <?php echo $header; ?>
  <div class="contents">
    <div class="nav_bread">
      <a href="javascript:;"><span class="flight_type">国际</span>机票</a>
      <i>&gt;</i>
      <a href="javascript:;"><span class="city_name_from">北京</span>到<span class="city_name_to">悉尼</span>机票(<span class="trip_type">单程</span> )</a>
    </div>
    <div class="filter_eles">
      <div class="form_search">
        <form class="form_one clearfloat" name="form1">
          <div class="form_left">
            <div class="form_left_fir clearfloat">
              <div class="tripType">
                <div class="show_part">
                  <input type="hidden" name="sType" value="oneway" />
                  <span class="trip_word" data-sType="o">单程</span>
                  <i class="arrow_icon"></i>
                </div>
                <ul class="yselect">
                  <li data-sType = "o">单程</li>
                  <li data-sType = "r">往返</li>
                </ul>
              </div>
              <div class="city_date_number  fl">
                <!--city-->
                <div class="city_outer clearfloat fl">
                  <div class="from_city fl">
                    <div class="input_out leave_city">
                      <input id="city" class="city_input cityCodeFrom" type="text" name="city_from" placeholder="选择出发城市" value="北京" data-code="BJS">
                    </div>
                    <div class="for_choose_city"></div>
                  </div>
                  <div class="change_city fl">
                    <i></i>
                  </div>
                  <div class="to_city fl">
                    <div class="input_out arrive_city">
                       <input id="city2" class="city_input cityCodeTo" type="text" name="city_to" placeholder="选择到达城市" value="纽约" data-code="NYC">
                    </div>
                    <div class="for_choose_city"></div>
                  </div>
                </div>
                <!--date-->
                <div class="date_outer clearfloat fl">
                  <div class="from_date fl">
                    <div class="input_out">
                      <input type="text"  id="startdate"  class="date_input" name="date_from" value="2016-08-08"/><span>星期三</span>
                    </div>
                    <div class="for_choose_city"></div>
                  </div>
                  <div class="date_line fl">
                    <i></i>
                  </div>
                  <div class="to_date fl">
                    <div class="input_out">
                      <input type="text"  id="enddate" class="date_input"  name="date_to" value="2016-08-15"/><span>星期四</span>
                    </div>
                    <div class="for_choose_city"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form_left_sec clearfloat">
              <div class="person_number  clearfloat fr">
                <div class="cabin_class cabin_outer fr">
                  <div class="select_cabin">
                    <input type="hidden" name="cabin_value" value="first" />
                    <span class="cabin_value">经济舱</span>
                    <i></i>
                    <!--<span class="person_type">舱位等级</span>-->
                  </div>
                  <ul class="cabin_ul">
                    <li data-value ="economy">经济舱</li>
                    <li data-value ="economyPremium">超级经济舱</li>
                    <li data-value ="business">商务舱</li>
                    <li data-value ="first">头等舱</li>
                  </ul>
                </div>
                <div class="child_number person_outer fr">
                  <div class="select_person">
                    <input type="hidden" name="child_num" value="0" />
                    <span class="child_value">0</span>
                    <i></i>
                    <span class="person_type">儿童</span>
                  </div>
                  <ul class="child_ul">
                    <li>0</li>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                  </ul>
                </div>
                <div class="adult_number person_outer fr">
                  <div class="select_person">
                    <input type="hidden" name="adult_num" value="1"/>
                    <span class="adult_value">1</span>
                    <i></i>
                    <span class="person_type">成人</span>
                  </div>
                  <ul class="adult_ul">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="form_right">
            <button type="button" id="search_submit">搜&nbsp;索</button>
          </div>
        </form>
      </div>
    </div>
    <div class="free_choose_advise">
      <ul class="choose_type clearfloat">
        <li class="free_choose_li" style="display:none">
          自由组合<i class="circle_line"></i><span>去程</span><i class="go_arrow"></i>2 返程
        </li>
        <li class="free_choose_li cur">
          推荐往返组合
        </li>
      </ul>
      <div class="chosen_flight_info" style="display: none">
        <div class="flight_summary clearfloat">
          <div class="flight_summary_left">
            <div class="name_icon_airway">
              <span class="trip_name">去程</span>
              <img class="logo" src="">
              <div class="airway_no_wrap">
                <p class="icon_airway_airway">中国国航</p>
                <p class="icon_airway_no">CA165 <b>330</b></p>
              </div>
            </div>
            <div class="flight_summary_clock_port">
              <div class="clock_port_wrap">
                <p class="flight_clock_value">01:05</p>
                <p class="flight_port_value">首都国际机场T3</p>
              </div>
            </div>
          </div>
          <div class="flight_summary_line">
            <i></i>
          </div>
          <div class="flight_summary_right">
            <div class="flight_summary_end_clock_port">
              <div class="clock_port_wrap">
                <p class="flight_clock_value">01:05</p>
                <p class="flight_port_value">首都国际机场T3</p>
              </div>
            </div>
            <div class="time_cost_wrap">
              <i class="clock_icon"></i>
              <span class="total_hours">15h45m</span>
              <span class="f_type"><?php echo $v1->directFlight==0?"直飞":"中转";?></span>
            </div>
            <div class="price_cabin_class">
              <p class="price_discount_p">
                <i class="m_tag">￥</i><span class="m_value">780</span><span class="d_word">4.0折</span>
              </p>
              <p class="cabin_refund">
                <span class="cabin_name">经济舱</span>
                <span class="refund_explain">退改签机购票说明</span>
              </p>
            </div>
            <div class="re_refund">
              <button type="button" class="re_choose">重选</button>
              <button type="button" class="re_cancel">取消</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flight_content clearfix margin_top" container_lr="" checkbox-icon="">
      <div class="load_circle bg_list">
          <div class="e_load_img"><img src="../../../resources/images/ico_loading.gif" alt=""></div>
          <div class="e_load_msg js-loading_tip">正在加载数据，请稍等...</div>
      </div>
      <?php if($lists->success): ?>
        <!--左侧导航-->
         <div class="contain_screen_l fl">
            <?php echo $filterflight; ?>
         </div>
        <!--右侧的内容-->
        <div class="content fr" style="border:1px solid #fff">
         <!--局部loading状态-->
         <div class="bg_list flight_list_right">
           <div class="e_load_img"><img src="../../../resources/images/ico_loading.gif" alt=""></div>
           <div class="e_load_msg js-loading_tip">正在加载数据，请稍等...</div>
         </div>
          <div class="clearfix margin_top_down trip_title">
            <?php echo $triptitle; ?>
          </div>
          <div class="filter_sort clearfloat">
            <?php echo $orderflight; ?>
          </div>
          <!--机票列表部分-->
          <div class="flight_list_info">
             <?php echo $flightlist; ?>
          </div>
        </div>
      <?php else: ?>
        <!--左侧导航-->
        <div class="contain_screen_l fl"></div>
        <!--右侧的内容-->
        <div class="content fr" style="border:1px solid #fff">
          <!--局部loading状态-->
          <div class="bg_list flight_list_right">
            <div class="e_load_img"><img src="../../../resources/images/ico_loading.gif" alt=""></div>
            <div class="e_load_msg js-loading_tip">正在加载数据，请稍等...</div>
          </div>
          <div class="clearfix margin_top_down trip_title"></div>
          <div class="filter_sort clearfloat"></div>
          <!--机票列表部分-->
          <div class="flight_list_info"></div>
        </div>
       <?php endif ?>
       <?php if(property_exists($lists, 'message')): ?>
        <div class="flight_list_no_info show">
          <div class="flight_no_tip"><?php echo$lists->message;?></div>
        </div>
      <?php else: ?>
        <div class="flight_list_no_info hide">
            <div class="flight_no_tip"></div>
        </div>
      <?php endif ?>
    </div>
  </div>
  <!--底部-->
  <?php echo $footer; ?>
</div>
</body>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/help.js"></script>
<script type="text/javascript" src="../../../resources/js/assembly.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/jquery-popupcitylist.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/city_v1.0.js"></script>
<script type="text/javascript" src="../../../resources/js/flight/lists.js"></script>
</html>


