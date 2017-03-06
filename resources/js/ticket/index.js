+(function($){
    var tabs =function(){
        var tab=$(".ticket_address span");
        var lis = $("#lis ul");
        tab.on("click",function(){
            var $this=$(this);
            var data_index=$this.index();
            tab.removeClass("cur");
            $this.addClass("cur");
            lis.css('display','none');
            lis.eq(data_index).css('display','block');
        })
    };
    var Input = function() {
        $(".public").on("focus", function () {
            $(".search_prompt").slideDown("slow");
            $(".submit_input").val("");
        });
        var Ul = $(".search_prompt");
            Ul.on("click",function(ev){
                var ev = ev || window.event;
                var target = ev.target || ev.srcElement;
                if(target.nodeName.toLowerCase() == "span"){
                    $(".submit_input").val($(target).html());
                    $("#loading").delay(400).fadeIn("medium");

                    window.location.href="/ticket/detail?"+"packageId="+$(target).attr("data-id");
                    Ul.slideUp("fast");
                }
            });
        var ALL = $(".all");//捕获事件
        ALL.on('click', function(ev){
            Ul.slideUp("fast");
        }, true);
        $(".ploy_centent").mouseover(function(){
            var $this=$(this).children().eq(0);
            $this.children().eq(1).css({"height":"100%","background":"rgba(225,225,225,0.15)"});
        }).mouseout(function(){
            var $this=$(this).children().eq(0);
            $this.children().eq(1).css({"height":"20%","background":"url('../../../resources/images/hotel_ticket/shadow_img.png') repeat-x"});
        });
        var ImgHover = function(obj){
            obj.mouseover(function(){
                $(this).children().eq(1).hide();
                $(this).children().eq(2).show();
            }).mouseout(function(){
                $(this).children().eq(1).show();
                $(this).children().eq(2).hide();
            });
        };
        ImgHover($(".hot_fl_one")); ImgHover($(".hot_fr_one"));ImgHover($(".hot_fl_two"));
    };
    var bindOnEvent = function(){

        $(".hot_fl").children().on("click",function(){  $("#loading").delay(400).fadeIn("medium");
            $("#loading").delay(400).fadeIn("medium");
            window.location.href="/ticket/lists?destCityCode="+$(this).attr("data-citycode")+"&destCityName="+$(this).attr("data-cityname");
        });
        $(".hot_fr").children().on("click",function(){
            $("#loading").delay(400).fadeIn("medium");
            window.location.href="/ticket/lists?destCityCode="+$(this).attr("data-citycode")+"&destCityName="+$(this).attr("data-cityname");
        })
        $(document).bind("click",function(e){
            var target = $(e.target);
            if(target.closest(".submit_input").length == 0){
                $(".search_prompt").hide();
            }
        })
    };
    var submitHandle= function(type){
        if(type === "s"){
            $("#loading").delay(400).fadeIn("medium");
            $('.search').addClass('not_allowed').attr("disabled",true).val('搜索中，，，');
        }else{
            $('.search').removeClass('not_allowed').attr("disabled",false).val('搜索')
        }
    };
    var searchSubmit=function(){
        $(".search").on("click",function(){
            if(($(".submit_input").val())==""){
                window.location.href="./lists?"+"destCityCode=SIN&destCityName=新加坡";
                submitHandle("s");
            }else{
                var name=$(".search").parent().children().eq(0).children().val();
                window.location.href="./lists?"+"destCityCode="+name+"&destCityName="+name;
                submitHandle("s");
            }
        })
    };
    var entersubmit = function(event){
        var event = window.event || arguments.callee.caller.arguments[0];
        if (event.keyCode == 13) {
            if ($('.submit_input').val() == '') {
                return false;
            }
            searchSubmit();
            console.log("222")
        }
    };
    searchSubmit();
    entersubmit(event);
    bindOnEvent();
    Input();
    tabs();
})(jQuery);
