/**
 * Created by zhouwei on 2016/7/18.
 * 支付页面（酒店，机票，酒+景，机+X）
 */
(function ($) {
  /*Globle变量声明*/
  var type /*业务类型 */,
      bookingRefNo /*订单号 */,
      paymentMode /*支付模式（10 - CreditCard; 20 - UnionPay; 21 - UnionPayCNY; 30 - AliPay; 31 - AlipayCNY; 40 - PayPal） */,
      cardType /*卡类型（101 - Visa; 102 - Master; 103 - Amex; 104 - JCB; 105 - Diner） */;

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

  var payment = function () {

    /*支付类型*/
    var paymentType = {
      "Paypal": {id: 21, name: "Paypal"},
      "UnionPayCNY": {id: 28, name: "银联卡",moduleName:"wechat-module"},
      "AliPayCNY": {id: 27, name: "支付宝" ,moduleName:"wechat-module"},
      "Visa": {id: 1, name: "Visa信用卡",moduleName:"wechat-module"},
      "Master": {id: 20, name: "万事达信用卡"},
    };

    /*支付模块（酒店，机票，景点，酒+景，机+酒）*/
    var _bussinessType = {
      "Hotle": {id: 1, name: "酒店", detailCode: "0013", payMentCode: "0012"},
      "Flight": {id: 2, name: "机票", detailCode: "3006", payMentCode: "3004"},
      "Scenic": {id: 3, name: "景点", detailCode: "0095", payMentCode: "0093"},
      "Tour": {id: 4, name: "酒+景", detailCode: "0095", payMentCode: "0203"},
      "FlightHotle": {id: 5, name: "机+酒", detailCode: "50100007", payMentCode: "50100005"},
      "FlightHotelTour": {id: 6, name: "机+酒+景", detailCode: "60100013", payMentCode: "60100011"}
    };

    var formHandler = function(){
      $("#form").validate({
        rules: {
          cardHolderName: {
            required : true,
            onlyChineseEnglish : true
          },
          cardNumber: {
            required : true,
            digits:true
          },
          digits:true,
          bankName: {
            required: true,
            minlength: 2
          },
          cardExpiry_month: {
            max : 12,
            min : 1,
           required: true,
           digits:true
          },
          cardExpiry_year:{
            max : 99,
            min : 1,
           required: true,
           digits:true
          },
          cardSecurityCode: {
            required: true,
            digits:true
          },
          mobilePhone: {
            isMobile : true,
            required: true,
            digits:true
          },
          cardAddress: "required",
          cardAddressPostalCode: {
            required : true,
            digits: true
          },
          //agree:{
          //  required: true,
          //}
        },
        errorPlacement:function(error,element) {
          if(element.is(':radio')){
            error.addClass('error_inline');
            element.is(':radio')?error.appendTo(element.parent().parent()) :error.appendTo(element.parent());
          };
          if(element.is(':checkbox')) {
            error.appendTo(element.parent().parent().parent());
            return;
          }
        },
        messages: {
          cardHolderName: {
            required : '请输入持卡人姓名',
            onlyChineseEnglish : '姓名只能包含中文和英文'
          },
          cardNumber: {
            required : '请输入正确的卡号',
            digits : '请输入正确的卡号'
          },
          digits:"请输入数字",
          bankName: {
            required: "请输入发卡银行",
            minlength: 2
          },
          cardExpiry_month: {
            max : "请输入正确的月份",
            min : "请输入正确的月份",
           required: "请输入正确的月份",
           digits:"请输入正确的月份"
          },
          cardExpiry_year:{
            max : "请输入正确的年份",
            min : "请输入正确的年份",
           required: "请输入正确的年份",
           digits:"请输入正确的年份"
          },
          cardSecurityCode: {
            required: "请输入安全码",
            digits:"请输入数字"
          },
          mobilePhone: {
            isMobile : "请输入正确的手机号",
            required: "请输入正确的手机号",
            digits:"请输入正确的手机号"
          },
          cardAddress: "请输入地址",
          cardAddressPostalCode: {
            required : "请输入邮编",
            digits:"请输入数字"
          },
          //agree:{
          //  required: "请阅读并同意《服务支付协议》"
          //}
        },
        submitHandler: function(form) {
          _payMehtond();
        }
      });
    };

    /*页面初始化*/
    var _initEvent = {
      //页面事件绑定
      bindEvent: function () {
        //选择支付方式
        $(".tabs li").on("click", function () {
          $(".tabs li").removeClass("cur");
          $(this).addClass("cur");
          var id=$(this).attr("data-paymentmode");
          $(".tabsConten .tab_div").css("display","none")
          $(".tabsConten div[data-paymentmode="+id+"]").css("display","block")

        })
        $(".tab_div .credit .type span").on("click", function () {
          $(this).parent().find("i").removeClass("curs")
          $(this).find("i").addClass("curs");
        })

        $(".wechatPay").on("click", function (){
              window.location.href="/payment/scan_pay?bookingRefNo="+bookingRefNo+"&type=Flight"
        });

        $(".service_icon").on("click",function(){
            $(this).toggleClass("checkbox_cur")
        });

        $('[checkbox-icon] input:checkbox').on('change', function (e) {
          this.checked ? $(this).parent().addClass('checkbox_cur') : $(this).parent().removeClass('checkbox_cur');
        });

        $(".alipayPay").on("click",function(){
          _payMehtond();
        })

        //$(".btnSubmit").on("click", function () {
        //  _payMehtond();
        //})
      },
    }

    /*支付Modle实体*/
    var _get_modle = function () {
      return {
        bookingRefNo:bookingRefNo,
        totalPrice:$(".price_num .priceAccount").html(),
        paymentMode: $("#Tabs .cur").attr("data-paymentmode"),
        cardInfo:{
          //信用卡信息
          "bankName": "222",
          "countryNumber": $(".phone_pre ").attr("data-code"),
          "cardAddressCity": "123",
          "cardExpiryDate": $(".cardExpiryDate").attr("data-expire"),
          "cardNumber": $(".cardNumber").val(),
          "MobilePhone": $(".mobilePhone").val(),
          "cardType": $(".credit .content_first .curs").attr("data-cardtype"),
          "cardSecurityCode": $(".cardSecurityCode").val(),
          "cardAddressCountryCode": $(".cardIssuanceCountryCode").attr("data-code"),
          "cardAddress": $(".cardAddress").val()
        }
      }
    }

    var _payMehtond=function() {

      var year=$(".cardExpiry_year").val()==""?"19":$(".cardExpiry_year").val();
      var month=$(".cardExpiryDate").val()==""?"01":$(".cardExpiryDate").val();
      var modle={
        type:vlm.getpara("type"),
        bookingRefNo: bookingRefNo,
        totalPrice: $(".price_num .priceAccount").html(),
        paymentMode: $("#Tabs .cur").attr("data-paymentmode"),
        cardInfo: {
          //信用卡信息
           "cardType":$("#Tabs .credit_tab").hasClass("cur") ?$(" .content_first .curs").attr("data-cardtype"):$("#Tabs .cur").eq(0).attr("data-paymentmode"),
          "cardHolderName":$(".cardHolderName").val(),
          "bankName": $(".bankName").val(),
          "countryNumber": $(".countrylist").find("span").attr("data-id"),
          "cardAddressCity": "Beijing",
          "cardExpiryDate":  "20"+year+"-"+month+"-01",
          "cardNumber": $(".cardNumber").val(),
          "MobilePhone": $(".mobilePhone").val(),
          "cardSecurityCode": $(".cardSecurityCode").val(),
          "cardCountryCode":$(".countrylist").find("span").attr("data-id"),
          "cardAddressCountryCode":$(".cardAddressCountryCode").find("span").attr("data-id"),
          "cardAddressPostalCode": $(".cardAddressPostalCode").val(),
          "cardAddress": $(".cardAddress").val()
        }
      }
      $("#loading").delay(10).fadeIn("medium");
      $.ajax({
        type:"POST",
        url:"/payment/asy_payment",
        data: modle,
        async:true,
        cache: false,
        success: function(msg){
          var msg = JSON.parse(msg);
          if (msg.success) {
            //var w = window.open();

            window.location.href = msg.message;
          }
          else {
            alert(msg.message);
          }
        },
        error:function(msg){

          alert(msg);

        },
        complete:function(XMLHttpRequest,textStatus){
          $("#loading").hide();
        }
      });
    }

    /*页面初始化方法*/
    var _initPage = function () {
      //获取Url参数
      type = _bussinessType[vlm.getpara("type")]; //业务类型（1酒店，2机票，3景点，4酒+景，5机+景）
      bookingRefNo = vlm.getpara("bookingRefNo"); //订单code
      _initEvent.bindEvent();
      formHandler();
    };

    /*接口*/
    return {
      InitPage: _initPage()
    }
  }();

})(jQuery)
