<?php
/**
 * Created by PhpStorm.
 * User: qizhenzhen
 * Date: 2016/11/1
 * Time: 13:59
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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel/index.css">
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
    </div>
</div>

<div class="contents">
    <?php $hotelDom = 'hotelType=dom';if (strpos($_SERVER['REQUEST_URI'], $hotelDom) !== false): ?>
        <?php echo $inter_hot_hotel_html ?>
        <?php echo $inter_hot_dest_html  ?>
    <?php else: ?>
        <?php echo $inter_hot_dest_html  ?>
        <?php echo $inter_hot_hotel_html ?>
    <?php endif;?>
</div>

<!--topper  begin-->
<?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-popupcitylist.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/city_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/ejs.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/select_person_pop2_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/lazyLoad.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel/index.js"></script>



</body>
</html>
