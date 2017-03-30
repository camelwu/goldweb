function responsive() {//页面宽度响应式
	var zw = $(window).width();
	if (zw < 1150) {
		$(".sidebar_box").animate({
			right : -100
		}, 200);
		$(".hui_top").animate({
			right : -100
		}, 200);
	}
	if (zw > 1150) {
		$(".sidebar_box").animate({
			right : 0
		}, 200);
		$(".hui_top").animate({
			right : 1
		}, 200);
	}
	if (zw < 1200) {
		$(".menu_box3").stop(false).animate({
			width : 730
		}, 200);
		$(".wrapper").stop(false).animate({
			width : 980
		}, 200);
		$(".commitment_box ul li").css("margin-right", "0.3%");
		$(".rbd_l_bg").css("width", "170px");
		$(".comm_login li").stop(false).animate({
			marginRight : "1.2%"
		}, 200);
		$(".comm_bdL .calendar dd a").css("width", "14.03%");
		$(".cd_info_title").width(770);
		$(".comm_ctR .gaiyao dd").width(300);
		$(".number_days .visa_dest").width(690);
		$(".number_days .visad_box").width(663);
		$(".popup").css("margin-left", "-490px");
		$(".mask_banner .slideBox .bd ul li img").width(605)
	} else {
		$(".menu_box3").stop(false).animate({
			width : 950
		}, 200)
		$(".wrapper").stop(false).animate({
			width : 1200
		}, 200);
		$(".commitment_box ul li").css("margin-right", "3%");
		$(".rbd_l_bg").css("width", "220px");
		$(".comm_login li").stop(false).animate({
			marginRight : "4.6%"
		}, 200);
		$(".comm_login .comm_pf").stop(false).animate({
			marginRight : 0
		}, 200);
		$(".comm_bdL .calendar dd a").css("width", "14.058%");
		$(".cd_info_title").width(943);
		$(".comm_ctR .gaiyao dd").width(390);
		$(".number_days").css("width", "100%");
		$(".number_days .visad_box").width(835);
		$(".popup").css("margin-left", "-600px");
		$(".mask_banner .slideBox .bd ul li img").width(740)
	};
}

