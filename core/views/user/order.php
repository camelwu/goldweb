<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no" />
  <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/base.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/assembly.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/order.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/order_list.css">
  <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/per_ct.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/plugin/jquery-ui-1.10.3.css">
</head>
<body>
<div class="all">
  <?php echo $header; ?>
  <!--内容-->
  <div class="contents clearfix">
    <!--左边菜单列表-->
    <div class="left_part fl">
      <?php echo $menu_list; ?>
    </div>
    <!--右边内容-->
    <div class="right_part list_information fr">
      <!--查询框-->
      <div search-div  class="input-prompt clearfix">
        <div class="row row1 clearfix">

          <div select-div select class="fl col">
            <span class="fl col_tilte">订单类型</span>
             <div class="fl select_unit">
                 <p class="select_btn btn_select"><span> <?php if (!isset($_GET['type'])):?> 全部<?php else: echo get_order_type($_GET['type']) ?> <?php endif?> </span><i></i></>
                 <ul class="select_ul" style="display: none;" >
                   <li class = "select_ul_li"type ="">全部</li>
                   <li class = "select_ul_li"type ="Hotel">酒店</li>
                   <li class = "select_ul_li"type ="Flight">机票</li>
                   <li class = "select_ul_li"type ="Package_T">景点</li>
                   <li class = "select_ul_li"type ="Package_HT">酒景</li>
                   <li class = "select_ul_li"type ="Package_FHT">自由行</li>
                 </ul>
               </div>
          </div>
          <div input-prompt class="fl col">
            <span  class="col_tilte">预定日期</span>
            <input id="startdate" class="public group_time" type="text" date-full-value="<?php echo date('Y-m-d',strtotime("-3months",strtotime(date("Y-m-d")))) ?>"  placeholder="<?php echo date('Y-m-d',strtotime("-3months",strtotime(date("Y-m-d")))) ?>">
            <span class="data_line">-</span>
            <input id="enddate" class="public group_time " type="text"  date-full-value="<?php echo date("Y-m-d")?>" placeholder="<?php echo date("Y-m-d")?>">
          </div>
          <div input-prompt class="fl col">
            <span  class="col_tilte">订单号</span>
            <input class="public txtordernumber" type="text" placeholder="输入订单号">
          </div>
          <div btn-default class="fr col ">
            <p class="search btn1_hover btn_order_search">搜索</p>
          </div>
      </div>
        <div class="row row2 clearfix">
          <div class="fr col col_phone"><a href="/user/search_order?type=0"><i class="icon_tel"></i><span>手机号查单</span></a></div>
        </div>
      </div>
      <div order_lists traveller_lists>
        <!--订单-->
        <?php echo $order_list; ?>
      </div>
    </div>
  </div>
  <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/personal_ct.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/datepicker.js"></script>
<script>

  var dates = $("#startdate,#enddate").datepicker({
    minDate: '-90d',
    maxDate:0,
    defaultDate: "+0w",
    dateFormat: "yy-mm-dd",
    changeYear: true,
    changeMonth: true,
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
      $(this).attr("date-full-value",selectedDate);//替换当前值
      $(this).val(selectedDate);//替换当前值
    }
  });
    var selectul = $(".btn_select");
    var selectli = $(".select_ul_li");
    selectli.on("click",function(){
      selectul.attr("type",$(this).attr("type"));
    });

  $(".btn_order_search").on("click",function(){
    $("#loading").delay(400).fadeIn("medium");
    var select =$(".btn_select").attr("type");
    var bookingDateBegin = $("#startdate").attr("date-full-value")+"T00:00:00";
    var bookingDateEnd = $("#enddate").attr("date-full-value")+"T23:59:59";
    var bookingRefNo = $(".txtordernumber").text();
    var json_data={
      type:select,
      bookingDateBegin:bookingDateBegin,
      bookingDateEnd:bookingDateEnd,
      bookingRefNo:bookingRefNo
    };
    console.log(json_data);
    $.ajax({
      type:"POST",
      url:"/user/asy_order",
      async:true,//是否是异步
      cache: false,//是否带缓存
      dataType:"json",
      data:json_data,
      success: function(res){
        $("#loading").delay(400).fadeOut("medium");
        if(res.success) {
          $(".order_ul").remove();
          $("div[order_lists]").children().remove();
          $("div[order_lists]").append(res.message)
        }else {
          showMsg(res.message)
        }
      },
      error:function(res){
        $("#loading").delay(400).fadeOut("medium");
        showMsg("网络错误")
      }
    });

  })

</script>

</body>
</html>


