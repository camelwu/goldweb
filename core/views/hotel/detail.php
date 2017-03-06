<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>酒店详情</title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
    <link rel="stylesheet"
          href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel/hotelDetail.css">
</head>
<body>
<div class="all">
    <!--    head-->
    <?php echo $header; ?>
    <div class="contents" gloabl>
        <div name_slider>
            <div class="score_address">
                <h2 id="hid"
                    data-hid="<?php echo $hotel_info->data['0']->hotelGenInfo->masterHotelID; ?>"><?php echo $hotel_info->data['0']->hotelGenInfo->hotelNameLocale . "(" . $hotel_info->data['0']->hotelGenInfo->hotelName . ")"; ?>
                    <span>豪华型</span></h2>

                <p class="score"><strong><?php echo $hotel_info->data['0']->hotelGenInfo->hotelReviewScore; ?></strong>
                    / 5分 <i class="cat_icon"></i><i class="star_icons star_icon1"></i><i class="star_icons star_icon2"></i></p>

                <p class="address"><?php echo $hotel_info->data['0']->hotelGenInfo->hotelAddress; ?><i
                        class="address_icon"></i></p>
            </div>
            <div slide_img hotel_gallery>
                <?php echo $preview_slider;?>
            </div>
        </div>
        <div class="service_items clearfix" service_items>
            <div class="hotel_tabs_box" id="hotel_tabs_box">
                <ul class="nav_ul clearfix">
                    <li class="cur"><a href="#1F" class="wa">房型预订</a></li>
                    <li><a href="#2F" class="wa">酒店简介</a></li>
                    <li><a href="#3F" class="wa">交通指南</a></li>
                    <li><a href="#4F" class="wa">用户点评</a></li>
                </ul>
            </div>

            <div class="detail_part_wrap" id="detail_part_wrap">
                <div class="detail_part clearfix">
                    <a class="pos_a" name="1F" id="1F"></a>
                    <!-- <h3><i></i>房型预订</h3>-->
                    <div class="detail_sub_part clearfix">
                        <div class="live_in_time">
                            <span class="sub_title">入住时间:</span>
                            <span class="time_info"><?php echo substr($sesson_info["parameters"]["checkInDate"],0,10);?></span>
                            <span><?php echo get_week($sesson_info["parameters"]["checkInDate"]);?></span>
                            <span>至</span>
                            <span class="time_info"><?php echo substr($sesson_info["parameters"]["checkOutDate"],0,10);?></span>
                            <span><?php echo get_week($sesson_info["parameters"]["checkOutDate"]);?></span>
                            <span class="time_info">共<?php echo diff_date($sesson_info["parameters"]["checkInDate"],$sesson_info["parameters"]["checkOutDate"],"D"); ?>晚</span>
                            <span class="info_two sub_title">入住信息:</span>
                            <span class="time_info"><?php echo$sesson_info["parameters"]["numOfGuest"];?>成人<?php echo$sesson_info["parameters"]["numOfChild"];?>儿童<?php echo $sesson_info["parameters"]["numOfRoom"];?>间房</span>
                        </div>
                        <?php foreach ($hotel_info->data['0']->hotelRoomsList as $k2 => $v2): ?>
                        <div class="hotel_sub_wrap clearfix">
                            <div class="hotel_img fl"><img src="<?php echo isset(
                                    $v2->roomTypeImagesList['0']->imageFileName)?$v2->roomTypeImagesList['0']->imageFileName:""; ?>" class="hotel_img"/></div>
                            <div class="rooms_type fl" rooms_type>
                                <h2><?php echo $v2->roomTypeName; ?></h2>
                                <?php foreach ($v2->roomList as $k4 => $v4): ?>
                                    <?php if($v4->promotionDetails):?>
                                        <p><i class="discount"></i><?php echo $v4->promotionDetails?></p>
                                    <?php else:?>
                                        <p style="height: 28px;"></p>
                                    <?php endif;?>
                                <?php endforeach; ?>
                                <p>
                                    <?php if(($v2->roomList[0]->isFreeTransfer)!=true||($v2->roomList[0]->isFreeWiFi)!=true):?>
                                        <i style="height: 20px;display: block;"></i>
                                    <?php else:?>
                                        <?php foreach ($v2->roomList as $k4 => $v4): ?>
                                            <?php if(($v4->isFreeTransfer)==true):?>
                                                <i class="park_icon"></i>
                                            <?php endif;?>
                                            <?php if(($v4->isFreeWiFi)==true):?>
                                                <i class="wifi_icon"></i>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                    <span class="price_num">¥<strong class=""> <?php echo $v2->minAvgPrice ?></strong> 起/人</span>
                                </p>

                                <p class="sp">近期内有<?php echo$hotel_info->data['0']->hotelGenInfo->hotelReviewCount; ?>人评论 <span class="fr check_room_type">查看房型<i></i></span></p>
                                <div class="room_items_out" data-rtc="<?php echo $v2->roomTypeCode; ?>">
                                    <div class="line_div title_div clearfix">
                                        <div class="_type">房型</div>
                                        <div class="_bed">床型</div>
                                        <div class="_breakfast">是否含早</div>
                                        <div class="_change_rule">退改签规则</div>
                                        <div class="_price">价格</div>
                                        <div class="_order">预订</div>
                                    </div>
                                    <?php foreach ($v2->roomList as $k3 => $v3): ?>
                                    <div class="room clearfix" data-item="<?php echo $k3; ?>">
                                        <div class="line_div clearfix">
                                            <div class="_type" data-rtc="<?php echo $v2->roomTypeCode; ?>"
                                                 data-rc="<?php echo $v3->roomCode; ?>"><?php echo $v3->roomTypeName; ?>
                                                <i class="room_info"></i></div>
                                            <div class="_bed">大/双人床</div>
                                            <div class="_breakfast"><?php echo $v3->isABD ? "含早" : "不含早"; ?></div>
                                            <div
                                                class="_change_rule"><?php echo $v3->cancellationInfoInRoomList; ?></div>
                                            <div class="_price">￥<?php echo $v3->avgPriceCNY; ?></div>
                                            <div class="_order">
                                                <?php if($v3->paymentModeID==1):?>
                                                    <a class="ro bookingBtn" href="javascript:;">预订<i class=""></i></a>
                                                <?php elseif($v3->paymentModeID==2):?>
                                                    <a class="ro" href="javascript:;" onclick=" showMsg('暂不支持到付业务',1,function(arg){
                                                           return false;

                                                       });">到付<i class=""></i></a>
                                                <?php endif;?>

                                            </div>
                                        </div>
                                        <div class="room_img"
                                        ">
                                        <ul class="clearfix">
                                            <li><img src=""></li>
                                        </ul>
                                        <p class="room_word">
                                            <span></span>
                                        </p>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="detail_part clearfix">
                <a class="pos_a" name="2F" id="2F">
                    <h3 class="no_pb"><i class="v_line"></i>酒店简介</h3>
                </a>
                <div class="detail_sub_part">
                    <ul class="detail_word">
                        <li>
                            <h4>基本信息</h4>

                            <p>
                                酒店名称：<?php echo $hotel_info->data['0']->hotelGenInfo->hotelNameLocale . "  " . $hotel_info->data['0']->hotelGenInfo->hotelName; ?>
                                <br/>
                                酒店地址：<?php echo $hotel_info->data['0']->hotelGenInfo->hotelAddress; ?> <br/>
                                <!--  酒店电话：65-6-5898000 <br/>
                                  基本信息：房间数 442间 层高57层-->
                            </p>
                        </li>
                        <li>
                            <h4>酒店位置</h4>

                            <p>
                                <?php echo $hotel_info->data['0']->hotelGenInfo->hotelDesc; ?>
                            </p>
                        </li>
                        <!-- <li>
                             <h4>客房</h4>
                             <p>
                                 有 442 间空调客房提供冰箱和iPod 基座；您定能在旅途中找到家的舒适。您的客房备有加厚层卧床。免费无线上网让您与朋友保持联系；卫星节目可满足您的娱乐需求。配备淋浴设施的独立浴室提供大花洒淋浴喷头和免费洗浴用品。
                             </p>
                         </li>-->
                        <!--<li>
                            <h4>餐饮</h4>
                            <p>
                                您可以到服务新加坡克拉码头智选假日酒店住客的餐厅享用一顿美餐。包含免费的欧式早餐。
                            </p>
                        </li>-->
                        <!--<li>
                            <h4>商务及其他服务设施 </h4>
                            <p>
                                特色服务/设施包括24 小时商务中心、电脑站和大堂免费报纸。酒店提供收费自助停车。
                            </p>
                        </li>-->
                        <li>
                            <?php if($hotel_feature->data['0']->hotelRoomAmenitiesList):?>
                                <h4>设施 </h4>

                                <p>
                                    <?php echo $hotel_feature->data['0']->hotelRoomAmenitiesList[0]->featureDesc; ?>
                                </p>
                            <?php endif;?>
                        </li>
                        <!-- <li>
                             <h4>服务 </h4>
                             <p>
                                 停车场     早餐     大堂     WIFI     行李存放     洗衣     滚梯/电梯
                             </p>
                         </li>-->
                    </ul>
                </div>
            </div>
            <div class="detail_part clearfix">
                <a class="pos_a" name="3F" id="3F">
                    <h3><i class="v_line"></i>交通指南</h3>
                </a>
                <div class="detail_sub_part">
                    <div id="map"></div>
                    <form name="mapInfo" id="mapInfo">
                        <input name="latitude" value="<?php echo $hotel_info->data['0']->hotelGenInfo->latitude; ?>"
                               type="hidden"/>
                        <input name="longitude" value="<?php echo $hotel_info->data['0']->hotelGenInfo->longitude; ?>"
                               type="hidden"/>
                        <input name="hotelNameLocale"
                               value="<?php echo $hotel_info->data['0']->hotelGenInfo->hotelNameLocale; ?>"
                               type="hidden"/>
                        <input name="rtc" value="" type="hidden"/>
                        <input name="ri" value="" type="hidden"/>
                    </form>
                    <!--<ul class="detail_word">
                        <li>
                            <h4>交通信息</h4>
                            <p>
                                新加坡圣淘沙名胜世界环球影城距离新加坡的中央商业区仅十分钟车程，交通四通八达，选择任何交通工具都能轻松抵达。您也可以选择悠闲的从怡丰城漫步至圣淘沙名胜世界。<br/>
                                搭乘地铁/圣淘沙捷运 前往新加坡环球影城的途径如下：<br/>
                                1.搭乘地铁东北线或环线至港湾站。<br/>
                                2.从E 出口前往怡丰城的3层搭乘圣淘沙捷运。乘坐1站后在滨海站下车。<br/>
                                3.直走至右侧的Chilis餐厅。右转后走向环球影城。<br/>
                            </p>
                        </li>
                    </ul>-->
                </div>
            </div>
            <div class="detail_part clearfix">
                <a class="pos_a" name="4F" id="4F"></a>
                <?php  if(isset($hotel_commit->data)):?>
                    <div class="detail_sub_part">
                        <div class="title_commit">以下点评来自于全球最大旅行社区<span>TripAdvisor</span>的独立点评 <i
                                class="cat_icon"></i>trip<span>advisor</span></div>
                        <ul class="commit_ul">
                            <?php foreach ($hotel_commit->data['0']->reviewCommentsList as $k4 => $v4): ?>
                                <li class="clearfix">
                                    <div class="portrait fl">
                                        <div class="img_wrap"><img src="../../../resources/images/header_60.png"/>
                                        </div>
                                        <p class="name_user"><?php echo $v4->reviewerName; ?></p>

                                        <p><?php echo $v4->countryName; ?></p>
                                    </div>
                                    <div class="comment_wrap fl">
                                        <p class="score_line"><strong><?php echo $v4->avgReviewerRating; ?></strong>
                                            / 5分 <span class = "icon_div"><i class="star_icons star_c star_icon1"></i><i class="star_icons star_c star_icon2"></i> </span><span
                                                class="s_word"><?php echo $v4->title; ?></span></p>

                                        <p class="commit_content"><?php echo $v4->comments; ?></p>

                                        <p class="commit_date"><span
                                                class="c_date"><?php echo string_cut($v4->createdDate, 0, 10); ?></span>来自TripAdvisor
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!--            <div class="fr page_wrap" page>-->
            <!--                --><?php //echo $pager_html; ?>
            <!--            </div>-->
        </div>
    </div>
    <div class="bg_big"><img src="<?php echo $this->config->item('resources_url') ?>/resources/images/ico_loading.gif"/></div>
</div>


<!--底部-->
<?php echo $footer; ?>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/maps.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel/detail.js"></script>
</body>
</html>