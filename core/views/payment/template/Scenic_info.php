<div ScenicInfo>
    <div class = "order_title">
        <h3 class="s_title">景点信息</h3>
        <?php if(isset($toursdata->hotelDetails)):?>
        <span><?php echo formate_date($toursdata->hotelDetails->checkinDate,"m月d日");?></span>
        <span>至</span>
        <span><?php echo formate_date($toursdata->hotelDetails->checkoutDate,"m月d日");?></span>
        <span>（可游玩<?php echo diff_date($toursdata->hotelDetails->checkinDate,$toursdata->hotelDetails->checkoutDate,"D")+1;?>天），</span>
        <?php endif?>
        <?php $i=0; foreach($toursdata->tours as $items):?>
        <?php $i++; endforeach;?>
        <span><?php echo $i;?>个景点</span>
    </div>
    <?php $ite=1; foreach($toursdata->tours as $item):?>
    <ul class = "s_detail">
        <li class = "s_detail_name">
            <i><?php echo $ite;?>.&nbsp;</i><?php echo $item->tourName;?>
        </li>
<!--        <li class = "s_detail_add">-->
<!--            <span>--><?php //echo $toursdata->packageName;?><!--</span>-->
<!--        </li>-->
        <li class = "s_detail_time">
            <?php if($item->travelDateSpecified):?>
            <span>游玩时间 : </span><span><?php echo formate_date($item->travelDate,"Y年m月d日"); ?></span>
                <?php if(($item->tourSession)==0):?>
                <span>上午</span>
                    <?php elseif(($item->tourSession)==1):?>
                    <span>下午</span>
                    <?php elseif(($item->tourSession)==2):?>
                    <span>晚上</span>
                    <?php elseif(($item->tourSession)==3):?>
                    <span>全天</span>
                    <?php endif?>
            <?php endif;?>
            <span class = "s_people">游客 :
                <?php $i=0; foreach($lists->data->travelers as $items):?>
                    <?php if($items->travelerType==0):?>
                        <?php $i++;endif;?>
                <?php endforeach;?></span><span><?php echo $i;?>成人
                <?php $j=0;foreach($lists->data->travelers as $items):?>
                    <?php if($items->travelerType==1):?>
                        <?php $j++; endif;?>
                <?php endforeach;?></span>
            <?php if($j>0):?>
            <span><?php echo $j;?>儿童</span>
            <?php endif;?>
        </li>
    </ul>
    <?php $ite++; endforeach ;?>
</div>