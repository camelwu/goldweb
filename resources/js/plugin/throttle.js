/*
 var fns = function(){};
 window.onscroll = function(){
 throttle(fns);
 }
 */
/**
 * 单继承
 * 简单属性复制，非IE下可用
 * IE下valueOf toString的属性名不能被识别
 */
var extend = function(target, source) {
	//遍历对象中的所有属性
	for (var i in source) {
		//copy 2 new obj
		target[i] = source[i];
	}
	return target;
};
/**
 * 节流器
 * 节流器要做两件事：1、清楚要执行的函数，2、延迟执行为函数判断留下时间
 * 第1：是否清，执行函数；第2：执行函数，相关参数
 */
function throttle() {
	//获取第一个参数
	var isClear = arguments[0], fn;
	//如第一个参数是布尔型，那么第一个参数则表示是否清计时器
	if ( typeof isClear === 'boolean') {
		fn = arguments[1];
		//函数计时器句柄存在，则清除该计时器
		fn.__throttleID && clearTimeout(fn.__throttleID);
	} else {//通过计时器延迟函数的执行
		//第一个参数为函数
		fn = isClear;
		//第二个参数为函数执行时的参数
		param = arguments[1];
		//对执行时的参数适配默认值
		var p = extend({
			context : null,
			args : [],
			time : 300
		}, param);
		//清掉执行函数计时器句柄
		arguments.callee(true, fn);
		//为函数绑定句柄，延迟执行函数
		fn.__throttleID = setTimeout(function() {
			fn.apply(p.context, p.args);
		}, p.time);
	}
}
