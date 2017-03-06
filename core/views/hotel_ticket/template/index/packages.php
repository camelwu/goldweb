<?php if ($packages->success) { ?>
    <div package>
        <div class="city_title clearfix">
            <h3>酒景组合套餐</h3>
        </div>
        <div class="city_list">
            <ul class="city clearfix">
                <?php $flag = true; foreach($packages->data->hotHotelTours as $package) { ?>
                    <?php if ($flag) { ?>

                        <li onclick="window.location.href='/hotelticket/detail?packageID=<?php echo $package->packageId ?>&leadinPrice=<?php echo $package->salePrice ?>'">
                            <div class="city_img city_img_big">
                                <img src="<?php echo $package->imgUrl ?>">
<!--                                <img src="../../../resources/images/ticket/hot_01.png">-->
                                <div class="city_img_big_note clearfix">
                                    <div class = "note fl"><?php echo $package->packageName ?></div>
                                    <div class = "price fr">￥ <span><?php echo $package->salePrice ?></span></div>
                                </div>
                                <div class="hover_div"></div>
                            </div>
                        </li>
                    <?php $flag=false; } else { ?>
                        <li onclick="window.location.href='/hotelticket/detail?packageID=<?php echo $package->packageId ?>&leadinPrice=<?php echo $package->salePrice ?>'">
                            <div class="city_img">
                                <img src="<?php echo $package->imgUrl ?>">
<!--                                <img src="../../../resources/images/ticket/hot_01.png">-->
                                <div class="hover_div"></div>
                            </div>
                            <div class="city_note">
                                <p><?php echo $package->packageName ?></p>
                                <p>
                                    <span class="price">￥<span><?php echo $package->salePrice ?></span></span>
                                    <span class="market_price">市场价<span>￥<?php echo $package->marketPrice ?></span></span>
                                </p>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>