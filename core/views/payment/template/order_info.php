<div OrderInfo>
    <h3 class = "order_title">订单信息</h3>
    <div>
        <?php if($_GET["type"]=="Hotel"):?>
            <?php foreach($orderinfo as $items):?>
            <div  class = "order_content">
                <div class = "fl content_list">
                    <span class = "content_list_child">订单状态<span><?php echo $items->orderStatusInfo; ?></span></span>
                    <span class = "content_list_child">剩余支付时间<span><?php echo remain_date( $items->createdTime); ?></span></span>
                    <span class = "content_list_child">订单号<span><?php echo $items->bookingReferenceNo;?></span></span>
                    <span class = "content_list_child">预定时间<span><?php echo substr($items->createdTime,0 ,10);?>&nbsp;<?php echo substr($items->createdTime,11 ,5) ?></span></span>
                </div>
                <?php if($items->orderStatus=='0'): ?>
                    <div btn-default class="fr submit">
                        <p class="btn order btn1_hover" onclick="window.location.href='/payment/index?bookingRefNo=<?php echo $_GET["bookingRefNo"]?>&type=<?php echo $_GET["type"]?>'">支付</p>
                        <p class="btn btn2_hover">取消订单</p>
                    </div>
                <?php endif; ?>
                <div class = "fl content_detail">
                    <span class = "content_list_child l_num">总金额：<span class = "num"><span class = "num_cur">￥</span><?php echo $items->totalRoomRate; ?></span></span>
                    <span class = "charges">费用明细 <i class = "icon_detail"></i></span>
