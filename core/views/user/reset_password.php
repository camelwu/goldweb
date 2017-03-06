<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php $this->config->item('resources_url')?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php $this->config->item('resources_url')?>/resources/css/user/reset_password.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <!--内容-->
    <div class="contents clearfix" reset_password>
        <div class="fp_wrap amb">
            <div class="part_title clearfix"><i></i><span>重置密码</span></div>
            <form name="info_form">
                <div class="line_div clearfix">
                    <label class="pre_f new_p fl" for="tel_num">新密码</label><input type="text" name="new_p" id="new_p" class="fl" placeholder="8-16位密码">
                    <div class="password_class fl"><span class="low">低</span><span class="middle">中</span><span class="high">高</span></div>
                </div>
                <div class="line_div clearfix"><label class="pre_f con_p fl" for="tel_num">确认密码</label><input type="text" name="con_p" id="con_p" class="fl" placeholder="8-16位密码"></div>

                <div class="button line_div">
                    <button type="submit" id="save"><a href="/user/login">保存</a></button>
                </div>
            </form>
        </div>
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>


