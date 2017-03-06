var mapHandler = (function () {
    var myCenter, map, script, mapsEle, ldArray = [], longitude, latitude, markers = [],points=[], dData = null, googleMap = null, baiDuMap = null,
        transferHandler, mapsId, point, pageType = 'list', icons = '../../../resources/images/hotel/hotel_list.png',
        isAbroad = function (lat, lng) {
            if ((lng < 72.004) || (lng > 137.8347)) {
                return true;
            }
            if ((lat < 3.5108) || (lat > 55.8271)) {/*0.8283与实际不符*/
                return true;
            }
            return false;
        },
        loadScript = function () {
            script = document.createElement('script');
            script.type = "text/javascript";
            if (isAbroad(dData.lat, dData.lng)) {
                script.src = "http://maps.google.cn/maps/api/js?key=AIzaSyBV850tYcTCzqZbZKVWpeGYRm0yNYLt9fc&sensor=false&callback=mapHandler.googleMap.initialize";
            } else {
                script.src = "http://api.map.baidu.com/api?v=2.0&ak=MhuuVxziXcOqWUAZ5vVEd4GBUdnZj0yO&callback=mapHandler.baiDuMap.initialize"
            }
            document.body.appendChild(script);
        }, iconHandler = function (aryIndex) {
            isAbroad(dData.lat, dData.lng) ? googleMap.iconHandler(aryIndex) : baiDuMap.iconHandler(aryIndex)
        };

    transferHandler = {

        delta: function (lat, lng) {
            var a = 6378245.0, ee = 0.00669342162296594323;
            var transformLat = function (x, y) {
                var ret = -100.0 + 2.0 * x + 3.0 * y + 0.2 * y * y + 0.1 * x * y + 0.2 * Math.sqrt(Math.abs(x));
                ret += (20.0 * Math.sin(6.0 * x * Math.PI) + 20.0 * Math.sin(2.0 * x * Math.PI)) * 2.0 / 3.0;
                ret += (20.0 * Math.sin(y * Math.PI) + 40.0 * Math.sin(y / 3.0 * Math.PI)) * 2.0 / 3.0;
                ret += (160.0 * Math.sin(y / 12.0 * Math.PI) + 320 * Math.sin(y * Math.PI / 30.0)) * 2.0 / 3.0;
                return ret;
            };
            var transformLng = function (x, y) {
                var ret = 300.0 + x + 2.0 * y + 0.1 * x * x + 0.1 * x * y + 0.1 * Math.sqrt(Math.abs(x));
                ret += (20.0 * Math.sin(6.0 * x * Math.PI) + 20.0 * Math.sin(2.0 * x * Math.PI)) * 2.0 / 3.0;
                ret += (20.0 * Math.sin(x * Math.PI) + 40.0 * Math.sin(x / 3.0 * Math.PI)) * 2.0 / 3.0;
                ret += (150.0 * Math.sin(x / 12.0 * Math.PI) + 300.0 * Math.sin(x / 30.0 * Math.PI)) * 2.0 / 3.0;
                return ret;
            };
            var dLat = transformLat(lng - 105.0, lat - 35.0);
            var dLng = transformLng(lng - 105.0, lat - 35.0);
            var radLat = lat / 180.0 * Math.PI;
            var magic = Math.sin(radLat);

            magic = 1 - ee * magic * magic;
            var sqrtMagic = Math.sqrt(magic);
            dLat = (dLat * 180.0) / ((a * (1 - ee)) / (magic * sqrtMagic) * Math.PI);
            dLng = (dLng * 180.0) / (a / sqrtMagic * Math.cos(radLat) * Math.PI);
            return {lat: dLat, lng: dLng};
        },
        wgs2gcj: function (wgsLat, wgsLng) {
            if (!isAbroad(wgsLat, wgsLng)) {
                return {lat: wgsLat, lng: wgsLng};
            }
            var d = this.delta(wgsLat, wgsLng);
            return {lat: wgsLat + d.lat, lng: wgsLng + d.lng};
        },
        gcj2wgs: function (gcjLat, gcjLng) {
            if (isAbroad(gcjLat, gcjLng)) {
                return {lat: gcjLat, lng: gcjLng};
            }
            var d = this.delta(gcjLat, gcjLng);
            return {lat: gcjLat - d.lat, lng: gcjLng - d.lng};
        }
    };


    //百度类型的地图
    baiDuMap = {
        setMarkers: function () {
            var myIcon = new BMap.Icon(icons, new BMap.Size(20, 25), {
                        offset: new BMap.Size(10, 25), // 指定定位位置
                        imageOffset: new BMap.Size(0, 0), // 设置图片偏移
                    });
            for (var i = 0; i < ldArray.length; i++) {
                var point=new BMap.Point(ldArray[i].lng, ldArray[i].lat - 0.03);
                points.push(point);
                var marker = new BMap.Marker(new BMap.Point(ldArray[i].lng, ldArray[i].lat - 0.03), {
                    icon: myIcon,
                    title:ldArray[i].tag
                });
                var label=new BMap.Label(String(i+1),{offset:new BMap.Size(5,3)});
                marker.setLabel(label);
                markers.push(marker);
            }
            return this;
        },

        iconHandler: function (indexArray) {
            //console.log(indexArray);
            var arr=[];
            for (var i = 0; i < markers.length; i++) {
                map.addOverlay(markers[i]);
                if (indexArray.toString().indexOf(String(i)) != -1) {
                    arr.push(points[i]);
                    markers[i].show();
                } else {
                    markers[i].hide();
                }
            }
            map.setViewport(arr);
        },
        markerEvent: function () {
            for (var i = 0; i < markers.length; i++) {
                if (pageType === "detail") {
                    markers[i].addEventListener('click',function(){
                        map.centerAndZoom(point,15);
                    })
                } else {
                    //转换到大地图页面
                }
            }
            return this;
        },

        initialize: function () {
            map = new BMap.Map(mapsId); // 创建地图实例
            point = new BMap.Point(dData.lng, dData.lat); // 创建点坐标
            map.centerAndZoom(point, 11); // 初始化地图，设置中心点坐标和地图级别

            map.addControl(new BMap.NavigationControl());
            map.addControl(new BMap.ScaleControl());
            map.setDefaultCursor("crosshair");
            map.enableScrollWheelZoom(true);

            this.setMarkers().markerEvent();   //初始化maker
            pageType == 'detail' ? mapHandler.iconHandler([0]) : void(0);  //百度map详情时只传一个
        },
    };

    //Google类型的地图
    googleMap = {
        setMarkers: function () {
            for (var i = 0; i < ldArray.length; i++) {
                var beach = ldArray[i];
                var marker = new google.maps.Marker({
                    position: ldArray[i],
                    label: pageType === "detail" ? "" : {color:"#FFFFFF",fontWeight:"600",text:String(i + 1)},
                    map: pageType === "detail" ? map : void(0),
                    icon: icons,
                    animation: google.maps.Animation.DROP,
                    title: beach['tag']
                });
                if (pageType === "detail") {
                    var infowindow = new google.maps.InfoWindow({
                        content: beach['tag']
                    });
                    infowindow.open(map, marker);
                }
                markers.push(marker);
            }
            return this;
        },
        iconHandler: function (indexArray) {
            for (var i = 0; i < markers.length; i++) {
                if (indexArray.toString().indexOf(String(i)) != -1) {
                    map.setCenter(markers[i].getPosition());
                    markers[i].setMap(map);
                } else {
                    markers[i].setMap(null);
                }
            }
        },
        markerEvent: function () {
            for (var i = 0; i < markers.length; i++) {
                if (pageType === "detail") {
                    google.maps.event.addListener(markers[i], 'click', function () {
                        map.setZoom(15);
                        map.setCenter(markers[i].getPosition());
                    });
                } else {
                    //转换到大地图页面
                }

            }
            return this;
        },
        initialize: function () {
            dData = transferHandler.wgs2gcj(dData.lat, dData.lng);
            myCenter = new google.maps.LatLng(dData.lat, dData.lng);
            var mapProp = {
                center: myCenter,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: false, //关闭默认控件集
                //单个控件控制
                panControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                    position: google.maps.ControlPosition.TOP_LEFT //修改 mapType控件的位置
                },
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true,
                rotateControl: true
            };
            map = new google.maps.Map(mapsEle, mapProp);
            this.setMarkers().markerEvent();
            pageType == 'detail' ? mapHandler.iconHandler([0]) : void(0);
        }
    };
    function init() {
        ldArray = arguments[0];
        mapsId = arguments[1];
        pageType = arguments[2];
        mapsEle = document.getElementById(arguments[1]);
        icons = pageType == 'list' ? '../../../resources/images/hotel/hotel_list.png' : '../../../resources/images/hotel/hotel_detail.png';
        if (!mapsEle) {
            console.log("Need a html element for maps !");
            return;
        }
        dData = ldArray[0];
        loadScript();
    }

    return {
        init: init,
        baiDuMap: baiDuMap,
        googleMap: googleMap,
        iconHandler: iconHandler
    }
})();