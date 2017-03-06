<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 机票Controller类，继承于HomeBase_Controller基类
 */
class Payment extends HomeBase_Controller {

    /**
     * 构造函数
     *
     */
    public function __construct(){
        parent::__construct();
        $this->load->helper('country'); //自定义国家helper类引用
        $this->load->helper('time');    //自定义时间helper类引用
    }
    // --------------------------------------------------------------------

    /**
     * 支付页面-首页
     *
     */
    public function index()
    {
        $data['title']= '支付页面';
        $data['header'] = $this->load->view('common/header_empty',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $type=$_GET['type'];
        $bookingRefNo=isset($_GET['bookingRefNo'])?$_GET['bookingRefNo']:"";
        $data['country'] = get_country();
        $json_string="";
        if($type=="Flight"){
            $param = array(
                'Parameters' => array(
                    'bookingRefNo'=>$bookingRefNo
                ),
                'code' => 30100006,
                'foreEndType' =>4
            );
            $json_string =json_encode($param);
            $data['country']=get_country();
            $data['lists']=parent::post_json($json_string);
            $this->load->view('payment/index', $data);
        }
        elseif($type=="Ticket"){
            $param = array(
                'Parameters' => array(
                    'bookingRefNo'=>$bookingRefNo
                ),
                'code' => 20100010,
                'foreEndType' =>4
            );
            $json_string =json_encode($param);
            $data['Tlist']=parent::post_json($json_string);
            $this->load->view('payment/index', $data);
        }
        elseif($type=="HotelTicket"){
            $param = array(
                'Parameters' => array(
                    'bookingRefNo'=>$bookingRefNo
                ),
                'code' => 40100006,
                'foreEndType' =>4
            );
            $json_string =json_encode($param);
            $data['HTlist']=parent::post_json($json_string);
            $this->load->view('payment/index', $data);
        }
        elseif($type=="Hotel"){
            if($bookingRefNo!="") {
                $para = array(
                    'Parameters' => array(
                        'BookingReferenceNo' => $bookingRefNo,
                        'CultureName' => "zh-CN"
                    ),
                    'code' => 10100007,
                    'foreEndType' => 4
                );
                $json_string = json_encode($para);
                $hotelDetail = parent::post_json($json_string);
                $data['Hlist']=$hotelDetail->data[0];
            }
            else{
                $order=$_SESSION["order_para"];
                $Hlist =new stdClass();
                $Hlist->totalAmount=$order["parameters"]["totalPrice"];
                $Hlist->GuestLastName=$order["parameters"]["GuestLastName"];
                $Hlist->GuestFirstName=$order["parameters"]["GuestFirstName"];
                $Hlist->hotelName=$order["parameters"]["hotelName"];
                $Hlist->hotelNameLocale=$order["parameters"]["hotelNameLocale"];
                $Hlist->checkInDate=$order["parameters"]["checkInDate"];
                $Hlist->checkOutDate=$order["parameters"]["checkOutDate"];
                $data['Hlist']=$Hlist;
            }
            $this->load->view('payment/index', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 支付页面-详情页面
     *
     */
    public function order_detail()
    {
        $data['title']= '详情页面';
        $data['header'] = $this->load->view('common/header',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $type = $_GET["type"];
        $bookingRefNo = $_GET["bookingRefNo"];
        $para="";
        if($type=="Flight") {
            $para = array(
                'Parameters' => array(
                    'bookingRefNo' => $bookingRefNo
                ),
                'code' => 30100006,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['lists']=parent::post_json($json_string);
            $data['orderbag']=$data['lists']->data->flightInfo;
            $data['order_bag']=$this->load->view('flight/template/order_confirm/order_bag',$data,true);
            //退改签
            $paraPolicy = array(
                'Parameters' => array(
                    "setID"=>"102354",
                    "cacheID"=>"102521",
                ),
                'code' => 30100018,
                'foreEndType' =>4
            );
            $json_string_policy = json_encode($paraPolicy);
            $data['data_policy']=parent::post_json($json_string_policy);
            $data['order_back']=$this->load->view('flight/template/order_confirm/order_back',$data,true);
            $data['PIS_info']=$this->load->view('payment/template/PIS_info',$data,true);
            $data['linkdata']=$data['lists']->data;
            $data['link_info']=$this->load->view('payment/template/link_info',$data,true);
            $data['orderinfo']=$data['lists']->data;
            $data['order_info']=$this->load->view('payment/template/order_info',$data,true);
            $this->load->view('payment/order_detail_flight', $data);
        } else if($type=="Ticket"){
            $para = array(
                'Parameters' => array(
                    'bookingRefNo' => $bookingRefNo
                ),
                'code' => 20100010,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['lists']=parent::post_json($json_string);
            $data['orderinfo']=$data['lists']->data;
            $data['order_info']=$this->load->view('payment/template/order_info',$data,true);
            $data['toursdata']=$data['lists']->data;
            $data['scenic_info']=$this->load->view('payment/template/Scenic_info',$data,true);
            $data['shuttledata']=$data['lists']->data->pickupPoint;
            $data['scenic_shuttle']=$this->load->view('payment/template/Scenic_shuttle',$data,true);
            $data['visitordata']=$data['lists']->data->travelers;
            $data['visitors_info']=$this->load->view('payment/template/visitors_info',$data,true);
            $data['linkdata']=$data['lists']->data->contactDetails;
            $data['link_info']=$this->load->view('payment/template/link_info',$data,true);
            $this->load->view('payment/order_detail_scenic', $data);
        } else if($type=="HotelTicket"){
            $para = array(
                'Parameters' => array(
                    'bookingRefNo' => $bookingRefNo
                ),
                'code' => 40100006,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['lists']=parent::post_json($json_string);
            $data['orderinfo']=$data['lists']->data;
            $data['orderinfo']->totalAmount=$data['orderinfo']->chargeDetails[0]->totalAmountInCNY;
            $data['order_info']=$this->load->view('payment/template/order_info',$data,true);
            $data['toursdata']=$data['lists']->data;
            $data['scenic_info']=$this->load->view('payment/template/Scenic_info',$data,true);
            $data['shuttledata']=$data['lists']->data;
            $data['scenic_shuttle']=$this->load->view('payment/template/Scenic_shuttle',$data,true);
            $data['visitordata']=$data['lists']->data->travelers;
            $data['visitors_info']=$this->load->view('payment/template/visitors_info',$data,true);
            $data['linkdata']=$data['lists']->data->contactDetails;
            $data['link_info']=$this->load->view('payment/template/link_info',$data,true);
            $para = array(
                'Parameters' => array(
                    "cultureName" =>"zh-CN",
                    'hotelID' => $data['lists']->data->hotelDetails->hotelID,
                ),
                'code' => 10100902,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['hotel_info']=parent::post_json($json_string);
            $this->load->view('payment/order_detail_tour', $data);
        }
        else if($type=="Hotel") {
            $para = array(
                'Parameters' => array(
                    'BookingReferenceNo' => $bookingRefNo,
                    'CultureName'=>"zh-CN"
                ),
                'code' => 10100007,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['lists']=parent::post_json($json_string);
            $data['orderinfo']=$data['lists']->data;
            $data['Horderinfo']=$this->load->view('payment/template/order_info',$data,true);
            $data['visitordata']=$data['lists']->data;
            $data['visitors_info']=$this->load->view('payment/template/visitors_info',$data,true);
            $data['linkdata']=$data['lists']->data;
            $data['link_info']=$this->load->view('payment/template/link_info',$data,true);
            $this->load->view('payment/order_detail_hotel', $data);
        }
        else if($type=="FlightHotle"){
            $this->load->view('payment/order_detail_FlightHotle', $data);
        }
        else if($type=="FlightHotelTour"){
            $this->load->view('payment/order_detail_tour', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 支付页面-微信二维码页面
     *
     */
    public function scan_pay()
    {
        $data['title']= '扫描支付';
        $data['header'] = $this->load->view('common/header',$data,true);
        $para1 = null;
        $type=$_GET['type'];
        $bookingRefNo = $_GET["bookingRefNo"];
        if($type=="Flight"){
        $para = array(
            'Parameters' => array(
                'bookingRefNo'=>$bookingRefNo
            ),
            'code' => 30100006,
            'foreEndType' =>4
        );
        $json_string = json_encode($para);
        $data['lists']=parent::post_json($json_string);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $this->load->view('payment/scan_pay', $data);
        }
        elseif($type=="Ticket"){
            $param = array(
                'Parameters' => array(
                    'bookingRefNo'=>$bookingRefNo
                ),
                'code' => 20100010,
                'foreEndType' =>4
            );
            $json_string =json_encode($param);
            $data['Tlistscan']=parent::post_json($json_string);
            $data['footer'] = $this->load->view('common/footer',null,true);
            $this->load->view('payment/scan_pay', $data);
        }
        elseif($type=="HotelTicket"){
            $param = array(
                'Parameters' => array(
                    'bookingRefNo'=>$bookingRefNo
                ),
                'code' => 40100006,
                'foreEndType' =>4
            );
            $json_string =json_encode($param);
            $data['HTlistscan']=parent::post_json($json_string);
            $data['footer'] = $this->load->view('common/footer',null,true);
            $this->load->view('payment/scan_pay', $data);
        }
        else if($type=="Hotel") {
            $para = array(
                'Parameters' => array(
                    'BookingReferenceNo' => $bookingRefNo,
                    'CultureName'=>"zh-CN"
                ),
                'code' => 10100007,
                'foreEndType' => 4
            );
            $json_string = json_encode($para);
            $data['Hlistscan']=parent::post_json($json_string);
            $data['footer'] = $this->load->view('common/footer',null,true);
            $this->load->view('payment/scan_pay', $data);
        }
        else if($type=="FlightHotle"){
            $this->load->view('payment/scan_pay', $data);
        }
        else if($type=="FlightHotelTour"){
            $this->load->view('payment/scan_pay', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 支付页面-支付确认 action
     *
     */
    public function pay_confirm(){
        $bookingRefNo = $_GET['bookingRefNo'];
        $pgtid = isset($_GET['pgtid'])?$_GET['pgtid']:"";
        $type=$_GET["business"];


        //    1、酒店
        //    2、景点
        //    3、机票
        //    4、会员中心	-- 不会返回该值
        //    5、酒+景
        //    50 机+酒
        $codeList=array(
            "1"=>"10100010",
            "2"=>20100009,
            "3"=>30100009,
            "4"=>"",
            "5"=>40100005,
            "50"=>"",
        );
        $typeList=array(
            "1"=>"Hotel",
            "2"=>'Ticket',
            "3"=>"Flight",
            "4"=>"",
            "5"=>"HotelTicket",
            "50"=>"",
        );
        if($type=="1"){
            $refID=$_GET["rid"];
            $pid=$_GET["pid"];
            $opid=$_GET["opid"];
            $paymentType=isset($_GET["paymentType"])?$_GET["paymentType"]:"Hotel";
            $para = array(
                'Parameters' => array(
                    'refID' => $refID,
                    "pid" => $pid,
                    "opid" => $opid
                ),
                'code' => $codeList[$type],
                'foreEndType' => 4
            );

        }
        else {
            $para = array(
                'Parameters' => array(
                    'bookingRefNo' => $bookingRefNo,
                    "gtid" => $pgtid
                ),
                'code' => $codeList[$type],
                'foreEndType' => 4
            );
        }
        $json_string = json_encode($para);
        $resulet=parent::post_json($json_string);
        if($type=="1"){
            $bookingRefNo=$resulet->data->bookingReferenceNo;
        }
        $host='http://'.$_SERVER['HTTP_HOST'];
        if($resulet->success){
            redirect($host.'/payment/pay_success?bookingRefNo='.$bookingRefNo."&type=".$typeList[$type],"location");
        }else{
            redirect($host.'/payment/pay_fail?bookingRefNo='.$bookingRefNo."&type=".$typeList[$type],"location");
        }
    }
    // --------------------------------------------------------------------

    /**
     * 支付页面-支付成功 action
     *
     */
    public function pay_success()
    {
        $data['title']= '支付成功';
        $data['header'] = $this->load->view('common/header',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $this->load->view('payment/pay_success', $data);
    }

    // --------------------------------------------------------------------
    /**
     * 支付页面-支付失败 action
     *
     */
    public function pay_fail()
    {
        $data['title']= '支付失败';
        $data['header'] = $this->load->view('common/header',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $this->load->view('payment/pay_fail', $data);
    }
    // --------------------------------------------------------------------

    /**
     * 支付页面-异步支付方法 action
     *
     */
    public function asy_payment()
    {
        $codeList = array(
            "Hotel" => 10100006,
            "Flight" => 30100004,
            "Ticket" => 20100008,
            "HotelTicket" => 40100003);

        $code = $codeList[$_POST["type"]];
        $host = 'http://' . $_SERVER['HTTP_HOST'];
        $bookingRefNo = $_POST["bookingRefNo"];

        if ($_POST["type"] == "Hotel") {
          if($bookingRefNo=="") {
              $paraSession = $_SESSION["order_para"];
              $paraSession["parameters"]["cultureName"] = "zh-CN";
              $paraSession["parameters"]["partnerCode"] = "1000";
              $paraSession["parameters"]["availability"] = true;
              $paraSession["parameters"]["cardHolderName"] = $_POST["cardInfo"]["cardHolderName"];
              $paraSession["parameters"]["creditCardNumber"] = $_POST["cardInfo"]["cardNumber"];
              $paraSession["parameters"]["creditCardType"] = $_POST["cardInfo"]["cardType"];
              $paraSession["parameters"]["creditCardExpiryDate"] = $_POST["cardInfo"]["cardExpiryDate"];
              $paraSession["parameters"]["cardSecurityCode"] = $_POST["cardInfo"]["cardSecurityCode"];
              $paraSession["parameters"]["bankName"] = $_POST["cardInfo"]["bankName"];
              $paraSession["parameters"]["cardBillingAddress"] = $_POST["cardInfo"]["cardAddressCity"];
              $paraSession["parameters"]["cardIssuanceCountry"] = "CN";
              $paraSession["parameters"]["cashVoucherDetails"] = '';
              $paraSession["parameters"]["cardAddressCity"] = $_POST["cardInfo"]["cardAddressCity"];
              $paraSession["parameters"]["cardAddressPostalCode"] = $_POST["cardInfo"]["cardAddressPostalCode"];
              $paraSession["parameters"]["cardCountryCode"] = 'CN';
              $paraSession["parameters"]["countryNumber"] = '86';
              $paraSession["parameters"]["MobilePhone"] = $_POST["cardInfo"]["MobilePhone"];
              $paraSession["parameters"]["trck"] = "";
              $paraSession["parameters"]["cookieID"] = 1;
              $paraSession["parameters"]["sessionID"] = true;
              $paraSession["parameters"]["browserType"] = "";
              $paraSession["parameters"]["MemberId"] = isset($this->user_info) ? $this->user_info->memberID : "";
              $paraSession["parameters"]["deviceID"] = "test";
              $paraSession["parameters"]["ReturnURL"] = $host . "/payment/pay_confirm";
              $paraSession["parameters"]["browserType"] = "";
              $paraSession["parameters"]["iPAddress"] = "";
              $paraSession["parameters"]["Vouchers"] = "";
              $paraSession["parameters"]["guestRequest"] = "";
              $paraSession["parameters"]["totalPriceCNY"] = $paraSession["parameters"]["totalPrice"];

              $para = array(
                  'Parameters' => $paraSession["parameters"],

                  'code' => $code,
                  'foreEndType' => 4);
          }else{
              $paraSession = $_SESSION["order_para"];
              $paraSession["parameters"]["BookingReferenceNo"] = $bookingRefNo;
              $paraSession["parameters"]["availability"] = true;
              $paraSession["parameters"]["cardHolderName"] = $_POST["cardInfo"]["cardHolderName"];
              $paraSession["parameters"]["creditCardNumber"] = $_POST["cardInfo"]["cardNumber"];
              $paraSession["parameters"]["creditCardType"] = $_POST["cardInfo"]["cardType"];
              $paraSession["parameters"]["creditCardExpiryDate"] = $_POST["cardInfo"]["cardExpiryDate"];
              $paraSession["parameters"]["cardSecurityCode"] = $_POST["cardInfo"]["cardSecurityCode"];
              $paraSession["parameters"]["bankName"] = $_POST["cardInfo"]["bankName"];
              $paraSession["parameters"]["cardBillingAddress"] = $_POST["cardInfo"]["cardAddressCity"];
              $paraSession["parameters"]["cardIssuanceCountry"] = "CN";
              $paraSession["parameters"]["cashVoucherDetails"] = '';
              $paraSession["parameters"]["cardAddressCity"] = $_POST["cardInfo"]["cardAddressCity"];
              $paraSession["parameters"]["cardAddressPostalCode"] = $_POST["cardInfo"]["cardAddressPostalCode"];
              $paraSession["parameters"]["cardCountryCode"] = 'CN';
              $paraSession["parameters"]["countryNumber"] = '86';
              $paraSession["parameters"]["MobilePhone"] = $_POST["cardInfo"]["MobilePhone"];
              $paraSession["parameters"]["trck"] = "";
              $paraSession["parameters"]["cookieID"] = 1;
              $paraSession["parameters"]["sessionID"] = true;
              $paraSession["parameters"]["browserType"] = "";
              $paraSession["parameters"]["MemberId"] = isset($this->user_info) ? $this->user_info->memberID : "";
              $paraSession["parameters"]["deviceID"] = "test";
              $paraSession["parameters"]["ReturnURL"] = $host ."/payment/pay_confirm";
              $para = array(
                  'Parameters' => $paraSession["parameters"],
                  'code' => "10100008",
                  'foreEndType' => 4);
          }
        } else {;
            $para = array(
                'Parameters' => array(
                    'bookingRefNo' => $bookingRefNo,
                    "currencyCode" => "CNY",
                    "totalPrice" => $_POST["totalPrice"],
                    "paymentMode" => $_POST["paymentMode"],
                    'cardInfo' => array(
                        "cardType" => $_POST["cardInfo"]["cardType"],
                        "bankName" => $_POST["cardInfo"]["bankName"],
                        "countryNumber" => $_POST["cardInfo"]["countryNumber"],
                        "cardAddressCity" => $_POST["cardInfo"]["cardAddressCity"],
                        "cardHolderName" => $_POST["cardInfo"]["cardHolderName"],
                        "cardExpiryDate" => $_POST["cardInfo"]["cardExpiryDate"],
                        "cardNumber" => $_POST["cardInfo"]["cardNumber"],//"4544152000000004",
                        "MobilePhone" =>$_POST["cardInfo"]["MobilePhone"],
                        "cardType" => $_POST["cardInfo"]["cardType"],
                        "cardSecurityCode" =>$_POST["cardInfo"]["cardSecurityCode"],
                        "cardCountryCode" => $_POST["cardInfo"]["cardCountryCode"],
                        "cardAddressCountryCode" => $_POST["cardInfo"]["cardAddressCountryCode"],
                        'cardAddressPostalCode' => $_POST["cardInfo"]["cardAddressPostalCode"],
                        "cardAddress" => $_POST["cardInfo"]["cardAddress"],
                    ),
                    'ReturnURL' => $host . "/payment/pay_confirm"
                ),
                'code' => $code,
                'foreEndType' => 4
            );
        }
        $json_string = json_encode($para);
        $data = parent::post_json($json_string);
        if ($data->success == 1) {
            if(is_array($data->data)){
                $arr = array('success' => true, 'message' => $data->data[0]->paymentRedirectURL);
            }
            else {
                $arr = array('success' => true, 'message' => $data->data->paymentRedirectURL);
            }
        } else {
            $arr = array('success' => false, 'message' => $data->message);
        }
        echo json_encode($arr);
    }
}
