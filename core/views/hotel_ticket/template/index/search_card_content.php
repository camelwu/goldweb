<?php
/**
 * Created by PhpStorm.
 * User: yyc
 * Date: 2016/8/31
 * Time: 14:59
 */
?>
<div class="search_card_content">
    <div input-prompt class="search_input">
        <input  type="text" class="public" id="search_box">
    </div>
    <div class="city_list">
        <h4>国际景点:</h4>
        <ul class="clearfix">
            <?php if ($hot_cities_name->success) {
                foreach ($hot_cities_name->data->internationalCities as $cityName) {
                    echo '<li><a href="/hotelticket/lists?DestCityCode=' . $cityName->cityCode . '&DestCity=' . $cityName->cityName . '">' . $cityName->cityName . '</a></li>';
                }
            } ?>
        </ul>
    </div>
    <div class="search_btn" btn-default>
        <p class="search s_index btn1_hover">搜索</p>
    </div>
</div>
