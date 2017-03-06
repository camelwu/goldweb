$(function(){
  //往返城市切换
  $(".icon_city").attr("data-iscur","false");
  $(".tab_font").each(function(i){
    $(".tab_font").eq(i).find(".icon_city").click(function(){
      if(!$(".tab_font").eq(i).attr("data-iscur")){
       $(this).addClass('cur')
        $(".tab_font").eq(i).attr("data-iscur","true")
       }else{
       $(this).removeClass('cur');
        $(".tab_font").eq(i).attr("data-iscur","false")
       }
      setTimeout(function(){
        var leave = {},arrive = {};
        leave.cityCodeFrom = $(".tab_font").eq(i).find('.cityCodeFrom').attr('data-code');
        leave.cityNameFrom = $(".tab_font").eq(i).find('.cityCodeFrom').val();
        arrive.cityCodeFrom = $(".tab_font").eq(i).find('.cityCodeTo').attr('data-code');
        arrive.cityNameFrom = $(".tab_font").eq(i).find('.cityCodeTo').val();
        console.log(leave)
        console.log(arrive)
        $(".tab_font").eq(i).find(".cityCodeFrom").val(arrive.cityNameFrom);
        $(".tab_font").eq(i).find(".cityCodeFrom").attr("data-name",arrive.cityNameFrom);
        $(".tab_font").eq(i).find(".cityCodeFrom").attr("data-code",arrive.cityCodeFrom);
        $(".tab_font").eq(i).find(".cityCodeTo").val(leave.cityNameFrom);
        $(".tab_font").eq(i).find(".cityCodeTo").attr("data-name",leave.cityNameFrom);
        $(".tab_font").eq(i).find(".cityCodeTo").attr("data-code",leave.cityCodeFrom);
      },100)
    })
  })

  var indexf = {
    tabChange : function(hide,index){
      $(".tab_way").eq(index).addClass("curs").parent().siblings().find(".tab_way").removeClass("curs");
      $(hide).hide().siblings("input").show();
    }
  }
  //往返日历控件引用  begin
  var dates = $("#startdate,#enddate,#readonly").datepicker({
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
      $(this).attr("date-full-value",selectedDate);//替换当前值
      $(this).val(selectedDate);//替换当前值
      //单程点击选择返程日期后切换到往返且将值带给返程  161114  amy
      indexf.tabChange("#readonly",1)
      $("#enddate").show().val($("#readonly").val());

    }
  });
  //往返日历控件引用  end

  //点击tab单返程切换
  $('#readonly').click(function(){
    indexf.tabChange("#enddate",0)

  })
  $('.tab_route').click(function(){
    indexf.tabChange("#readonly",1)
  })
  $('.tab_oneway').click(function(){
    console.log("点击了")

    indexf.tabChange("#enddate",0);
    $('#readonly').val("");
  })

  /*点击搜搜按钮*/
  var routeType,//单程，往返   routeType=return
    cityCodeFrom,//出发城市三字码   cityCodeFrom=BJS
    cityCodeTo,//到达城市三字码   cityCodeTo=NYC
    departDate,//离开时间  departDate=2016-07-28
    returnDate,//往返时间  returnDate=2016-07-30
    numofAdult,//成人数  numofAdult=1
    numofChild,//儿童数  numofChild=0
    cabinClass,
    cityNameFrom,
    cityNameTo;
  var subscript = 0;//下标

  /*点击搜索跳转*/
  $('.search_button').click(function(){
    $("#loading").delay(400).fadeIn("medium");
    dataWay = $(this).attr('data-way');
    if(dataWay == "0"){
      subscript = 0;
    }else{
      subscript = 1;
    }
    //跳转带的参数
    routeType = $('.type span').eq(subscript).attr('data-routeType');
    cityCodeFrom = $('.tab_font').eq(subscript).find('.cityCodeFrom').attr("data-code");
    cityNameFrom = $('.tab_font').eq(subscript).find('.cityCodeFrom').val();
    cityCodeTo = $('.tab_font').eq(subscript).find('.cityCodeTo').attr("data-code");
    cityNameTo = $('.tab_font').eq(subscript).find('.cityCodeTo').val();
    departDate = $('.tab_font').eq(subscript).find('.departDate').attr("date-full-value");
    returnDate = $('.tab_font').eq(subscript).find('.returnDate').attr("date-full-value");
    numofAdult = $('.tab_font').eq(subscript).find('#numofAdult').html()-0;
    numofChild  = $('.tab_font').eq(subscript).find('#numofChild').html()-0;
    cabinClass = $('.tab_font').eq(subscript).find('.cabinClass').attr('data-type');
    /*2016.8.4  判断往返地址是否相同*/
    if($("#city").attr("data-name") == $("#city2").attr("data-name")){
      showMsg("往返地址不能相同")
    }else{


      if(returnDate){
        window.location.href = "/flight/lists?routeType="+routeType+"&cityCodeFrom="+cityCodeFrom+"&cityCodeTo="+cityCodeTo+"&cityNameFrom="+cityNameFrom+"&cityNameTo="+cityNameTo+"&departDate="+departDate+"&returnDate="+returnDate+"&numofAdult="+numofAdult+"&numofChild="+numofChild+"&cabinClass="+cabinClass;
      }else{
        window.location.href = "/flight/lists?routeType="+routeType+"&cityCodeFrom="+cityCodeFrom+"&cityCodeTo="+cityCodeTo+"&cityNameFrom="+cityNameFrom+"&cityNameTo="+cityNameTo+"&departDate="+departDate+"&numofAdult="+numofAdult+"&numofChild="+numofChild+"&cabinClass="+cabinClass;
      }
    }
  })

  /*点击列表跳转*/
  $('.list li').click(function(){
    cityCodeFrom = $(this).attr('data-from');
    cityCodeTo = $(this).attr("data-to");
    departDate = $(this).attr("data-depart");
    cityNameFrom = $(this).attr("data-cityfrom");
    cityNameTo = $(this).attr("data-cityto");
    dataWay = $('.search_button').attr('data-way');
    if(dataWay == "0"){
      subscript = 0;
      routeType = "oneway";
    }else{
      subscript = 1;
      routeType = "return";
    }
    numofAdult = $('.tab_font').eq(subscript).find('#numofAdult').html()-0;
    numofChild  = $('.tab_font').eq(subscript).find('#numofChild').html()-0;
    cabinClass = $('.tab_font').eq(subscript).find('.cabinClass').attr('data-type');
    window.location.href = "/flight/lists?routeType="+routeType+"&cityCodeFrom="+cityCodeFrom+"&cityCodeTo="+cityCodeTo+"&cityNameFrom="+cityNameFrom+"&cityNameTo="+cityNameTo+"&departDate="+departDate+"&numofAdult="+numofAdult+"&numofChild="+numofChild+"&cabinClass="+cabinClass;
  })

  //成人数  儿童数下拉点击事件
  $('.select_unit .select_btn').on("click",function(e){
    var ev = e||event;
    ev.stopPropagation()
    $(this).next().slideToggle("fast").parent().siblings().find('.select_ul').hide();
  })
  $(document).on('click',function(){
    $('.select_ul').hide();
  })
  $('.select_last').each(function(i){
    $('.select_last').eq(i).find(".select_ul li").click(function(){
      $('.select_last').eq(i).find('.cabinClass').html($(this).html());
      $('.select_last').eq(i).find('.cabinClass').attr("data-type",$(this).attr("data-type"));
    })
  })
  /*成人 儿童 人数*/
  var adultNum,childNum;
  tab("#tab1")
  tab("#tab2")
  function tab(id){
    var select1 = $(id).find('.select_ul').eq(0);
    var select2 = $(id).find('.select_ul').eq(1);
    $(select1).children().click(function(){
      var numofAdult = $(id+" #numofAdult").html()-0;
      var numofChild = $(id+" #numofChild").html()-0;
      var value = $(this).html()-0;
      if( (value + numofChild) >9 ){
        showMsg("儿童与成人人数最多9位");
      }else if( numofChild/value > 2 ){
        showMsg("1个成人最多带2个儿童");
      }else{
        $(id+" #numofAdult").html(value)
      }
    });
    $(select2).children().click(function(){
      var numofAdult = $(id+" #numofAdult").html()-0;
      var numofChild = $(id+" #numofChild").html()-0;
      var value = $(this).html()-0;
      if( (value + numofAdult) >9 ){
        showMsg("儿童与成人人数最多9位");
      }else if( value/numofAdult > 2 ){
        showMsg("1个成人最多带2个儿童");
      }else{
        $(id+" #numofChild").html(value)
      }
    });
  }

  //获取当前时间，离开日期默认为t+1  t+4
  function getLocalTime(addNum){
    var today,ms,thatDay, y, m, d,endDate;
    today = new Date().getTime();
    ms = today + addNum*24*60*60*1000;
    thatDay = new Date(ms);
    y = thatDay.getFullYear();
    m = thatDay.getMonth()+1;
    d = thatDay.getDate();
    endDate = y+"-"+toDabble(m)+"-"+toDabble(d);
    function toDabble(num){
      if( num < 10 ){
        num = "0"+num;
      }
      return num;
    }
    return endDate
  }
  $("#date,#startdate").val(getLocalTime(1));
  $("#date,#startdate").attr("date-full-value",getLocalTime(1));
  $('#enddate').val(getLocalTime(4));
  $('#enddate').attr("date-full-value",getLocalTime(4));
})