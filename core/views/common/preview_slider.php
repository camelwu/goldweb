<link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/review_slider.css">
    <div class="slide_img clearfix">
        <div class="img_left fl">
            <img src="<?php echo $hotel_info->data['0']->hotelGenInfo->hotelImage; ?>" data-index="0"/>
            <span class="total_num">查看<?php echo count($hotel_info->data['0']->hotelImagesList); ?>张酒店图片</span>
        </div>
        <div class="img_right fl" id="en_wrap">
            <ul id="smallImages">
                <!--鼠标移到图片上，则加CLASS值：current-->
                <?php foreach ($hotel_info->data['0']->hotelImagesList as $k1 => $v1): ?>
                    <?php if ($k1<6): ?>
                        <li class="img_out_li">
                            <a onclick="return false;" target="_self" href="#">
                                <img class="target_img" data-index="<?php echo $k1; ?>" src="<?php echo $v1->imageFileName; ?>">
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="hotel_gallery" style="display: none">
        <div class="hotel_mask" id="mainLayout"></div>
        <div class="hotel_gallery_wrap">
            <div class="close_btn"></div>
            <div class="hotel_gallery_content">
                <div id="hotelPhotoSlide" class="gallery">
                    <div class="hotel_gallery_img_wrap">
                        <?php foreach ($hotel_info->data['0']->hotelImagesList as $k2 => $v2): ?>
                        <div class="slide"><img src="<?php echo $v2->imageFileName; ?>" onerror="javascript:this.src='<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png';" alt="图片" data-index="<?php echo $k2; ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="prev_area">
                    <div class="prev_btn t_c"></div>
                </div>
                <div class="next_area">
                    <div class="next_btn t_c"></div>
                </div>
            </div>
            <div class="hotel_gallery_footer">
                <p> <em id="hotelPhotoIndex">1</em>/<em id="hotelPhotoAllCount"><?php echo count($hotel_info->data['0']->hotelImagesList);?></em><span><?php echo $hotel_info->data['0']->hotelGenInfo->hotelNameLocale;?></span></p>
            </div>
            <div class="hotel_gallery_panel" id="hotelGalleryPanel">
                <div class="icon_wrap">
                    <div class="icon_inner clearfix">
                        <?php foreach ($hotel_info->data['0']->hotelImagesList as $k3 => $v3): ?>
                        <a class="hotel_gallery_pic <?php echo $k3==0?'indexOn':''; ?>" href="javascript:void(0);">
                            <img class="s_icon" src="<?php echo $v3->imageFileName; ?>" onerror="javascript:this.src='<?php echo $this->config->item('resources_url') ?>/resources/images/hotelDetailerrorpic.png';" data-index="<?php echo $k3;?>" alt="图片">
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/preview_slider.js"></script>
