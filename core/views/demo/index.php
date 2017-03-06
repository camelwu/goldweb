<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<title><?php echo $title; ?></title>
  <style type="text/css">
    #maps{
      width:500px;
      height:800px;
    }
  </style>
<link rel="stylesheet" href="../../../resources/css/base.css">
<link rel="stylesheet" href="../../../resourcejquery ui城市jquery ui城市s/css/layout.css">
<link rel="stylesheet" href="../../../resources/css/assembly.css">
<link rel="stylesheet" href="../../../resources/css/plugin/calendar_v1.0.css">
<link rel="stylesheet" href="../../../resources/css/plugin/select_person_pop2_v1.0.css">
</head>
<body>

<div class="all">

  <!--topper  begin-->
  <?php echo $header; ?>


  <!--内容部分 用contents包起来-->
  <div class="contents">
    <!--单独中间模块  begin-->
    <div style=" background:#f3e9e9;; margin-bottom:20px;font-size: 18px; line-height: 40px;">
      <div>
        <h4>整体外框架简介</h4>
        <p>“all 标签”：最外层 (或宽度是100%) 的div 的 class 名统一定为“all”，且所有的all标签都是平级</p>
        <p>“contents 标签”：所有宽度是1200px且居中的内容放在这个标签下</p>
        <p>all 标签中包含 class 为  "contents"  的div标签；如：all->contents</p>
      </div>
    </div>
    <!--单独中间模块  end-->
  </div>
  <div page class="contents">
     <div page class="clearfix fr">
         <?php echo $this->mypage->show(1); ?>
     </div>
  </div>

  <div select_person class="contents clearfix">
    <div class="txtoutput" id="person_select">2 成人 2儿童</div>
  </div>


  <!--内容部分样式一   居中显示-->
  <div class="contents">
    <!--面包屑导航  begin-->
    <div class="nav_bread">
      <a href="javascript:;">首页</a>
      <i>&gt;</i>
      <a href="javascript:;">出境游</a>
      <i>&gt;</i>
      <span>面包屑导航</span>
    </div>
    <!--面包屑导航 end-->
    <br>

    <!--景点板块 tab导航 begin-->
    <div class="clearfix" nav_sub>
      <div class="category fl">
        <i class="icon fl"></i>
        <p class="fl">海外玩乐 景点板块 tab导航</p>
      </div>
      <ul class="tab fr">
        <li class="fl">新加坡</li>
        <li class="fl">香港</li>
        <li class="fl">曼谷</li>
        <li class="fl">首尔</li>
        <li class="fl">吉隆坡</li>
      </ul>
    </div>
    <!--景点板块 tab导航  end-->
    <br>

    <!--单独中间模块  begin-->
    <div style=" background:#e9eaf3; margin-bottom:40px;font-size: 20px;">
      <h4>面包屑导航、景点板块 tab导航</h4>
      <p>使用方法：直接粘贴html+css部分；</p>
      <p>不可删除现有标签;</p>
      <p>可以在“现有基础上”添加标签、样式等；可以更换箭头图标，调整其间距</p>
    </div>
    <!--单独中间模块  end-->

    <!--左侧导航+右侧   begin-->
    <div class="clearfix" container_lr checkbox-icon>
      <!--左侧导航-->
      <div class="contain_screen_l fl">
        <div class="clearfix">
          <h4 class="fl">筛选条件</h4>
          <p class="fr">清除全部</p></div>
        <ul class="clearfix">
          <li>
            <p class="title">航空公司</p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon checkbox_cur">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">直飞</span>
              <span class="price">￥1092</span>
            </p>
            <p class="li clearfix">
              <i class="icon ">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">1程中转</span>
              <span class="price">￥1092</span>
            </p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">2程中转</span>
              <span class="price">￥1092</span>
            </p>
            <p class="more_li">更多V</p>
          </li>
          <li>
            <p class="title">出发时间</p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">凌晨(0:00~6:00)</span>
              <span class="price">￥1092</span>
            </p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">直飞(6:00~12:00)</span>
              <span class="price">￥1092</span>
            </p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">凌晨(18:00~24:00)</span>
              <span class="price">￥1092</span>
            </p>
            <p class="li clearfix">
              <i class="icon">
                <a href="javascript:void(0);" class="checkbox_icon">
                  <input type="checkbox">
                </a>
              </i>
              <span class="word">凌晨(18:00~24:00)</span>
              <span class="price">￥1092</span>
            </p>
            <p class="more_li">更多V</p>
          </li>
        </ul>
      </div>
      <!--右侧的内容-->
      <div class="content fr" style="font-size: 16px; background: #f3e9e9">
        <h3>左侧导航+右侧</h3>
        <div>
          <p>“框架布局必须部分”：调用左右布局框架的，须知3部分：容器名必须是:container_lr；左右内容class名字必须是 contain_screen_l 和 content；且浮动；注意父级请浮动必须写</p>
          <p>“左侧导航版块”：具体布局主要针对机票模块；非此布局者可忽略左侧详细布局。只调用contain_screen_l即可。左右分部模式布局适用于所有的这种左右结构</p>
          <p>“命名规则”：左右分部结构的命名规则 --> contain(必须)+（任意）+l(必须)；l的意思是left；</p>
          <p>“clearfix” 标签：请浮动标签，有浮动的父级添加请浮动class -> clearfix ；</p>
          <p>“container_lr” 标签 ：左右分部，左侧导航，右侧内容的布局容器名称；</p>
          <p>“左侧导航”：是机票列表中的左侧列表样式，只可在此基础上添加样式或class，不可删除原有class和样式</p>
          <p>“左右间距”：左侧导航和右侧的间距会统一调整，不需要单独调整</p>
        </div>
      </div>
    </div>
    <!--左侧导航+右侧   end-->
    <br><br>

    <!--右侧导航+左侧   begin-->
    <div class="clearfix" container_rl>
      <!--左侧导航-->
      <div class="contain_screen_r fr">
        <!--更改航班-->
        <div class="border flight">
          <dl>
            <dt>更改航班</dt>
            <dd>
              <div>11111</div>
            </dd>
            <dd><div>11111</div></dd>
          </dl>
          <div></div>
        </div>
        <!--费用明细-->
        <div class="border detailed">
          <p>这里是价格内容部分</p>
          <p>这里是价格内容部分</p>
          <p>这里是价格内容部分</p>
          <p>这里是价格内容部分</p>
          <p>这里是价格内容部分</p>
        </div>
      </div>
      <div class="content" style="font-size: 16px; background: #e9eaf3">
        <h3>右侧导航+左侧</h3>
        <div>
          <p>“针对性版块”：此版块主要针对机票模块；左右分部模式布局适用于所有的这种左右结构</p>
          <p>“clearfix” 标签：请浮动标签，有浮动的父级添加请浮动class -> clearfix ；</p>
          <p>“container_lr” 标签 ：左右分部，左侧导航，右侧内容的布局容器名称；</p>
          <p>“左侧导航”：是机票列表中的左侧列表样式，只可在此基础上添加样式或class，不可删除原有class和样式</p>
          <p>“左右间距”：左侧导航和右侧的间距会统一调整，不需要单独调整</p>
        </div>
      </div>
    </div>
    <!--右侧导航+左侧   end-->
    <br><br>
    <!--填写流程图   3个步骤  begin-->
    <div step-flow step-num3>
      <div class="step_flow_img clearfix">
        <i class="cur">1</i>
        <span class="cur"></span>
        <i class="cur">2</i>
        <span></span>
        <i>3</i>
      </div>
      <div class="step_flow_word clearfix">
        <p class="cur">信息填写</p>
        <p class="pd cur">在线支付</p>
        <p>支付完成</p>
      </div>
    </div>
    <!--填写流程图  3个步骤  end-->
    <br><br>

    <!--填写流程图  4个步骤  begin-->
    <div class="contents" step-flow step-num4>
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
  </div>

  <br><br>

  <!--组件部分-->
  <div class="contents" checkbox-icon>
    <h2 style="background:#900; color:#fff; padding: 10px 0; text-align: center;">以下是组件部分，样式加 assembly.less</h2>
    <br><br><br>
    <!--输入框  效果  begin-->
    <div input-prompt>
      <div class="tips_wrap pr">
        <input class="public" type="text" placeholder="姓（英文），如HAN">
        <div class="tips_message pa">
          <div class="tip_top"></div>
          <div class="tips_content">例：直接将 input-prompt 容器中的div全部粘贴过去，不可减少只能增加</div>
        </div>
      </div>

      <br/><br/>
      <!-- 输入错误 添加class  input_error-->
      <div class="tips_wrap input_error pr">
        <input class="public" type="text" placeholder="input_error 是错误提示红框">
        <div class="tips_message pa">
          <div class="tip_top"></div>
          <div class="tips_content">例：韩梅梅请填写 MEIMEI</div>
        </div>
      </div>

      <br/><br/>
      <!-- 获取焦点 添加class  input_focus-->
      <div class="tips_wrap input_focus pr">
        <input class="public" type="text" placeholder="input_error 是错误提示红框">
        <div class="tips_message pa">
          <div class="tip_top"></div>
          <div class="tips_content">例：韩梅梅请填写 MEIMEI</div>
        </div>
      </div>
      <br/><br/>
      <input class="public" type="text" placeholder="单纯的输入框">
      <input class="public" type="text" placeholder="单纯的输入框">

    </div>
    <!--输入框  效果  end-->

    <!--幻灯片-->
    <div class="contents">
      <?php echo $slide;?>
    </div>

    <br/><br/>
    <!-- btn begin -->
    <div btn-default>
      <p class="search s_index btn1_hover">搜索</p>   <!--首页banner图上的搜索按钮-->
      <br/>
      <p class="btn">不含税</p>   <!--无划过-->
      <br/>
      <p class="btn cur">含税</p>   <!--无划过-->
      <br/>
      <p class="btn btn2_hover">取消</p>
      <br/>
      <p class="btn btn1_hover cur">重置</p>
      <br/>
      <p class="btn order btn1_hover">预订</p>     <!--机票列表-->
      <br/>
      <p class="btn order btn1_hover">更改人数</p>   <!--订单填写页面-->
      <br/>
      <p class="search btn1_hover">搜索</p>  <!--列表页的搜索按钮  默认是此样式-->
      <br/>
      <p class="people">成人</p>   <!--订单填写页面   无划过-->
      <br/>
      <p class="next btn1_hover">下一步，核对信息</p>   <!--订单填写页面-->
      <br/>
    </div>
    <!-- btn end -->
    <!--警示部分-->
    <div Warn class = "warn_ie">
      <i class = "icon_warn"></i><p class = "warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
    </div>
