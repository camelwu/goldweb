# CitySelect #

本插件只针对AT当前的6个业务线的离抵城市选择，只在移动端H5站上使用；依赖JQuery，通过页面上data-bind的参数进行点击事件的绑定。虽然，数据格式和来源各有不同，但最后的展现逻辑完全一样，所以：dom容器结构如下：
instance(实例):[
box(容器):[
	header(返回箭头、搜索框等),
	tag(国内外标签)[外,内],
	当前,
	历史[外,内],
	热门[外,内],
	列表[
		出发[外,内,右索引],
		抵达[外,内,右索引]
		],
	选择提示(A~Z)等
],
masker(搜索遮罩),
suggest(搜索结果建议)
]

确认页面只有一个组件存在。响应点击事件后，出发与目的地就确认，只有回到业务线，才能发生改变。所以组件内的展示逻辑只考虑国内外的切换即可。
['citybox_dep_list_inter','citybox_dep_list_domes','citybox_des_list_inter','citybox_des_list_domes']
## 为什么重写插件 ##

过去插件效率低，在每个业务线都要在开发过程中添加Dom和css，手工依赖与耦合度过高。既然各业务线都需使用，重写插件提升开发与debug的效率势在必行。改写之后，旧的参数可简单修改和适配。

## 通用性 ##

目前只考虑移动端H5的使用，在个人电脑的chrome上进行调试，其它浏览器均未进行适配调试:

* Mobile Safari
* Chrome on iOS
* Chrome on Android
* Opera Mobile
* UC
* etc

## 使用方法 ##

```html
<a href="javascript:void(0);" id="h_out" data-bind="type:'setCityBox',data:'f_dep_domes',returnId:'#ret',returnAttr:'value',returnStrId:'#h_ret'">机票出发</a>
```
```js
<script src="./cityselect.js"></script>
<script>
    n.bindDoc();
</script>
```
html引用之后，有data-bind的参数类型的dom元素上点击触发整体渲染，参数解析后是json，如下:

```json
@param = {
	type:'setCityBox',//标志本js使用
	data:'f_dep_domes',//产品（f,fh,fht……）_出发（dep）|目的（des）_国外（inter）|国内（domes）
	returnId:'#ret',
	returnAttr:'value',
	returnStrId:'#h_ret'
}
```

## 注意事项 ##

2015-06-04 /main.php:line78,增加一个域名判断，直接进入mobile.php;以实现手机与PC的分离。
## 过去日志丢失，从2017年2月15日开始补全
2017-02-15 /common/inc/main.func.php:line4,增加中国地区对象areaCN。
2017-02-16 /common/inc/tool.func.php:line431,修改生成目录函数mkdirs。
2017-02-16 /common/inc/main.func.php:line67,增加smarty模板存放目录判断。
2017-02-17 /common/inc/tool.func.php:line720,优化获取IP地址函数getIP，增加IP地址通过新浪和淘宝接口函数getCity。 
2017-02-17 /common/inc/tool.func.php:line,无用函数删除。
2017-02-18 开启服务器，权限变化沟通与测试中
2017-02-19 开启服务器，本地目录与旧机器之间版本冲突
---------------------------------------------------------------------
2017-02-20 版本冲突测试中，新增bug系统与今后工作方式。
