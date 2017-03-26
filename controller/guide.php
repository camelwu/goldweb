<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Flight extends HomeBase_Controller {

    // --------------------------------------------------------------------

    /**
     * 机票构造函数
     *
     */
    public function __construct(){
        parent::__construct();
        $this->load->library('session'); //session类引用
        $this->load->helper('country'); //自定义国家helper类引用
        $this->load->helper('time');    //自定义时间helper类引用
        $this->load->helper('common');    //自定义时间common类引用
    }

    // --------------------------------------------------------------------

    /**
     * 机票-首页 action
     *
     */
    public function index()
    {
        $data['title']= '机票首页';
        $data['top_menu_name']="flight";
        $data['header'] = $this->load->view('common/header_index',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        //banner图
        $para = array(
            'Parameters' => array(
                "BannerType" => 8,
            ),
            "ForeEndType" => 4,
            "Code" => "80100001"
        );
        $jsonstring = json_encode($para);
        $data['jsonresulte'] = parent::post_json($jsonstring);

        $data['banner_slide'] = $data['jsonresulte']->data;
        $data["bannerslide"] = $this->load->view('common/banner_slide', $data, true);
         //列表数组
        $array = array(
          'Parameters' => array(),
          'Code' => 30100019,
          'ForeEndType' =>4
        );
        $json_string = json_encode($array);
        $data['list']=parent::post_json($json_string);
        $this->load->view('flight/index', $data);
    }
//  国际机票
    public function international()
    {
        $data['title']= '机票首页';
        $data['top_menu_name']="flight";
        $data['header'] = $this->load->view('common/header_index',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        //banner图
        $banner = array(
          'Parameters'=> array(
            "BannerType" => 8
          ),
          "ForeEndType" => 4,
          "Code" => "80100001"
        );
        $json_string_banner = json_encode($banner);
        $data['banner']=parent::post_json($json_string_banner);
        //列表数组
        $array = array(
          'Parameters' => array(),
          'Code' => 30100019,
          'ForeEndType' =>4
        );
        $json_string = json_encode($array);
        $data['list']=parent::post_json($json_string);
        $this->load->view('flight/international', $data);
    }
    // --------------------------------------------------------------------

    /**
     * 机票-列表 action
     *
     */
    public function lists()
    {
        $data['title']= '机票列表页';
        $data['top_menu_name']="flight";
        $data['header'] = $this->load->view('common/header',null,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $para1 = null;
        $para = array(
            'parameters' => array(
                'routeType' => $_GET['routeType'],
                'cabinClass' => $_GET['cabinClass'],
                'departDate' => $_GET['departDate'],
                'numofAdult' => $_GET['numofAdult'],
                'numofChild' => $_GET['numofChild'],
                'cityCodeTo' => $_GET['cityCodeTo'],
                'cityCodeFrom' => $_GET['cityCodeFrom'],
                'sortFields'=>array(
                    'orderType'=>5,
                    'orderRuleValue' =>0
                ),
                'filterFields'=> array()
            ),
            'code' => 30100100,
            'foreEndType' =>4
        );
        $data['cityInfo'] = array(
            'cityNameFrom'=>$_GET['cityNameFrom'],
            'cityNameTo'=>$_GET['cityNameTo'],
            'routeType'=>$_GET['routeType'],
            'departDate'=>$_GET['departDate'],
        );
        if($_GET['routeType']=="return"){
            $para['parameters']['returnDate'] = $_GET['returnDate'];
            $data['cityInfo']['returnDate'] = $_GET['returnDate'];
        }
        $data['cityInfo']['directFlightNum'] = 0;
        $data['cityInfo']['trainsFlightNum'] = 0;
        /*保存首次请求参数*/
        $this->session->set_userdata("firstPoData", $para);
        $json_string = json_encode($para);
        $data['lists'] = parent::post_json($json_string);
        if($data['lists']->success){
            $this->session->set_userdata("currentFLightInfo", $data['lists']);
            $data['hasTax'] = "0";
            foreach($data['lists']->data->flightInfos as $value){
               if( $value->directFlight == 1){
                   $data['cityInfo']['trainsFlightNum']++;
               }elseif($value->directFlight == 0){
                   $data['cityInfo']['directFlightNum']++;
               }
            }
            $data['triptitle']=$this->load->view('flight/template/lists/triptitle',$data,true);
            $data['filterflight']=$this->load->view('flight/template/lists/filterflight',$data,true);
            $data['orderflight']=$this->load->view('flight/template/lists/orderflight',$data,true);

            $data['flightlist']=$this->load->view('flight/template/lists/flightlist',$data,true);
            $this->load->view('flight/lists', $data);
        }else{
            $this->load->view('flight/lists', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 机票-asy获取航班html action
     *
     */
    public function asy_get_flight()
    {
        header("Content-Type: text/json; charset=utf-8");
        if($_POST['postGreat'] == "A"){ /*全部更新*/
            $tempPara = array(
                'parameters' => array(
                    'routeType' => $_POST['routeType'],
                    'cabinClass' => $_POST['cabinClass'],
                    'departDate' => $_POST['departDate'],
                    'numofAdult' => (int)$_POST['numofAdult'],
                    'numofChild' => (int)$_POST['numofChild'],
                    'cityCodeTo' => $_POST['cityCodeTo'],
                    'cityCodeFrom' => $_POST['cityCodeFrom']
                ),
                'code' => 30100100,
                'foreEndType' =>4
            );
            $data['cityInfo'] = array(
                'cityNameFrom'=>$_POST['cityNameFrom'],
                'cityNameTo'=>$_POST['cityNameTo'],
                'routeType'=>$_POST['routeType'],
                'departDate'=>$_POST['departDate'],
            );
            if($_POST['routeType']=="return"){
                $tempPara['parameters']['returnDate'] = $_POST['returnDate'];
                $data['cityInfo']['returnDate'] = $_POST['returnDate'];
            }
            $this->session->set_userdata("firstPoData", $tempPara); /*更新A级请求参数*/
            $postPara = $tempPara;
        }else{ /*更新列表部分*/
            /*获得缓存A级参数*/
            $cachePara =$this->session->userdata('firstPoData');
            $cachePara['parameters']['sortFields'] = array_key_exists('sortFields',$_POST)?$_POST['sortFields']:array();
            $cachePara['parameters']['filterFields'] = array_key_exists('filterFields',$_POST)?$_POST['filterFields']:array();
            if(array_key_exists('departFlightNo',$_POST)){
                $cachePara['parameters']['departFlightNo'] = $_POST['departFlightNo'];
            }else if(array_key_exists('returnFlightNo',$_POST)){
                $cachePara['parameters']['returnFlightNo'] = $_POST['returnFlightNo'];
            }
            $postPara = $cachePara;
        }
        $json_string = json_encode($postPara);
        //echo $json_string;exit;
        $data['lists'] = $_POST['getCache']=="1"&&isset($_SESSION["currentFLightInfo"])?$_SESSION["currentFLightInfo"]:parent::post_json($json_string);
        $data['hasTax'] = $_POST['hasTax'];
        if($data['lists']->success){
            $this->session->set_userdata("currentFLightInfo", $data['lists']);
            if(array_key_exists('departFlightNo',$_POST)){
                $this->session->set_userdata("currentFlightNo", $_POST['departFlightNo']);
            }else if(array_key_exists('returnFlightNo',$_POST)){
                $this->session->set_userdata("currentFlightNo", $_POST['returnFlightNo']);
            }
            $arr = array( 'success' => true,
                'type' => 'B',
                'listHTML' => $this->load->view('flight/template/lists/flightlist',$data,true),
            );
            if($_POST['postGreat'] == "A"){
                $data['cityInfo']['directFlightNum'] = 0;
                foreach($data['lists']->data->flightInfos as $value){
                    if( $value->directFlight == 1){
                        $data['cityInfo']['directFlightNum']++;
                    }
                }
                $arr['type'] = 'A';
                $arr['filerHTML'] = $this->load->view('flight/template/lists/filterflight',$data,true);
                $arr['orderHTML'] = $this->load->view('flight/template/lists/orderflight',$data,true);
                $arr['triptitle'] = $this->load->view('flight/template/lists/triptitle',$data,true);
            }
        }else{
            $arr = array( 'success' => false,
                'type' => $_POST['postGreat'],
                'listHTML' => $this->load->view('flight/template/lists/flightlist',$data,true),
            );

        }
         echo json_encode($arr);
    }

    // --------------------------------------------------------------------
    /**
     * 机票-订单填写 action
     *
     */
    public function order()
    {
        $sFlight = $_SESSION["currentFLightInfo"]->data->flightInfos;
        $data['title']= '国外机票订单填写页面';
        $data['header'] = $this->load->view('common/header',$data,true);
        $data['chooseflight'] = $this->load->view('common/header',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $data['flightinfo']=$sFlight[$_GET['findex']];
        $data['numofChild'] =  $_GET['numofChild'];
        $data['numofAdult'] = $_GET['numofAdult'];
        foreach ( $sFlight[$_GET['findex']]->segmentsLeave  as &$value) {
            $value->cabinClassName =  $sFlight[$_GET['findex']]->flightGroupOtherInfoList[$_GET['cindex']]->cabinClassName;
        }
        if(property_exists($sFlight[$_GET['findex']],'segmentsReturn')){
            foreach ( $sFlight[$_GET['findex']]->segmentsReturn  as &$value) {
                $value->cabinClassName = $sFlight[$_GET['findex']]->flightGroupOtherInfoList[$_GET['cindex']]->cabinClassName;
        }
        }
        $curDetailFlight = $sFlight[$_GET['findex']]->flightGroupOtherInfoList[$_GET['cindex']];
        if(!(int)$_GET['numofChild']){
            $totalPrice = ((int)$_GET['numofAdult'])*((int)$curDetailFlight->totalFareAmountADT+(int)$curDetailFlight->totalTaxAmountADT);
        }else{
            $totalPrice = ((int)$_GET['numofAdult'])*((int)$curDetailFlight->totalFareAmountADT+(int)$curDetailFlight->totalTaxAmountADT)+((int)$_GET['numofChild'])*((int)$curDetailFlight->totalFareAmountCHD+(int)$curDetailFlight->totalTaxAmountCHD);
        }
        // 已登录用户的常旅数据获取
        if ($this->user_info != null) {
            $para = array(
                'parameters' => array(
                    'memberId' => $this->user_info->memberID
                ),
                'code' => 70100015,
                'foreEndType' =>4
            );
            $json_string = json_encode($para);
            $data['user_list'] = parent::post_json($json_string);
            $data["userlist_html"]=$this->load->view('flight/template/order/user_list', $data,true);
        } else {
            $data["userlist_html"] = '';
        }

        $data['countryData']=get_country();
        $data["flightinfo_html"]=$this->load->view('flight/template/order_confirm/order_flight', $data,true);
        $data["order_free"]=(object)array(
            "numofChild"=>$_GET['numofChild'],
            "numofAdult"=>$_GET['numofAdult'],
            "totalFlightPrice"=>$totalPrice,
            "flightInfo"=>(object)array(
                "totalFareAmountCHD"=>$curDetailFlight->totalFareAmountCHD,
                "totalFareAmountADT"=>$curDetailFlight->totalFareAmountADT,
                "totalTaxAmountCHD"=>$curDetailFlight->totalTaxAmountCHD,
                "totalTaxAmountADT"=>$curDetailFlight->totalTaxAmountADT,
                "totalFareAmountExc"=>$curDetailFlight->totalFareAmountExc
            )
        );
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
        $data["free_html"]=$this->load->view('flight/template/order_confirm/order_fee', $data,true);
        $data["country_ul"]=$this->load->view('flight/template/order/countrylist', $data,true);
        $data["personul"]=$this->load->view('flight/template/order/personul', $data,true);
        $this->load->view('flight/order', $data);
    }

    // --------------------------------------------------------------------

    /**
     * 机票-从session获取航班信息 action
     *
     */
    public function get_order_no(){
        header("Content-Type: text/json; charset=utf-8");
        $sFlight = $_SESSION["currentFLightInfo"]->data->flightInfos;
        $data['flightinfo']=$sFlight[$_POST['findex']];
        $data['curDetailFlight'] = $data['flightinfo']->flightGroupOtherInfoList[$_POST['cindex']];
        $cabinClass = 0; $totalPrice = 0;
        if($data['curDetailFlight']->cabinClass =="Economy"){
            $cabinClass = 0;
        }else if($data['curDetailFlight']->cabinClass =="EconomyPremium"){
            $cabinClass = 1;
        }else if($data['curDetailFlight']->cabinClass =="Business"){
            $cabinClass = 2;
        }else if($data['curDetailFlight']->cabinClass =="First"){
            $cabinClass = 3;
        }
        if(!(int)$_POST['wapOrder']['numofChild']){
            $totalPrice = ((int)$_POST['wapOrder']['numofAdult'])*((int)$data['curDetailFlight']->totalFareAmountADT+(int)$data['curDetailFlight']->totalTaxAmountADT);
        }else{
            $totalPrice = ((int)$_POST['wapOrder']['numofAdult'])*((int)$data['curDetailFlight']->totalFareAmountADT+(int)$data['curDetailFlight']->totalTaxAmountADT)+((int)$_POST['wapOrder']['numofChild'])*((int)$data['curDetailFlight']->totalFareAmountCHD+(int)$data['curDetailFlight']->totalTaxAmountCHD);
        }

        $para = array(
            'parameters' => array(
                'wapOrder' => array(
                    'setID' => $data['curDetailFlight']->setID,
                    'cacheID' => $data['curDetailFlight']->cacheID,
                    'cityCodeFrom' => $_POST['wapOrder']['cityCodeFrom'],
                    'cityCodeTo' => $_POST['wapOrder']['cityCodeTo'],
                    'numofAdult' => $_POST['wapOrder']['numofAdult'],
                    'numofChild' => $_POST['wapOrder']['numofChild'],
                    'routeType' => $_POST['wapOrder']['routeType'],
                    'cabinClass' => $cabinClass,
                    'memberId' =>isset($this->user_info)?$this->user_info->memberID:"",
                ),
                'travellerInfo' => $_POST['travellerInfo'],
                'contactDetail' =>$_POST['contactDetail'],
                'currencyCode' => $_POST['currencyCode'],
                'totalPrice' => $totalPrice,
                "track"=> array(
                    "deviceID"=>get_deviceId()
                )
            ),
             'code' => 30100002,
            'foreEndType' =>4
        );
        $json_string = json_encode($para);

        $data['result'] =parent::post_json($json_string);
        if($data['result']->success == 1){
             echo json_encode($data['result']);
        }else{
             echo json_encode($data['result']);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 机票-填单确认 action
     *
     */
    public function order_confirm()
    {
        $data['title']= '确认页面';
        $data['header'] = $this->load->view('common/header',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);
        $para1 = null;
        $bookingRefNo = $_GET["bookingRefNo"];
        $para = array(
            'Parameters' => array(
                'bookingRefNo'=>$bookingRefNo
            ),
            'code' => 30100006,
            'foreEndType' =>4
        );
        $json_string = json_encode($para);
        $data['lists']=parent::post_json($json_string);;
        $data["order_free"]=$data['lists']->data;
        $data['order_fee']=$this->load->view('flight/template/order_confirm/order_fee', $data,true);
        $data['flightinfo']=$data['lists']->data->flightInfo;
        $data['order_flight']=$this->load->view('flight/template/order_confirm/order_flight',$data,true);
        $data['orderbag']=$data['lists']->data->flightInfo;
        $data['order_bag']=$this->load->view('flight/template/order_confirm/order_bag',$data,true);
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
        $this->load->view('flight/order_confirm', $data);
    }
}