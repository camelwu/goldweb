$(function() {
	/*
	* 本函数部分重构，去除无用的点
	*
	*/
	//接收首页地址栏传来的数据
	var hotel_search = window.location.search.substring(1);

	var hotel_arr = hotel_search.split('&');
	console.log(hotel_arr);
	$('.city_hotel').html(decodeURIComponent(hotel_arr[7].split('=')[1]));
	$('#startdate').val(hotel_arr[2].split('=')[1]);
	$('#enddate').val(hotel_arr[3].split('=')[1]);

	$('#hotel_room_number').html(hotel_arr[4].split('=')[1]);
	$('#hotel_adult_number').html(hotel_arr[5].split('=')[1]);
	$('#hotel_child_number').html(hotel_arr[6].split('=')[1]);

	$('.choose_more_btn').click(function() {
		$('.hotel_classify_wrap').slideToggle();
	});

	$('.hotel_classify_bot .cancel').click(function() {
		$('.hotel_type_wrap .filter_cell').removeClass('cur');
		$('#js_hotel_type').addClass('cur');
		$('.hotel_classify_wrap').slideUp();
	});

	//搜索进程
	function process() {
		if (window.bar) {
			window.clearInterval(window.bar);
			window.bar = null;
		}
		var simulate = function() {
			var currNum = parseInt($('.price_loading').eq(0).html()), rn = Math.floor(Math.random() * 4), n = 1;
			switch (rn) {
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
			if (currNum < 99) {
				currNum += n;
				currNum = currNum >= 99 ? 99 : currNum;
				$('.price_loading').eq(0).html(currNum + '%');
			} else {
				window.clearInterval(window.bar);
			}
		};
		window.bar = setInterval(function() {
			simulate();
		}, 50);
	};

	//筛选框操作
	function hotelSearch(className, callback) {
		$(className).click(function(e) {
			if ($(e.target).attr('data-selType') == 'noControl') {
				if (!$(e.target).hasClass('cur')) {
					$(e.target).parents('.hotel_sel_wrap').find('.filter_cell').removeClass('cur');
					$(e.target).addClass('cur');
				}
				if (callback) {
					callback();
				}
			} else if ($(e.target).parents('.filter_cell').attr('data-selType') == 'noControl') {
				if (!$(e.target).parents('.filter_cell').hasClass('cur')) {
					$(e.target).parents('.hotel_sel_wrap').find('.filter_cell').removeClass('cur');
					$(e.target).parents('.filter_cell').addClass('cur');
				}
				if (callback) {
					callback();
				}
			} else {

				//点击的不限以外的按钮
				if ($(e.target).attr('class') == 'filter_cell') {
					var oSpan = $('<span class="choice_bar"><em></em></span>');
					oSpan.find('em').html($(e.target).find('.tip_word').html());
					var shutClose = $('<i class="choice_cross"></i>');
					shutClose.attr('data-chooseType', $(e.target.attr('data-chooseType')));
					shutClose.appendTo(oSpan);
					oSpan.appendTo('.term_wrap');
					$('.clear_all_choice').show();

					$(e.target).parents('.hotel_sel_wrap').find('.filter_cell').eq(0).removeClass('cur');
					$(e.target).addClass('cur');

					if (callback) {
						callback();
					}

				} else if ($(e.target).parents('.filter_cell').attr('class') == 'filter_cell') {

					var oSpan = $('<span class="choice_bar"><em></em></span>');
					oSpan.find('em').html($(e.target).parents('.filter_cell').find('.tip_word').html());
					var shutClose = $('<i class="choice_cross" ></i>');
					shutClose.attr('data-chooseType', $(e.target).parents('.filter_cell').attr('data-chooseType'));
					shutClose.appendTo(oSpan);
					oSpan.appendTo('.term_wrap');
					$('.clear_all_choice').show();

					$(e.target).parents('.hotel_sel_wrap').find('.filter_cell').eq(0).removeClass('cur');
					$(e.target).parents('.filter_cell').eq(0).addClass('cur');

					if (callback) {
						callback();
					}

				} else if ($(e.target).attr('class') == 'filter_cell cur') {
					$(e.target).removeClass('cur');
					var n = $(e.target).parent('.hotel_sel_wrap').length, item_arr = [];
					for (var i = 1; i < $(e.target).parent('.hotel_sel_wrap').length; i++) {
						var searchItem = $(e.target).parent('.hotel_sel_wrap').find('.filter_cell').eq(i);
						if (searchItem.attr('class') == 'filter_cell') {
							item_arr.push(searchItem)
						}
					}
					if (item_arr.length == n - 1) {
						$(e.target).parent('.hotel_sel_wrap').find('.filter_cell').eq(i).addClass('cur');
					}

					for (var i = 0; i < $('.term_wrap .choice_cross').length; i++) {
						if ($('.term_wrap .choice_cross').eq(i).attr('data-choosetype') == $(e.target).attr('data-choosetype')) {
							$('.term_wrap .choice_cross').eq(i).parent().remove();
						}
					}

					if (callback) {
						callback();
					}
				} else if ($(e.target).parents('.filter_cell').attr('class') == 'filter_cell cur') {
					$(e.target).parents('.filter_cell').removeClass('cur');
					var n = $(e.target).parents('.hotel_sel_wrap').find('.filter_cell').length, item_arr = [];
					for (var i = 1; i < n; i++) {
						var searchItem = $(e.target).parents('.hotel_sel_wrap').find('.filter_cell').eq(i);
						if (searchItem.attr('class') == 'filter_cell') {
							item_arr.push(searchItem)
						}
					}
					if (item_arr.length == n - 1) {
						$(e.target).parents('.hotel_sel_wrap').find('.filter_cell').eq(0).addClass('cur');
					}

					for (var i = 0; i < $('.term_wrap .choice_cross').length; i++) {
						if ($('.term_wrap .choice_cross').eq(i).attr('data-choosetype') == $(e.target).parents('.filter_cell').attr('data-choosetype')) {
							$('.term_wrap .choice_cross').eq(i).parent().remove();
						}
					}

					if ($('.choice_bar').length <= 0) {
						$('.clear_all_choice').hide();
					}

					if (callback) {
						callback();
					}
				}

			}

		});

	};

	//收集被选中的条件
	function listenSel() {
		var selObj = {}, rangeArr = [], starArr = [], typeArr = [];

		if ($("#price_start").val() != "" || $("#price_end").val() != "") {
			var obj = {};
			obj.Min = $("#price_start").val() == "" ? 0 : (parseInt($("#price_start").val()) - 1);
			obj.Max = $("#price_end").val() == "" ? 999999 : (parseInt($("#price_end").val()) + 1);
			rangeArr.push(obj);
			console.info("rangeArr:" + JSON.stringify(rangeArr))
		} else {
			//酒店价格
			for (var i = 0; i < $('#hotel_price .cur').length; i++) {
				if ($('#hotel_price .cur').eq(i).attr('data-range') == '不限') {
					var obj = {};
					obj.Min = '0';
					obj.Max = '不限';
					rangeArr.push(obj);
				} else {
					var obj = {};
					obj.Min = $('#hotel_price .cur').eq(i).attr('data-range').split('-')[0];
					obj.Max = $('#hotel_price .cur').eq(i).attr('data-range').split('-')[1];
					rangeArr.push(obj);
				}
			}
		}

		selObj.HotelPriceList = rangeArr;
		//酒店星级
		for (var i = 0; i < $('#hotel_star .cur').length; i++) {
			starArr.push($('#hotel_star .cur').eq(i).attr('data-stars'))
		}
		selObj.StarRating = starArr.join('$');

		//酒店类型
		for (var i = 0; i < $('#hotel_type .cur').length; i++) {
			typeArr.push($('#hotel_type .cur').eq(i).attr('data-cate'))
		}
		selObj.Category = typeArr.join('$');
		selObj.CurrentIndex = $("#hotel_page").find(".pg_curr").html() || 1;
		//推荐好评价格
		for (var i = 0; i < $('.order_div .order_span').length; i++) {
			if ($('.order_div .order_span').eq(i).hasClass('on')) {
				selObj.sorttype = $('.order_div .order_span').eq(i).attr('data-sorttype');
			}
		}

		return selObj;
	};

	//推荐好评价格排序点击
	var bOk = true;
	$('.order_div .order_span').click(function() {
		var selJson = listenSel();
		$('.order_div .order_span').removeClass('on');
		$('.order_div .order_span').eq($(this).index()).addClass('on');
		if ($(this).attr('id') == 'js_recommend') {
			//推荐
			$(this).attr('data-sorttype', 'PriorityDESC');
			selJson.sorttype = 'PriorityDESC';

		} else if ($(this).attr('id') == 'js_great') {
			//好评降序
			$(this).attr('data-sorttype', 'ReviewscoreDESC');
			selJson.sorttype = 'ReviewscoreDESC';
		} else if ($(this).attr('id') == 'js_price') {
			if (bOk) {
				//价格升序
				$(this).find('i').removeClass('down');
				$(this).attr('data-sorttype', 'PriceASC');
				selJson.sorttype = 'PriceASC';
				bOk = false;
			} else {
				//价格降序
				$(this).find('i').addClass('down');
				$(this).attr('data-sorttype', 'PriceDESC');
				selJson.sorttype = 'PriceDESC';
				bOk = true;
			}
		}

		hotel_select(selJson);
	});

	//星级图标
	function start() {
		var lis = $(".hotel_res_item");
		for (var i = 0; i < lis.length; i++) {
			var star = $(lis[i]).find($(".hotel_score")).text();
			$(lis[i]).find($(".night_ow2")).css({
				"width" : star * 14.6 + "px"
			});
		}
	};
	start();
	//搜索栏点击搜索
	$('#search_hotel').click(function() {
		hotel_select(listenSel());
	});

	//酒店价格星级类型筛选
	hotelSearch('.search_term', function() {
		hotel_select(listenSel());
	});

	//筛选结果处去掉其中一个筛选条件
	$('.term_wrap ').click(function(e) {
		if ($(e.target).attr('class') == 'choice_cross') {
			for (var i = 0; i < $('.search_term .filter_cell').length; i++) {
				if ($(e.target).attr('data-chooseType') == $('.filter_wrap .filter_cell').eq(i).attr('data-chooseType')) {
					$('.filter_wrap .filter_cell').eq(i).removeClass('cur');
					hotel_select(listenSel());
				}
			}
			$(e.target).parent().remove();
			if ($('.choice_bar').length <= 0) {
				$('.clear_all_choice').hide();
				$('.search_term .filter_cell').each(function(i) {
					$('.filter_wrap .filter_cell').eq(i).removeClass('cur');
					if ($('.filter_wrap .filter_cell').eq(i).attr('data-seltype') == 'noControl') {
						$('.filter_wrap .filter_cell').eq(i).addClass('cur');
					}
				});

				$("input[name='price_start']").val('');
				$("input[name='price_end']").val('');
				hotel_select(listenSel());
			}
		}
	});

	$(".adslist").on("click", function() {
		$("#loading").delay(400).fadeIn("medium");
		var hotel_user_info = {
			'HotelID' : $(this).attr('data-id'),
			'HotelCode' : $(this).attr('data-id'),
			'InstantConfirmation' : false,
			'freeTransfer' : true,
			'AllOccupancy' : true,
			"guestNameList" : [//每个房间的入住信息
			{
				"adult" : "1", //	成人数量
			}],
			"checkInDate" : $('#startdate').val() + 'T00:00:00',
			"checkOutDate" : $('#enddate').val() + 'T00:00:00',
			"numOfRoom" : vlm.getpara("numofRoom") || 1, //房间数
			"numOfGuest" : vlm.getpara("numofAdult") || 1, //成人数
			"numOfChild" : vlm.getpara("numofChild") || 0, //儿童数\
			"age" : vlm.getpara("age") || "" //儿童数\
		};
		console.log("age：" + vlm.getpara("age"))
		$.ajax({
			type : "POST",
			url : "/hotel/hotel_users",
			data : hotel_user_info,
			async : true,
			cache : false,
			success : function(res) {
				console.log('session=' + res);
				window.location.href = "/hotel/detail";
			},
			error : function(res) {
				$("#loading").hide();
				console.log(res);

			}
		});

	})
	//清除筛选条件
	$('.clear_all_choice').click(function() {
		$(this).hide();
		$('.term_wrap').html('');
		$('.search_term .filter_cell').each(function(i) {
			$('.filter_wrap .filter_cell').eq(i).removeClass('cur');
			if ($('.filter_wrap .filter_cell').eq(i).attr('data-seltype') == 'noControl') {
				$('.filter_wrap .filter_cell').eq(i).addClass('cur');
			}
		});
		hotel_select(listenSel());
	});

	//自定义价格
	$(document.body).on('click', function(event) {
		var target = event.target;
		if ($(target).hasClass('price_input')) {
			var tp = $(target).parents('.search_price').eq(0);
			tp.hasClass('focus') ?
			void (0) : tp.addClass('focus');
		} else if ($(target).hasClass('clear_price')) {
			$("input[name='price_start']").val('');
			$("input[name='price_end']").val('');
		} else if ($(target).hasClass('sure')) {
			if ($('input[name="price_start"]').val() != "" && $('input[name="price_end"]').val() != "") {
				$(target).parents('.search_price').removeClass('focus');
				hotel_select(listenSel());
			} else if ($('input[name="price_start"]').val() == "" && $('input[name="price_end"]').val() == "") {
				$(target).parents('.search_price').removeClass('focus');
			}

		}
	})
	function bindDetailLink() {
		$('.detail_link').click(function(e) {
			//存数据，传给detail
			var hotel_user_info = {
				'HotelID' : $(this).attr('data-hotelcode'),
				'HotelCode' : Number($(this).attr('data-hotelcode')),
				'InstantConfirmation' : false,
				'freeTransfer' : $(this).attr('data-freetransfer'),
				'AllOccupancy' : $(this).attr('hotellist-alloccupancy'),

				"guestNameList" : [//每个房间的入住信息
				{
					"adult" : "1", //	成人数量
					//"childAges": [5] //儿童年龄
				}
				//{
				//    "adult": "1", //	成人数量
				//    //"childAges": [9] //儿童年龄
				//}
				],
				"checkInDate" : $('#startdate').val() + 'T00:00:00',
				"checkOutDate" : $('#enddate').val() + 'T00:00:00',
				"numOfRoom" : $("#hotel_room_number").html(), //房间数
				"numOfGuest" : $("#hotel_adult_number").html(), //成人数
				"numOfChild" : $("#hotel_child_number").html(), //儿童数\
				//"childAges": [5, 9] //儿童年龄
				"age" : vlm.getpara("age") || "" //儿童数\
			};
			$.ajax({
				type : "POST",
				url : "/hotel/hotel_users",
				data : hotel_user_info,
				async : false,
				cache : false,
				success : function(res) {
					vlm.Utils.OpenWin("/hotel/detail");
				},
				error : function(res) {
					alert("接口错误！")
					console.log(res);
				}
			});

		});
	}

	var searchObj = {};
	pageObj.callback = function(page) {
		//alert(page);
		var sel = listenSel();
		hotel_select(sel);
	};
	vlm.Utils.paginate("hotel_page", pageObj, searchObj)
	/*function pagerEventBind() {
		$("#hotel_page").find("a").click(function (e) {

		 });
	}pagerEventBind();*/

	bindDetailLink();
	
	//向php发送请求
	function hotel_select(arg) {

		console.info(hotel_arr);
		var postObj = {
			cityCode : vlm.getpara("cityCode"),
			cityName : vlm.getpara("cityName"),
			currentIndex : arg.CurrentIndex || 1,
			checkInDate : $('#startdate').val(),
			checkOutDate : $('#enddate').val(),
			numofRoom : $('#hotel_room_number').html(),
			numofAdult : $('#hotel_adult_number').html(),
			numofChild : $('#hotel_child_number').html(),
			HotelPriceList : arg.HotelPriceList, //酒店价格
			StarRating : arg.StarRating, //酒店星级
			Category : arg.Category, //酒店类别
			sorttype : arg.sorttype
		};
		$(window).scrollTop("0px");
		$('.num_plass').eq(0).html('<i class="price_loading">0%</i><span class="total_number">正在加载数据...</span>');
		process();
		$('.tour_list_bg').show();
		$('.hotel_list_det_cont').hide();
		$('#hotel_page').hide();
		$.ajax({
			type : "POST",
			url : "/hotel/asy_hotel_lists",
			data : postObj,
			async : true,
			cache : false,
			success : function(res) {
				if (res.success) {
					$('.tour_list_bg').hide();
					$('.hotel_list_det_cont').empty();
					$('.hotel_list_det_cont').html(res.listsHtml).show();
					bindDetailLink();
					$('#hotel_page').show();
					$('.num_plass').eq(0).html('<strong>' + res.hotelCount + '</strong>家酒店满足条件');
				} else {
					$('.num_plass').eq(0).html('<strong>' + res.hotelCount + '</strong>家酒店满足条件');
					$('.hotel_list_det_cont').html(res.listsHtml).show();
				}
			},
			error : function(res) {
				console.log(res);
			}
		});
	};

	/*双日期*/
	var dates2 = $("#startdate,#enddate").datepicker({
		minDate : 0,
		maxDate : '%y-%M-%-{%d+30}',
		defaultDate : "+0w",
		dateFormat : "yy-mm-dd",
		changeYear : true,
		yearRange : "-0:+1",
		changeMonth : true,
		numberOfMonths : 2,
		onClose : function() {
			$(this).blur();
		},
		onSelect : function(selectedDate) {
			var option = this.id == "startdate" ? "minDate" : "maxDate", instance = $(this).data("datepicker"), date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			if (option == "minDate") {
				dates2.not(this).datepicker("option", option, date);
			}
		}
	});

	//列表页地图
	var latArr = [];
	$('#latitude_wrap >li').each(function() {
		var obj = {};
		obj.lat = Number($(this).text().split(',')[0]);
		obj.lng = Number($(this).text().split(',')[1]);
		obj.tag = $(this).text().split(',')[2];
		latArr.push(obj);
	});
	console.info(latArr);
	//console.log(latArr);

	setTimeout(function() {

		mapHandler.init(latArr, "maps", "list");
		//初始化
		setTimeout(function() {
			mapHandler.iconHandler([0, 1, 2, 3]);
			//显示地图中经纬度数组索引为1,2的标记（即标记中心数字为2,3的标记）
		}, 300);

	}, 1000);

	var Height = $('.hotel_list_det_cont').height();
	$(window).scroll(function() {
		if ($(window).scrollTop() >= 630) {
			var H = $(window).height();
			//console.log(Math.floor(($(window).scrollTop()-630)/192));
			var map_index = Math.floor(($(window).scrollTop() - 630) / 192);

			var maps_indexArr = [];
			for (var i = 0; i < 4; i++) {
				maps_indexArr.push(map_index);
				map_index++;
			}
			//console.log(maps_indexArr);
			mapHandler.iconHandler(maps_indexArr);
		}
	});

	//地图跟随浮动图标
	$('#isFixed').click(function() {
		if ($(this).find('.filter_cell ').hasClass('cur')) {
			$(this).find('.filter_cell ').removeClass('cur');

		} else {
			$(this).find('.filter_cell ').addClass('cur');
		}
	});
	//地图滚动时
	$(document).scroll(function() {
		if ($('#isFixed').find('.filter_cell ').hasClass('cur')) {
			var scrolltop = $(window).scrollTop();
			var height = $(window).height();
			var all = $(".all").height();
			if (scrolltop >= 630 && scrolltop < all - height - (height < 1000 ? 600 : 290)) {
				$(".hotel_map_wrap").css({
					"margin-top" : scrolltop - 580 + "px"
				})
			} else if (scrolltop < 800) {
				$(".hotel_map_wrap").css({
					"margin-top" : 0 + "px"
				})
			}
		}
	});
}); 