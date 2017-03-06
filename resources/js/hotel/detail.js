;(function($){
    $(document).ready(function(){
        var formObj = $("form[name='mapInfo']").get(0), itemWrap = $('#detail_part_wrap .detail_part'), itemTitles = $('.nav_ul li'), maxCut, midCut, minCut,miCut, lat,lng, hName,stTag = false,
        ajaxHandler = function(){
            var postObj = null;
            if(arguments[1] === 1){
                postObj = {
                    HotelID:arguments[0].hotelId,
                    RoomTypeCode:arguments[0].roomTypeCode,
                    ReType:arguments[1]
                };
            }else{
                postObj = {
                    HotelID:arguments[0].hotelId,
                    PageIndex:arguments[0].pageIndex,
                    ReType:arguments[1]
                };
            }

            $("input[name='rtc']").val(arguments[0].roomTypeCode);
            $("input[name='ri']").val(arguments[0].item);
            $.ajax({
                type:"POST",
                url:"/hotel/asy_get_Hotel_data",
                data: postObj,
                async:true,
                cache: false,
                success: function(res){
                    $('.bg_big').hide();
                    showRoomImg(res);
                },
                error:function(res){
                    console.log(res);
                }
            });
        }, showRoomImg = function(res){
               var rtc = formObj.rtc.value;
               var ri = formObj.ri.value;
                $("input[name='rtc']").val();
                $("input[name='ri']").val();
                $('.room_items_out').each(function(){
                    if($(this).attr('data-rtc') == rtc){
                          $(this).find('.room').each(function(){
                                if($(this).attr('data-item') ==ri){
                                     $(this).find('.room_img').eq(0).html(res.cHtml).slideDown();
                                }
                          })
                    }
                })
        };
        lat = Number(formObj.latitude.value);
        lng = Number(formObj.longitude.value);
        hName = formObj.hotelNameLocale.value;
        mapHandler.init( [{lat:lat, lng:lng,tag:hName}], "map","detail" );
        $(document.body).on('click', function(event){
            var event = event || window.event;
            var target = event.target || event.srcElement;
            if($(target).hasClass('check_room_type')||$(target.parentNode).hasClass('check_room_type')){
                $(target).hasClass('check_room_type')? $(target).toggleClass('open'):$(target.parentNode).toggleClass('open');
                var temp = $(target).parents('.sp').eq(0), tSpan=temp.find('.check_room_type').eq(0);
                var opEle = temp.next('.room_items_out');
                $(opEle).slideToggle(500);
                tSpan.hasClass('open')?tSpan.html("收起房型<i></i>"):tSpan.html("查看房型<i></i>");
            }
            if($(target).hasClass('_type')||$(target.parentNode).hasClass('_type')){
                var hid = $('#hid').attr('data-hid'),rtc, iTag, line, index;
                line = $(target).parents('.room').eq(0);
                rtc= $(target).hasClass('_type')?$(target).attr('data-rtc'):$(target.parentNode).attr('data-rtc');
                iTag = line.find('i').eq(0).toggleClass('ex');
                index = line.attr('data-item');
                if(line.find('i').eq(0).hasClass('ex')){
                    line.find('.room_img').slideUp();
                }else{
                    $('.bg_big').show();
                    ajaxHandler({hotelId:hid,roomTypeCode:rtc,item:index}, 1)
                }
            }
        });
        if(itemWrap.length !== 0){
            maxCut = itemWrap.eq(0)[0].getBoundingClientRect().top;
            midCut = itemWrap.eq(0)[0].getBoundingClientRect().top-itemWrap.eq(1)[0].getBoundingClientRect().top;
            minCut = itemWrap.eq(0)[0].getBoundingClientRect().top-itemWrap.eq(2)[0].getBoundingClientRect().top;
            miCut = itemWrap.eq(0)[0].getBoundingClientRect().top-itemWrap.eq(3)[0].getBoundingClientRect().top;
            $(window).scroll(function () {
                var top = document.getElementById('detail_part_wrap').getBoundingClientRect().top, c_top,op = $('#hotel_tabs_box'),
                    bScrollTop = $(document.body).eq(0).scrollTop();
                top <= 62 ? op.addClass('fixTab') : op.removeClass('fixTab');
                c_top = top;
                if(!stTag){
                    if(c_top<miCut){
                        itemTitles.eq(3).addClass('cur').siblings().removeClass('cur');
                    }
                    else if(c_top< minCut){
                        itemTitles.eq(2).addClass('cur').siblings().removeClass('cur');
                    }else if(c_top<midCut&&c_top>minCut){
                        itemTitles.eq(1).addClass('cur').siblings().removeClass('cur');
                    }else if(c_top>midCut){
                        itemTitles.eq(0).addClass('cur').siblings().removeClass('cur');
                    }
                }
                stTag = false;
            });
            $(document.body).on('click', function (event) {
                var event = event || window.event;
                var target = event.target || event.srcElement;
                if (target.className == 'wa') {
                    stTag = true;
                    $(target).parent().addClass('cur').siblings().removeClass('cur');
                }
                if($(target).parents('.page_wrap').length!==0){
                    var curNum = "";
                    if($(target).hasClass('pg_link')){
                        curNum = $(target).text();
                    }else if($(target).hasClass('pg_pre')){
                        curNum  = Number($('.pg_curr').eq(0).text())-1;
                    }else if($(target).hasClass('pg_next')){
                        curNum  = Number($('.pg_curr').eq(0).text())+1;
                    }
                   // ajaxHandler({hotelId:$('#hid').attr('data-hid'),pageINdex:curNum}, 2)
                }
                if($(target).hasClass('bookingBtn')||$(target.parentNode).hasClass('bookingBtn')){
                    var rtc, rc, tp = $(target).parents('._order').eq(0).siblings('._type').eq(0);
                    window.location.href ="/hotel/order?rtc="+tp.attr('data-rtc')+"&rc="+tp.attr('data-rc');
                }
            });
        };
        //星级图标
        function start(stars){
            var star =$(".score").find("strong").html();
            $(".star_icon2").css({"width": star * 14.6 + "px"});
        };
        function starts(){
            var lis = $(".commit_ul").find("li");
            for(var i=0;i<lis.length;i++) {
                var star =$(lis[i]).find($("strong")).html();
                $(lis[i]).find($(".star_icon2")).css({"width": star * 14.6 + "px"});
            }
        };
        start();starts();
        var date2 =$("#startdate,#enddate").datepicker({
            minDate: 0,
            maxDate:"+90d",
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
                    dates2.not(this).datepicker("option", option, date);
                }
                $(this).attr("data_date",selectedDate);//替换当前值
                $(this).val(selectedDate);//替换当前值
            }
        });
        //房间人数年龄选择
        new select_person_pop().init({
            isShowRoom: true,
            type: "ticket",// ticket:景点门票， hotel_ticket:酒景
            elemId: "person_select",//
            maxRoom: 5,
            minPax: 1,//最小总人数
            maxPax: 2,//最多总人数
            maxAdult: 3, //最多成人数
            childAgeMax: 8,//最多儿童数
            childAgeMin: 2,//最小儿童年龄
            onlyForAdult: false,//最只能是成人
            callback: function (obj) {
                var adultNum=0;
                var childtNum=0;
                for(var i=0;i<=obj.length-1;i++){
                    adultNum+=parseInt(obj[i].adultNum);
                    childtNum+=parseInt(obj[i].childtNum);
                }
                console.log(obj);
                $('#change_info').html(adultNum+ '成人' + childtNum + '儿童'+obj.length + '房间');
            }

        });
        function bingClick (){
            $(".change_num").on("click",function(){
                $("#loading").delay(400).fadeIn("medium");
                var json_data = {
                    CheckInDate: $("#startdate").attr("placeholder"),
                    CheckOutDate: $("#enddate").attr("placeholder"),
                    numofAdult: $("#change_info").html().substring(0, 1),
                    NumChild: $("#change_info").html().substring(3, 4),
                    NumRoom: $("#change_info").html().substring(6, 7)
                };
                console.log(json_data);
                $.ajax({
                    type: "POST",
                    url: "/hotel/asy_feature",
                    data: json_data,
                    async: true,
                    cache: false,
                    success: function (res) {
                        var data=JSON.parse(res);
                        $("#loading").delay(400).fadeOut("medium");
                        $(".detail_frature>.hotel_sub_wrap").remove();
                        $(".detail_frature").append(data.message);
                        console.log(data.message);
                    },
                    error: function (res) {
                        $("#loading").delay(400).fadeOut("medium");
                    }
                });
            })
        }
        bingClick()
    })
})(jQuery);