<!--    警示部分结束-->
    <br/>
    日历控件
    <input type="text" class="input" style="width:200px;height:22px;"/>
    <div class="calendarPanel hidden">

    </div>
    <br/>

    <!-- select begin -->
    <div select-div>
      <div class="select_unit">
        <p class="select_btn">1<i></i></p>
        <ul class="select_ul" style="display: block;">
          <li>1</li>
          <li>2</li>
          <li>3</li>
          <li>4</li>
          <li>5</li>
        </ul>
      </div>
    </div>
    <!-- select end -->
    <br/><br/>
    <div info>
      <h3  class = "order_title">联系人</h3>
    </div>
    <br/><br/>
    <!--男女选择圆圈-->
    <div search-index>
      <div class="type">
        航程类型<span><i class="cur"></i>单程</span><span><i></i>往返</span>
      </div>
    </div>
    <!--
      @帮助图标   划过范围：tip_btn_i 仅划过图标时候出现，离开icon就隐藏tip
    -->
    <div icon_help tip style="margin-bottom: 50px;">
      <div class="pr"><!--pr是相对定位，必须用相对定位-->
        <i class="help tip_btn_i"></i>
        <div class="tip_box">
          <span class="tip_icon"></span>
          <p class="tip_word">本航班仅提供电子行程单(中国境内无法报销)，如需要发票报销的旅客请联系代理商提供发票(乘客需承担税点)。请在购票前务必取得出入境或者过境各国（地区）所需要的旅行证件和签证，并事先自行了解旅行的始发、前往或途径国家（地区）</p>
        </div>
      </div>
    </div>
    <!--
        @帮助图标   划过范围：tip_btn_div 划过图标tip的总范围时候显示，离开总范围才隐藏
      -->
    <div class="clearfix" icon_help tip>
      <div class="help_tip_box fl tip_btn_div ">
        <i class="help tip_show_btn"></i>
        <div class="tip_box">
          <span class="tip_icon"></span>
          <p class="tip_word">本航班仅提供电子行程单(中国境内无法报销)，如需要发票报销的旅客请联系代理商提供发票(乘客需承担税点)。请在购票前务必取得出入境或者过境各国（地区）所需要的旅行证件和签证，并事先自行了解旅行的始发、前往或途径国家（地区）</p>
        </div>
      </div>
    </div>
    <br/><br/>
  </div>

