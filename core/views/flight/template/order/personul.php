<?php $aa=array(1=>"一",2=>"二",3=>"三",4=>"四",5=>"五",6=>"六",7=>"七",8=>"八",9=>"九",10=>"十");?>
<?php for($i = 0;$i<(int)$numofAdult+(int)$numofChild;$i++){
       echo "<ul class=\"people_message clearfix\" data-choose=\"true\" data-type=\"".($i < (int)$numofAdult ? "adult" : "child")."\" data-index='$i'>
         <input type='hidden' name ='person_type".$i."' class='person_type'/>
         <input type='hidden' name ='idActivatedDate".$i."' class='idActivatedDate'/>
         <input type='hidden' name ='baggageCode".$i."' class='baggageCode'/>
        <li btn-default>
            <span class=\"fl word_l\">第".$aa[($i+1)]."位乘机人</span>
            <p class=\"people fl\">".($i < (int)$numofAdult ? "成人" : "儿童")."</p>
            <a href=\"javascript:;\" class=\"empty fr\">清空</a>
        </li>
        <li class=\"name\" icon_help tip>
            <span class=\"fl word_l pdt10\">姓</span>
            <p class=\"fl\">
                <input name='first_name".$i."' class=\"public surname\" type=\"text\">
            </p>
            <span class=\"fl word_l word_card word_card_in\">名</span>
            <div class=\"fl ming\">
                <input name='last_name".$i."' class=\"public ming fl\" type=\"text\">
                <div class=\"pr help_tip_box order_help_tip_box fl\">
                    <i class=\"help tip_btn_i\"></i>
                    <div class=\"tip_box\">
                        <span class=\"tip_icon\"></span>
                        <p class=\"tip_word\">若持护照登机，必须按照护照顺序区分姓（Surname）与名（Givenname）。例如: \"Smith/Black\"，不区分大小写。名字长≤26个字符，若过长请使用缩写。</p>
                    </div>
                </div>
            </div>
        </li>
        <li class=\"card_id\" select-div>
            <span class=\"fl word_l pdt10\">证件类型</span>
            <div class=\"select_unit fl\">
                <p class=\"select_btn idType\" data-value='1'>护照<i></i></p>
                <ul class=\"select_ul\">
                    <li data-value='1'>护照</li>
                    <li data-value='2'>身份证</li>
                    <li data-value='3'>港澳通行证</li>
                    <li data-value='4'>台胞证</li>
                    <li data-value='5'>回乡证</li>
                    <li data-value='6'>台湾通行证</li>
                    <li data-value='7'>军官证</li>
                    <li data-value='8'>户口簿</li>
                    <li data-value='9'>出生证明</li>
                    <li data-value='10'>其他</li>
                </ul>
            </div>
            <span class=\"fl word_l word_card pdt10\">证件号</span>
            <p class=\"fl word_lp\">
                <input name='idNumber".$i."' class=\"public card_id2 idNumber\" type=\"text\">
            </p>
        </li>
        <li class=\"name nationality\" icon_help  search-index>
            <span class=\"fl word_l pdt10\">国籍</span>
            <div class=\"fl add_arrow country_slider\">
                <i></i><input name='idcountry".$i."' class=\"public countryName\" type=\"text\" placeholder=\"中文/英文\" value='中国' / data-idcountry='CN' readonly=\"readonly\" />
                 $country_ul
                 </div>
        </li>
        <li class=\"name nationality\" icon_help>
            <span class=\"fl word_l pdt10\">出生日期</span>
            <p class=\"fl add_arrow\">
                <i></i><input name='date_birth".$i."' id='date_birth".$i."'  class=\"public dateOfBirth\"   type=\"text\" readonly>
            </p>
        </li>
        <li class=\"sex_name\" search-index>
            <span class=\"word_l fl\">性别</span>
            <div class=\"type\">
                <span class='sex_radio'><input type=\"radio\"  name='sex_list".$i."' value=\"1\" class=\"radioclass\"><i class= \"sex_i\" ></i><span class=\"sexName\">男</span></span>
                <span class='sex_radio'><input type=\"radio\"  name='sex_list".$i."' value=\"2\" class=\"radioclass\"><i class= \"sex_i\"></i><span class=\"sexName\">女</span></span>
            </div>
        </li>
    </ul>";
} ?>

