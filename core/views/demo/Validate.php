<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../../../resources/css/base.css">
  <style type="text/css" rel="stylesheet">
    .lg_bd {
      width: 980px;
      margin:0 auto;
      position: relative;
      z-index: 10;
      padding: 0 10px 50px;
    }
    .lg_loginwrap {
      width: 574px
      min-height: 420px;
      _height: 420px;
      margin:0 auto;
      border-radius: 5px 5px 0 0;
    }

    .lg_loginbox {
      border: 1px solid #afd0f1;
      border-radius: 5px 5px 0 0;
      background-color: #fff;
    }
    .lg_loginbox {
      border-radius: 0;
    }
    .lg_loginbox_title {
      margin: 0 29px 15px;
      padding: 15px 0 10px;
      font: normal 16px "microsoft yahei";
      border-bottom: 1px solid #D8E8F8;
    }
    .lg_loginbox_title span {
      float: right;
      margin-top: 3px;
      font: 12px arial,simsun;
    }
    .lg_select {
      padding-left: 104px;
    }
    .index_label {
      font-size: 12px;
      cursor: pointer;
      border-bottom: 1px dashed #fff;
    }
    .lg_select .index_label {
      margin-right: 20px;
    }
    .index_label input {
      margin-right: 5px;
      vertical-align: -2px;
    }
    .lg_loginbox_form {
      margin-top: 10px;
      padding: 0 0 5px 30px;
    }
    .lg_loginbox_form li {
      padding-bottom: 16px;
      font-family: "Microsoft YaHei", SimSun,sans-serif;
      font-size: 16px;
      clear: both;
      position: relative;
    }
    .lg_loginbox_form li .tt {
      display: inline-block;
      width: 65px;
      text-align: right;
      font-size: 14px;
      font-weight: normal;
    }
    .lg_input {
      width: 188px;
      padding-left: 3px;
      margin-left: 10px;
      border-color: #bbb #ddd #ddd #bbb;
      border-style: solid;
      border-width: 1px;
      height: 28px;
      font: 14px/28px "Microsoft YaHei", SimSun, Tahoma, Verdana, Arial, sans-serif;
      outline: none;
      color: #333;
      box-shadow: 1px 1px 1px #ddd inset;
    }
    .lg_loginbox_form li a {
      font-size: 12px;
      font-family: Tahoma;
    }
    .lg_loginbox_form .lg_forget_pwd {
      /*  margin-left: 10px;
        vertical-align: middle;*/
    }
    .lg_loginbox_form .lg_forget_pwd {
      margin-left: 10px;
    }
    .lg_loginbox_form .lg_login_code {
      width: 90px;
      margin-right: 10px;
    }
    .lg_loginbox_form .lg_login_code_img {
      width: 88px;
      height: 35px;
      vertical-align: -11px;
      cursor: pointer;
      position: absolute;
      top: -2px;
      left: 185px;
    }
    .base_error_wrap {
      margin: -8px 0 0 75px;
      font-family: Tahoma;
    }
    .base_error {
      border: 1px solid #ffb533;
      padding: 2px 0 2px 26px;
      background-color: #fff5d1;
      font-size: 12px;
    }
    .base_error_wrap .base_error {
      width: 165px;
    }
    .base_error i {
      float: left;
      width: 16px;
      height: 16px;
      margin-left: -21px;
      margin-top: 1px;
      background-position: 0 -192px;
    }
    .lg_index_label {
      margin-left: 27px;
      padding-left: 3em;
      font-family: simsun,sans-serif;
    }
    .s_btn, .s_btn_disabled {
      width: 191px;
      height: 33px;
      color: #fff;
      font-size: 16px;
      font-family: "Microsoft YaHei", SimSun, Tahoma, Verdana, Arial, sans-serif;
      font-weight: bold;
      cursor: pointer;
      text-align: center;
      letter-spacing: 0.4em;
      box-shadow: 0 1px 0 rgba(95,50,0,0.7);
      border-radius: 3px;
      clear: both;
    }
    .s_btn {
      text-shadow: 1px 1px 0 #45CC0C;
      background-color: #33cc00;
      border: solid 1px #5ECC56;
    }
    input[type="button"], input[type="submit"] {
      -webkit-appearance: none;
    }
    .ico {
      display: inline-block;
      overflow: hidden;
      vertical-align: middle;
      width: 16px;
      height: 16px;
      font-family: Tahoma, Arial, 'Hiragino Sans GB', \5b8b\4f53, sans-serif;
      font-style: normal;
    }
    .help_error .ico_error_s {
      position: absolute;
      left: 0;
      top: 6px;
    }
    .ico_error_s {
      width: 12px;
      height: 12px;
      background-position: -50px -75px;
    }

    .help_error_block, .help_error_inline,.help_right_block, .help_right_inline{
      clear: both;
      position: relative;
      text-align: left;
      _margin-left: 3px;
      color: #d80000;
      line-height: 22px;
      padding-left: 16px;
      margin-right: 10px;
      font-size: 12px;
    }
    .help_right_block, .help_right_inline{
      color:#33cc00
    }
    .help_error_block,.help_right_block{
      display:block;
      padding-left: 80px;
    }
  </style>
