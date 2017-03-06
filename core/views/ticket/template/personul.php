<ul class="contact_ul clearfix" input-prompt>
    <li class="clearfix">
        <div class="label fl">姓</div>
        <div class="fl">
            <input type="text" name="contact_last_name" class="public short_input fast_name" placeholder="如Li">
        </div>
        <div class="center_label fl">名</div>
        <div class="fl">
            <input type="text" name="contact_first_name" class="public short_input last_name" placeholder="如Shimin">
        </div>
    </li>
    <li class="clearfix">
        <div class="label fl">国籍</div>
        <div class="fl" select-div>
            <div class="select_unit nationality_select nation_select">
                <p class="select_btn">
                    <span class ="select_country"data-value="CN">中国</span>
                    <i></i>
                    <input class = "nation_select citycode" type="hidden" name="contact_nationality" value="CN">
                </p>
                <ul class="select_ul">
                    <?php foreach ($countryData as $cv): ?>
                        <li class= "country"data-value='<?php echo $cv['countryCode'] ?>'><?php echo $cv['chineseName'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </li>
    <li class="clearfix">
        <div class="label fl">手机号</div>
        <div class="fl"><input type="text" class="public phone" placeholder="" name="phone"></div>
    </li>
    <li class="clearfix">
        <div class="label fl">邮箱</div>
        <div class="fl"><input type="text" class="public email" placeholder="" name="email"></div>
    </li>
<!--    <li class="contact_lastli" checkbox-icon>-->
<!--        <i class="icon">-->
<!--            <a href="javascript:void(0);" class="checkbox_icon checkbox_cur">-->
<!--                <input  name="agree" type="checkbox" class = "icon_checkbox">-->
<!--            </a>-->
<!--        </i>-->
<!--        <span class = "word">保存为常用旅客</span>-->
<!--    </li>-->
</ul>