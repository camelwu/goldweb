
$(function(){
	/*$(".reg_title li").click(function(){//注册
		var regtl_num=$(".reg_title li").index(this)+1;
		$(".phone_mailbox").hide();
		$(".pm_box"+regtl_num).show();
		$(this).siblings().removeClass("reg_hd_on");
	  $(this).addClass("reg_hd_on");
	});*/
  $(".rge_protocol a").click(function() {
    $(".mask_bg").fadeIn(300);
    $(".popup").fadeIn(300);
  })
  $(".mask_bg,.show_x").click(function() {//弹窗
    $(".mask_bg").fadeOut(300);
    $(".popup").fadeOut(300);
  })
  $(".mask_tab").eq(0).show();
});
var validate = true;
function get_code() {
  if (validate == true) {
    document.getElementById("findcode").src = "/image.php?" + Math.random();
    validate = false;
    return false;
  } else {
    document.getElementById("findcode").src = "/image.php?" + Math.random();
    validate = true;
    return false;
  }
}
function login() {
  var email = $("input[name='email']");
  var username = $("input[name='username']");
  var password = $("input[name='password']");
  var password2 = $("input[name='password2']");
  var code = $("input[name='code']");
  var url = "/async/login/email=" + email.val() + "&password=" + password.val() + "&code=" + code.val();
  $.getJSON(url, function(json) {
    if (json.status == '0') {
      location.href = "/member/center";
    } else {
      alert(json.msg);
    }
  });
}
function register() {
  var email = $("input[name='email']");
  var username = $("input[name='username']");
  var password = $("input[name='password']");
  var password2 = $("input[name='password2']");
  var code = $("input[name='code']");
  var url = "/async/check/email=" + email.val()
      + "&username=" + username.val() + "&password=" + password.val()
      + "&password2=" + password2.val() + "&code=" + code.val();
  $.getJSON(url, function(json) {
    if (json.reg_str != '0') {
      $("#reg_str1").css('background', '');
      $("#reg_str2").css('background', '');
      $("#reg_str3").css('background', '');
      $("#reg_str" + json.reg_str).css('background', '#FF0000');
    }
    if (json.status == '0') {
      alert("注册成功");
      location.href = "/member/center";
    } else {
      alert(json.msg);
    }
  });
}
