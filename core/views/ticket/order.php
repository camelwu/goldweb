<?php
/**
 * Created by PhpStorm.
 * User: zhouwei
 * Date: 2016/8/29
 * Time: 23:32
 */
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/jquery-ui-1.10.3.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/ticket/order.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/plugin/select_person_pop_v1.0.css">
</head>
<body>
<div class="all" fill>
    <div class="shdow_circle">
        <img class="load_img order_bg"
             src="<?php echo $this->config->item('resources_url') ?>/resources/images/bg_loading.gif"/>
    </div>
    <!--topper  begin-->
    <?php echo $header; ?>

    <div class="contents">
        <!--填写流程图  4个步骤  begin-->
        <form>
        <div step-flow step-num3 step-fill>
            <div class="step_flow_img clearfix">
                <i class="cur">1</i>
                <span></span>
                <i>2</i>
                <span></span>
                <i>3</i>
            </div>
            <div class="step_flow_word clearfix">
                <p class="cur">信息填写</p>
                <p class="pd">支付</p>
                <p class="pd2">完成</p>
            </div>
        </div>
        <!--填写流程图  3个步骤  end-->

        <!--右侧导航+左侧   begin-->
        <div class="clearfix" container_rl>
            <!--左侧内容-->
            <div class="content fl">
                <!--预订信息-->
                <div reserve_info>
                    <div class="info_title">预订信息</div>
                    <div class = "info_centent clearfix" select-div>
                      <div class = "scenic_center">
                          <?php foreach($Packageid->tours as $items):?>
                          <div class = "scenic_date" input-prompt>
                              <span><span id = "packegeid"data-id="<?php echo$items->tourID ;?>"><?php echo $items->tourName;?></span><span>游玩日期</span></span>
                              <div class="select_unit">
                                  <input type="text" data-data="<?php echo$items->tourID ;?>"class="public date_public" name="arrive_date" readonly value="<?php echo substr($_SESSION["package"]->defaultDepartStartDate,0,10 );?>">
                              </div>
                          </div>
                          <?php endforeach;?>
                      </div>
                        <div class="vistor_order" select-div>
                            <span>游客信息</span>
                            <div class = "vistor_center" select_person>
                                <div class="txtoutput people " id="person_select" data-value='{"adultNum":<?php echo $_SESSION["priceInfo"]->prices[0]->quantity;?>,"childtNum":"0","ageList":[]}'><?php echo $_SESSION["priceInfo"]->prices[0]->quantity;?>成人 <?php if($_SESSION["package"]->onlyForAdult!=1):?>0儿童<?php endif;?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--接送酒店-->
                <?php if(isset($hotelArray)):?>
                <div coach-hotel>
                    <div class="info_title">接送酒店</div>
                    <div  class = "coach_hotel clearfix"select-div>
                        <span>选择接送景点的酒店</span>
                        <div class="select_unit select_hotel" data-value='<?php echo $hotelArray->pickupInfos[0]->pickupID; ?>'>
                            <p class="select_btn">
                                <span id = "hotel_info"><?php echo $hotelArray->pickupInfos[0]->pickupPoint;?></span>
                                <i></i>
                                <input type="hidden" value="12">
                            </p>
                            <ul class="select_ul">
                                <?php foreach ($hotelArray->pickupInfos as $items): ?>
                                    <li class  = "libotton" data-value='<?php echo $items->pickupID; ?>'><?php echo $items->pickupPoint; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <span class = "coach_span">酒店往返景点接送</span>
                    </div>
                </div>
                <?php endif;?>
                <!--取票人信息-->
                <div person_info>
                    <div class="info_title">取票人信息</div>
                    <?php echo $userlist_html?>
                    <div class="add_person" input-prompt>
                        <div class="sub_title">添加取票人</div>
                        <?php echo $personul;?>
                    </div>
                </div>
                <!--下一步,去支付-->
                <div class="next_btn submit" btn-default>
                    <p class="next btn1_hover">下一步，去支付</p>
                </div>
            </div>
            <!--右侧导航-->
            <div class="contain_screen_r fr" cost_detail>
                <!--费用明细-->
                <div class="border">
                    <div class="detail_tPackageiditle detail_title">费用明细</div>
                    <!--景点-->
                    <ul class="person_list" id = "costlist">

                        <?php  foreach( $cost->prices as $items):?>
                            <?php if(($items->category)=="ADULT"):?>
                                <li class="clearfix">
                                    <div class="person_type">成人</div>
                                    <div class="person_price">￥<span class = " price_adult"><?php echo $items->amountInCNY;?></span>*<span class = "adult_num"><?php echo $items->quantity;?></span>人</div>
                                </li>