function index_click() {//导航和侧栏
	$(".this_area").mouseenter(function() {//出发地
		$(".this_area span").addClass("this_area_on");
		$(".area_box1").addClass("area_box1_on");
		$(".area_box1").show(function() {
			$(".area_box1 a").click(function() {
				$(".this_area span").html($(this).html() + "站");
				$(".this_area span").removeClass("this_area_on");
				$(".area_box1").stop(false).hide(100);
			});
		});
	});
	$(".this_area").mouseleave(function() {//出发地
		$(".area_box1").stop(false).hide(300);
		$(".this_area span").removeClass("this_area_on");
		$(".area_box1").removeClass("area_box1_on");
	});
	$(".menu_box").mouseenter(function() {//目的地
		$(this).find(".menu_box2").stop(false).fadeIn(300, function() {
			$(".menu_box .menu_box2").mouseenter(function() {
				$(this).find(".menu_box3").show();
				$(this).siblings(".menu_box3").hide();
			});
		});
	});
	$(".menu_box").mouseleave(function() {//目的地
		$(this).find(".menu_box2").stop(false).fadeOut(300, function() {
			$(".menu_box .menu_box2").mouseleave(function() {
				$(".menu_box3").hide();
			});
		});
	});
	$(".sidebar_box>li").mouseenter(function() {//侧栏
		$(this).find("ul").stop(false).fadeIn(300);
	});
	$(".sidebar_box>li").mouseleave(function() {
		$(this).find("ul").stop(false).fadeOut(100);
	});
	$(".hui_top").click(function() {//回顶部
		$("html, body").animate({
			scrollTop : 0
		}, 300)
	});

	/*
	 $(".reg_title li").click(function(){//注册
	 var regtl_num=$(".reg_title li").index(this)+1;
	 $(".phone_mailbox").hide();
	 $(".pm_box"+regtl_num).show();
	 $(this).siblings().removeClass("reg_hd_on");
	 $(this).addClass("reg_hd_on");
	 });
	 $(".domestic_top li").mouseenter(function(){ //国内游
	 $(this).siblings().stop(false).animate({opacity:0.6},200);
	 $(this).stop(false).animate({opacity:1},200);
	 })
	 $(".domestic_top li").mouseleave(function(){ //国内游
	 $(".domestic_top li").stop(false).animate({opacity:1},200);
	 })

	 $(".visad_ul li").click(function(){
	 $(this).siblings().removeClass("on");
	 $(this).addClass("on");
	 });

	 $(".cd_info_title li").click(function(){//商品详情——订单导航
	 //$(this).siblings().removeClass("cd_on");
	 // $(this).addClass("cd_on");
	 var cdit_num=$(".cd_info_title li").index(this)+1;
	 var cdit_top=$(".cd_t"+cdit_num).offset().top-60;
	 $("html, body").animate({ scrollTop: cdit_top},300);
	 });
	 $(".trip_left ul li").click(function(){//商品详情——天数导航
	 var cdit_num=$(".trip_left ul li").index(this);
	 var cdit_top=$(".frt_ul").eq(cdit_num).offset().top-50;
	 $("html, body").animate({ scrollTop: cdit_top},300);

	 });
	 $(".comm_bdR .bd_route .route_ct a").click(function(){//商品详情-详细
	 var rct=$(this);
	 $(".exp_ct").toggle(0,function(){
	 if(rct.html()=="详细"){
	 rct.html("收起")
	 }else{
	 rct.html("详细")
	 }
	 });
	 $(".comm_bdR .bd_route .route_ct").css("height","auto");
	 })

	 $(".dest_zhou_box li").click(function(){//筛选洲/城市
	 var dz_num=$(this).index(".dest_zhou_box li");
	 $(this).siblings().removeClass("dest_zhou_on");
	 $(this).addClass("dest_zhou_on");
	 $(".dest_guo_box li").siblings().removeClass("dest_guo_on");
	 $(".dest_guo_box li").eq(dz_num).addClass("dest_guo_on");
	 $(".dest_guo_box li span").removeClass("dga_on");
	 });
	 $(".dest_guo_box li span").click(function(){//筛选国家/旅游胜地
	 $(this).siblings().removeClass("dga_on");
	 $(this).addClass("dga_on");
	 });
	 $(".set_out_box li span").click(function(){//出发地
	 $(".set_out_box li span").removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });
	 $(".service_mold li span").click(function(){//服务类型
	 $(".service_mold li span").removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });
	 $(".number_days li span").click(function(){//行程天数
	 $(this).siblings().removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });
	 $(".stay_box li span").click(function(){
	 $(".stay_box li span").removeClass("sob_on");//住宿类型
	 $(this).addClass("sob_on");
	 })
	 $(".sob_box li span").click(function(){//预算花费
	 $(".sob_box li span").removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });
	 $(".route_box li span").click(function(){//航线
	 $(".route_box li span").removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });
	 $(".cruises_brand li span").click(function(){//游轮品牌
	 $(".cruises_brand li span").removeClass("sob_on");
	 $(this).addClass("sob_on");
	 });

	 $(".mc_status a").click(function(){
	 $(this).siblings().removeClass("mc_on");
	 $(this).addClass("mc_on");
	 });

	 $(".jq_price .price_exp").mouseenter(function(){
	 $(this).find("div").show();
	 })
	 $(".jq_price .price_exp").mouseleave(function(){
	 $(this).find("div").hide();
	 })
	 $(".dm_box a").click(function(){
	 $(".mask_bg").fadeIn(300);
	 $(".popup").fadeIn(300);
	 })
	 $(".mask_bg,.show_x").click(function(){//弹窗
	 $(".mask_bg").fadeOut(300);
	 $(".popup").fadeOut(300);
	 })
	 $(".mask_tab").eq(0).show();
	 $(".mask_title ul li").click(function(){//弹窗切换
	 $(this).siblings().removeClass("on");
	 $(this).addClass("on");
	 var num_mt =$(this).index();
	 $(".mask_tab").eq(num_mt).show();
	 $(".mask_tab").eq(num_mt).siblings().hide();
	 })
	 */
}


$(window).resize(function() {//窗口大小改变
	responsive();
});

$(function() {//加载
	responsive();
	index_click();
	$(document).ready(function() {
		$("#banner_search").click(function(event) {
			var inp = $(this).find('input');
			if (event.target.nodeName === "A") {
				inp.val() == "" ? inp.focus() : window.location.href = "/search/0/" + encodeURI(inp.val());
			}
		});
		//左側
		$(".side ul li").hover(function() {
			$(this).find(".sidebox").stop().animate({
				"width" : "124px"
			}, 200).css({
				"opacity" : "1",
				"filter" : "Alpha(opacity=100)",
				"background" : "#ae1c1c"
			});
		}, function() {
			$(this).find(".sidebox").stop().animate({
				"width" : "54px"
			}, 200).css({
				"opacity" : "0.8",
				"filter" : "Alpha(opacity=80)",
				"background" : "#000"
			});
		});
	});
});
