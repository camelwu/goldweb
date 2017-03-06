<div LinkInfo>
    <?php if(isset($linkdata)):?>
        <?php if($_GET["type"]=="Hotel"):?>
            <h3  class = "order_title">联系人</h3>
            <ul class="l_list">
                <li><span class = "l_title">姓名</span><span><?php echo isset($linkdata[0]->guestFirstName)?$linkdata[0]->guestFirstName: ""?>/<?php echo isset($linkdata[0]->guestLastName)?$linkdata[0]->guestLastName:"" ?></span></li>
                <li><span class = "l_title">手机号码</span><span><?php echo $linkdata[0]->guestContactNo; ?></span></li>
                <li><span class = "l_title">Email </span><span><?php echo $linkdata[0]->guestEmail; ?></span></li>
            </ul>
        <?php else:?>
            <h3  class = "order_title">联系人</h3>
            <ul class="l_list">
                <li><span class = "l_title">姓名</span><span><?php echo $linkdata->firstName;?>/<?php echo $linkdata->lastName;?></span></li>
                <li><span class = "l_title">手机号码</span><span><?php echo $linkdata->contactNo;; ?></span></li>
                <li><span class = "l_title">Email </span><span><?php echo $linkdata->email;; ?></span></li>
            </ul>
        <?php endif?>
    <?php endif?>
</div>