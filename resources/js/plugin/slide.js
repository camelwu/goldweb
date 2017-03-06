var Carousel = {
  id : "",
  animation : 1000, //图片切换时间间隔
  isAutoPlay : false, //是否自动播放动画，默认为false
  timer : null, //定时器
  eqNow : 0, //当前图片下标
  left : 0, //向左移动距离
  leftClick : true, //防左侧按钮频繁点击时产生的bug
  rightClick : true, //防右侧按钮频繁点击时产生的bug
  getMarginRight : function(){ //右边距
    return parseFloat($("#carouselLi li").eq(0).css("margin-right"));
  },
  getUnitWidth : function(){ //单位宽度
    var marginRight = this.getMarginRight();
    return parseInt($("#carouselLi li").css("width"))+marginRight;
  },
  getTotalWidth : function(){ //ul总宽度
    var marginRight = this.getMarginRight();
    var unitWidth = this.getUnitWidth();
    return unitWidth*($("#carouselLi li").size())-marginRight;
  },
  makeTotalWidth : function(){ //给ul总宽度赋值
    var totalWidth = this.getTotalWidth()+"px";console.log(totalWidth)
    $(".carousel_small").css("width",totalWidth);
    $("#carouselLi li:last").css("margin-right", "0")
  },
  setIndexNow : function(){
    var id = this.id;
    var number = this.eqNow+1;
    $(id).find(".index_now").html(number)
  },
  autoPlay : function(){
    var that = Carousel;
    that.eqNow++;
    //小图跟随转动
    var dataIndex = that.eqNow - 1;
    var unitWidth = that.getUnitWidth(); //单位宽度
    var totalWidth = that.getTotalWidth(); //ul总宽度
    var marginRight = that.getMarginRight(); //右边距
    if (that.eqNow <= 1) {
      that.left = 0;
    }
    if( that.eqNow > 1 && that.eqNow < $("#carouselBox li").length - 1 ){
      that.left = -(unitWidth * dataIndex);
    }
    if ( that.eqNow > ($("#carouselBox li").length - 1)){
      that.eqNow = 0;
      that.left = 0;
    }
    if (that.eqNow == $("#carouselBox li").length - 1) {
      that.left = -(totalWidth - unitWidth * 3) - marginRight;
    }
    var src = $("#carouselBox li").eq(that.eqNow).find("img").attr("src");
    $("#big_img").attr("src", src);
    that.setIndexNow();
    $("#carouselLi").animate({"left": that.left + "px"}, 300, function () {
      that.rightClick = true;
    })

  },
  movePlay : function(){
    this.isAutoPlay ? this.timer = setInterval(this.autoPlay,this.animation) : void(0);
  },
  hover : function(){ //滑过图片
    var that = Carousel;
    $("#carouselBox").on("mouseover", function (e) {
      if(that.timer){ clearInterval(that.timer)}
      if ($(e.target).hasClass('car_li') || $(e.target).parent().hasClass('car_li')) {
        var tem = $(e.target);
        $("#big_img").attr("src", tem.attr("src"));
        that.eqNow = tem.attr("data-index")-0;
        that.setIndexNow();
      }
    });
    $("#carouselBox").on("mouseout", function (e) {
      that.movePlay();
    });
  },
  leftRightClick : function(){ //点击左右按钮
    var that = Carousel;
    var unitWidth = that.getUnitWidth(); //单位宽度
    var totalWidth = that.getTotalWidth(); //ul总宽度
    var marginRight = that.getMarginRight();
    var left = that.left;
    $("#carouselBox").on("click",function(e){
      if($(e.target).hasClass("right") && that.rightClick == true){
        that.rightClick = false;
        (totalWidth+left)>unitWidth*3 ? ( left -= unitWidth) : (left = 0);
        $("#carouselLi").animate({"left":left+"px"},500,function(){
          that.rightClick = true;
        })
      }
      if($(e.target).hasClass("left") && that.leftClick == true){
        that.leftClick = false;
        left = left == 0 ? (left-(totalWidth - unitWidth*3+marginRight)) : (left + unitWidth);
        $("#carouselLi").animate({"left":left+"px"},500,function(){
          that.leftClick = true;
        })
      }
    })
  },
  init : function(){
    this.makeTotalWidth();
    this.animation = arguments[0]["animation"];
    this.isAutoPlay = arguments[0]['isAutoPlay'];
    this.id = arguments[0]['id'];
    this.movePlay();
    this.hover();
    this.leftRightClick();
    this.setIndexNow();
  }
};
Carousel.init({
  id : "#carouselBox",
  animation : 5000,
  isAutoPlay : true
})