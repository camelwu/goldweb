$(function() {
  $(".scenic_area>li").hover(function() {
    $(this).find(".sa_mask").stop(false).animate({
      bottom : 0
    }, 300);
  },function() {
    $(this).find(".sa_mask").stop(false).animate({
      bottom : -138
    }, 200);
  });
  $(".index_option li").click(function() {//热门跟团游title单击事件
    $(this).siblings().removeClass("index_option_on");
    $(this).addClass("index_option_on");
    var al_num = $(".index_option li").index(this);
    var al_dom = "#" + $(this).parent().parent().next().attr("id");
    if (al_num == 4 || al_num == 3) {
      al_num = al_num - 3;
    } else if (al_num == 5 || al_num == 6) {
      al_num = al_num - 5;
    }
    $(al_dom).children("span").hide();
    //alert($(al_dom+" span").eq(1).html());
    $(al_dom).children("span").eq(al_num).show(0);
  });
  $(".sa_title li").click(function() {//热门跟团游二级title单击事件
    $(this).siblings().removeClass("sa_title_on");
    $(this).addClass("sa_title_on");
  });
  $(".recom_box ul li").click(function() {//推荐旅游导航单击事件
    $(this).siblings().removeClass("recom_on");
    $(this).addClass("recom_on");
  });
  $(".city_box li").click(function() {//热门跟团游左侧景区
    $(this).siblings().removeClass("city_li_on");
    $(this).addClass("city_li_on");
  });
  $(".slideBox").slide({
    mainCell : ".bd ul",
    effect : "fold",
    autoPlay : true,
    easing : "easeOutCirc",
    delayTime : 800
  });
});
