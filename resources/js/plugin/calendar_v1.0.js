/**
 * 日历控件编写 支持单日历 双日历 多日历等。
 * @author tugenhua
 * @time 2013 11-07
 * @email 879083421@qq.com
 */

function Calendar() {

  this.config = {
    elemCls             :  '.input',            // 目标元素
    beginYear           :  1990,                //开始日期
    endYear             :  2020,                //结束日期
    panelCls            :  '.calendarPanel',    // 日历面板类
    bg_cur_day          :  'bg_cur_day',        // 当前的颜色
    bg_out              :  'bg_out',            // 鼠标hover颜色
    bg_over             :  'bg_over',           // 鼠标out颜色
    date2StringPattern  :  'yyyy-MM-dd',        // 默认显示格式 yyyy-MM-dd
    patternDelimiter    :  '-',                 // 分隔符 注意：分隔符要和上面显示格式对应
    panelCount          :  2,                   // 面板的个数 是单日历 双日历 或者 多日历等
    manyDisabled        :  false,               // 默认情况下为false 如果为true 指当前日期之前的日期不可点击
    ishasSelect         :  true,                // 是否有下拉框选择年份和月份 默认为true 暂不做操作
                                                // 为以后留接口 因为如果没有的话 年月份没有显示出来 感觉怪怪的

    render              :  null,                // 渲染日历后触发
    clickDayCallBack    :  null,                // 点击某一天后 回调函数
    clickPrevCallBack   :  null,                // 点击上一月的回调函数
    clickNextCallBack   :  null,                // 点击下一页的回调函数
    changeYearCallBack  :  null,                // 下拉框改变年份的回调函数
    changeMonthCallBack :  null                 //  下拉框改变月份的回调函数
  };

  this.cache = {
    createPanelHTML : '',
    flag            : true,
    year            : '',             //保存页面一渲染时候 当前的年份
    month           : '',             //保存页面一渲染时候 当前的月份
    storeDateArrs   : []
  };
  this.date = new Date();
  this.year = this.date.getFullYear();
  this.month = this.date.getMonth();

}
Calendar.model = {
  "year"               :      "\u5e74",
  "months"             :      ["\u4e00\u6708","\u4e8c\u6708","\u4e09\u6708","\u56db\u6708","\u4e94\u6708","\u516d\u6708","\u4e03\u6708","\u516b\u6708","\u4e5d\u6708",
    "\u5341\u6708","\u5341\u4e00\u6708","\u5341\u4e8c\u6708"],
  "weeks"              :      ["\u65e5","\u4e00","\u4e8c","\u4e09","\u56db","\u4e94","\u516d"],
  "string2DatePattern" :      "ymd"
};
Calendar.prototype = {

  init: function(options){
    this.config = $.extend(this.config,options || {});
    var self = this,
        _config = self.config,
        _cache = self.cache;
    $(_config.elemCls).unbind('click');
    $(_config.elemCls).bind('click',function(){
      // 判断下 如果日历面板已经渲染出来后 就不再渲染
      if($(_config.panelCls + ' .calendarDiv').length > 0) {
        self.show();
      }else {
        self.show();
        self._draw();
        self._renderYear();
        self._renderMonth();
        self._changeSelect();
        return;
        self._renderData();
      }

    });
  },
  _draw: function(){
    var self = this,
        _config = self.config,
        _cache = self.cache;

    // 拼接HTML结构
    _cache.createPanelHTML += '<div class="calendarDiv">'+
        '<table class="js-calendarTable" width="100%" border="0" cellpadding="3" cellspacing="1" align="center">' +
        '<tr>' +
        '<th><input class="l goPrevMonthButton" name="goPrevMonthButton" type="button" value="<" \/><\/th>' +
        '<th colspan="5">'+
        '<select class="year yearSelect" name="yearSelect"><\/select>'+
        '<select class="month monthSelect" name="monthSelect"><\/select>'+
        '<\/th>' +
        '<th><input class="r goNextMonthButton" name="goNextMonthButton" type="button" value=">" \/><\/th>' +
        '<\/tr>';
    _cache.createPanelHTML += '<tr>';
    for(var i = 0; i < 7; i++) {
      _cache.createPanelHTML += '<th class="theader">'+
          Calendar.model["weeks"][i] +
          '<\/th>';
    }
    _cache.createPanelHTML += '<\/tr>';

    for(var k = 0; k < 6; k+=1) {
      _cache.createPanelHTML += '<tr align="center">';
      for(var j = 0; j < 7; j++) {
        switch (j) {
          case 0:  _cache.createPanelHTML += '<td class="sun"> <\/td>'; break;
          case 6:  _cache.createPanelHTML += '<td class="sat"> <\/td>'; break;
          default: _cache.createPanelHTML += '<td class="normal"> <\/td>'; break;
        }
      }
      _cache.createPanelHTML += '<\/tr>';
    }

    _cache.createPanelHTML += '<tr>' +
        '<th colspan="2"><input type="button" class="b clearButton" name="clearButton" value="清空"\/><\/th>'+
        '<th colspan="3"><\/th>' +
        '<th colspan="2"><input type="button" class="b closeButton" name="closeButton" value="关闭"\/><\/th>' +
        '<\/tr>' +
        '<input type="hidden" class="js_year" year="" month=""/>' +
        '<\/table>' +
        '<\/div>';
    for(var m = 0; m < _config.panelCount; m+=1) {
      if(_cache.flag) {

        $(_config.panelCls).append(_cache.createPanelHTML);
        /*
         * 一开始克隆当前年份和月份 保存到隐藏域去 目的当点击上下按钮时候 互不影响各自的年份 和月份
         */
        self._year = self.cloneObject(self.year),
            self._month = self.cloneObject(self.month);
        $(".calendarDiv .js_year").attr({"year":self._year,"month":self._month});
      }
    }
    if(!_config.ishasSelect) {
      !$(".yearSelect").hasClass("hidden") && $(".yearSelect").addClass("hidden");
      !$(".monthSelect").hasClass("hidden") && $(".monthSelect").addClass("hidden");
    }
    _cache.year = self.year;
    _cache.month = self.month;
    _cache.flag = false;

    _config.render && $.isFunction(_config.render) && _config.render();

    $(".goPrevMonthButton").unbind('click');
    $(".goPrevMonthButton").bind('click',function(e){
      self._goPrevMonth(e);
      _config.clickPrevCallBack && $.isFunction(_config.clickPrevCallBack) && _config.clickPrevCallBack();
    });
    $(".goNextMonthButton").unbind('click');
    $(".goNextMonthButton").bind("click",function(e){
      self._goNextMonth(e);
      _config.clickNextCallBack && $.isFunction(_config.clickNextCallBack) && _config.clickNextCallBack();
    });
    $(".yearSelect").change(function(e){
      self._update(e);
      _config.changeYearCallBack && $.isFunction(_config.changeYearCallBack) && _config.changeYearCallBack();
    });

    $(".monthSelect").change(function(e){
      self._update(e);
      _config.changeMonthCallBack && $.isFunction(_config.changeMonthCallBack) && _config.changeMonthCallBack();
    });
    $(".clearButton").unbind('click');
    $(".clearButton").bind('click',function(e){
      $(_config.elemCls).val('');
      $(_config.elemCls).attr('value','');
      _cache.storeDateArrs[0] = undefined;
      _cache.storeDateArrs[1] = undefined;
    });

    $(".closeButton").unbind('click');
    $(".closeButton").bind('click',function(){
      self.hide();
    });
  },
  // 渲染下拉框所有的年份
  _renderYear: function() {
    var self = this,
        _config = self.config,
        _cache = self.cache;
    var html = '';
    for(var i = _config.beginYear; i <= _config.endYear; i+=1) {
      html += '<option value="'+i+'">'+(i + Calendar.model['year'])+'</option>';
    }
    $(".yearSelect").each(function(index,item){
      $(item).html(html);
    });
  },
  // 渲染下拉框所有月份
  _renderMonth: function(){
    var self = this,
        _config = self.config,
        _cache = self.cache;
    var html = '';
    for(var i = 0; i < 12; i++) {
      html+= '<option value="'+i+'">'+Calendar.model['months'][i]+'</option>'
    }
    $('.monthSelect').each(function(index,item){
      $(item).html(html);
    });
  },
  _renderData: function(targetParent,date) {
    var self = this,
        _config = self.config,
        _cache = self.cache;

    var dateArray,
        tds;
    if(targetParent) {
      tds = $("td",$(targetParent));
      dateArray = self._getMonthViewDateArray(date.getFullYear(),date.getMonth());
      renderTDs(tds,dateArray,date);
    }else {
      $(".js-calendarTable").each(function(index,item){
        tds = $('td',item);
        dateArray = self._getMonthViewDateArray(self.date.getFullYear(),self.date.getMonth());
        renderTDs(tds,dateArray);
      });
    }
    function renderTDs(tds,dateArray,date){
      $(tds).each(function(index,td){
        $(td).hasClass(_config.bg_cur_day) && $(td).removeClass(_config.bg_cur_day);
      });
      for(var i = 0; i < tds.length; i+=1) {
        !$(tds[i]).hasClass(_config.bg_out) && $(tds[i]).addClass(_config.bg_out);
        $(tds[i]).html("");
        $(tds[i]).html(dateArray[i]) || " ";
        if (i > dateArray.length - 1) continue;
        if(dateArray[i]) {
          $(tds[i]).unbind('click');
          $(tds[i]).bind('click',function(e){
            var target = e.target,
                tagParent = $(target).closest('.js-calendarTable');
            var year = $(".js_year",tagParent).attr("year"),
                month = $(".js_year",tagParent).attr("month");

            var curdate = new Date(year,month,1);

            if($(_config.elemCls)) {
              if($(this).hasClass("disabled")) {
                return;
              }
              // 暂时只考虑2种情况 单日历面板 和 双日历面板 输入框显示问题
              if(_config.panelCount == 2) {
                var parent = $(this).closest('.js-calendarTable'),
                    curIndex = $(".js-calendarTable").index(parent);

                if(curIndex == 0) {
                  _cache.storeDateArrs[0] = new Date(curdate.getFullYear(),curdate.getMonth(),$(this).html())._format(_config.date2StringPattern);
                }else {
                  _cache.storeDateArrs[1] = new Date(curdate.getFullYear(),curdate.getMonth(),$(this).html())._format(_config.date2StringPattern);
                }
                if(_cache.storeDateArrs[0] != undefined && _cache.storeDateArrs[1] == undefined){

                  //先去掉类 bg_cur_day
                  $('td',tagParent).each(function(index,td){
                    $(td).hasClass(_config.bg_cur_day) && $(td).removeClass(_config.bg_cur_day);
                  });
                  $(_config.elemCls).val(_cache.storeDateArrs[0]);
                  $(_config.elemCls).attr('value',_cache.storeDateArrs[0]);
                  !$(this).hasClass(_config.bg_cur_day) && $(this).addClass(_config.bg_cur_day);

                }else if(_cache.storeDateArrs[0] == undefined && _cache.storeDateArrs[1] != undefined){
                  //先去掉类 bg_cur_day
                  $('td',tagParent).each(function(index,td){
                    $(td).hasClass(_config.bg_cur_day) && $(td).removeClass(_config.bg_cur_day);
                  });
                  $(_config.elemCls).val(_cache.storeDateArrs[1]);
                  $(_config.elemCls).attr('value',_cache.storeDateArrs[1]);
                  !$(this).hasClass(_config.bg_cur_day) && $(this).addClass(_config.bg_cur_day);

                }else if(_cache.storeDateArrs[0] != undefined && _cache.storeDateArrs[1] != undefined) {

                  if(Date.parse(_cache.storeDateArrs[0]) >= Date.parse(_cache.storeDateArrs[1])) {
                    alert("结束日期必须大于开始日期 或者 开始日期必须小于结束日期");
                    return;
                  }else {
                    $(_config.elemCls).val(_cache.storeDateArrs[0] + '/' + _cache.storeDateArrs[1]);
                    $(_config.elemCls).attr("value",_cache.storeDateArrs[0] + '/' + _cache.storeDateArrs[1]);
                    self.hide();
                  }
                }
              }else{
                $(_config.elemCls).val(new Date(curdate.getFullYear(),curdate.getMonth(),$(this).html())._format(_config.date2StringPattern));
                self.hide();
              }
            }
            _config.clickDayCallBack && $.isFunction(_config.clickDayCallBack) && _config.clickDayCallBack();
          });

          $(tds[i]).hover(function(){
            if($(this).hasClass("disabled")){
              return;
            }
            !$(this).hasClass(_config.bg_over) && $(this).addClass(_config.bg_over);

          },function(){
            $(this).hasClass(_config.bg_over) && $(this).removeClass(_config.bg_over);
          });

          var today = new Date();
          if(today.getFullYear() == self.date.getFullYear() && today.getMonth() == self.date.getMonth()) {
            if(today.getDate() == dateArray[i]){
              // 获取当前i 第几项 循环下 当前的i 前面所有的单元格不可点击
              if(_config.manyDisabled){
                self._cellDisabled(tds,i);
              }
              !$(tds[i]).hasClass(_config.bg_cur_day) && $(tds[i]).addClass(_config.bg_cur_day);
            }
          }else {

            $(tds[i]).hasClass(_config.bg_cur_day) && $(tds[i]).removeClass(_config.bg_cur_day);
          }
        }
      }
    }
  },
  _cellDisabled: function(tds,i){
    for(var k = 0; k < i; k++) {
      !$(tds[k]).hasClass("disabled") && $(tds[k]).addClass("disabled");
    }
  },
  // 上一页按钮
  _goPrevMonth: function(e){
    var self = this,
        _config = self.config,
        _cache = self.cache;
    var target = e.target,
        targetParent = $(target).closest('.js-calendarTable');
    var year = $(".js_year",targetParent).attr('year'),
        month = $(".js_year",targetParent).attr('month');

    if(_config.manyDisabled) {
      return;
    }
    if(year == _config.beginYear && month == 0) {
      return;
    }
    month--;
    if(month < 0) {
      year--;
      month = 11;
    }
    var date = new Date(year,month,1);
    self._changeSelect(targetParent,date);
    self._renderData(targetParent,date);

    // 重新渲染td背景色
    self._renderTdBg(year,month,targetParent);
  },
  // 下一页按钮
  _goNextMonth: function(e){
    var self = this,
        _config = self.config,
        _cache = self.cache;
    var target = e.target,
        targetParent = $(target).closest('.js-calendarTable');

    var year = $(".js_year",targetParent).attr('year'),
        month = $(".js_year",targetParent).attr('month');
    if(year == _config.beginYear && month == 0) {
      return;
    }
    month++;
    if(month > 12) {
      year++;
      month = 0;
    }
    var date = new Date(year,month,1);
    self._changeSelect(targetParent,date);
    self._renderData(targetParent,date);

    // 重新渲染td背景色
    self._renderTdBg(year,month,targetParent);
  },

  // 渲染当前天的背景色
  _renderTdBg: function(year,month,targetParent){
    var self = this,
        _config = self.config,
        _cache = self.cache;

    if(_cache.year == year && _cache.month == month) {
      return;
    }else {
      var tds = $("td",targetParent);

      $.each(tds,function(index,td){
        $(td).hasClass(_config.bg_cur_day) && $(td).removeClass(_config.bg_cur_day);
      });
    }
  },
  /**
   * 深度克隆一个对象 使原对象和新对象完全独立
   */
  cloneObject: function(obj){
    if(obj === null){
      return null;
    }else if(obj instanceof Array){
      var arr = [];
      for(var i = 0, ilen = obj.length; i < ilen; i+=1){
        arr[i] = obj[i];
      }
      return arr;
    }else if(obj instanceof Date || obj instanceof RegExp || obj instanceof Function){
      return obj;
    }else if(obj instanceof Object){
      var o = {};
      for(var i in obj){
        if(obj.hasOwnProperty(i)){
          o[i] = cloneObject(obj[i]);
        }
      }
      return o;
    }else{
      return obj;
    }
  },
  show: function(){
    var self = this,
        _config = self.config;
    $(_config.panelCls).hasClass('hidden') && $(_config.panelCls).removeClass('hidden');
  },
  hide: function(){
    var self = this,
        _config = self.config;
    !$(_config.panelCls).hasClass('hidden') && $(_config.panelCls).addClass('hidden');
  },
  _getMonthViewDateArray: function(y,m) {
    var dateArray = new Array(42);

    // 返回表示星期的第一天的数字
    var dayOfFirstDate = new Date(y, m, 1).getDay(),

    // 返回月份的最后一天
        dateCountOfMonth = new Date(y, m + 1, 0).getDate();

    for(var i = 0; i < dateCountOfMonth; i+=1) {
      dateArray[i + dayOfFirstDate] = i + 1;
    }
    return dateArray;
  },
  _update: function(e) {
    var self = this,
        target = e.target,
        targetParent = $(target).closest('.js-calendarTable'),
        monthSelect = $(".monthSelect",targetParent)[0],
        yearSelect = $(".yearSelect",targetParent)[0];

    self.year = yearSelect.options[yearSelect.selectedIndex].value;
    self.month = monthSelect.options[monthSelect.selectedIndex].value;
    self.date = new Date(self.year,self.month,1);

    self._changeSelect(targetParent,self.date);
    self._renderData(targetParent,self.date);
  },
  // 重新渲染当前的下拉框的年份和月份 重新赋值下拉框的年份和月份
  _changeSelect: function(targetParent,date){
    var self = this;
    var ys,
        ms;
    if(targetParent) {
      ys = $('.yearSelect',targetParent)[0];
      ms = $('.monthSelect',targetParent)[0];
      renderSelectYearVal(ys,targetParent);
      renderSelectMonthVal(ms,targetParent);
    }else {
      $(".js-calendarTable").each(function(index,item){
        ys = $('.yearSelect',item)[0],
            ms = $('.monthSelect',item)[0];
        renderSelectYearVal(ys);
        renderSelectMonthVal(ms);
      });
    }
    function renderSelectYearVal(ys,targetParent) {

      for(var i = 0; i < ys.length; i++) {
        if(date) {
          if(ys.options[i].value == date.getFullYear()){
            ys[i].selected = true;

            // 重新获取当选被选中的年份 给页面隐藏域输入框重新赋值
            var year = $(ys[i]).attr("value");
            $('.js_year',targetParent).attr("year",year);
            break;
          }
        }else {
          if(ys.options[i].value == self.date.getFullYear()){
            ys[i].selected = true;
            break;
          }
        }

      }
    }
    function renderSelectMonthVal(ms,targetParent){

      for(var i = 0; i < ms.length; i++) {
        if(date) {
          if(ms.options[i].value == date.getMonth()){
            ms[i].selected = true;
            // 重新获取当选被选中的年份 给页面隐藏域输入框重新赋值
            var month = $(ms[i]).attr("value");
            $('.js_year',targetParent).attr("month",month);
            break;
          }
        }else {
          if(ms.options[i].value == self.date.getMonth()){
            ms[i].selected = true;
            break;
          }
        }
      }
    }
  }
};

