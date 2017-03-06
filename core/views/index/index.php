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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/plugin/tab_card.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/ticket/ticket_order.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/index/index.css">
</head>
<body>
<div class="all">
    <!--topper  begin-->
    <?php echo $header; ?>

    <div index_banner>
        <div class="banner">
            <?php echo $bannerslide;?>
            <div class="menu_bg"></div>
        </div>
        <div class="search_card">
            <div index_card class = "tab_name">
                <div class = "cur">酒店<span class="sign">hot</span></div>
                <div>景点</div>
                <div>出境游</div>
                <span class = "span_flight">机票<span class="sign sign3">即将上线</span></span>
            </div>
            <div class = "tab_list">
<!--                酒店-->
                <?php echo $hotel_tab; ?>
<!--                景点-->
                <?php echo $ticket_tab; ?>
                <!--                酒+景-->
                <?php echo $hotel_ticket; ?>
<!--                机票-->
<!--                --><?php //echo $flight_tab; ?>
            </div>
        </div>
    </div>
    <div class="left_anchor">
        <div class="variety"><a class="nav_hotel" href="#hotel"><span  class ="cur"><i class ="icon icon_cur"></i>酒店</span></a><a class="nav_ticket" href="#ticket"><span><i  class = "icon"></i>景点</span></a><a
                class="nav_hotelticket"    href="#hotelticket"><span><i class = "icon"></i>出境</span></a></div>
        <div class = "user_top">
            <a href="./user/login"><span><i class = "icon_user"></i></span></a>
            <span class = "span_back"><i class = "icon_back"></i></span>
        </div>
    </div>
    <div class="contents" container_lr >
        <div class = "clearfix" oversea>
            <a name = "hotel"><h1>海外酒店</h1></a>
                    <div class ="contain_screen_l fl">
                    <ul>
                        <?php foreach($Hdata->sideBarList as $items=>$sideBarList):?>
                        <li class = "sale_title"><?php echo $sideBarList->sideBarCategory;?></li>
                            <?php foreach($sideBarList->sideBar as $item=>$h1):?>

                        <li class = "sale_link t_link" data_h_link = "<?php echo $h1->title;?>"><a href="<?php echo $h1->redirectUrl->{'#cdata-section'}?>"><?php echo $h1->title;?></a></li>
                            <?php endforeach;?>
                        <?php endforeach ;?>
                    </ul>
                        <div class = "ad_img"><img src="<?php echo $Hdata->sideBarImageUrl;?>" alt=""></div>
                </div>
                <div class="content fr clearfix">
                    <ul class = "hot_city" id="hotel_title">
                        <?php $flag = true; foreach($Hdata->cityList as $items=>$cityList):?>
                        <li <?php if ($flag) {
                            echo ' class="hot_cur"';
                            $flag = false;
                        } ?>><?php echo $cityList->cityCategory?></li>
                        <?php endforeach;?>
                    </ul>
                    <?php $flag = true; foreach($Hdata->cityList as $items=>$cityList):?>
                    <ul class = "hot_content clearfix hotel_content"  style="<?php if (!$flag) {
                        echo 'display: none;';
                    } else {
                        $flag = false;
                    } ?>;">
                        <?php foreach($cityList->city as $item=>$h2):?>
                        <li class="h_link">
                            <img src="<?php echo $h2->imageUrl;?>" alt="">
                            <div class = "gray_bg">
                                <div class = "hot_content_info" data-citycode="<?php echo $h2->countryCode;?>" data-cityname="<?php echo $h2->cityEnglishName;?>" data-citys="<?php echo $h2->cityChineseName;?>">
                                    <span class = "hot_info_name"><?php echo $h2->cityChineseName;?></span>
                                    <span class = "hot_info_num"><?php echo $h2->cityHotelDesc;?></span>
                                    <span class = "hot_info_price"><strong><?php echo $h2->price;?></strong>元起</span></div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php endforeach;?>
                </div>
            </div>
        <div class = "clearfix" ticket>
            <a name = "ticket" id = "ticket"><h1 class="hot_ticket">景点门票</h1></a>
                <div class ="contain_screen_l fl">
                    <h3><?php echo $Tdata->sideBarList[0]->sideBarCategory;?></h3>
                    <div class = "ticket_city">
                        <?php foreach($Tdata->sideBarList[0]->sideBar as $items=>$t1):?>
                            <span class = "t_title"data-destCityCode="<?php echo $t1->cityCode;?>" data-destCityName="<?php echo $t1->title;?>"><?php echo $t1->title;?></span>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="content fr clearfix" ticket_centent>
                    <?php foreach($Tdata->preferentialTicketList as $item=>$Tprefer):?>
                    <h3><?php echo $Tprefer->preferentialTicketCategory?></h3>
                    <?php endforeach;?>
                    <ul class="ticket_ploy_center">
                        <?php foreach($Tdata->preferentialTicketList as $items=>$Tprefer):?>
                        <?php foreach($Tprefer->preferentialTicket as $item=>$t2):?>
                                <li class = "ploy_centent T_package" data-packageID = "<?php echo $t2->packageId?>">
                                    <div class = "ploy_img"><img src="<?php echo $t2->imageUrl;?>" alt=""><div class = "ploy_name_bg"><span class = "ploy_name"><?php echo $t2->tourName;?></span></div></div>
                                    <div class = "ploy_center">
                                        <p class = "ploy_theme"><?php echo $t2->tourDesc;?></p>
                                        <p class = "ploy_num"><span class="ploy_price">￥ <strong><?php echo $t2->price;?></strong></span><span class = "ploy_gray">市场价: <del>￥</del><?php echo $t2->marketPrice;?></span></p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                        <?php endforeach;?>
                    </ul>
                </div>
        </div>
        <div class = "clearfix" hot_theme>
            <div class ="contain_screen_l fl">
                <h3><?php echo $Tdata->sideBarList[1]->sideBarCategory;?></h3>
                <ul class = "hot_theme">
                    <?php foreach($Tdata->sideBarList[1]->sideBar as $items=>$t3):?>
                    <li><span>·</span>&nbsp;<?php echo $t3->title;?></li>
                    <?php endforeach;?>
                </ul>
                <div class = "ad_img"><img src="<?php echo $Tdata->sideBarImageUrl;?>" alt=""></div>
            </div>
            <div class="content fr clearfix" ticket_centent hot_theme >
                <ul class = "hot_city" id = "theme_title">
                    <?php $flags=true; foreach($Tdata->tourList as $items=>$t4):?>
                    <li <?php if ($flags) {
                        echo ' class="hot_cur"';
                        $flags = false;
                    } ?>><?php echo $t4->tourCategory;?></li>
                    <?php endforeach;?>
                </ul>
                <?php $flags=true;foreach($Tdata->tourList as $items=>$Ttour):?>
                <ul class="ticket_ploy_center theme_content"style="<?php if (!$flags) {
                    echo 'display: none;';
                } else {
                    $flags = false;
                } ?>">
                    <?php foreach($Ttour->tour as $items=>$t5):?>
                    <li class = "ploy_centent">
                    <div class = "ploy_img"><img src="<?php echo $t5->imageUrl?>" alt=""><div class = "ploy_name_bg"><span class = "ploy_name"><?php echo $t5->tourName?></span></div></div>
                    <div class = "ploy_center">
                        <p class = "ploy_theme"><?php echo $t5->tourDesc?></p>
                        <p class = "ploy_num"><span class="ploy_price">￥ <strong><?php echo $t5->price?></strong></span><span class = "ploy_gray">市场价: <del>￥</del><?php echo $t5->marketPrice?></span><span class="prompt_buy T_by" data_t_id = "<?php echo $t5->packageId?>">立即预定</span></p>
                    </div>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endforeach;?>
            </div>
        </div>
        <div class = "clearfix" holiday>
            <a name = "hotelticket" id = "hotelticket"><h1>海外度假</h1></a>
            <div class ="contain_screen_l fl">
                <h3><?php echo $HTdata->sideBarList[0]->sideBarCategory;?></h3>
                <div class = "holiday_city">
                    <?php foreach($HTdata->sideBarList[0]->sideBar as $items=>$ht1):?>
                    <span class = "ht_title"data-destCityCode="<?php echo $ht1->cityCode;?>" data-destCityName="<?php echo $ht1->title;?>"><?php echo $ht1->title;?></span>
                    <?php endforeach;?>
                </div>
                <h3><?php echo $HTdata->sideBarList[1]->sideBarCategory;?></h3>
                <ul class = "holiday_city">
                    <?php foreach($HTdata->sideBarList[1]->sideBar as $items=>$ht2):?>
                    <li class = "sale_link"><a href=""><?php echo $ht2->title;?></a></li>
                    <?php endforeach;?>
                </ul>
                <div class = "ad_img"><img src="<?php echo $HTdata->sideBarImageUrl;?>" alt=""></div>
            </div>
            <div class="content fr clearfix" ticket_centent>
                <?php foreach($HTdata->vacationList as $HTvaca=>$ht3):?>
               <h3><i class="ht_icon"></i><?php echo $ht3->vacationCategory;?></h3>
                <ul class="ticket_ploy_center">
                     <?php foreach($ht3->vacation as $HTvacation=>$ht4):?>
                    <li class = "ploy_centent ht_by" data_ht_id = "<?php echo $ht4->packageId?>" data_ht_price = "<?php echo $ht4->price?>">
                        <div class = "ploy_img"><img src="<?php echo $ht4->imageUrl;?>" alt=""><div class = "ploy_name_bg"><span class = "ploy_name"><?php echo $ht4->vacationName;?></span></div></div>
                        <div class = "ploy_center">浪漫二人游
                            <p class = "ploy_theme"><?php echo $ht4->vacationDesc;?></p>
                            <p class = "ploy_num"><span class="ploy_price">￥ <strong><?php echo $ht4->price;?></strong></span><span class = "ploy_gray">市场价: <del>￥</del><?php echo $ht4->marketPrice;?></span><span class="prompt_buy ht_by" data_ht_id = "<?php echo $ht4->packageId?>" data_ht_price = "<?php echo $ht4->price?>">立即预定</span></p>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endforeach;?>
            </div>
        </div>
</div>
<!--topper  begin-->
<?php echo $footer; ?>
</div>
</body>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-popupcitylist.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/city_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/ejs.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/select_person_pop2_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/index/index.js"></script>
</html>
