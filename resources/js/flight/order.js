;(function($){

    // 姓名校验, 不包含数字
    $.validator.addMethod("onlyChineseEnglish", function(value, element) {
        var length = value.length;
        var reg = /^[\u2E80-\u9FFFa-zA-Z]*$/;
        return this.optional(element) || (length > 0 && reg.test(value));
    }, "姓名只能包含中文和英文");

    // 手机号码验证asy_phone_code
    jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请正确填写您的手机号码");
  $(document).ready(function(){
    var travelerUl = $('.people_message'), urlPara = null, formObj = $("form[name='form1']").get(0)
    ,parseUrlHandler= function (url, isEncode) {
      var isEncode = isEncode || false, reg = /([^=&?]+)=([^=&?]+)/g, obj = {}, url = url;
      url.replace(reg, function () {
        var arg = arguments;
        obj[arg[1]] = isEncode ? decodeURIComponent(arg[2]) : arg[2];
      });
      return obj;
    }
    ,addMessageHandler = function(ite, context){
      var opUl =$(ite), that = context, suffix = opUl.attr('data-index');
      opUl.find("input[name='first_name"+suffix+"']").val($(that).attr("data-lastName"));
      opUl.find("input[name='last_name"+suffix+"']").val($(that).attr("data-firstName"));
      opUl.find('.idType').attr("data-value",$(that).attr("data-idtype")).html(vlm.idType[$(that).attr("data-idtype")]+"<i></i>");
      opUl.find("input[name='idNumber"+suffix+"']").val($(that).attr("data-idNumber"));
      opUl.find("input[name='idcountry"+suffix+"']").attr("data-idcountry",$(that).attr("data-countrycode"));
      opUl.find("input[name='idcountry"+suffix+"']").val($(that).attr("data-countryname"));
      opUl.find("input[name='date_birth"+suffix+"']").val($(that).attr("data-dateOfBirth"));
      opUl.find('input[type="radio"]').each(function(ele){
             if($(this).val() == $(that).attr("data-sexCode")){
                   $(this).attr('checked', 'checked');
                   $(this.parentNode).addClass('cur');
             }else{
                 $(this).removeAttr('checked');
                 $(this.parentNode).removeClass('cur');
             }
      });
      opUl.find("input[name='person_type"+suffix+"']").val( $(that).attr('data-passengertype'));
      opUl.find("input[name='idActivatedDate"+suffix+"']").val( $(that).attr('data-idactivateddate'));
        // 添加证件类型数据
        var idTypeSelectEl = opUl.find('.idType').parent();
        $(that).find('.list_traveller_id_info').each(function(index, el) {
            idTypeSelectEl.find('.select_ul>li[data-value=' + $(el).attr('data-idtype') + ']')
                .attr('data-idnumber', $(el).attr('data-idnumber'));
        });
    }
    ,clearMessage = function(){
        var opEle = $(arguments[0]), suffix = opEle.attr('data-index');
        opEle.find("input[name='first_name"+suffix+"']").val("");
        opEle.find("input[name='last_name"+suffix+"']").val("");
        opEle.find('.idType').attr("data-value","");
        opEle.find("input[name='idNumber"+suffix+"']").val("");
        opEle.find("input[name='idcountry"+suffix+"']").val("");
        opEle.find("input[name='idcountry"+suffix+"']").attr('data-idcountry',"");
        opEle.find("input[name='date_birth"+suffix+"']").val("");
        opEle.find('.sex_radio').each(function(){
             $(this).removeClass('cur').find('input[type="radio"]').removeAttr('checked');
      });
        opEle.find("input[name='person_type"+suffix+"']").val("");
        opEle.find("input[name='idActivatedDate"+suffix+"']").val("");
        opEle.find("input[name='baggageCode"+suffix+"']").val("");
        // 证件类型数据的清除
        opEle.find('.idType').siblings('.select_ul').find('li').each(function(index, el) {
            $(el).removeAttr('data-idnumber');
        });
    }
    ,getBookingNo = function(){
            /*提交下单*/
            var  travellerInfo = [], contactDetail = {},wapOrder = {};
            $('.people_message').each(function(){
              var temObj = {}, suffix = $(this).attr('data-index');
              temObj.certificateInfo = {};
              temObj.passengerType =  $(this).find("input[name='person_type"+suffix+"']").val() || 1;
              temObj.sexCode = $(this).find("input[checked='checked"+suffix+"']").attr('data-value') || 1;
              temObj.firstName = $(this).find("input[name='first_name"+suffix+"']").val();
              temObj.lastName = $(this).find("input[name='last_name"+suffix+"']").val();
              temObj.dateOfBirth = $(this).find("input[name='date_birth"+suffix+"']").val();
              temObj.baggageCode = $(this).find("input[name='baggageCode"+suffix+"']").val();
              temObj.countryCode = $(this).find("input[name='idcountry"+suffix+"']").attr('data-idcountry');
              /*certificateInfo*/
              temObj.certificateInfo.idType =  $(this).find(".idType").attr('data-value')||3;
              temObj.certificateInfo.idNumber =  $(this).find("input[name='idNumber"+suffix+"']").val();
              temObj.certificateInfo.idCountry =  $(this).find("input[name='idcountry"+suffix+"']").attr('data-idcountry')||"CN";
              temObj.certificateInfo.idActivatedDate =  $(this).find("input[name='idActivatedDate"+suffix+"']").val()||"2022-07-08";
              travellerInfo.push(temObj);
            });
            /*wapOrder*/
            wapOrder.cityCodeFrom = urlPara.cityCodeFrom;
            wapOrder.cityCodeTo = urlPara.cityCodeTo;
            wapOrder.numofAdult = urlPara.numofAdult;
            wapOrder.numofChild = urlPara.numofChild;
            wapOrder.routeType = urlPara.routeType;
            /*contactDetail*/
            contactDetail.sexCode = $(this).find("input[checked='checked']").val() ||1;
            contactDetail.firstName = formObj.c_first_last_name.value;
            contactDetail.lastName = formObj.c_first_last_name.value;
            contactDetail.email = formObj.c_email.value;
            contactDetail.mobilePhone = formObj.c_mobile_phone.value;
            contactDetail.countryNumber = '86';
            var postObj = {
              wapOrder:wapOrder,
              travellerInfo:travellerInfo,
              contactDetail:contactDetail,
              currencyCode:"CNY",
              findex:urlPara.findex,
              cindex:urlPara.cindex
            };

            ajaxHandler(postObj,"/flight/get_order_no");
    }
    ,formHandler = function() {
          var rulesD = arguments[0][0], messagesD = arguments[0][1];
          validator = $('#orderForm').validate({
              focusInvalid:true,
              rules:rulesD,
              messages:messagesD,
              errorPlacement:function(error,element) {
                  if(element.is(':radio')){
                      error.addClass('error_inline');
                  }
                  element.is(':radio')?error.appendTo(element.parent().parent()) :error.appendTo(element.parent());

              },
              submitHandler: function(form) {
                  getBookingNo();
              },
              invalidHandler:function(form, validator) {
                $("#loading").show();;
              },
              highlight: function (element, errorClass) {
                 /* $(element).addClass(errorClass);
                  if (element.className.indexOf('ttt') > -1) {
                      $(element).next().animate({top: "50px"})
                  }*/
              },
              unhighlight: function (element, errorClass) {
                  //$(element).removeClass(errorClass);
              }
          });
      }
    ,ajaxHandler = function(data, url){

          $.ajax({
              type:"POST",
              url:url,
              data: data,
              async:false,
              cache: false,
              success: function(res){
                  if(res.success){
                      window.location.href='/flight/order_confirm?type=Flight&bookingID='+res.data.bookingID+'&bookingRefNo='+res.data.bookingRefNo;
                  }else{
                      alert(res.message);
                  }
              },
              error:function(res){
                  console.log(res)
              }
          });
      }
    ,inputNameHandler = function(){
          var rulesData = {},messagesData = {}, defaultRule = {required: true},defaultMessage = {required: "不能为空"};
          $('.passenger .people_message').each(function(index, ele){
              rulesData['first_name'+index] = {required: true, onlyChineseEnglish: true};
              rulesData['last_name'+index] =  {required: true, onlyChineseEnglish: true};
              rulesData['idNumber'+index] = defaultRule;
              rulesData['idcountry'+index] = defaultRule;
              rulesData['date_birth'+index] = defaultRule;
              rulesData['person_type'+index] = defaultRule;
              rulesData['sex_list'+index] = defaultRule;
              /*message*/
              messagesData['first_name'+index] = {required: "不能为空", onlyChineseEnglish: "姓名只能包含中文和英文"};
              messagesData['last_name'+index] =  {required: "不能为空", onlyChineseEnglish: "姓名只能包含中文和英文"};
              messagesData['idNumber'+index] = defaultMessage;
              messagesData['idcountry'+index] = defaultMessage;
              messagesData['date_birth'+index] = defaultMessage;
              messagesData['person_type'+index] = defaultMessage;
              messagesData['sex_list'+index] = {required: "必须选择性别"};
          });
          rulesData['c_first_last_name'] = {required: true, onlyChineseEnglish: true};
          rulesData['c_mobile_phone'] = {required: true, isMobile: true};
          rulesData['c_email'] = {required: true};
          rulesData['c_email']['email'] = true;
          /*message*/
          messagesData['c_first_last_name'] = {required: "不能为空", onlyChineseEnglish: "姓名只能包含中文和英文"};
          messagesData['c_mobile_phone'] = {required: "不能为空", isMobile: "请正确填写您的手机号码"};
          messagesData['c_email'] = {required: "不能为空"};
          messagesData['c_email']['email'] = "请输入一个正确的邮箱";
          return [rulesData,messagesData];
      }
    ,dateHandler = function(){
        $('.people_message .dateOfBirth').each(function(item){
              var tem = this.id;
              var isChild = $(this).parents('.people_message').attr('data-type') == 'child';
              $("#"+this.id).datepicker({
                minDate: (isChild ? '-12y' : null),
                maxDate: (isChild ? '-1d':'-12y'),
                defaultDate: '-12y',
                dateFormat: "yy-mm-dd",
                changeYear: true,
                yearRange: "-120:+0",
                changeMonth: true,
                numberOfMonths: 1,
                onClose: function () {
                    $(this).blur();
                },
                onSelect: function (selectedDate) {
                    var option = this.id == "startdate" ? "minDate" : "maxDate",
                        instance = $(this).data("datepicker"),
                        date = $.datepicker.parseDate(
                            instance.settings.dateFormat ||
                            $.datepicker._defaults.dateFormat,
                            selectedDate, instance.settings);
                    if (option == "minDate") {
                        dates.not(this).datepicker("option", option, date);
                    }
                }
            }, $.datepicker.regional['zh-cn']);
        });
    }
    ,validator;
    dateHandler();
    formHandler(inputNameHandler());
    //添加乘机人
    $('.card_font').click(function(){
      $(this).addClass('cur').siblings().each(function(){
        $(this).removeClass('cur');
      });
        // 判断是否是儿童
        var isChild = (function (card) {
            var birthNum = Date.parse($(card).attr('data-dateofbirth'));
            if (isNaN(birthNum)) {
                // 没填写生日的按成人计算
                return false;
            }
            var birth = new Date(birthNum);
            var now = new Date();
            //
            // (now月>birth月 && now日>birth日 && now年-birth年>=12) || now年-birth年>=13
            if ((now.getMonth() > birth.getMonth()
                    && now.getDate() > birth.getDate()
                    && now.getFullYear() - birth.getFullYear() >= 12
                ) || now.getFullYear() - birth.getFullYear() >= 13) {
                // 成人
                return false;
            }
            // 儿童
            return true;
        })(this);

      var getInputUl = function(){
        var opEle = null;
        $('.people_message').each(function(){
                if ($("input.person_type", this).eq(0).val() == "") {
                    if (isChild && $(this).attr('data-type') == 'child') {
                        // 数据是儿童且表单也是儿童的
                        opEle = this;
                        return false;
                    } else if (!isChild && $(this).attr('data-type') == 'adult') {
                        // 数据是成人且表单也是成人的
                        opEle = this;
                        return false;
                    }
                }
        });
        return opEle;
      };
     var opUl = getInputUl();
      if(opUl){
        addMessageHandler(opUl, this);
      }else{
          if (isChild) {
              alert('只能选择' + (Number(urlPara.numofChild)) + '位儿童!');
          } else {
              alert('只能选择' + (Number(urlPara.numofAdult)) + '位成人!');
          }

      }
    });
    //清空乘机人
      urlPara = parseUrlHandler(window.location.href, true);
      $(".country_slider").on('click',function(){
             $('.nationality_ul', this).slideToggle("fast");
      });
      $(document.body).on('click', function(event){
          var event = event || window.event;
          var target = event.target || event.srcElement;
          $(".select_ul").hide();
     if(target.className == "empty fr"){
     clearMessage($(target).parents('.people_message').eq(0))
     }else if(target.className.indexOf('sex_radio')>-1||target.parentNode.className.indexOf('sex_radio')>-1){
                 var temEle = target.className.indexOf('sex_radio')>-1?target:target.parentNode;
                   $(temEle).find('input[type="radio"]').attr('checked', 'checked');
                   $(temEle).addClass('cur').siblings().each(function(){
                          $(this).removeClass('cur').find('input[type="radio"]').removeAttr('checked');
                   });
     }else if(target.tagName=="LI"&&target.parentNode.className =="select_ul"){
                      var opEle =  $(target).parents('.select_unit').eq(0);
                      $(opEle).find('.idType').eq(0).attr('data-value', $(target).attr('data-value')).html($(target).text()+'<i></i>');
              }else if(target.parentNode.className =="nationality_ul"){
                            $(target.parentNode).prev().val( $(target).html()).attr('data-idcountry', $(target).attr('data-value'));
     }else if($(target).parents('.nationality').length==0){
             $('.nationality_ul').hide()
     }
     })
      //退改规则
      var order =  function(){
          if($(".info_direct").length>1){
              $(".info_direct:last")[0].style.border = "0px solid #fff";
          }else{
              $(".info_direct")[0].style.border = "0px solid #fff";
          }
      }
      var warn = function(){
          $("#back").hover(function(){
              $("#Back").show();
          },function(){
              $("#Back").hide();
          });
          $("#bag").hover(function(){
              $("#Bag").show();
          },function(){
              $("#Bag").hide();
          });
      }
      warn();
      order();

      // 添加证件类型选中事件, 选中时更改证件号
      $('.select_btn.idType').each(function (index, el) {
          $(el).siblings('.select_ul').find('li').click(function () {
              var input = $(el).parent().siblings('.word_lp').find('input');
              var idnumber = $(this).attr('data-idnumber') || '';
              input.val(idnumber);
          })
      });
  });
})(jQuery);
