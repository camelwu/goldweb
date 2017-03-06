<!--费用明细-->
<div class="border detailed" cost_detail >
    <div class = "cost_title"><h3>费用明细</h3></div>
    <div class="cost_num clearfix">
        <div class = "fl cost_numtitle">应付总金额</div>
        <div class = "fr">
            <span class = "cost_sum">￥<?php echo $order_free->totalFlightPrice; ?></span>
            <span class = "cost_p_sum">（成人 <?php echo $order_free->numofAdult; ?>人<?php if(($order_free->numofChild)> 0): ?>&nbsp;儿童<?php echo $order_free->numofChild; ?>人            <?PHP endif;?>）</span>
        </div>
    </div>
    <div class = "cost_detail">
        <ul>
            <li class = "cost_list cost_first"><span class = "fl">成人</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalFareAmountExc; ?>*<?php echo $order_free->numofAdult; ?>人</span></li>
            <li class = "cost_list"><span class = "fl">票价</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalFareAmountADT; ?>*<?php echo $order_free->numofAdult; ?>人</span></li>
            <li class = "cost_list"><span class = "fl">机票税</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalTaxAmountADT; ?>*
                    <?php echo $order_free->numofAdult; ?>人</span></li>
            <!--                            <li class = "cost_list"><span class = "fl">燃油费</span><span class ="fr">￥980*1人</span></li>-->
        </ul>
        <ul>
            <?php if(($order_free->numofChild)> 0): ?>
            <li class = "cost_list cost_first"><span class = "fl">儿童</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalFareAmountCHD + $order_free->flightInfo->totalTaxAmountCHD; ?>*<?php echo $order_free->numofChild; ?>人</span></li>
            <li class = "cost_list"><span class = "fl">票价</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalFareAmountCHD; ?>*<?php echo $order_free->numofChild; ?>人</span></li>
            <li class = "cost_list"><span class = "fl">机票税</span><span class ="fr">￥<?php echo $order_free->flightInfo->totalTaxAmountCHD; ?>*<?php echo $order_free->numofChild; ?>人</span></li>
            <!--                            <li class = "cost_list"><span class = "fl">燃油费</span><span class ="fr">￥980*1人</span></li>-->
            <?PHP endif;?>
        </ul>
    </div>
</div>
