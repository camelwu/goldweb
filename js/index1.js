

function responsive(){//页面宽度响应式
    var zw=$(window).width();
	if(zw<1150){
		$(".sidebar_box").animate({right:-100},200);
		$(".hui_top").animate({right:-100},200);
		}
	if(zw>1150){
		$(".sidebar_box").animate({right:0},200);
		$(".hui_top").animate({right:1},200);
		}
	if(zw<1200){
		$(".menu_box3").stop(false).animate({width:730},200);
		$(".wrapper").stop(false).animate({width:980},200);
		$(".commitment_box ul li").css("margin-right","0.3%");
		$(".rbd_l_bg").css("width","170px");
	}else{
		$(".menu_box3").stop(false).animate({width:950},200)
		$(".wrapper").stop(false).animate({width:1200},200);

		$(".commitment_box ul li").css("margin-right","3%");
		$(".rbd_l_bg").css("width","220px");		
	};
}

function banner(){//banneravr切换
	$(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,easing:"easeOutCirc",delayTime:800})
	}

function index_click(){//单击事件
	$(".nav_main li").click(function(){//主导航单击事件
		$(this).siblings().removeClass("nav_on");
		$(this).addClass("nav_on");
	});
	$(".this_area").mouseenter(function(){//出发地  
		$(".this_area span").addClass("this_area_on");
		$(".area_box1").addClass("area_box1_on");
		$(".area_box1").show(function(){
			$(".area_box1 a").click(function(){
				$(".this_area span").html($(this).html()+"站");
				$(".this_area span").removeClass("this_area_on");
				$(".area_box1").stop(false).hide(100);
				})
			});
	});
	$(".this_area").mouseleave(function(){//出发地    
		$(".area_box1").stop(false).hide(300);
		$(".this_area span").removeClass("this_area_on");
		$(".area_box1").removeClass("area_box1_on");
	});

	$(".menu_box").mouseenter(function(){//目的地
		$(this).find(".menu_box2").stop(false).fadeIn(300,function(){
			$(".menu_box .menu_box2").mouseenter(function(){
				$(this).find(".menu_box3").show();
				$(this).siblings(".menu_box3").hide();
				})
		});
	})
	$(".menu_box").mouseleave(function(){//目的地
		$(this).find(".menu_box2").stop(false).fadeOut(300,function(){
			$(".menu_box .menu_box2").mouseleave(function(){
				$(".menu_box3").hide();
				})
		});
	})

	$(".recom_box ul li").click(function(){//推荐旅游导航单击事件
	    $(this).siblings().removeClass("recom_on");
	    $(this).addClass("recom_on");
	});
	$(".index_option li").click(function(){//热门跟团游title单击事件
		$(this).siblings().removeClass("index_option_on");
		$(this).addClass("index_option_on");
	});
	$(".sa_title li").click(function(){//热门跟团游二级title单击事件
		$(this).siblings().removeClass("sa_title_on");
		$(this).addClass("sa_title_on");
	});
	$(".city_box li").click(function(){	//热门跟团游左侧景区
	    $(this).siblings().removeClass("city_li_on");
	    $(this).addClass("city_li_on");	
	});
	$(".sidebar_box>li").mouseenter(function(){//侧栏
		$(this).find("ul").stop(false).fadeIn(300);	
		})
	$(".sidebar_box>li").mouseleave(function(){
		$(this).find("ul").stop(false).fadeOut(100);
		})
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
	$(".cd_info_title li").click(function(){//商品详情——订单导航
		$(this).siblings().removeClass("cd_on");
	    $(this).addClass("cd_on");	
	});
	$(".hui_top").click(function(){//回顶部
		$("html, body").animate({ scrollTop:0},300)
	});
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
		$(".number_days li span").removeClass("sob_on");
		$(this).addClass("sob_on");
	});
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
	$(".page_box li").click(function(){//页码
		$(this).siblings().removeClass("pb_on");
		$(this).addClass("pb_on");
	});
	$(".mc_status a").click(function(){
		$(this).siblings().removeClass("mc_on");
		$(this).addClass("mc_on");
	});
	$(".about_left li").click(function(){//关于我们左侧单击
	    
		var al_num=$(".about_left li").index(this);
		$(this).siblings().removeClass("al_li");
		$(this).addClass("al_li");
		$(".about_right ul").hide();
		$(".about_right ul").eq(al_num).show(0);
		var about_left_h=$(".about_box").height()-2;
		$(".about_left").height(about_left_h).css("min-height","500px");
		})
	$(".scenic_area>li").mouseenter(function(){
		$(this).find(".sa_mask").stop(false).animate({bottom:0},300);
	})
	$(".scenic_area>li").mouseleave(function(){
		$(this).find(".sa_mask").stop(false).animate({bottom:-138},200);
	})
}


$(function(){ //加载
	responsive();
	banner();
	index_click();
});
$(window).resize(function(){//窗口大小改变
	responsive();
	});