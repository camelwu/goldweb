;(function($){
    $.validator.addMethod("onlyChineseEnglish", function(value, element) {
        var length = value.length;
        var reg = /^[\u2E80-\u9FFFa-zA-Z]*$/;
        return this.optional(element) || (length > 0 && reg.test(value));
    }, "姓名只能包含中文和英文");
    jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请正确填写您的手机号码");
    jQuery.validator.addMethod("gEmail", function(value, element) {
        var length = value.length;
        var mobile = /^(\w-*_*\.*)+@(\w-?)+(\.\w{2,})+$/;
        return this.optional(element) || (length > 2 && mobile.test(value));
    }, "请正确填写您的邮箱");

    $(document).ready(function(){
        var validator,formHandler = function() {
            var rulesD = arguments[0][0], messagesD = arguments[0][1];
            validator = $('#orderForm').validate({
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
                    getInfoCache();
                },
                invalidHandler: function(form, validator) {
                }
            });
        },inputNameHandler = function(){
            var rulesData = {},messagesData = {}, defaultRule = {required: true},defaultMessage = {required: "不能为空"};
            $('.room_users .room').each(function(index, ele){
                rulesData['name'+index] = {required: true, onlyChineseEnglish: true};
                messagesData['name'+index] = {required: "不能为空", onlyChineseEnglish: "姓名只能包含中文和英文"};
            });
            rulesData['fln'] =defaultRule;
            rulesData['phone_num'] = {required: true, isMobile: true};
            rulesData['c_phone_num'] = {required: true, isMobile: true};
            rulesData['c_email'] = {required: true, gEmail: true};
            rulesData['country'] = defaultRule;
            rulesData['nationality'] = defaultRule;
            messagesData['fln'] = defaultMessage;
            messagesData['phone_num'] = {required: "不能为空", isMobile: "请正确填写您的手机号码"};
            messagesData['c_phone_num'] = {required: "不能为空", isMobile: "请正确填写您的手机号码"};
            messagesData['c_email'] = {required: "不能为空", gEmail: "请正确填写您的邮箱"};
            messagesData['country'] = defaultMessage;
            messagesData['nationality'] = defaultMessage;
            return [rulesData,messagesData];
        },ajaxHandler = function(data, url){
            console.log(data);
            $.ajax({
                type:"POST",
                url:url,
                data: data,
                async:false,
                cache: false,
                success: function(res){
                    window.location.href='/payment?type=Hotel';
                },
                error:function(res){
                    console.log(res)
                }
            });
        },getInfoCache = function() {
            var guestNameList = [], wapOrder = {}, formObj = document.getElementById('orderForm'), totalCost = Number(document.getElementById('price_value').innerHTML);
            $('.room_users .room').each(function () {
                var temObj = {}, suffix = $(this).attr('data-index');
                temObj.adult = 1;
                temObj.enmGuestTitle = "Mr";
                temObj.guestFirstName = $(this).val();
                temObj.guestLastName = $(this).val();
                guestNameList.push(temObj);
            });
            /*wapOrder*/
            wapOrder.guestContactNo =formObj.c_phone_num.value;
            wapOrder.guestEmail = formObj.c_email.value;
            wapOrder.totalPrice = totalCost;
            wapOrder.guestTitle = "Mr";
            wapOrder.guestName = $(".link_firstname").val();
            wapOrder.guestNameList = guestNameList;
            wapOrder.guestNameList = guestNameList;
            wapOrder.residenceCode = $("input[name='country']").attr('data-code') || "CN";
            wapOrder.nationlityCode = $("input[name='nationality']").attr('data-number') ||"86";

            //{
            //    "guestNameList": [  //每个房间的入住信息
            //    {
            //        "adult": "2", //	成人数量
            //        "enmGuestTitle": "Mr", //性别 0 - Mr; 1 - Ms
            //        "guestFirstName": "Nin",//姓
            //        "guestLastName": "Frank"//名
            //    }
            //],
            //
            //    "hotelCode": "136", //酒店编码
            //    "hotelName": "中環65号旅馆", //酒店名称

            //    "roomCode": 145759, //产品房间编码
            //    "roomName": "16 Bedders Dorm", //	产品房型名称

            //    "roomTypeCode": "67554", //物理房型编码
            //    "roomTypeName": "16 Bedders Dorm", //物理房型名称

           /* //    "checkInDate": "2016-03-20T00:00:00",
            //    "checkOutDate": "2016-03-21T00:00:00",
            //    "numOfRoom": 2, //房间数
            //    "numOfGuest": 3, //成人数
            //    "childAges": [5,9], //儿童年龄
            //    "numOfChild": 2, //儿童数*/

            //    "guestTitle": "Mr", //性别
            //    "guestContactNo": "18311111111", //客人联系电话
            //    "guestEmail": "qwert@qq.com", //客人联系邮箱
            //    "totalPrice": 228, //总价
            //    "availability": true,//true即时确认,默认值

            //    }

            ajaxHandler(wapOrder,"/hotel/cacheOrderPara");
        };
        formHandler(inputNameHandler());
        $(document.body).on('click', function(event){
            var event = event || window.event;
            var  target = event.target || event.srcElement;
            if(($(target).hasClass('card_font')||$(target).parents('.card_font').length !==0 )){
                     var temp = $(target).hasClass('card_font')?$(target):$(target).parents('.card_font').eq(0);
                     temp.find('i').eq(0).addClass('choose_tag');
                     $("input[name='name0']").eq(0).val(temp.attr('data-firstname')+temp.attr('data-lastname'));
            }
            if($(target).hasClass('country_slider')||$(target).parents('.country_slider').length !==0 ){
                var temp_ = $(target).hasClass('country_slider')?target:$(target).parents('.country_slider').eq(0), tarUl = temp_.find('.nationality_ul').get(0);
                $('.nationality_ul').each(function(){
                    if(this === tarUl){
                        $(this).slideDown();
                    }else{
                        $(this).hide()
                    }
                });
            }else{
                $('.nationality_ul').each(function(){
                    $(this).hide()
                })
            }
            if($(target).parents('.nationality_ul').eq(0).length!==0){
                var tu = $(target).parents('.nationality_ul').eq(0);
                tu.hide().prev().attr('data-code',$(target).attr('data-value')).attr('data-number',$(target).attr('data-number')).val($(target).html());
            }
        })
    });
})(jQuery);
