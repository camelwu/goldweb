var isLoaded = false;
+(function($){
    $(document).ready(function(){
        if (!isLoaded) {
            isLoaded = true;
            var formObj = $("form[name='travellerForm']").get(0), bul = $('.select_ul'),validator=null, initDate = function(){
                var nowDate = new Date(), yearMax = nowDate.getFullYear(), monthMax = nowDate.getMonth()+1,
                    dayMax =nowDate.getDate(),strY='',strM ='',strD ='';
                for(var i =1900;i<=yearMax;i++){
                    strY+='<li class="da y">'+i+'</li>';
                }
                bul.eq(0).html(strY);
                for(var j =1;j<=12;j++){
                    var tem = j<10?'0'+j:j;
                    strM+='<li class="da m">'+tem+'</li>';
                }
                bul.eq(1).html(strM);
                for(var k =1;k<=31;k++){
                    var tem_ = k<10?'0'+k:k;
                    strD+='<li class="da d">'+tem_+'</li>';
                }
                bul.eq(2).html(strD);
            };
            var ajaxHandler = function(){
                var getListTravellerIdInfo = function(){
                    var  listTravellerIdInfo = [];
                    $('.traveller_ul').find('.traveller_li').each(function() {
                        var temObj = {}, suffix = $(this).attr('data-index');
                        if(window.location.search){
                            temObj.id = $(this).attr('data-id');
                            temObj.isDelete = false;
                        }
                        temObj.travellerId = $(formObj).attr('data-travellerid');
                        temObj.idType = $(this).find("input[name='id_type" + suffix + "']").attr('data-value') || 1;
                        temObj.idNumber = $(this).find("input[name='id_number" + suffix + "']").val() ;
                        temObj.idCountry = $(this).find("input[name='id_country" + suffix + "']").attr('data-code');
                        temObj.idCountryName = $(this).find("input[name='id_country" + suffix + "']").val();
                        temObj.idActivatedDate = $(this).find("input[name='id_active_time" + suffix + "']").val();
                        temObj.nationalityCode = $(this).find("input[name='id_country" + suffix + "']").attr('data-code');
                        listTravellerIdInfo.push(temObj);
                    });
                    return listTravellerIdInfo;
                }, postObj = null;
                postObj = {
                    "traveller": {
                        "idName": formObj.chinese_name.value,  //中文姓名
                        "lastName": formObj.last_name.value, //英文姓
                        "firstName": formObj.first_name.value,  //英文名
                        "countryCode":$("input[name='nationality']").attr('data-countrycode'),  // 国籍编码
                        "countryName": formObj.nationality.value, // 国籍名称
                        "sexCode":"Mr",   // 性别(Mr:男 Mrs:女)
                        "sexName": "男",     //性别名称
                        "dateOfBirth": formObj.birthday_y.value+'-'+formObj.birthday_m.value+'-'+formObj.birthday_d.value, // 出生日期
                        "email": formObj.email.value, // 邮箱
                        "memberId": 11111,   // 所属会员ID
                        "mobilePhone":formObj.phone_number.value,  //手机号
                        "mobilePhoneAreaCode":$(formObj).find(".country_code").eq(0).html()  //手机号区号
                    },
                    "listTravellerIdInfo":getListTravellerIdInfo()
                };
                window.location.search!=""?postObj.traveller.travellerId = $(formObj).attr('data-travellerid'):void(0);
                $.ajax({
                    type:"POST",
                    url: window.location.search==""?"/user/asy_passenger_add":"/user/asy_passenger_edit",
                    data: postObj,
                    async:true,
                    cache: false,
                    success: function(res){
                        console.log(res)
                        if(res.success){
                            //alert('操作成功!');
                          window.location.href=window.location.search==""?"passenger":"/user/passenger";
                        }else{
                            alert(res.message);
                        }
                    },
                    error:function(res){
                        alert('failed');
                        console.log(res)
                    }
                });
            };
            var dataChangeHandler = function(para){
                var opUl = para;
                var inputType = function(para){
                    return para.className.substring(10)
                };
                var createM_D = function(){
                    var currentYear = $("input[name='birthday_y']").eq(0).val();
                    var currentMonth = $("input[name='birthday_m']").eq(0).val();
                    var getDayNum = function(par1,par2){
                        var  isLeapYear = function(year){
                            return (year % 4 == 0) && (year % 100 != 0 || year % 400 == 0);
                        };
                        var isBigM = function(pra){
                            var bigMonth = [1,3,5,7,8,10,12], tag =false;
                            $(bigMonth).each(function(){
                                if(this==pra){
                                    tag = true;
                                    return;
                                }
                            });
                            return tag;
                        };
                        if(par2==2){
                            return isLeapYear(par1)?29:28;
                        }else if(isBigM(par2)){
                            return 31;
                        }else{
                            return 30;
                        }

                    };
                    var initDayLi = function(num) {
                        var strD = '';
                        for(var i= 1;i<= num;i++){
                            var te= i<10?'0'+i:i;
                            strD+='<li class="da d">'+te+'</li>';
                        }
                        return strD;
                    };
                    bul.eq(2).html(initDayLi(getDayNum(currentYear,currentMonth)));
                };
                if(inputType(opUl)=='year'||inputType(opUl)=='month'){
                    createM_D();
                }
            };
            var validateAccess = function(){};
            var formHandler = function() {
                var rulesD = arguments[0][0], messagesD = arguments[0][1];
                 $('#travellerForm').validate({
                    focusInvalid:true,
                    rules:rulesD,
                    messages:messagesD,
                    errorPlacement:function(error,element) {
                        if(element.is(':radio')){
                            error.addClass('error_inline');
                        }
                        element.is(':radio')?error.appendTo(element.parent().parent()) :error.appendTo(element.parent());

                    },
                    submitHandler: function(form) {
                        ajaxHandler()
                    },
                    invalidHandler: function(form, validator) {
                        // alert('need fill all!')
                    }
                });
            };
            var getIdArray = function(){};
            var resetInputName = function(){
                $('.traveller_ul').find('.line_div_sub').each(function(item, ele){ //      //$("input:text").attr("name",str)
                      $(this).attr('data-index',item);
                      $(this).find('input').each(function(){
                          $(this).attr("name", $(this).attr("data-pre")+item);

                      })
                })
            };
            var validateNameHandler = function(){
                var rulesData = {},messagesData = {}, defaultRule = {required: true},defaultMessage = {required: "不能为空"};
                var temArray = [0,1,2,3,4,5,6,7,8,9,10]; //处理证件表单数目增多后，validate失效的问题
                //$('.traveller_ul .traveller_li').each(function(index, ele){
                $(temArray).each(function(index, ele){
                    rulesData['id_type'+index] = defaultRule;
                    rulesData['id_number'+index] =  defaultRule;
                    rulesData['id_active_time'+index] = defaultRule;
                    rulesData['id_country'+index] = defaultRule;
                    /*message*/
                    messagesData['id_type'+index] = defaultMessage;
                    messagesData['id_number'+index] =  defaultMessage;
                    messagesData['id_active_time'+index] = defaultMessage;
                    messagesData['id_country'+index] = defaultMessage;
                });
                rulesData['chinese_name'] = defaultRule;
                rulesData['first_name'] = defaultRule;
                rulesData['last_name'] = {required: true};
                rulesData['six_type'] = {required: true};
                rulesData['birthday_y'] = {required: true};
                rulesData['birthday_m'] = {required: true};
                rulesData['birthday_d'] = {required: true};
                rulesData['phone_number'] = {required: true};
                rulesData['email'] = {required: true};
                /*message*/
                messagesData['chinese_name'] = defaultMessage;
                messagesData['first_name'] = defaultMessage;
                messagesData['last_name'] = defaultMessage;
                messagesData['six_type'] = defaultMessage;
                messagesData['birthday_y'] = defaultMessage;
                messagesData['birthday_m'] = defaultMessage;
                messagesData['birthday_d'] = defaultMessage;
                messagesData['phone_number'] = defaultMessage;
                messagesData['email'] = defaultMessage;
                return [rulesData,messagesData]
            };
            resetInputName();
            formHandler(validateNameHandler());
            initDate();
            $(document.body).eq(0).on('click',function(e){
                if($(e.target).hasClass('opa')){
                    $(e.target).parent().parent().find($(e.target).parent()).remove();
                    resetInputName();
                }else if($(e.target).hasClass('add_other')){
                    var ele = document.createElement('LI'), strEle='';
                    strEle = ' <i></i>'+
                        ' <p class="fl"><input type="text" name="id_type" class="id_type" value="护照" data-pre="id_type" data-value="1" readonly="readonly"></p>'+
                        '   <ul class="select_ul_id" style="display: none;">'+
                        '    <li data-value="1">护照</li>'+
                        '    <li data-value="3">身份证</li>'+
                        '    <li data-value="3">港澳通行证</li>'+
                        '    <li data-value="4">台胞证</li>'+
                        '    <li data-value="5">回乡证</li>'+
                        '     <li data-value="6">台湾通行证</li>'+
                        '     <li data-value="7">军官证</li>'+
                        '     <li data-value="8">户口簿</li>'+
                        '    <li data-value="9">出生证明</li>'+
                        '    <li data-value="10">其他</li>'+
                        '    </ul>'+
                        '    </div>'+
                        '    <p class="fl dle"><input type="text" name="id_number" class="id_number" data-pre="id_number" value="" placeholder="证件号码"></p>'+
                        '    <p class="fl dle"><input type="text" name="id_active_time" class="id_active_time" data-pre="id_active_time" value="" placeholder="证件有效期"></p>'+
                        '    <p class="fl dle mfp"><input type="text" name="id_country" class="id_country" data-pre="id_country" value="" data-code="CN" placeholder="签发地"></p>'+
                        '    <a href="javascript:void(0);" class="opa dle mfa">删除</a>';
                    ele.className = 'line_div_sub traveller_li clearfix last_li';
                    $(e.target).parent().prev().removeClass('last_li');
                    $(ele).html(strEle).attr('data-index','0');
                    $(ele).insertBefore('.add_b');
                    resetInputName();
                }else if($(e.target).hasClass('da')){
                      $(e.target).parent().prev().find('input').eq(0).val($(e.target).html());
                      dataChangeHandler(e.target.parentNode);
                }else if($(e.target).parents('.b_d_d').length != 1){
                    bul.each(function(){
                        $(this).hide();
                    })
                }else if($(e.target).parents('.b_d_d').length == 1){
                    bul.each(function(){
                        this == $(e.target).parent().next().get(0)?void(0):$(this).hide();
                    })
                }
                if($(e.target).hasClass('id_li')){
                    $(e.target).parent().prev().find('input').eq(0).val($(e.target).html());
                    $(e.target).parent().prev().find('input').eq(0).attr('data-value',$(e.target).attr('data-value') );
                }else if($(e.target).hasClass('nation_li')){
                    $(e.target).parent().prev().find('input').eq(0).val($(e.target).html());
                    $(e.target).parent().prev().find('input').eq(0).attr('data-countrycode',$(e.target).attr('data-countrycode'));
                    if($(e.target).parent().parent().find('.country_code').length==1){
                        $(e.target).parent().parent().find('.country_code').html($(e.target).attr('data-phonecode'))
                      }
                }
            });
            $('.pr').each(function(item){
                   $(this).on('click',function(){
                       $('.select_ul', this).slideToggle();
                   });
            });
            $('.id_ul').on('click',function(){
                    $('.select_ul_id', this).slideToggle();
            });
            $('.nation_div').on('click',function(){
                $('.select_ul_nation', this).slideToggle();
            })
        }
    })
    $('.sex').click(function(){
        var radioId = $(this).attr('name');
        $(".checked").removeAttr('class') && $(this).attr('class', 'checked');
        $('input[name="six_type"]').removeAttr('checked') && $('six_type').attr('checked', 'checked');
    });
})(jQuery);