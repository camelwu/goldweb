<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no" />
  <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php echo $this->config->item("resources_url")?>/resources/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/base.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
  <link rel="stylesheet" href="<?php echo  $this->config->item("resources_url")?>/resources/css/user/login.css">
</head>
<body>
<div class="all">
  <?php echo $header; ?>

  <div class="login_bg" login>
    <div class="contents clearfix">
      <!--注册部分-->
      <div class="login_box fr">
        <dl class="login_tit">
          <dt class="clearfix">
          <p class="fl cur"><a href="javascript:;">亚程会员登陆</a></p>
          <p class="fr"><a href="javascript:;">动态密码登陆</a></p>
          </dt>
        </dl>
        <p class="login_line"><span></span></p>

        <!--亚程会员登录-->
        <div class="login_font" input-prompt inp_login >
          <p class="inp">
            <input class="public username" id="username" type="text" name="username" placeholder="手机号" autocomplete="off">
            <label id="phone_error" class="error" style="display: none;">请输入11位手机号</label>
          </p>
          <p class="inp">
            <input class="public" id="password" type="password" name="password" placeholder="6-15位密码" autocomplete="false">
            <label id="password_error" class="error" maxlength="15" style="display: none;">请输入密码</label>
          </p>
          <?php if(!isset($_SESSION["error_count"])){ $this->session->set_tempdata('error_count', 0, 60*5);}?>
          <div class="inp" id="verify_div"  <?php if( $_SESSION["error_count"]<=3):?> style="display: none;" <?php endif ?>>
            <p class="pr">
              <input class="public code" id="imgCode" placeholder="图片识别码">
              <a class="verify_img pa" href="javascript:;">
                <img id="verify_img" src="<?php echo $code_image_url?>">
              </a>
            </p>
            <label id="verify_error" class="error" style="display: none;">验证码错误</label>
          </div>
          <div class="clearfix no_login">
            <p class="agreement_con cur fl pr" data-day="true"><i class="pa"></i>30天内自动登陆</p>
            <a class="agreement fr" href="/user/find_password">忘记密码？</a>
          </div>
          <p class="inp pt5">
            <input id="btnLogin" class="next btn1_hover submit"  type="submit" value="登录">
          </p>
          <p class="register"><a href="/user/register">立即注册</a></p>
        </div>

        <!--动态码登录-->
        <div class="login_font" input-prompt inp_login style="display: none">
          <p class="inp">
            <input class="public username" id="username2" type="text" name="username2" placeholder="手机号">
            <label id="phone_error" class="error" style="display: none;">请输入11位手机号</label>
          </p>
          <div class="inp">
            <p class="pr">
              <input class="public code" placeholder="图片识别码" id="imgCode2">
              <a class="verify_img pa" href="javascript:;">
                <img id="verify_img2" src="<?php echo $code_image_url?>">
              </a>
            </p>
            <label class="error" style="display: none;">验证码错误</label>
          </div>
          <div class="inp">
            <p class="pr">
              <input class="public code" id="smCode2" placeholder="短信验证码">
              <a class="sms_verification pa" id="sms_verification2" href="javascript:;">发送动态码</a>
            </p>
            <label class="error" style="display: none;">请输短信验证码</label>
          </div>
          <div class="clearfix no_login">
            <p class="agreement_con cur fl pr" data-day="true"><i class="pa"></i>30天内自动登陆</p>
            <a class="agreement fr" href="/user/find_password">忘记密码？</a>
          </div>
          <p class="inp pt5">
            <input class="next btn1_hover submit" id="btn1_hover2" type="submit" value="登录">
          </p>
          <p class="register register_pb"><a href="/user/register">立即注册</a></p>
        </div>
      </div>
    </div>
  </div>

  <!--底部-->
  <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/jAlert.js"></script>
<script>
  $(function(){
    //tab选项卡
    var left_right = "left";
    $(".login_tit dt a").click(function(){
      $(this).parent().addClass("cur").siblings().removeClass("cur");
    })
    $(".login_tit dt p a").eq(0).on("click",function(){
      $(".login_line span").animate({left:"0%"},200);
      $(".login_font").eq(0).show();
      $(".login_font").eq(1).hide();
    })
    $(".login_tit dt p a").eq(1).on("click",function(){
      $(".login_line span").animate({left:"50%"},200);
      $(".login_font").eq(1).show();
      $(".login_font").eq(0).hide();
    })
    //普通、动态登录手机号校验
    var regMobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
    $(".username").blur(function(){
      if( !regMobile.test($(this).val()) || $(this).val().length != 11){
        $(this).next().show();
      }else{
        $(this).next().hide();
      }
    })
  })
