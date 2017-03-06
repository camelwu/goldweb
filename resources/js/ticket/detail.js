;(function ($) {
    $(document).ready(function () {
        var itemWrap = $('#detail_part_wrap .detail_part'), itemTitles = $('.nav_ul li'), maxCut, midCut, minCut, stTag = false;
        var stopDefault = function( e )
        {
            if ( e && e.preventDefault )
                e.preventDefault();
            else
                window.event.returnValue = false;
        },ajaxHandler = function(){
            $.ajax({
                type:"GET",
                url:"/ticket/getPrice",
                async:true,
                cache: false,
                success: function(res){
                    if(!res.success){
                        requestTip('e');
                      requestTip2('e');
                        showMsg(res.msg);
                    }else{
                        location.href = "/ticket/order";
                    }
                },
                error:function(res){
                    console.log(res);
                }
            });
        },requestTip = function(type){
                if(type === "s"){
                    $('.btn').addClass('not_allowed').attr("disabled",true).val('预订中...')
                }else{
                    $('.btn').removeClass('not_allowed').attr("disabled",false).val('立即预订')
                }
        },requestTip2 = function(type){
          if(type === "s"){
            $('.book_btn').addClass('not_allowed').attr("disabled",true).val('预订中...')
          }else{
            $('.book_btn').removeClass('not_allowed').attr("disabled",false).val('立即预订')
          }
        };
        if(itemWrap.length !== 0){
            maxCut = itemWrap.eq(0)[0].getBoundingClientRect().top;
            midCut = itemWrap.eq(0)[0].getBoundingClientRect().top-itemWrap.eq(1)[0].getBoundingClientRect().top;
            minCut = itemWrap.eq(0)[0].getBoundingClientRect().top-itemWrap.eq(2)[0].getBoundingClientRect().top;
            var bookBtn = $(".book_btn");
            $(window).scroll(function () {
                var top = document.getElementById('detail_part_wrap').getBoundingClientRect().top, c_top,op = $('#hotel_tabs_box'),
                    bScrollTop = $(document.body).eq(0).scrollTop();
              if(top <= 62){
                bookBtn.removeClass("hidden");
                op.addClass('fixTab');
                var arr = ["#1F","#2F","#3F"];
                $("#nav_ul li").each(function(i){
                  $("#nav_ul li").eq(i).find("a").attr("href",arr[i])
                })
              }else{
                bookBtn.addClass("hidden");
                op.removeClass('fixTab');
                $("#nav_ul li").find("a").attr("href","javascript:;")
              }
                //top <= 62 ? op.addClass('fixTab') : op.removeClass('fixTab');
              /*c_top = top;
                if(!stTag){
                    if(c_top < minCut){
                        itemTitles.eq(2).addClass('cur').siblings().removeClass('cur');
                    }else if(c_top<midCut&&c_top>minCut){
                        itemTitles.eq(1).addClass('cur').siblings().removeClass('cur');
                    }else if(c_top>midCut){
                        itemTitles.eq(0).addClass('cur').siblings().removeClass('cur');
                    }
                }
                stTag = false;*/
            });
            $("#nav_ul li").each(function(i){
              $("#nav_ul li").eq(i).click(function(){
                $("#nav_ul li").eq(i).addClass('cur').siblings().removeClass('cur');
                $(".detail_part").eq($(this).index()).show().siblings().hide();
              })
            })
            /*$(document.body).on('click', function (e) {
                if (e.target.className == 'wa') {
                    stTag = true;
                    $(e.target).parent().addClass('cur').siblings().removeClass('cur');
                }
            });*/
        }
        $(document.body).on('click',function(e){
          if(e.target.className === "btn"){
            ajaxHandler();
            requestTip('s');
          }
          if(e.target.className === "book_btn"){
            ajaxHandler();
            requestTip2('s');
          }
        })

    })
})(jQuery);