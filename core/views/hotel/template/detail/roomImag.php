<?php if($hotelPData->success):?>
        <ul class="clearfix">
        <?php foreach ($hotelPData->data['0']->hotelRoomFeaturesList as $k1 => $v1):?>
            <li><img src="<?php echo $v1->imageFileName; ?>"> </li>
        <?php endforeach;?>
        </ul>
        <p class="room_word">
            <?php foreach ($hotelPData->data['0']->hotelRoomAmenitiesList as $k2 => $v2):?>
                <?php if(isset($v2->featureDesc)):?>
               <span><?php echo $v2->featureDesc; ?></span>
                    <?php endif;?>
            <?php endforeach;?>
        </p>
<?php else:?>
        <ul class="clearfix">
                <li>暂无图片</li>
        </ul>
<?php endif;?>

