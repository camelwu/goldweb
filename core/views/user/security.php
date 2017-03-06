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
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/assembly.css">
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/user/security.css">
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
    <div class="right_part list_information fr" security password>
      <div class="list_b_title"><i></i>账户安全</div>
      <div class="security">
        <div class="security_t">
          <p class="leave fl">安全等级：
            <?php if($data->data->passwordGrade==3):?>
            <span>高</span>
            <?php elseif($data->data->passwordGrade==2):?>
              <span>中</span>
            <?php else:?>
              <span>低</span>
            <?php endif;?></p>
<!--          <p class="before fl">上次登录：<span>2016-07-14  14:20</span></p>-->
        </div>
        <div class="security_font clearfix">
          <i class="icon fl"></i>
          <span class="word fl">登录密码</span>
          <?php if($data->data->passwordGrade==3):?>
          <div class="password fl passhigh">密码安全：<span class="low">低</span><span class="middle">中</span><span class="high">高</span></div>
          <?php elseif($data->data->passwordGrade==2):?>
            <div class="password fl passmiddle">密码安全：<span class="low">低</span><span class="middle">中</span><span class="high">高</span></div>
          <?php else:?>
            <div class="password fl passlow">密码安全：<span class="low">低</span><span class="middle">中</span><span class="high">高</span></div>
          <?php endif;?>
          <p class="href fr"><a href="/user/modify_password">修改密码</a></p>
        </div>
        <div class="security_font clearfix">
          <i class="icon fl"></i>
          <span class="word fl">手机验证</span>
          <p class="fl phone_color">手机<?php echo substr_replace($this->user_info->mobile,"****",3,4);?>已通过验证</p>
          <p class="href fr"><a href="/user/modify_phone">更改手机</a></p>
        </div>
      </div>
      <!--广告-->
      <p class="ad_sefity"><img src="<?php echo $this->config->item('resources_url')."/resources/images/user/ad_sefity.jpg"?>"> </p>
    </div>
  </div>

  <!--底部-->
  <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item("resources_url")?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>
