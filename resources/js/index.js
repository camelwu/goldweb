$(function() {
	$(document).ready(function() {
		/*header:站点切换*/
		$(".this_area").hover(function() {
			$(".this_area span").addClass("this_area_on");
			$(".area_box1").addClass("area_box1_on");
			$(".area_box1").show(function() {
				$(".area_box1 a").click(function() {
					//$(".this_area span").html($(this).html() + "站");
					$(".this_area span").removeClass("this_area_on");
					$(".area_box1").stop(false).hide(100);
				});
			});
		},function() {
			$(".area_box1").stop(false).hide(300);
			$(".this_area span").removeClass("this_area_on");
			$(".area_box1").removeClass("area_box1_on");
		});
		/*header:搜索*/
		$(".search_box").click(function(event) {
			var type = $(this).find("option:selected").val(), keyvalue = $(this).find("input").val();
			if (event.target.nodeName === "A") {
				if(keyvalue!=""){
					window.location.href = "/search/" + type + "/" + encodeURI(keyvalue);
				}
			}
		});
		/*banner*/
		$("#banner_search").click(function(event) {
			var inp = $(this).find('input');
			if (event.target.nodeName === "A") {
				inp.val() == "" ? inp.focus() : window.location.href = "/search/guide/" + encodeURI(inp.val());
			}
		});
		/*出游目的地*/
		$(".menu_box").hover(function() {
			$(this).find(".menu_box2").stop(false).fadeIn(300);
		},function() {
			$(this).find(".menu_box2").stop(false).fadeOut(300);
		});
		$(".menu_box2").hover(function() {
			$(this).find(".menu_box3").show();
			$(this).siblings(".menu_box3").hide();
		},function() {
			$(".menu_box3").hide();
		});
		/*左側QQ*/
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
		/*右推荐侧栏*/
		$(".sidebar_box>li").hover(function() {
			$(this).find("ul").stop(false).fadeIn(300);
		},function() {
			$(this).find("ul").stop(false).fadeOut(100);
		});
		$(".hui_top").click(function() {//回顶部
			$("html, body").animate({
				scrollTop : 0
			}, 300)
		});

		function logout() {
			var url = "/async/logout";
			$.getJSON(url, function(json) {
				window.location.reload();
			});
		}
	});
});
