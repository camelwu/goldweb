(function ($) {

    $.fn.popularCityList = function (options) {
        var settings = $.extend({
            url: "",
            cols: "5",
            // headername: "热门城市（可直接输入城市或城市拼音）",
            textbox: "",
            lbldomestic: "国内",
            lblinternational: "国际",
            param: {},
        }, options);

        this.keyup(function () {
            if ($(this).val().length > 0) {
                var divPCL = $("#divPCL");
                var divPCLOverlay = $("#divPCLOverlay");
                if (divPCL.length > 0) {
                    divPCL.hide();
                    divPCLOverlay.hide();
                }
            }
            else {
                getPopularCityList($(this), settings, $(this).parent());
            }
        });

        this.focus(function () {
//            if ($(this).val().length == 0) {
            getPopularCityList($(this), settings, $(this).parent());
            // $(this).val("");//2016.8.4  amy
//            }
        });
    };

    function getPopularCityList(thisObj, settings, parent) {
        var data = {"DataType": settings.param.DataType};
        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "/index/asyGetCityList" + '?rnd=' + Math.random(),
            data: JSON.stringify(data),
            contentType: 'application/json;charset=utf-8',
            success: function (data) {
                data=JSON.parse(data);
                 $("#loading").hide();
                if(data.success){
                    renderResult(thisObj, data.data, settings, parent);
                }
                else{
                     showMsg("获取目的地城市接口出错！")
                }
            },
            error: function () {
                $("#loading").hide();
                thisObj.blur();
                showMsg("获取城市失败,网络请求超时！");

            }
        })
    }

    function renderResult(thisObj, data, settings, parent) {

        var divPCL = $("#divPCL");
        var divPCLOverlay = $("#divPCLOverlay");
        var content = generateAllPopularCitiesHtml(thisObj, data, settings);
        var left = fix_div_coordinate(document.getElementById(settings.textbox), "left"); //thisObj.position().left;
        var top = fix_div_coordinate(document.getElementById(settings.textbox), "top"); //thisObj.position().top + thisObj.height() + 5;

        if (divPCLOverlay.length > 0) {
            divPCLOverlay.remove();
        }
        var objBody = $("body");
        objBody.append('<div id="divPCLOverlay" style="z-index:500;min-width:800px;min-height:600px;position:absolute;left:0px;top:0px;background-color: rgba(0, 0, 0, 0.01);">' +
            '<div id="divPCL" style="display:none;left:' + left.toString() + 'px;top:' + top.toString() + 'px;";></div>' +
            '</div>');

        divPCL = $("#divPCL");
        divPCL.html(content);

        $("#popularTabControl").tabs();
        $("#otherPopularTabControl").tabs();
        divPCLOverlay.show();
        divPCL.show();

        $('#divPCL table').find('td').click(function () {
            var divPCL = $("#divPCL");
            var divPCLOverlay = $("#divPCLOverlay");
            var selectedCity = $(this).attr("title");
            if (selectedCity != "") {
                thisObj.val(selectedCity);
                if (thisObj.attr('data-hotel') == 'hotel') {
                    thisObj.attr("data-code", $(this).attr("data-countryCode")); //hotel 取data-countryCode
                    debugger;
                    thisObj.attr("data-name", $(this).attr("data-citynameeng")); //hotel 取data-countryCode
                } else {
                    thisObj.attr("data-code", $(this).attr("data-id"));//flight 取data-id
                    thisObj.attr("data-name", $(this).attr("title"));
                };
                divPCLOverlay.hide();
                divPCL.hide();
            }
        });
        document.onclick = function (e) {

            $("#loading").hide();
            // document.onclick = function (event) {
            //   var hasParent = false;
            //   var thisObjId = thisObj.attr("id");
            //   for (var node = event.target; node != document.body; node = node.parentNode) {
            //     if (node.id.toString() == 'divPCL' || node.id.toString() == thisObjId) {
            //       hasParent = true;
            //       break;
            //     }
            //   }
            var hasParent = false;
            var thisObjId = thisObj.attr("id");
            var node, evt = e ? e : event;

            if (evt.srcElement) {
                node = evt.srcElement;
            }
            else if (evt.target) {
                node = evt.target;
            }

            for (node; node !== document.body; node = node.parentNode) {
                if (node.id.toString() === 'divPCL' || node.id.toString() === thisObjId) {
                    hasParent = true;
                    break;
                }
            }
            if (!hasParent) {
                $("#divPCL").hide();
                $("#divPCLOverlay").hide();
            }
        };
    }

    function generateAllPopularCitiesHtml(thisObj, data, settings) {
        var popularCityListContentHtml = "";
        var arrRegions = getRegions(data);
        var blnIsSingleBox = true; //getModeBox(data);
        var arrAllPopularCities = getAllPopularCities(data);
        var arrPopularRegion = getPopularByRegion(arrRegions, true);
        var arrOtherPopularRegion = getPopularByRegion(arrRegions, false);

        if (arrPopularRegion.length > 0) {
            blnIsSingleBox = false;
        }

        if (blnIsSingleBox == false) {
            popularCityListContentHtml =
                // generateHeaderControl("divHDR", settings) +
                generateTabControl("popularTabControl", arrPopularRegion, arrAllPopularCities, settings, blnIsSingleBox, true) +
                generateTabControl("otherPopularTabControl", arrOtherPopularRegion, arrAllPopularCities, settings, blnIsSingleBox, false);
        }
        else {
            popularCityListContentHtml =
                // generateHeaderControl("divHDR", settings) +
                generateTabControl("otherPopularTabControl", arrOtherPopularRegion, arrAllPopularCities, settings, blnIsSingleBox, false);
        }

        return popularCityListContentHtml;
    }

    /*function generateHeaderControl(ControlId, settings) {
     var tabHtml = ''
     tabHtml =
     '<div id="' + ControlId + '">' + settings.headername + '</div>';
     return tabHtml;
     }
     */
    function generateTabControl(tabControlId, arrRegions, arrAllPopularCities, settings, blnIsSingleBox, isdomestic) {
        var tabHtml = '';

        if (blnIsSingleBox == false) {
            if (isdomestic == true) {
                var strStyleTabRegion = 'style="display:none;"';
                if (arrRegions.length > 1) {
                    strStyleTabRegion = ''
                }
                tabHtml =
                    '<div id="' + tabControlId + '">' +
                    '<div class="divGRP">' + settings.lbldomestic + '</div>' +
                    '<ul ' + strStyleTabRegion + '>' +
                    generateTabPageLink(arrRegions) +
                    '</ul>' +
                    generateTabPageContent(arrRegions, arrAllPopularCities, settings) +
                    '</div>';
            }
            else {
                tabHtml =
                    '<div id="' + tabControlId + '">' +
                    '<div class="divGRP">' + settings.lblinternational + '</div>' +
                    '<ul>' +
                    generateTabPageLink(arrRegions) +
                    '</ul>' +
                    generateTabPageContent(arrRegions, arrAllPopularCities, settings) +
                    '</div>';
            }
        }
        else {
            tabHtml =
                '<div id="' + tabControlId + '">' +
                '<ul>' +
                generateTabPageLink(arrRegions) +
                '</ul>' +
                generateTabPageContent(arrRegions, arrAllPopularCities, settings) +
                '</div>';
        }
        return tabHtml;
    }

    function generateTabPageLink(arrRegions) {
        var tabPageLinkHtml = "";
        for (var i = 0; i < arrRegions.length; i++) {
            tabPageLinkHtml += '<li><a href="#' + arrRegions[i].regionEng + '">' + arrRegions[i].region + '</a></li>'
        }
        return tabPageLinkHtml;
    }

    function generateTabPageContent(arrRegions, arrAllPopularCities, settings) {
        var tabPageContentHtml = "";
        var arrPopularCitiesByRegion = [];
        for (var i = 0; i < arrRegions.length; i++) {
            arrPopularCitiesByRegion = getPopularCitiesByRegion(arrAllPopularCities, arrRegions[i].regionEng);
            tabPageContentHtml +=
                '<div id="' + arrRegions[i].regionEng + '">' +
                generatePopularCitiesByRegionHtml(arrPopularCitiesByRegion, settings) +
                '</div>'
        }
        return tabPageContentHtml;
    }

    function generatePopularCitiesByRegionHtml(arrPopularCitiesByRegion, settings) {
        var regionCitiesHtml = '<table style="width:100%;">';
        var count = 0;
        var cols = parseInt(settings.cols);
        var widthpercent = "100%";

        if (settings.cols == 2) {
            widthpercent = "50%";
        }
        else if (settings.cols == 3) {
            widthpercent = "33%";
        }
        else if (settings.cols == 4) {
            widthpercent = "25%";
        }
        else if (settings.cols == 5) {
            widthpercent = "20%";
        }

        for (var i = 0; i < arrPopularCitiesByRegion.length; i += cols) {
            count = i;
            regionCitiesHtml += '<tr>';
            var strItemText = "";
            var strItemValue = "";
            var strItemValueEng = "";
            var strCountryCode = "";
            var strCityCode = "";

            for (var j = 0; j < cols; j++) {
                if (count < arrPopularCitiesByRegion.length) {
                    strItemText = arrPopularCitiesByRegion[count].cityName;
                    strItemValue = arrPopularCitiesByRegion[count].cityName;
                    strItemValueEng = arrPopularCitiesByRegion[count].cityNameEng;

                    strItemValueEng=strItemValueEng.replace(" ","+");//空格替换成+
                    console.log(strItemValueEng);
                    strCountryCode = arrPopularCitiesByRegion[count].CountryCode;
                    strCityCode = arrPopularCitiesByRegion[count].CityCode;

                    if (strItemText.length > 6) {
                        strItemText = strItemText.substring(0, 6) + "...";
                    }

                    regionCitiesHtml += '<td style="width:' + widthpercent + ';" data-id=' + strCityCode + ' data-countryCode=' + strCountryCode+' data-cityNameEng='+strItemValueEng+' class="cityValue" title="' + strItemValue + '">' + strItemText + '</td>';
                }
                else {
                    regionCitiesHtml += '<td style="width:' + widthpercent + ';"></td>';
                }
                count++;
            }
            regionCitiesHtml += '</tr>';
        }
        regionCitiesHtml += '</table>'

        return regionCitiesHtml;
    }

    function getRegions(data) {
        var arrRegions = [];
        for (i = 0; i < data.length; i++) {
            if (data[i].GroupHeader == "1") {
                arrRegions.push(createRegionObject(data[i].Region, data[i].RegionEng, data[i].BoxSeqNo));
            } else {
                break;
            }
        }
        return arrRegions;
    }

    // Comment: Not in use
    function getModeBox(data) {
        var blnIsSingleBox = true;
        try {
            if (data.length > 0) {
                if (data[0].hasOwnProperty('BoxMode') == true) {
                    if (data[0].BoxMode != null) {
                        if (data[0].BoxMode == "2") {
                            blnIsSingleBox = false;
                        }
                    }
                }
            }
        }
        catch (e) {
        }
        return blnIsSingleBox;
    }

    function getPopularByRegion(arrRegions, isPopularRegion) {
        var arrPopularRegions = [];
        var region = {};
        for (i = 0; i < arrRegions.length; i++) {
            if (isPopularRegion) {
                if (arrRegions[i].boxSeqNo.toUpperCase() == "0") {
                    region = {};
                    region.region = arrRegions[i].region;
                    region.regionEng = arrRegions[i].regionEng;
                    arrPopularRegions.push(region);
                }
            } else {
                if (arrRegions[i].boxSeqNo.toUpperCase() == "1") {
                    region = {};
                    region.region = arrRegions[i].region;
                    region.regionEng = arrRegions[i].regionEng;
                    arrPopularRegions.push(region);
                }
            }
        }
        return arrPopularRegions
    }

    function getAllPopularCities(data) {
        var arrCities = [];
        for (i = 0; i < data.length; i++) {
            if (data[i].GroupHeader == "0") {
                arrCities.push(createPopularCityListObject(data[i].Region, data[i].RegionEng, data[i].CityName, data[i].CityNameEng, data[i].CityCode, data[i].CountryCode));
            }
        }
        return arrCities;
    }

    function getPopularCitiesByRegion(arrAllPopularCities, region) {
        var arrPopularCities = [];
        for (i = 0; i < arrAllPopularCities.length; i++) {
            if (arrAllPopularCities[i].regionEng.toUpperCase() == region.toUpperCase()) {
                arrPopularCities.push(createPopularCityListObject(arrAllPopularCities[i].region, arrAllPopularCities[i].regionEng, arrAllPopularCities[i].cityName, arrAllPopularCities[i].cityNameEng, arrAllPopularCities[i].CityCode, arrAllPopularCities[i].CountryCode));
            }
        }
        //console.log(arrPopularCities);
        return arrPopularCities;
    }

    function createPopularCityListObject(region, regionEng, cityName, cityNameEng, CityCode, CountryCode) {
        var objPopularCityList = {};
        objPopularCityList.region = region;
        objPopularCityList.regionEng = regionEng;
        objPopularCityList.cityName = cityName;
        objPopularCityList.cityNameEng = cityNameEng;
        objPopularCityList.CityCode = CityCode;
        objPopularCityList.CountryCode = CountryCode;

        return objPopularCityList
    }

    function createRegionObject(region, regionEng, boxSeqNo) {
        var objRegion = {};
        objRegion.region = region;
        objRegion.regionEng = regionEng;
        objRegion.boxSeqNo = boxSeqNo;

        return objRegion;
    }


    function fix_div_coordinate(obj, trg) {
        var leftval = 0;
        var topval = 0;
        var leftpos = 0;
        var toppos = 0;
        aTag = obj;
        do {
            if (aTag.offsetParent) {
                aTag = aTag.offsetParent;
            }
            else {
                leftpos += aTag.style().left;
                toppos += aTag.style().top;
                break;
            }
            leftpos += aTag.offsetLeft;
            toppos += aTag.offsetTop;
        } while (aTag.tagName.toLowerCase() != "body");

        if (trg == "left") {
            return (obj.offsetLeft + parseInt(leftpos));
        }
        else {
            return (obj.offsetTop + parseInt(toppos) + obj.offsetHeight + 2);
        }
    }

}(jQuery));
