<?php foreach ($feater_data->data['0']->hotelRoomsList as $k2 => $v2): ?>
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
        <p class="sp">近期有<?php echo $feater_data->data['0']->hotelGenInfo->hotelReviewCount; ?>人评论 <span class="fr check_room_type">查看房型<i></i></span></p>
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
                <div class="room_img">
                    <ul class="clearfix"><li><img src=""></li></ul>
                    <p class="room_word"><span></span></p>
                </div>
            </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach;?>