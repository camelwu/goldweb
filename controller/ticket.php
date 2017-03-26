<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 景点门票Controller类，继承于HomeBase_Controller基类
/**
 * Created by PhpStorm.
 * User: zhouwei
 * Date: 2016/8/29
 * Time: 16:40
 */
class Ticket extends HomeBase_Controller
{
  /**
   * 构造函数
   *
   */
  public function __construct(){
    parent::__construct();
    $this->load->helper('time');     //系统自带url helper类引用
    $this->load->helper('country'); //自定义国家helper类引用
    $this->load->library('session');//session类引用
    $this->load->library('mypage');
  }
  // --------------------------------------------------------------------

  /**
   * 景点频道-首页
   *
   */
  public function index()
  {
    $data["title"]="景点首页";
    $data['top_menu_name']="ticket";
    $data["header"]=$this->load->view('common/header_index',$data,true);
    $data["footer"]=$this->load->view('common/footer',null,true);
    $para = array(
        'Parameters'=> array(
            "BannerType" => 7,
        ),
        "ForeEndType" => 4,
        "Code" => "80100001"
    );
    $jsonstring= json_encode($para);
    $data['jsonresulte']=parent::post_json($jsonstring);
    $data['banner_slide']=$data['jsonresulte']->data;
    $data["bannerslide"]=$this->load->view('common/banner_slide',$data,true);
//    海外玩乐
    $para = array(
        'Parameters'=> array(),
        "ForeEndType" => 4,
        "Code" => "20100016"
    );
    $jsonstring= json_encode($para);
    $data['ticket_ploy'] = array();
    $data['jsonresulte']=parent::post_json($jsonstring);
    $data['hotTouer']=$data['jsonresulte']->data;

    $cityArray=array();

    foreach($data['hotTouer']->hotTours as $item){
      if(!in_array($item->cityName,$cityArray)){
        array_push($cityArray,$item->cityName);
      }
    }
    $data["cityArray"]=$cityArray;
    for ($i = 1; $i < 6; $i++) {
      $data['ticket_ploy'][$i] = $i;
    }
    $ticket_order=array(
      "type"=>"ticket"
    );
    $data['ticket_order'] = $ticket_order;
    $data["ticket_order"]=$this->load->view('ticket/template/ticket_order',$data,true);
//    海外热门城市
    $para = array(
        'Parameters'=> array(),
        "ForeEndType" => 4,
        "Code" => "20100017"
    );
    $jsonstring= json_encode($para);

    $data['jsonresulte']=parent::post_json($jsonstring);
    $data["hotcity"]=$data['jsonresulte']->data;

//    热门目的地和景点
    $para = array(
        'Parameters'=> array(),
        "ForeEndType" => 4,
        "Code" => "20100015"
    );
    $jsonstring= json_encode($para);
    $data['jsonresulte']=parent::post_json($jsonstring);
    $data["catgorycity"]=$data['jsonresulte']->data;
    $this->load->view('ticket/index',$data);
  }

  // --------------------------------------------------------------------

  /**
   * 景点-列表页
   *
   */
  public function lists()
  {
    $data['title'] =  '景点列表';
    $data['top_menu_name']="ticket";
    $data['header'] = $this->load->view('common/header',$data,true);
    $data["footer"]=$this->load->view('common/footer',null,true);
    $para = array(
        "parameters" => array(
            "destCityCode" =>$_GET['destCityCode'],
            "subProduct" => "all",
            "themeIDSpecified" => false,
            "priceSortType" => "",
            "pageIndex" => 1,
            "pageSize" => 10,
            "minPrice" => 0,
            "maxPrice" => 0
        ),
        "foreEndType" => 4,
        "code" => 20100002,
    );
    $json_string = json_encode($para);
    $data["results"] = parent::post_json($json_string);
//    var_dump($json_string);exit();
    if($data["results"]->success){
      $page_config['perpage']=5; //每页条数
      $page_config['total']= $data["results"]->data->totalCount;//总条数
      $page_config['nowindex']=1;
      $this->mypage->initialize($page_config);
      $data['pager_html'] = $this->mypage->show(1);
    }
    $data['lists'] = $this->load->view('ticket/template/tour_lists',$data,true);
    $data["themes"]=$this->load->view('ticket/template/theme_items',$data,true);
    $this->load->view('ticket/lists', $data);
  }


