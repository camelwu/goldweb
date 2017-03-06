(function(w){
    var OrderInfo = {};//定义字面量单体
    OrderInfo.init={
        hasEmptyInput:true   //常用旅客有无判断
    };
    OrderInfo.visitorOrder = {
            bindClick:function() {
                //var iconbutton=$(".checkbox_icon");
                //iconbutton.on("click", function () {   //保存为联系人点击事件
                //    if(iconbutton.addClass("checkbox_cur")){
                //        OrderInfo.submit.passergeAjax();
                //    }else{
                //        iconbutton.removeClass("checkbox_cur");
                //    }
                //});
                var country = $(".country");
                var selectCountry = $(".select_country");
                country.on("click",function(){
                    selectCountry.attr("data-value",$(this).attr("data-value"));
                });
                var libotton = $(".libotton");
                var liparent = $(".select_hotel");
                libotton.on("click",function(){
                    liparent.attr("data-value",$(this).attr("data-value"));
                })
            }
        };
    OrderInfo.bindEvent = {
        //取票人信息事件
        cardClick:function(){
            // 点击常旅卡片, 给出游人赋值
            $('.card_font').on("click", function (e) {
                var that = $(this);
                var hasEmptyInput = false;
                $('.contact_ul >li').each(function (index, event) {
                    var first_name = $('.fast_name', this);
                    var last_name = $('.last_name', this);
                    var nationality = $('.nation_select', this);
                    var phone = $('.phone', this);
                    var email = $('.email', this);
                    // 如果姓名不为空, 则认为是空的表单
                    if (!first_name.val() && !last_name.val()) {
                        first_name.val(that.attr('data-firstname'));
                        last_name.val(that.attr('data-lastname'));
                        nationality.val(that.attr('data-idcountry'));
                        phone.val(that.attr('data-idNumber'));
                        email.val(that.attr('data-idType'));            //email类型不对
                        nationality.siblings('span').html(that.attr('data-countryname'));
                        //OrderInfo.bindEvent.refreshContact();
                        hasEmptyInput = true;
                        return false;
                    }else{
                        first_name.val(that.attr('data-firstname'));
                        last_name.val(that.attr('data-lastname'));
                        nationality.val(that.attr('data-idcountry'));
                        phone.val(that.attr('data-idNumber'));
                        email.val(that.attr('data-idType'));
                        nationality.siblings('span').html(that.attr('data-countryname'));
                        hasEmptyInput = true;
                        return false;
                    }
                });
                that.addClass('selected').siblings().removeClass('selected');
            });
        },
        // 将第一出游人信息更新到联系人
        refreshContact:function(){
            var checkbox = $('.checkbox_cur'),
                lists = $('.contact_ul>li'),
                last_name = lists.eq(0).children().eq(1).children(),
                first_name = lists.eq(0).children().eq(3).children(),
                nationality = lists.eq(1).children().eq(1).children(),
                phone=lists.eq(2).children().eq(1).children(),
                email=lists.eq(3).children().eq(1).children();
            return function () {
                if (checkbox.prop('checkbox_cur')) {
                    contact_last_name.val(last_name.val());
                    contact_first_name.val(first_name.val());
                    contact_nationality.val(nationality.val());
                    contact_nationality_text.html(nationality_text.html());
                }
            }
        }

    };
    OrderInfo.submit = {
        ajax :function(){
            var  personinfo = {}, reserve = {},pickupPoint = {}, cost={}, visitor=[];
            var tour=[];
            var person=$("#person_select");
            var sencedata = $(".scenic_date");
            var selecthotel = $(".select_hotel");
            for(var i=0; i<sencedata.length;i++){
                var id= $(sencedata[i]).find("#packegeid").attr("data-id");
                var data=$(sencedata[i]).find(".date_public").val();
                tour.push({"tourID":id,"travelDate":data})
            }
            //取票人信息参数
            personinfo.firstName=$(".fast_name").val();
            personinfo.lastName=$(".last_name").val();
            personinfo.email=$(".email").val();
            personinfo.phone=$(".phone").val();
            //接送酒店
            pickupPoint.pickupID=selecthotel.attr("data-value");
            pickupPoint.pickupPoint=$("#hotel_info").html();
                //费用明细
            cost.adult=$(".price_adult").html();
            cost.childage=jQuery.parseJSON(person.attr("data-value"))["ageList"];//$(".price_child").html(),
            cost.adultnum=jQuery.parseJSON(person.attr("data-value"))["adultNum"];
            cost.childnum=jQuery.parseJSON(person.attr("data-value"))["childtNum"];
            cost.totalprice=$(".totalprice").html();
            var data_json = {
                personinfo:personinfo,
                visitor:visitor,
                tour:tour,
                currencyCode:"CNY",
                pickupPoint:pickupPoint,
                cost:cost
            };
            $('#loading-div').show();
            $.ajax({
                type:'POST',url:"/ticket/get_code",asyne:false,cache:false,dataType:"json",data:data_json,
                success:function(res){
                    $('#loading-div').hide();
                    console.info(res);
                    if(res.success){
                        window.location.href ="/payment?type=Ticket&bookingID="+res.message.data.bookingID+'&bookingRefNo='+res.message.data.bookingRefNo;
                    }
                    else{
                        showMsg(res.message);
                        return;
                    }
                },
                error:function(res){
                    $('#loading-div').hide();
                    showMsg(res.message);
                    return;
                }
            })
    },
        passergeAjax : function(){
            var  passergeadd = {};
            var selectCountry = $(".select_country");
            //取票人信息参数
            passergeadd.firstName=$(".fast_name").val();
            passergeadd.lastName=$(".last_name").val();
            passergeadd.email=$(".email").val();
            passergeadd.countrycode=selectCountry.attr("data-value");
            passergeadd.countryname=selectCountry.val();
            passergeadd.sexcode="Mr";
            passergeadd.sexname="男";
            passergeadd.memberId=11111;
            passergeadd.mobilePhone='86';
            passergeadd.phone=$(".phone").val();
            var data_json = {
                passergeadd:passergeadd
            };
            console.log(data_json);
            $('#loading-div').show();
            $.ajax({
                type:'POST',url:"/ticket/get_code_passenger",asyne:false,cache:false,dataType:"json",data:data_json,
                success:function(res){
                    $('#loading-div').hide();
                    console.info(res);
                    if(res.success){
                        showMsg("保存成功！");
                    }
                    else{
                        showMsg(res.message);
                        return;
                    }
                },
                error:function(res){
                    $('#loading-div').hide();
                    showMsg(res.message);
                    return;
                }
            })
    }

    };
    OrderInfo.date={
        playDate:function(){
            var inputsearch=$(".date_public");
            for(var i=0;i<=inputsearch.length;i++){
                var dates = $(inputsearch[i]).datepicker({
                    minDate: 0,
                    defaultDate: "+0w",
                    dateFormat: "yy-mm-dd",
                    changeYear: true,
                    changeMonth: true,
                    onClose: function () {
                        $(this).blur();
                    },
                    onSelect: function (selectedDate) {
                        var option = this.name == 'arrive_date' ? 'minDate' : 'maxDate',
                            instance = $(this).data('datepicker'),
                            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                        if (option == 'minDate') {
                            dates.not(this).datepicker('option', option, date);
                        }
                        $(this).attr('date-full-value',selectedDate);//替换当前值
                        $(this).val(selectedDate);//替换当前值
                    }
                });
            }
        }
    };
    OrderInfo.verify={
        //姓名校验，不包含数字
        formHandle:function(){
            $.validator.addMethod("onlyChineseEnglish", function(value, element) {
            var length = value.length;
            var reg = /^[\u2E80-\u9FFFa-zA-Z]*$/;
            return this.optional(element) || (length > 0 && reg.test(value));
             }, '姓名只能包含中文和英文');
        // 手机号码验证
         jQuery.validator.addMethod("isMobile", function(value, element) {
             var length = value.length;
             var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
             return this.optional(element) || (length == 11 && mobile.test(value));
         }, '请正确填写您的手机号码');
            var rulesData = {},messagesData = {};
            rulesData['contact_last_name'] = {required: true, onlyChineseEnglish: true};
            rulesData['contact_first_name'] = {required: true, onlyChineseEnglish: true};
            rulesData['contact_nationality'] = {required: true};
            rulesData['phone'] = {required: true, isMobile: true};
            rulesData['email'] = {required: true, email : true};
            /*messagesData*/
            messagesData['contact_last_name'] = {required: "不能为空"};
            messagesData['contact_first_name'] = {required: "不能为空"};
            messagesData['contact_nationality'] = {required: "不能为空"};
            messagesData['phone'] = {required: "不能为空", isMobile: "请正确填写您的手机号码"};
            messagesData['email'] = {required: "不能为空", email: "请输入正确的邮箱"};
            //messagesData['agree'] = {required: '请选着是否保存为常用旅客'};
            $('form').validate({
                rules: rulesData,
                messages: messagesData,
                errorPlacement:function(error,element) {
                    if(element.is('.submit')){
                        error.addClass('error_inline');
                    }
                    element.is('.submit') ? error.appendTo(element.parent().parent()) : error.appendTo(element.parent());
                },
                submitHandler:function(form){
                    OrderInfo.submit.ajax();
                }
            });
                $('.submit').on('click', function () {
                    $('form').submit();
                });
        }
    };
    OrderInfo._init={
        init:function(){
            OrderInfo.visitorOrder.bindClick();
            OrderInfo.bindEvent.cardClick();
            OrderInfo.verify.formHandle();
            OrderInfo.date.playDate();
        }
    };
    OrderInfo._init.init();
    return OrderInfo;
})(jQuery);