</head>
<body>
  <form name="Form1" method="post" action="" id="form">
  <div class="lg-bd">
    <div class="lg_loginwrap">
      <div class="lg_loginbox" id="memberlogin">
        <h2 class="lg_loginbox_title">
                              <span>
                                   没有亚程账户,<a href="" id="register">立即注册</a>
                              </span>
          会员登录
        </h2>
        <div class="lg_select">
          <label class="index_label" id="domUser">
            <input type="radio" name="1" checked="checked">普通登录
          </label>
          <label class="index_label" id="phonePwd">
            <input type="radio" name="1" checked="checked">手机动态码登录
          </label>
        </div>
        <ul class="lg_loginbox_form" style="display: block;" id="domUserUl">
          <li>
            <label class="tt">登录名</label><input name="info[txtUserName]" type="text" maxlength="60" id="txtUserName" class="lg_input" mod="notice" mod_notice_tip="用户名/卡号/手机/邮箱" style="color: gray;">
          </li>
          <li><label class="tt">密　码</label><input name="info[txtPwd]" type="password" maxlength="20" id="txtPwd" class="lg_input" onpaste="return false;" oncontextmenu="return false;" oncopy="return false;" oncut="return false;"></li>
          <li><label class="tt">确认密码</label><input name="info[confirmPwd]" type="password" maxlength="20" id="confirmPwd" class="lg_input" onpaste="return false;" oncontextmenu="return false;" oncopy="return false;" oncut="return false;"></li>
          <li id="divVerifyCode" style="display:block"><label class="tt">验证码</label><input type="text" mod="notice" class="lg_input lg_login_code" name="info[txtCode]" id="txtCode" mod_notice_tip="不区分大小写" value="" style="color: gray;"><img src="images/pic_verificationcode.gif" class="lg_login_code_img" id="imgCode"><a href="javascript:void(0);" id="changeNext" title="看不清?" style="display:none;">换一张</a></li>
          <li class="lg_pr">
            <div class="lg_index_label"><label class="index_label"><span title="30天内自动登录"><input id="chkAutoLogin" type="checkbox" name="chkAutoLogin" checked="checked"><label for="chkAutoLogin">30天内自动登录</label></span></label><a href="https://accounts.ctrip.com/member/PassWord/VerifyUserInfo.aspx" id="forgetPwd" tabindex="-1" class="lg_forget_pwd">忘记密码?</a></div>
          </li>
          <li><div class="lg_index_label"><input type="submit" name="btnSubmit" value="登录" id="btnSubmit" class="s_btn"></div></li>
        </ul>
      </div>
      <div class="lg_loginbox" id="commonlogin"></div>
    </div>
    <div class="lg_bd_pic"></div>
  </div>
</form>
</body>
<script type="text/javascript" src="../../../resources/js/lib/jquery.js"></script>
<script type="text/javascript" src="../../../resources/js/plugin/validate.js"></script>
<script>
  $(function () {
    /*添加自定义验证规则*/
    var rules = {
      "coupon_amount": [/^0.([1-9]){1,2}$/, "必须为0.85这样的数字"]
    };
    $.checkFormHandler.addRules(rules);
    /*验证参数解释*/
    var items_array = [
      {
        name: "info[txtUserName]",                              /*input的name*/
        type: "username",                                       /*input内容的类型，不同的类型调用不同的规则去检测*/
        simple: "用户名",                                        /*当没有填内容时的默认提示内容*/
        message: "用户名格式错误",                              /*不符合规范的提示文字*/
        focusMsg: '数字和英文及下划线和.的组合,4-20个字符', /*输入框在获得焦点时的提示文字*/
        tp:0                                                       /*0：提示文字在右侧， 1 提示文字在左侧*/
      },
      {
        name: "info[txtPwd]",
        type: 'password',
        simple: "密码",
        message: "密码格式错误!",
        focusMsg: '最小长度:6 最大长度:16',
        tp: 0
      },
      {
        name: "info[confirmPwd]",
        type: 'password',
        to:"txtPwd",                                          /*to后的字符串是定义该输入框和另一个input的nmme[X]后的值比较，只有一样时才通过验证*/
        simple: "确认密码",
        message: "密码不一致!",
        focusMsg: '最小长度:6 最大长度:16',
        tp: 0
      },
      {
        name: "info[txtCode]",
        simple: "验证码",
        type: "empty",
        message: "请输入正确验证码!",
        focusMsg: '',
        tp:1
      }
    ];

    $("#form").checkFormHandler({
      items: items_array
    });
  });


</script>
</html>