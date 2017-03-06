<link rel="stylesheet" href="../../../resources/css/banner_slide.css">
<div class = "banner">
    <div  class = "banner_box">
        <ul class = "banner_img">
            <?php foreach($banner_slide->bannerList as $item):?>
            <li class = "banner_li"><img src="<?php echo $item->bannerPicUrl;?>" alt=""></li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class = "banner_span"><span class="left"><</span><span class="right">></span></div>
<!--    <div class = "banner_num"><span class = "img_index">1</span>/<span class = "img_length">5</span></div>-->
    <div class = "banner_num">
        <ul class = "li_num">
        </ul>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script>
    ~(function($){
        var banner = {};//定义全局字面量单体
        banner.init={   //为单体添加属性
            time:5000,   //图片切换时间
            isAutoPlay:false,//是否自动播放
            timer:null,//定时器
            index:0,// 图片编号
            leader:0,
            target:0,
            left:0,
            leftClick:true,//防左侧按钮频繁点击时产生的bug
            rightClick:true, //防右侧按钮频繁点击时产生的bug
        };
        banner.getMargin={   //为单体添加方法
            getUnitWidth:function(){    //单位宽度
                return parseInt($(".banner_img li").css("width"));
            },
            getTotalWidth : function(){    //ul总宽度
                var unitWidth = this.getUnitWidth();
                return unitWidth*($(".banner_img li").size());
            },
            makeTotalWidth : function(){ //给ul总宽度赋值
                var totalWidth = this.getTotalWidth()+"px";
                $(".banner_img").css("width",totalWidth);
            }
        };
        banner.autoPlay={
            autoplay:function(){
                var that= banner.init;
                var indexli = that.index;
                that.index++;
                var dataIndex = that.index - 1;
                var unitWidth =  banner.getMargin.getUnitWidth(); //单位宽度
                var totalWidth =  banner.getMargin.getTotalWidth(); //ul总宽度
                var target=banner.init.target;
                var imgindex=$(".img_index");
                if (that.index <= 1) {
                    that.target = 0;
                }
                if( that.index > 1 && that.index < $(".banner_img li").length){
                    that.target = -(unitWidth * dataIndex);
                    dataIndex=that.index-1;
                }
                if ( that.index > ($(".banner_img li").length)){
                    that.index = 0;
                    that.target = 0;
                    dataIndex=$(".banner_img li").length-1;
                }
                if (that.index == $(".banner_img li").length) {
                    that.target = -(unitWidth * dataIndex);
                    dataIndex=$(".banner_img li").length-1;
                };
                $(".banner_img").animate({"left": that.target + "px"}, 1000, function (e) {
                    $(".img_index").html(dataIndex+1);
                    that.rightClick = true;
                });
                if($(".li_num").children().length==0){
                    for(var i=0;i<$(".banner_img li").length;i++){
                        var temp = "<li></li>";
                        $(".li_num").append(temp);
                    }
                }
                $(".li_num").children().eq(indexli).addClass("cur").siblings("li").removeClass("cur");
            },
            movePlay : function(){
                this.autoplay ? banner.init.timer = setInterval(this.autoplay,banner.init.time) : void(0);
            },
            hover : function(){  //滑过图片
                $(".banner").mouseover(function (){
                    $(".banner_span").css({"display":"block"})
                }).mouseout(function () {
                    $(".banner_span").css({"display": "none"});
                })

        }}
        banner.bindClick = {
            leftRightclick :function(){
                var index= banner.init.index+1;
                var that=banner.getMargin;
                var unitWidth = that.getUnitWidth(); //单位宽度
                var totalWidth = that.getTotalWidth(); //ul总宽度
                $(".img_length").html($(".banner_img li").length);
                $(".right").on("click", function(e) {
                    if(banner.init.rightClick == true){
                    banner.init.rightClick = false;
                    banner.init.target -= unitWidth;
                    if (index <= 1) {
                        index = 1;
                        banner.init.target = 0
                    }
                    if( index > 1 && index < $(".banner_img li").length-1){
                        index = index;
                        banner.init.target <= -(totalWidth-unitWidth);
                    }
                    if ( index >= ($(".banner_img li").length)){
                        index = $(".banner_img li").length;
                        banner.init.target = -(totalWidth-unitWidth);
                    };
                        console.log(index)
                        $(".img_index").html(index);
                        index=index+1;
                        $(".banner_img").animate({"left":banner.init.target+"px"},1000,function(){
                        banner.init.rightClick = true;
                    });
                        console.log(index);
                    }
                });
                $(".left").on("click", function(e) {
                    if(banner.init.leftClick == true){
                        banner.init.leftClick = false;
                        banner.init.target += unitWidth;
                        if (index <= 1) {
                            index = 1;
                            banner.init.target = 0
                            console.log(index)
                        }
                        if( index > 1 && index < $(".banner_img li").length){
                            index = index;
                            console.log(index)
                            banner.init.target <= -(totalWidth-unitWidth);
                        }
                        if ( index >= ($(".banner_img li").length)){
                            index = $(".banner_img li").length;
                            banner.init.target = -(totalWidth-unitWidth);
                            console.log(index)
                        }
                        $(".img_index").html(index);
                        index=index-1;
                        $(".banner_img").animate({"left":banner.init.target+"px"},1000,function(){
                            banner.init.leftClick = true;
                        });
                    }
                });

            }
        };
        banner._init={
            init: function(){
                banner.getMargin.makeTotalWidth();
                banner.init.isAutoPlay = arguments[0]['isAutoPlay'];
                banner.autoPlay.autoplay();
                banner.autoPlay.movePlay();
                banner.autoPlay.hover();
                banner.bindClick.leftRightclick();
            }
        };
        banner._init.init({
            isAutoPlay : false
    });
    })(jQuery)
</script>
