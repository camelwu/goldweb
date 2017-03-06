<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href=<?php $this->config->item('resources_url')?>"/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/ticket/index.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/ticket/ticket_order.css">
</head>
<body>

<div class="all">
    <!--header  begin-->
    <?php echo $header; ?>
    <!--banner  begin-->
    <div ticket_banner>
        <div class="banner">
            <?php echo $bannerslide;?>
        </div>
        <div class="banner_bg"></div>
        <div class = "banner_search" btn-default>
            <div class="search_centent">
                <div class = "search_input" input-prompt>
                    <input class= "public submit_input" type="text" placeholder="请输入目的地、景点">
                    <ul class="search_prompt" style="display: none;">
                        <?php foreach($catgorycity->recommends as $item):?>
                        <li class="search_address"><?php echo $item->category;?></li>
                        <li class="search_nation">
                            <span class = "destination" data-id="<?php echo $item->value;?>"><?php echo $item->text;?></span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <p class = "search s_index btn1_hover">搜索</p>
            </div>
        </div>
    </div>
    <!--banner  end-->
    <div class="contents" ticket_centent>
        <div class = "ticket_ploy">
            <div class="ticket_title">
                <h3 class = "ticket_ploy_title">海外玩乐</h3>
                <div class="fr ticket_address">
                    <?php $i=0; foreach($cityArray as $item): ?><span <?php if ($i==0):?> class="cur"<?php endif;?>><?php $i=$i+1; echo $item?></span>
                <?php endforeach;?></div>
            </div>
            <div id = "lis">
                <?php echo $ticket_order;?>
            </div>
        </div>
        <div class="ticket_hot">
            <h3 class = "ticket_hot_title">海外热门城市</h3>
            <div class="hot_centent clearfix">
                <div class = "fl hot_fl">
                    <div class = "hot_fl_one" id = "one_img" data-citycode="<?php echo $hotcity->hotCities[0]->cityCode;?>" data-cityname="<?php echo $hotcity->hotCities[0]->cityName;?>"><img src="<?php echo $hotcity->hotCities[0]->imgUrl;?>" alt=""><div class = "hot_fl_bg_img"><span class = "hot_name"><?php echo $hotcity->hotCities[0]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_one"><p><?php echo $hotcity->hotCities[0]->cityName;?></p><p>17234个景点</p></span></div></div>
                    <div class ="hot_fl_two fl" data-citycode="<?php echo $hotcity->hotCities[1]->cityCode;?>"data-cityname="<?php echo $hotcity->hotCities[1]->cityName;?>"><img src="<?php echo $hotcity->hotCities[1]->imgUrl;?>" alt=""><div class = "hot_fl_bg"><span class = "hot_name"><?php echo $hotcity->hotCities[1]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_two"><p><?php echo $hotcity->hotCities[1]->cityName;?></p><p>17234个景点</p></span></div></div>
                    <div class ="hot_fl_two fl_three fl" data-citycode="<?php echo $hotcity->hotCities[2]->cityCode;?>" data-cityname="<?php echo $hotcity->hotCities[2]->cityName;?>"><img src="<?php echo $hotcity->hotCities[2]->imgUrl;?>" alt=""><div class = "hot_fl_bg"><span class = "hot_name"><?php echo $hotcity->hotCities[2]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_two"><p><?php echo $hotcity->hotCities[2]->cityName;?></p><p>17234个景点</p></span></div></div>
                </div>
                <div class = "fr hot_fr">
                    <div class = "hot_fr_one" data-citycode="<?php echo $hotcity->hotCities[3]->cityCode;?>" data-cityname="<?php echo $hotcity->hotCities[3]->cityName;?>"><img src="<?php echo $hotcity->hotCities[3]->imgUrl;?>" alt=""><div class = "hot_fl_bg"><span class = "hot_name"><?php echo $hotcity->hotCities[3]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_three"><p><?php echo $hotcity->hotCities[3]->cityName;?></p><p>17234个景点</p></span></div></div>
                    <div class = "hot_fr_one" data-citycode="<?php echo $hotcity->hotCities[4]->cityCode;?>" data-cityname="<?php echo $hotcity->hotCities[4]->cityName;?>"><img src="<?php echo $hotcity->hotCities[4]->imgUrl;?>" alt=""><div class = "hot_fl_bg"><span class = "hot_name"><?php echo $hotcity->hotCities[4]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_three"><p><?php echo $hotcity->hotCities[4]->cityName;?></p><p>17234个景点</p></span></div></div>
                    <div class = "hot_fr_one fr_three" data-citycode="<?php echo $hotcity->hotCities[5]->cityCode;?>" data-cityname="<?php echo $hotcity->hotCities[5]->cityName;?>"><img src="<?php echo $hotcity->hotCities[5]->imgUrl;?>" alt=""><div class = "hot_fl_bg"><span class = "hot_name"><?php echo $hotcity->hotCities[5]->cityName;?></span></div><div class = "hot_fl_bg_hover"><span class ="hot_name_hover hover_three"><p><?php echo $hotcity->hotCities[5]->cityName;?></p><p>17234个景点</p></span></div></div>
                </div>
            </div>
        </div>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<script src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-popupcitylist.js"></script>
<script src="<?php echo $this->config->item('resources_url')?>/resources/js/ticket/index.js"></script>
</body>
</html>