/**
 * Created by zhouwei on 2016/9/1.
 */

/**
 * 选择人控件
 * @author zhouwei
 * @time 2013 11-07
 * @email 879083421@qq.com
 */
function select_person_pop(config) {
  this.config={
    isShowRoom:true,
    type:"ticket",// ticket:景点门票， hotel_ticket:酒景
    elemId:"test_person_select",//
    minPax:2,//最小总人数
    maxPax:5,//最多总人数
    maxAdult:2, //最多成人数
    childAgeMax:8,//最多儿童数
    childAgeMin:2,//最小儿童年龄
    onlyForAdult:false, //最只能是成人
    callback:null
  }
}
var childAgeMax=0;
var childAgeMin=0;



select_person_pop.prototype = {
  init: function (options) {
    this.config = $.extend(this.config, options || {});

    childAgeMax=this.config.childAgeMax;
    childAgeMin=this.config.childAgeMin;

    var popStartHtml=[
      '<div bombbox input-prompt select_person2>',
      '<div  class="pop_box" id="H-dialog" style="display: block;">',
      '<p class="bg"></p>',
      '<div class="pop_font">',
      '<p class="pop_title pr ">房间,人数设置<a class="close pop_closed" href="javascript:;"> </a></p>',
      '<div id="msgCont" class="word">'
    ].join('');

    var roomtStartHtml=[
      '<div class="room" style="position: relative;overflow: hidden" data-id="1">',
      '<span>房间</span><span class="roomNumber">1</span>',
      '<span  class="age">(<%=childAgeMin%>-<%=childAgeMax%>岁)</span>'].join('')

    var adultChildCountHtml=[
      '<ul select2-div select class="adultChildUL row">',
        '<li class="col clearfix">',
            '<span class="fl">成人</span>',
        '<div class="select_unit fl">',
              '<p class="select_btn"><span class="num adultNum"><%=minPax%></span><i class="up" onclick="up(this)"></i><i class="down" onclick="down(this)"></i></p>',
        '</div>',
        '</li>',
        '<li class="col clearfix">',
           '<span class="fl">儿童</span>',
            '<div class="select_unit fl">',
                '<p class="select_btn"><span class="num childNum">0</span><i class="up upChild" onclick="upChild(this)" ></i><i class="downChild down" onclick="downChild(this)"></i></p>',
            '</div>',
        '</li>',
      '</ul>',
    ].join('')

    var  childAgeStartHtml='<ul select2-div select class="childAgeUL row" >';
    var childAgeHtml=[
             '<li class="col clearfix"  data-id="1">',
                '<span class="fl">儿童<i class="childAgeNum">1</i></span>',
                '<div class="select_unit fl">',
                    '<p class="select_btn"><span class="num">1</span><i class="unit">岁</i><i onclick="up(this)" class="up"></i><i onclick="down(this)" class="down"></i></p>',
                '</div>',
            '</li>',
       ].join('');
    var childAgeEndHtml= '</ul>';
    var withBedHtml=[
      '<ul select2-div select class="row addBed"  style="display: none">',
      '<li class="col clearfix">',
      '<span class="fl">儿童加床</span>',
      '<div class="select_unit fl">',
      '<p class="select_btn"><span class="num" data-id="1">加一床</span></span><i class="up" onclick="upBed(this)"></i><i class="down" onclick="downBed(this)"></i></p>',
      '</div>',
      '</li>', ,
      '</ul>'].join('');
    var roomtEndHtml='</div>';
    var pop_end=[
      '</div>',
      '<div btn-default class="btn_div row clearfix fr">',
      '<p  class="btn btn2_hover fl addroom">+加房间</p>',
      '<p class="btn cur fl btnConfirm">确认</p>',
      '</div>',
      '</div>',
      '</div>',
      '</div>'
    ].join('')

    var popHotelTicket_tpl=popStartHtml+roomtStartHtml+adultChildCountHtml+childAgeStartHtml+childAgeEndHtml+withBedHtml+roomtEndHtml+pop_end;
    this.popHotelTicketHtml = ejs.render(popHotelTicket_tpl, this.config);

    var self = this,
        _config = self.config,
        _pophtml = self.popHotelTicketHtml;
    //下拉框事件，
    var that = this;

    //pop触发事件
    $("#"+_config.elemId).bind('click',function(e){
      $(".all").before(_pophtml);
      $(".pop_closed").on("click",function(){
        $(this).parents().find("#H-dialog").remove();
        $("#hotel_adult_number").html("1成人");
      });

      $(".addroom").on("click",function(){
        var room_tpl=roomtStartHtml+adultChildCountHtml+childAgeStartHtml+childAgeEndHtml+withBedHtml+roomtEndHtml;
        var roomHtml = ejs.render(room_tpl, that.config);
        var roomNo=parseInt($(".room").last().attr("data-id"));
        var roomNo=roomNo+1;
        $("#msgCont").append(roomHtml);
        $(".room").last().attr("data-id",roomNo);
        $(".room").last().find(".roomNumber").html(roomNo);

        $(".pop_font").css({"top":"300px"})
      })
      for(var i ;i<=that.config.maxRoom-1;i++) {
        $(".addroom").click();
      }

      $(".btnConfirm").on("click",function(){
        var roomList=[]
        $(".room").each(function(){
            var adultNum=0;
            var childtNum=0;
            var roomNum=0;
            var withBed=$(this).find(".addBed").find(".num").attr("data-id");
            var ageList=[];
            var childWithoutBed=[]
            var childWithBed=[]

            roomNum=$(this).attr('data-id');
            adultNum=$(this).find(".adultChildUL li").eq(0).find(".num").html();
            childtNum=$(this).find(".adultChildUL li").eq(1).find(".num").html();
           console.log("withBed:"+withBed);
            $(this).find(".ageLi").each(function(){
                 var age=  $(this).find(".num").html();
                 if(age!="") {
                   if (withBed == 1) {
                     childWithBed.push(age)
                   } else {
                     childWithoutBed.push(age);
                   }
                   ageList.push(age);
                 }
            })
            console.log("childWithBed2:"+JSON.stringify(childWithBed));
            console.log("childWithoutBed2:"+JSON.stringify(childWithoutBed));
            withBed=$(this).find(".addBed").find(".num").attr("data-id")||0;
            console.log("childWithoutBed:"+childWithoutBed.join(","));
            console.log("childWithBed:"+childWithBed.join(","));
            roomList.push({"adultNum":adultNum,"childtNum":childtNum,"withBed":withBed,"ageList":ageList.join(","),"childWithoutBed":childWithoutBed.join(","),"childWithBed":childWithBed.join(",")})
        });

        if(typeof that.config.callback =="function"){
          that.config.callback(roomList);
          $("#H-dialog").remove();
        }
      })
    })
  }
}

