<div hot_city>
    <div class="city_title clearfix">
        <h3>酒景热门城市</h3>
        <ul>
            <?php $flag = true; foreach($hot_cities_map as $cityName=>$cities) { ?>
                <li<?php if ($flag) {echo ' class="selected"'; $flag = false;} ?>><?php echo $cityName ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="city_list">
        <?php $flag = true; foreach($hot_cities_map as $cityName=>$cities) { ?>
            <ul class="city city_hot clearfix" style="<?php if (!$flag) {echo 'display: none;';} else {$flag = false;} ?>;">
                <?php foreach($cities as $city) { ?>
                    <li class = "hot_list_detail" data_packageId="<?php echo $city->packageId ?>" data_leadinPrice="<?php echo $city->salePrice ?>">
                        <div class="city_img">
                            <img src="<?php echo $city->imgUrl ?>">
<!--                            <img src="../../../resources/images/ticket/hot_01.png">-->
                            <div class="hover_div"></div>
                        </div>
                        <div class="city_note">
                            <p class = "note_p"><?php echo $city->packageName ?></p>
                            <p>
                                <span class="price">￥<span><?php echo $city->salePrice ?></span></span>
                                <span class="market_price">市场价<span>￥<?php echo $city->marketPrice ?></span></span>
                            </p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>