/*
 * vlm.js
 * name:vehicle_layout_mobile
 * out_api:pls check return
 * auth:wusongbo
 * 2015-11-12
 * ver:1.1.1
 */
(function(e, t) {
	var n = n || (function(n) {
		_init = function() {
			_loadend();
		}, _loading = function(k) {
			if ($("#preloader").css('display') == 'none') {
				$("#status").css({
					backgroundImage : "../images/loading" + k + ".gif"
				});
				$("#status").fadeIn();
				$("#preloader").delay(400).fadeIn("medium");
			}
		}, _loadend = function() {
			if ($("#preloader").css('display') != 'none') {
				$("#status").fadeOut();
				$("#preloader").delay(400).fadeOut("medium");
			}
		}, _idType = {
			1 : '护照',
			2 : '身份证',
			3 : '出生证明',
			4 : '港澳通行证',
			5 : '军官证',
			6 : '驾驶证',
			7 : '台胞证',
			8 : '回乡证',
			9 : '其他'
		}, _getpara = function(str) {
			var reg = new RegExp("(^|&)" + str + "=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if (r != null)
				return decodeURIComponent(r[2]);
			return null;
		}, _Utils = {
			//分页
			paginate : function(containerId, pageObj, searchObj) {
				var totalCount = pageObj.totalCount;
				var perPageCount = pageObj.perPageCount ? pageObj.perPageCount : 20;
				var callback = pageObj.callback;
				var currentPage = pageObj.currentPage;
				$("#" + containerId).pagination(totalCount, {
					items_per_page : perPageCount,
					num_display_entries : 6,
					current_page : currentPage,
					num_edge_entries : 1,
					callback : pageselectCallback
				});

				function pageselectCallback(page_id, jq) {
					$.extend(searchObj, {
						"page" : page_id + 1,
						"rows" : perPageCount
					});
					callback(searchObj, false);
				}

			},
			Storage : function() {

			},
			OpenWin : function(url) {
				var openwin = document.getElementById("openwin");
				// 防止反复添加
				if (!openwin) {
					var a = document.createElement("a");
					a.setAttribute("href", url);
					a.setAttribute("target", "_blank");
					a.setAttribute("id", "openwin");
					document.body.appendChild(a);
					a.click();
				} else {
					openwin.click();
				}

			}
		}, loadHtml = function(url, data, mycallback, async, encryption, isShowLoading) {
			data = JSON.stringify(data);

			if (isShowLoading != undefined && isShowLoading == true) {
				//ajax 不全屏显示loading
				$(t).ajaxStart(function() {
					$("#preloader").hide();
					$('#status').hide();
				}).ajaxStop(function() {
					$("#preloader").hide();
					$('#status').show();
				});
			} else {
				// 1.8以后，ajaxStart要绑定到document
				$(t).ajaxStart(function() {
					$("#preloader").show();
					$('#status').show();
				}).ajaxStop(function() {
					$("#preloader").hide();
					$('#status').show();
				});
			}
			if (async != undefined && async == true) {
				$.ajaxSetup({
					async : false
				});
			};
			var apiUrl = url == "" ? _api : url;
			$.ajax({
				type : "post",
				url : apiUrl + '?rnd=' + Math.random(),
				timeout : 1000 * 60 * 5,
				data : data,
				contentType : 'html;charset=utf-8',
				beforeSend : function(xhr) {
					//xhr.setRequestHeader("Accept-Encoding", "gzip");
					//xhr.setRequestHeader('Content-Type','application/json');
					if (encryption != undefined && encryption == true) {
						var uid = md5("zhangfengming");
						var password = md5("");
						xhr.setRequestHeader('uid', user);
					}
				},
				success : function(jsondata) {
					mycallback(jsondata);
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					if (textStatus == 'timeout') {
						alert("网络不给力，刷新重试！");
						window.location.reload();
					}
				}
			});
			$.ajaxSetup({
				async : true
			});
		};
		return {
			Utils : _Utils,
			getpara : _getpara,
			idType : _idType
		};
	})();
	if ( typeof module !== "undefined" && module.exports) {
		module.exports = n;
	}
	if ( typeof ender === "undefined") {
		this.vlm = n;
	}
	if ( typeof define === "function" && define.amd) {
		define("vlm", ['jquery'], function($) {
			return n;
		});
	}
}).call(this, window, document);
