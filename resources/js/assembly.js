//提示框出现
$(function(){

  var is_cache=getCookie('is_pager_cache');
  if (is_cache==1){
    var label_list=$("label[is_cache]");
    var input_list=$("label[is_cache]");
    label_list.forEach(function(e){
      debugger;
      alert(e);
    })
    input_list.forEach(function(e){
      alert(e);
    })
  }
  function getCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
    if(arr != null){
      return unescape(arr[2]);
    }else{
      return null;
    }
  }

  $("body").on("click",function(){
    $('.select_unit').find(".select_ul").hide();
    $("#visiter_order").hide();
    $(".vistor_order").find(".txtoutput").css("border-bottom", "1px solid #eaeaea");

  })

  //@帮助图标   划过范围：tip_btn_i 仅划过图标时候出现，离开icon就隐藏tip
  $('.tip_btn_i').hover(function(){
    $(this).next().show();
  },function(){
    $(this).next().hide();
  })
  //@帮助图标   划过范围：tip_btn_div 划过图标tip的总范围时候显示，离开总范围才隐藏
  $('.tip_btn_div').hover(function(){
    $(this).find('.tip_box').show();
  },function(){
    $(this).find('.tip_box').hide();
  });

  $(' .select_btn').on("click",function(e){
    var ev = e||event;
    ev.stopPropagation()
    $(".select_unit").find(".select_ul").hide();
    $(this).next().slideToggle("fast");
  })

  $('.select_unit li').click(function(){
    console.log(9)
    $(this).parent().siblings().find('span').html($(this).html());
    $($(this).parent()).hide();
  })

  //图形验证码
  $("#verify_code,.change_code").click(function(){
    $("#verify_code").attr('src',"/demo/verify_image?r=" + Math.random());
  })









})