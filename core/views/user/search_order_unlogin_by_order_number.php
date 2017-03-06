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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/order_list_login.css">
</head>
<body>
    <div class="all">
        <?php echo $header; ?>
        <div class="contents">
            <div class = "login_content" order_title>
                <div class="login_title"><a href= "/user/search_order?type=0"><i class = "icon "></i>用手机号查询</a><a  href= "/user/search_order?type=1" class = span_cur"><i class = "icon icon_cur"></i>订单号查询</a></div>
            </div>
            <form login id = "signupForm" method="get" >
                <ul input-prompt class = "login_list">
                    <li><span>订单号</span><input class="public" type="order" name="order" placeholder="请输入订单号" id="order"></li>
                    <li><span>手机号</span><input class="public" type="phone" name="phone" placeholder="请输入下单手机号" id="phone"></li>
                    <li class = "code_title"><span>验证码</span><input class="public code" type="agree" name = "agree" placeholder="请输入验证码" id="verfica"></li>
                    <li class = "code_warn"><span class = "v_code"><img src="<?php echo $code_image_url?>" id = "change_img"></span><span id = "changeImage" class = "icon_submit">换一张</span></li>
                    <li  btn-default><input class="btn btn1_hover cur" type="submit" value="提交"></li>
                </ul>
            </form>
        </div>

        <!--底部-->
        <?php echo $footer; ?>
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
                    showMsg("网络错误！");
                }
            },
            error:function(data){
                debugger;
                showMsg("网络错误")
            }
        });
    })


</script>
<script>
    $.validator.setDefaults({
        submitHandler: function() {
            window.location.href = ""
        }
    });
    $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
        $("#signupForm").validate({
            rules: {
                order: "required",
                phone: {
                    required: true,
                    digits:true,
                    minlength:11,
                    maxlength:11,
                    isMobile:true
                },
                active: "required"
            },
            messages: {
                order: "请输入订单号",
                phone : {
                    required : "请输入手机号",
                    minlength : "确认手机不能小于11个字符",
                    maxlength:"确认手机不能大于11个字符",
                    digits: "请正确填写您的手机号码",
                    isMobile : "请正确填写您的手机号码"
                },
                active: "请输入动态码"
            }
        });
    });
</script>
</body>
</html>
