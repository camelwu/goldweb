<div inter_hot_dest>
    <div class="city_title clearfix">
        <?php $hotelDom = 'hotelType=dom';if (strpos($_SERVER['REQUEST_URI'], $hotelDom) !== false): ?>
            <h3>发现住宿目的地</h3>
        <?php else:?>
            <h3>热门旅游目的地</h3>
        <?php endif;?>
    </div>
    <div class="hot_destination">
        <div class="hot_dest_top clearfix">
            <div class="left fl">

                <div class="inter_one" data-citycode="<?php echo $results->data[0]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[0]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[0]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[0]->cityName)[0] ?></span>
                </div>
                <div class="inter_one" data-citycode="<?php echo $results->data[1]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[1]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[1]->imgURL ?>" alt="">
                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[1]->cityName)[0] ?></span>
                </div>
            </div>
            <div class="inter_two fl">
                <div data-citycode="<?php echo $results->data[2]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[2]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[2]->imgURL ?>" alt="">
                    <div class="dest_mask"></div>
                    <span><?php  echo explode('|',$results->data[2]->cityName)[0] ?></span>
                </div>
            </div>
            <div class="right fl">
                <div class="inter_one" data-citycode="<?php echo $results->data[3]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[3]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[3]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[3]->cityName)[0] ?></span>
                </div>
                <div class="inter_one" data-citycode="<?php echo $results->data[4]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[4]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[4]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php  echo explode('|',$results->data[4]->cityName)[0] ?></span>
                </div>
            </div>
        </div>
        <div class="hot_dest_bot clearfix">
            <div class="left inter_two fl">
                <div  data-citycode="<?php echo $results->data[5]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[5]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[5]->imgURL ?>" alt="">
                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[5]->cityName)[0] ?></span>
                </div>
            </div>
            <div class="right fl clearfix">
                <div class="hot_dest_bot_wrap inter_one fl" data-citycode="<?php echo $results->data[6]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[6]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[6]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[6]->cityName)[0] ?></span>
                </div>
                <div class="hot_dest_bot_wrap inter_one fl" data-citycode="<?php echo $results->data[6]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[7]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[7]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[7]->cityName)[0] ?></span>
                </div>
                <div class="hot_dest_bot_wrap inter_one fl" data-citycode="<?php echo $results->data[6]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[8]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[8]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[8]->cityName)[0] ?></span>
                </div>
                <div class="hot_dest_bot_wrap inter_one fl" data-citycode="<?php echo $results->data[6]->cityCode?>" data-cityname="<?php echo explode('|',$results->data[9]->cityName)[1]?>">
                    <img class="inter_one_img" src="<?php echo $results->data[9]->imgURL ?>" alt="">

                    <div class="dest_mask"></div>
                    <span><?php echo explode('|',$results->data[9]->cityName)[0] ?></span>
                </div>

            </div>
        </div>
    </div>
</div>