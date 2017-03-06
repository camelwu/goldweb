<!--更改航班-->
<div class="border flight" flight_info>
    <div class = "info_title">
        <?php if(array_key_exists('routeType',$_GET)): ?>
            <a href="javascript:window.history.go(-1);">更改航班</a>
        <?php else: ?>
            <a href="javascript:window.history.go(-2);">更改航班</a>
        <?php endif;?>
        <span class = "fr">航班的起飞和到达时间为当地时间</span></div>
    <div class = "info_content">
        <?php if(property_exists($flightinfo,'segmentsReturn') ):  ?>
            <!--            //判断：往返情况-->
            <?php if(sizeof($flightinfo->segmentsLeave) >1 ): ?>
                <!--                //判断；往返情况下的去程中转情况-->
                <ul class = "info_direct">
                    <li class = "info_d_t">去程 <span>（中转）</span></li>
                    <?php foreach ($flightinfo->segmentsLeave as $item):?>
                        <li class="clearfix info_detail_air">
                        <span class = "fr info_first_air">
                                            <span class = "icon_ai">
                                                <img class="logo" src="<?php echo $item->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo $item->airCorpName; ?></span>
                                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo $item->planeType; ?></span>
                                            <span><?php echo $item->cabinClassName; ?></span>
                                        </span>
                        </li>
                        <li class = "info_day clearfix">
                            <span class = "fl info_d_g"><?php echo formate_date($item->departDate,"Y年m月d日"); ?></span>
                            <span class = "fr info_d_a"><?php echo formate_date($item->arriveDate,"Y年m月d日"); ?></span>
                        </li>
                        <li class = "info_time clearfix">
                            <span class = "info_d_g info_play"><?php echo $item->cityNameFrom; ?><span><?php echo substr($item->departDate,11,5); ?></span></span>
                            <span class = "icon_arrow"></span>
                            <span class = "fr info_d_a"><?php echo $item->cityNameTo; ?><span><?php echo substr($item->arriveDate,11,5); ?></span></span>
                        </li>
                        <li class = "info_airport clearfix">
                            <span class = "info_d_g"><?php echo $item->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                            <span class = "fr info_d_a"><?php echo $item->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                        </li>
                    <?php endforeach;?>
                </ul>
                <ul class = "info_direct">
                    <li class = "info_d_t">返程 <span>（中转）</span></li>
                    <?php foreach ($flightinfo->segmentsReturn as $item):?>
                        <li class = "clearfix info_detail_air">
                        <span class = "fr info_first_air">
                                            <span class = "icon_ai">
                                                <img class="logo" src="<?php echo $item->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo $item->airCorpName; ?></span>
                                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo $item->planeType; ?></span>
                                            <span><?php echo $item->cabinClassName; ?></span>
                                        </span>
                        </li>
                        <li class = "info_day clearfix">
                            <span class = "fl info_d_g"><?php echo formate_date($item->departDate,"Y年m月d日"); ?></span>
                            <span class = "fr info_d_a"><?php echo formate_date($item->arriveDate,"Y年m月d日"); ?></span>
                        </li>
                        <li class = "info_time clearfix">
                            <span class = "info_d_g info_play"><?php echo $item->cityNameFrom; ?><span><?php echo substr($item->departDate,11,5); ?></span></span>
                            <span class = "icon_arrow"></span>
                            <span class = "fr info_d_a"><?php echo $item->cityNameTo; ?><span><?php echo substr($item->arriveDate,11,5); ?></span></span>
                        </li>
                        <li class = "info_airport clearfix">
                            <span class = "info_d_g"><?php echo $item->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                            <span class = "fr info_d_a"><?php echo $item->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php else: ?>
                <!--                //判断；往返情况下的直飞情况-->
                <ul class = "info_direct">
                    <li class = "info_d_t">去程 <span>（直飞）</span></li>
                    <li class = "clearfix info_detail_air">
                                        <span class = "fr info_first_air">
                                            <span class = "icon_ai">
                                                <img class="logo" src="<?php echo $flightinfo->segmentsReturn[0]->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo $flightinfo->segmentsLeave[0]->airCorpName; ?></span>
                                            <span><?php echo $flightinfo->segmentsLeave[0]->airCorpCode; ?><?php echo $flightinfo->segmentsLeave[0]->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo $flightinfo->segmentsLeave[0]->planeType; ?></span>
                                            <span><?php echo $flightinfo->segmentsLeave[0]->cabinClassName; ?></span>
                                        </span>
                    </li>
                    <li class = "info_day clearfix">
                        <span class = "fl info_d_g"><?php echo formate_date($flightinfo->segmentsLeave[0]->departDate,"Y年m月d日"); ?></span>
                        <span class = "fr info_d_a"><?php echo formate_date($flightinfo->segmentsLeave[0]->arriveDate,"Y年m月d日"); ?></span>
                    </li>
                    <li class = "info_time clearfix">
                        <span class = "info_d_g info_play"><?php echo $flightinfo->segmentsLeave[0]->cityNameFrom; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->departDate,11,5); ?></span></span>
                        <span class = "icon_arrow"></span>
                        <span class = "fr info_d_a"><?php echo $flightinfo->segmentsLeave[0]->cityNameTo; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->arriveDate,11,5); ?></span></span>
                    </li>
                    <li class = "info_airport clearfix">
                        <span class = "info_d_g"><?php echo$flightinfo->segmentsLeave[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $flightinfo->segmentsLeave[0]->airportNameFrom; ?><?php echo $flightinfo->segmentsLeave[0]->termDepart; ?></span>
                        <span class = "fr info_d_a"><?php echo$flightinfo->segmentsLeave[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $flightinfo->segmentsLeave[0]->airportNameTo; ?><?php echo $flightinfo->segmentsLeave[0]->termArrive; ?></span>
                    </li>
                </ul>
                <ul class = "info_direct">
                    <li class = "info_d_t">返程 <span>（直飞）</span></li>
                    <li class = "clearfix info_detail_air">
                                        <span class = "fr info_first_air">
                                            <span class = "icon_ai">
                                                <img class="logo" src="<?php echo $flightinfo->segmentsReturn[0]->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo $flightinfo->segmentsReturn[0]->airCorpName; ?></span>
                                            <span><?php echo $flightinfo->segmentsReturn[0]->airCorpCode; ?><?php echo $flightinfo->segmentsLeave[0]->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo $flightinfo->segmentsReturn[0]->planeType; ?></span>
                                            <span><?php echo $flightinfo->segmentsReturn[0]->cabinClassName; ?></span>
                                        </span>
                    </li>
                    <li class = "info_day clearfix">
                        <span class = "fl info_d_g"><?php echo formate_date($flightinfo->segmentsReturn[0]->departDate,"Y年m月d日"); ?></span>
                        <span class = "fr info_d_a"><?php echo formate_date($flightinfo->segmentsReturn[0]->arriveDate,"Y年m月d日"); ?></span>
                    </li>
                    <li class = "info_time clearfix">
                        <span class = "info_d_g info_play"><?php echo $flightinfo->segmentsLeave[0]->cityNameFrom; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->departDate,11,5); ?></span></span>
                        <span class = "icon_arrow"></span>
                        <span class = "fr info_d_a"><?php echo $flightinfo->segmentsLeave[0]->cityNameTo; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->arriveDate,11,5); ?></span></span>
                    </li>
                    <li class = "info_airport clearfix">
                        <span class = "info_d_g"><?php echo$flightinfo->segmentsReturn[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $flightinfo->segmentsReturn[0]->airportNameFrom; ?><?php echo $flightinfo->segmentsReturn[0]->termDepart; ?></span>
                        <span class = "fr info_d_a"><?php echo$flightinfo->segmentsReturn[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $flightinfo->segmentsReturn[0]->airportNameTo; ?><?php echo $flightinfo->segmentsReturn[0]->termArrive; ?></span>
                    </li>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <!--            //判断：单程情况下的-->
            <?php if(sizeof($flightinfo->segmentsLeave) >1 ): ?>
                <!--                //判断；单程情况下的中转情况-->
                <ul class = "info_direct clearfix">
                    <li class = "info_d_t">去程 <span>（中转）</span></li>
                    <?php foreach ($flightinfo->segmentsLeave as $item):?>
                        <li class = "info_detail_air clearfix">
                        <span class = "fr info_first_air">
                                            <span class = "icon_ai">
                                                <img class="logo" src="<?php echo $flightinfo->segmentsLeave[0]->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo $item->airCorpName; ?></span>
                                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo $item->planeType; ?></span>
                                            <span><?php echo $item->cabinClassName; ?></span>
                                        </span>
                        </li>
                        <li class = "info_day clearfix">
                            <span class = "fl info_d_g"><?php echo formate_date($item->departDate,"Y年m月d日"); ?></span>
                            <span class = "fr info_d_a"><?php echo formate_date($item->arriveDate,"Y年m月d日"); ?></span>
                        </li>
                        <li class = "info_time clearfix">
                            <span class = "info_d_g info_play"><?php echo $item->cityNameFrom; ?><span><?php echo substr($item->departDate,11,5); ?></span></span>
                            <span class = "icon_arrow"></span>
                            <span class = "fr info_d_a"><?php echo $item->cityNameTo; ?><span><?php echo substr($item->arriveDate,11,5); ?></span></span>
                        </li>
                        <li class = "info_airport info_hub clearfix">
                            <span class = "info_d_g"><!--?php echo $item->cityCodeFrom; ?-->&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                            <span class = "fr info_d_a"><!--?php echo $item->cityCodeTo; ?-->&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php else: ?>
                <!--                //判断；单程情况下的直飞情况-->
                <ul class = "info_direct">
                    <li class = "info_d_t">去程 <span>(直飞)</span></li>
                    <li class = "info_detail_air">
                                        <span class = "fr info_first_air">
                                             <span class = "icon_ai">
                                                <img class="logo" src="<?php echo$flightinfo->segmentsLeave[0]->airwayLogo;?>">
                                            </span>
                                            <span class = "info_air"><?php echo$flightinfo->segmentsLeave[0]->airCorpName; ?></span>
                                            <span><?php echo $flightinfo->segmentsLeave[0]->airCorpCode; ?><?php echo$flightinfo->segmentsLeave[0]->flightNo; ?></span>
                                            <span class = "info_d_num"><?php echo$flightinfo->segmentsLeave[0]->planeType; ?></span>
                                            <span><?php echo $flightinfo->segmentsLeave[0]->cabinClassName; ?></span>
                                        </span>
                    </li>
                    <li class = "info_day clearfix">
                        <span class = "fl info_d_g"><?php echo formate_date($flightinfo->segmentsLeave[0]->departDate,"Y年m月d日"); ?></span>
                        <span class = "fr info_d_a"><?php echo formate_date($flightinfo->segmentsLeave[0]->arriveDate,"Y年m月d日"); ?></span>
                    </li>
                    <li class = "info_time clearfix">
                        <span class = "info_d_g info_play"><?php echo $flightinfo->segmentsLeave[0]->cityNameFrom; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->departDate,11,5); ?></span></span>
                        <span class = "icon_arrow"></span>
                        <span class = "fr info_d_a"><?php echo $flightinfo->segmentsLeave[0]->cityNameTo; ?><span><?php echo substr($flightinfo->segmentsLeave[0]->arriveDate,11,5); ?></span></span>
                    </li>
                    <li class = "info_airport clearfix">
                        <span class = "info_d_g"><?php echo $flightinfo->segmentsLeave[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo$flightinfo->segmentsLeave[0]->airportNameFrom; ?><?php echo $flightinfo->segmentsLeave[0]->termDepart; ?></span>
                        <span class = "fr info_d_a"><?php echo $flightinfo->segmentsLeave[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo$flightinfo->segmentsLeave[0]->airportNameTo; ?><?php echo $flightinfo->segmentsLeave[0]->termArrive; ?></span>
                    </li>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>