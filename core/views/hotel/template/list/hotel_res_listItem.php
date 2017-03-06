 <ul class="hotel_list_det_cont">
     <?php foreach ($results->data[0]->hotelList as $k1 => $v1): ?>
    <li class="hotel_res_item clearfix">
        <div class="fl clearfix">
            <div class="fl hotel_front_img_wrap">
                <?php if(isset($v1->frontPgImage) ):?>
                    <img class="hotel_res_item_img" src="<?php echo $v1->frontPgImage ?>">
                <?php endif ?>
            </div>
            <div class="fl hotel_facilities">
                <h3 class="hotel_name"><?php echo isset($v1->hotelNameLocale)?$v1->hotelNameLocale:"" ?><span class="hotel_service_level">豪华型</span></h3>
                <p><?php echo $v1->address?>
                    <i class="hotel_country"><?php echo $v1->city ?></i>
                    <span class="hotel_icon location_tips"></span>
                </p>
                <div>
<!--                    --><?php //if(($v1->isFreeWiFi)==true):?>
<!--                    <span class="hotel_icon breakfast_tip"></span>-->
<!--                    --><?php //endif;?>
                    <?php if(($v1->isFreeTransfer)==true):?>
                    <span class="hotel_icon parking_tip"></span>
                    <?php endif;?>
                    <?php if(($v1->isFreeWiFi)==true):?>
                    <span class="hotel_icon wifi_tip"></span>
                    <?php endif;?>
<!--                    <i class="order_recent_text">近两天有<em class="order_num">15</em>人预定</i>-->
                </div>
                <div class="hotel_score_wrap">
                    <span class="hotel_score_wrap_span"><i class="hotel_score"><?php echo $v1->hotelReviewScore; ?></i>/5分</span>
                    <span class = "icon_div">
                        <span class="night_ow"></span>
                        <span class="night_icon night_ow1"></span>
                        <span class="night_icon night_ow2"></span>
                    </span>
                    <span class = "revie">共<i><?php echo $v1->hotelReviewCount; ?></i>条点评来自旅行社区<i class="travel_region">TripAdvisor</i></span>
                </div>
            </div>
        </div>
        <div btn-default class="fr check_detail">
            <span>¥<i class="price_per"><?php echo $v1->avgPriceCNY?></i>起/人</span>
            <p class="btn order btn1_hover detail_link" data-freetransfer="true" data-hotelcode="<?php echo $v1->hotelCode ?>"  hotellist-alloccupancy="true">查看详情</p>
        </div>
    </li>
<?php endforeach; ?>
 </ul>
