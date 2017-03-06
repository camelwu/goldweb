<?php
/**
 * Created by PhpStorm.
 * User: zhouwei
 * Date: 2016/8/29
 * Time: 23:31
 */
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/jquery-ui-1.10.3.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/select_person_pop2_v1.0.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel_ticket/index.css">
</head>
<body>
<div class="all" fill>
    <!--topper  begin-->
    <?php echo $header; ?>

    <div index_banner>
        <div class="banner">
            <?php echo $bannerslide;?>
            <div class="menu_bg"></div>
        </div>
        <div class="search_card">
            <?php echo $tab_card; ?>
        </div>
<!--        <div class="banner" style="background-image:url(../../../resources/images/ticket/ticket_banner.png)">-->
        </div>
    </div>

    <div class="contents">
        <?php echo $hot_cities_html ?>
        <?php echo $packages_html ?>
    </div>

    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-popupcitylist.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/city_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script>
    (function () {
        $('.search').on('click', function () {
            if($("#search_box").val()==""){
                $("#loading").fadeIn("medium");
                window.location.href ='/hotelticket/lists?DestCityCode=SIN&DestCity=新加坡';
            }else{
                $("#loading").fadeIn("medium");
                window.location.href ='/hotelticket/lists?DestCityCode='+$("#search_box").attr("data-code")+'&DestCity='+$("#search_box").attr("data-name")
            }
        });
        $(".city_hot>li").on("click",function(){
            $("#loading").fadeIn("medium");
            window.location.href='/hotelticket/detail?packageID='+$(this).attr("data_packageId")+"&leadinPrice="+$(this).attr("data_leadinPrice");
        });
        function show(index) {
            $('[hot_city] .city_title li').removeClass('selected').eq(index).addClass('selected');
            $('[hot_city] .city_list ul').hide().eq(index).show();
        }
        $('[hot_city] .city_title li').on('click', function (e) {
            show($(this).index());
        });
        $("#search_box").popularCityList({
            param: {
                DataType: 4 //4为酒景类型
            },
            textbox: 'search_box',
            showdomestic: true,
        })


    })();
</script>
</body>
</html>
