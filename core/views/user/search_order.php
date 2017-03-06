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
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/per_ct.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/not_find_info.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list_phone.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/o_travellers_list.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <div class="contents clearfix">
        <!--        左边菜单栏-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part list_information fr" order_lists>
            <form order_phone>
                <dl class="order_phone clearfix" input-prompt>
                    <dt class = "order_num"><i></i>手机号查单</dt>
                    <dd><span>手机号</span><input class = "public order_phone_num" type="text" id = "phone"  value="<?php echo  $this->user_info->mobile;?>" placeholder="请输入手机号"></dd>
                    <dd class = "order_warm"><span>验证码</span><input class = "public" type="text" id = "img_code" placeholder="请输入验证码"></dd><dd class = "order_code"  id="changeImage" ><span class=" order_code_img"><img src="<?php echo $code_image_url?>" id = "change_img"></span><span class = "order_code_change">换一张</span></dd>
                    <dd class="order_line"></dd>
                    <dd class = "order_warm"><span>动态码</span><input class = "public" type="text" id = "code_phone" placeholder="请输入短信码"></dd><dd class = "order_code clearfix" btn-default><span class = "order_code_num" id = "send_code">发送动态码</span><input class="btn btn1_hover cur" type="button" value="搜索" id = "submit"></dd>
                </dl>
            </form>
            <div id="order_list" traveller_lists not_find_wrap>
            <?php echo $order_list; ?>
            </div>
        </div>
    </div>
    <!--底部-->
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
<script>
    $("#changeImage").on("click",function(){
        $.ajax({
            type:"POST",
            url:"/user/asy_get_code",
            async:true,//是否是异步
            cache: false,//是否带缓存
            dataType:"json",
            success: function(data){
                if(data.success) {
                    $("#change_img").attr("src",data.message)
                }else {
                    showMsg("网络错误")
                }
            },
            error:function(data){
                showMsg("网络错误")
            }
        });
    });
    //获取手机短信验证码
    var on_codeImg = true,timer;
    $("#send_code").on("click",function(){
        //给php传的数据
        var json_data={"mobile":$("#phone").val(), "inputcode":$("#img_code").val(),"type":"6"};
        if($("#img_code").val()==""){ showMsg("图形验证码不能为空！");return;}
        if(on_codeImg) {
            on_codeImg = false;
            $.ajax({
                type:"post",
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
                            $("#send_code").html(time + "s后重发");
                            if (time == 0) {
                                clearInterval(timer);
                                $("#send_code").html("重新发送");
                                onoff = true;
                            }
                        }, 1000)
                    }else {
                        showMsg(res.message);
                        on_codeImg=true;
                    }
                },
                error:function(res){
                    showMsg("网络错误");
                    on_codeImg=true;
                }
            });
        }

    })
    $("#submit").on("click",function(){
            var json_data = {"MobilePhone":$("#phone").val(),"SmsCode":$("#code_phone").val()};
            console.log(json_data);
            $.ajax({
                type:"POST",
                url:"/user/asy_code_phone_list",
                async:true,//是否是异步
                cache: false,//是否带缓存
                dataType:"json",
                data:json_data,

                success: function(data){
                    var str = "";
                    if(data.success) {
                        $("#order_list").child().replace(data.message);
                    }else {
                        showMsg(res.message)
                    }
                },
                error:function(data){
                    showMsg("网络错误")
                }
            });
    });
</script>
</body>
</html>
