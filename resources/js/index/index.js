(function(){
    //酒+景
    $("#ht_search_box").popularCityList({
        param: {
            DataType: 4 //4为酒景类型
        },
        textbox: 'ht_search_box',
        showdomestic: true
    });
    //景点
    $("#ticket_input").popularCityList({
        param: {
            DataType: 4 //4为酒景类型
        },
        textbox: 'ticket_input',
        showdomestic: true
    });
    /*酒店城市pop*/
    $("#hotel_inter").popularCityList({
        param: {
            DataType: 1
        },
        textbox: 'hotel_inter',
        showdomestic: false,
    });
    $("#hotel_dom").popularCityList({
        param: {
            DataType: 2
        },
        textbox: 'hotel_dom',
        showdomestic: true,
    });


    //房间人数年龄选择
    var  personNum =  new select_person_pop().init({
        isShowRoom: true,
        type: "ticket",// ticket:景点门票， hotel_ticket:酒景
        elemId: "person_select",//
        maxRoom: $("#hotel_room_number").val(),
        minPax: 1,//最小总人数
        maxPax: 2,//最多总人数
        maxAdult: 6, //最多成人数
        childAgeMax: 11,//最多儿童数
        childAgeMin: 2,//最小儿童年龄
        onlyForAdult: false,//最只能是成人
        callback: function (obj) {

            var adultNum=0;
            var childtNum=0;
            var age =[];
            for(var i=0;i<=obj.length-1;i++){
                adultNum+=parseInt(obj[i].adultNum);
                childtNum+=parseInt(obj[i].childtNum);
                age.push(obj[i].ageList);
            }

            console.info(obj);
            $('#hotel_adult_number').css({
                fontSize: '12px'
            }).html(adultNum+ '成人' + childtNum + '儿童').parent('.select_btn').css('textIndent', '5px');
            $("#hotel_room_number").html(obj.length)
            $("#hotel_adult_number").attr("data_age",age.join(","));

        }

    }),dates2 = $("#startdate,#enddate,#readonly").datepicker({
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
    }),getLocalTime = function(addNum){
        //获取当前时间，离开日期默认为t+1  t+4
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
    var clickHandle = function(){
        //tab栏切换
        function show(index) {
            $('.tab_name>div').removeClass('cur').eq(index).addClass('cur');
            $('.tab_list>div').css({"display":"none"}).eq(index).css({"display":"inline-block"});
        }
        $('.tab_name>div').on('click', function (e) {
            show($(this).index());
        });
        show(0);
        //海外酒店模块切换
        $('#hotel_title > li').click(function () {
            $(this).addClass('hot_cur').siblings('li').removeClass('hot_cur');
            $('.hotel_content').hide().eq($(this).index()).show();
        });
        //热门主题玩法，模块切换
        $('#theme_title > li').click(function () {
            $(this).addClass('hot_cur').siblings('li').removeClass('hot_cur');
            $('.theme_content').hide().eq($(this).index()).show();
        });
        $(window).scroll(function(){
            if($(window).scrollTop() >= 600){
                var Wtop=$(window).scrollTop();
                $(".left_anchor").css({"margin-top":Wtop-530+"px"});
            }else{
                $(".left_anchor").css({"margin-top":70+"px"});
            }
            if(($(".all").height()-160-530)< $(window).scrollTop()+$(window).height()){
                $(".left_anchor").css({"margin-top":Wtop-1004+"px"});
            }
        });
        //左侧锚点
        $('.variety span').click(function () {
            $(this).addClass('cur').parent().siblings().find('span').removeClass('cur');
            $(this).find("i").addClass('icon_cur').parent().parent().siblings().find('i').removeClass('icon_cur');
        });
        $(".span_back").on("click",function(){
            $('body,html').animate({
                    scrollTop: 0
                },
                1000);
            return false;
        });
    }, skipHandle = function(){
        //格式化时间
        function formatDate(date) {
            var y = date.getFullYear();
            var m = date.getMonth() + 1;
            m = m < 10 ? '0' + m : m;
            var d = date.getDate();
            d = d < 10 ? ('0' + d) : d;
            return y + '-' + m + '-' + d;
        };
        $('.h_link').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            var cityCode = $(this).find("div.hot_content_info").attr('data-citycode');
            var cityName = $(this).find("div.hot_content_info").attr('data-cityname');
            var citys = $(this).find("div.hot_content_info").attr('data-citys');
            var checkInDate = formatDate(new Date());
            var checkOutDate = formatDate(new Date(new Date().getTime() + 1 * 24 * 60 * 60 * 1000));
            window.location.href = "./hotel/lists?cityCode=" + cityCode + "&cityName=" + cityName + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate + "&numofRoom=" + 1 + "&numofAdult=" + 1 + "&numofChild=" + 0+"&city=" + citys+"&statetype="+"0";
        });
        $('.t_title').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            window.location.href="/ticket/lists?destCityCode="+$(this).attr("data-destCityCode")+"&destCityName="+$(this).attr("data-destCityName");
        });
        $('.T_package').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            window.location.href="/ticket/detail?packageId="+$(this).attr("data-packageID");
        });
        $('.T_by').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            window.location.href="/ticket/detail?packageId="+$(this).attr("data_t_id");
        });
        $('.ht_by').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            //window.location.href="Expect/index"
            window.location.href="/hotelticket/detail?packageID="+$(this).attr("data_ht_id")+"&leadinPrice="+$(this).attr("data_ht_price");
        })
        $('.ht_title').on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            //window.location.href="Expect/index"
            window.location.href="/hotelticket/lists?DestCityCode="+$(this).attr("data-destCityCode")+"&DestCity="+$(this).attr("data-destCityName");
        });
    };
    var ajaxHandle = {
        hotelAjax :function(){
            /*点击搜索跳转*/
            $('#hotel_search').click(function () {
                $("#loading").delay(400).fadeIn("medium");
                if ($(this).attr('data-hotelType') == "hotel_inter") {
                    subscript = 0;
                } else {
                    subscript = 1;
                }
                //跳转带的参数
                cityCode = $('[input-prompt] .public').eq(subscript).attr("data-code");
                cityName = $('[input-prompt] .public').eq(subscript).attr("data-name");
                citys = ( subscript == 0)?($("#hotel_inter").val()):($("#hotel_dom").val());
                checkInDate = $('.hotel_tab_list').find('#startdate').val();
                checkOutDate = $('.hotel_tab_list').find('#enddate').val();
                numofRoom = $('.hotel_tab_list').find('#hotel_room_number').html();
                numofAdult = $('.hotel_tab_list').find('#hotel_adult_number').html().substring(0, 1);
                age=$('#hotel_adult_number').attr("data_age");
                statetype= subscript;
                if ($('#hotel_adult_number').html().length > 3) {
                    numofChild = $('#hotel_adult_number').html().substring(3, 4);
                }else{
                    numofChild=0;
                }
                console.log(numofChild);
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
                window.location.href = "/hotel/lists?cityCode=" + cityCode + "&cityName=" + cityName + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate + "&numofRoom=" + numofRoom + "&numofAdult=" + numofAdult + "&numofChild=" + numofChild+ "&city=" + citys+"&statetype="+statetype+"&age="+age;
            })
        },
        tickeAjax :function(){
            var submitHandle= function(type){
                if(type === "s"){
                    $("#loading").delay(400).fadeIn("medium");
                    $('#ticket_search').addClass('not_allowed').attr("disabled",true).val('搜索中，，，');
                }else{
                    $('#ticket_search').removeClass('not_allowed').attr("disabled",false).val('搜索')
                }
            };
            $("#ticket_search").on("click",function(){
                //if(($(".ticket_input").val())==""){
                //    window.location.href="./ticket/lists?"+"destCityCode=SIN&destCityName=新加坡";
                //    submitHandle("s");
                //}else{
                //    var sub=$(".search").parent().children().eq(0).children().val();
                //    window.location.href="../ticket/lists?"+"destCityCode="+sub+"&destCityName="+sub;
                //    submitHandle("s");
                //}
                window.location.href="./ticket/lists?destCityCode="+$("#ticket_input").attr("data-code")+"&destCityName="+$("#ticket_input").attr("data-code");
            })
        },
        flightAjax:function(){
            //往返城市切换
            $(".icon_city").attr("data-iscur","false");
            $(".tab_font").each(function(i){
                $(".tab_font").eq(i).find(".icon_city").click(function(){
                    if(!$(".tab_font").eq(i).attr("data-iscur")){
                        $(this).addClass('cur')
                        $(".tab_font").eq(i).attr("data-iscur","true")
                    }else{
                        $(this).removeClass('cur');
                        $(".tab_font").eq(i).attr("data-iscur","false")
                    }
                    setTimeout(function(){
                        var leave = {},arrive = {};
                        leave.cityCodeFrom = $(".tab_font").eq(i).find('.cityCodeFrom').attr('data-code');
                        leave.cityNameFrom = $(".tab_font").eq(i).find('.cityCodeFrom').val();
                        arrive.cityCodeFrom = $(".tab_font").eq(i).find('.cityCodeTo').attr('data-code');
                        arrive.cityNameFrom = $(".tab_font").eq(i).find('.cityCodeTo').val();
                        $(".tab_font").eq(i).find(".cityCodeFrom").val(arrive.cityNameFrom);
                        $(".tab_font").eq(i).find(".cityCodeFrom").attr("data-name",arrive.cityNameFrom);
                        $(".tab_font").eq(i).find(".cityCodeFrom").attr("data-code",arrive.cityCodeFrom);
                        $(".tab_font").eq(i).find(".cityCodeTo").val(leave.cityNameFrom);
                        $(".tab_font").eq(i).find(".cityCodeTo").attr("data-name",leave.cityNameFrom);
                        $(".tab_font").eq(i).find(".cityCodeTo").attr("data-code",leave.cityCodeFrom);
                    },100)
                })
            });
            indexf = {
                tabChange : function(hide,index){
                    $(".tab_way").eq(index).addClass("curs").parent().siblings().find(".tab_way").removeClass("curs");
                    $(hide).hide().siblings("input").show();
                }
            }
            //点击tab单返程切换
            $('#readonly').click(function(){
                indexf.tabChange("#enddate",0)
            });
            $('.tab_route').click(function(){
                indexf.tabChange("#readonly",1)
            });
            $('.tab_oneway').click(function(){
                indexf.tabChange("#enddate",0);
                $('#readonly').val("");
            });
            /*点击搜搜按钮*/
            var routeType,//单程，往返   routeType=return
                cityCodeFrom,//出发城市三字码   cityCodeFrom=BJS
                cityCodeTo,//到达城市三字码   cityCodeTo=NYC
                departDate,//离开时间  departDate=2016-07-28
                returnDate,//往返时间  returnDate=2016-07-30
                numofAdult,//成人数  numofAdult=1
                numofChild,//儿童数  numofChild=0
                cabinClass,
                cityNameFrom,
                cityNameTo;
            var subscript = 0;//下标
            /*点击搜索跳转*/
            $('#flight_search').click(function(){
                $("#loading").delay(400).fadeIn("medium");
                dataWay = $(this).attr('data-way');
                if(dataWay == "0"){
                    subscript = 0;
                }else{
                    subscript = 1;
                }
                //跳转带的参数
                routeType = $('.type span').eq(subscript).attr('data-routeType');
                cityCodeFrom = $('.tab_font').eq(subscript).find('.cityCodeFrom').attr("data-code");
                cityNameFrom = $('.tab_font').eq(subscript).find('.cityCodeFrom').val();
                cityCodeTo = $('.tab_font').eq(subscript).find('.cityCodeTo').attr("data-code");
                cityNameTo = $('.tab_font').eq(subscript).find('.cityCodeTo').val();
                departDate = $('.tab_font').eq(subscript).find('.departDate').attr("date-full-value");
                returnDate = $('.tab_font').eq(subscript).find('.returnDate').attr("date-full-value");
                numofAdult = $('.tab_font').eq(subscript).find('#numofAdult').html()-0;
                numofChild  = $('.tab_font').eq(subscript).find('#numofChild').html()-0;
                cabinClass = $('.tab_font').eq(subscript).find('.cabinClass').attr('data-type');
                /*2016.8.4  判断往返地址是否相同*/
                if($("#city").attr("data-name") == $("#city2").attr("data-name")){
                    showMsg("往返地址不能相同")
                }else{
                    if(returnDate){
                        window.location.href = "/flight/lists?routeType="+routeType+"&cityCodeFrom="+cityCodeFrom+"&cityCodeTo="+cityCodeTo+"&cityNameFrom="+cityNameFrom+"&cityNameTo="+cityNameTo+"&departDate="+departDate+"&returnDate="+returnDate+"&numofAdult="+numofAdult+"&numofChild="+numofChild+"&cabinClass="+cabinClass;
                    }else{
                        window.location.href = "/flight/lists?routeType="+routeType+"&cityCodeFrom="+cityCodeFrom+"&cityCodeTo="+cityCodeTo+"&cityNameFrom="+cityNameFrom+"&cityNameTo="+cityNameTo+"&departDate="+departDate+"&numofAdult="+numofAdult+"&numofChild="+numofChild+"&cabinClass="+cabinClass;
                    }
                }
            })
        },
        hotelticketAjax:function(){
            $('#ht_search').on('click', function () {
                window.location.href = '/hotelticket/lists?DestCityCode='+$("#ht_search_box").attr("data-code")+'&DestCity='+$("#ht_search_box").attr("data-name");
            });
        }
    };
    ajaxHandle.hotelAjax();
    ajaxHandle.tickeAjax();
    ajaxHandle.flightAjax();
    ajaxHandle.hotelticketAjax();
    clickHandle();
    skipHandle();
})();