//表单提交
$.validator.setDefaults({
  submitHandler: function() {

    console.log("触发点击")
    var json_data={
      "password":$("#password").val(),
      "new_p":$("#new_p").val()
    };
    console.log($("#password").val())
    $.ajax({
      type:"POST",
      url:"/user/asy_modify_password",
      async:true,//是否是异步
      cache: false,//是否带缓存
      dataType:"json",
      data:json_data,
      success: function(res){
        if(res.success) {
          window.location.href = "/user/success"
        }else {
          showMsg("密码错误")
        }
      },
      error:function(res){
        showMsg("网络错误")
      }
    });
  }
});

console.log($("#password").val())
$().ready(function() {
  //密码强弱
  $(".password_n").each(function(i) {
    $(".password_n").eq(i).on("keyup", function () {
      checkStrong($(this).val(), i);
    })
  })
  function checkStrong(sValue,n) {
    var modes = 0;
    var n ;
    //正则表达式验证符合要求的
    if (sValue.length < 6 || sValue.length > 15){
      $(".password_class").eq(n).removeClass("passlow").removeClass("passmiddle").removeClass("passhigh");
    };
    if (/\d/.test(sValue) && sValue.length > 5 ) modes++; //数字
    if (/[a-z]/.test(sValue) && sValue.length > 5 ) modes++; //小写
    if (/[A-Z]/.test(sValue) && sValue.length > 5 ) modes++; //大写
    if (/\W/.test(sValue) && sValue.length > 5 ) modes++; //特殊字符
    //逻辑处理
    switch (modes) {
      case 1:
        $(".password_class").eq(n).addClass("passlow").removeClass("passmiddle").removeClass("passhigh");
        break;
      case 2:
        $(".password_class").eq(n).addClass("passmiddle").removeClass("passhigh");
        break;
      case 3:
        $(".password_class").eq(n).addClass("passhigh");
        break;
    }
  }

  // 在键盘按下并释放及提交后验证提交表单
  $("#modifyPassword").validate({
    rules: {
      password: {
        required: true,
        minlength:6,
        maxlength:15
      },
      new_p: {
        required: true,
        minlength:6,
        maxlength:15
      },
      confirm_password: {
        required: true,
        equalTo: "#new_p"
      }
    },
    messages: {
      password: {
        required: "请输入6-15位密码",
        minlength: "密码长度不能小于6个字母",
        maxlength:"密码长度不能大于15个字母"
      },
      new_p: {
        required: "请输入6-15位密码",
        minlength: "密码长度不能小于6个字母",
        maxlength:"密码长度不能大于15个字母"
      },
      confirm_password: {
        required: "请输入确认密码",
        equalTo: "两次密码输入不一致"
      }
    }
  });
});
