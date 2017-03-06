$(function () {
    //手机号校验
    var regMobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
    $("#tel_num").blur(function () {
        if (!regMobile.test($(this).val())) {
            $("#phone_error").css("display", "block");
        } else {
            $("#phone_error").css("display", "none");
        }
    });
    //新密码强弱校验
    $("#new_p").blur(function () {
        if ($(this).val() == "") {
            $("#password_error").css("display", "block");
        } else {
            $("#password_error").css("display", "none");
        }
    });
    function checkStrong(el) {
        var sValue = $(el).val();
        console.log(sValue.length);
        var modes = 0;
        //正则表达式验证符合要求的
        if (sValue.length < 8) return 0;
        if (/\d/.test(sValue)) modes++; //数字
        if (/[a-z]/.test(sValue)) modes++; //小写
        if (/[A-Z]/.test(sValue)) modes++; //大写
        if (/\W/.test(sValue)) modes++; //特殊字符
        if(sValue.length >15) return 3;
        return  modes;}
    $("#new_p,#con_p").keyup(function () {
        var modes=checkStrong(this);
        console.log(modes);
        switch (modes) {
            case 0:
                $(this).siblings(".password").addClass("passlow").removeClass("passmiddle").removeClass("passhigh");
                break;
            case 1:
                $(this).siblings(".password").addClass("passlow").removeClass("passmiddle").removeClass("passhigh");
                break;
            case 2:
                $(this).siblings(".password").addClass("passmiddle").removeClass("passhigh");
                break;
            case 3:
                $(this).siblings(".password").addClass("passhigh");
                break;
        }
    });

    //确认密码
    $("#con_p").blur(function () {
        if ($(this).val() != $("#new_p").val() || $(this).val() == "") {
            $("#confirm_error").css("display", "block");
        } else {
            $("#confirm_error").css("display", "none");
        }
    });
    //验证码校验
    $("#confirmation_code").blur(function () {
        if ($(this).val() == "") {
            $("#confirmation_error").css("display", "block");
        } else {
            $("#confirmation_error").css("display", "none");
        }
    });
    var refreshVerifyImg = function () {
        $.ajax({
            type: "POST",
            url: "/user/asy_get_code",
            async: true,//是否是异步
            cache: false,//是否带缓存
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    $(".confirmation_png img").attr("src", res.message)
                } else {
                    alert("网络错误！");
                }
            },
            error: function (res) {
                alert("网络错误")
            }
        });
    };
    //点击刷新图形验证码
    $("#verify_img").on("click", refreshVerifyImg);
    $('#verify_img').siblings('.confirmation_png').find('img').on("click", refreshVerifyImg);
    //获取短信动态码
    var on_codeImg = true, timer;
    $(".get_confirmation_code").on("click", function () {
        //给php传的数据
        var json_data = {
            "mobile": $("#tel_num").val(),
            "inputcode": $("#confirmation_code").val(),
            "type": "3"
        };
        if (on_codeImg) {
            on_codeImg = false;
            $.ajax({
                type: "POST",
                url: "/user/asy_get_sms",
                async: true,//是否是异步
                data: json_data,
                cache: false,//是否带缓存
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    if (res.success) {
                        var time = 60;
                        timer = setInterval(function () {
                            time--;
                            $(".get_confirmation_code").html(time + "s后重发").css("cursor", "default");
                            if (time == 0) {
                                clearInterval(timer);
                                $(".get_confirmation_code").html("重新发送").css("cursor", "pointer");
                                on_codeImg = true;
                            }
                        }, 1000)
                    } else {
                        $("#confirmation_error").html(res.message).css("display", "block");
                        on_codeImg = true;
                    }
                },
                error: function (res) {
                    alert("网络错误");
                    on_codeImg = true;
                }
            });
        }
    });
    //动态短信校验
    $("#dynamic_code").blur(function () {
        if ($(this).val() == "") {
            $("#code_error").css("display", "block");
        } else {
            $("#code_error").css("display", "none");
        }
    });


    //点击提交按钮也需要校验所有的input
    $("#submit").on("click", function () {
        if ($("#dynamic_code").val() == "") {
            $("#code_error").css("display", "block");
            $("#dynamic_code").focus();
        }
        if ($("#confirmation_code").val() == "") {
            $("#confirmation_error").css("display", "block");
            $("#confirmation_code").focus();
        }
        if ($("#con_p").val() == "") {
            $("#confirm_error").css("display", "block");
            $("#con_p").focus();
        }
        if ($("#new_p").val() == "") {
            $("#password_error").css("display", "block");
            $("#new_p").focus();
        }
        if ($("#phone_error").css("display") == "none" && $("#password_error").css("display") == "none" && $("#confirm_error").css("display") == "none" && $("#confirmation_error").css("display") == "none" && $("#code_error").css("display") == "none") {
            var json_data = {
                "username": $("#tel_num").val(),
                "password": $("#new_p").val(),
                "smcode": $("#dynamic_code").val()
            };
            $.ajax({
                type: "POST",
                url: "/user/submit_forget_password",
                async: true,//是否是异步
                cache: false,//是否带缓存
                dataType: "json",
                data: json_data,
                success: function (res) {
                    if (res.success) {
                        window.location.href = "/user/success"
                    } else {
                        console.log(res.message);
                        if (res.message == "短信验证码错误") {
                            $("#code_error").html("短信验证码错误").css("display", "block");
                        }
                    }
                },
                error: function (res) {
                    alert("网络错误")
                }
            });
        }
    })
});