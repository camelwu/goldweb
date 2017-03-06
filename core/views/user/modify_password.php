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
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/per_ct.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/menu_list.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url") ?>/resources/css/assembly.css">
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
    <div class="right_part list_information fr" reset_password modify_password>
      <div class="list_b_title"><i></i>修改密码<a class="photo_modify" href="/user/modify_password_by_phone">手机验证码修改</a></div>
      <form id="modifyPassword" input-prompt>
        <div class="line_div clearfix">
          <label class="pre_f con_p fl">当前密码</label>
          <input type="password" name="password" id="password" class="fl" placeholder="6-15位密码" required>
        </div>
        <div class="line_div clearfix">
          <label class="pre_f new_p fl" for="tel_num">新密码</label>
          <input type="password" name="new_p" id="new_p" class="password_n fl" placeholder="6-15位密码" required>
          <div class="password_class fl">
            <span class="low">低</span>
            <span class="middle">中</span>
            <span class="high">高</span>
          </div>
        </div>
        <div class="line_div clearfix">
          <label class="pre_f con_p fl" for="tel_num">确认密码</label>
          <input type="password" name="confirm_password" id="confirm_password" class="password_n fl" placeholder="6-16位密码" required>
          <div class="password_class fl">
            <span class="low">低</span>
            <span class="middle">中</span>
            <span class="high">高</span>
          </div>
        </div>

        <div class="button line_div">
          <button type="submit" id="save">保存</button>
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
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/user/modify_password.js"></script>

</body>
</html>