function  up($this){
  var obj=$($this).siblings(".num").html()
  var num=parseInt(obj||0);

  var currentNum=num+1;
  var childNum=parseInt($($this).closest(".room").find(".childNum").html());
  //成人最多6人
  if(currentNum>3) {
      return false;
  }
  if(currentNum>=2 && childNum>=1 ){
    $($this).closest(".room").find(".addBed").show();
  }else {
    $($this).closest(".room").find(".addBed").hide();
  }

  if(currentNum>=2 && childNum>=2){
    $($this).closest(".room").find(".addBed").find("i").hide();
  }
  else{
    $($this).closest(".room").find(".addBed").find("i").show();
  }
  $($this).siblings(".num").html(currentNum);

  var currentChildCount=parseInt($($this).closest(".room").find(".adultChildUL li").eq(1).find(".num").html());

  //if (currentChildCount>=1 && currentChildCount<2 && $($this).closest(".room").find(".addBed").length<1)
  //{
  //  $($this).closest(".room").append([
  //    '<ul select2-div select class="row addBed">',
  //    '<li class="col clearfix">',
  //    '<span class="fl">儿童加床</span>',
  //    '<div class="select_unit fl">',
  //    '<p class="select_btn"><span class="numofAdult" data-id="0">不加床</span></span><i class="up" onclick="upBed(this)"></i><i class="down" onclick="downBed(this)"></i></p>',
  //    '</div>',
  //    '</li>', ,
  //    '</ul>'].join(''));
  //}
  //else if(currentChildCount>=2 &&  $($this).closest(".room").find(".addBed").length<1)
  //{
  //  $($this).closest(".room").append([
  //    '<ul select2-div select class="row addBed">',
  //    '<li class="col clearfix">',
  //    '<span class="fl">儿童加床</span>',
  //    '<div class="select_unit fl">',
  //    '<p class="select_btn"><span class="numofAdult" data-id="1">加一床</span></span><i class="up" onclick="upBed(this)"></i><i class="down" onclick="downBed(this)"></i></p>',
  //    '</div>',
  //    '</li>', ,
  //    '</ul>'].join(''));
  //}

}
function  down($this){
  var obj=$($this).siblings(".num").html()
  var num=parseInt(obj||0);
  var currentNum=num-1;
  var childNum=parseInt($($this).closest(".room").find(".childNum").html());
    if(currentNum>0) {
      $($this).siblings(".num").html(currentNum);
    }
    if(currentNum>=2 && childNum>=1 ){
      $($this).closest(".room").find(".addBed").show();
    }else {
      $($this).closest(".room").find(".addBed").hide();
    }

    if(currentNum>=2 && childNum>=2){
      $($this).closest(".room").find(".addBed").find("i").hide();
    }
    else{
      $($this).closest(".room").find(".addBed").find("i").show();
    }

}

