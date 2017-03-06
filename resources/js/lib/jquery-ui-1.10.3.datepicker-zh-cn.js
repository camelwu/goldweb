/* Chinese initialisation for the jQuery UI date picker plugin. year : 年*/
(function (factory) {
  if (typeof define === "function" && define.amd) {
    define(["../datepicker"], factory);
  } else {
  // Browser globals
    factory(jQuery.datepicker);
  }
}(function (datepicker) {
  datepicker.regional['zh-CN'] = {
    closeText: '关闭',
    prevText: '&#x3C;',
    nextText: '&#x3E;',
    currentText: '今天',
    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
    dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
    dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
    weekHeader: '周',
    dateFormat: 'dd-mm-yy',
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: true,
    changeMonth:false,
    changeYear:false,
    yearSuffix: ''
  };
  datepicker.setDefaults(datepicker.regional['zh-CN']);
  return datepicker.regional['zh-CN'];
}));