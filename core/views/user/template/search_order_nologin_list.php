<div class = "contents clearfix" >
    <div class="content_l fl" content_left>
        <ul class = "list">
            <li class = "list_my"><i></i>我的亚程首页</li>
            <li class = "list_order"><i></i>我的订单</li>
        </ul>
    </div>
    <div class="right_part list_information fr" content_right order_lists traveller_lists>
        <!--订单列表-->
        <?php if($orderData->success):?>
            <?php if(count($orderData->data)>0):?>
                <!--true ,data[N]-->
                <ul class="order_ul">
                    <?php $len = array_key_exists('maxSize',$errorDIY)?$errorDIY['maxSize']:count(count($orderData->data));?>
                    <?php foreach($orderData->data as $k => $v): ?>
                        <?php if($k < $len && is_object($v)): ?>
                            <?php if($v->productType=="Fligh"):?>
                                <li>
                                    <p class="list_top clearfix">
                                        <span class="order_name"><?php echo get_order_type($v->productType);?></span>
                                        <span class="order_no">订单号&nbsp;:&nbsp;<i><?php echo $v->bookingRefNo;?></i></span>
                                        <span class="order_date">预定日期&nbsp;:&nbsp;<?php echo substr($v->bookingDate,0,10);?></span>
                                    </p>
                                    <!--细节-->
                                    <div class="order_out clearfix">
                                        <div class="order_name">
                                            <span><?php echo $v->productName;?></span>
                                        </div>
                                        <div class="order_owner">
                                            <span><?php echo $v->memberName;?></span>
                                        </div>
                                        <div class="trip_type">
                                            去程&nbsp;：&nbsp;<span><?php echo substr($v->travelStartDate,0,10);?></span><br>
                                            <?php if(isset($v->travelEndDate) ): ?>
                                                返程&nbsp;：&nbsp;<span><?php echo substr($v->travelEndDate,0,10);?></span>
                                            <?php endif;?>
                                        </div>
                                        <div class="order_price">
                                            <span><?php echo $v->currency;echo $v->bookingAmount ?></span>
                                        </div>
                                        <div class="order_status">
                        <span>
                            <?php echo get_order_status($v->bookingStatus);?>
                        </span>
                                        </div>
                                        <div class="order_actions">
                                            <?php if($v->productType=="Flight"):?>
                                                <span><a href="<?php echo '/payment/order_detail?type=Flight&bookingRefNo='.$v->bookingRefNo?>">查看</a></span>
                                            <?php elseif($v->productType=="Hotel"):?>
                                                <span>查看</span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </li>
                            <?php elseif($v->productType=="Package_T"):?>
                                <li>
                                    <p class="list_top clearfix">
                                        <span class="order_name">景点</span>
                                        <span class="order_no">订单号&nbsp;:&nbsp;<i><?php echo $v->bookingRefNo;?></i></span>
                                        <span class="order_date">预定日期&nbsp;:&nbsp;<?php echo substr($v->bookingDate,0,10);?></span>
                                    </p>
                                    <!--细节-->
                                    <div class="order_out clearfix">
                                        <div class="order_name">
                                            <span><a href="<?php echo '/payment/order_detail?type=Ticket&bookingRefNo='.$v->bookingRefNo?>"><?php echo $v->productName;?></a></span>
                                        </div>
                                        <div class="order_owner">
                                            <span><?php echo $v->memberName;?></span>
                                        </div>
                                        <div class="trip_type">
                                            订票日期 &nbsp;<span><?php echo substr($v->travelStartDate,0,10);?></span><br>
                                        </div>
                                        <div class="order_price">
                                            <span><?php echo $v->currency;echo $v->bookingAmount ?></span>
                                        </div>
                                        <div class="order_status">
                        <span>
                            <?php echo get_order_status($v->bookingStatus);?>
                        </span>
                                        </div>
                                        <div class="order_actions">
                                            <?php if($v->productType=="Flight"):?>
                                                <span><a href="<?php echo '/payment/order_detail?type=Ticket&bookingRefNo='.$v->bookingRefNo?>">查看</a></span>
                                            <?php elseif($v->productType=="Package_T"):?>
                                                <span>查看</span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </li>
                            <?php elseif($v->productType=="Hotel"):?>
                                <li>
                                    <p class="list_top clearfix">
                                        <span class="order_name">酒店</span>
                                        <span class="order_no">订单号&nbsp;:&nbsp;<i><?php echo $v->bookingRefNo;?></i></span>
                                        <span class="order_date">预定日期&nbsp;:&nbsp;<?php echo substr($v->bookingDate,0,10);?></span>
                                    </p>
                                    <!--细节-->
                                    <div class="order_out clearfix">
                                        <div class="order_name">
                                            <span><a href="<?php echo '/payment/order_detail?type=Hotel&bookingRefNo='.$v->bookingRefNo?>"><?php echo $v->productName;?></a></span>
                                        </div>
                                        <div class="order_owner">
                                            <span><?php echo $v->memberName;?></span>
                                        </div>
                                        <div class="trip_type">
                                            入住&nbsp;：&nbsp;<span><?php echo substr($v->travelStartDate,0,10);?></span><br>
                                            <?php if(isset($v->travelEndDate) ): ?>
                                                离店&nbsp;：&nbsp;<span><?php echo substr($v->travelEndDate,0,10);?></span>
                                            <?php endif;?>
                                        </div>
                                        <div class="order_price">
                                            <span><?php echo $v->currency;echo $v->bookingAmount ?></span>
                                        </div>
                                        <div class="order_status">
                        <span>
                            <?php echo get_order_status($v->bookingStatus);?>
                        </span>
                                        </div>
                                        <div class="order_actions">
                                            <?php if($v->productType=="Flight"):?>
                                                <span><a href="<?php echo '/payment/order_detail?type=Hotel&bookingRefNo='.$v->bookingRefNo?>">查看</a></span>
                                            <?php elseif($v->productType=="Package_T"):?>
                                                <span>查看</span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </li>
                            <?php elseif($v->productType=="Package_HT"):?>
                                <li>
                                    <p class="list_top clearfix">
                                        <span class="order_name">酒+景</span>
                                        <span class="order_no">订单号&nbsp;:&nbsp;<i><?php echo $v->bookingRefNo;?></i></span>
                                        <span class="order_date">预定日期&nbsp;:&nbsp;<?php echo substr($v->bookingDate,0,10);?></span>
                                    </p>
                                    <!--细节-->
                                    <div class="order_out clearfix">
                                        <div class="order_name">
                                            <span><a href="<?php echo '/payment/order_detail?type=HotelTicket&bookingRefNo='.$v->bookingRefNo?>"><?php echo $v->productName;?></a></span>
                                        </div>
                                        <div class="order_owner">
                                            <span><?php echo $v->memberName;?></span>
                                        </div>
                                        <div class="trip_type">
                                            入住&nbsp;：&nbsp;<span><?php echo substr($v->travelStartDate,0,10);?></span><br>
                                            <?php if(isset($v->travelEndDate) ): ?>
                                                离店&nbsp;：&nbsp;<span><?php echo substr($v->travelEndDate,0,10);?></span>
                                            <?php endif;?>
                                        </div>
                                        <div class="order_price">
                                            <span><?php echo $v->currency;echo $v->bookingAmount ?></span>
                                        </div>
                                        <div class="order_status">
                        <span>
                            <?php echo get_order_status($v->bookingStatus);?>
                        </span>
                                        </div>
                                        <div class="order_actions">
                                            <?php if($v->productType=="Flight"):?>
                                                <span><a href="<?php echo '/payment/order_detail?type=HotelTicket&bookingRefNo='.$v->bookingRefNo?>">查看</a></span>
                                            <?php elseif($v->productType=="Package_T"):?>
                                                <span>查看</span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </li>
                            <?php elseif($v->productType=="Package_FHT"):?>
                                <li>
                                    <p class="list_top clearfix">
                                        <span class="order_name">机+酒+景</span>
                                        <span class="order_no">订单号&nbsp;:&nbsp;<i><?php echo $v->bookingRefNo;?></i></span>
                                        <span class="order_date">预定日期&nbsp;:&nbsp;<?php echo substr($v->bookingDate,0,10);?></span>
                                    </p>
                                    <!--细节-->
                                    <div class="order_out clearfix">
                                        <div class="order_name">
                                            <span><a href="<?php echo '/payment/order_detail?type=FHT&bookingRefNo='.$v->bookingRefNo?>"><?php echo $v->productName;?></a></span>
                                        </div>
                                        <div class="order_owner">
                                            <span><?php echo $v->memberName;?></span>
                                        </div>
                                        <div class="trip_type">
                                            入住&nbsp;：&nbsp;<span><?php echo substr($v->travelStartDate,0,10);?></span><br>
                                            <?php if(isset($v->travelEndDate) ): ?>
                                                离店&nbsp;：&nbsp;<span><?php echo substr($v->travelEndDate,0,10);?></span>
                                            <?php endif;?>
                                        </div>
                                        <div class="order_price">
                                            <span><?php echo $v->currency;echo $v->bookingAmount ?></span>
                                        </div>
                                        <div class="order_status">
                        <span>
                            <?php echo get_order_status($v->bookingStatus);?>
                        </span>
                                        </div>
                                        <div class="order_actions">
                                            <?php if($v->productType=="Flight"):?>
                                                <span><a href="<?php echo '/payment/order_detail?type=FHT&bookingRefNo='.$v->bookingRefNo?>">查看</a></span>
                                            <?php elseif($v->productType=="Package_FHT"):?>
                                                <span>查看</span>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </li>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach; ?>
                </ul>
            <?php else:?>
                <!--true ,data[0]-->
                <div class="not_find_wrap" not_find_wrap>
                    <p class="list_top">
                        <span class="traveller_name">订单信息</span>
                        <span class="traveller_age">订单号</span>
                        <span class="id_type">订单时间</span>
                        <span class="id_no">订单金额</span>
                        <span class="tel_value">订单状态</span>
                    </p>
                    <div class="content_wrap">
                        <div class="img_out">
                            <i></i>
                            <span class="tip_word"><?php echo isset($errorDIY['errorMsgOrder'])?$errorDIY['errorMsgOrder']:"没有找到符合条件的订单!!!";?></span>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        <?php else:?>
            <!--failed ,data[0]-->
            <div class="not_find_wrap" not_find_wrap>
                <p class="list_top">
                    <span class="traveller_name">订单信息</span>
                    <span class="traveller_age">订单号</span>
                    <span class="id_type">订单时间</span>
                    <span class="id_no">订单金额</span>
                    <span class="tel_value">订单状态</span>
                </p>
                <div class="content_wrap">
                    <div class="img_out">
                        <i></i>
                        <span class="tip_word"><?php echo $orderData->message;?></span>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>