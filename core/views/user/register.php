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
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/per_ct.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/login.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/register.css">
</head>
<body>
<div class="all">
  <?php echo $header; ?>

  <!--注册部分-->
  <div class="login_bg" login register>
    <div class="contents clearfix">
      <!--注册部分-->
      <div class="login_box fr pr" >
        <div class="pr" style="z-index: 0;">
          <p class="new_user">新用户注册</p>
          <form class="cmxform" id="signupForm" method="get" action="">
            <!--亚程会员登录-->
            <div input-prompt inp_login password>
              <p class="inp">
                <input autocomplete="off" class="public" id="phone" type="phone" name="phone" placeholder="输入手机号" required>
              </p>
              <p class="inp">
                <input autocomplete="off" class="public" id="password" type="password" name="password" maxlength="15"  placeholder="输入6-15位密码" required>
              </p>
              <div class="password fl"><span class="low">低</span><span class="middle">中</span><span class="high">高</span></div>
              <p class="inp">
                <input autocomplete="off" class="public" id="confirm_password" type="password" name="confirm_password" maxlength="15" placeholder="重新确认密码" required>
              </p>
              <div class="inp">
                <p class="clearfix">
                  <input class="public code fl" id="imgCode" placeholder="图片识别码">
                  <a class="verify_img fr" href="javascript:;"><img id="verify_img" src="<?php echo $code_image_url?>"></a>
                </p>
                <label class="error" style="display:none;">验证码错误</label>
              </div>
              <p class="inp clearfix">
                <input class="public code fl" id="smcode" placeholder="短信码">
                <a class="sms_verification fr" href="javascript:;">发送动态码</a>
              </p>
              <div class="clearfix no_login">
                <p class="agreement_con fl cur pr"><i class="pa"></i>我已阅读并同意</p>
                <a class="agreement fl" id="asy_get_sms" href="javascript:;">《亚程用户服务协议》</a>
              </div>
              <p class="inp pt5">
                <input class="next btn1_hover submit" type="submit" value="注册" id = "register" data-day="true">
              </p>
              <p class="register">已有亚程账号？ <a href="/user/login">登录</a></p>
            </div>
          </form>
        </div>
        <!--弹框-->
        <div class="pop_box">
          <p class="bg"></p>
          <div class="pop_font">
            <p class="pop_title">注册成功</p>
            <div class="word">
              <p><span id="countdown">15</span> 秒后跳转至首页，或者点击<a href="/index/">手动跳转</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--底部-->
  <?php echo $footer; ?>

  <!--弹框-->
  <div class="reg_pop_box"data-pop="reg_pop" reg_pop>
    <p class="reg_pop_bg"></p>
    <div class="reg_pop">
      <div class="reg_tit">亚程用户服务协议<i></i></div>
      <div class="reg_content">
        <h3>《 亚程用户服务协议 》</h3>
        <div class="reg_font">
          <p>亚程旅游网（www.atrip.com）所提供的各项服务和内容的所有权和运作权均归北京畅旅科技有限公司及其关联公司（以下简称“亚旅”）所有。如果您在本网站、亚旅关联公司网站或其他亚旅提供的移动应用或软件上访问、预定或使用我们的产品或服务（以上统称为“服务”），即表示您同意并接受了以下服务协议，请仔细阅读以下内容。如果您不同意以下任何内容，请立刻停止访问本网站或使用本网站服务。</p>
          <br/>
          <p>一、协议总则</p>
          <p>1.本协议内容包括协议正文、亚旅子频道各单项服务协议及其他亚旅已经发布的或将来可能发布的各类规则，包括但不限于 隐私政策、 免责声明、 知识产权声明、 权利声明、 旅游度假预订须知、 亚旅用户协议、 亚旅个人账户协议等其他协议（“其他条款”）。如果本协议与“其他条款”有不一致之处，则以“其他条款”为准。</p>
          <br/>
          <p>2.亚旅有权根据需要不时地制订、修改本协议及/或各类规则向用户提供基于互联网以及移动网的相关服务，并在本页面及其相应页面进行公布，但不再另行通知您，您应该定期登陆本页面及其他相关页面，了解最新的协议内容。变更后的协议和规则一经在本页面及相关页面公布后，立即自动生效。如您不同意相关变更，应当立即停止访问亚旅或使用亚旅服务。若您继续使用亚旅服务的，即表示您同意并接受相关修订的协议和规则。</p>
          <br/>
          <p>3.若您作为亚旅的关联公司或合作公司的用户登陆亚旅平台，访问亚旅站或使用亚旅服务，即表示您同意并接受本协议的所有条款及亚旅公布的其他规则、说明和操作指引。</p>
          <br/>
          <p>二、用户权利</p>
          <p>1.在您完成注册申请手续后，意味着您已获得亚旅账户（用户名）的使用权。您应提供及时、详尽及准确的个人资料，并不断更新注册资料，符合及时、详尽、准确的要求。您应妥善保管您的账户和密码，通过您的账户和密码操作或实施的行为，将视为您本人的行为，由您本人承担相应的责任和后果。如果您发现他人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以书面形式通知亚旅，要求亚旅暂停相关服务。在此，您理解亚旅对您的请求采取行动需要合理时间，亚旅对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。</p>
          <br/>
          <p>二、用户权利</p>
          <p>1.在您完成注册申请手续后，意味着您已获得亚旅账户（用户名）的使用权。您应提供及时、详尽及准确的个人资料，并不断更新注册资料，符合及时、详尽、准确的要求。您应妥善保管您的账户和密码，通过您的账户和密码操作或实施的行为，将视为您本人的行为，由您本人承担相应的责任和后果。如果您发现他人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以书面形式通知亚旅，要求亚旅暂停相关服务。在此，您理解亚旅对您的请求采取行动需要合理时间，亚旅对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。</p>
          <br/>
          <p>二、用户权利</p>
          <p>1.在您完成注册申请手续后，意味着您已获得亚旅账户（用户名）的使用权。您应提供及时、详尽及准确的个人资料，并不断更新注册资料，符合及时、详尽、准确的要求。您应妥善保管您的账户和密码，通过您的账户和密码操作或实施的行为，将视为您本人的行为，由您本人承担相应的责任和后果。如果您发现他人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以书面形式通知亚旅，要求亚旅暂停相关服务。在此，您理解亚旅对您的请求采取行动需要合理时间，亚旅对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script>
  $(function(){
    //服务协议
    $(document).on("click",function(e){
      if( $(e.target).hasClass("agreement") ){
        $(".reg_pop_box").fadeIn(100);
      }
      if($(e.target).is("I")){
        $(".reg_pop_box").fadeOut(100);
      }
    })


    //  是否同意注册协议 -> 注册按钮是否可点
    var onoff = true;
    $(".agreement_con").on("click",function(){
      if(onoff){
        $(this).removeClass("cur");
        $(".btn1_hover").attr("disabled","disabled").css("background","#ccc");
        onoff = false;
      }else{
        $(this).addClass("cur");
        $(".btn1_hover").attr("disabled",false).css("background","#8ace00");
        onoff = true;
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
            showMsg(res.message)
          }
        },
        error:function(res){
          showMsg(res.message);
        }
      });
    })
    //获取手机短信验证码
    var on_codeImg = true,timer;
    $(".sms_verification").on("click",function(){
      //给php传的数据
      var json_data={
        "mobile":$("#phone").val(),
        "inputcode":$("#imgCode").val(),
        "type":"1"
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
                else if(time<0){
                  time=0;
                }
              }, 1000)
            }else {
              console.log(res.message);
              if(res.message == "验证码错误"){
                $("#imgCode").parent().next().show();
              }else{
                $("#imgCode").parent().next().hide();
                alert(res.message);
              }
              on_codeImg = true;
            }
          },
          error:function(res){
            alert("网络错误");
            on_codeImg = true;
          }
        });
      }
    });
    //手机号失去焦点
    var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
    $("#phone").blur(function(){
      if(mobile.test($(this).val())&&$(this).siblings().length>0){
        $(this).removeClass("error").next().remove();
      }
      if(!mobile.test($(this).val())&&$(this).siblings().length==0){
        $(this).after('<label id="phone-error" class="error" for="phone">确认手机不能小于11个字符</label>');
      }
    })
  })
