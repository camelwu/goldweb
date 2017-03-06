<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item("resources_url")?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/order_detail_flight.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/order_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/payment/detail_info.css">
</head>
<body>
<?php echo $header; ?>
<!--content部分-->
<div payment class = "all" >
    <div OrderDetail class ="contents">
        <!--面包屑导航  begin-->
        <div class="nav_bread">
            <a href="javascript:;">国际机票</a>
            <i>&gt;</i>
            <a href="javascript:;">机票预订</a>
            <i>&gt;</i>
            <span>订单详情</span>
        </div>
        <!--面包屑导航 end-->
        <!--警示部分-->
        <?php if($lists->data->isContinuePay===0):?>
        <div warn="" class="warn_ie">
            <i class="icon_warn"></i><p class="warn">航班价格变动频繁，请您在30分钟被完成支付，以确保舱位价格有效</p>
        </div>
        <?php endif;?>
        <?php echo $order_info; ?>
        <div FlightInfo>
            <h3  class = "order_title">航班信息</h3>
        <?php if($lists->data->routeType === 1): ?>
<!--            //判断：单程情况-->
            <?php if(sizeof($lists->data->flightInfo->segmentsLeave) > 1): ?>
<!--                //判断；单程情况下的中转情况-->
                <div class = "trans_content">
                    <div class = "fl t_title">去程 <span>（中转）</span></div>
                    <div class = "fl trans_box">
                    <?php foreach ($lists->data->flightInfo->segmentsLeave as $item):?>
                    <div class = "t_detail t_line">
                                <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $item->airwayLogo;?>">
                             </span>
                            <span><?php echo $item->airCorpName; ?></span> &nbsp;
                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $item->planeType; ?></span>&nbsp;
                            <span><?php echo $item->cabinClassName; ?></span>
                        </span>
                                    <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($item->departDate,$item->arriveDate,"hm"); ?></span></span>
                                </p>
                                <p class ="t_terminal clearfix">
                                    <i class = "icon_num t_icon">1</i>
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($item->departDate,"Y年m月d日") ?></span>&nbsp;
                                <span class = "t_minu"> <?php echo substr($item->departDate,11,5);?></span>
                            </span>
                                    <span class  = "icon_arrow"></span>
                            <span class="fl t_right">
                                <span class = "t_minu"><?php echo substr($item->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($item->arriveDate,"Y年m月d日") ?></span>&nbsp;
                            </span>

                                </p>
                                <p>
                                    <span class = "t_go_port"><?php echo $item->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                                    <span  class = "t_return_port"><?php echo $item->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                                </p>
                            </div>
                    <?php endforeach;?>
                    </div>
                </div>
                <?php else: ?>
<!--                //判断；单程情况下的直飞情况-->
                <div class = "direct_content">
                    <div class = "fl t_title t_direct_title">去程 <span>（直飞）</span></div>
                    <div class = "fl t_detail">
                        <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $lists->data->flightInfo->segmentsLeave[0]->airwayLogo;?>">
                             </span>
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airCorpName; ?></span> &nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airCorpCode; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $lists->data->flightInfo->segmentsLeave[0]->planeType; ?></span>&nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->cabinClassName; ?></span>
                        </span>
                            <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($lists->data->flightInfo->segmentsLeave[0]->departDate,$lists->data->flightInfo->segmentsLeave[0]->arriveDate,"hm"); ?></span></span>
                        </p>
                        <p class ="t_terminal clearfix">
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($lists->data->flightInfo->segmentsLeave[0]->departDate,"Y年m月d日"); ?></span>&nbsp;
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsLeave[0]->departDate,11,5);?></span>
                            </span>
                            <span class  = "icon_arrow"></span>
                            <span class="fl t_right">
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsLeave[0]->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($lists->data->flightInfo->segmentsLeave[0]->arriveDate,"Y年m月d日"); ?></span>&nbsp;
                            </span>

                        </p>
                        <p>
                            <span class = "t_go_port"><?php echo $lists->data->flightInfo->segmentsLeave[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->termDepart; ?></span>
                            <span  class = "t_return_port"><?php echo $lists->data->flightInfo->segmentsLeave[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameTo; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->termArrive; ?></span>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
            <?php elseif ($lists->data->routeType === 2): ?>
<!--            //判断：往返情况下的-->
                <?php if(sizeof($lists->data->flightInfo->segmentsLeave) > 1&& sizeof($lists->data->flightInfo->segmentsReturn) > 1): ?>
<!--                //判断；往返情况下的中转情况-->
                <div class = "trans_content">
                    <div class = "fl t_title">去程 <span>（中转）</span></div>
                    <div class = "fl trans_box">
                        <?php $i=1; foreach ($lists->data->flightInfo->segmentsLeave as $item):?>
                            <div class = "t_detail t_line">
                                <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $item->airwayLogo;?>">
                             </span>
                            <span><?php echo $item->airCorpName; ?></span> &nbsp;
                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $item->planeType; ?></span>&nbsp;
                            <span><?php echo $item->cabinClassName; ?></span>
                        </span>
                                    <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($item->departDate,$item->arriveDate,"hm"); ?></span></span>
                                </p>
                                <p class ="t_terminal clearfix">
                                    <i class = "icon_num t_icon"><?php echo $i; ?></i>
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($item->departDate,"Y年m月d日") ?></span>&nbsp;
                                <span class = "t_minu"><?php echo substr($item->departDate,11,5);?></span>
                            </span>
                                    <span class  = "icon_arrow"></span>
                            <span class="fl t_right">
                                <span class = "t_minu"><?php echo substr($item->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($item->arriveDate,"Y年m月d日") ?></span>&nbsp;
                            </span>

                                </p>
                                <p>
                                    <span class = "t_go_port"><?php echo $item->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                                    <span  class = "t_return_port"><?php echo $item->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                                </p>
                            </div>
                        <?php $i=$i+1; endforeach;?>
                    </div>
                </div>
                <div class = "trans_content">
                    <div class = "fl t_title">返程<span>（中转）</span></div>
                    <div class = "fl trans_box">
                        <?php $i=1; foreach ($lists->data->flightInfo->segmentsReturn as $item):?>
                            <div class = "t_detail t_line">
                                <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $item->airwayLogo;?>">
                             </span>
                            <span><?php echo $item->airCorpName; ?></span> &nbsp;
                            <span><?php echo $item->airCorpCode; ?><?php echo $item->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $item->planeType; ?></span>&nbsp;
                            <span><?php echo $item->cabinClassName; ?></span>
                        </span>
                                    <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($item->departDate,$item->arriveDate,"hm"); ?></span></span>
                                </p>
                                <p class ="t_terminal clearfix">
                                    <i class = "icon_num t_icon"><?php echo $i; ?></i>
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($item->departDate,"Y年m月d日") ?></span>&nbsp;
                                <span class = "t_minu"><?php echo substr($item->departDate,11,5);?></span>
                            </span>
                                    <span class  = "icon_arrow"></span>
                            <span class="fl t_right">
                                <span class = "t_minu"><?php echo substr($item->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($item->arriveDate,"Y年m月d日") ?></span>&nbsp;
                            </span>

                                </p>
                                <p>
                                    <span class = "t_go_port"><?php echo $item->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $item->airportNameFrom; ?><?php echo $item->termDepart; ?></span>
                                    <span  class = "t_return_port"><?php echo $item->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $item->airportNameTo; ?><?php echo $item->termArrive; ?></span>
                                </p>
                            </div>
                        <?php $i=$i+1; endforeach;?>
                    </div>
                </div>
                <?php else: ?>
<!--                //判断；往返情况下的直飞情况-->
                <div class = "direct_content">
                    <div class = "fl t_title t_direct_title">去程 <span>（直飞）</span></div>
                    <div class = "fl t_detail">
                        <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $lists->data->flightInfo->segmentsLeave[0]->airwayLogo;?>">
                             </span>
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airCorpName; ?></span> &nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->airCorpCode; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $lists->data->flightInfo->segmentsLeave[0]->planeType; ?></span>&nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsLeave[0]->cabinClassName; ?></span>
                        </span>
                            <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($lists->data->flightInfo->segmentsLeave[0]->departDate,$lists->data->flightInfo->segmentsLeave[0]->arriveDate,"hm"); ?></span></span>
                        </p>
                        <p class ="t_terminal clearfix">
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($lists->data->flightInfo->segmentsLeave[0]->departDate,"Y年m月d日"); ?></span>&nbsp;
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsLeave[0]->departDate,11,5);?></span>
                            </span>
                            <span class  = "icon_arrow"></span>
                            <span class="fr t_right">
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsLeave[0]->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($lists->data->flightInfo->segmentsLeave[0]->arriveDate,"Y年m月d日"); ?></span>&nbsp;
                            </span>

                        </p>
                        <p>
                            <span class = "t_go_port"><?php echo $lists->data->flightInfo->segmentsLeave[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameFrom; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->termDepart; ?></span>
                            <span  class = "t_return_port"><?php echo $lists->data->flightInfo->segmentsLeave[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsLeave[0]->airportNameTo; ?><?php echo $lists->data->flightInfo->segmentsLeave[0]->termArrive; ?></span>
                        </p>
                    </div>
                </div>
                <div class = "direct_content">
                    <div class = "fl t_title t_direct_title">返程 <span>（直飞）</span></div>
                    <div class = "fl t_detail">
                        <p>
                        <span class ="t_level">
                            <span class="img_wrap">
                                 <img class="logo" src="<?php echo $lists->data->flightInfo->segmentsReturn[0]->airwayLogo;?>">
                             </span>
                            <span><?php echo $lists->data->flightInfo->segmentsReturn[0]->airCorpName; ?></span> &nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsReturn[0]->airCorpCode; ?><?php echo $lists->data->flightInfo->segmentsReturn[0]->flightNo; ?></span>&nbsp;
                            <span class = "t_code"><?php echo $lists->data->flightInfo->segmentsReturn[0]->planeType; ?></span>&nbsp;
                            <span><?php echo $lists->data->flightInfo->segmentsReturn[0]->cabinClassName; ?></span>
                        </span>
                            <span class = "t_time"><i class = "icon_time"></i><span><?php echo diff_date($lists->data->flightInfo->segmentsReturn[0]->departDate,$lists->data->flightInfo->segmentsReturn[0]->arriveDate,"hm"); ?></span></span>
                        </p>
                        <p class ="t_terminal clearfix">
                            <span class="fl">
                                <span class = "t_day"><?php echo formate_date($lists->data->flightInfo->segmentsReturn[0]->departDate,"Y年m月d日"); ?></span>&nbsp;
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsReturn[0]->departDate,11,5);?></span>
                            </span>
                            <span class  = "icon_arrow"></span>
                            <span class="fl t_right">
                                <span class = "t_minu"><?php echo substr($lists->data->flightInfo->segmentsReturn[0]->arriveDate,11,5);?></span>
                                <span class = "t_day1"><?php echo formate_date($lists->data->flightInfo->segmentsReturn[0]->departDate,"Y年m月d日"); ?></span>&nbsp;
                            </span>

                        </p>
                        <p>
                            <span class = "t_go_port"><?php echo $lists->data->flightInfo->segmentsReturn[0]->cityCodeFrom; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsReturn[0]->airportNameFrom; ?><?php echo $lists->data->flightInfo->segmentsReturn[0]->termDepart; ?></span>
                            <span  class = "t_return_port"><?php echo $lists->data->flightInfo->segmentsReturn[0]->cityCodeTo; ?>&nbsp;&nbsp;<?php echo $lists->data->flightInfo->segmentsReturn[0]->airportNameTo; ?><?php echo $lists->data->flightInfo->segmentsReturn[0]->termArrive; ?></span>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="info_note help_tip_box" tip>
                <?php echo $order_back;?>
                <?php echo $order_bag;?>
            </div>
        </div>
        <?php echo $PIS_info; ?>
        <?php echo $link_info; ?>
        <!--导航-->
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/help.js"></script>
</body>
<script>
    $(function(){
        $(".charges").on("click",function(){
            $(".content_cost").slideToggle("slow");
            $(".icon_detail").toggleClass("icon_detail_cur");
        });
        var dire = $(".direct_content");
        var trans = $(".trans_content");
        var t_con= $(".t_direct_title>span").html();
        if(t_con === "（直飞）"){
            if(dire.length>1){
                $(".direct_content:last")[0].style.border = "0px solid #fff";
            }else{
                $(".direct_content")[0].style.border = "0px solid #fff";
            }
        }else{
            if(trans.length>1){
                $(".trans_content:last")[0].style.border = "0px solid #fff";
            }else{
                trans[0].style.border = "0px solid #fff";
            }
        }
        var warn = function(){
            $("#back").hover(function(){
                $("#Back").show();
            },function(){
                $("#Back").hide();
            });
            $("#bag").hover(function(){
                $("#Bag").show();
            },function(){
                $("#Bag").hide();
            });
        }
        warn();
    });
</script>
</html>


