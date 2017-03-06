
<div class="add_person" max-person-num="<?php echo $adultCount ?>" input-prompt>
    <div class="sub_title">添加出游人</div>
    <ul class="person_list">
        <?php  $count=1; for ($i=0; $i<=count($roomDetails)-1; $i++) { ?>
         <?php for($j=0;$j<=$roomDetails[$i]["Adult"]-1;$j++){?>
             <li class="clearfix" data-roomid="<?php echo $i+1?>" >
                 <input type="hidden" value="<?php echo $i+1?>" name="room_id$<?php echo $count ?>">
                 <input type="hidden" value="adult" name="passage_type$<?php echo $count ?>">
                 <?php if($j==0):?>
                    <p>房间<?php echo $i+1?></p>
                  <?php endif ?>
                <i class="fl"><?php echo $count ?></i>
                <div class="label fl last_name">姓</div>
                <div class="fl">
                    <input type="text" class="public last_name_input" name="last_name$<?php echo $count ?>" placeholder="如Li">
                </div>
                <div class="label fl first_name">名</div>
                <div class="fl">
                    <input type="text" class="public first_name_input" name="first_name$<?php echo $count ?>" placeholder="如Shimin">
                </div>
                <div class="label fl nationality">国籍</div>
                <div class="fl" select-div>
                    <div class="select_unit nationality_select">
                        <p class="select_btn">
                            <span>中国</span>
                            <i></i>
                            <input type="hidden" class="nationality_input" name="nationality$<?php echo $count ?>" value="CN">
                        </p>
                        <ul class="select_ul">
                            <?php foreach ($countryData as $cv): ?>
                                <li data-value='<?php echo $cv['countryCode'] ?>'><?php echo $cv['chineseName'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="fl clear_input">清除</div>
            </li>
         <?php $count= $count+1; } ?>
         <?php if(!empty($roomDetails[$i]["ChildWithBed"])):?>
                <li class="clearfix" data-roomid="<?php echo $i+1?>">
                    <input type="hidden" value="<?php echo $i+1?>" name="room_id$<?php echo $count ?>">
                    <input type="hidden" value="adult" name="passage_type$<?php echo $count ?>">
                    <input type="hidden" value="<?php echo $roomDetails[$i]["ChildWithBed"][0]?>" name="child_age$<?php echo $count ?>">
                    <i class="fl"><?php echo $count ?></i>
                    <div class="label fl last_name">姓</div>
                    <div class="fl">
                        <input type="text" class="public last_name_input" name="last_name$<?php echo $count ?>" placeholder="如Li">
                    </div>
                    <div class="label fl first_name">名</div>
                    <div class="fl">
                        <input type="text" class="public first_name_input" name="first_name$<?php echo $count ?>" placeholder="如Shimin">
                    </div>
                    <div class="label fl nationality">国籍</div>
                    <div class="fl" select-div>
                        <div class="select_unit nationality_select">
                            <p class="select_btn">
                                <span>中国</span>
                                <i></i>
                                <input type="hidden" class="nationality_input" name="nationality$<?php echo $count ?>" value="CN">
                            </p>
                            <ul class="select_ul">
                                <?php foreach ($countryData as $cv): ?>
                                    <li data-value='<?php echo $cv['countryCode'] ?>'><?php echo $cv['chineseName'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="fl clear_input">清除</div>
        </li>
          <?php $count= $count+1; endif ?>
         <?php if(!empty($roomDetails[$i]["ChildWithoutBed"])):?>
                <li class="clearfix" data-roomid="<?php echo $i+1?>">
                    <input type="hidden" value="<?php echo $i+1?>" name="room_id$<?php echo $count ?>">
                    <input type="hidden" value="child" name="passage_type$<?php echo $count ?>">
                    <input type="hidden" value="<?php echo $roomDetails[$i]["ChildWithoutBed"][0]?>" name="child_age$<?php echo $count ?>">
                    <i class="fl"><?php echo $count ?></i>
                    <div class="label fl last_name">姓</div>
                    <div class="fl">
                        <input type="text" class="public last_name_input" name="last_name$<?php echo $count ?>" placeholder="如Li">
                    </div>
                    <div class="label fl first_name">名</div>
                    <div class="fl">
                        <input type="text" class="public first_name_input" name="first_name$<?php echo $count ?>" placeholder="如Shimin">
                    </div>
                    <div class="label fl nationality">国籍</div>
                    <div class="fl" select-div>
                        <div class="select_unit nationality_select">
                            <p class="select_btn">
                                <span>中国</span>
                                <i></i>
                                <input type="hidden" class="nationality_input" name="nationality$<?php echo $count ?>" value="CN">
                            </p>
                            <ul class="select_ul">
                                <?php foreach ($countryData as $cv): ?>
                                    <li data-value='<?php echo $cv['countryCode'] ?>'><?php echo $cv['chineseName'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="fl clear_input">清除</div>
                </li>
            <?php $count= $count+1; endif ?>
        <?php    } ?>

    </ul>
</div>

