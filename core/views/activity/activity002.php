<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/activity/activity002.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <div class = "bg_contents">
        <img src="../../../resources/images/activity/activity201_bg.png" alt="">
    </div>
    <div class="contents content_conter">
        <div class ="bg_title">
            <h3>春季出游如何选择酒店</h3>
            <p>一年之计在于春，如今天气已有了暖意，是时候该带着宝贝到国外畅快的游玩了！这些拥有舒适贴心服务的酒店，会是你们忘却或开学，或上班的苦闷；丢掉年后假日综合征赵成的烦恼...自会令你们在停留在当下的快乐中，与自己的宝贝们一同无忧无虑的疯玩，增进彼此的感情，一家人嗨到不行！</p>
        </div>
        <div content class = "clearfix" >
            <div content_l class = "clearfix" id = "title_name">
            </div>
            <div content_r>
                <ul class = "ul_div" id = "title_content">
                </ul>
            </div>
        </div>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
</body>
<script type="text/javascript" src="../../../resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="../../../resources/js/activity/activity002.js"></script>
<script type="text/javascript" src="../../../resources/js/lib/ejs.js"></script>
<script type="text/template" id="titleName">
    <ul  class = "l_title">
        <% for(var i=0;i<=json.length-1;i++){%>
        <% if(i==1){%>
        <li class = "index_title_3 cur"><%=json[1].name %></li>
        <%} else{%>
        <li class = "index_title_3"><%=json[i].name %></li>
        <%}%>
        <%}%>
    </ul>
    <div class = "l_label">
        <span></span>
        <span>
            <% for(var a=1,j=json.length-2; a< json.length+1,-1< j;a++,j--){%>
               <% if(i==0){%>
            <i class = "icon_0 index_0"><%= 0 %></i>
                <%} else{%>
            <i class = "icon_<%= json.length-a %> index_<%= json.length-a %>"><%= a%></i>
                <%}%>
            <%}%>
        </span>
    </div>
    <div class = "l_ad"><img src="../../../resources/images/activity/activity201.png" alt=""></div>
</script>
<script type="text/template" id="titleContent">
    <% for(var i=0,j=json.length-1;i<=json.length-1,0< j ;i++,j--){ %>
    <% if(i==0){%>
    <li  class="r_content li_index_<%= j%>">
        <i></i><div class = "r_img"><img src="<%= json[0].imageUrl %>" alt=""></div>
        <div class="r_conter">
            <h3><%= json[0].name %></h3>
            <p><%= json[0].title %></p>
            <p class ="r_info">
                <span class ="r_addr"><i></i><%=json[0].destCityName %></span>
                <span class = "r_price"><span>￥<strong><%=json[0].price %></strong></span>起</span>
            </p>
        </div>
    </li>
    <%} else{%>
    <li  class="r_content li_index_<%= j%>">
        <i></i><div class = "r_img"><img src="<%= json[i].imageUrl %>" alt=""></div>
        <div class="r_conter">
            <h3><%= json[i].name %></h3>
            <p><%= json[i].title %></p>
            <p class ="r_info">
                <span class ="r_addr"><i></i><%=json[i].destCityName %></span>
                <span class = "r_price"><span>￥<strong><%=json[i].price %></strong></span>起</span>
            </p>
        </div>
    </li>
    <%}%>
    <%}%>
</script>
<script>
    $(document).scroll(function(){
        var scrolltop = $(window).scrollTop();
        var offsetHight = document.body.offsetHeight;
        var height = $("[content_r]").height();
        var r_hitght = $("r_content").height();
        var len = $(".ul_div>li");
        var titlelen = $(".l_title>li");
        console.log("scrolltop:"+scrolltop);
        if( 0<=scrolltop && scrolltop<=720){
            $("[content_l]").css({"position":"absolute","top":48,"left":0});
            $(".l_label>span:first").css({"height":height-38});
        }else if(720<scrolltop && scrolltop<height){
            $("[content_l]").css({"position":"fixed","top":0,"left":$(window).width()=="1583"?188:$(window).width()*0.188});
            var box_height=502;
            var index=parseInt((offsetHight-scrolltop-730)/box_height);

            $(".li_index_"+index).find("i").css({"display":"block"});
            console.log("index_height:"+(5-index))
            $(".icon_"+index).css({"display":"block","top":35+(7-index)*60});
            $(".index_"+index).css({"display":"block"}).siblings().css({"display":"none"});
            //$(".index_title_"+index).addClass("cur").siblings().removeClass("cur");
        }
    });
    var htmla = $("#titleName").html();
    var htmlA = ejs.render(htmla, {json:data[0].data});
    $("#title_name").html(htmlA);
    var htmlb = $("#titleContent").html();
    var htmlB = ejs.render(htmlb, {json:data[0].data});
    $("#title_content").html(htmlB);
</script>

</html>