  /**
   * 景点-异步获得列表页
   *
   */
  public function asy_ticket_lists()
  {
    header("Content-Type: text/json; charset=utf-8");
    $data['title'] =  '景点列表';
    $data['top_menu_name']="ticket";
    $data['header'] = $this->load->view('common/header',$data,true);
    $data["footer"]=$this->load->view('common/footer',null,true);
    $para = array(
        "parameters" => array(
            "destCityCode" => $_POST['destCityCode'],
            "subProduct" => $_POST['subProduct'],
            "themeIDSpecified" => $_POST['themeIDSpecified'],
            "priceSortType" => $_POST['priceSortType'],
            "pageIndex" => $_POST['pageIndex'],
            "pageSize" => $_POST['pageSize'],
            "minPrice" => $_POST['minPrice'],
            "maxPrice" => $_POST['maxPrice']
        ),
        "foreEndType" => 4,
        "code" => 20100002,
    );
    if( array_key_exists('themeID',$_POST)){
      $para['parameters']['themeID'] = $_POST['themeID'];
    }
    if( array_key_exists('packageName',$_POST)){
      $para['parameters']['packageName'] = $_POST['packageName'];
    }
    $json_string = json_encode($para);
    $data["results"] = parent::post_json($json_string);
    if($data["results"]->success){
      /*主题html*/
      $data["themes"]=$this->load->view('ticket/template/theme_items',$data,true);
      /*页码html*/
      $page_config['perpage']=$_POST['pageSize'];  //每页条数
      $page_config['total']=$data["results"]->data->totalCount;  //总条数
      $page_config['nowindex']=$_POST['pageIndex'];
      $this->mypage->initialize($page_config);
      $data['pager_html'] = $this->mypage->show(1);
      $data['lists'] = $this->load->view('ticket/template/tour_lists',$data,true);
      /*列表内容html*/
      $result = array(
          "postClass" => $_POST["postClass"],
          "listsHtml" => $data['lists'],
          "totalCount" => $data["results"]->data->totalCount,
      );
      if($_POST["postClass"] == "A"){
        $result['themesHtml'] = $data["themes"];
      }
    }else{
      $data['lists'] = $this->load->view('ticket/template/tour_lists',$data,true);
      $result = array(
          "postClass" => $_POST["postClass"],
          "listsHtml" => $data['lists'],
          "totalCount" => 0,
      );
    }
     echo json_encode($result);
  }
  // --------------------------------------------------------------------
  /**
   * 景点-详情页面
   *
   */
  public function detail()
  {
    $data['title'] =  '景点详情';
    $data['top_menu_name']="ticket";
    $data['header'] = $this->load->view('common/header',$data,true);
    $data["footer"]=$this->load->view('common/footer',null,true);
    $param = array(
        "parameters" => array(
            "packageID" => $_GET['packageId']
        ),
        "foreEndType" => 4,
        "code" => "20100003"
    );
    $json_string =json_encode($param);
    $data['result'] =parent::post_json($json_string);
    $this->session->set_userdata("package",  $data['result']->data); /*存储package信息*/
//    var_dump($data['result']);exit();
    if( $data['result']->success){
      $data['package'] = $data['result']->data;
      $data['slide'] = $this->load->view('hotel_ticket/template/slide',$data,true);
    }
    $this->load->view('ticket/detail', $data);
  }

