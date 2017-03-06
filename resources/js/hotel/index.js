/**
 * Created by qzz on 2016/11/11.
 */
;$(function () {
    var agesArr=[];

    //国际国内精选酒店城市选择tab

    $('.choose_recom >ul li').click(function () {
        $(this).addClass('selected').siblings('li').removeClass('selected');
        $('.choose_recom_item >ul').hide().eq($(this).index()).show();
    });

    $('.choose_vacation >ul li').click(function () {
        $(this).addClass('selected').siblings('li').removeClass('selected');
        $('.hotel_oneline >ul').hide().eq($(this).index()).show();
    });

    /*酒店城市pop*/
    $("#hotel_inter").popularCityList({
        param: {
            DataType: 1
        },
        textbox: 'hotel_inter',
        showdomestic: false,
    })
    $("#hotel_dom").popularCityList({
        param: {
            DataType: 2
        },
        textbox: 'hotel_dom',
        showdomestic: true,
    })
    /*酒店城市pop*/

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
            var age=[];
            for(var i=0;i<=obj.length-1;i++){
                adultNum+=parseInt(obj[i].adultNum);
                childtNum+=parseInt(obj[i].childtNum);
                age.push(obj[i].ageList);
            }

            console.info(obj);
            $('#hotel_adult_number').css({
                fontSize: '12px'
            }).html(adultNum+ '成人' + childtNum + '儿童').parent('.select_btn').css('textIndent', '5px');
            $("#hotel_room_number").html(obj.length);
            $("#hotel_adult_number").attr("data_age",age.join(","));
        }

    });

    //懒加载
    new lazyLoad('hotelList');

    /*双日期*/
    var dates1 = $("#startdate").datepicker({
        minDate: 0,
        maxDate:"+30d",
        defaultDate: "+0w",
        dateFormat: "yy-mm-dd",
        changeYear: true,
        yearRange: "-0:+1",
        changeMonth: true,
        numberOfMonths: 1,
        onClose: function () {
            $(this).blur();
        },
        onSelect: function (selectedDate) {
            $("#checkOutDate").datepicker("option","minDate", '+1');
            $("#checkOutDate").datepicker("option","maxDate","+1M");
        }
    });

    var dates2 = $("#enddate").datepicker({
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

        }
    });
    //获取当前时间，离开日期默认为t+1  t+4
    function getLocalTime(addNum){
        var today,ms,thatDay, y, m, d,endDate;
        today = new Date().getTime();
        ms = today + addNum*24*60*60*1000;
        thatDay = new Date(ms);
        y = thatDay.getFullYear();
        m = thatDay.getMonth()+1;
        d = thatDay.getDate();
        endDate = y+"-"+toDabble(m)+"-"+toDabble(d);
        function toDabble(num){
            if( num < 10 ){
                num = "0"+num;
            }
            return num;
        }
        return endDate
    }
    $("#date,#startdate").val(getLocalTime(1));
    $("#date,#startdate").attr("date-full-value",getLocalTime(1));
    $('#enddate').val(getLocalTime(4));
    $('#enddate').attr("date-full-value",getLocalTime(4));

    /*点击搜搜按钮*/
    var cityCode,//入住城市三字码   cityCode=BJS
        cityName,//入住城市名称
        checkInDate,//入住时间  checkInDate=2016-07-28
        checkOutDate,//往返时间  checkOutDate=2016-07-30
        numofRoom,//成人数  numofRoom=1
        numofAdult,//成人数  numofAdult=1
        numofChild,
        subscript = 0;//下标

    /*点击搜索跳转*/
    $('#search_hotel_btn').click(function () {
        $("#loading").delay(400).fadeIn("medium");
        if ($(this).attr('data-hotelType') == "hotel_inter") {
            subscript = 0;
        } else {
            subscript = 1;
        }
        //跳转带的参数
        cityCode = $('[input-prompt] .public').eq(subscript).attr("data-code");
        cityName = $('[input-prompt] .public').eq(subscript).attr("data-name");
        citys = (subscript ==0)?($("#hotel_inter").val()):($("#hotel_dom").val());
        checkInDate = $('.hotel_tab_list').find('#startdate').val();
        checkOutDate = $('.hotel_tab_list').find('#enddate').val();
        numofRoom = $('.hotel_tab_list').find('#hotel_room_number').html();
        numofAdult = $('.hotel_tab_list').find('#hotel_adult_number').html().substring(0, 1);
        age=$('#hotel_adult_number').attr("data_age")||"";
        console.log("age:"+age);
        statetype = subscript;
        if ($('#hotel_adult_number').html().length > 3) {
            numofChild = $('#hotel_adult_number').html().substring(3, 4);
        }else{
            numofChild=0;
        }

        //入住城市验证
        if ($('[input-prompt] .public').eq(subscript).val() == '') {
            $('[input-prompt] .public').eq(subscript).focus();
            return;
        }
        //入离店时间验证
        if (checkInDate == '') {
            $('.hotel_tab_list').find('#startdate').focus();
            return;
        }
        if (checkOutDate == '') {
            $('.hotel_tab_list').find('#enddate').focus();
            return;
        }

        window.location.href = "/hotel/lists?cityCode=" + cityCode + "&cityName=" + cityName + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate + "&numofRoom=" + numofRoom + "&numofAdult=" + numofAdult + "&numofChild=" + numofChild+ "&city=" + citys+"&statetype="+statetype+"&age="+age;;
    })

    //格式化时间
    function formatDate(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        m = m < 10 ? '0' + m : m;
        var d = date.getDate();
        d = d < 10 ? ('0' + d) : d;
        return y + '-' + m + '-' + d;
    };
    //国际热门目的地点击
    $('.hot_destination').click(function (e) {
        if ($(e.target).parent().attr('data-cityname')) {
            var cityCode = $(e.target).parent().attr('data-citycode');
            var cityName = $(e.target).parent().attr('data-cityname');
            var citys = $(e.target).parent().find("span").html();
            var checkInDate = formatDate(new Date());
            var checkOutDate = formatDate(new Date(new Date().getTime() + 1 * 24 * 60 * 60 * 1000));
            if ($(".s_index ").attr('data-hotelType') == "hotel_inter") {
                subscript = 0;
            } else {
                subscript = 1;
            }
            var statetype = subscript;
            $("#loading").delay(400).fadeIn("medium");
            window.location.href = "/hotel/lists?cityCode=" + cityCode + "&cityName=" + cityName + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate + "&numofRoom=" + 1 + "&numofAdult=" + 1 + "&numofChild=" + 0+"&city=" + citys+"&statetype="+statetype;
        }
    });


    //存数据，传给detail
    function hotel_user_info() {

        var hotel_user_info = {
            'HotelID': "37",
            'HotelCode': 37,
            'InstantConfirmation': false,
            'freeTransfer': true,
            'AllOccupancy': true,

            "guestNameList": [  //每个房间的入住信息
                {
                    "adult": "1", //	成人数量
                    //"childAges": [5] //儿童年龄
                }
                //{
                //    "adult": "1", //	成人数量
                //    //"childAges": [9] //儿童年龄
                //}
            ],
            "checkInDate": "2016-12-20T00:00:00",
            "checkOutDate": "2016-12-21T00:00:00",
            "numOfRoom": 1, //房间数
            "numOfGuest": 1, //成人数
            "numOfChild": 0, //儿童数
            //"childAges": [5, 9] //儿童年龄
        };

        //console.log(hotel_user_info);

        $.ajax({
            type: "POST",
            url: "/hotel/hotel_users",
            data: hotel_user_info,
            async: true,
            cache: false,
            success: function (res) {
                console.log('session=' + res);
            },
            error: function (res) {
                console.log(res);

            }
        });
    }

    hotel_user_info();

});