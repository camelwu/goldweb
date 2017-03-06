/*!
 * Datepicker.js v0.0.1
 * (c) 2016 Li Zhihua
 * Released under the MIT License.
 */
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
      (global.Datepicker = factory());
}(this, function () {
  'use strict';

  function Datepicker(options) {
    this.el = options.el;
    this.init();
  }

  Datepicker.prototype.init = function () {

  }
  Datepicker.prototype.on = function (event, callback) {
    callback({
      a: 1,
      b: 2
    })
  }


  // http://ejohn.org/blog/javascript-micro-templating/ JavaScript Micro-Templating
  // http://blog.gejiawen.com/2015/04/08/talk-about-fontend-templates/ 浅谈前端模版
  /**
   这段代码最核心的地方在于new Function那一块，
   利用正则对模版中被类似这种<% %>包裹的字符串进行替换
   通过push方法将所有的字符串片段压入临时数组变量p中
   最后通过p.join('')返回处理拼接后的字符串
   通过new Function的方式构造一个函数fn
   函数fn内部通过with语法限制变量的作用域
   传入参数data（这个data其实就是模版中Javascript变量的顶层作用域）执行fn返回最终的字符串（此时返回的字符串不再包含Javascript代码）
   **/
  function tmpl(str, data) {
    var fn = new Function("obj",
      "var p=[],print=function(){p.push.apply(p,arguments);};" +
      "with(obj){p.push('" +
      str
        .replace(/[\r\t\n]/g, " ")
        .split("<%").join("\t")
        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
        .replace(/\t=(.*?)%>/g, "',$1,'")
        .split("\t").join("');")
        .split("%>").join(";p.push('")
        .split("\r").join("\\'") +
      "');}return p.join('');");

    return data ? fn(data) : fn;
  }

  /**
   "var p=[],print=function(){p.push.apply(p,arguments);};" +
   "with(obj){p.push('" +
      "<%data.hello%>"
        .replace(/[\r\t\n]/g, " ")
        .split("<%").join("\t")
        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
        .replace(/\t=(.*?)%>/g, "',$1,'")
        .split("\t").join("');")
        .split("%>").join(";p.push('")
        .split("\r").join("\\'") +
      "');}return p.join('');"
   // "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('');data.hello;p.push('');}return p.join('');"

   "var p=[],print=function(){p.push.apply(p,arguments);};" +
   "with(obj){p.push('" +
      "<%=data.hello%>"
        .replace(/[\r\t\n]/g, " ")
        .split("<%").join("\t")
        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
        .replace(/\t=(.*?)%>/g, "',$1,'")
        .split("\t").join("');")
        .split("%>").join(";p.push('")
        .split("\r").join("\\'") +
      "');}return p.join('');"
   **/
  // "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('',data.hello,'');}return p.join('');"


  return Datepicker;
}));