<!--                    <span class = "charges1">打印订单</span>-->
                </div>
            </div>
        <?endforeach;?>
        <?php else:?>
        <div  class = "order_content">
            <div class = "fl content_list">
                <span class = "content_list_child">订单状态<?php if((array_key_exists("isContinuePay",$orderinfo))):?><span><?php echo get_order_status($orderinfo->isContinuePay);?></span><?php else:?><span><?php echo get_order_Tstatus($orderinfo->bookingStatus);?></span>
                    <?php endif;?></span>
                <span class = "content_list_child">剩余支付时间<span><?php echo array_key_exists("createTime",$orderinfo) ? remain_date($orderinfo->createTime):remain_date($orderinfo->bookingDate); ?></span></span>
                <span class = "content_list_child">订单号<span><?php echo $orderinfo->bookingRefNo ?></span></span>
                <span class = "content_list_child">预定时间<span><?php echo array_key_exists("createTime",$orderinfo)?substr($orderinfo->createTime,0 ,10):substr($orderinfo->bookingDate,0 ,10);?>&nbsp;<?php echo array_key_exists("createTime",$orderinfo)?substr($orderinfo->createTime,11 ,5):substr($orderinfo->bookingDate,11 ,5) ?></span></span>
            </div>
            <?php if((array_key_exists("isContinuePay",$orderinfo)? $orderinfo->isContinuePay : $orderinfo->bookingStatus )=="3"): ?>
                <div btn-default class="fr submit">
                    <p class="btn order btn1_hover" onclick="window.location.href='/payment/index?bookingRefNo=<?php echo $_GET["bookingRefNo"]?>&type=<?php echo $_GET["type"]?>'">支付</p>
                    <p class="btn btn2_hover">取消订单</p>
                </div>
            <?php endif; ?>
            <div class = "fl content_detail">
                <span class = "content_list_child l_num">总金额：<span class = "num"><span class = "num_cur">￥</span><?php echo array_key_exists("totalFlightPrice",$orderinfo)?$orderinfo->totalFlightPrice:$orderinfo->totalAmount; ?></span></span>
                <span class = "charges">费用明细 <i class = "icon_detail"></i></span>
                <?php if(isset($orderinfo->voucher)):?>
                        <?php if(sizeof($orderinfo->voucher)>1):?>
                            <span class = "charges1"><a href="javascritp:;">打印订单</a></span>
                        <?php else:?>
                            <span class = "charges1"><a href="<?php echo $orderinfo->voucher[0]->link; ?>">打印订单</a></span>
                        <?php endif;?>
                <?php endif;?>
            </div>
        </div>
            <div style="display: none" id = "voucher_link">
                <?foreach($orderinfo->voucher as $items):?>
                    <span><a href="<?php echo $items->link; ?>">打印<?php echo $items->descriptionCN;?></a></span>
                <?php endforeach;?>
            </div>
        <?endif;?>
        <div class = "content_cost clearfix">
            <?php if($_GET["type"]=="Flight"): ?>
            <ul class = "fl c_cost_type">
                <li class = "c_cost_typelist">乘客信息</li>
                <li>成人</li>
                    <?php if(($lists->data->numofChild)> 0): ?>
                <li>儿童</li>
                    <?PHP endif;?>
            </ul>
            <ul class = "fl c_cost_type">
                <li class = "c_cost_typelist">乘客数量</li>
                <li><?php echo $lists->data->numofAdult; ?></li>
                    <?php if(($lists->data->numofChild)> 0): ?>
                <li><?php echo $lists->data->numofChild; ?></li>
                    <?PHP endif;?>
            </ul>
            <ul class = "fl c_cost_type">
                <li class = "c_cost_typelist">票价</li>
                <li>￥<?php echo $lists->data->flightInfo->totalFareAmountADT; ?>/人</li>
                    <?php if(($lists->data->numofChild)> 0): ?>
                <li>￥<?php echo $lists->data->flightInfo->totalFareAmountCHD; ?>/人</li>
                    <?PHP endif;?>
            </ul>
            <ul class = "fl c_cost_type">
                <li class = "c_cost_typelist">机票税
                <li>￥<?php echo $lists->data->flightInfo->totalTaxAmountADT; ?>/人</li>
                    <?php if(($lists->data->numofChild)> 0): ?>
                <li>￥<?php echo $lists->data->flightInfo->totalTaxAmountCHD; ?>/人</li>
                    <?PHP endif;?>
            </ul>
            <!--                    <ul class = "fl c_cost_type">-->
            <!--                        <li class = "c_cost_typelist">燃油费<>-->
            <!--                        <li>￥980/人<>-->
            <!--                        <li>￥980/人<>-->
            <!--                    </ul>-->
            <?php elseif($_GET["type"]=="Ticket"):?>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">乘客信息</li>
                        <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                    <li>成人</li>
                        <?php elseif(($items->category)=="CHILD"):?>
                    <li>儿童</li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">乘客数量</li>
                    <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                    <li><?php echo $items->quantity; ?></li>
                        <?php elseif(($items->category)=="CHILD"):?>
                    <li><?php echo $items->quantity;; ?></li>
                        <?PHP endif;?>
                <?php endforeach;?>
                </ul>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">票价</li>
                        <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                    <li>￥<?php echo $items->amountInCNY; ?>/人</li>
                        <?php elseif(($items->category)=="CHILD"):?>
                    <li>￥<?php echo $items->amountInCNY; ?>/人</li>
                        <?PHP endif;?>
                    <?php endforeach;?>
                </ul>
            <?php elseif($_GET["type"]=="HotelTicket"):?>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">乘客信息</li>
                    <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                            <li>成人</li>
                        <?php elseif(($items->category)=="CHILD"):?>
                            <li>儿童</li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">乘客数量</li>
                    <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                            <li><?php echo $items->quantity; ?></li>
                        <?php elseif(($items->category)=="CHILD"):?>
                            <li><?php echo $items->quantity;; ?></li>
                        <?PHP endif;?>
                    <?php endforeach;?>
                </ul>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">票价</li>
                    <?php foreach($orderinfo->chargeDetails as $items):?>
                        <?php if(($items->category)=="ADULT"):?>
                            <li>￥<?php echo $items->amountInCNY; ?>/人</li>
                        <?php elseif(($items->category)=="CHILD"):?>
                            <li>￥<?php echo $items->amountInCNY; ?>/人</li>
                        <?PHP endif;?>
                    <?php endforeach;?>
                </ul>
            <?php elseif($_GET["type"]=="Hotel"):?>
                <?php foreach($orderinfo as $items):?>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">房费类型</li>
                        <?php if(($items->totalRoomRate)):?>
                    <li>房费</li>
                    <li>税和服务费</li>
                        <?php else:?>
                    <li>房费</li>
                        <?php endif;?>
                </ul>
                <ul class = "fl c_cost_type">
                    <li class = "c_cost_typelist">价格</li>
                        <?php if(($items->totalRoomRate)):?>
                    <li><?php echo (($items->totalRoomRate)-($items->totalSeriveCharge)); ?></li>
                    <li><?php echo ($items->totalSeriveCharge); ?></li>
                        <?php else:?>
                    <li><?php echo $items->totalRoomRate; ?></li>
                        <?PHP endif;?>
                </ul>
<!--                <ul class = "fl c_cost_type">-->
<!--                    <li class = "c_cost_typelist">票价-->
<!--                        --><?php //if(($items->totalRoomRate)):?>
<!--                    <li>￥--><?php //echo (($items->totalRoomRate)-($items->totalSeriveCharge)); ?><!--/人-->
<!--                    <li>￥--><?php //echo ($items->totalSeriveCharge); ?><!--/人-->
<!--                        --><?php //else:?>
<!--                    <li>￥--><?php //echo $items->totalAmount; ?><!--/人-->
<!--                        --><?PHP //endif;?>
<!--                </ul>-->
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>