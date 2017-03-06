<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item("resources_url") ?>/resources/images/favicon.ico"
          type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/assembly.css">
    <link rel="stylesheet"
          href="<?php echo $this->config->item("resources_url") ?>/resources/css/plugin/select_person_pop2_v1.0.css">
    <link rel="stylesheet"
          href="<?php echo $this->config->item("resources_url") ?>/resources/css/hotel_ticket/detail.css">
    <link rel="stylesheet" href="/resources/css/plugin/jquery-ui-1.10.3.css">
</head>
<body>
<div class="all">
    <!--头部-->
    <?php echo $header; ?>

    <div class="contents">
        <!--面包屑导航-->
        <div class="nav_bread">
<!--            <a href="/index/index">首页</a>-->
<!--            <i>&gt;</i>-->
            <a href="/hotelticket">出境游</a>
            <i>&gt;</i>
            <a href="/hotelticket/lists?DestCityCode=<?php echo $package->destCityCode ?>&DestCity=<?php echo $package->destCity ?>"><?php echo $package->destCity ?></a>
            <i>&gt;</i>
            <span><?php echo $package->packageName ?></span>
        </div>
        <!--article1-->
        <div class="article1 clearfix" btn-default article1>
            <!--slide-->
            <?php echo $slide; ?>
            <!--右侧-->
            <div class="message fr">
                <h3><?php echo $package->packageName ?></h3>
                <ul>
                    <li class="clearfix">
                        <span class="lf_word">套餐包括</span>
                        <div class="rg_mes">
                            <!--<p>3天2晚住宿<br/>2晚住宿，含早餐<br/>华侨银行空中走道电子票 <br/>新加坡环球影城电子票</p>-->
                            <?php echo $package->inclusiveItem; ?>
                        </div>
                    </li>
                    <li class="clearfix">
                        <span class="lf_word">行程天数</span>
                        <div class="rg_mes">
                            <p><?php echo string_cut($package->packageName, 0, 8); ?></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <span class="lf_word">产品编号</span>
                        <div class="rg_mes">
                            <p><?php echo $package->packageRefNo; ?></p>
                        </div>
                    </li>
                    <li class="price_li clearfix">
                        <span class="lf_word">预订价格</span>
                        <div class="rg_mes price">
                            <span>￥</span>
                            <i class="total_price"><?php echo empty($price) ? $_GET["leadinPrice"] : $price ?></i>
                            <span>
                                <span class="price_qi"><?php echo empty($roomID) ? "起/人" : "" ?></span><!--接口返回的价格是总价, 所以[/人]这个也要去掉-->
                            </span>
<!--                            <a href="javascript:;">起价说明</a>-->
                        </div>
                    </li>
                    <li>
                        <a class="btn order btn1_hover" id="orderFill" style="display: none">选人数房间</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--article2-->
        <div class="article2" input-prompt article2>
            <!--choose-->
            <div class="clearfix" id="dateChoose" choose data-hotelID="" data-hotelName="" data-roomID=""
                 data-roomName="">
                <div class="choose fl">
                    <input class="public fl" id="checkInDate" type="text"
                           data-defaultDepartStartDate="<?php echo $package->defaultDepartStartDate; ?>"
                           data-val="<?php echo $package->defaultDepartStartDate; ?>"
                           value="<?php echo formate_date($package->defaultDepartStartDate,"Y-m-d") ?>">
                    <input class="public fl" id="checkOutDate" type="text"
                           data-minDuration="<?php echo $package->minDuration; ?>"
                           data-val="" value="<?php echo  formate_date($package->defaultDepartStartDate,"Y-m-d",+$package->minDuration-1) ?>" max-date="<?php echo $package->departValidTo; ?>">
                    <!--<p class="people fl">2成人0儿童1间房</p>-->
                    <div select_person class="fl">
                        <div class="txtoutput people " id="test_person_select">请选择</div><!--TODO 如果session中有房间信息, 这里需要还原-->
                    </div>
                </div>
                <div class="fr" btn-default>
                    <span class="lf_word fl">预订价格</span>
                    <div class="price fl">
                        <span>￥</span>
                        <i class="total_price"><?php echo empty($price) ? $_GET["leadinPrice"] : $price ?></i>
                        <span>
                            <span class="price_qi"><?php echo empty($roomID) ? "起/人" : "" ?></span>
                        </span>
                    </div>
                    <a id="btnSearchPrice" class="btn order btn1_hover fl btnSearchPrice"
                       style="<?php echo empty($roomID) ? "" : "visibility:initial;" ?>" href="javascript:;">立即预定</a>
                </div>
            </div>
            <!--loading-->
            <div class="detail_onload" detail_onload>
                loading....
            </div>
            <?php echo empty($hotel_tour) ? "" : $hotel_tour ?>
        </div>
        <!--article3-->
        <div class="article3" article3>
            <!--局部菜单-->
            <div class="fixed_menu clearfix" id="divFollowedMenu">
                <a href="#package" class="cur">套餐简介</a>
                <a href="#useComment">预订须知</a>
                <a href="#clause">服务条款</a>
            </div>
            <!--内容-->
            <div class="detail_box">
                <div class="detail_content">
                    <h3 class="title_h3" id="package">套餐简介</h3>
                    <div>
                        <?php foreach ($package->tours as  $item):?>
                           </br><?php echo $item->overview; ?></br>
                        <?php endforeach;?>
                    </div>
                    <h3 class="title_h3" id="useComment">预定须知</h3>
                    <div>
                        <?php echo $package->tours[0]->importantNotes; ?>
                    </div>
                    <h3 class="title_h3" id="clause">服务条款</h3>
                    <div>
                        <?php echo $package->termsConditions; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--底部-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript"
        src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript"
        src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel_ticket/detail.js"></script>
