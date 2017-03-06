<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/plugin/tab_card.css" />
<div tab-card>
    <div class="tab_title">
        <ul class="clearfix">
            <?php
            foreach ($tab_card_array['titles'] as $title) {
                echo '<li>'.$title.'</li>';
            }
            ?>
        </ul>
    </div>
    <div class="tab_content">
        <div class="hotel_tab_list">
                <div input-prompt>
                    <input data-hotel="hotel" class="public checkin_city" type="text" id="hotel_inter" data-code="SG" data-name="Singapore" placeholder="选择入住城市" value="新加坡">
                    <input data-hotel="hotel" class="public checkin_city" type="text" id="hotel_dom" data-code="CN" data-name="beijing" placeholder="选择入住城市" value="北京">
                </div>
                <div id="ui-datepicker">
                    <input type="text" id="startdate" placeholder="入住日期" data_date="2016-12-23"><input type="text" id="enddate" placeholder="离店日期">
                </div>
                <div class="clearfix checkIn_sumary">
                    <div select-div class="fl">
                        房间
                        <div class="select_unit">
                            <p class="select_btn"><span id="hotel_room_number">1</span><i></i></p>
                            <ul class="select_ul" >
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                            </ul>
                        </div>
                    </div>
                    <div select-div class="fl">
                        房间入住人数
                        <div class="select_unit" style="width: 96px;">
                            <p class="select_btn"><span id="hotel_adult_number" data_age="">1成人</span><i></i></p>
                            <ul class="select_ul" >
                                <li>1成人</li>
                                <li>2成人</li>
                                <li id="person_select">更多选项</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <div btn-default class="search_hotel_btn_wrap">
            <?php $hotelDom = 'hotelType=dom';if (strpos($_SERVER['REQUEST_URI'], $hotelDom) !== false): ?>
            <p class="search s_index btn1_hover fr" data-hotelType="hotel_dom" id="search_hotel_btn" >搜索</p>
            <?php else: ?>
                <p class="search s_index btn1_hover fr" data-hotelType="hotel_inter" id="search_hotel_btn" >搜索</p>
            <?php endif;?>
        </div>
    </div>
</div>
<script>
    (function () {
        function show(index) {
            $('[tab-card] .tab_title li').removeClass('cur').eq(index).addClass('cur');
            $('[tab-card] .tab_content [input-prompt] input').removeClass('cur').eq(index).addClass('cur');
        }
        $('[tab-card] .tab_title li').on('click', function (e) {
            show($(this).index());
            if($(this).index() == 0){
                $('#search_hotel_btn').attr('data-hoteltype','hotel_inter');
            }else{
                $('#search_hotel_btn').attr('data-hoteltype','hotel_dom');
            }
        });
        show(<?php echo $tab_card_index ?>);

    })();

</script>