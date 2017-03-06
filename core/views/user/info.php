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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/per_ct.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/menu_list.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/user_info.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <!--内容-->
    <div class="contents clearfix">
        <!--左边菜单列表-->
        <div class="left_part fl">
            <?php echo $menu_list; ?>
        </div>
        <!--右边内容-->
        <div class="right_part fr apt amb">
            <div class="part_title clearfix"><i></i><span>我的信息</span></div>
            <div class="part_content clearfix">
                <div class="img_wrap fl">
                    <div class="img_p">
                        <a href="/user/change_head"><img src="<?php echo $memberData[0]->bigHeadImageUrl==""?$this->config->item('resources_url')."/resources/images/header.png":$memberData[0]->bigHeadImageUrl?>"?> /></a>
                        <div class="shadow_bg"><a href="/user/change_head">修改头像</a> </div>
                    </div>
                </div>
                <div class="form_zone fr" user_info>
                    <form name="infoForm" id="infoForm">
                        <div class="line_div clearfix"><label class="pre_f fl" for="nick_name" is_cache>昵称</label>
                            <p class="fl"><input type="text" name="p_name" id="nick_name" value="<?php echo $memberData[0]->nickName; ?>" placeholder="输入您的昵称" /></p>
                        </div>
                        <div style="display:none" class="line_div clearfix"><label class="pre_f fl" for="first_last_name" is_cache>姓名</label>
                            <p class="fl"><input type="text" name="first_last_name" placeholder="中文/英文"  value="<?php echo $memberData[0]->firstName; ?>" id="first_last_name" is_cache /></p>
                        </div>
                        <div class="line_div clearfix">
                            <span class="pre_f fl">性别</span>
                            <div class="six_type fl">
                                <p>
                                    <?php if($memberData[0]->salutation==26):?>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex checked" value="26">男</label>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex"  value="27">女</label>
                                    <?php elseif($memberData[0]->salutation==27):?>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex" value="26">男</label>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex checked"  value="27">女</label>
                                     <?php else:?>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex checked" value="26">男</label>
                                        <input name="six_type" type="radio"/>
                                        <label class="sex" value="27">女</label>
                                    <?php endif;?>
                                </p>
                            </div>
                        </div>
                        <div class="line_div b_d_d clearfix">
                            <span class="pre_f fl">生日</span>
                            <div class="birthday_y pr fl clearfix">
                                <i></i>
                                <p class="fl"><input type="text" name="birthday_y" class="s_in" value="<?php echo string_cut($memberData[0]->dateOfBirth,0,4); ?>" readonly="readonly"/></p>
                                <ul class="select_ul year"></ul>
                            </div>
                            <span class="md fl">年</span>
                            <div class="birthday_m  pr fl clearfix">
                                <i></i>
                                <p class="fl"><input type="text" name="birthday_m"  class="s_in"  value="<?php echo string_cut($memberData[0]->dateOfBirth,5,2); ?>" readonly="readonly"/></p>
                                <ul class="select_ul month"></ul>
                            </div>
                            <span class="md fl">月</span>
                            <div class="birthday_d pr fl clearfix">
                                <i></i>
                                <p class="fl"><input type="text" name="birthday_d"  class="s_in" value="<?php echo string_cut($memberData[0]->dateOfBirth,8,2); ?>" readonly="readonly"/></p>
                                <ul class="select_ul day"></ul>
                            </div>
                            <span class="ml fl">日</span>
                        </div>
                        <div class="tel_line line_div">
                            <div class="line_div clearfix"><label class="pre_f fl" for="mobileNo">手机号</label>
                                <p class="fl"><input type="text" name="mobile_no" id="mobile_no" class="mobileNo" value="<?php echo substr_replace($memberData[0]->mobileNo,"****",3,4);?>" /><a href="/user/modify_phone" class="ml">修改</a></p>
                            </div>
                        </div>
                        <div class="button line_div">
                            <button type="submit">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/user_info.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
</body>
</html>


