<div class="control_show">
  <!--section1-->
  <div class="section1" section1>
    <div class="hotel_tit" public_tit>
      <div class="public_tit tit2 clearfix">
        <i class="fl"></i>
        <div class="fl">
          <div class="fl portrait_nf">
            <h3 class="fl"><?php echo $hotel->hotelName?></h3>
            <span class="type fl">豪华型</span>
          </div>
          <div class="portrait_t fl">
            <p class="score fl"><span><?php echo $hotel->hotelGenInfo->hotelReviewScore?></span> / 5分</p>
            <p class="comment fl">（<?php echo $hotel->hotelGenInfo->hotelReviewCount?>条点评）</p>
            <a class="change_hotel fl" href="/hotelticket/change_hotel?leadinPrice=<?php echo $leadinPrice?>">更换酒店</a>
          </div>
        </div>
      </div>
      <div class="address clearfix">
        <span class="lf_word fl">景点地址</span>
        <p class="rg_mes fl"><?php echo $hotel->hotelGenInfo->hotelAddress?><i></i></p>
      </div>
      <div class="clearfix">
        <span class="lf_word fl">酒店设施</span>
        <p class="rg_icon fl">
<!--          <i class="icon1"></i>-->
<!--          <i class="parking"></i>-->
          <?php if($hotel->hotelGenInfo->isFreeWiFi):?>
          <i class="wifi"></i>
          <? endif; ?>
        </p>
      </div>
    </div>
    <div class="part_box pr">
      <img class="group_img pa" src="<?php echo $hotel->hotelGenInfo->hotelImage?>">
      <div class="part_rg">
        <ul class="list_tit clearfix">
          <li>房型</li>
          <li class="li2">床型</li>
          <li>是否含早</li>
          <li class="li4">退改规则</li>
          <li class="li5">差价</li>
          <li class="li6">预订</li>
        </ul>
        <dl class="house_room_choose" rooms data-roomID="<?php echo empty($roomID) ? "" : $roomID?>" data-roomName="<?php echo empty($roomName) ? "" : $roomName?>">
          <?php foreach($hotel->rooms as $item):?>
          <dd class="rooms">
            <ul class="room_tit clearfix">
              <li class="house <?php echo !empty($roomID) && $item->roomID == $roomID ? "cur" : "" ?>">
                <span class="fl" title="<?php echo $item->roomName; ?>"><?php echo $item->roomName; ?></span>
                <i class="icon fl"></i>
              </li>
              <li class="bed">大/双人床</li>
              <li class="brickfrist"><?php echo($item->includedBreakfast?"含早":"无早")?></li>
              <li class="is_cancel">不可取消</li>
              <li class="difference" price="<?php echo $item->totailPrice; ?>">+￥<?php echo $item->markUp; ?></li>
              <li class="choose_btn">
                <a class="pr <?php echo !empty($roomID) && $item->roomID == $roomID ? "cur" : "" ?>" href="javascript:;" data-roomID="<?php echo $item->roomID; ?>" data-roomName="<?php echo $item->roomName; ?>">选择<i class="pa"></i></a>
              </li>
            </ul>
            <div class="room_img" style="<?php echo !empty($roomID) && $item->roomID == $roomID ? "display:block" : "" ?>">
              <ul class="clearfix">
                <li><img src="<?php echo $item->roomPictureURL; ?>"> </li>
              </ul>
              <p class="room_word">
<!--                <span>39㎡</span>-->
<!--                <span>独立卫浴 </span>-->
<!--                <span>有窗</span>-->
                <span><?php echo($hotel->hotelGenInfo->isFreeWiFi?"免费Wi-Fi":"")?></span>
                <span><?php echo($item->includedBreakfast?"含早餐":"无早餐")?></span>
<!--                <span>停车场</span>-->
              </p>
            </div>
          </dd>
          <? endforeach; ?>
          <?php if(count($hotel->rooms)>3):?>
<!--            <dt class="more_house clearfix">-->
<!--              <i class="fr"></i>-->
<!--              <a class="fr" href="javascript:;">更多房型</a>-->
<!--            </dt>-->
          <? endif; ?>
        </dl>
      </div>
    </div>
  </div>
  <!--section2-->
  <div class="section2" section2 public_tit>
    <div class="public_tit tour_icon clearfix">
      <i class="fl"></i>
      <div class="fl"><h3>新加坡滨海花园+新加坡摩天观景塔</h3></div>
    </div>
    <?php foreach($tourInfos as $item):?>
    <div class="group clearfix">
      <img class="group_img fl" src="<?php echo $item->tourPictureURL?>">
      <div class="group_mes fr tourInfo" group>
        <div class="title tourName" data-tourID="<?php echo $item->tourID ?>"><h3><?php echo $item->tourName ?></h3></div>
        <p class="en mgb22"></p>

        <?php if($item->tourType !=17):?>
          <div class="mgb22 clearfix">
              <span class="lf_word lf_word2 fl">请选择游玩日期</span>
              <input class="public rg_mes fl travelDate" type="text" name="travelDate"    data-val="<?php isset($checkInDate) ? $checkInDate : "请选择"?>"  value="<?php echo $checkInDate?>">
          </div>
        <?php endif?>


      <?php foreach($_SESSION["hotelTicket"]["package"]->tours as $item2):?>
        <?php if($item2->tourID==$item->tourID && !in_array(4,$item2->tourSession)):?>
         <div class="tour_date clearfix">
          <span class="lf_word fl">请选择游玩时段</span>
          <ul class="rg_mes fl">
            <?php if(in_array(0,$item2->tourSession)):?><li class="time_slot" data-session="0">上午<i></i></li><?php endif?>
            <?php if(in_array(1,$item2->tourSession)):?><li class="time_slot" data-session="1">中午<i></i></li><?php endif?>
            <?php if(in_array(2,$item2->tourSession)):?><li class="time_slot" data-session="2">晚上<i></i></li><?php endif?>
            <?php if(in_array(3,$item2->tourSession)):?><li class="time_slot" data-session="3">全天<i></i></li><?php endif?>
          </ul>
        </div>
        <?php endif ?>
      <?php endforeach;?>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>