</script>

<script>
  $.validator.setDefaults({
    submitHandler: function() {
      var noland = $("#register").eq(0).attr("data-day");
      //校验手机
      if($("#phone").siblings().length>0){
        $("#phone").focus();
      }
      //提交
      var json_data={
        "username":$("#phone").val(),
        "password":$("#password").val(),
        "smcode":$("#smcode").val(),
        "noland":noland
      };
      $.ajax({
        type:"POST",
        url:"/user/asy_submit_register",
        async:true,//是否是异步
        cache: false,//是否带缓存
        dataType:"json",
        data:json_data,
        success: function(res){
          if(res.success) {
            $(".pop_box").show();
            var time2 = 15;
            time2 = setInterval(function(){
              $("#countdown").html(time2);
              time2--;
              if(time2==0){
                clearInterval(timer2);
                window.location.href="/index/index";
              }
            },1000)
          }else {
            showMsg(res.message)
          }
        },
        error:function(res){
          showMsg(res.message)
        }
      });
    }
  });
  // 手机号码验证
  jQuery.validator.addMethod("isMobile", function(value, element){
    var length = value.length;
    var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
    return this.optional(element) || (length == 11 && mobile.test(value));
  }, "请正确填写您的手机号码");

  $().ready(function() {
    //密码强弱
    var arrPassWord = ["passlow","passmiddle","passhigh"];
    function checkStrong(sValue) {
      var modes = 0;
      //正则表达式验证符合要求的
      if (sValue.length < 8) return 0;
      if (/\d/.test(sValue)) modes++; //数字
      if (/[a-z]/.test(sValue)) modes++; //小写
      if (/[A-Z]/.test(sValue)) modes++; //大写
      if (/\W/.test(sValue)) modes++; //特殊字符
      if(sValue.length >15) return 3;
      return  modes;}
      //逻辑处理
    $("#password").keyup(function(){
      var val= $(this).val();
      var modes=checkStrong(val);
      console.log(modes);
      switch (modes) {
        case 0:
          $(".password").addClass("passlow").removeClass("passmiddle").removeClass("passhigh");
          break;
        case 1:
          $(".password").addClass("passlow").removeClass("passmiddle").removeClass("passhigh");
          break;
        case 2:
          $(".password").addClass("passmiddle").removeClass("passhigh");
          break;
        case 3:
          $(".password").addClass("passhigh");
          break;
      }
    })

    //图形验证码校验是否为空
    $("#imgCode").blur(function(){
      $(this).parent().next(".error").hide();
    })
// 在键盘按下并释放及提交后验证提交表单
    $("#signupForm").validate({
      rules: {
        phone: {
          required: true,
          digits:true,
          minlength:11,
          maxlength:11,
          isMobile:true
        },
        password: {
          required: true,
          minlength:6,
          maxlength:15
        },
        confirm_password: {
          required: true,
          equalTo: "#password"
        },
        agree: "required"
      },
      messages: {
        phone : {
          required : "请输入手机号",
          minlength : "确认手机不能小于11个字符",
          maxlength:"确认手机不能大于11个字符",
          digits: "请正确填写您的手机号码",
          isMobile : "请正确填写您的手机号码"
        },
        password: {
          required: "请输入6-15位密码",
          minlength: "密码长度不能小于6个字母",
          maxlength:"密码长度不能大于15个字母"
        },
        confirm_password: {
          required: "请输入确认密码",
          equalTo: "两次密码输入不一致"
        },
        agree: "请接受我们的声明"
      }
    });
  });
</script>

</body>
</html>
