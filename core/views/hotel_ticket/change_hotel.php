<?php

/**
 * Created by PhpStorm.
 * User: zhouwei
 * Date: 2016/8/29
 * Time: 23:34
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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel_ticket/change_hotel.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/price_group/price_group.css">
</head>
<body>
<div class="all" fill>
    <!--topper  begin-->
    <?php echo $header; ?>

    <div class="contents">
        <div filter-div>
            <div class="filter_div">
                <div class="checkbox_list clearfix">
                    <div>级别:</div>
                    <ul class="clearfix">
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" class="select_all"></a></i>全部</li>
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" name="starRating" value="2 星级"></a></i>二星级</li>
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" name="starRating" value="3 星级"></a></i>三星级</li>
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" name="starRating" value="4 星级"></a></i>四星级</li>
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" name="starRating" value="5 星级"></a></i>五星级</li>
                    </ul>
                </div>
                <div class="checkbox_list clearfix">
                    <div>地理位置:</div>
                    <ul class="clearfix">
                        <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" class="select_all"></a></i>全部</li>
                        <?php foreach($hotel_list->data->locationList as $item):?>
                            <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox"></a></i><?php echo $item;?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div class="list_bar clearfix">
                <div class="recommend fl">推荐</div>
                <div class="up_down_btn up cur price fl">价格<i></i></div>
            </div>
        </div>
        <?php echo $hotel_list_html ?>
        <!--分页信息没有-->
        <div class="clearfix hotel_page">
<!--            <div page class="clearfix fr">-->
<!--                <span class="pg_pre"></span>-->
<!--                <span class="pg_curr">1</span>-->
<!--                <a class="pg_link" href="#">2</a>-->
<!--                <a class="pg_link" href="#">3</a>-->
<!--                <a class="pg_link" href="#">4</a>-->
<!--                <a class="pg_link" href="#">5</a>-->
<!--                <a class="pg_link" href="#">6</a>-->
<!--                <a class="pg_link" href="#">7</a>-->
<!--                <a class="pg_link" href="#">8</a>-->
<!--                <a class="pg_next" href="#"></a>-->
<!--            </div>-->
        </div>
    </div>

    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<div id="loading-div" style="display: none;">
    <img src="../../../resources/images/ico_loading.gif" alt="">
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/price_group/price_group.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel_ticket/change_hotel.js"></script>
<script>
    function gotoDetail(packageID, hotelID, roomID) {
        window.location.href = '/hotelticket/detail?packageID=' + packageID + '&hotelID=' + hotelID + '&roomID=' + roomID + '&leadinPrice=<?php echo $_GET["leadinPrice"]?>';
    }
</script>
</body>
</html>