<script type="text/javascript"
        src="<?php echo $this->config->item("resources_url") ?>/resources/js/lib/ejs.js"></script>
<script type="text/javascript"
        src="<?php echo $this->config->item("resources_url") ?>/resources/js/plugin/select_person_pop2_v1.0.js"></script>
<script src="<?php echo $this->config->item("resources_url") ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<!--日历-->
<!--日历-->
<script>


    var date1 = $("#checkInDate").datepicker({
        minDate:('<?php echo $package->defaultDepartStartDate; ?>' ? new Date('<?php echo $package->defaultDepartStartDate; ?>') : null),
        maxDate : ('<?php echo $package->departValidTo; ?>' ? new Date('<?php echo $package->departValidTo; ?>') : null),
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
            console.log(selectedDate);
            var curDate = new Date(selectedDate);
            $(".travelDate").datepicker("option","minDate",selectedDate);
            $("#checkOutDate").datepicker("option","minDate",new Date(curDate.setDate(curDate.getDate()+<?php echo ($package->minDuration)-1?>)));
            $("#checkOutDate").datepicker("option","maxDate",new Date(curDate.setDate(<?php echo formate_date($package->departValidTo,"Y-m-d")?>)));

        }
    });

    var dates2 = $("#checkOutDate").datepicker({
        minDate: ('<?php echo formate_date($package->defaultDepartStartDate,"Y-m-d",+$package->minDuration-1); ?>'),
        maxDate : ('<?php echo $package->departValidTo; ?>' ? new Date('<?php echo $package->departValidTo; ?>') : null),
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
            console.log(selectedDate);
//            var option = this.id == "checkInDate" ? "minDate" : "maxDate",
//                instance = $(this).data("datepicker"),
//                date = $.datepicker.parseDate(
//                    instance.settings.dateFormat ||
//                    $.datepicker._defaults.dateFormat,
//                    selectedDate, instance.settings);
//            if (option == "minDate") {
//                dates.not(this).datepicker("option", option, date);
//            }
//            $(this).attr("data-val", selectedDate + "T00:00:00");//替换当前值
//            $(this).val(selectedDate);//替换当前值
////            $(".travelDate").datepicker("option", option, date);
        }
    });
