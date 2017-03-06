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
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/user/modify_password.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>

    <div class="contents clearfix">
        <!--左边菜单列表-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part list_information fr" reset_password modify_password input-prompt>
            <div class="list_b_title"><i></i>手机号验证</div>
            <form name="info_form" id = "signupForm">
                <div class="line_div clearfix">
                    <label class="pre_f con_p fl" for="tel_num">手机号码</label>
                    <input type="text" name="con_p" id="con_p" class="fl" placeholder="请输入要绑定或更换的手机号码">
                </div>
                <div class="line_div clearfix">
                    <span class = "fl">
                        <label class="pre_f new_p fl" for="tel_num">验证码</label>
                         <input type="text" name="new_p" id="new_p" class="fl verifi_code " placeholder="请输入验证码" required>
                    </span>
                    <span class = "fl">
                        <span class="fl img_code"><img src="<?php echo $code_image_url?>" id = "img_code" alt="图片验证码"></span>
                        <span class = "fl img_change" id = "change_img">换一张</span>
                    </span>
                </div>
                <div class="line_div clearfix">
                    <span class = "fl">
                        <label class="pre_f con_p fl" for="tel_num">动态码</label>
                        <input type="text" name="con_send" id="con_send" class="fl verifi_code" placeholder="请输入动态验证码">
                    </span>
                    <span class = "fl"><input value="发送动态码" class="fl send_code" type="submit" id = "send_code"></span>
                </div>

                <div class="button line_div">
                    <button type="submit" id="save">验证手机号</button>
                </div>
            </form>
            <!--广告-->
            <p class="ad_sefity">
                <img src="<?php echo $this->config->item('resources_url')."/resources/images/user/ad_sefity.jpg"?>">
            </p>
        </div>
    </div>

    <!--底部-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script>
    //    加载图片验证码
    var change_image;
    $("#change_img").on("click",function(){
            change_image( $("#img_code"));
    });
    $("#img_code").on("click",function(){
        change_image( $("#img_code"));
    });
    change_image = function(obj){
            $.ajax({
                type:"POST",
                url:"/user/asy_get_code",
                async:true,//是否是异步
                cache: false,//是否带缓存
                dataType:"json",
                success: function(data){
                    if(data.success) {
                       obj.attr("src",data.message);
                    }else {
                        showMsg(data.message)
                    }
                },
                error:function(data){
                    showMsg("网络错误")
                }
            });
    };
    $.validator.setDefaults({
        submitHandler: function() {
            //提交
            var json_data={
                "Mobile":$("#con_p").val(),
                "Code_phone":$("#con_send").val()
            };
            console.log(json_data);
            $.ajax({
                type:"POST",
                url:"/user/asy_submit_phone_modify",
                async:true,//是否是异步
                cache: false,//是否带缓存
                dataType:"json",
                data:json_data,
                success: function(res){
                    if(res.success) {
                        window.history.go(-1);
                    }else {
                        showMsg(res.message);
                    }
                },
                error:function(res){
                    showMsg(res.message);
                }
            });
        }
    });
    //获取手机短信验证码
    var on_codeImg = true,timer;
    $("#send_code").on("click",function(){
        //给php传的数据
        var json_data={"mobile":$("#con_p").val(), "inputcode":$("#new_p").val(),"type":"4"};
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
                    console.log(res);
                    if(res.success) {
                        var time = 60;
                        timer = setInterval(function () {
                            time--;
                            $("#send_code").val(time + "s后重发");
                            if (time == 0) {
                                clearInterval(timer);
                                $("#send_code").val("重新发送");
                                on_codeImg = true;
                            }
                        }, 1000)
                    }else {
                        if(res.message == "验证码错误"){
                            $("#error").show();
                        }
                        if(res.message == "缺少必须的请求数据"){
                            $("#error").hide();
                            showMsg(res.message)
                        }
                        on_codeImg = true;
                    }
                },
                error:function(res){
                    showMsg("网络错误")
                    on_codeImg = true;
                }
            });
        }

    })
    // 手机号码验证asy_phone_code
    jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请正确填写您的手机号码");
    $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
        $("#signupForm").validate({
            rules: {
                con_p: {
                    required: true,
                    digits:true,
                    minlength:11,
                    maxlength:11,
                    isMobile:true
                },
                new_p:"required",
                con_send: "required"
            },
            messages: {
                con_p : {
                    required : "请输入手机号",
                    minlength : "确认手机不能小于11个字符",
                    maxlength:"确认手机不能大于11个字符",
                    digits: "请正确填写您的手机号码",
                    isMobile : "请正确填写您的手机号码"
                },
                new_p: "请输入验证码",
                con_send: "请输入动态码"
            }
        });
    });
</script>
</body>
</html>
