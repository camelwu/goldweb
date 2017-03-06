;(function($){
  $(document).ready(function(){
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
      var priceStr = function(){
        if($(".choosePrice").hasClass("order_span")){
          if($('.choosePrice').hasClass('down')){
            return "highToLow"
          }else{
            return "lowToHigh"
          }
        }
        if($(".chooseRecommend").hasClass("order_span")){
          return ""
        }
        //return  $('.choosePrice').hasClass('down')?'highToLow':'lowToHigh';
      };
      var bgWrap = $('.tour_list_bg').eq(0);
      var tour_list_info = $('.tour_list_info').eq(0);
      var sg = $('h4 strong').eq(0);
      var postObj = {
        destCityCode:Boolean(urlData.DestCityCode)?urlData.DestCityCode:"SIN",//"SIN"目的地城市编码
        themeID:$('.filter_cell.cur').eq(0).attr('data-id'),//	主题ID
        themeIDSpecified:$('.filter_cell.cur').eq(0).attr('data-id')?true:false,//主题ID是否必须
        durationValue:$('.filter_p.cur').eq(0).attr('data-days'),//入住天数
        priceSortType:priceStr(),//价格排序类型（枚举值 HighToLow, LowToHigh）
        postClass:arguments[1],
        pageIndex:arguments[0],//页号（从1开始）
        pageSize:10,//单页大小
        minPrice:$('input[name="price_start"]').val(),//最小价格
        maxPrice:$('input[name="price_end"]').val()//最大价格
      };
      if($('input[name="searchText"]').val()){//搜索
        postObj.packageName = $('input[name="searchText"]').val()
      }
      bgWrap.css('display','block');
      tour_list_info.css('display','none');
      $.ajax({
        type:"POST",
        url:"/hotelticket/asy_ticket_lists",
        data: postObj,
        async:true,
        cache: false,
        success: function(res){
          bgWrap.css('display','none');
          tour_list_info.html(res.listsHtml);
          tour_list_info.css('display','block');
          sg.html(res.totalCount);
          if(res.postClass == "A"){
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
          $('.flight_list_no_info .flight_no_tip').eq(0).html(res.statusText);
        }
      });
      console.log(postObj)
    };

    /*景点目的地中文名*/
    if(urlData.destCityName){
      $('.destCityName').eq(0).html(decodeURI(urlData.destCityName));
    }
    $(".all").on('click',function(e){
      //alert(2)
      if($(e.target).hasClass('price_input')){
        var tp = $(e.target).parents('.search_price').eq(0);
        tp.hasClass('light')?void(0):tp.addClass('light');
      }else if($(e.target).hasClass('clear_price')){
        $("input[name='price_start']").val('');
        $("input[name='price_end']").val('');
      }else if($(e.target).hasClass('sure')){
        $(e.target).parents('.search_price').removeClass('light');
        if($('input[name="price_start"]').val()!=""&&$('input[name="price_end"]').val()!=""){
          ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")
        }else if($('input[name="price_start"]').val()==""&&$('input[name="price_end"]').val()==""){
          ajaxHandler(1,"B")
        }else if($('input[name="price_start"]').val()!=""&&$('input[name="price_end"]').val()==""){
          alert("请输入区间价")
        }else if($('input[name="price_start"]').val()==""&&$('input[name="price_end"]').val()!=""){
          alert("请输入区间价")
        }
        //alert(1)
      }else if($(e.target).parent().hasClass('filter_cell')){
        var op = $(e.target).parent();
        //后台只支持单选，int型数据
        op.addClass('cur').siblings().removeClass('cur');
        ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")

      }else if($(e.target).parent().hasClass("filter_p")){
        //酒景列表天数筛选
        $(e.target).parent().addClass('cur').siblings().removeClass('cur');
        ajaxHandler($('.pg_curr').eq(0).length!=0?Number($('.pg_curr').eq(0).text()):1,"B")

      //  价格高低筛选
      }else if($(e.target).hasClass('choosePrice')||$(e.target).parent().hasClass('choosePrice')) {
        $(".choosePrice").addClass("order_span").siblings().removeClass("order_span");
        $(e.target).hasClass('down') ? $(e.target).removeClass('down') : $(e.target).addClass('down');
        ajaxHandler($('.pg_curr').eq(0).length != 0 ? Number($('.pg_curr').eq(0).text()) : 1, "B")

      //  推荐排序筛选
      }else if($(e.target).hasClass('chooseRecommend')||$(e.target).parent().hasClass('chooseRecommend')){
        $(".chooseRecommend").addClass("order_span").siblings().removeClass("order_span").removeClass("down");
        //$(e.target).hasClass('down') ? $(e.target).removeClass('down') : $(e.target).addClass('down');
        ajaxHandler( 1, "B")

      }else if(e.target.id == "search"){
        if($('input[name="searchText"]').val()!=""){
          ajaxHandler(1,"A")
        }else{
          //$('input[name="searchText"]').focus();
          ajaxHandler(1,"B")
        }
      }else if($(e.target).parent().parent().hasClass('index_num_wrap')){
        var curNum = "";
        if($(e.target).hasClass('pg_link')){
          curNum = $(e.target).text();
        }else if($(e.target).hasClass('pg_pre')){
          curNum  = Number($('.pg_curr').eq(0).text())-1;
        }else if($(e.target).hasClass('pg_next')){
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