<script>
  $(function(){
    /*单日期*/
    var dates1 = $(".travelDate").datepicker({
      minDate: new Date('<?php echo $checkInDate ?>'),
      maxDate : new Date('<?php echo $checkOutDate ?>'),
      defaultDate: "+0w",
      dateFormat: "yy-mm-dd",
      changeYear: true,
      yearRange: "-0:+1",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function () {
        $(this).blur();
      },
      onSelect: function (selectedDate) {
//        // minDate（出发日期）；maxDate（到达日期）
//        var option = this.class == "travelDate" ? "minDate" : "maxDate",
//          instance = $(this).data("datepicker"),
//          date = $.datepicker.parseDate(
//            instance.settings.dateFormat ||
//            $.datepicker._defaults.dateFormat,
//            selectedDate, instance.settings);
//        if (option == "minDate") {
//          dates.not(this).datepicker("option", option, date);
//        }
      }
    }, $.datepicker.regional['zh-cn']);
  })

</script>
<script>
  $(function(){
    function week(num){
      switch (num){
        case 1:
          return "周一";
          break;
        case 2:
          return "周二";
          break;
        case 3:
          return "周三";
          break;
        case 4:
          return "周四";
          break;
        case 5:
          return "周五";
          break;
        case 6:
          return "周六";
          break;
        case 7:
          return "周日";
          break;
      }
    };

    //旅行时间格式化
//    var time = $(".travelDate").attr("data-val").substring(0,10);
//    var changeTime = time.replace(/-/g,",");
//    var timeData = time+"   "+ week(new Date(changeTime).getDay());
//    $(".travelDate").val(timeData)
//    $(".travelDate").val(time)
  })
  //house_room_choose  酒店选择
  var totalPrice = $(".total_price").html()-0;//改变酒店总价 1
  $(".house_room_choose").on("click",function(e){
    if($(e.target).parent().hasClass("house")){
      $(e.target).parent().addClass("cur").parents(".rooms").siblings().find(".house").removeClass("cur");
      var op = $(e.target).parents(".room_tit").next();
      op.show().parent().siblings().find(".room_img").hide();
    }
    if($(e.target).parent().hasClass("choose_btn")){
      chooseRoom(e.target);
    }
  })
  function chooseRoom(el) {
    //总价格会随着变动
//    var nowPrice =($(el).parent().siblings("li.difference").html());
//    nowPrice = nowPrice.replace(/￥/,"")-0;
//    var htmlPrice = totalPrice + nowPrice;
//    $(".total_price").html(htmlPrice)
    var price = $(el).parent().siblings("li.difference").attr('price');
    $(".total_price").html(price);

    $(el).addClass("cur").parents(".rooms").siblings().find(".choose_btn a").removeClass("cur");
    $("#dateChoose").attr({"data-roomID":$(el).attr("data-roomID"),"data-roomName":$(el).attr("data-roomName")})
    $('.price_qi').hide();
  }
  //上下午时间段
  $(".section2").on("click",function(e){
    if($(e.target).hasClass("time_slot")||$(e.target).parent().hasClass("time_slot")){
      var tem = $(e.target).hasClass("time_slot")? $(e.target) : $(e.target).parent();
      tem.addClass("cur").siblings().removeClass("cur");
    }
  })
  var selectedRoom = '<?php echo empty($roomID) ? "" : $roomID?>';
  if (selectedRoom) {
    // $('[data-roomID=206707]').parent()
    chooseRoom($("[data-roomID=" + selectedRoom + "]"));
  } else {
    $(".house").eq(0).addClass("cur");
    $(".choose_btn").eq(0).find("a").addClass("cur");
    $(".room_img").eq(0).show();
    chooseRoom($(".choose_btn").eq(0).find("a"));
  }

  $(".tour_date .rg_mes").find("li:first").addClass("cur")
  //默认情况下  选中房间
  $("#dateChoose").attr({"data-roomID":$(".choose_btn a").attr("data-roomID"),"data-roomName":$(".choose_btn a").attr("data-roomName")})
</script>
