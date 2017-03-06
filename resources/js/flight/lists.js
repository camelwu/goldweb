;(function($){
    var dayNames = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
    var setWeek = function(el) {
        var instance = el.data("datepicker"),
            date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                $.datepicker._defaults.dateFormat,
                el.val(), instance.settings);
        el.siblings('span').html(dayNames[date.getDay()]);
    };
    $(document).ready(function(){
        var dates = $("#startdate,#enddate").datepicker({
            minDate: 0,
            defaultDate: "+0w",
            dateFormat: "yy-mm-dd",
            changeYear: true,
            yearRange: "-0:+1",
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function () {
                $(this).blur();
            },
            onSelect: function (selectedDate) {
                var option = this.id == "startdate" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings);
                if (option == "minDate") {
                    dates.not(this).datepicker("option", option, date);
                    if (dates.not(this).val() == $(this).val()) {
                        dates.not(this).siblings('span').html(dayNames[date.getDay()]);
                    }
                }
                $(this).siblings('span').html(dayNames[date.getDay()]);
            }
        }), formObj = $("form[name='form1']").get(0),urlPara = null,
            getReturnDate = function(){
            var tem = new Date(arguments[0].replace(/-/g, "/")), minusOne, monthNum, dateNum;
            minusOne = new Date(tem.setDate(tem.getDate() + 3));
            monthNum = (minusOne.getMonth() + 1) < 10 ? "0" + parseInt((minusOne.getMonth() + 1)) : minusOne.getMonth() + 1;
            dateNum = (minusOne.getDate()) < 10 ? "0" + parseInt(minusOne.getDate()) : minusOne.getDate();
            return minusOne.getFullYear() + '-' + monthNum + '-' + dateNum;
        }, r_choose_buttonHandler = function(){
            $('.r_choose_button .choose').on('click', function(event){
                var fcStr = "&findex="+$(this).parents('.li_out').eq(0).attr('data-findex')+"&cindex="+$(this).parents('.li_cabin_out').eq(0).attr('data-cindex'), routeType=1;
                routeType = formObj.sType.value=="oneway"?1:2;
                window.location.href ="/flight/order?departDate="+formObj.date_from.value+"&returnDate="+formObj.date_to.value+"&numofAdult="
                    +formObj.adult_num.value+"&numofChild="+formObj.child_num.value+fcStr+"&routeType="+routeType+"&cityCodeFrom="+urlPara.cityCodeFrom+"&cityCodeTo="+urlPara.cityCodeTo;
            })
        },setWot = function(urlPara){
            var temWrap =  $('.nav_bread').eq(0);
            temWrap.find('.flight_type').html('国际');
            temWrap.find('.city_name_from').html(formObj.city_from.value);
            temWrap.find('.city_name_to').html(formObj.city_to.value);
            temWrap.find('.trip_type').html($('.trip_word').eq(0).html());
        }, ajaxHandler = function(){
            var filterHandler = function(){
                var filterObj = {1:[], 2:[], 4:[]}, resultArray = [];
                if( $('.filter_ul').length){
                    $('.filter_ul a.checkbox_cur').each(function(index, item){
                        for(var p in filterObj){
                            if(p == $(item).parents('li').attr('data-mapkey')){
                                filterObj[p].push($(item).parents('p').attr('data-mapkeyvalue'))
                            }
                        }
                    });
                    for(var p in filterObj){
                        var temO = {};
                        temO.filterType = p;
                        temO.filterValues = filterObj[p];
                        if(temO.filterValues.length>0){
                            resultArray.push(temO);
                        }
                    }
                    return resultArray;
                }else{
                    return false;
                }
            };
            var orderHandler = function(){
                var orderObj = {orderType:"",orderRuleValue:""}, opeObj =  $('.order_ul li.cur').eq(0);
                if(opeObj.length>0){
                    orderObj.orderType =opeObj.attr('data-key');
                    orderObj.orderRuleValue = opeObj.attr('data-value');
                    return orderObj;
                }else{
                    return false;
                }
            };
            var taxHandler = function(){
                return  Number($('.tax_ul .cur').eq(0).attr('data-value'));
            };
            var filterArray = filterHandler(), orderObj =orderHandler(), postObj = null;
            setWot();
            if(arguments[1] == "A"){
                postObj = {
                    postGreat:"A",
                    routeType:formObj.sType.value,
                    cityCodeFrom:$(formObj.city_from).attr('data-code'),
                    cityCodeTo: $(formObj.city_to).attr('data-code'),
                    cityNameFrom: formObj.city_from.value,
                    cityNameTo: formObj.city_to.value,
                    cabinClass: formObj.cabin_value.value,
                    departDate: formObj.date_from.value,
                    returnDate: formObj.date_to.value,
                    numofChild: Number(formObj.child_num.value),
                    numofAdult:Number(formObj.adult_num.value),
                    getCache: 0,
                    hasTax:0
                };
                $(".contain_screen_l").eq(0).html("");
                $(".filter_sort").eq(0).html("");
                $(".flight_list_info").eq(0).html("");
                $('.load_circle.bg_list').eq(0).show();
            }else{
                $(".flight_list_info").eq(0).html("");
                $('.bg_list.flight_list_right').eq(0).show();
                postObj = {
                    postGreat:"B",
                    sortFields: orderHandler(),
                    filterFields: filterHandler(),
                    hasTax: taxHandler(),
                    getCache: arguments[0]
                };
                if(arguments.length == 3){
                    arguments[2].type == 1?postObj.departFlightNo = arguments[2].value:postObj.returnFlightNo = arguments[2].value;
                }
            }
            console.log(postObj);
            $.ajax({
                type:"POST",
                url:"/flight/asy_get_flight",
                data: postObj,
                async:true,
                cache: false,
                success: function(res){
                    $('.bg_list').each(function(){
                        $(this).hide();
                    });
                    if(res.success){
                        $(".flight_list_info").eq(0).html(res.listHTML);
                        if(res.type == "A"){
                            $(".contain_screen_l").eq(0).html(res.filerHTML);
                            $(".filter_sort").eq(0).html(res.orderHTML);
                            $(".trip_title").eq(0).html(res.triptitle);
                            $('.flight_list_no_info').eq(0).hide();
                        }
                        r_choose_buttonHandler();
                        explainF();
                    }else{
                        if(res.type == "A"){
                            $('.flight_list_no_info').eq(0).show();
                        }else{
                            $(".flight_list_info").eq(0).html(res.listHTML);
                        }
                    }
                },
                error:function(res){
                    $('.bg_list').each(function(){
                        $(this).hide();
                    });
                    $('.flight_list_no_info').eq(0).show();
                    $('.flight_list_no_info .flight_no_tip').eq(0).html(res.statusText);
                }
            });
        }, initHandler = function(){
            var parseUrlHandler= function (url, isEncode) {
                var isEncode = isEncode || false, reg = /([^=&?]+)=([^=&?]+)/g, obj = {}, url = url;
                url.replace(reg, function () {
                    var arg = arguments;
                    obj[arg[1]] = isEncode ? decodeURIComponent(arg[2]) : arg[2];
                });
                return obj;
            };

            urlPara = parseUrlHandler(window.location.href, true);
            formObj.sType.value = urlPara.routeType;
            $(formObj.city_to).attr('data-code', urlPara.cityCodeTo);
            $(formObj.city_from).attr('data-code', urlPara.cityCodeFrom);
            formObj.city_from.value = urlPara.cityNameFrom;
            formObj.city_to.value = urlPara.cityNameTo;
            formObj.cabin_value.value =  urlPara.cabinClass;
            $('.cabin_ul>li', formObj).each(function(index, el) {
                if ($(this).attr('data-value') == urlPara.cabinClass) {
                    $('.cabin_value', formObj).html($(this).html());
                    return false;
                }
            });
            formObj.date_from.value =  urlPara.departDate;
            setWeek($('#startdate'));
            formObj.child_num.value = urlPara.numofChild;
            $('.select_person .child_value', formObj).html(urlPara.numofChild);
            formObj.adult_num.value = urlPara.numofAdult;
            $('.select_person .adult_value', formObj).html(urlPara.numofAdult);
            if(urlPara.routeType == "oneway"){
                $('.tripType .trip_word').eq(0).text('单程');
                $('#enddate').val('').attr('disabled', true).next().html('');
                $("input[name='date_to_show']").attr("readonly",true)
            }else{
                $('.tripType .trip_word').eq(0).text('往返');
                formObj.date_to.value =  urlPara.returnDate|| getReturnDate(urlPara.departDate);
                setWeek($('#enddate'));
            }
            setWot();
        }, explainF = function(){
            $('.explain_word').hover(function(){
                $(this).next().show();
            }, function(){
                $(this).next().hide();
            });
             $('.flight_port').hover(function(){
                    $(this).css({width:'auto'});
              }, function(){
                    $(this).css({width:'88px'});
             });
        };
        /*单程往返类型选择*/
        $('.tripType').eq(0).on('click',function(event){
            $(".yselect", this).slideToggle("fast");
            var event = event || window.event;
            var target = event.target || event.srcElement;
            if(target.nodeName == "LI"){
                $('.trip_word', this).eq(0).text($(target).text()).attr('data-sType', $(target).attr('data-sType'));
                $('.trip_word', this).eq(0).attr('data-sType')=='r'?$("input[name='sType']").val('return'):$("input[name='sType']").val('oneway');
            }
            if($("input[name='sType']").val() == "return"){
                $('#enddate').val('').removeAttr('disabled');
                formObj.date_to.value = getReturnDate($("input[name='date_from']").val());
                $("input[name='date_to_show']").val(formObj.date_to.value);
                $("input[name='date_to_show']").attr("readonly",false);
                setWeek($('#enddate'));
            } else {
                $('#enddate').val('').attr('disabled', true).next().html('');
            }
            if($('.trip_word', this).eq(0).attr('data-sType')== "o"){
                $('.free_choose_advise').eq(0).hide();
            }else{
                $('.free_choose_advise').eq(0).show();
            }
        } );
        /*人数舱位选择*/
        $('.person_number').eq(0).on('click',function(event){
            var adultNumEle =  $('.adult_value').eq(0),childNumEle =  $('.child_value').eq(0);
            var checkPersonNum = function(upele, evt, ac){
                var tag = true;
                if(Number($(evt).text())+Number(upele.text())>9){
                    alert("儿童与成人人数最多9位");
                    tag = false;
                }else{
                    if(ac == "adult"){
                        if(Number($(evt).text())/Number(upele.text()) < 1/2){
                            alert("1个成人2名儿童");
                            tag = false;
                        }
                    }else{
                        if(Number(upele.text())/Number($(evt).text()) < 1/2){
                            alert("1个成人2名儿童");
                            tag = false;
                        }
                    }
                }
                return tag;
            };
            var event = event || window.event;
            var target = event.target || event.srcElement;
            if(target.parentNode.className.indexOf('adult_number')> -1 || target.parentNode.parentNode.className.indexOf('adult_number')> -1){
                $('.person_number .adult_ul').slideToggle("fast");
                $('.person_number .child_ul,.person_number .cabin_ul').hide();
            }else if(target.parentNode.className.indexOf('child_number')> -1 || target.parentNode.parentNode.className.indexOf('child_number')> -1){
                $('.person_number .child_ul').slideToggle("fast");
                $('.person_number .adult_ul,.person_number .cabin_ul').hide();
            }else if(target.parentNode.className.indexOf('cabin_class')> -1 || target.parentNode.parentNode.className.indexOf('cabin_class')> -1){
                $('.person_number .cabin_ul').slideToggle("fast");
                $('.person_number .adult_ul,.person_number .child_ul').hide();
            }
            if(target.nodeName == "LI" &&$(target).parents('.person_outer').get(0)&& $(target).parents('.person_outer').get(0).className.indexOf('adult_number')>-1){
                checkPersonNum(childNumEle,target, "adult")?$(target).parents('.person_outer').eq(0).find('.adult_value').eq(0).text($(target).text()):void(0);
                $("input[name='adult_num']").val($('.person_number .adult_value').eq(0).text())
            }else if(target.nodeName == "LI" && $(target).parents('.person_outer').get(0)&& $(target).parents('.person_outer').get(0).className.indexOf('child_number')>-1){
                checkPersonNum(adultNumEle,target, "child")?$(target).parents('.person_outer').eq(0).find('.child_value').eq(0).text($(target).text()):void(0);
                $("input[name='child_num']").val($('.person_number .child_value').eq(0).text())
            }else if(target.nodeName == "LI" && $(target).parents('.cabin_outer').get(0).className.indexOf('cabin_class')>-1){
                $(target).parents('.cabin_outer').eq(0).find('.cabin_value').eq(0).text($(target).text());
                $("input[name='cabin_value']").val($(target).attr('data-value'));
            }
        });
        $(document.body).on('click', function(event){
            var event = event || window.event;
            var target = event.target || event.srcElement;
            if($(target).parents('.person_number').length == 0){
                $('.adult_ul').eq(0).hide();
                $('.child_ul').eq(0).hide();
                $('.cabin_ul').eq(0).hide();
            }
            if(target.className=="filter_input"&&target.parentNode.tagName=="A"){
               target.parentNode.className = target.parentNode.className == "checkbox_icon"? "checkbox_icon checkbox_cur":"checkbox_icon";
                ajaxHandler(0, 'B');
            }else if(target.className.indexOf("flight_input")>-1&&target.parentNode.tagName=="A"){
                $(".flight_list_info input[name='flight_input']").each(function(item){
                    (this == target)? this.parentNode.className =this.parentNode.className=="checkbox_icon checkbox_cur"?"checkbox_icon":"checkbox_icon checkbox_cur":this.parentNode.className ="checkbox_icon";
                });
                if( $(".flight_list_info a.checkbox_icon.checkbox_cur").length>0){
                    if(target.className.indexOf('depart')>-1){
                        ajaxHandler(0,'B', {type:1,value: $(target).attr('data-flightno')})
                    }else{
                        ajaxHandler(0, 'B',{type:2,value: $(target).attr('data-flightno')})
                    }
                }else{
                    ajaxHandler(0,'B')
                }
            }
            if((target.className.indexOf("order_li")>-1)||target.parentNode.className.indexOf("order_li")>-1){
                var temp = target.className.indexOf("order_li")>-1?target:target.parentNode;
                $(temp).siblings().each(function(){
                    this.className = "order_li";
                    $(this).attr('data-value',0);
                }) ;
                temp.className = "order_li cur";
                if( $(temp).attr('data-value') == "1"){
                    temp.className = 'order_li cur up';
                    $(temp).attr('data-value',0);
                }else{
                    $(temp).attr('data-value',1);
                    temp.className = 'order_li cur down';
                }
                ajaxHandler(0,'B');
            }
            if($(target).text() == "清空"){
                $('.filter_ul a').each(function(item){
                    $(this).removeClass('checkbox_cur');
                });
                ajaxHandler(0,'B');
            }else if(target.className.indexOf('more_li')>-1){
                if($(target).text()=="更多"){
                    $('.filter_ul .height_pre').eq(0).animate(
                        {
                            height:"100%"
                        }, 500
                    );
                    $(target).text('收起更多');
                }else{
                    $('.filter_ul .height_pre').eq(0).animate(
                        {
                            height: "188px"
                        }, 500
                    );
                    $(target).text('更多');
                }
            }else if($(target).parents('.tax_ul').length>0){
                var op = target.nodeName == "SPAN"? target.parentNode:target;
                $(op).siblings().each(function(){
                    this.className = "fr";
                }) ;
                op.className ="fr cur";
                ajaxHandler(1,'B')
            }else if($(target).hasClass('flight_detail_tip')||$(target.parentNode).hasClass('flight_detail_tip')){
                $(target).hasClass('flight_detail_tip')? $(target).toggleClass('cur'):$(target.parentNode).toggleClass('cur');
                var opEle = $(target).parents('.flight_sum').eq(0).next('.flight_s_info');
                $(opEle).slideToggle("fast");
            }else if($(target).hasClass('change_city')||$(target.parentNode).hasClass('change_city')){
                var temCityName = formObj.city_to.value, temCityCode = $(formObj.city_to).attr('data-code');
                $(formObj.city_to).attr('data-code',  $(formObj.city_from).attr('data-code'));
                formObj.city_to.value = formObj.city_from.value;
                $(formObj.city_from).attr('data-code',temCityCode);
                formObj.city_from.value = temCityName;
            }
        });
        $("#search_submit").on("click",function(){
            ajaxHandler(0,'A')
        });
        r_choose_buttonHandler();
        initHandler();
        explainF();
    });
})(jQuery);

