<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/plugin/slide.css">

<div id="carouselBox" class="carousel_box">
  <!--大图-->
  <p data-id="big_img" class="carousel_big">
    <img id="big_img" data-index=0 src="/resources/images/demo/big1.jpg">
  </p>
  <!--小图-->
  <div class="carouselUl">
    <ul id="carouselLi" class="carousel_small">
      <li class='car_li' data-index=0>
        <img data-index=0 src="/resources/images/demo/big1.jpg" alt="">
      </li>
      <li class='car_li' data-index=1>
        <img data-index=1 src="/resources/images/demo/big2.jpg" alt="">
      </li>
      <li class='car_li' data-index=2>
        <img data-index=2 src="/resources/images/demo/big3.jpg" alt="">
      </li>
      <li class='car_li' data-index=3>
        <img data-index=3 src="/resources/images/demo/big4.jpg" alt="">
      </li>
      <li class='car_li' data-index=4>
        <img data-index=4 src="/resources/images/demo/big5.jpg" alt="">
      </li>
      <li class='car_li' data-index=5>
        <img data-index=5 src="/resources/images/demo/big6.jpg" alt="">
      </li>
      <li class='car_li' data-index=6>
        <img data-index=6 src="/resources/images/demo/big7.jpg" alt="">
      </li>
    </ul>
  </div>

  <div data-id="btn" class="carousel_btn">
    <img class="left" src="/resources/images/demo/left_btn.png">
    <img class="right" src="/resources/images/demo/right_btn.png">
  </div>
</div>


<script>
$(function(){
  var left = 0;//向左移动
  var leftClick = true;//可以点击想做移动
  var rightClick = true;//可以点击想做移动
  var marginRight = parseFloat($("#carouselLi li").eq(0).css("margin-right"));//右边距
  //list按钮总宽度
  var unitWidth = parseInt($("#carouselLi li").css("width"))+marginRight;//单位宽度
  var totalLength = unitWidth*($("#carouselLi li").size())-marginRight;//总宽度

  $(".carousel_small").css("width",totalLength+"px");
  $("#carouselLi li:last").css("margin-right","0")
  //点击小图换大图
  $("#carouselBox").on("click",function(e){
    if($(e.target).hasClass("right") && rightClick == true){
      rightClick = false;
      (totalLength+left)>unitWidth*3 ? ( left -= unitWidth) : (left = 0);
      $("#carouselLi").animate({"left":left+"px"},500,function(){
        rightClick = true;
      })
    }
    if($(e.target).hasClass("left") && leftClick == true){
      leftClick = false;
      left = left == 0 ? (left-(totalLength - unitWidth*3+marginRight)) : (left + unitWidth);
      $("#carouselLi").animate({"left":left+"px"},500,function(){
        leftClick = true;
      })
    }
  })
  //自动播放
  var eqNow = 0;
  var timer= null;
  timer = setInterval(autoplay,2000)
  function autoplay(){
    eqNow++;
    if( eqNow>$("#carouselBox li").length-1 ) eqNow = 0;
    var src = $("#carouselBox li").eq(eqNow).find("img").attr("src");
    var dataIndex = parseFloat($("#carouselBox li").eq(eqNow).attr("data-index"))-1;
    $("#big_img").attr("src",src);

    //小图
    if(eqNow>1 && eqNow<$("#carouselBox li").length-1){
      left = -(unitWidth*dataIndex) ;
    }
    if(eqNow == $("#carouselBox li").length-1){
      left = -(totalLength-unitWidth*3)-marginRight ;
    }
    if( eqNow<=1 ){
      left = 0;
    }
    $("#carouselLi").animate({"left":left+"px"},500,function(){
      rightClick = true;
    })
  }
  //划过换图
  $("#carouselBox").on("mouseover",function(e){
    clearInterval(timer)
    if($(e.target).hasClass('car_li')||$(e.target).parent().hasClass('car_li')){
      var tem = $(e.target);
      $("#big_img").attr("src",tem.attr("src"));
      eqNow = tem.attr("data-index");
    }
  });
  $("#carouselBox").on("mouseout",function(e){
    timer = setInterval(autoplay,2000)
  });
})
</script>

