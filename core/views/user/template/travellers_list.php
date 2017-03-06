<!--常旅列表-->

<?php if($travellerData->success):?>
    <?php if(count($travellerData->data)>0):?>
        <!--true ,data[N]-->
        <ul class="order_ul">
            <!--顶部-->
            <p class="list_top">
                <span class="traveller_name">姓名</span>
                <span class="traveller_age">年龄</span>
                <span class="id_type">证件类型</span>
                <span class="id_no">证件号</span>
                <span class="tel_value">联系电话</span>
                <?php if($errorDIY['is_show_op']): ?>
                    <span class="operation">操作</span>
                <?php endif;?>
            </p>
            <?php foreach($travellerData->data as $k => $v): ?>
                <?php $len =array_key_exists('maxSize',$errorDIY)?$errorDIY['maxSize']:count($travellerData->data);?>
                <?php if($k < $len && is_object($v)): ?>
                    <li class="traveller_li" data-id="<?php echo $v->traveller->travellerId;?>">
                        <div class="traveller_out clearfix">
                            <div class="traveller_name">
                                <span><?php echo $v->traveller->idName;?></span>
                            </div>
                            <div class="traveller_age_value">
                                <span><?php echo get_user_age($v->traveller->dateOfBirth);?></span>
                            </div>
                            <div class="ip_wrap">
                                <ul>
                                    <?php foreach($v->listTravellerIdInfo as $k1 => $v1): ?>
                                        <li class="sub_li">
                                            <div class="ip_type_value <?php echo $k1==count($v->listTravellerIdInfo)-1&&count($v->listTravellerIdInfo)>1?'no_mb':'';?> ">
                                                <span><?php echo get_id_type($v1->idType);?></span>
                                            </div>
                                            <div class="ip_no_value <?php echo $k1==count($v->listTravellerIdInfo)-1&&count($v->listTravellerIdInfo)>1?'no_mb':'';?> ">
                                                <span><?php echo number_handler($v1->idNumber,9);?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="contact_value">
                                <span><?php echo number_handler($v->traveller->mobilePhone,9);?></span>
                            </div>
                            <?php if($errorDIY['is_show_op']): ?>
                                <div class="operation_item">
                                    <a href="javascript:void(0)" class="edit_pass">编辑</a>
                                    <a href="javascript:void(0)" class="delete_pass">删除</a>
                                </div>
                            <?php endif;?>
                        </div>
                    </li>
                <?php endif;?>
            <?php endforeach; ?>
        </ul>
    <?php else:?>
        <!--true ,data[0]-->
        <div class="not_find_wrap" not_find_wrap>
            <p class="list_top">
                <span class="traveller_name">姓名</span>
                <span class="traveller_age">年龄</span>
                <span class="id_type">证件类型</span>
                <span class="id_no">证件号</span>
                <span class="tel_value">联系电话</span>
                <?php if($errorDIY['is_show_op']): ?>
                    <span class="operation">操作</span>
                <?php endif;?>
            </p>
            <div class="content_wrap">
                <div class="img_out">
                    <i></i>
                    <span class="tip_word"><?php echo isset($errorDIY['errorMsgTraveller'])?$errorDIY['errorMsgTraveller']:"没有找到符合条件的订单!";?></span>
                </div>
            </div>
        </div>
    <?php endif;?>
<?php else:?>
    <!--failed ,data[0]-->
    <div class="not_find_wrap" not_find_wrap>
        <p class="list_top">
            <span class="traveller_name">姓名</span>
            <span class="traveller_age">年龄</span>
            <span class="id_type">证件类型</span>
            <span class="id_no">证件号</span>
            <span class="tel_value">联系电话</span>
            <?php if($errorDIY['is_show_op']): ?>
                <span class="operation">操作</span>
            <?php endif;?>
        </p>
        <div class="content_wrap">
            <div class="img_out">
                <i></i>
                <span class="tip_word"><?php echo $travellerData->message;?></span>
            </div>
        </div>
    </div>
<?php endif;?>









