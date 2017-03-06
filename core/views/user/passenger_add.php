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
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url')?>/resources/css/user/passenger_add.css">
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
                <div class="form_zone" traveller_info>
                     <?php if(isset($_GET['travellerId'])):?>
                         <form name="travellerForm" id="travellerForm" data-travellerId ="<?php echo $curTraveller->traveller->travellerId ?>">
                             <div class="line_div clearfix"><label class="pre_f fl" for="chinese_name">中文名</label>
                                 <p class="fl"><input type="text" name="chinese_name" id="chinese_name" value="<?php echo $curTraveller->traveller->idName ?>" placeholder="输入您的昵称" /></p><span class="name_tip">中英文必填一项</span>
                             </div>
                             <div class="line_div clearfix"><label class="pre_f fl" for="first_name">英文名</label>
                                 <p class="fl"><input type="text" name="first_name" id="first_name" class="e_f_n" value="<?php echo $curTraveller->traveller->lastName ?>" placeholder="姓(Surname)" /></p>
                                 <p class="fl nml"><input type="text" name="last_name" id="last_name" class="e_l_n" value="<?php echo $curTraveller->traveller->firstName ?>" placeholder="名(Givenname)" /></p>
                                 <span class="name_tip name_tip_p">若护照或港澳通行证存在,英文名必填！</span>
                             </div>
                             <div class="line_div nation clearfix">
                                 <span class="pre_f fl">国籍</span>
                                 <div class="nation_div pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="nationality" class="nationality" value="<?php echo $curTraveller->traveller->countryName ?>"  data-CountryCode="CN" readonly="readonly"/></p>
                                     <ul class="select_ul_nation">
                                         <?php if($nationData->success):?>
                                             <?php foreach($nationData->data as $k => $v): ?>
                                                 <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                             <?php endforeach;?>
                                         <?php endif;?>
                                     </ul>
                                 </div>
                             </div>
                             <div class="line_div clearfix">
                                 <span class="pre_f fl">性别</span>
                                 <div class="six_type fl">
                                     <p>
                                         <?php if($curTraveller->traveller->sexCode == 'Mr'):?>
                                             <input name="six_type" type="radio" value="Mr" checked="checked" />
                                             <label class="sex checked">男</label>
                                             <input name="six_type" type="radio" value="Mrs" />
                                             <label class="sex">女</label>
                                         <?php elseif($curTraveller->traveller->sexCode == 'Mrs'):?>
                                             <input name="six_type" type="radio" value="Mr" />
                                             <label class="sex">男</label>
                                             <input name="six_type" type="radio" value="Mrs" checked="checked" />
                                             <label class="sex checked">女</label>
                                         <?php else:?>
                                             <input name="six_type" type="radio" value="Mr"/>
                                             <label class="sex">男</label>
                                             <input name="six_type" type="radio" value="Mrs"/>
                                             <label class="sex">女</label>
                                         <?php endif;?>
                                     </p>
                                 </div>
                             </div>
                             <div class="line_div b_d_d clearfix">
                                 <span class="pre_f fl">生日</span>
                                 <div class="birthday_y pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_y" class="s_in" value="<?php echo string_cut($curTraveller->traveller->dateOfBirth,0,4); ?>" readonly="readonly"/></p>
                                     <ul class="select_ul year"></ul>
                                 </div>
                                 <span class="md fl">年</span>
                                 <div class="birthday_m  pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_m"  class="s_in"  value="<?php echo string_cut($curTraveller->traveller->dateOfBirth,5,2); ?>" readonly="readonly"/></p>
                                     <ul class="select_ul month"></ul>
                                 </div>
                                 <span class="md fl">月</span>
                                 <div class="birthday_d pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_d"  class="s_in" value="<?php echo string_cut($curTraveller->traveller->dateOfBirth,8,2); ?>" readonly="readonly"/></p>
                                     <ul class="select_ul day"></ul>
                                 </div>
                                 <span class="md fl">日</span>
                             </div>
                             <div class="line_div id_input clearfix">
                                 <span class="pre_f id_span fl">证件</span>
                                 <ul class="traveller_ul">
                                     <?php foreach($curTraveller->listTravellerIdInfo as $k => $v): ?>
                                       <li class="line_div_sub traveller_li clearfix" data-id="<?php echo $v->id;?>" data-index>
                                         <div class="birthday_y pr id_ul nation_div fl clearfix">
                                             <i></i>
                                             <p class="fl"><input type="text" name="id_type" class="id_type" value="<?php echo get_id_type($v->idType);?>" data-pre="id_type" data-value="<?php echo $v->idType;?>" readonly="readonly"/></p>
                                             <ul class="select_ul_id">
                                                 <li class="id_li" data-value="1">护照</li>
                                                 <li class="id_li" data-value="3">身份证</li>
                                                 <li class="id_li" data-value="3">港澳通行证</li>
                                                 <li class="id_li" data-value="4">台胞证</li>
                                                 <li class="id_li" data-value="5">回乡证</li>
                                                 <li class="id_li" data-value="6">台湾通行证</li>
                                                 <li class="id_li" data-value="7">军官证</li>
                                                 <li class="id_li" data-value="8">户口簿</li>
                                                 <li class="id_li" data-value="9">出生证明</li>
                                                 <li class="id_li" data-value="10">其他</li>
                                             </ul>
                                         </div>
                                         <p class="fl dle"><input type="text" name="id_number" class="id_number" data-pre="id_number" value="<?php echo $v->idNumber;?>" placeholder="证件号码" /></p>
                                         <p class="fl dle"><input type="text" name="id_active_time" class="id_active_time" data-pre="id_active_time" value="<?php echo string_cut($v->idActivatedDate,0,10);?>" placeholder="证件有效期" /></p>
                                         <div class="fl dle nation_div mfp">
                                           <p><input type="text" name="id_country" class="id_country" data-pre="id_country" value="<?php echo $v->idCountryName;?>" data-code="<?php echo $v->idCountry;?>" placeholder="签发地" readonly="readonly"/></p>
                                            <ul class="select_ul_nation id_zone">
                                                <?php if($nationData->success):?>
                                                    <?php foreach($nationData->data as $k => $v): ?>
                                                        <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                           </ul>
                                         </div>
                                         <a href="javascript:void(0);" class="opa dle mfa">删除</a>
                                     </li>
                                     <?php endforeach;?>
                                     <li class="add_b"><a href="javascript:void(0);" class="add_other">添加其他证件</a></li>
                                 </ul>
                             </div>
                             <div class="line_div nation clearfix">
                                 <span class="pre_f fl">手机号</span>
                                 <div class="birthday_y pr nation_div fl clearfix">
                                     <i></i>
                                     <em class="country_code"><?php echo $curTraveller->traveller->mobilePhoneAreaCode;?></em>
                                     <p class="fl"><input type="text" name="phone_number_pre" class="s_in s_width" value="<?php echo $curTraveller->traveller->countryName;?>"  data-countrycode="<?php echo $curTraveller->traveller->mobilePhoneAreaCode;?>" readonly="readonly"/></p>
                                     <ul class="select_ul_nation phone_zone">
                                         <?php if($nationData->success):?>
                                             <?php foreach($nationData->data as $k => $v): ?>
                                                 <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                             <?php endforeach;?>
                                         <?php endif;?>
                                     </ul>
                                 </div>
                                 <p class="fl"><input type="text" name="phone_number" class="phone_number" value="<?php echo $curTraveller->traveller->mobilePhone; ?>" placeholder="输入手机号" /></p>
                             </div>
                             <div class="line_div clearfix"><label class="pre_f fl" for="chinese_name">邮箱</label>
                                 <p class="fl"><input type="text" name="email" id="email" value="<?php echo $curTraveller->traveller->email; ?>" placeholder="常用邮箱" /></p>
                             </div>
                             <div class="button line_div">
                                 <button type="submit" class="submit">保存</button>
                                 <button class="cancel">取消</button>
                             </div>
                         </form>
                     <?php else:?>
                         <form name="travellerForm" id="travellerForm" data-travellerId ="">
                             <div class="line_div clearfix"><label class="pre_f fl" for="chinese_name">中文名</label>
                                 <p class="fl"><input type="text" name="chinese_name" id="chinese_name" value="" placeholder="输入您的昵称" /></p><span class="name_tip">中英文必填一项</span>
                             </div>
                             <div class="line_div clearfix"><label class="pre_f fl" for="first_name">英文名</label>
                                 <p class="fl"><input type="text" name="first_name" id="first_name" class="e_f_n" value="" placeholder="姓(Surname)" /></p>
                                 <p class="fl nml"><input type="text" name="last_name" id="last_name" class="e_l_n" value="" placeholder="名(Givenname)" /></p>
                                 <span class="name_tip name_tip_p">若护照或港澳通行证存在,英文名必填！</span>
                             </div>
                             <div class="line_div nation clearfix">
                                 <span class="pre_f fl">国籍</span>
                                 <div class="nation_div pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="nationality" class="nationality" value="中国"  data-CountryCode="CN" readonly="readonly"/></p>
                                     <ul class="select_ul_nation">
                                         <?php if($nationData->success):?>
                                             <?php foreach($nationData->data as $k => $v): ?>
                                                 <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                             <?php endforeach;?>
                                         <?php endif;?>
                                     </ul>
                                 </div>
                             </div>
                             <div class="line_div clearfix">
                                 <span class="pre_f fl">性别</span>
                                 <div class="six_type fl">
                                     <p>
                                             <input name="six_type" type="radio" value="Mr"/>
                                             <label class="sex">男</label>
                                             <input name="six_type" type="radio" value="Mrs"/>
                                             <label class="sex">女</label>
                                     </p>
                                 </div>
                             </div>
                             <div class="line_div b_d_d clearfix">
                                 <span class="pre_f fl">生日</span>
                                 <div class="birthday_y pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_y" class="s_in" value="" readonly="readonly"/></p>
                                     <ul class="select_ul year"></ul>
                                 </div>
                                 <span class="md fl">年</span>
                                 <div class="birthday_m  pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_m"  class="s_in"  value="" readonly="readonly"/></p>
                                     <ul class="select_ul month"></ul>
                                 </div>
                                 <span class="md fl">月</span>
                                 <div class="birthday_d pr fl clearfix">
                                     <i></i>
                                     <p class="fl"><input type="text" name="birthday_d"  class="s_in" value="" readonly="readonly"/></p>
                                     <ul class="select_ul day"></ul>
                                 </div>
                                 <span class="md fl">日</span>
                             </div>
                             <div class="line_div id_input clearfix">
                                 <span class="pre_f id_span fl">证件</span>
                                 <ul class="traveller_ul">
                                         <li class="line_div_sub traveller_li clearfix" data-id="" data-index>
                                             <div class="birthday_y pr id_ul nation_div fl clearfix">
                                                 <i></i>
                                                 <p class="fl"><input type="text" name="id_type" class="id_type" value="身份证" data-pre="id_type" data-value="3" readonly="readonly"/></p>
                                                 <ul class="select_ul_id">
                                                     <li class="id_li" data-value="1">护照</li>
                                                     <li class="id_li" data-value="3">身份证</li>
                                                     <li class="id_li" data-value="3">港澳通行证</li>
                                                     <li class="id_li" data-value="4">台胞证</li>
                                                     <li class="id_li" data-value="5">回乡证</li>
                                                     <li class="id_li" data-value="6">台湾通行证</li>
                                                     <li class="id_li" data-value="7">军官证</li>
                                                     <li class="id_li" data-value="8">户口簿</li>
                                                     <li class="id_li" data-value="9">出生证明</li>
                                                     <li class="id_li" data-value="10">其他</li>
                                                 </ul>
                                             </div>
                                             <p class="fl dle"><input type="text" name="id_number" class="id_number" data-pre="id_number" value="" placeholder="证件号码" /></p>
                                             <p class="fl dle"><input type="text" name="id_active_time" class="id_active_time" data-pre="id_active_time" value="" placeholder="证件有效期" /></p>
                                             <div class="fl dle nation_div mfp">
                                                 <p><input type="text" name="id_country" class="id_country" data-pre="id_country" value="" data-code="" placeholder="签发地" readonly="readonly"/></p>
                                                 <ul class="select_ul_nation id_zone">
                                                     <?php if($nationData->success):?>
                                                         <?php foreach($nationData->data as $k => $v): ?>
                                                             <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                                         <?php endforeach;?>
                                                     <?php endif;?>
                                                 </ul>
                                             </div>
                                             <a href="javascript:void(0);" class="opa dle mfa">删除</a>
                                         </li>
                                     <li class="add_b"><a href="javascript:void(0);" class="add_other">添加其他证件</a></li>
                                 </ul>
                             </div>
                             <div class="line_div nation clearfix">
                                 <span class="pre_f fl">手机号</span>
                                 <div class="birthday_y pr nation_div fl clearfix">
                                     <i></i>
                                     <em class="country_code">86</em>
                                     <p class="fl"><input type="text" name="phone_number_pre" class="s_in s_width" value="中国"  data-countrycode="86" readonly="readonly"/></p>
                                     <ul class="select_ul_nation phone_zone">
                                         <?php if($nationData->success):?>
                                             <?php foreach($nationData->data as $k => $v): ?>
                                                 <li class="nation_li" data-countryCode="<?php echo $v->countryCode;?>" data-phonecode="<?php echo $v->phoneCode;?>"><?php echo $v->chineseName;?></li>
                                             <?php endforeach;?>
                                         <?php endif;?>
                                     </ul>
                                 </div>
                                 <p class="fl"><input type="text" name="phone_number" class="phone_number" value="" placeholder="输入手机号" /></p>
                             </div>
                             <div class="line_div clearfix"><label class="pre_f fl" for="chinese_name">邮箱</label>
                                 <p class="fl"><input type="text" name="email" id="email" value="" placeholder="常用邮箱" /></p>
                             </div>
                             <div class="button line_div">
                                 <button type="submit" class="submit">保存</button>
                                 <button class="cancel">取消</button>
                             </div>
                         </form>
                     <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/passenger_add.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/user/passenger_add.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url')?>/resources/js/plugin/jAlert.js"></script>
</body>
</html>


