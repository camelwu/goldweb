/**
 * Created by zhouwei on 2016/8/29.
 */
$(function () {
    //服务协议
    $(document).on("click",function(e){
        if( $(e.target).hasClass("agree") ){
            $(".reg_pop_box").fadeIn(100);
        }
        if($(e.target).is("I")){
            $(".reg_pop_box").fadeOut(100);
        }
    })

    // 点击常旅卡片, 给出游人赋值
    $('.person_card_list>.card_ul>li').on("click", function (e) {
        var thiz = $(this);
        var hasEmptyInput = false;
        $('.add_person>.person_list>li').each(function (index, el) {
            var first_name = $('.first_name_input', this);
            var last_name = $('.last_name_input', this);
            var nationality = $('.nationality_input', this);
            // 如果姓名不为空, 则认为是空的表单
            if (!first_name.val() && !last_name.val()) {
                first_name.val(thiz.attr('data-firstname'));
                last_name.val(thiz.attr('data-lastname'));
                //nationality.val(thiz.attr('data-idcountry'));
                nationality.siblings('span').html(thiz.attr('data-countryname'));
                refreshContact();
                hasEmptyInput = true;
                return false;
            }
        });
        if (!hasEmptyInput) {
            alert('最多只能选择' + $('.add_person').attr('max-person-num') + '位出游人!');
            return;
        }
        thiz.addClass('selected').siblings().removeClass('selected');
    });

    // 清空出游人信息
    $('.add_person>.person_list>li>.clear_input').on("click", function (e) {
        var thiz = $(this);
        thiz.siblings('div').find('input:lt(2)').val('');
        thiz.siblings('div').find('.select_btn>span').html('中国').siblings('input').val('CN');
        refreshContact();
    });

    // 将第一出游人信息更新到联系人
    var refreshContact = (function() {
        var checkbox = $('[contact_info]>.info_title input:checkbox'),
            inputs = $('.add_person>.person_list>li:eq(0) input'),
            last_name = inputs.eq(0),

            first_name = inputs.eq(1),
            nationality = inputs.eq(2),
            nationality_text = nationality.siblings('span'),
            contact_last_name = $('input[name=contact_last_name]'),
            contact_first_name = $('input[name=contact_first_name]'),
            contact_nationality = $('input[name=contact_nationality]'),
            contact_nationality_text = contact_nationality.siblings('span');
        return function () {
            if (checkbox.prop('checked')) {
                contact_last_name.val(last_name.val());
                contact_first_name.val(first_name.val());
                contact_nationality.val(nationality.val());
                contact_nationality_text.html(nationality_text.html());
            }
        }
    })();

    // 在联系人与第一出游人相同时, 更改出游人, 同步更新联系人
    $('.add_person>.person_list>li:eq(0) input').on("change", function (e) {
        refreshContact();
    });

    // 选中联系人与第一出游人相同时, 同步更新联系人
    $('[contact_info]>.info_title input:checkbox').on('change', function (e) {
        refreshContact();
    });

    // 联系人姓名国籍发生改变的时候, 去掉联系人与第一出游人相同的复选框
    $('[contact_info]>ul input:lt(3)').on("change", function (e) {
        $('[contact_info]>.info_title input:checkbox').removeProp('checked').trigger('change');
    });

    // 下拉框变化时, 更新下拉框隐藏域的值, 并触发隐藏域的change事件
    $('.select_unit>.select_ul>li').on('click', function (e) {
        $(this).parent().siblings('.select_btn').find('input').val($(this).attr('data-value')).trigger('change');
    });

    // 复选框选中状态改变时, 改变复选框样式
    $('[checkbox-icon] input:checkbox').on('change', function (e) {
        this.checked ? $(this).parent().addClass('checkbox_cur') : $(this).parent().removeClass('checkbox_cur');
    });

    var dates = $('input[name=arrive_date],input[name=leave_date]').datepicker({
        minDate: $(".checkindata").val(),
        maxDate : $(".arrivedata").val(),
        defaultDate: "+0w",
        dateFormat: "yy-mm-dd",
        changeYear: true,
        yearRange: "-0:+1",
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
    // dates.eq(0).val($.datepicker.formatDate('yy-mm-dd', new Date(new Date().getTime() + 1 * 24 * 60 * 60 * 1000)));
    // dates.eq(1).val($.datepicker.formatDate('yy-mm-dd', new Date(new Date().getTime() + 3 * 24 * 60 * 60 * 1000)));



    (function () {

        // 姓名校验, 不包含数字
        $.validator.addMethod("onlyChineseEnglish", function(value, element) {
            var length = value.length;
            var reg = /^[\u2E80-\u9FFFa-zA-Z]*$/;
            return this.optional(element) || (length > 0 && reg.test(value));
        }, '只能包含中文和英文');

        // 手机号码验证asy_phone_code
        jQuery.validator.addMethod("isMobile", function(value, element) {
            var length = value.length;
            var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
            return this.optional(element) || (length == 11 && mobile.test(value));
        }, '请正确填写您的手机号码');

        var i, maxPersonNum = parseInt($('.add_person').attr('max-person-num'));
        var rules = {};
        var messages = {};
         //rules['arrival_flight_no'] = {required: true};
        // rules['arrive_date'] = {required: true};
        // rules['arrive_hour'] = {required: true};
        // rules['arrive_minute'] = {required: true};
        rules['contact_first_name'] = {required: true, onlyChineseEnglish : true};
        rules['contact_last_name'] = {required: true, onlyChineseEnglish : true};
        rules['contact_nationality'] = {required: true};
         //rules['leave_flight_no'] = {required: true};
        // rules['leave_date'] = {required: true};
        // rules['leave_hour'] = {required: true};
        // rules['leave_minute'] = {required: true};
        rules['contact_no'] = {required: true, isMobile : true};
        rules['email'] = {required: true, email : true};
        rules['agree'] = {required: true};

         //messages['arrival_flight_no'] = {required: '不能为空'};
        // messages['arrive_date'] = {required: '不能为空'};
        // messages['arrive_hour'] = {required: '不能为空'};
        // messages['arrive_minute'] = {required: '不能为空'};
        messages['contact_first_name'] = {required: '不能为空'};
        messages['contact_last_name'] = {required: '不能为空'};
        messages['contact_nationality'] = {required: '不能为空'};
         //messages['leave_flight_no'] = {required: '不能为空'};
        // messages['leave_date'] = {required: '不能为空'};
        // messages['leave_hour'] = {required: '不能为空'};
        // messages['leave_minute'] = {required: '不能为空'};
        messages['contact_no'] = {required: '不能为空'};
        messages['email'] = {required: '不能为空', email : '请输入正确的邮箱'};
        messages['agree'] = {required: '请阅读并接受用户协议'};

        for (i=0; i<maxPersonNum; i++) {
            rules['first_name$' + (i+1)] = {required: true, onlyChineseEnglish : true};
            rules['last_name$' + (i+1)] = {required: true, onlyChineseEnglish : true};
            rules['nationality$' + (i+1)] = {required: true};
            messages['first_name$' + (i+1)] = {required: '不能为空'};
            messages['last_name$' + (i+1)] = {required: '不能为空'};
            messages['nationality$' + (i+1)] = {required: '不能为空'};
        }
        $('form').validate({
            rules: rules,
            messages: messages,
            errorPlacement:function(error,element) {
                if(element.is(':radio')){
                    error.addClass('error_inline');
                }
                if(element.is(':checkbox')) {
                    error.appendTo(element.parent().parent().parent());
                    return;
                }
                element.is(':radio') ? error.appendTo(element.parent().parent()) : error.appendTo(element.parent());

            },
            submitHandler: function(form) {
                submitForm();
            }
        });
        $('#next_btn, #next_btn2').on('click', function () {
            $('form').submit();
        });
    })();

    function submitForm() {
        // 出游人信息
        var formArray = $('form').serializeArray();
        var data = {};
        var i, len;
        for (i = 0, len = formArray.length; i < len; i++) {
            data[formArray[i].name] = formArray[i].value;
        }
        console.log(data);
        $('#loading-div').show();
        $.ajax({
            type:"POST",
            url:"/hotelticket/order_submit",
            data: data,
            dataType : 'json',
            success: function(res){
                // console.log(res);
                if (res.success) {
                    window.location.href ="/payment?type=HotelTicket&bookingID="+res.data.bookingID+'&bookingRefNo='+res.data.bookingRefNo;
                } else {
                    $('#loading-div').hide();
                    alert(res.message);
                }
            },
            error:function(res){
                $('#loading-div').hide();
                alert("网络请求失败");
            }
        });
    }
});