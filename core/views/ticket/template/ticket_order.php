
<?php $k=0; foreach($cityArray as $city):?>
<ul class="ticket_ploy_center" <?php if($k==0):?>style="display: block" <?php else:?>style="display: none" <?php endif;?> >
    <?php foreach($hotTouer->hotTours as $item):?>
        <?php if($city==($item->cityName)):?>
            <li class = "ploy_centent" data-id="<?php echo $item->packageId;?>">
        <div class = "ploy_img"><img src="<?php echo $item->imgUrl;?>" alt=""><div class = "ploy_name_bg"><span class = "ploy_name"><?php echo $item->cityName;?></span></div></div>
        <div class = "ploy_center">
            <p class = "ploy_theme"><?php echo $item->packageName;?></p>
            <p class = "ploy_num"><span class="ploy_price">￥ <strong><?php echo $item->salePrice;?></strong></span><span class = "ploy_gray">市场价: <del>￥<?php echo $item->marketPrice;?></del></span></p>
        </div>
    </li>
        <?php endif;?>
    <?php endforeach;?>
</ul>
<?php $k=$k+1 ;endforeach;?>
<script>
    ~(function(){
        var type= '<?php echo $ticket_order["type"];?>';
        var binEventfunction=function(){
            $(".ploy_centent").on("click",function(event){
                var url="";
                if(type=="ticket"){
                    url="/ticket/detail?packageId="+$(this).attr("data-id");
                }else if(type=="hotelticket"){
                    url="/hotel_ticket/lists?packageId="+$(this).attr("data-id");
                }
                window.location.href=url;
            });
       };
        binEventfunction();
    })(jQuery)


</script>
