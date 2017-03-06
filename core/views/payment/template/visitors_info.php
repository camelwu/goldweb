<div PISInfo>
    <?php if($_GET["type"]=="Hotel"):?>
        <h3  class = "order_title">入住人信息</h3>
    <?php foreach($visitordata as $items):?>
        <?php $i=1;foreach ($items->guestNameList as $item):?>

            <div class="p_order">
                <i class = "icon_num"><?php echo $i; ?></i>
                <ul class="p_list">
                    <li><span class = "p_title">姓名 </span><span><?php echo $item->guestFirstName; ?>/<?php echo $item->guestLastName; ?></span></li>
<!--                    <li><span class = "p_title">证件信息</span><span>护照</span></li>-->
<!--                    --><?php //if($item->enmGuestTitle ===0): ?>
<!--                        <li><span class = "p_title">性别</span><span>男</span></li>-->
<!--                    --><?php //else: ?>
<!--                        <li><span class = "p_title">性别</span><span>女</span></li>-->
<!--                    --><?php //endif; ?>
<!--                    <li><span class = "p_title">国籍 </span><span>中国</span></li>-->
                    <!--                <li><span class = "p_title">出生日期</span><span>1990-08-04</span></li>-->
                </ul>
            </div>
            <?php $i=$i+1; endforeach;?>
    <?endforeach;?>
    <?else:?>
        <h3  class = "order_title">出游人信息</h3>
        <?php $i=1;foreach ($visitordata as $item):?>
            <div class="p_order">
            <i class = "icon_num"><?php echo $i; ?></i>
            <ul class="p_list">
                <li><span class = "p_title">姓名 </span><span><?php echo $item->lastName; ?>/<?php echo $item->firstName; ?></span></li>
<!--                --><?php //if($item->travelerType === 1):  ?>
<!--                    <li><span class = "p_title">证件信息</span><span>护照</span></li>-->
<!--                --><?php //elseif ($item->travelerType === 2):  ?>
<!--                    <li><span class = "p_title">证件信息</span><span>身份证</span></li>-->
<!--                --><?php //else:  ?>
<!--                    <li><span class = "p_title">证件信息</span><span>港澳通行证</span></li>-->
<!--                --><?php //endif;  ?>
<!--                --><?php //if($item->salutation === 1): ?>
<!--                    <li><span class = "p_title">性别</span><span>男</span></li>-->
<!--                --><?php //else: ?>
<!--                    <li><span class = "p_title">性别</span><span>女</span></li>-->
<!--                --><?php //endif; ?>
                    <li><span class = "p_title">国籍 </span><span><?php echo $item->nationalityCode; ?>   <?php echo $item->nationality; ?></span></li>
<!--                <li><span class = "p_title">出生日期</span><span>1990-08-04</span></li>-->
            </ul>
        </div>
        <?php $i=$i+1; endforeach;?>
    <?endif;?>
</div>