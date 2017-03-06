<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/plugin/slide.css">

<div id="carouselBox" class="carousel_box fl">
    <!--大图-->
    <div data-id="big_img" class="carousel_big">
        <img id="big_img" data-index=0 src="<?php if(count($package->imageGalleries)>0){ echo $package->imageGalleries[0]->imageURL; }else{echo "";}?>">
        <div class="carousel_pageNo">
            <p class="pageNo_bg"></p>
            <p class="carousel_number">
                <span class="index_now">1</span> <span>/</span> <span class="number_total"><?php echo count($package->imageGalleries) ?></span>
            </p>
        </div>
    </div>
    <!--小图-->
    <div class="carouselUl">
        <ul id="carouselLi" class="carousel_small">
            <?php $i=0; foreach($package->imageGalleries as $item): ?>
                <li class='car_li' data-index=<?php echo $i; ?> >
                    <img data-index=<?php echo $i; ?> src="<?php echo $item->imageURL?>" alt="">
                </li>
            <?php $i++; endforeach; ?>
        </ul>
    </div>

    <div data-id="btn" class="carousel_btn">
        <img class="left" src="/resources/images/demo/left_btn.png">
        <img class="right" src="/resources/images/demo/right_btn.png">
    </div>
</div>
<script src="../../../../resources/js/plugin/slide.js"></script>





