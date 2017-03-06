//日期选择
//获取当前时间，离开日期默认为t+1  t+4
//symbol链接符号
var dataTime = {
  toDabble:function(num){
    if( num < 10 ){
      num = "0"+num;
    }
    return num;
  },
  checkInDate:function(symbol,num){
      var val = $("#checkInDate").val() || $("#checkInDate").attr("data-defaultDepartStartDate");
    var date = val.substring(0,10);
    var year = date.substring(0,4);
    var month = date.substring(5,7)-num;
    var day = +date.substring(8,10);
    data = year + symbol + this.toDabble(month) + symbol + this.toDabble(day);
    return data;
  },
  checkInDateTimeMs:function(){
    var timeStamp = new Date(this.checkInDate(",",0)).getTime();
    return timeStamp;
  },
  addTimeMs:function(){
    var addDays = $("#checkOutDate").attr("data-minduration");
    var addTimes = addDays*24*60*60*1000;
    return addTimes;
  },
  checkOutDate:function(){
      var checkOutDate = $('#checkOutDate').val();
      if (checkOutDate) {
          return checkOutDate;
      }

    var defaultDepartStartDate,addTimeMs,ms,thatDay, y, m, d,endDate;
    defaultDepartStartDate = this.checkInDateTimeMs();
    addTimeMs = this.addTimeMs();
    ms = defaultDepartStartDate + addTimeMs;
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
}
dataTime.checkOutDate();

$("#checkInDate").val(dataTime.checkInDate("-",0)).attr("data-val",dataTime.checkInDate("-",0)+"T00:00:00");
$('#checkOutDate').val(dataTime.checkOutDate()).attr("data-val",dataTime.checkOutDate()+"T00:00:00");


//tab选项卡
var article2 = $(".article2").offset().top;
$("#divFollowedMenu a").on("click",function(){
  $(this).addClass("cur").siblings().removeClass("cur");
})
$(window).scroll(function(){
  var leaveTop = $(".article3").offset().top;
  var packageTop = $("#package").offset().top;
  var useCommentTop = $("#useComment").offset().top;
  var clause = $("#clause").offset().top;

  if($(window).scrollTop() >= packageTop){
    $("#divFollowedMenu a").eq(0).addClass("cur").siblings().removeClass("cur");
  }
  if($(window).scrollTop() >= useCommentTop){
    $("#divFollowedMenu a").eq(1).addClass("cur").siblings().removeClass("cur");
  }
  if($(window).scrollTop() >= clause){
    $("#divFollowedMenu a").eq(2).addClass("cur").siblings().removeClass("cur");
  }
  //预订跳转按钮 1
  if($(window).scrollTop() >= article2 && ifScroll == true){
    $("#dateChoose").css({"position":"fixed"});
    //$("#btnSearchPrice").css({"visibility":"initial"})
  }else{
    $("#dateChoose").css({"position":"absolute"});
    //$("#btnSearchPrice").css({"visibility":"hidden"})
  }
  if($(window).scrollTop() >= leaveTop-40){
    $("#divFollowedMenu").addClass("tab_fixed");
    //$("#dateChoose").css({"position":"absolute"})
  }else{
    $("#divFollowedMenu").removeClass("tab_fixed");
  }
})

//选择人数  预订按钮点击事件
/*$("#orderFill").click(function(){
  $("#checkInDate").focus();
})*/


/*//预订跳转按钮 提交
var postObj = {};
postObj.roomID = $(".house_room_choose").attr("data-roomID",$(".choose_btn").eq(0).find("a").attr("data-roomID"));
postObj.roomName = $(".house_room_choose").attr("data-roomName",$(".choose_btn").eq(0).find("a").attr("data-roomName"));
console.log($(".choose_btn").eq(0).find("a").attr("data-roomID"))

$(document).on("click",function(e){
  if($(e.target).parent().hasClass("choose_btn")){
    postObj.roomID = $(e.target).attr("data-roomID");
    postObj.roomName = $(e.target).attr("data-roomName");
  }
  if($(e.target).hasClass("btnSearchPrice")){
    var tours=[];
    //postObj.roomID = $(".house_room_choose").attr("data-roomID");
    //postObj.roomName = $(".house_room_choose").attr("data-roomName");
      $(".tourInfo").each(function(i){
      var tourID = $(".tourInfo").eq(i).find(".tourName").attr("data-tourID");
      var tourName = $(".tourInfo").eq(i).find(".tourName").html();
      var travelDate = $(".tourInfo").eq(i).find(".travelDate").val()+"T00:00:00";
      var tourSession = $(".tourInfo").eq(i).find(".rg_mes .cur").attr("data-session");
      tours.push({"tourID":tourID,"tourName":tourName,"travelDate":travelDate,"tourSession":tourSession})
    })
    postObj.tours = tours;
    console.log(postObj)
  }
})
$("#btnSearchPrice").click(function(){
  var tours=[];
  $(".tourInfo").each(function(i){
    var tourID = $(".tourInfo").eq(i).find(".tourName").attr("data-tourID");
    var tourName = $(".tourInfo").eq(i).find(".tourName").html();
    var travelDate = $(".tourInfo").eq(i).find(".travelDate").attr("data-val");
    var tourSession = $(".tourInfo").eq(i).find(".time_slot.cur").attr("data-val");
    tours.push({"tourID":tourID,"tourName":tourName,"travelDate":travelDate,"tourSession":tourSession})
  })

  var postObj = {
    "roomID":"",
    "roomName":"",
    "tours":tours,
  };
  $.ajax({
    type:"POST",
    url:"/hotelticket/asy_hotel_tour_order",
    data:postObj,
    async:true,//是否是异步
    cache: false,//是否带缓存
    dataType:"json",
    success:function(res){
      if(res.success){
        alert("成功")
      }
    }
  })
})*/




//var supportsOrientationChange = "onorientationchange" in window,
//  orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
//// 监听事件
//window.addEventListener(orientationEvent, function() {
//  var ua = navigator.userAgent;
//  var deviceType="";
//  //判断设备类型
//  if (ua.indexOf("iPad") > 0) {
//    deviceType = "isIpad";
//  } else if (ua.indexOf("Android") > 0) {
//    deviceType = "isAndroid";
//  } else {
//    //console.log("既不是ipad，也不是安卓！");
//    return;
//  }
//  // 判断横竖屏
//  if ("isIpad" == deviceType) {
//    if (Math.abs(window.orientation) == 90) {
//      alert("我是ipad的横屏");
//    } else {
//      alert("我是ipad的竖屏");
//    }
//  } else if ("isAndroid" == deviceType ) {
//    if (Math.abs(window.orientation) != 90) {
//      alert("我是安卓的横屏");
//    } else {
//      alert("我是安卓的竖屏");
//    }
//  }
//}, false);
