    //    加载图片验证码
$("#changeImage").on("click",function(){
    $.ajax({
        type:"POST",
        url:"/user/asy_get_code",
        async:true,//是否是异步
        cache: false,//是否带缓存
        dataType:"json",
        success: function(data){
            if(data.success) {
                $("#change_img").attr("src",data.message);
            }else {
                showMsg("网络错误！");
            }
        },
        error:function(data){
            debugger;
            showMsg("网络错误")
        }
    });
});
//获取手机短信验证码
var on_codeImg = true,timer;
$("#send_code").on("click",function(){
    //给php传的数据
    var json_data={"mobile":$("#phone").val(), "inputcode":$("#agree").val(),"type":"6"};
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
                        $("#send_code").html(time + "s后重发");
                        if (time == 0) {
                            clearInterval(timer);
                            $("#send_code").html("重新发送");
                            on_codeImg = true;
                        }
                    }, 1000)
                }else {
                    showMsg(res.message);
                    on_codeImg = true;
                }
            },
            error:function(res){
                showMsg("网络错误")
                on_codeImg = true;
            }
        });
    }

});

var mobilePhone='',code='';
$.validator.setDefaults({
    submitHandler: function() {
        var mobilePhone= $("#phone").val();
        var code=$("#active").val();
        var json = {"MobilePhone":mobilePhone,"SmsCode": code};
        console.log(json);
        $.ajax({
            type:"POST",
            url:"/user/asy_code_no_phone_list",
            async:true,//是否是异步
            data:json,
            cache: false,//是否带缓存
            dataType:"json",
            success: function(data){
                if(data.success) {
                    console.info(data);
                    $("#search").css({"display":"none"});
                    $("#list").css({"display":"block"});
                    $("#list").append(data.message);

                }else {
                    showMsg("网络错误！");
                    console.log(222);
                }
            },
            error:function(data){
                showMsg("网络错误");
                console.log(111)
            }
        });
    }
});

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
            phone: {
                required: true,
                digits:true,
                minlength:11,
                maxlength:11,
                isMobile:true
            },
            agree:"required",
            active: "required"
        },
        messages: {
            phone : {
                required : "请输入手机号",
                minlength : "确认手机不能小于11个字符",
                maxlength:"确认手机不能大于11个字符",
                digits: "请正确填写您的手机号码",
                isMobile : "请正确填写您的手机号码"
            },
            agree: "请输入验证码",
            active: "请输入动态码"
        }
    });

});
    //function isNum(){
    //    $(this).keypress(function (event) {
    //        console.log("gewgff");
    //        var eventObj = event || e;
    //        var keyCode = eventObj.keyCode || eventObj.which;
    //        if (keyCode >= 48 && keyCode <= 57)
    //            return true;
    //        else
    //            return false;
    //    }).focus(function () {
    //        this.val="";
    //    }).bind("paste", function () {//获取剪切板的内容
    //        var clipboard = window.clipboardData.getData("Text");
    //        if (/^\d+$/.test(clipboarreturn))
    //            return true;
    //        else
    //            return false;
    //    });
    //}