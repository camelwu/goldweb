/**
 * Created by zhouwei on 2016/8/2.
 */
(function ($) {
  $(".go2detail").on("click",function(){
      var bookingRefNo=vlm.getpara("bookingRefNo");
      var type=vlm.getpara("type");
      if (type.toLowerCase()=="flight") {
       $(this).attr("href", "/payment/order_detail?bookingRefNo="+bookingRefNo+"&type=Flight")
     }
  })


})(jQuery)
