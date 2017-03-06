<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= $this->config->item("resources_url")?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?= $this->config->item("resources_url")?>/resources/css/base.css">
    <link rel="stylesheet" href="<?= $this->config->item("resources_url")?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?= $this->config->item("resources_url")?>/resources/css/user/per_ct.css">
    <link rel="stylesheet" href="<?= $this->config->item("resources_url")?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?= $this->config->item("resources_url")?>/resources/css/user/modify_password_by_phone.css">
</head>
<body>
<div class="all">
    <?= $header; ?>
    <!--内容-->
    <div class="contents clearfix">
        <!--左边菜单列表-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part list_information fr" input-prompt modify_password_by_phone>
            <div class="fp_wrap">
                <div class="part_title clearfix">
                    <i></i><span>修改密码</span>
                    <a class="modify_password" href="/user/modify_password">使用旧密码修改</a>
                </div>
                <div class="line_div clearfix">
                    <div class="clearfix">
                        <label class="pre_f fl">手机号</label>
                        <?= number_handler($user_info->mobile, 9); ?>
                        <input type="hidden" name="tel_num" id="tel_num" value="<?= $user_info->mobile ?>">
                    </div>
                    <label id="phone_error" class="error">请输入11位手机号</label>
                </div>
                <div class="line_div" password>
                    <div class="clearfix">
                        <label class="pre_f new_p fl">新密码</label>
                        <input type="password" name="new_p" id="new_p" class="fl" placeholder="6-15位密码">
                        <div class="password fl">
                            <span class="low">低</span>
                            <span class="middle">中</span>
                            <span class="high">高</span>
                        </div>
                    </div>
                    <label id="password_error" class="error" style="">请输6-15位新密码</label>
                </div>
                <div class="line_div" password>
                    <div class="clearfix">
                        <label class="pre_f con_p fl">确认密码</label>
                        <input type="password" name="con_p" id="con_p" class="fl" placeholder="6-15位密码">
                        <div class="password fl">
                            <span class="low">低</span>
                            <span class="middle">中</span>
                            <span class="high">高</span>
                        </div>
                    </div>
                    <label id="confirm_error" class="error" style="">请输确认密码</label>
                </div>
                <div class="line_div">
                    <div class=" clearfix">
                        <label class="pre_f fl">验证码</label>
                        <input name="confirmation_code" class="m_log fl" type="text" placeholder="请输入验证码"
                               id="confirmation_code">
                        <p class="confirmation_png s_log fl">
                            <img src="<?= $code_image_url ?>">
                        </p>
                        <a href="javascript:;" id="verify_img" class="fl">换一张 </a>
                    </div>
                    <label id="confirmation_error" class="error">请输入验证码</label>
                </div>
                <div class="line_div">
                    <div class="clearfix">
                        <label class="pre_f fl">动态码</label>
                        <input type="text" name="dynamic_code" class="m_log fl" placeholder="请输入动态码" id="dynamic_code">
                        <p class="get_confirmation_code s_log fl">发送动态码</p>
                    </div>
                    <label id="code_error" class="error">请输入动态码</label>
                </div>
                <div class="button line_div">
                    <button id="submit">提交</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
    <script type="text/javascript" src="<?= $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
    <script type="text/javascript" src="<?= $this->config->item('resources_url') ?>/resources/js/plugin/jAlert.js"></script>
    <script type="text/javascript" src="<?= $this->config->item('resources_url') ?>/resources/js/user/modify_password_by_phone.js"></script>
</body>
</html>


