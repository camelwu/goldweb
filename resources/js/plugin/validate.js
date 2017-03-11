;(function($){
    $.fn.checkFormHandler = function(settings){
        //如果选择器选择的不是form，则阻止插件继续运行
        if( !this.is("form") ) return;
        var form_id = this.selector.substring(1);
        settings = $.extend({}, $.checkFormHandler.defaultSettings, settings || {});
        // 计算checkFormHandler的根路径
        if (!settings.root) {
            $('script').each(function(a, tag) {
                miuScript = $(tag).get(0).src.match(/(.*)jquery\.checkFormHandler\.1\.5(\.mini)?\.js$/);
                if (miuScript !== null) settings.root = miuScript[1];
            });
        }
        //设定ajax loading的图片地址
        if (!settings.ajaxImage&&settings.root) settings.ajaxImage = settings.root + 'images/loading.gif';
        //加载css样式
         /* if ($("link[href$='css/formStyle.css']").length == 0){
            var css_href = settings.root+'css/formStyle.css';
            var styleTag = document.createElement("link");
            styleTag.setAttribute('type', 'text/css');
            styleTag.setAttribute('rel', 'stylesheet');
            styleTag.setAttribute('href', css_href);
            $("head")[0].appendChild(styleTag);
        }*/
        //装载ajax loading图片和遮罩层
        if ($("#checkFormHandlerOverlay").length == 0){
            $("body").append('<div id="checkFormHandlerOverlay" style="display:none;text-align:center;position:absolute;z-index:2000;left:0;top:0;background:black;cursor:hand"><img src="'+settings.ajaxImage+'" id="checkFormHandler_image"></div>');
        }
        settings.ajaxImageObj = $("#checkFormHandler_image");
        settings.overLayObj	= $("#checkFormHandlerverlay");
        var	msg = "",
            formObj = this,
            checkRet = true,
            rule = $.checkFormHandler.rule,
            isAll,
            tipname = function(namestr){
                namestr = namestr.replace(/(\.|\[|\])/g,'');
                return form_id + "tip_" + namestr.replace(/([a-zA-Z0-9])/g,"-$1");
            },
        //规则类型匹配检测
            typeTest = function(){
                var result = true,args = arguments;
                if(rule.hasOwnProperty(args[0])){
                    var t = rule[args[0]][0], v = args[1];
                    result = args.length>2 ? t.apply(arguments,[].slice.call(args,1)):($.isFunction(t) ? t(v) :t.test(v));
                }
                return result;
            },
        //错误信息提示
            showError = function(fieldObj,filedName, infoObj, warnInfo){
                checkRet = false;
                var tipObj = $("#"+tipname(filedName));
                if(tipObj.length>0) tipObj.remove();
                fieldObj.after(infoObj.tp==0?"<span class='help_error_inline' id='"+tipname(filedName)+"'><i class = 'inp_tip_icon'></i>"+ warnInfo +"</span>":"<div class='help_error_block' id='"+tipname(filedName)+"'><i class = 'inp_tip_icon'></i>"+ warnInfo +"</div>");
                if(settings.isAlert && isAll) msg += "\n" + warnInfo;
            },

        //正确信息提示
            showRight = function(fieldObj,filedName,infoObj,SuccessInfo){
                var tipObj = $("#"+tipname(filedName));
                if(tipObj.length>0) tipObj.remove();
                if (!SuccessInfo){
                    //SuccessInfo = '填写正确';
                    SuccessInfo = '';
                    $(fieldObj).css("border","1px solid #eaeaea")
                }
                fieldObj.after(infoObj.tp==0?"<span class='help_right_inline' id='"+tipname(filedName)+"'><i class = 'inp_tip_icon'></i>"+ SuccessInfo +"</div>":"<div class='help_right_block' id='"+tipname(filedName)+"'><i class = 'inp_tip_icon'></i>"+ SuccessInfo +"</div>");
            },
        //focus时提示
            showExp = function(obj){
                var i = obj, fieldObj = $("[name='"+i.name+"']",formObj[0]);
                var tipObj = $("#"+tipname(i.name));
                if(tipObj.length>0) tipObj.remove();
                var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll(":last"):fieldObj;
                if (i.focusMsg){
                    tipPosition.after(i.tp==0? "<span class='help_error_inline' id='"+tipname(i.name)+"'><i class = 'inp_tip_icon'></i>"+ i.focusMsg +"</span>":"<div class='help_error_block' id='"+tipname(i.name)+"'><i class = 'inp_tip_icon'></i>"+ i.focusMsg +"</span>" );
                }
            },
        //匹配对比值的提示名
            findTo = function(objName){
                var find;
                $.each(settings.items, function(){
                    if(this.name == objName && this.simple){
                        find = this.simple;
                        return false;
                    }
                });
                if(!find) find = $("[name='"+objName+"']")[0].name;
                return find;
            },
        //ajax验证
            ajax = function (obj,fv,field){
                var i = obj, fieldObj = $("[name='"+i.name+"']",formObj[0]);
                var tipObj = $("#"+tipname(i.name));
                if(tipObj.length>0) tipObj.remove();
                var tipPosition = fieldObj.next().length>0 ? fieldObj.nextAll().eq(this.length):fieldObj.eq(this.length - 1);
                tipPosition.after("<span class='Exp' id='"+tipname(i.name)+"'>检测中......</span>");
                fv = encodeURI(fv);
                $.ajax({
                    type	: obj.ajax.method || 'GET',
                    url		: obj.ajax.url,
                    data	: obj.name+"="+fv,
                    cache	: false,
                    async	: !isAll,
                    success	: function(data){
                        if (data == 1){
                            showRight(field,obj.name, obj, obj.ajax.success_msg);
                        }
                        else if(data == 0){
                            showError(field ,obj.name, obj, obj.ajax.failure_msg);
                        }else{
                            showError(field ,obj.name, obj, data);
                        }
                    }
                });
            },
        //单元素验证
            fieldCheck = function(item){
                var i = item, field = $("[name='"+i.name+"']",formObj[0]),filed_length = field.length;

                if(filed_length == 0) return;
                var warnMsg,
                    fv = $.trim(field.val()),
                    isRq = typeof i.require ==="boolean" ? i.require : true;
                if (filed_length == 1){
                    $(field).css("border","1px solid #fd7f54")
                    if( isRq && ((field.is(":radio")|| field.is(":checkbox")) && !field.is(":checked"))){
                        warnMsg =  i.message|| "请选择" + i.simple;
                        showError(field ,i.name, i, warnMsg);
                    }else if(isRq && fv == "" ){
                        warnMsg = ( field.is("select") ? "请选择" :"请填写" ) + i.simple;
                        showError(field ,i.name, i, warnMsg);
                    }else if(fv != ""){
                        if(i.min || i.max){
                            var len = fv.length, min = i.min || 0, max = i.max;
                            warnMsg =  i.message || (max? i.simple + "长度范围应在"+min+"~"+max+"之间":i.simple + "长度应大于"+min);
                            if( (max && (len>max || len<min)) || (!max && len<min) ){
                                showError(field ,i.name, i, warnMsg);	return;
                            }
                        }
                        if(i.type){
                            var matchVal = i.to ? $.trim($("[name='"+i.to+"']",formObj[0]).val()) :i.value;
                            //var matchRet = matchVal ? typeTest(i.type,fv,matchVal) :typeTest(i.type,fv);
                            var matchRet = matchVal ? typeTest(i.type,fv) :typeTest(i.type,fv);
                            warnMsg = i.message|| i.simple + rule[i.type][1];
                            if(matchVal && i.simple) warnMsg += (i.to ? findTo(i.to) +"的值" :i.value);
                            if(!matchRet){
                                showError(field ,i.name, i,  warnMsg);return;
                            }else{
                                showRight(field,i.name, i);
                            }
                        }
                        if (i.between){
                            var from = i.between[0],to = i.between[1];
                            warnMsg = i.message || i.simple + "的值必须在" + from + "和" + to + "之间";
                            if (fv >= +from && fv <= +to){
                                showRight(field,i.name, i);
                            }else{
                                showError(field ,i.name, i,  i, warnMsg);
                                return;
                            }
                        }
                        if (i.ajax){
                            ajax(i,fv,field);
                        }else{
                            showRight(field,i.name, i);
                        }
                    }
                }else{
                    if (field.is("input:checkbox")){
                        var checked_count = 0;
                        field.each(function(){
                            if (this.checked == true){
                                checked_count ++;
                            }
                        });
                        if(i.checked_limit){
                            var min = i.checked_limit[0] || 1, max = i.checked_limit[1] || null;
                            warnMsg = i.message || min==max?"请必须选择"+min+"项"+i.simple:(max? "请选择"+i.simple + min+"到"+max+"项目":"请至少选择" +min + "项" + i.simple);
                            if( (max && (checked_count>max || checked_count<min)) || (!max && checked_count<min) ){
                                showError(field ,i.name,  i, warnMsg);	return;
                            }else{
                                showRight(field,i.name,i, '正确');
                            }
                        }
                    }
                }
            },
        //元素组验证
            validate = function(){
                checkRet = true;
                $.each(settings.items, function(){
                    isAll=true; fieldCheck(this);
                });
                if(settings.isAlert && msg != ""){
                    alert(msg);	msg = "";
                }
                return checkRet;
            },

            val = function(){};
        //单元素事件绑定
        $.each(settings.items, function(){
            var field = $("[name='"+this.name+"']",formObj[0]);

            var obj = this,
                toExp = function(){showExp(obj);},
                toCheck = function(){ isAll=false; fieldCheck(obj);};
            if(field.is(":file") || field.is("select")){
                field.change(toCheck).focus(toExp);
            }else{
                field.blur(toCheck).focus(toExp);
            }
        });
        return this.each(function(){
            //提交事件绑定
            if(settings.isAjaxSubmit) {
                formObj.submit(function(){
                    //console.log(validate())
                    if (validate()){
                        if (settings.isBg){
                            $.fn.checkFormHandler.setPosition(formObj,settings);
                        }
                        $('input:submit',formObj).attr('disabled','disabled');
                        formObj.jAjaxSubmit(settings);
                    }
                    return false;
                });
            }else{//非ajax提交数据
              //  formObj.submit(validate)
                formObj.submit(function(){
                    if(validate()&&settings.fn){
                        settings.fn();
                    }
                    return false;
                })
            }
        });
    };
    $.checkFormHandler = function(){};
    $.checkFormHandler.defaultSettings = {
        items				: [],
        isAlert				: false,
        isAjaxSubmit		: false,
        success				: $.noop,
        isBg				: true,
        clearForm			: true,
        root				: '',
        ajaxImage			: null
    };

    $.checkFormHandler.rule	= {
        "eng" 		: [/^[A-Za-z]+$/,"只能输入英文"],
        "chn" 		: [/^[\u0391-\uFFE5]+$/,"只能输入汉字"],
        "mail" 		: [/^(\w-*_*\.*)+@(\w-?)+(\.\w{2,})+$/,"格式不正确"],
        "url" 		: [/^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,"格式不正确"],
        "currency" 	: [/^\d+(\.\d+)?$/,"数字格式有误"],
        "number" 	: [/^\d+$/,"只能为数字"],
        "int" 		: [/^[0-9]{1,30}$/,"只能为整数"],
        "double" 	: [/^[-\+]?\d+(\.\d+)?$/,"只能为带小数的数字"],
        "username" 	: [/^[a-zA-Z][a-zA-Z0-9_]{3,29}$/,"用户名不合法"],
        "password" 	: [/^(\w){6,20}$/,"只能为数字和英文及下划线的组合，6-20个字符"],
        "safe" 		: [/>|<|,|\[|\]|\{|\}|\?|\/|\+|=|\||\'|\\|\"|:|;|\~|\!|\@|\#|\*|\$|\%|\^|\&|\(|\)|`/i,"不能有特殊字符"],
        "dbc" 		: [/[ａ-ｚＡ-Ｚ０-９！＠＃￥％＾＆＊（）＿＋｛｝［］｜：＂＇；．，／？＜＞｀～　]/,"不能有全角字符"],
        "qq" 		: [/[1-9][0-9]{4,}/,"格式不正确"],
        "date" 		: [/^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))$/,"格式不正确"],
        "telephone" : [/^1\d{10}$/,"格式不正确"],
        "zipcode" 	: [/^[1-9]\d{5}$/,"格式不正确"],
        "bodycard" 	: [/^((1[1-5])|(2[1-3])|(3[1-7])|(4[1-6])|(5[0-4])|(6[1-5])|71|(8[12])|91)\d{4}((19\d{2}(0[13-9]|1[012])(0[1-9]|[12]\d|30))|(19\d{2}(0[13578]|1[02])31)|(19\d{2}02(0[1-9]|1\d|2[0-8]))|(19([13579][26]|[2468][048]|0[48])0229))\d{3}(\d|X|x)?$/,"格式不正确"],
        "ip" 		: [/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/,"IP不正确"],
        "empty"     : [/^\S*$/, "不能为空"],
        "eq"		: [function(arg1,arg2){ return arg1==arg2 ? true:false;},"必须等于"],
        "gt"		: [function(arg1,arg2){ return arg1>arg2 ? true:false;},"必须大于"],
        "gte"		: [function(arg1,arg2){ return arg1>=arg2 ? true:false;},"必须大于或等于"],
        "lt"		: [function(arg1,arg2){ return arg1<arg2 ? true:false;},"必须小于"],
        "lte"		: [function(arg1,arg2){ return arg1<=arg2 ? true:false;},"必须小于或等于"]
    };

    $.checkFormHandler.extendRemove = function(target, props) {
        $.extend(target, props);
        for (var name in props)
            if (props[name] == null || props[name] == undefined)
                target[name] = props[name];
        return target;
    };

    $.checkFormHandler.addRules = function(settings) {
        $.checkFormHandler.extendRemove($.checkFormHandler.rule, settings || {});
        return this;
    };

    $.fn.checkFormHandler.setPosition = function(formObj,settings){
        var form_position = formObj.offset();
        settings.overLayObj.css({
            'width' : formObj.outerWidth(),
            'height': formObj.outerHeight(),
            'top'	: form_position.top,
            'left'	: form_position.left,
            'opacity':'0.5'
        }).fadeIn();
        var image_h = settings.ajaxImageObj[0].height;
        var marginTop = parseInt((formObj.outerHeight() - image_h)/2,10);
        if (settings.ajaxImage) settings.ajaxImageObj.css('marginTop',marginTop);
    };

    $.fn.jAjaxSubmit = function(options) {
        if (!this.length) {	return this;}
        return this.each(function(){
            var $form = $(this), callbacks = [];
            var url = $.trim($form.attr('action'));
            if (url) url = (url.match(/^([^#]+)/)||[])[1];
            url = url || window.location.href || '';
            options = $.extend(true, {
                url		:  url,
                type	: $form.attr('method') || 'GET',
                dataType:'html'
            }, options);

            var q = $form.serialize();

            if(options.type.toUpperCase() == 'GET') {
                options.url += (options.url.indexOf('?') >= 0 ? '&' : '?') + q;
                options.data = null;
            }else{
                options.data = q;
            }

            if (options.clearForm) {
                callbacks.push(function() { $form.clearForm(); });
            }

            callbacks.push(function(){
                $.fn.removeBg($form);
            });

            if (options.success) {
                callbacks.push(options.success);
            }

            options.success = function(data, status, xhr) {
                var context = options.context || options;
                for (var i=0, max=callbacks.length; i < max; i++) {
                    callbacks[i].apply(context, [data, status, xhr || $form, $form]);
                }
            };
            $.ajax(options);
        });
    };

    $.fn.removeBg = function($form){
        $('#checkFormHandlerOverlay').fadeOut();
        $('input:submit',$form[0]).removeAttr('disabled');
    };

    $.fn.clearForm = function() {
        return this.each(function() {
            $('input,select,textarea', this).clearFields();
        });
    };

    $.fn.clearFields = function() {
        return this.each(function() {
            var t = this.type, tag = this.tagName.toLowerCase();
            if (t == 'text' || t == 'password' || tag == 'textarea') {
                this.value = '';
            }
            else if (t == 'checkbox' || t == 'radio') {
                this.checked = false;
            }
            else if (tag == 'select') {
                this.selectedIndex = -1;
            }
        });
    };

    //锁定背景屏幕
    function lockScreen() {
        var clientH = document.body.offsetHeight; //body高度
        var clientW = document.body.offsetWidth; //body宽度
        var docH = document.body.scrollHeight; //浏览器高度
        var docW = document.body.scrollWidth; //浏览器宽度
        var bgW = clientW > docW ? clientW : docW; //取有效宽
        var bgH = clientH > docH ? clientH : docH; //取有效高
        var blackBg = document.createElement("div");
        blackBg.id = "blackBg";
        blackBg.style.position = "absolute";
        blackBg.style.zIndex = "99999";
        blackBg.style.top = "0";
        blackBg.style.left = "0";
        blackBg.style.width = bgW+"px";
        blackBg.style.height = bgH+"px";
        blackBg.style.opacity = "0.4";
        blackBg.style.backgroundColor = "#333";
        document.body.appendChild(blackBg);
    }
    //关闭按钮事件
    function popupClose(el) {
        var blackBg = document.getElementById("blackBg");
        blackBg && document.body.removeChild(blackBg);
        el.parentNode.style.display = "none";
    }
    //自动关闭
    function autoClose(id) {
        id = id || "H-dialog";
        var blackBg = document.getElementById("blackBg");
        var objDiv = document.getElementById(id);
        setTimeout(function(){
            blackBg && document.body.removeChild(blackBg);
            objDiv.style.display = "none";
        },2000);
    }
    /**
     *功能 : 弹窗信息
     *参数1 : 提示信息内容
     *参数2 : 提示信息状态默认0 为提示信息,1为成功信息
     *参数3 : 弹窗div的id,默认"H-dialog"
     *参数4 : 弹窗内容的id,默认"msgCont"
     **/
    function showMsg(msg) {
        msg = msg || "请重新操作";
        var status = arguments[1] || 0,
            popupId = arguments[2] || "H-dialog",
            contentId = arguments[3] || "msgCont";
        lockScreen();
        //屏幕实际高宽
        var pageWidth = window.innerWidth;
        var pageHeight = window.innerHeight;
        if (typeof pageWidth != "number") {
            if (document.compatMode == "CSS1Compat") {
                pageWidth = document.documentElement.clientWidth;
                pageHeight = document.documentElement.clientHeight;
            } else {
                pageWidth = document.body.clientWidth;
                pageHeight = document.body.clientHeight;
            }
        }
        //滚动条高宽
        var scrollLeft = window.document.documentElement.scrollLeft;
        var scrollTop = 0;
        if (typeof window.pageYOffset != 'undefined') {
            scrollTop = window.pageYOffset;
        } else if (typeof window.document.compatMode != 'undefined' &&
            window.document.compatMode != 'BackCompat') {
            scrollTop = window.document.documentElement.scrollTop;
        } else if (typeof window.document.body != 'undefined') {
            scrollTop = window.document.body.scrollTop;
        }
        var div_X = (pageWidth - 400) / 2 + scrollLeft;
        var div_Y = (pageHeight - 200) / 2 + scrollTop;
        var objDiv = document.getElementById(popupId);
        if (status) {
            document.getElementById(contentId).style.background = "url($Root/Assets/Images/ui_success.png) no-repeat 20px 50%";
        }
        document.getElementById(contentId).innerHTML = msg;
        objDiv.style.display = "block";
        objDiv.style.left = div_X + "px";
        objDiv.style.top = div_Y + "px";
        autoClose(popupId);
    }
})(jQuery);