</script>
<script type="text/javascript">
    var strSelect = $("#test_person_select").attr("data-value");
    var roomCount = 1;//这里有个数据最小是，不需要设置
    var roomArray;
    if (strSelect) {
        var strJson = $.parseJSON(strSelect);
        roomCount = strJson.roomNum;
    }

    var ifScroll = false;
    new select_person_pop().init({
        isShowRoom: true,
        type: "hotel_ticket",// ticket:景点门票， hotel_ticket:酒景
        elemId: "test_person_select",//
        maxRoom: 6,
        minPax:<?php echo $package->minPax?>,
        maxPax:<?php echo $package->maxPax?>,//最多总人数
        maxAdult:<?php echo $package->maxAdult?>=="-1"?<?php echo $package->maxAdult?>:3, //最多成人数
        childAgeMax:<?php echo $package->childAgeMax?>,//最多儿童数
        childAgeMin:<?php echo $package->childAgeMin?>,//最小儿童年龄
        onlyForAdult: false, //最只能是成人,
        callback: function (obj) {

            var adultNum=0;
            var childtNum=0;
            roomArray=[];
            for(var i=0;i<=obj.length-1;i++){
                adultNum+=parseInt(obj[i].adultNum);
                childtNum+=parseInt(obj[i].childtNum);
                console.log("info:"+obj[i].childWithoutBed);
                var roomDetail={
                    Adult:obj[i].adultNum
                }
                //是否加床
                console.info(obj)
                if(obj[i].childWithoutBed!="") {
                    roomDetail.ChildWithoutBed = obj[i].childWithoutBed.split(",");
                }
                if(obj[i].childWithBed!="") {
                    roomDetail.ChildWithBed = obj[i].childWithBed.split(",");
                }
                roomArray.push(roomDetail);
            }
           console.info(roomArray)
           //console.info(roomArray)
            $('#test_person_select').html(obj.length + '房间'+adultNum+ '成人' + childtNum + '儿童');
            $(".detail_onload").show().html("loading....");
            if ($(".control_show")) {
                $(".control_show").hide();
            }
            var postObj = {
                checkInDate: $("#checkInDate").val(),
                checkOutDate: $("#checkOutDate").val(),
                adult: $("#test_person_select").html().substring(3, 4),
                childWithoutBed: $("#test_person_select").html().substring(6, 7),
                roomID: $("#dateChoose").attr("data-roomID"),
                roomName: $("#dateChoose").attr("data-roomName"),
                roomCount: roomCount,
                roomArray:roomArray
            };
            postObj.roomDetails = $("#test_person_select").attr('data-value');
            $.ajax({
                type: "POST",
                url: "/hotelticket/asy_hotel_tour?leadinPrice=<?php echo $_GET["leadinPrice"]?>",
                data: postObj,
                async: true,//是否是异步
                cache: false,//是否带缓存
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        $("#btnSearchPrice").css({"visibility": "initial"});
                        if ($(".article2 .control_show").length > 0) {
                            $(".article2 .control_show").remove();
                        }
                        $(".detail_onload").hide();
                        $(".article2").append(res.message);
                        ifScroll = true;
                        if (ifScroll == true && $(window).scrollTop() > $(".article2").offset().top) {
                            $(window).scrollTop($(".article2").offset().top);
                            $("#dateChoose").css({"position": "fixed"});
                            $("#btnSearchPrice").css({"visibility": "initial"})
                        } else {
                            $("#dateChoose").css({"position": "absolute"});
//              $("#btnSearchPrice").css({"visibility":"hidden"})
                        }
                        $(".house_room_choose").attr("data-roomID", $(".choose_btn").eq(0).find("a").attr("data-roomID"));
                        $(".house_room_choose").attr("data-roomName", $(".choose_btn").eq(0).find("a").attr("data-roomName"));

                    } else {
//                        alert(1)
                        $(".detail_onload").html(res.message);
                    }
                },
                error: function (res) {
                    $(".detail_onload").html("请求超时，请重新加载");
//                    alert(2)
                }
            });
        }
    });
    $(function () {

        var postObj = {};

        console.info("init："+postObj.roomID)
        //预订跳转按钮 提交
        $(document).on("click", function (e) {

            if ($(e.target).hasClass("btnSearchPrice")) {
                postObj.roomID = $(e.target).closest(".article2").find(".house_room_choose .choose_btn .cur").attr("data-roomID");
                postObj.roomName = $(e.target).closest(".article2").find(".house_room_choose .choose_btn .cur").attr("data-roomName");

                var tours = [];
                var flag = true;
                $(".tourInfo").each(function (i) {
                    var tourID = $(".tourInfo").eq(i).find(".tourName").attr("data-tourID");
                    var tourName = $(".tourInfo").eq(i).find(".tourName h3").html();
                    if (!$(".tourInfo").eq(i).find(".travelDate").val()) {
                        flag = false;
                    }
                    var travelDate = $(".tourInfo").eq(i).find(".travelDate").val() + "T00:00:00";
                    var tourSession = $(".tourInfo").eq(i).find(".rg_mes .cur").attr("data-session");
                    tours.push({
                        "tourID": tourID,
                        "tourName": tourName,
                        "travelDate": travelDate,
                        "tourSession": tourSession
                    })
                });


                postObj.tours = tours;
                console.info("发送数据:"+postObj.roomID);
                $.ajax({
                    type: "POST",
                    url: "/hotelticket/asy_hotel_tour_order",
                    data: postObj,
                    async: true,//是否是异步
                    cache: false,//是否带缓存
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            window.location.href = "/hotelticket/order";
                        } else {
                            alert(data.message);
                        }
                    }
                })
            }
        })
    })
</script>

</body>
</html>
