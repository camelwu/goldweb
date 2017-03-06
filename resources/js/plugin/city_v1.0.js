/**
 * Created by zhouwei on 2016/7/22.
 */
/*机票绑定start*/
$("#city,#city2").popularCityList({
    param: {
        DataType: 1
    },
    textbox: 'city',
    showdomestic: false,
})

/*机票绑定end*/




function getPopularCityList(settings) {
    var data = {};
    data.Parameters = {
        "DataType": settings.param.DataType,
        "Keyword": settings.param.Keyword
    };
    data.foreEndType = 3;
    data.code = "80111008";

    $.ajax({
        type: "POST",
        url: URLPopularCity() + '?rnd=' + Math.random(),
        data: JSON.stringify(data),
        contentType: 'application/json;charset=utf-8',
        success: function (data) {
            settings.response($.map(data.data, function (item) {
                return {
                    label: item.KeywordName,
                    labelEng: item.KeywordNameEng,
                    TypeID: item.TypeID,
                    KeywordName: item.KeywordName,
                    GroupName: item.GroupName,
                    ShowGroupLabel: item.ShowGroupLabel
                }
            }));
        },
        error: function (req, stat, err) {
            alert(err);
        }
    })
}

function autoComplete(id) {
    $(id).autocomplete({
            source: function (request, response) {
                getPopularCityList({
                    param: {
                        DataType: 1,
                        Keyword: request.term
                    },
                    response: response
                });
            },
            minLength: 2,
            select: function (event, ui) {
                document.getElementById('city_type').value = ui.item.TypeID;
                document.getElementById('city_name').value = ui.item.KeywordName;
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        })
        .focus(function () {
            $(this).select();
        })
        .data("uiAutocomplete")._renderItem = function (ul, item) {
        var strClassName = groupclass(item.GroupName);
        var strGroupName = "";
        if (item.ShowGroupLabel == 'Y') {
            strGroupName = item.GroupName;
        }
        var listItem = $("<li>")
            .data("item.autocomplete", item)
            .append("<a>" +
                "<table class='atctbl' border='0' cellpadding='0'><tr>" +
                "<td class='atctdlbl'>" + item.label + "</td>" +
                "<td class='atctdspc'></td>" +
                "<td class='atctdlbleng'>" + item.labelEng + "</td>" +
                "</tr></table>" +
                "</a>")
            .appendTo(ul);
        if (item.ShowGroupLabel == 'Y') {
            listItem.css('border-top', '1px dotted #485562');
        }
        return listItem;

    };
}

if ($('#city').length) {
    /*机票城市*/
    autoComplete('#city');
} else if ($('#hotel_inter').length) {
    /*酒店城市调用*/
    autoComplete('#hotel_inter');
}