  /**
   * 景点-详情异步获取价格
   *
   */
  public function getPrice()
  {
    function getArrayPara($par, $defDate)
    {
      $result = array();
      for($i = 0; $i<count($par); $i++) {
        $tempObj = new stdClass();
        $tempObj->tourID = $par[$i]->tourID;
        $tempObj->travelDate = $defDate;
        array_push($result, $tempObj);
      }
      return $result;
    }
    $param = array(
        "parameters" => array(
            "packageID" => $_SESSION["package"]->packageID,
            "tours" => getArrayPara($_SESSION["package"]->tours, $_SESSION["package"]->defaultDepartStartDate),
        ),
        "foreEndType" => 4,
        "code" => "20100006"
    );
    if($this->user_info != null){
      $param['parameters']['memberID'] =$this->user_info->memberID;
    }
    if($_SESSION["package"]->minPaxType === 1){
      $param['parameters']['adult'] = $_SESSION["package"]->minPax-1;
      $param['parameters']['child'] = array($_SESSION["package"]->childAgeMin);
    }else{
      //默认获取最多成人，0小孩
      $param['parameters']['adult'] = $_SESSION["package"]->minPax === -1?1:$_SESSION["package"]->minPax;
    }
     $json_string =json_encode($param);
     $data['result'] =parent::post_json($json_string);

     if( $data['result']->success){
         $priceObj = new stdClass();
         $priceObj->totailPrice = $data['result']->data->totailPrice;
         $priceObj->prices = $data['result']->data->prices;
         $this->session->set_userdata("priceInfo", $priceObj);
       }
      $result = array(
          "success" => $data['result']->success,
          "msg" => $data['result']->message
      );
     header("Content-Type: text/json; charset=utf-8");
     echo json_encode($result);
  }
  // --------------------------------------------------------------------
  /**
   * 景点-订单填写页
   *
   */
  public function order()
  {
    $data['title'] = '订单填写页';
    $data['top_menu_name']="ticket";
    $data['header'] = $this->load->view('common/header_empty', $data, true);
    $data['footer'] = $this->load->view('common/footer', null, true);
    $data['countryData'] = get_country();
    $data['hourArray'] = array();
    $data["Packageid"]=$_SESSION["package"];

    for ($i = 0; $i < 24; $i++) {
      $data['hourArray'][$i] = $i;
    }
    $data['minuteArray'] = array();
    for ($i = 0; $i < 60; $i+=5) {
      $data['minuteArray'][$i] = $i;
    }
    $data['peopleArray'] = array();
    for ($i = 0; $i < 10; $i++) {
      $data['peopleArray'][$i] = $i;
    }
    //获取接送酒店信息
    $hparam = array(
        'Parameters' => array(
            "packageID"=>$_SESSION["package"]->packageID
        ),
        'code' => 20100004,
        'foreEndType' =>4
    );
    $json_string =json_encode($hparam);
    $result=parent::post_json($json_string);
    $data["hotelArray"]=$result->data;


    //获取费用明细
    $data["TourID"]=$data["Packageid"]->tours[0]->tourID;
    $data["trvekDate"]=$data["Packageid"]->defaultDepartStartDate;

    //获取初始化价格
    $data["cost"]=$_SESSION["priceInfo"];
//    echo json_encode($data["cost"]);exit();

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
    $data["personul"]=$this->load->view('ticket/template/personul', $data,true);
    $this->load->view('ticket/order', $data);
  }
  // --------------------------------------------------------------------

