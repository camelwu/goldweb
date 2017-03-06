<div tab-card style="display: none">
    <div class="tab_title_div">海外景点</div>
    <ul class="tab_content" ticket_tab btn-default>
        <div input-prompt>
            <input class="public ticket_input" type="text" placeholder="请输入城市名或者目的地" style="display: block" id="ticket_input">
        </div>
        <div class="city_list">
            <h4 class = "h_title">国际景点:</h4>
            <ul class="clearfix">
                <?php foreach ($hotcity->hotCities as $cityName) {
                        echo '<li class = "title_li"><a href="/ticket/lists?destCityCode=' . $cityName->cityCode . '&destCityName=' . $cityName->cityName . '">' . $cityName->cityName . '</a></li>';
                    }
                ?>
            </ul>
        </div>
        <p class="search s_index btn1_hover fr" data-hoteltype="hotel_inter" id="ticket_search">搜索</p>
</div>