</script>
<!--普通登录-->
<script>
$(function(){

  //是否30天内免登陆
  $(".agreement_con").each(function(i){
    $(".agreement_con").eq(i).on("click",function(){
      if($(".agreement_con").eq(i).attr("data-day") == "true"){
        $(".agreement_con").attr("data-day","false");
        $(".agreement_con").removeClass("cur");
      }else{
        $(".agreement_con").attr("data-day","true");
        $(".agreement_con").addClass("cur");
      }
    })
  })

  //密码是否为空
  $("#password").blur(function(){
    if($(this).val() == ""){
      $(this).next().show();
    }else{
      $(this).next().hide();
    }
  })
  //获取图形验证码
  $("#verify_img").on("click",function(){
    $.ajax({
      type:"POST",
      url:"/user/asy_get_code",
      async:true,//是否是异步
      cache: false,//是否带缓存
      dataType:"json",
      success: function(res){
        if(res.success) {
          $("#verify_img").attr("src",res.message)
        }else {
          showMsg(res.message,1);
        }
      },
      error:function(res){
        showMsg("网络错误",1);
      }
    });
  })
  //普通登录
  $("#btnLogin").on("click",function(){
    console.log($("#username").siblings().length)
    console.log($("#password").siblings().length)
    if($("#phone_error").css("display")=="none" && $("#password_error").css("display")=="none"){
      var noland = $(".agreement_con").eq(0).attr("data-day");
      console.log(noland)
      var postObj={
        "username":$("#username").val(),
        "password":$("#password").val(),
        "imgCode":$("#imgCode").val(),
        "noland":noland
      }
      $.ajax({
        type:"POST",
        url:"/user/asy_submit_login",
        data: postObj,
        async:true,
        cache: false,
        dataType:"json",
        success: function(res){
          if(res.success) {
            window.location.href = "/index"
          } else {
            if(res.error_count>3){
              $("#verify_div").show();
            }
            showMsg(res.message,1);
          }
        },
        error:function(res){
          showMsg("网络错误",1);
        }
      });
    }
  })
})
</script>
<!--动态登录-->
<script>
  $(function(){
    //获取图形验证码
    $("#verify_img2").on("click",function(){
      $.ajax({
        type:"POST",
        url:"/user/asy_get_code",
        async:true,//是否是异步
        cache: false,//是否带缓存
        dataType:"json",
        success: function(res){
          if(res.success) {
            $("#verify_img2").attr("src",res.message)
          }else {
            showMsg(res.message,1);
          }
        },
        error:function(res){
          showMsg("网络错误",1);
        }
      });
    })

    //获取手机短信验证码
    var on_codeImg = true,timer;
    $("#sms_verification2").on("click",function(){
      //给php传的数据
      var json_data={
        "mobile":$("#username2").val(),
        "inputcode":$("#imgCode2").val(),
        "type":"5"
      };
      if(on_codeImg) {
        on_codeImg = false;
        $.ajax({
          type:"POST",
          url:"/user/asy_get_sms",
          async:true,//是否是异步
          data:json_data,
          cache: false,//是否带缓存
          dataType:"json",
          success: function(res){
            console.log(res)
            if(res.success) {
              var time = 60;
              timer = setInterval(function () {
                time--;
                $(".sms_verification").html(time + "s后重发").css("cursor","default");
                if (time == 0) {
                  clearInterval(timer);
                  $(".sms_verification").html("重新发送").css("cursor","pointer");
                  on_codeImg = true;
                }
              }, 1000)
            }else {
              console.log(res.message);
              if(res.message == "验证码错误"){
                $("#imgCode2").parent().next().show();
              }
              if(res.message == "缺少必须的请求数据"){
                $("#phone_error").show();
              }
              on_codeImg = true;
            }
          },
          error:function(res){
            showMsg("网络错误",1);
            on_codeImg = true;
          }
        });
      }
    })

    //动态登录  图片验证码
    $("#imgCode2").blur(function(){
      if($(this).val() == ""){
        $(this).parent().next().show();
      }else{
        $(this).parent().next().hide();
      }
    })
    //动态登录  短信验证码
    $("#smCode2").blur(function(){
      if($(this).val() != ""){
        $(this).parent().next().hide();
      }
    })

    //点击登录按钮
    $("#btn1_hover2").on("click",function(){
      var noland = $(".agreement_con").eq(0).attr("data-day");
      //验证手机号是否填写
      if($("#username2").val() ==""){
        $("#username2").next().show();
        $("#username2").focus();
      }else{
        //验证验证码是否为空
        if($("#imgCode2").val()==""){
          $("#imgCode2").parent().next().show();
          $("#imgCode2").focus();
        }else{
          //验证短信验证码是否为空
          if($("#smCode2").val()==""){
            $("#smCode2").parent().next().show();
            $("#smCode2").focus();
          }
        }
      }
      //异步提交
      if( $("#smCode2").val()!="" && $("#username2").val()!="" ){
        var json_data={
          "username":$("#username2").val(),
          "smcode":$("#smCode2").val(),
          "noland":noland
        };
        $("#loading").delay(400).fadeIn("medium");
        $.ajax({
          type:"POST",
          url:"/user/asy_submit_sms_login",
          async:true,//是否是异步
          cache: false,//是否带缓存
          dataType:"json",
          data:json_data,
          success: function(res){
            if(res.success) {
              window.location.href="/index"
            }else {
              showMsg(res.message,1);
            }
          },
          error:function(res){
            $("#loading").hide();
            showMsg("网络错误",1);
          }
        });
      }
    })
  })
</script>

</body>
</html>