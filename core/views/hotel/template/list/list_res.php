<div list_res>
    <div class="list_res_content clearfix">
        <div class="hotel_list_det fl clearfix">
            <?php if ($results->success): ?>
            <div class="hotel_list_det_head clearfix">
                <div class="order_div clearfix fl">
                    <span class="order_span on" data-sorttype="PriorityDESC" id="js_recommend">推荐</span>
                    <span class="order_span" id="js_great">好评</span>
                    <span class="order_span" id="js_price">价格<i></i></span>
                </div>
            </div>
            <!--loading start-->
            <div class="tour_list_bg">
                <div class="e_load_img"><img src="../../../../../resources/images/ico_loading.gif" alt=""></div>
                <div class="e_load_msg js-loading_tip">正在加载数据，请稍等...</div>
            </div>
            <!--loading end-->

                <!--酒店经纬度start-->
                <ul id="latitude_wrap">
                    <?php foreach ($results->data[0]->hotelList as $k1 => $v1):
                        echo '<li>'.$v1->latitude.','.$v1->longitude.','.$v1->hotelNameLocale.'</li>';
                        ?>
                    <?php endforeach; ?>
                </ul>
                <!--酒店经纬度end-->

                 <?php echo $hotel_res_listItem_html ?>
			<!-- pagination -->
			<div page class="fr" id="hotel_page"></div>

            <?php else: ?>
                <p class="hotel_noResult"><?php echo $results->message ?></p>
            <?php endif ?>
        </div>

        <div class="hotel_map_wrap fr">
            <?php if ($results->success): ?>
                <div class="map_box">
                    <div class="map_head clearfix">
                        <div class="fl">酒店地图</div>
                        <div class="fr" id="isFixed">
                            <span class="filter_cell cur">
                               <i class="icon">
                                   <a href="javascript:void(0);" class="checkbox_icon">
                                       <input type="checkbox" class="filter_input">
                                   </a>
                               </i>
                               <b class="tip_word">跟随浮动</b>
                            </span>
                        </div>
                    </div>
                    <div id="maps" class="list_map"></div>
                </div>
            <?php endif ?>
            <div class="hotel_ad_box">
                <h4>直签酒店推广</h4>
                <ul>
                    <li class="adslist" data-id="19031">
                        <div class = "img_bg">
                            <img src="../../../../resources/images/hotel/ad2.jpg" alt="">
                        </div>
                        <div class="title1"><span class = "f1">风华南岸酒店</span><span>链接有温度的旅游体验</span></div>
                    </li>
                    <li class="adslist" data-id="5271">
                        <div class = "img_bg">
                            <img src="../../../../resources/images/hotel/ad1.jpg" alt="">
                        </div>
                        <div class="title1"><span class = "f1">素坤逸普尔曼曼谷大酒店</span><span>链接有温度的旅游体验</span></div>
                    </li>
                    <li class="adslist" data-id="700">
                        <div class = "img_bg">
                            <img src="../../../../resources/images/hotel/ad3.jpg" alt="">
                        </div>
                        <div class="title1"><span class = "f1">艾美普吉海滩度假酒店</span><span>链接有温度的旅游体验</span></div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>