<!--                            --><?php //elseif(($items->category)=="CHILD") : ?>
<!--                                <li class="clearfix">-->
<!--                                    <div class="person_type">儿童</div>-->
<!--                                    <div class="person_price">￥<span class = " price_child">--><?php //echo $items->amountInCNY;?><!--</span>*<span class = "child_num">0</span>人</div>-->
<!--                                </li>-->
                            <?php endif;?>
                        <?php endforeach;?>
                        <li class="clearfix">
                            <div class="person_type">儿童</div>
                            <div class="person_price">￥<span class = " price_child">0</span>*<span class = "child_num">0</span>人</div>
                        </li>
                    </ul>
                    <div class="pay clearfix">
                        <span>应付总金额:</span>
                        <?php foreach( $cost->prices as $items):?>
                        <?php $sum; if(($items->category)=="ADULT"):?>
                            <span class="money">￥<span class = "totalprice"><?php echo $cost->totailPrice;?></span></span>
                        <?php endif;?>
                        <?php endforeach;?>
                        <div btn-default class="pay_btn"><p class="btn btn1_hover cur submit">去支付</p></div>
                    </div>
                </div>
            </div>
        </div>
        <!--右侧导航+左侧   end-->
        </form>
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>
</div>
<div id="loading-div" style="display: none;">
    <img src="../../../resources/images/ico_loading.gif" alt="">
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/calendar_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/ejs.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/select_person_pop_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/ticket/order.js"></script>
<script>
    $(document).ready(function() {
        function serverEvent(){
            var person=$("#person_select");
            var tours=[];
            for(var i=0; i<$(".scenic_date").length;i++){
                var id= $($(".scenic_date")[i]).find("#packegeid").attr("data-id");
                var data=$($(".scenic_date")[i]).find(".date_public").val();
                console.log(id);
                tours.push({"tourID":id,"travelDate":data})
            }
            var data_json = {
                tours:tours,
                travelAdilt:jQuery.parseJSON(person.attr("data-value"))["adultNum"],
                travelChild:jQuery.parseJSON(person.attr("data-value"))["childtNum"],
                travelChildage:jQuery.parseJSON(person.attr("data-value"))["ageList"]
            };
            console.log(data_json);
            $.ajax({
                type:'POST',url:"/ticket/get_travel_code",asyne:false,cache:false,dataType:"json",data:data_json,
                success:function(res){
                    if(res.success){
                        for(var i=0;i<res.message.prices.length;i++){
                            if(res.message.prices[i].category=="CHILD"){
                                $(".person_price>.price_child").html(res.message.prices[i].amount);
                                $(".person_price>.child_num").html(jQuery.parseJSON(person.attr("data-value"))["childtNum"]);
                                $(".money>span").html(res.message.totailPrice);
                            }else{
                                $(".person_price>.price_adult").html(res.message.prices[i].amount);
                                $(".person_price>.adult_num").html(jQuery.parseJSON(person.attr("data-value"))["adultNum"]);
                                $(".person_price>.child_num").html(jQuery.parseJSON(person.attr("data-value"))["childtNum"]);
                                $(".money>span").html(res.message.totailPrice);
                            }
                        }
                        $('#loading-div').hide();
                    }
                    else{
                        showMsg(res.message);
                        $('#loading-div').hide();
                    }
                },
                error:function(res){
                    showMsg(res.message);
                    $('#loading-div').hide();
                }
            });
        }
        /* 选择用户人数控件
         * @type ticket:景点门票， hotel_ticket:酒景
         * @elemId  用户控件ID
         * @minPax  最小总人数
         * @maxPax  最多总人数
         * @maxAdult  最多成人数
         * @childAgeMax  最多儿童数
         * @childAgeMin  最小儿童年龄
         * @onlyForAdult  只能是成人
         * */
        new select_person_pop().init({
            isShowRoom: true,
            type: "ticket",// ticket:景点门票， hotel_ticket:酒景
            elemId: "person_select",//
            maxRoom: 5,
            minPax:<?php echo $_SESSION["package"]->minPax<0? 1: $_SESSION["package"]->minPax ?>,//最小总人数
            maxPax: <?php echo $_SESSION["package"]->maxPax?>,//最多总人数
            maxAdult: <?php echo $_SESSION["package"]->maxAdult? 10: $_SESSION["package"]->maxAdult ?>, //最多成人数
            childAgeMax: <?php echo $_SESSION["package"]->childAgeMax?>,//最多儿童数
            childAgeMin: <?php echo $_SESSION["package"]->childAgeMin?>,//最小儿童年龄
            onlyForAdult: <?php echo empty($_SESSION["package"]->onlyForAdult)==1?0:1;?>,//是否只有成人
            callback: function () {
                debugger;
                //alert("执行回调");
                serverEvent();
                $('#loading-div').show();
                if($("#costlist li").length==1) {
                    $("#costlist").append("<li class='clearfix'><div class='person_type'>儿童</div><div class='person_price'>￥<span class = ' price_child'></span>*<span class = 'child_num'>0</span>人</div></li>");
                }
            }

        });
    })
</script>
</body>
</html>
