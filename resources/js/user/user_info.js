-(function($){
    $(document).ready(function(){
        var formObj = $("form[name='infoForm']").get(0), tp = $('.select_ul'), initDate = function(){
            var nowDate = new Date(), yearMax = nowDate.getFullYear(), monthMax = nowDate.getMonth()+1,
                dayMax =nowDate.getDate(),strY='',strM ='',strD ='';
            for(var i =1900;i<=yearMax;i++){
                strY+='<li class="da y">'+i+'</li>';
            }
            tp.eq(0).html(strY);
            for(var j =1;j<=12;j++){
                strM+='<li class="da m">'+j+'</li>';
            }
            tp.eq(1).html(strM);
            for(var k =1;k<=31;k++){
                strD+='<li class="da d">'+k+'</li>';
            }
            tp.eq(2).html(strD);
        };
        var ajaxHandler = function(){
            var postObj = {
                nickName:formObj.nick_name.value,
                firstName: formObj.first_last_name.value,
                lastName: formObj.first_last_name.value,
                salutation: $("label[class='checked']").eq(0).attr("value"),
                DOB:formObj.birthday_y.value+'-'+formObj.birthday_m.value+'-'+formObj.birthday_d.value,
                mobile: formObj.mobile_no.value
            };
            console.log(postObj);
            $.ajax({
                type:"POST",
                url:"/user/asy_change_info",
                data: postObj,
                async:true,
                cache: false,
                success: function(res){
                     if(res.success){
                           //alert('保存成功!');
                           window.location.href="/user/info";
                            sessionStorage.setItem("user_info[name]",postObj.nickName);
                         console.log(sessionStorage.getItem("user_info[name]"));
                         //$(".cl_green span").html(sessionStorage.getItem("user_info[name]"))
                     }else{
                         alert(res.message);
                     }
                },
                error:function(res){
                    alert('failed');
                    console.log(res)
                }
            });
        };
        var validateHandler = function(){
            $("#infoForm").validate({
                rules: {
                    nick_name: "required",
                    first_last_name: "required",
                    six_type: "required",
                    birthday_y: "required",
                    birthday_m: "required",
                    birthday_d: "required"
                },
                messages: {
                    nick_name: "昵称不能为空",
                    first_last_name: "姓名不能为空",
                    six_type: "请选择性别",
                    birthday_y: "出生年不能为空!",
                    birthday_m: "出生月年不能为空!",
                    birthday_d: "出生日不能为空!"
                },
                focusInvalid:true,
                errorElement:'em',
                onclick:false,
                errorPlacement:function(error,element) {
                    if (element.is(":radio")){
                        error.addClass('inline');
                        error.appendTo(element.parent());
                    }else if (element.is(":checkbox")){
                        error.appendTo(element.next());
                    }else{
                        error.appendTo(element.parent());
                        element.addClass('error')
                    }
                },

                success: function(error,element) {
                    $(element).removeClass('error')
                },

                submitHandler: function(form) {
                    ajaxHandler()
                },
                invalidHandler: function(form, validator) {
                   // alert('need fill all!')
                }
            });
        };
        var dataChangeHandler = function(para){
               var opUl = para, curY = $(para).prev().find('input').eq(0).val();
               var inputType = function(para){
                     return para.className.substring(10)
               };
               var createM_D = function(){
                     var currentYear = $("input[name='birthday_y']").eq(0).val();
                     var currentMonth = $("input[name='birthday_m']").eq(0).val();
                     var getDayNum = function(par1,par2){
                         var  isLeapYear = function(year){
                             return (year % 4 == 0) && (year % 100 != 0 || year % 400 == 0);
                         };
                         var isBigM = function(pra){
                             var bigMonth = [1,3,5,7,8,10,12], tag =false;
                              $(bigMonth).each(function(){
                                   if(this==pra){
                                       tag = true;
                                       return;
                                   }
                              });
                             return tag;
                         };
                             if(par2==2){
                                return isLeapYear(par1)?29:28;
                             }else if(isBigM(par2)){
                                 return 31;
                             }else{
                                 return 30;
                             }

                     };
                     var initDayLi = function(num) {
                            var strD = '';
                            for(var i= 1;i<= num;i++){
                                strD+='<li class="da d">'+i+'</li>';
                         }
                           return strD;
                     };
                       tp.eq(2).html(initDayLi(getDayNum(currentYear,currentMonth)));
               };
               if(inputType(opUl)=='year'||inputType(opUl)=='month'){
                       /*重新生成day:根据年，月*/
                        createM_D();
                   }
        };
        initDate();
        validateHandler();
        /*$("input[name='birthday_y']").on('input', function(e) {  /!*问题1：js 触发的值改变不能触发事件*!/
            alert(1)
        });*/
        $('.pr').on('click',function(){
            var ou = $('.select_ul', this).eq(0);
            ou.css('display') == 'block'? ou.slideUp():ou.slideDown();
        });

        $(document.body).on('click',function(event){
            var eve = event||window.event;
            if(eve.target.className.indexOf('da')>-1){
                var tem = $(eve.target.parentNode);
                tem.hide().prev().find('input').val( $(eve.target).html());
                dataChangeHandler(eve.target.parentNode);
            }else if(eve.target.className!='s_in'){
                tp.each(function(){
                   // $(this).hide();
                })
            }
        })
    })
        $('.sex').click(function(){
            var radioId = $(this).attr('name');
            $(".checked").removeAttr('class') && $(this).attr('class', 'checked');
            $('input[name="six_type"]').removeAttr('checked') && $('six_type').attr('checked', 'checked');
        });
})(jQuery);
