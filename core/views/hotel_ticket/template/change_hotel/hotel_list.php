<div hotel-list>
    <?php if ($hotel_list->success) foreach($hotel_list->data->hotels as $hotel) { ?>
        <div class="hotel clearfix">
            <div class="hotel_img">
                <img src="<?php echo $hotel->hotelPictureURL ?>" alt="">
            </div>
            <div class="hotel_detail" >
                <div class="hotel_msg"  >
                    <div class="title" onclick="vlm.Utils.OpenWin('/hotel/detail?hotelCode=<?php echo $hotel->hotelID;?>')">

                        <span class="main" ><?php echo $hotel->hotelName ?></span>
                        <span class="type"><?php echo $hotel->starRating ?></span>
                        <span class="score"><?php echo $hotel->hotelGenInfo->hotelReviewScore ?></span>
                        <span class="total">/ 5分</span>
                        <span class="comment_count">（<?php echo $hotel->hotelGenInfo->hotelReviewCount ?>条评论）</span>
                    </div>
                    <div class="address clearfix">
                        <div class="title fl">酒店地址</div>
                        <div class="content fl clearfix">
                            <div class="fl"><?php echo $hotel->hotelGenInfo->hotelAddress ?></div>
                            <i></i>
                        </div>
                    </div>
                    <div class="facilities clearfix">
                        <div class="title fl">酒店设施</div>
                        <div class="content fl clearfix">
                            <!--只有一个wifi字段-->
                            <!--<i class="food"></i>-->
                            <!--<i class="park"></i>-->
                            <?php if ($hotel->hotelGenInfo->isFreeWiFi) {echo '<i class="wifi"></i>';} ?>
                        </div>
                    </div>
                    <div class="price">
                        ￥<span><?php echo ($hotel->avgRatePerPaxInCNY < $hotel->avgRatePerPaxSeparatelyInCNY ? $hotel->avgRatePerPaxInCNY : $hotel->avgRatePerPaxSeparatelyInCNY) ?></span>起/人
                    </div>
                    <div class="show_room clearfix" hotel-id="<?php echo $hotel->hotelID ?>" hotel-name="<?php echo $hotel->hotelName ?>">
                        <i class="fr"></i>
                        <div class="fr">查看房型</div>
                    </div>
                    <div class="hide_room clearfix" style="display: none;">
                        <i class="fr"></i>
                        <div class="fr">收起房型</div>
                    </div>
                </div>
                <div class="hotel_room" style="display: none;">
                    <div class="room_title clearfix">
                        <div class="room_type fl">房型</div>
<!--                        <div class="bed_type fl">床型</div>-->
                        <div class="breakfast fl">是否含早</div>
<!--                        <div class="change_rule fl">退改规则</div>-->
                        <div class="diff_price fl">差价</div>
                        <div class="reserve fl">预订</div>
                    </div>
                    <div class="room_list">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>