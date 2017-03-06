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
    callback:null,
    resulte:null
  }
}
select_person_pop.prototype = {

  init: function(options) {
    this.config = $.extend(this.config, options || {});
    var popTickHtml_tpl= ['<ul select-div class="visitor_info" id="visiter_order" style="">'+
    '<li class=" adult_list visitor_li">',
      '<span>成人数</span>',
      '<div class="select_unit">',
      '<p class="select_btn">',
      '<span><%=minPax%>人</span>',
      '<i></i>',
      '<input type="hidden" value="1">',
      '</p>',
      '<ul class="select_ul">',
      '<% for(var i=1;i<=maxAdult;i++) { %>',
      '<li data-value=<%=i%>><%=i%>人</li>',
      '<% } %>',
      '</ul>',
      '</div>',
      '</li>',
      '<% if(onlyForAdult!=1) { %>',
      '<li class="visitor_li child_list">',
      '<span>儿童数</span>',
      '<div class="select_unit">',
      '<p class="select_btn">',
      '<span>0人</span>',
      '<i></i>',
      '<input type="hidden"  value="0">',
      '</p>',
      '<ul class="select_ul">',
      '<% for(var i=0;i<=childAgeMax;i++) { %>',
      '<li data-value=<%=i%>><%=i%>人</li>',
      '<% } %>',
      '</ul>',
      '</div>',
      '</li>',

      '<li class="visitor_li clild_age" style="display:none;">',
      '<span>儿童1</span>',
      '<div class="select_unit">',
      '<p class="select_btn">',
      '<span>3岁</span>',
      '<i></i>',
      '<input type="hidden"  value="<%=childAgeMin%>">',
      '</p>',
      '<ul class="select_ul">',
      '<% for(var i=childAgeMin;i<=12;i++) { %>',
      '<li data-value=<%=i%>><%=i%>岁</li>',
      '<% } %>',
      '</ul>',
      '</div>',
      '</li>',
      '<% } %>',
      '<li btn-default=""><p class="search s_index btn1_hover selectPepole_ok">确认</p></li>',
      '</ul>'].join('');
    this.popTickHtml= ejs.render(popTickHtml_tpl, this.config);

    var self = this,
        _config = self.config
    _pophtml=_config.type=="ticket"?self.popTickHtml:self.popHotelTicketHtml;

    //下拉框事件，
    var that = this;
    var bindEvent=function() {

      $(' .select_btn').on("click", function (e) {
        $(this).next().slideToggle("fast").parent().siblings().find('.select_ul').hide();
        var ev = e || event;
        ev.stopPropagation()
      });
      $('.select_unit li').click(function (e) {
        $(this).parent().siblings().find('span').html($(this).html());
        $($(this).parent()).hide();
        var ev = e || event;
        ev.stopPropagation()
      });

      $('.adult_list .select_ul li').on("click",function(){

        var v=$(this).attr("data-value")
        $(this).parent().prev().find("input").attr("value",v);
        $($(this).parent()).hide();
      });
      $('.room_list .select_ul li').on("click",function(){
        var v=$(this).attr("data-value")
        $(this).parent().prev().find("input").attr("value",v);
        $($(this).parent()).hide();

      });
      $('.clild_age .select_ul li').on("click",function(){
        var v=$(this).attr("data-value")
        $(this).parent().prev().find("input").attr("value",v);
        $($(this).parent()).hide();

      });
      $('.child_withbed .select_ul li').on("click",function(){
        //var v=$(this).attr("data-value")
        //$(this).parent().prev().find("input").attr("value",v);
        $($(this).parent()).hide();
      });

      //选择儿童数量
      $('.child_list .select_ul li').on("click",function() {
        var value = $(this).attr("data-value")
        $(this).parent().prev().find("input").attr("value", value);
        var age_ul = $(this).parent().parent().parent().next().css("display", "block").clone(true);

        $(".clild_age").remove();
        if ($(age_ul).is(':hidden')) {
          if(value==0){
            if(value==0){
              $(age_ul).css("display", "none");
              $($(this).parent().parent().parent()).after($(age_ul).clone(true));
              return;
            }
          }
          $(age_ul).css("display", "block");
          for (var i = 1; i <= value; i++) {
            var obj=$(age_ul).clone(true);
            obj.find(".select_unit").prev().html("儿童"+(value-i+1));
            $($(this).parent().parent().parent()).after(obj)
          }
        }
        $($(this).parent()).hide();
      });

      $(".selectPepole_ok").on("click",function(){
        console.info(that.config);
        $(this).parent().parent().toggle();
        var adultNum=$('.adult_list input').val();
        var childtNum=$('.child_list input').val();
        var roomNum=$('.room_list input').val();
        var ageObj= $('.clild_age input');
        var ageList=[];
        for(var i=0;i<= ageObj.length-1;i++){
          ageList.push($(ageObj[i]).val());
        }
        console.log(ageList);
        var child_withbed=$('.child_withbed input').val();

        if(that.config.type=="ticket"){
          that.resulte=JSON.stringify({"adultNum":adultNum,"childtNum":childtNum,"ageList":ageList});
          if (that.config.onlyForAdult==1){
            $(this).parent().parent().prev().html(adultNum+"成人");
          }
          else {
            $(this).parent().parent().prev().html(adultNum+"成人 "+childtNum+" 儿童");
          }

        }
        else
        {
          that.resulte=JSON.stringify({"adultNum":adultNum,"childtNum":childtNum,"roomNum":roomNum,"ageList":ageList});
          $(this).parent().parent().prev().html(adultNum+"成人 "+childtNum+" 儿童 "+roomNum+"房间");
        }
        $(this).parent().parent().prev().attr("data-value",that.resulte);
        $(this).parent().parent().prev().css("border-bottom", "1px solid #eaeaea");
        if(typeof that.config.callback =="function"){
          that.config.callback();
        }
      })
    }
    //pop触发事件
    $("#"+_config.elemId).bind('click',function(e){
      var ev = e||event;
      ev.stopPropagation()
      var pop=$(this).parent().find(".visitor_info");
      if (pop.length==0) {
        $(this).after(_pophtml);
        $(this).css("border-bottom", "0");
        bindEvent();
      }
      else{
        pop.toggle();
        if($(pop).is(":visible")==true){
          $(this).css("border-bottom", "0");
        }
        else {
          $(this).css("border-bottom", "1px solid #eaeaea");
        }
      }
    })
  }
}




