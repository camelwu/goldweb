<div inter_hot_hotel>
    <?php $hotelDom = 'hotelType=dom';if (strpos($_SERVER['REQUEST_URI'], $hotelDom) !== false): ?>
    <div class="city_title choose_recom clearfix">
        <!--国内酒店推荐-->
        <h3>每日酒店推荐</h3>
        <ul>
            <?php $flag = true;
            foreach ($daily_cities_map as $cityName => $cities) { ?>
            <li<?php if ($flag) {
            echo ' class="selected"';
            $flag = false;
            } ?>><?php echo $cityName ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="city_list choose_recom_item">
        <?php $flag = true;
        foreach ($daily_cities_map as $cityName => $cities) { ?>
        <ul class="city clearfix" style="<?php if (!$flag) {
        echo 'display: none;';
        } else {
        $flag = false;
        } ?>;">
            <?php foreach ($cities as $city) { ?>
            <li onclick="window.location.href='/hotel/detail?hotelCode=<?php echo $city->hotelCode ?>&sellingPrice=<?php echo $city->sellingPrice ?>'">
                <div class="city_img">
                    <img src="<?php echo $city->imgURL ?>">

                    <div class="hover_div"></div>
                </div>
                <div class="city_note">
                    <p><?php echo $city->hotelNameLocale ?></p>

                    <p>
                        <span class="price">￥<span><?php echo $city->sellingPrice ?></span></span>
                        <span class="market_price">市场价<span>￥<?php echo $city->marketPrice ?></span></span>
                    </p>
                </div>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>

    <!--国内精选度假酒店start-->
    <div class="city_title choose_vacation clearfix" >
        <h3>精选度假酒店</h3>
        <ul>
            <?php $flag = true;
            foreach ($hot_cities_map as $cityName => $cities) { ?>
                <li<?php if ($flag) {
                    echo ' class="selected"';
                    $flag = false;
                } ?>><?php echo $cityName ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="city_list hotel_oneline" id="hotelList" data-no-img="<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png">
        <?php $flag = true;
        foreach ($hot_cities_map as $cityName => $cities) { ?>
            <ul class="city clearfix" style="<?php if (!$flag) {
                echo 'display: none;';
            } else {
                $flag = false;
            } ?>;">
                <?php foreach ($cities as $city) { ?>
                    <li onclick="window.location.href='/hotel/detail?hotelCode=<?php echo $city->hotelCode ?>&sellingPrice=<?php echo $city->sellingPrice ?>'">
                        <div class="city_img">
                            <img src="<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png" data-src="<?php echo $city->imgURL ?>">
                            <div class="hover_div"></div>
                        </div>
                        <div class="city_note">
                            <p><?php echo $city->hotelNameLocale ?></p>

                            <p>
                                <span class="price">￥<span><?php echo $city->sellingPrice ?></span></span>
                                <span class="market_price">市场价<span>￥<?php echo $city->marketPrice ?></span></span>
                            </p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
    <!--国内精选度假酒店end-->

    <?php else: ?>
    <!--国际酒店start-->
    <div class="city_title choose_recom clearfix">
        <h3>国际热门酒店</h3>
        <ul >
            <?php $flag = true;
            foreach ($hot_cities_map as $cityName => $cities) { ?>
                <li<?php if ($flag) {
                    echo ' class="selected"';
                    $flag = false;
                } ?>><?php echo $cityName ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="city_list choose_recom_item" id="hotelList" data-no-img="<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png" >
        <?php $flag = true;
        foreach ($hot_cities_map as $cityName => $cities) { ?>
            <ul class="city clearfix" style="<?php if (!$flag) {
                echo 'display: none;';
            } else {
                $flag = false;
            } ?>;">
                <?php foreach ($cities as $city) { ?>
                    <li onclick="window.location.href='/hotel/detail?hotelCode=<?php echo $city->hotelCode ?>&sellingPrice=<?php echo $city->sellingPrice ?>'">
                        <div class="city_img">
                            <img src="<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png" data-src="<?php echo $city->imgURL ?>">

                            <div class="hover_div"></div>
                        </div>
                        <div class="city_note">
                            <p><?php echo $city->hotelNameLocale ?></p>

                            <p>
                                <span class="price">￥<span><?php echo $city->sellingPrice ?></span></span>
                                <span class="market_price">市场价<span>￥<?php echo $city->marketPrice ?></span></span>
                            </p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
    <?php endif; ?>
    <!--国际酒店end-->

</div>