  /**
   * 景点-订单填写页交互
   *
   */
  //order提交订单
  public function get_code(){
    //参数验证
    if(!isset($_POST["personinfo"]["firstName"]) || !isset($_POST["lastName"])||!isset($_POST["email"])||!isset($_POST["phone"])){
      $arr = array('success' => false,'message' =>"取票人信息不能为空！");
//      echo json_encode($arr);
    }else {
      $firstName = $_POST["personinfo"]["firstName"];
      $lastName = $_POST["personinfo"]["firstName"];
      $email = $_POST["personinfo"]["email"];
      $phone = $_POST["phone"];
    }
    $param = array(
        'Parameters' => array(
            "PackageID"=>$_SESSION["package"]->packageID,
            "Adult"=>$_POST["cost"]["adultnum"],
            "Child"=>isset($_POST["cost"]["childage"])?$_POST["cost"]["childage"]:"[]",//array(4),
            "Tours" =>$_POST["tour"],
            "Travelers" => array( // 游客信息 true
                array(
                    "TravelerType" => "Adult",
                    "Salutation" => "Mr",
                    "FirstName" => $_POST["personinfo"]["firstName"],
                    "LastName" => $_POST["personinfo"]["lastName"],
                    "NationalityCode" =>"CN",//_POST["reserve"]["nationalityCode"]
                )
            ),
            "pickupPoint"=>isset($_POST["pickupPoint"]["pickupID"])?array(
                "pickupID"=>$_POST["pickupPoint"]["pickupID"],
                "pickupPoint"=>$_POST["pickupPoint"]["pickupPoint"],
            ):"",
            "ContactDetails"=>array(
              "Salutation" => "Mr",
              "FirstName"=>$_POST["personinfo"]["firstName"],
              "LastName"=>$_POST["personinfo"]["lastName"],
              "Email"=>$_POST["personinfo"]["email"],
              "MemberID"=>isset($this->user_info->memberID)?$this->user_info->memberID:"",
              "ContactNo"=>array(
                  "CountryCode"=>"86",
                  "PhoneNo"=>$_POST["personinfo"]["phone"]
                )
            ),
            "track"=>array(
                  "deviceID"=>"604239e6-1592-44ac-8569-08c9b48f14cb",
                  "browserType"=>""
            ),
            "ChargeDetails"=>array(
              "CurrencyCode" => "CNY",
              "TotalPrice"=>$_POST["cost"]["totalprice"]
            )
        ),
        "Code" => "20100007",
        "ForeEndType" =>3
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
//    var_dump($json_string);exit();
    if($result->success){
      $arr = array('success' => true,'message' =>$result);
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);
}
  /**
   *保存为常用旅客信息异步调用
   *
   */
  public function get_code_passenger()
  {
    header("Content-Type: text/json; charset=utf-8");
    $param = array(
        'parameters' => array(
            'traveller' => array(
              array(
                  "FirstName"=>$_POST["passergeadd"]["firstName"],
                  "LastName"=>$_POST["passergeadd"]["lastName"],
                  "Email"=>$_POST["passergeadd"]["email"],
                  "MobilePhone"=>$_POST["passergeadd"]["phone"],
                  "CountryCode"=>$_POST["passergeadd"]["countrycode"],
                  "CountryName"=>$_POST["passergeadd"]["countryname"],
                  "SexCode"=>$_POST["passergeadd"]["sexcode"],
                  "SexName"=>$_POST["passergeadd"]["sexname"],
              )
            ),
            'listTravellerIdInfo' =>
            array(
              array(

              )
            )
        ),
        'code' => 70100012,
        'foreEndType' => 4
    );
    $json_string = json_encode($param);
    $result = parent::post_json($json_string);
//    echo json_encode($result);exit();
    if($result->success){
      $arr = array('success' => true,'message' =>$result->data);
    }
    else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);
  }

//获取价格接口
  public function get_travel_code()
  {
    $param = array(
        'Parameters' => array(
          "PackageID"=>(string)$_SESSION["package"]->packageID,
            "Child"=>isset($_POST["travelChildage"])?$_POST["travelChildage"]:"",
            "Adult"=>(int)$_POST["travelAdilt"],
            "Tours"=>$_POST["tours"]
        ),
        'code' => "20100006",
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $arr = array('success' => true,'message' =>$result->data);
    }
    else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);
  }
}