<!--上传头像-->
  <div class="contents">
    <?php echo $uploader;?>
  </div>

  <div class="contents">
  <div class="pop_click" style="width: 100%;height:50px; line-height: 50px; background:snow; font-size: 20px;font-weight: bold; text-align: center; box-shadow:0 0 3px #00CC00;">点我~点我~！ 敢点~我就~弹你！</div>


  <!--弹框-->
    <div class="contents">
      <div bombBox btn-default>
        <div class="pop_box">
          <p class="bg"></p>
          <div class="pop_font">
            <p class="pop_title pr">
              提示
              <a class="close" href="javascript:;"> </a>
            </p>
            <div class="word">
              <p>写内容</p>
            </div>
    <!--        <div class="button btn_one pa">-->
    <!--          <p class="btn order btn1_hover">确认</p>-->
    <!--        </div>-->
            <div class="button btn_two pa clearfix">
              <p class="btn order btn1_hover fl">确认</p>
              <p class="btn btn2_hover fr close">取消</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script>
    $(function(){
      //  提示框
      $(".pop_click").click(function(){
        $('.pop_box').show();
      })
      $(".pop_box .close,.pop_box .bg").click(function(){
        $(".pop_box").hide();
        console.log(1)
      })
    })
  </script>
  <br/>
  <br/>
  <br/>
  <br/>
