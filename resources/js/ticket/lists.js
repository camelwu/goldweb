;(function($){
    $(document).ready(function(){
        var process = function(){
            if(window.bar){
                window.clearInterval(window.bar);
                window.bar = null;
            }
            var simulate  = function(){
                var currNum = parseInt($('.price_loading').eq(0).html()), rn = Math.floor(Math.random()*4),n = 1;
                switch (rn){
                    case 0:
                        n = 1;
                    break;
                    case 1:
                        n = 2;
                        break;
                    case 2:
                        n = 3;
                        break;
                    case 3:
                        n = 5;
                        break;
                    default:
                        n = 1;
                }
                if(currNum < 99){
                    currNum += n;
                    currNum = currNum >= 99 ? 99 : currNum;
                    $('.price_loading').eq(0).html(currNum+'%');
                }else{
                    window.clearInterval(window.bar);
                }
            };
            window.bar = setInterval(function(){
                simulate ();
            },50);
        };
        var parseUrlHandler= function (url, isEncode) {
            var isEncode = isEncode || false, reg = /([^=&?]+)=([^=&?]+)/g, obj = {}, url = url;
            url.replace(reg, function () {
                var arg = arguments;
                obj[arg[1]] = isEncode ? decodeURIComponent(arg[2]) : arg[2];
            });
            return obj;
        };
        var urlData = parseUrlHandler(window.location.href);
        var ajaxHandler = function(){
            $('.num_plass').eq(0).html('<i class="price_loading">0%</i><span class="total_number">正在加载报价...</span>');
             process();
             var priceStr = function(){
                 console.log($('.order_span').attr("data-sort"));
                    //return  $('.order_span').eq(0).hasClass('down')?'highToLow':'lowToHigh';
                 return $('.order_span.on').attr("data-sort");
             },bgWrap = $('.tour_list_bg').eq(0),tour_list_info = $('.tour_list_info').eq(0), sg = $('h4 strong').eq(0);

             var postObj = {
                 destCityCode:Boolean(urlData.destCityCode)?urlData.destCityCode:"SIN",
                 subProduct:"all",
                 themeID:$('.filter_cell.cur').eq(0).attr('data-id'),
                 themeIDSpecified:$('.filter_cell.cur').eq(0).attr('data-id')?true:false,
                 priceSortType:priceStr(),
                 postClass:arguments[1],
                 pageIndex:arguments[0],
                 pageSize:10,
                 minPrice:$('input[name="price_start"]').val(),
                 maxPrice:$('input[name="price_end"]').val()
             };
            if($('input[name="searchText"]').val()){
                postObj.packageName = $('input[name="searchText"]').val()
            }
            bgWrap.css('display','block');
            tour_list_info.css('display','none');
            $.ajax({
                type:"POST",
                url:"/ticket/asy_ticket_lists",
                data: postObj,
                async:true,
                cache: false,
                success: function(res){
                    bgWrap.css('display','none');
                    tour_list_info.html(res.listsHtml);
                    tour_list_info.css('display','block');
                    $('.num_plass').eq(0).html('<strong>'+res.totalCount+'</strong>个景点满足条件');
                    if(res.postClass == "A"){ /*目前后台总会给出主题数据*/
                       $('.filter_zone').eq(0).html(res.themesHtml);
                    }
                },
                error:function(res){
                    bgWrap.css('display','none');
                    tour_list_info.css('display','block');
                    sg.html(res.totalCount);
                    $('.bg_list').each(function(){
                        $(this).hide();
                    });
                    $('.flight_list_no_info').eq(0).show();
                    $('.flight_list_no_info.flight_no_tip').eq(0).html(res.statusText);
                }
            });
        };
        /*景点目的地中文名*/
        if(urlData.destCityName){
            $('.destCityName').eq(0).html(decodeURI(urlData.destCityName));
        }
       $(document.body).on('click',function(event){
           var event = event || window.event;
           var target = event.target || event.srcElement;
           if($(target).hasClass('price_input')){
                 var tp = $(target).parents('.search_price').eq(0);
                 tp.hasClass('light')?void(0):tp.addClass('light');
           }else if($(target).hasClass('clear_price')){
                  $("input[name='price_start']").val('');
                  $("input[name='price_end']").val('');
           }else if($(target).hasClass('sure')){
              $(target).parents('.search_price').removeClass('light');
               if($('input[name="price_start"]').val()!=""&&$('input[name="price_end"]').val()!=""){
                   ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")
               }else if($('input[name="price_start"]').val()==""&&$('input[name="price_end"]').val()==""){
                   ajaxHandler(1,"B")
               }else if($('input[name="price_start"]').val()!=""&&$('input[name="price_end"]').val()==""){
                   alert("请输入区间价")
               }else if($('input[name="price_start"]').val()==""&&$('input[name="price_end"]').val()!=""){
                   alert("请输入区间价")
               }
           }else if($(target).parents('.filter_cell').length == 1){
               $(target).parents('.filter_cell').eq(0).addClass('cur').siblings().removeClass('cur');
               ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")
           }else if($(target).hasClass('order_span')){
               $(target).parent().find("span").removeClass("on");
               $(target).addClass("on");
               $(target).hasClass('down')?$(target).removeClass('down'):$(target).addClass('down');
               if($(target).attr("data-sort")!=""){
                 $(target).hasClass('down')?$(target).attr("data-sort","highToLow"):$(target).attr("data-sort","lowToHigh")
               }

               ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")
           }else if(target.id == "search"){
               ajaxHandler(1,"A")
           }else if($(target).parent().parent().hasClass('index_num_wrap')){
                 var curNum = "";
                 if($(target).hasClass('pg_link')){
                       curNum = $(target).text();
                 }else if($(target).hasClass('pg_pre')){
                       curNum  = Number($('.pg_curr').eq(0).text())-1;
                 }else if($(target).hasClass('pg_next')){
                       curNum  = Number($('.pg_curr').eq(0).text())+1;
                 }
               var num = $("#pageTotal").val();
               if( curNum>=1 && curNum<=(Math.ceil(num/10))){
                   ajaxHandler(curNum,"A");
               }
           }
       })
    })
})(jQuery);