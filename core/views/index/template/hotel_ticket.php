<div tab-card style="display: none">
    <div class="tab_title">
        <ul class="clearfix tab_ht_title">
            <?php
            foreach ($tab_card_array['titles'] as $title) {
                echo '<li>'.$title.'</li>';
            }
            ?>
        </ul>
    </div>
    <div class="tab_content">
        <ul class = "tab_ht_content">
            <li class="clearfix"></li>
            <li class="clearfix"></li>
            <li class="clearfix">
                <div class="search_card_content">
                    <div input-prompt class="search_input" style="padding-top: 0px;">
                        <input  type="text" class="public" id="ht_search_box"  placeholder="请输入城市名或者目的地" style="display: block;">
                    </div>
                    <div class="city_list">
                        <h4 class = "h_title">国际景点:</h4>
                        <ul class="clearfix">
                            <?php if ($hot_cities_name->success) {
                                foreach ($hot_cities_name->data->internationalCities as $cityName) {
                                    echo '<li><a href="/hotelticket/lists?DestCityCode=' . $cityName->cityCode . '&DestCity=' . $cityName->cityName . '">' . $cityName->cityName . '</a></li>';
                                }
                            } ?>
                        </ul>
                    </div>
                    <div class="search_btn" btn-default>
                        <p class="search s_index btn1_hover"  style="position: absolute;right: 0;bottom: 0;" id = "ht_search">搜索</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

</div>
<script>
    ;(function () {
        function show(index) {
            $('.tab_ht_title li').removeClass('cur').eq(index).addClass('cur');
            $('.tab_ht_content li').removeClass('cur').eq(index).addClass('cur');
        }
        $('.tab_ht_title li').on('click', function (e) {
//            show($(this).index());
            show(2);
        });
//        show(<?php //echo $tab_card_index ?>//);
        show(2);
    })();
</script>