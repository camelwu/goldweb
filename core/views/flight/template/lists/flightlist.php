<?php if($lists->success):?>
      <?php if(count($lists->data->flightInfos)==0):?>
         <P class="no_get_data">没有搜到符合条件的航班信息，<br/>请更换条件后再试试！</P>
      <?php else:?>
         <ul>
            <?php foreach ($lists->data->flightInfos as $k1 => $v1):?>
                <?php if(property_exists($lists->data->flightInfos[0],'segmentsReturn')):?>
                    <li data-findex="<?php echo $k1;?>" class="li_out">
                        <!--第一行-->
                        <!--去程-->
                        <div class="flight_sum clearfloat">
                            <div class="flight_sum_left">
                                <div class="icon_airway">
                                    <div class="input_choose">
                                        <i class="icon">
                                            <a href="javascript:void(0);" class="checkbox_icon <?php echo (isset($_SESSION["currentFlightNo"])&&$_SESSION["currentFlightNo"]==$lists->data->flightInfos[0]->segmentsLeave[0]->flightNo)?'checkbox_cur':''?>">
                                                <input type="checkbox" name="flight_input" class="flight_input depart" data-flightno="<?php echo $v1->segmentsLeave[0]->flightNo;?>">
                                            </a>
                                        </i>
                                    </div>
                                    <div class="logo_out">
                                        <div class="img_wrap">
                                            <img class="logo" src="<?php echo $v1->segmentsLeave[0]->airwayLogo;?>">
                                        </div>
                                    </div>
                                    <div class="left_info_wrap">
                                        <p class="icon_airway_airway"><?php echo $v1->segmentsLeave[0]->airCorpName;?></p>
                                        <p class="icon_airway_no"><?php echo $v1->segmentsLeave[0]->airCorpCode;echo $v1->segmentsLeave[0]->flightNo;?><b><?php echo $v1->segmentsLeave[0]->planeType;?></b></p>
                                    </div>
                                </div>
                                <div class="flight_start_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsLeave[0]->departDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsLeave[0]->airportNameFrom.$v1->segmentsLeave[0]->termDepart;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flight_sum_line flight_sum_line_d">
                                <i></i>
                            </div>
                            <div class="flight_sum_right">
                                <div class="flight_end_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsLeave[count($v1->segmentsLeave)-1]->arriveDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsLeave[count($v1->segmentsLeave)-1]->airportNameTo;echo $v1->segmentsLeave[count($v1->segmentsLeave)-1]->termArrive;?></p>
                                    </div>
                                </div>
                                <div class="flight_detail_tip">
                                    航班详情<i class="arrow_up"></i>
                                </div>
                                <div class="time_cost">
                                    <i class="clock_icon"></i>
                                    <span class="total_hours"><?php echo $v1->segmentsLeaveTotalTravelTimeString;?></span>
                                    <span class="f_type"><?php echo $v1->directFlight==0?"直飞":"中转";?></span>
                                </div>
                            </div>
                        </div>
                        <!--去程航段-->
                        <div class="flight_s_info clearfloat">
                            <p class="list_border_top"></p>
                            <?php foreach ( $v1->segmentsLeave as $k2 => $v2):?>
                                <div class="inner_div">
                                    <div class="logo_small_wrap">
                                        <img class="logo_small" src="<?php echo $v2->airwayLogo;?>" />
                                    </div>
                                    <div class="p_class_wrap">
                                        <p class="airway_time">
                                            <span class="airway_no"><?php echo $v2->airCorpCode;echo $v2->flightNo;?>&nbsp;&nbsp;<b><?php echo $v2->planeType;?></b></span>
                                            <span class="fly_time">飞行时长 <?php echo '88h08m';?></span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date"><?php echo string_cut($v2->departDate,5,2).'月'.string_cut($v2->departDate,8,2).'日'.string_cut($v2->departDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeFrom.$v2->airportNameFrom.$v2->termDepart;?></span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date"><?php echo string_cut($v2->arriveDate,5,2).'月'.string_cut($v2->arriveDate,8,2).'日'.string_cut($v2->arriveDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeTo.$v2->airportNameTo.$v2->termArrive;?></span>
                                        </p>
                                    </div>
                                </div>
                                <?php if(count($v1->transferListLeave)>0&&$k2<count($v1->transferListLeave)): ?>
                                    <div class="transfer_city_word">
                                        中转 : <span class="transfer_city_item"><?php echo$v1->transferListLeave[$k2]->transferLocalName;?></span>
                                        <span class="stop_time">停留时长 <span class="stop_time_value"><?php echo$v1->transferListLeave[$k2]->transferTime;?></span></span>
                                    </div>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>
                        <!--返程-->
                        <div class="flight_sum clearfloat">
                            <div class="flight_sum_left">
                                <div class="icon_airway">
                                    <div class="input_choose">
                                        <i class="icon">
                                            <a href="javascript:void(0);" class="checkbox_icon <?php echo (isset($_SESSION["currentFlightNo"])&&$_SESSION["currentFlightNo"]==$lists->data->flightInfos[0]->segmentsReturn[0]->flightNo)?'checkbox_cur':''?>">
                                                <input type="checkbox"  name="flight_input" class="flight_input return" data-flightno="<?php echo $v1->segmentsReturn[0]->flightNo;?>">
                                            </a>
                                        </i>
                                    </div>
                                    <div class="logo_out">
                                        <div class="img_wrap">
                                            <img class="logo" src="<?php echo $v1->segmentsReturn[0]->airwayLogo;?>">
                                        </div>
                                    </div>
                                    <div class="left_info_wrap">
                                        <p class="icon_airway_airway"><?php echo $v1->segmentsReturn[0]->airCorpName;?></p>
                                        <p class="icon_airway_no"><?php echo $v1->segmentsReturn[0]->airCorpCode;echo $v1->segmentsReturn[0]->flightNo;?>&nbsp;&nbsp;<b><?php echo $v1->segmentsReturn[0]->planeType;?></b></p>
                                    </div>
                                </div>
                                <div class="flight_start_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsReturn[0]->departDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsReturn[0]->airportNameFrom.$v1->segmentsReturn[0]->termDepart;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flight_sum_line flight_sum_line_d">
                                <i></i>
                            </div>
                            <div class="flight_sum_right">
                                <div class="flight_end_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsReturn[count($v1->segmentsReturn)-1]->arriveDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsReturn[count($v1->segmentsReturn)-1]->airportNameTo;echo $v1->segmentsReturn[count($v1->segmentsReturn)-1]->termArrive;?></p>
                                    </div>
                                </div>
                                <div class="flight_detail_tip">
                                    航班详情<i class="arrow_up"></i>
                                </div>
                                <div class="time_cost">
                                    <i class="clock_icon"></i>
                                    <span class="total_hours"><?php echo $v1->segmentsReturnTotalTravelTimeString;?></span>
                                    <span class="f_type"><?php echo $v1->directFlight==0?"直飞":"中转";?></span>
                                </div>
                            </div>
                        </div>
                        <!--返程航段-->
                        <div class="flight_s_info clearfloat">
                            <p class="list_border_top"></p>
                            <?php foreach ( $v1->segmentsReturn as $k2 => $v2):?>
                                <div class="inner_div">
                                    <div class="logo_small_wrap">
                                        <img class="logo_small" src="<?php echo $v2->airwayLogo;?>" />
                                    </div>
                                    <div class="p_class_wrap">
                                        <p class="airway_time">
                                            <span class="airway_no"><?php echo $v2->airCorpCode;echo $v2->flightNo;?>&nbsp;&nbsp;<b><?php echo $v2->planeType;?></b></span>
                                            <span class="fly_time">飞行时长 <?php echo '88h08m';?></span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date"><?php echo string_cut($v2->departDate,5,2).'月'.string_cut($v2->departDate,8,2).'日'.string_cut($v2->departDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeFrom.$v2->airportNameFrom.$v2->termDepart;?></span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date"><?php echo string_cut($v2->arriveDate,5,2).'月'.string_cut($v2->arriveDate,8,2).'日'.string_cut($v2->arriveDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeTo.$v2->airportNameTo.$v2->termArrive;?></span>
                                        </p>
                                    </div>
                                </div>
                                <?php if(count($v1->transferListReturn)>0&&$k2<count($v1->transferListReturn)): ?>
                                    <div class="transfer_city_word">
                                        中转 : <span class="transfer_city_item"><?php echo$v1->transferListReturn[$k2]->transferLocalName;?></span>
                                        <span class="stop_time">停留时长 <span class="stop_time_value"><?php echo$v1->transferListReturn[$k2]->transferTime;?></span></span>
                                    </div>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>
                        <!--第三行-->
                        <div class="flight_cabinClass clearfloat">
                            <ul>
                                <?php foreach ( $v1->flightGroupOtherInfoList as $k3 => $v3):?>
                                    <li class="clearfloat li_cabin_out" data-cindex="<?php echo $k3;?>">
                                        <div class="cabin_item cabin_item_d">
                                            <span class="cabin_word"><?php echo $v3->cabinClassName;?></span>
                                            <div class="explain_out">
                                                <span class="explain_word">退改签说明</span>
                                                <div class="tip_box">
                                                    <span class="tip_icon"></span>
                                                    <p class="tip_word">退改签具体规则以航司为准。</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="r_choose_button">
                                            <button type="button" class="choose">预定</button>
                                            <div class="price_discount">
                                                <?php if($hasTax=="1"): ?>
                                                    <span class="price_type_word">往返含税价 : </span><span class="money_tag">￥</span><span class="money_value"><?php echo $v3->totalFareAmountExc;?></span>
                                                <?php else: ?>
                                                    <span class="price_type_word">往返不含税价 : </span><span class="money_tag">￥</span><span class="money_value"><?php echo $v3->totalFareAmountADT;?></span>
                                                <?php endif;?>
                                                <?php if(0):?>
                                                    <span class="discount_value discount_value_d">4.0折</span>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </li>
                <?php else: ?>
                    <li data-findex="<?php echo $k1;?>" class="li_out">
                        <!--第一行-->
                        <div class="flight_sum clearfloat">
                            <div class="flight_sum_left">
                                <div class="icon_airway">
                                    <div class="logo_out">
                                        <div class="img_wrap">
                                            <img class="logo" src="<?php echo $v1->segmentsLeave[0]->airwayLogo;?>"/>
                                        </div>
                                    </div>
                                    <div class="left_info_wrap">
                                        <p class="icon_airway_airway"><?php echo $v1->segmentsLeave[0]->airCorpName;?></p>
                                        <p class="icon_airway_no"><?php echo $v1->segmentsLeave[0]->airCorpCode;echo $v1->segmentsLeave[0]->flightNo;?>&nbsp;&nbsp;<b><?php echo $v1->segmentsLeave[0]->planeType;?></b></p>
                                    </div>
                                </div>
                                <div class="flight_start_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsLeave[0]->departDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsLeave[0]->airportNameFrom;echo $v1->segmentsLeave[0]->termDepart;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flight_sum_line">
                                <i></i>
                            </div>
                            <div class="flight_sum_right">
                                <div class="flight_end_clock_port">
                                    <div class="clock_port_outer">
                                        <p class="flight_clock"><?php echo substr($v1->segmentsLeave[count($v1->segmentsLeave)-1]->arriveDate,11,5);?></p>
                                        <p class="flight_port"><?php echo $v1->segmentsLeave[count($v1->segmentsLeave)-1]->airportNameTo;echo $v1->segmentsLeave[count($v1->segmentsLeave)-1]->termArrive;?></p>
                                    </div>
                                </div>
                                <div class="flight_detail_tip">
                                    航班详情<i class="arrow_up"></i>
                                </div>
                                <div class="time_cost">
                                    <i class="clock_icon"></i>
                                    <span class="total_hours"><?php echo $v1->segmentsLeaveTotalTravelTimeString;?></span>
                                    <span class="f_type"><?php echo $v1->directFlight==0?"直飞":"中转";?></span>
                                </div>
                            </div>
                        </div>
                        <!--第二行-->
                        <div class="flight_s_info clearfloat">
                            <p class="list_border_top"></p>
                            <?php foreach ( $v1->segmentsLeave as $k2 => $v2):?>
                                <div class="inner_div">
                                    <div class="logo_small_wrap">
                                        <img class="logo_small" src="<?php echo $v2->airwayLogo;?>" />
                                    </div>
                                    <div class="p_class_wrap">
                                        <p class="airway_time">
                                            <span class="airway_no"><?php echo $v2->airCorpCode;echo $v2->flightNo;?>&nbsp;&nbsp;<b><?php echo $v2->planeType;?></b></span>
                                            <span class="fly_time" data-departDate="<?php echo $v2->departDate?>" data-arriveDate="<?php echo $v2->arriveDate ?>">飞行时长
                                                <?php echo diff_date($v2->departDate,$v2->arriveDate,$format="hm"); ?>
                                            </span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date" ><?php echo string_cut($v2->departDate,5,2).'月'.string_cut($v2->departDate,8,2).'日'.string_cut($v2->departDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeFrom.$v2->airportNameFrom.$v2->termDepart;?></span>
                                        </p>
                                        <p class="airway_date">
                                            <span class="items_date" ><?php echo string_cut($v2->arriveDate,5,2).'月'.string_cut($v2->arriveDate,8,2).'日'.string_cut($v2->arriveDate,11,5);?></span>
                                            <span class="items_port"><?php echo $v2->airportCodeTo.$v2->airportNameTo.$v2->termArrive;?></span>
                                        </p>
                                    </div>
                                </div>
                                <?php if(count($v1->transferListLeave)>0&&$k2<count($v1->transferListLeave)): ?>
                                    <div class="transfer_city_word">
                                        中转 : <span class="transfer_city_item"><?php echo$v1->transferListLeave[$k2]->transferLocalName;?></span>
                                        <span class="stop_time">停留时长 <span class="stop_time_value"><?php echo$v1->transferListLeave[$k2]->transferTime;?></span></span>
                                    </div>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>
                        <!--第三行-->
                        <div class="flight_cabinClass clearfloat">
                            <ul class="clearfix">
                                <?php foreach ( $v1->flightGroupOtherInfoList as $k3 => $v3):?>
                                    <li class="clearfloat li_cabin_out" data-cindex="<?php echo $k3;?>">
                                        <div class="cabin_item">
                                            <span class="cabin_word"><?php echo $v3->cabinClassName;?></span>
                                            <div class="explain_out buy_explain_out">
                                                <span class="explain_word">退改签机购票说明</span>
                                                <div class="tip_box">
                                                    <span class="tip_icon"></span>
                                                    <p class="tip_word">退改签具体规则以航司为准。</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="r_choose_button">
                                            <button type="button" class="choose">预定</button>
                                            <div class="price_discount price_discount_s">
                                                <?php if($hasTax=="1"): ?>
                                                    <span class="price_type_word">单程含税价 : </span><span class="money_tag">￥</span><span class="money_value"><?php echo $v3->totalFareAmountExc;?></span>
                                                <?php else: ?>
                                                    <span class="price_type_word">单程不含税价 : </span><span class="money_tag">￥</span><span class="money_value"><?php echo $v3->totalFareAmountADT;?></span>
                                                <?php endif;?>
                                                <?php if(0):?>
                                                    <span class="discount_value discount_value_d">4.0折</span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
      <?php endif?>
<?php else:?>
     <P class="no_get_data"><?php echo $lists->message;?></P>
<?php endif?>