<!--  图片验证码-->
  <div>
    <input type="text">
    <a class="verify_img" href="javascript:;"><img src="/demo/verify_image?code=1234" alt="验证码" id="verify_code"/></a>
    <a href="javascript:;" class="change_code">换一张</a>
    <p><a class="btnLogin" href="/demo/login">登录</a></p>
  </div>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>

    <!-- 模拟进度加载开始 -->
    <div class="simulation">
      <h4>
        <span class="num_plass"><i class="price_loading">1%</i><span class="total_number">正在加载报价...</span></span>
      </h4>
      <p>
        <input type="button" class="click_start" value="点击开始"/>
        <input type="button" class="click_reset" value="点击重置"/>
      </p>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    </div>
  <script type="text/javascript">
    ;(function($){
      $(document).ready(function(){
        var process = function(){
          if(window.bar){
            window.clearInterval(window.bar);
            window.bar = null;
          }
          var simulate  = function(){
            var currNum = parseInt($('.price_loading').eq(0).html()), rn = Math.floor(Math.random()*4),n = 1;
            switch (rn){
              case 0:
                n = 1;
                break;
              case 1:
                n = 2;
                break;
              case 2:
                n = 3;
                break;
              case 3:
                n = 5;
                break;
              default:
                n = 1;
            }
            if(currNum < 99){
              currNum += n;
              currNum = currNum >= 99 ? 99 : currNum;
              $('.price_loading').eq(0).html(currNum+'%');
            }else{
              callback();
              window.clearInterval(window.bar);
            }
          };
          window.bar = setInterval(function(){
             simulate ();
          },50);
        };
        var callback = function(){
          $('.num_plass').eq(0).html('<strong>123</strong>个景点满足条件');
        };
          $('.click_start').on('click',function(){
                 process();
          });
        $('.click_reset').on('click',function(){
          $('.num_plass').eq(0).html('<i class="price_loading">0%</i><span class="total_number">正在加载报价...</span>');
        })
      })
    })(jQuery);


  </script>
  <!-- 模拟进度加载结束 -->
  <div class="contents">
    <div info>
      <h3 class="order_title">
        jquery ui城市
        <div id="ui-datepicker">
          城市选择<input type="text" id="city" placeholder="城市">
          <input type="hidden" id="city_type">
          <input type="hidden" id="city_name">
          <br>
        </div>
      </h3>
    </div>
  </div>

  <link rel="stylesheet" href="/resources/css/plugin/jquery-ui-1.10.3.css">
