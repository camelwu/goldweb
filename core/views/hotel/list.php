<?php
/**
 * Created by PhpStorm.
 * User: qizhenzhen
 * Date: 2016/11/3
 * Time: 11:06
 * @querystring应该依赖php进行参数传递
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico"
          type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/jquery-ui-1.10.3.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel/list.css">
</head>
<body>
<div class="all" fill>
    <!--topper  begin-->
    <?php echo $header; ?>
    <div class="contents">
        <div hotel_list>
            <!--导航面包屑-->
            <?php if($_GET["statetype"]==0):?>
            <div class="nav_bread">
                <a href="javascript:;">国际酒店</a>
                <i>&gt;</i>
                <span class="city_hotel">新加坡酒店</span>
            </div>
            <?php else: ?>
                <div class="nav_bread">
                    <a href="javascript:;">国内酒店</a>
                    <i>&gt;</i>
                    <span class="city_hotel">新加坡酒店</span>
                </div>
            <?php endif; ?>
            <!--搜索条件main and sub-->
            <?php echo $hotel_list_search_html ?>
            <!--展示列表-->
            <?php echo $hotel_list_res_html ?>
        </div>
    </div>

    <!--footer  begin-->
     <?php echo $footer; ?>

</div>


<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery.pagination.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/maps.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel/lists.js"></script>
<script>var pageObj = {totalCount :<?echo $results->data[0]->hotelCount?>, perPageCount :1,callback:function(){},currentPage:0};</script>
</body>
</html>
