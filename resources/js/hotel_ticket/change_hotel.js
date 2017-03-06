/**
 * Created by zhouwei on 2016/8/29.
 */

;(function () {

    var searchData = {
        sort_type : 1,
        star_rating : ''
    };

    $('[checkbox-icon]').on('click', function (e) {
        if (e.target.type != 'checkbox') {
            $('input:checkbox', this).trigger('click');
        }
    });

    $('[checkbox-icon] input:checkbox').on('click', function (e) {
        if ($(this).hasClass('select_all')) {
            if (this.checked) {
                $(this).parents('ul').find('a').addClass('checkbox_cur').find('input:checkbox').prop('checked', e.target.checked);
            } else {
                $(this).parents('ul').find('a').removeClass('checkbox_cur').find('input:checkbox').prop('checked', e.target.checked);
            }
        } else {
            // 处理全选的选中状态, 有一个未选中, 去掉全选, 全部选中时全选自动选中
            if ($(this).parents('ul').find('input.select_all').prop('checked') && $(this).parents('ul').find('input:not(:checked)').length != 0) {
                $(this).parents('ul').find('input.select_all').prop('checked', false).parent('a').removeClass('checkbox_cur');
            } else if (!$(this).parents('ul').find('input.select_all').prop('checked') && $(this).parents('ul').find('input:not(:checked)').length == 1) {
                $(this).parents('ul').find('input.select_all').prop('checked', true).parent('a').addClass('checkbox_cur');
            }
        }
        this.checked ? $(this).parent().addClass('checkbox_cur') : $(this).parent().removeClass('checkbox_cur');
    });


    $('.up_down_btn').on('click', function (e) {
        var thiz = $(this);
        if (thiz.hasClass('cur')) {
            thiz.hasClass('up') ? thiz.removeClass('up').addClass('down').trigger('change_down') : thiz.removeClass('down').addClass('up').trigger('change_up');
        } else {
            $(this).addClass('cur up').trigger('change_up').siblings().removeClass('cur up down');
        }
    });
    $('.up_down_btn.price').on('change_up', function (e) {
        // SortType=1 升序排列
        searchData.sort_type = 1;
        doSearch();
    }).on('change_down', function (e) {
        // SortType=2 降序排列
        searchData.sort_type = 2;
        doSearch();
    });

    $('.checkbox_icon>input').on('click', function () {
        searchData.star_rating = '';
        $('.checkbox_icon>input[name=starRating]:checked').each(function (index, el) {
            if (searchData.star_rating.length != 0) {
                searchData.star_rating += '$';
            }
            searchData.star_rating += $(el).val();
        });
        doSearch();
    });

    function doSearch() {

        $('#loading-div').show();
        $.ajax({
            type:"POST",
            url:"/hotelticket/ajax_change_hotel",
            data: searchData,
            success: function(res){
                var i, len;
                $('[hotel-list]').empty();
                $('.location_div').empty();
                var json = eval('(' + res + ')');
                if (json.success) {
                    if(json.data.hotels=="") {
                        creatNoData();
                    }else{
                        for (i=0, len=json.data.hotels.length; i<len; i++) {
                            createHotelElement(json.data.hotels[i]);
                        }
                    }
                    //if(json.data.locationList!=""){
                    //    creatElect(json.data.locationList);
                    //}
                }
                $('#loading-div').hide();
            },
            error:function(res){
                alert('网络请求失败!');
                $('#loading-div').hide();
            }
        });
    }
function creatNoData(){
    var htmlNo = [
        '        <div class="hotel clearfix">',
        '          <div class="tour_list_info">',
        '            <ul>',
        '               <p class="no_get_data">未能搜索到数据，<br>请更换条件再试试!</p>',
        '            </ul>',
        '           </div> ',
        '        </div>'
    ].join('');
    $('[hotel-list]').append(htmlNo);
}
    function creatElect(hotel) {
        var str = "";
        for (var i = 0; i < hotel.length; i++) {
            console.log(hotel[i]);
            str += '<li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" name="starRating" value="2 星级"></a></i> '+hotel[i]+ '</li>';
        }
        console.log(str);
        var htmlElect = [
            '      <div class="checkbox_list clearfix">',
            '       <div>地理位置:</div>',
            '           <ul class="clearfix">',
            '               <li checkbox-icon><i class="icon"><a href="javascript:void(0);" class="checkbox_icon"><input type="checkbox" class="select_all"></a></i>全部</li>'+str+' </ul>',
            '       </div>',
            '    </div>'
        ].join('');
        $('.location_div').append(htmlElect);
    }
    function createHotelElement(hotel) {
        var html = [
            '        <div class="hotel clearfix">',
            '            <div class="hotel_img">',
            '                <img src="' + hotel.hotelPictureURL + '" alt="">',
            '            </div>',
            '            <div class="hotel_detail">',
            '                <div class="hotel_msg">',
            '                    <div class="title">',
            '                        <span class="main">' + hotel.hotelName + '</span>',
            '                        <span class="type">' + hotel.starRating + '</span>',
            '                        <span class="score">' + hotel.hotelGenInfo.hotelReviewScore + '</span>',
            '                        <span class="total">/ 5分</span>',
            '                        <span class="comment_count">（' + hotel.hotelGenInfo.hotelReviewCount + '条评论）</span>',
            '                    </div>',
            '                    <div class="address clearfix">',
            '                        <div class="title fl">酒店地址</div>',
            '                        <div class="content fl clearfix">',
            '                            <div class="fl">' + hotel.hotelGenInfo.hotelAddress + '</div>',
            '                            <i></i>',
            '                        </div>',
            '                    </div>',
            '                    <div class="facilities clearfix">',
            '                        <div class="title fl">酒店设施</div>',
            '                        <div class="content fl clearfix">',
            '                            <!--TODO 只有一个wifi字段-->',
            '                            <!--<i class="food"></i>-->',
            '                            <!--<i class="park"></i>-->',
            '                            ' + (hotel.hotelGenInfo.isFreeWiFi ? '<i class="wifi"></i>' : ''),
            '                        </div>',
            '                    </div>',
            '                    <div class="price">',
            '                        <!--TODO 没有单人最低价字段-->',
            '                        ￥<span>' + (hotel.avgRatePerPaxInCNY < hotel.avgRatePerPaxSeparatelyInCNY ? hotel.avgRatePerPaxInCNY : hotel.avgRatePerPaxSeparatelyInCNY) + '</span>起/人',
            '                    </div>',
            '                    <div class="show_room clearfix" hotel-id="' + hotel.hotelID + '" hotel-name="' + hotel.hotelName + '">',
            '                        <i class="fr"></i>',
            '                        <div class="fr">查看房型</div>',
            '                    </div>',
            '                    <div class="hide_room clearfix" style="display: none;">',
            '                        <i class="fr"></i>',
            '                        <div class="fr">收起房型</div>',
            '                    </div>',
            '                </div>',
            '                <div class="hotel_room" style="display: none;">',
            '                    <div class="room_title clearfix">',
            '                        <div class="room_type fl">房型</div>',
            // '                        <div class="bed_type fl">床型</div>',
            '                        <div class="breakfast fl">是否含早</div>',
            // '                        <div class="change_rule fl">退改规则</div>',
            '                        <div class="diff_price fl">差价</div>',
            '                        <div class="reserve fl">预订</div>',
            '                    </div>',
            '                    <div class="room_list">',
            '                        <ul>',
            '                        </ul>',
            '                    </div>',
            '                </div>',
            '            </div>',
            '        </div>'
        ].join('');
        $('[hotel-list]').append(html);
    }

    $(document.body).on('click', function (e) {
        var target = $(e.target);
        if (target.parent().hasClass('show_room')) {
            var thiz = $(e.target).parent();
            var roomUl = thiz.parent().siblings('.hotel_room').find('.room_list>ul');

            if (!roomUl.hasClass('room_loaded')) {
                $('#loading-div').show();
                $.ajax({
                    type:"POST",
                    url:"/hotelticket/asy_get_hotel_rooms",
                    data: {
                        hotelId : thiz.attr('hotel-id')
                    },
                    success: function(res){
//                        console.log(res);
                        var rooms = res.data.hotels[0].rooms;
                        var i=0, len = rooms.length;
                        for (i; i<len; i++) {
                            var html = [
                                '                            <li>',
                                '                                <div class="grid_item clearfix">',
                                '                                    <div class="room_type fl hide_img">',
                                '                                        <div class="fl" title="' + rooms[i].roomName + '">' + rooms[i].roomName + '</div>',
                                '                                        <i></i>',
                                '                                    </div>',
                                '                                    <!--TODO 床型字段未找到-->', //床型字段未找到
                                // '                                    <div class="bed_type fl">-----</div>',
                                '                                    <div class="breakfast fl">' + (rooms[i].includedBreakfast ? '含早' : '不含') + '</div>',
                                '                                    <!--TODO 退改规则字段未找到-->', // 退改规则字段未找到
                                // '                                    <div class="change_rule fl">----</div>',
                                '                                    <div class="diff_price fl ' + (rooms[i].markUp>0 && 'orange') + '">+￥' + rooms[i].markUp + '</div>',
                                '                                    <div class="reserve fl">',
                                '                                        <div class="select_btn" ' +
                                '                                                room-name="' + rooms[i].roomName + '" ' +
                                '                                                room-id="' + rooms[i].roomID + '" ' +
                                '                                                hotel-id="' + thiz.attr('hotel-id') + '" ' +
                                '                                                hotel-name="' + thiz.attr('hotel-name') + '" ' +
                                '                                                package-id="' + res.data.packageID + '">选择</div>',
                                '                                    </div>',
                                '                                </div>',
                                '                                <div class="room_detail" style="display: none;">',
                                '                                    <div class="img_list clearfix">',
                                '                                        <div class="img">',
                                '                                            <img src="' + rooms[i].roomPictureURL + '" alt="">',
                                '                                        </div>',
                                '                                    </div>',
                                '                                    <div class="room_text">',
                                '                                        ' + (rooms[i].roomDescription || ''),
                                '                                    </div>',
                                '                                </div>',
                                '                            </li>'
                            ].join('');
                            roomUl.append(html);
                        }
                        roomUl.find('.room_type').on('click', function (e) {
                            var thiz = $(this);
                            if (thiz.hasClass('show_img')) {
                                thiz.removeClass('show_img').addClass('hide_img').parent().siblings('.room_detail').slideToggle();
                            } else {
                                thiz.removeClass('hide_img').addClass('show_img').parent().siblings('.room_detail').slideToggle();
                            }
                        });
                        roomUl.addClass('room_loaded');
                        $('#loading-div').hide();
                        thiz.hide().siblings('.hide_room').show().parent().siblings('.hotel_room').slideToggle();
                    },
                    error:function(res){
                        alert('获取酒店房间信息失败!');
                    }
                });
            } else {
                thiz.hide().siblings('.hide_room').show().parent().siblings('.hotel_room').slideToggle();
            }
        } else if (target.parent().hasClass('hide_room')) {
            target.parent().hide().siblings('.show_room').show().parent().siblings('.hotel_room').slideToggle();
        } else if (target.hasClass('select_btn')) {
            var roomID = target.attr('room-id');
            var roomName = target.attr('room-name');
            var hotelID = target.attr('hotel-id');
            var hotelName = target.attr('hotel-name');
            var packageID = target.attr('package-id');
            $('#loading-div').show();
            $.ajax({
                type:"POST",
                url:"/hotelticket/ajax_select_room",
                data: {
                    hotelId : hotelID,
                    hotelName : hotelName,
                    roomId : roomID,
                    roomName : roomName,
                    packageId : packageID
                },
                success: function(res){
                    // $('#loading-div').hide();
                    var json = eval('(' + res + ')');
                    gotoDetail(packageID, json.data.hotelID, json.data.roomID);
                },
                error:function(res){
                    alert('获取酒店房间信息失败!');
                }
            });
        }
    });
})();