<!--  <script src="/resources/js/lib/URL.js"></script>-->
  <script src="/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
  <script src="/resources/js/lib/jquery-popupcitylist.js"></script>
  <script>
    $("#city").popularCityList({
      url: 'http://m.yazhoulvyou.cn/api/GetServiceApiResult',
      param: {
        DataType: 1
      },
      textbox: 'city',
      showdomestic: false,
    })
    function getPopularCityList(settings) {
      var data = {};
      data.Parameters = {
        "DataType": settings.param.DataType,
        "Keyword": settings.param.Keyword
      };
      data.foreEndType = 3;
      data.code = "80100008";

      $.ajax({
        type : "POST",
        url : URLPopularCity() + '?rnd=' + Math.random(),
        data : JSON.stringify(data),
        contentType : 'application/json;charset=utf-8',
        success: function (data) {
          settings.response($.map(data.data, function (item) {
            return {
              label: item.KeywordName,
              labelEng: item.KeywordNameEng,
              TypeID: item.TypeID,
              KeywordName: item.KeywordName,
              GroupName: item.GroupName,
              ShowGroupLabel: item.ShowGroupLabel
            }
          }));
        },
        error: function (req, stat, err) {

          alert(err);
        }
      })
    }

    $("#city").autocomplete({
      source: function (request, response) {
        getPopularCityList({
          param: {
            DataType: 1,
            Keyword: request.term
          },
          response: response
        });
      },
      minLength: 2,
      select: function (event, ui) {
        document.getElementById('city_type').value = ui.item.TypeID;
        document.getElementById('city_name').value = ui.item.KeywordName;
      },
      open: function () {
        $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
      },
      close: function () {
        $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
      }
    })
        .focus(function () {
          $(this).select();
        })
        .data("uiAutocomplete")._renderItem = function (ul, item) {
      var strClassName = groupclass(item.GroupName);
      var strGroupName = "";
      if (item.ShowGroupLabel == 'Y') {
        strGroupName = item.GroupName;
      }
      var listItem = $("<li>")
          .data("item.autocomplete", item)
          .append("<a>" +
              "<table class='atctbl' border='0' cellpadding='0'><tr>" +
              "<td class='atctdlbl'>" + item.label + "</td>" +
              "<td class='atctdspc'></td>" +
              "<td class='atctdlbleng'>" + item.labelEng + "</td>" +
              "</tr></table>" +
              "</a>")
          .appendTo(ul);
      if (item.ShowGroupLabel == 'Y') {
        listItem.css('border-top', '1px dotted #485562');
      }
      return listItem;

    };
  </script>

  <div class="contents">
    <div info>
      <h3 class="order_title">
        jquery ui日历
        <div id="ui-datepicker">
          单日历：<input type="text" id="date" placeholder="日期"><br>
          双日历：<input type="text" id="startdate" placeholder="开始日期"><input type="text" id="enddate" placeholder="结束日期">
        </div>
      </h3>
    </div>
  </div>
  <link rel="stylesheet" href="/resources/css/plugin/jquery-ui-1.10.3.css">
  <script src="/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
  <script src="/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
  <script>
    /*单日期*/
    var dates1 = $("#date").datepicker({
      minDate: 0,
      defaultDate: "+0w",
      dateFormat: "yy-mm-dd",
      changeYear: true,
      yearRange: "-0:+1",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function () {
        $(this).blur();
      },
      onSelect: function (selectedDate) {
        // minDate（出发日期）；maxDate（到达日期）
        var option = this.id == "startdate" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
        if (option == "minDate") {
          dates.not(this).datepicker("option", option, date);
        }
      }
    }, $.datepicker.regional['zh-cn']);
    /*双日期*/
    var dates2 = $("#startdate,#enddate").datepicker({
      minDate: 0,
      defaultDate: "+0w",
      dateFormat: "yy-mm-dd",
      changeYear: true,
      yearRange: "-0:+1",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function () {
        $(this).blur();
      },
      onSelect: function (selectedDate) {
        var option = this.id == "startdate" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
        if (option == "minDate") {
          dates.not(this).datepicker("option", option, date);
        }
      }
    });
  </script>


  <br>
  <div id="datapicker" class="contents">
    <div info module-datepicker>
      <h3 class="order_title">
        定制日历<br>
        <input type="text">
      </h3>
    </div>
  </div>
  <script src="/resources/js/plugin/datepicker.js"></script>
  <script>
    var datepicker = new Datepicker({
      el: document.querySelector('#datapicker')
    });
    datepicker.on('alert', function (dateObj) {
      console.log(dateObj);
    });
  </script>
  <!--地图-->
  <div class="contents" id="maps"></div>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  <!--底部-->
  <div bottom>
    <div class="contents bottom_box pr">
      <h1 class="bottom_logo"><a>logo</a></h1>
      <p class="bottom_nav">
        <span><a href="javascript:;">网站首页</a></span>
        <i>|</i>
        <span><a href="javascript:;">订单查询</a></span>
        <i>|</i>
        <span><a href="javascript:;">机票查询</a></span>
        <i>|</i>
        <span><a href="javascript:;">酒店服务</a></span>
        <i>|</i>
        <span><a href="javascript:;">关于我们</a></span>
        <i>|</i>
        <span><a href="javascript:;">隐私条款</a></span>
        <i>|</i>
        <span><a href="javascript:;">服务项目</a></span>
        <i>|</i>
        <span><a href="javascript:;">联系我们</a></span>
      </p>
      <p class="bottom_copyright">版权所有 @ 2016 Asiatravel.com 控股有限公司. 保留所有权利</p>
      <div class="bottom_phone pa">
        <i class="fl"></i>
        <span>400 - 888 - 8888</span>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript" src="../../../resources/js/plugin/calendar_v1.0.js"></script>
<!--<div class="all">-->
<!--  <div class="contact">-->
<!--    <div style="height: 100px; background: #000000;"></div>-->
<!--  </div>-->
<!--</div>-->

</body>
<script src="../../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script src="../../../resources/js/lib/ejs.js"></script>
<script src="../../../resources/js/plugin/select_person_pop2_v1.0.js"></script>
<script src="../../../resources/js/assembly.js"></script>
<script src="../../../resources/js/plugin/maps.js"></script>

<script>

  new select_person_pop().init({
    isShowRoom: true,
    type: "ticket",// ticket:景点门票， hotel_ticket:酒景
    elemId: "person_select",//
    maxRoom: 5,
    minPax:1,//最小总人数
    maxPax: 2,//最多总人数
    maxAdult: 3, //最多成人数
    childAgeMax: 8,//最多儿童数
    childAgeMin: 2,//最小儿童年龄
    onlyForAdult: false,//最只能是成人
    callback: function (obj) {
      console.info(obj)
      alert("执行回调");

    }

  });
</script>

</html>