function  upChild($this){

  var obj=$($this).siblings(".num").html()
  var num=parseInt(obj||0);

  var currentNum=num+1;
  var adultNum=parseInt($($this).closest(".room").find(".adultNum").html());
  //小孩最多2小孩
  if(currentNum>2) {
    return false;
  }
  if (currentNum>=1 && adultNum>=2){

    $($this).closest(".room").find(".addBed").show();
    $($this).closest(".room").find(".addBed").find("i").show();

  }else {
    $($this).closest(".room").find(".addBed").hide()
  }

  if(currentNum>=2 && adultNum>=2){
    $($this).closest(".room").find(".addBed").find("i").hide();
    $($this).closest(".room").find(".addBed").find(".up").click();
  }
    var childAgeHtml = [
      '<li class="ageLi col clearfix"  data-id="1">',
      '<span class="fl">儿童<i class="childAgeNum">' + currentNum + '</i></span>',
      '<div class="select_unit fl">',
      '<p class="select_btn"><span class="num' +
      '"><%=childAgeMin%></span><i class="unit">岁</i><i onclick="upAge(this)" class="up"></i><i onclick="downAge(this)" class="down"></i></p>',
      '</div>',
      '</li>',
    ].join('');
    $($this).siblings(".num").html(currentNum);
    childAgeHtml=ejs.render(childAgeHtml, this.config);
    $($this).closest(".room").find(".adultChildUL").append(childAgeHtml);


}

function  downChild($this){

  var count=parseInt($($this).prevAll(".num").html()||0);
  var adultNum=parseInt($($this).closest(".room").find(".adultNum").html());
  if(count>=1) {
    $($this).siblings(".num").html(count-1);
    $($this).closest(".room").find(".adultChildUL li").last().remove();
  }
  var obj=$($this).siblings(".num").html()
  var num=parseInt(obj||0);
  var currentNum=num-1;

  //小孩最多2小孩
  if(currentNum>2) {
    return false;
  }
  if (currentNum>0 && adultNum>=2 ){
    $($this).closest(".room").find(".addBed").show();
    $($this).closest(".room").find(".addBed").find("i").show();
  }

  else {
    $($this).closest(".room").find(".addBed").hide()
  }

  if(currentNum>=2 && adultNum>=2){
    $($this).closest(".room").find(".addBed").find(".up").click();
    $($this).closest(".room").find(".addBed").find("i").hide();
  }

}

function  upBed($this){
    $($this).siblings(".num").html("加一床");
    $($this).siblings(".num").attr("data-id",1);
}

function  downBed($this){
  $($this).siblings(".num").html("不加床");
  $($this).siblings(".num").attr("data-id",0);
}

function upAge($this){
  var obj=$($this).siblings(".num").html()
  var num=parseInt(obj||0);
  var currentNum=num+1;

  if (currentNum<=childAgeMax) {
    $($this).siblings(".num").html(currentNum);
  }
}

function downAge($this){
  var count=parseInt($($this).prevAll(".num").html()||0);
  if(count>=1) {
    $($this).siblings(".num").html(count-1);
  }
}




