<?php if($_GET["type"]=="Ticket"):?>
    <?php if(isset( $shuttledata->pickupID)&& (!($shuttledata->pickupID)=="")):?>
        <div ScenicService>
            <h3 class = "order_title">景点接送</h3>
            <ul class = "s_service">
                <li><span class = "s_service_title">接送地点</span><span class = "s_service_centent"><?php echo $shuttledata->pickupPoint; ?></span></li>
                <li><span class = "s_service_title">接送日期</span><span class = "s_service_centent">2016-07-07 12:30</span></li>
            </ul>
        </div>
    <?php endif;?>
<?php elseif($_GET["type"]=="HotelTicket"):?>
    <?php if(isset($shuttledata->flightDetails)):?>
        <div ScenicService>
            <h3 class = "order_title">接送信息</h3>
            <ul class = "s_service">
                <?php ?>
                <li>
            <span class="s_service_div">
                <span class = "s_service_title">类型</span><span>接机</span>
            </span>
            <span class="s_service_div">
                <span class = "s_service_title">航班号</span><span><?php echo $shuttledata->flightDetails->arrivalFlightNo;?></span>
            </span>
            <span class="s_service_div">
                <span class = "s_service_title">接送日期</span><span><?php echo substr_replace($shuttledata->flightDetails->arrivalDateTime," ",10,1);?></span>
            </span>
                </li>
                <li>
            <span class="s_service_div">
                <span class = "s_service_title">类型</span><span>送机</span>
            </span>
            <span class="s_service_div">
                 <span class = "s_service_title">航班号</span><span><?php echo $shuttledata->flightDetails->departFlightNo;?></span>
            </span>
            <span class="s_service_div">
                 <span class = "s_service_title">接送日期</span><span><?php echo substr_replace($shuttledata->flightDetails->departDateTime," ",10,1);?></span>
            </span>
                </li>
            </ul>
        </div>
    <?php endif;?>
<?php endif;?>