/*
 * 日期格式化方法
 */
if(!Date.prototype._format) {
  Date.prototype._format = function(str) {
    var o = {
      "M+" : this.getMonth() + 1, //month
      "d+" : this.getDate(),      //day
      "h+" : this.getHours(),     //hour
      "m+" : this.getMinutes(),   //minute
      "s+" : this.getSeconds(),   //second
      "w+" : "\u65e5\u4e00\u4e8c\u4e09\u56db\u4e94\u516d".charAt(this.getDay()),   //week
      "q+" : Math.floor((this.getMonth() + 3) / 3),  //quarter
      "S"  : this.getMilliseconds() //millisecond
    }
    if (/(y+)/.test(str)) {
      str = str.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for(var k in o){
      if (new RegExp("("+ k +")").test(str)){
        str = str.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
      }
    }
    return str;
  }
}
/*
 * 转换为日期
 */
if(!String.prototype._toDate) {
  String.prototype._toDate = function(delimiter, pattern) {
    delimiter = delimiter || "-";
    pattern = pattern || "ymd";
    var a = this.split(delimiter);
    var y = parseInt(a[pattern.indexOf("y")], 10);
    if(y.toString().length <= 2) y += 2000;
    if(isNaN(y)) y = new Date().getFullYear();
    var m = parseInt(a[pattern.indexOf("m")], 10) - 1;
    var d = parseInt(a[pattern.indexOf("d")], 10);
    if(isNaN(d)) d = 1;
    return new Date(y, m, d);
  };
}

// 页面初始化方式
$(function(){
  new Calendar().init({
    //manyDisabled: true
    //ishasSelect: true
  });
});