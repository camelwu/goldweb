/**
 * Created by DELL on 2016/11/17.
 */
;(function($){
    $(document).ready(function(){
        var curIndex = 0,uWidth, sWidth, isSc = false,imgOut, maxLeft,maxTop,viewPort,
            scrollleft, scrolltop,out, hWrap,lWrap, size, intNum = 6;
        var changeTo=function(){
            if (curIndex == size) {
                hWrap.css({ left: 0 });
                curIndex = 1;
            }
            if (curIndex == -1) {
                hWrap.css({ left: -(size - 1) * uWidth });
                curIndex = size - 1;
            }
            hWrap.stop().animate({ left: -curIndex * uWidth }, isSc?0:500);
            $(".icon_inner a").eq(curIndex).addClass("indexOn").siblings().removeClass("indexOn");
            $("#hotelPhotoIndex").html(curIndex+1);
            var sIndex = Math.floor(curIndex/intNum);
            lWrap.stop().animate({ left: -sIndex * (uWidth+13)}, isSc?0:500);
            if(curIndex+1 == size){
                $('.prev_area').show();
                $('.next_area').hide();
            }else if(curIndex == 0){
                $('.prev_area').hide();
                $('.next_area').show();
            }else{
                $('.prev_area').show();
                $('.next_area').show();
            }
            isSc = false;
        };
        var getViewPort= function (){
            if(document.compatMode == "BackCompat"){
                return {
                    width:document.body.clientWidth,
                    height:document.body.clientHeight
                }
            }else{
                return {
                    width:document.documentElement.clientWidth,
                    height:document.documentElement.clientHeight
                }
            }
        };
        var pre_next = function(){
            $(".prev_btn").click(function(){
                curIndex--;
                changeTo();
            });
            $(".next_btn").click(function(){
                curIndex++;
                changeTo();
            });
        };
        var addMouseEvent = function(){
            out.onmouseenter = function(e){
                var event = e || window.event;
                var target = event.target||event.srcElement;
                var bigImg = document.createElement("img");
                viewPort = getViewPort();
                if(596<viewPort.width && viewPort.width<1184){
                    intNum = 5;
                }else if(viewPort.width <596){
                    intNum = 4;
                }
                imgOut = document.createElement("div");
                bigImg.src="http://www.baidu.com/img/baidu_sylogo1.gif";
                imgOut.style.width = 346+"px";
                imgOut.style.height = 230+"px";
                imgOut.style.position = "fixed";
                imgOut.style.zIndex = 25;
                imgOut.style.display = "none";
                imgOut.style.border ="4px solid #e0e3eb";
                bigImg.style.width = "100%";
                bigImg.style.height = "100%";
                imgOut.appendChild(bigImg);
                document.body.appendChild(imgOut);
            };
            out.onmousemove = function(e){
                var event = e || window.event;
                var target = event.target||event.srcElement, imgTar;
                if(imgOut&&target.tagName === "IMG"){
                    imgTar = imgOut.getElementsByTagName('IMG')[0];
                    imgTar.setAttribute('src',target.getAttribute('src') );
                    imgOut.style.display = "block";
                    maxLeft = viewPort.width-imgOut.offsetWidth;
                    maxTop = viewPort.height-imgOut.offsetHeight;
                    imgOut.style.left = (event.clientX +15)<=maxLeft?event.clientX +15 +"px":event.clientX-imgOut.offsetWidth-15+"px";
                    imgOut.style.top = (event.clientY +15)<=maxTop?event.clientY+15 +"px":maxTop+"px";
                }
            };
            out.onmouseleave = function(e){
                if(imgOut){
                    document.body.removeChild(imgOut)
                }

            };
        };
        var init =function(){
            var tem = document.getElementById(arguments[0]);
            if(!tem){
                console.error("Need an id String !");
                return;
            }
            out = tem;
            addMouseEvent();
            lWrap = $(".icon_inner");
            uWidth = $(".slide").eq(0).outerWidth(true);
            sWidth =$(".hotel_gallery_pic").eq(0).outerWidth(true);
            hWrap = $(".hotel_gallery_img_wrap");
            size = $(".hotel_gallery_img_wrap .slide").length;
            $('.icon_wrap').width(uWidth);
            hWrap.width(uWidth*size);
            lWrap.width(sWidth*size+4);
            pre_next();
        };
        var throttle = function ( fn, interval ) {
            var __self = fn, timer, firstTime = true;

            return function () {
                var args = arguments,
                    __me = this;

                if ( firstTime ) {
                    __self.apply(__me, args);
                    return firstTime = false;
                }
                if ( timer ) {
                    return false;
                }
                timer = setTimeout(function () {
                    clearTimeout(timer);
                    timer = null;
                    __self.apply(__me, args);

                }, interval || 500 );

            };

        };
        $(document.body).on('click', function(event){
            var target = event.target;
            if($(target).hasClass('close_btn')){
                $("#hotel_gallery").hide();
            }
            if($(target).hasClass('s_icon')||$(target).hasClass('target_img')){
                isSc = true;
                $(target).hasClass('target_img')?$("#hotel_gallery").show():"";
                curIndex = Number($(target).attr('data-index'));
                changeTo();
            }else if($(target).parents('.img_left').length==1 || $(target).parents('.img_out_li').length==1){
                $("#hotel_gallery").show();
            }
        });
        window.onresize = throttle(function(){
            viewPort = getViewPort();
            lWrap = $(".icon_inner");
            uWidth = $(".slide").eq(0).outerWidth(true);
            sWidth =$(".hotel_gallery_pic").eq(0).outerWidth(true);
            hWrap = $(".hotel_gallery_img_wrap");
            $('.icon_wrap').width(uWidth);
            hWrap.width(uWidth*size);
            lWrap.width(sWidth*size+4);
            if(596<viewPort.width && viewPort.width<1184){
                intNum = 5;
            }else if(viewPort.width <596){
                intNum = 4;
            }
        }, 500);
        init('en_wrap');
        });
})(jQuery);