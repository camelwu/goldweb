<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 用户中心Controller类，继承于UserCenter_Controller基类
 */
class User extends UserCenter_Controller
{
  // --------------------------------------------------------------------

  var $imageNo="";
  /**
   * 构造函数
   *
   */
  public function __construct(){
    parent::__construct();
    $this->load->library('uploader');
    $this->load->library('gd');
    $this->load->helper('time');     //系统自带url helper类引用
    $this->load->library('session');//session类引用

  }

  // --------------------------------------------------------------------
  /**
   * 用户中心首页Index
   *
   */
  public function index()
  {
    $data['title']= '用户中心-首页';
    $data['left_menu_name']="index";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $memberID = $this->user_info->memberID;
    /*获取会员详情*/
    $param0 = array(
        'parameters' => array(
            'memberId' =>$memberID,
        ),
        'code' => 70100004,
        'foreEndType' =>4
    );
    $json_string =json_encode($param0);
    $memberData=parent::post_json($json_string);
    $data['memberData'] = $memberData->data;
    /*获取订单列表*/
    $param1 = array(
        'parameters' => array(
            'memberId' =>$memberID,
        ),
        'code' => 70100017,
        'foreEndType' =>4
    );
    $errorDIY = array(
        'maxSize' => 2,//控制显示条数
        'errorMsgOrder' => '没有找到符合条件的订单!', //自定义订单提示信息
        'errorMsgTraveller' => '您还没有添加任何常旅客信息!', //自定义提示常旅信息
        'is_show_op' => false  //是否显示常旅类表操作项
    );
    $data['errorDIY'] = $errorDIY;
    $json_string =json_encode($param1);
    $resultOrder=parent::post_json($json_string);
    $data['orderData'] = $resultOrder;
    $data['order_list']=$this->load->view('user/template/order_list',$data,true);
    /*获取常旅信息*/
    $param2 = array(
        'parameters' => array(
            'memberId' =>$memberID,
        ),
        'code' => 70100015,
        'foreEndType' =>4
    );
    $json_string2 =json_encode($param2);
    $resultTraveller=parent::post_json($json_string2);
    $data['travellerData'] = $resultTraveller;
    $data['o_travellers_list']=$this->load->view('user/template/travellers_list',$data,true);
    $this->load->view('user/index', $data);
  }
  // --------------------------------------------------------------------
  /**
   * 我的信息
   *
   */
  public function info()
  {
    $pager_cache=array('is_cache'=>true,'pager_name'=>"user_info");
    $data['title']= '用户中心-我的信息';
    $data['left_menu_name']="info";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $memberID = $this->user_info->memberID;
    /*获取会员详情*/
    $param0 = array(
        'parameters' => array(
            'memberId' =>$memberID,
        ),
        'code' => 70100004,
        'foreEndType' =>4
    );
    $json_string =json_encode($param0);
    $memberData=parent::post_json($json_string);
    $this->session->set_userdata("cacheMemberData", $memberData);
    $data['memberData'] = $memberData->data;
//    echo json_encode($memberData->data);exit();
    $this->load->view('user/info', $data);
  }
  // --------------------------------------------------------------------
  /**
   * 提交修改我的信息
   *
   */
  public function asy_change_info()
  {
    header("Content-Type: text/json; charset=utf-8");
    /*获得缓存参数*/
    $cachePara =$this->session->userdata('cacheMemberData');
    //echo json_encode($cachePara);exit;
    /*修改资料参数*/
    $para1 = array(
       'parameters'=>array(
            'cultureName' =>$cachePara->data[0]->cultureName,
            'memberId' =>$cachePara->data[0]->memberId,
            'email' =>$cachePara->data[0]->emailAddress,
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'DOB' => $_POST['DOB'],
            'address' =>$cachePara->data[0]->address,
            'city' =>$cachePara->data[0]->city,
            'state' =>$cachePara->data[0]->state,
            'postcode' =>$cachePara->data[0]->zipCode,
            'country' =>$cachePara->data[0]->country,
            'nationality' =>$cachePara->data[0]->nationality,
            'mobile' => $_POST['mobile'],
            'phone' =>$cachePara->data[0]->phoneNo,
            'salutation' =>isset($_POST['salutation'])?$_POST['salutation']:"",
            'activatedDate' =>isset($cachePara->data[0]->activatedDate)?$cachePara->data[0]->activatedDate:"",
       ),
        'foreEndType'=>4,
        'code'=>70100009,
    );
    $json_string = json_encode($para1);
    $data['resultInfo'] = parent::post_json($json_string);
    /*修改昵称*/
    $para2 = array(
        'parameters'=>array(
            'memberId' =>$cachePara->data[0]->memberId,
            'nickName' =>$_POST['nickName'],
        ),
        'foreEndType'=>4,
        'code'=>70100011,
    );
    $json_string2 = json_encode($para2);
    $data['resultNickName'] = parent::post_json($json_string2);
    /*返回结果*/
    $result = array(
       'success'=> true,
        'message'=>''
    );
    if($data['resultInfo']->success&&$data['resultNickName']->success){
           echo json_encode($result);
    }else if(!$data['resultInfo']->success&&$data['resultNickName']->success){
           echo json_encode($data['resultInfo']);
    }else if($data['resultInfo']->success&&!$data['resultNickName']->success){
           echo json_encode($data['resultNickName']);
    }
  }

  /*更换头像*/
  public function change_head()
  {
    $data['title']= '用户中心-更换头像';

    /*获取会员详情*/
    $param0 = array(
        'parameters' => array(
            'memberId' =>$this->user_info->memberID,
        ),
        'code' => 70100004,
        'foreEndType' =>4
    );
    $json_string =json_encode($param0);
    $memberData=parent::post_json($json_string);
    $data['memberData'] = $memberData->data;

    $data['left_menu_name']="info";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    /*view part*/
    $data["uploader"]=$this->load->view('user/template/uploader', $data,true);
    $this->load->view('user/change_head', $data);
  }

  // --------------------------------------------------------------------
  /**
   * 登录 Action
   */
  public function login()
  {
    $data['title']= '用户中心-登录';
    $data['header'] = $this->load->view('common/header_empty',$data,true);
    $data['footer'] = $this->load->view('common/footer_login',null,true);

    $param = array(
        'Parameters' => array(
        ),
        'code' => 70100022,
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $_SESSION["imageNo"]=$result->data->imageNo;
      $data["code_image_url"]=$result->data->imageUrl;
    }
    $this->load->view('user/login', $data);
  }

  // --------------------------------------------------------------------
  /**
   * 注册 Action
   */
  public function register()
  {
    $data['title']= '用户中心-注册';
    $data['header'] = $this->load->view('common/header_empty',$data,true);
    $data['footer'] = $this->load->view('common/footer_login',null,true);

    $param = array(
        'Parameters' => array(
        ),
        'code' => 70100022,
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $_SESSION["imageNo"]=$result->data->imageNo;
      $data["code_image_url"]=$result->data->imageUrl;
    }
    $this->load->view('user/register', $data);//直接显示视图
  }

  // --------------------------------------------------------------------
  /**
   * 注册按钮异步
   */
  public function asy_submit_register()
  {
    //var_dump($_POST["smcode"]);exit;
    //参数验证
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
      $arr = array('success' => false,'message' =>"用户名和密码不能为空！");
      echo json_encode($arr);
    }else {
      $username = $_POST["username"];//手机号 -->用户名
      $password = $_POST["password"];
      $smcode = $_POST["smcode"];//短信码
      $noland = $_POST["noland"];
    }

    $param = array(
        'Parameters' => array(
            "CultureName"=>"",
            "Email"=>"",
            "Password"=>$password,
            "Mobile"=>$username,
            "Code"=>$smcode
        ),
        'code' => 70100003,
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    //判断返回结果 必须写  ajax异步需要返回前端结果
    if($result->success){
      //这是给异步定义的成功
      if($noland == "true"){
        $this->session->set_tempdata('user_info', $result->data, 2592000);
      }
      $arr = array('success' => true,'message' =>$result->memberId);
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);//返回数据  json_encode转化成json
  }

  // --------------------------------------------------------------------
  /**
   * 获取验图形证码
   */
  public function asy_get_code()
  {
    $param = array(
        'Parameters' => array(
        ),
        'code' => 70100022,
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $_SESSION["imageNo"]=$result->data->imageNo;
      $arr = array('success' => true,'message' =>$result->data->imageUrl);
    }
    else{
      $arr = array('success' => false,'message' =>"用户名或密码有错误！");
    }
    echo json_encode($arr);
  }

  // --------------------------------------------------------------------
  /**
   * 手机号查询订单
   */
  public function asy_code_phone_list()
  {
    if (!isset($_POST["MobilePhone"]) || !isset($_POST["SmsCode"])) {
      $arr = array('success' => false, 'message' => "手机号和验证码不能为空！");
      echo json_encode($arr);exit;
    } else {
      $MobilePhone = $_POST["MobilePhone"];
      $code = $_POST["SmsCode"];
      $para = array(
          'Parameters' => array(
              'MobilePhone' => $MobilePhone,
              'Code' => $code,
              'PageSize' => '20',
              'PageIndex' => '1'
          ),
          'ForeEndType' => "3",
          'Code' => "70100023"
      );
      $result = parent::post_json($para);
      $datalist_html=$this->load->view('user/template/order_list',$result,true);
      //判断返回结果 必须写
      if($result->success){
        //这是给异步定义的成功
        $arr = array('success' => true,'message' =>$datalist_html);
      }
      else{
        $arr = array('success' => false,'message' =>$result->message);
      }
      //返回数据  json_encode转化成json
      echo json_encode($arr);
    }
  }
  public function asy_code_no_phone_list()
  {
    if (!isset($_POST["MobilePhone"]) || !isset($_POST["SmsCode"])) {
      $arr = array('success' => false, 'message' => "手机号和验证码不能为空！");
       echo json_encode($arr);
    } else {
      $MobilePhone = $_POST["MobilePhone"];
      $code = $_POST["SmsCode"];

      $para = array(
          'Parameters' => array(
              'MobilePhone' => $MobilePhone,
              'Code' => $code,
              'PageSize' => '20',
              'PageIndex' => '1'
          ),
          'ForeEndType' => "3",
          'Code' => "70100023"
      );
      $json_string =json_encode($para);
//      echo $json_string;exit;
      $result=parent::post_json($json_string);//请求
//      var_dump($result);
      //判断返回结果 必须写
      $errorDIY = array(
          'maxSize' =>100,//控制显示条数
          'errorMsgOrder' => '没有找到符合条件的订单!', //自定义订单提示信息
          'errorMsgTraveller' => '您还没有添加任何常旅客信息!', //自定义提示常旅信息
          'is_show_op' => false  //是否显示常旅类表操作项
      );
      $data['errorDIY'] = $errorDIY;
      if($result->success){
        //这是给异步定义的成功
        $data["orderData"]=$result;
        $html=$this->load->view('user/template/search_order_nologin_list', $data,true);
        $arr = array('success' => true,'message' =>$html);

      }
      else{
        $arr = array('success' => false,'message' =>$result->message);
      }
      //返回数据  json_encode转化成json
      echo json_encode($arr);
    }
  }
  // --------------------------------------------------------------------
  /**
   * 获取短信码
   */
  public function asy_get_sms()
  {
    //参数验证
    if(!isset($_POST["mobile"]) || !isset($_POST["inputcode"])){
      $arr = array('success' => false,'message' =>"手机号和图片验证码不能为空！");
      echo json_encode($arr);exit;
    }else {
      $mobile = $_POST["mobile"];
      $inputcode = $_POST["inputcode"];
      $type = isset($_POST["type"])?$_POST["type"]:1;

      $param = array(
          'Parameters' => array(
              "cultureName"=>"",
              "mobile"=>$mobile,
              "verificationCodeType"=>$type,
              "imageNo"=>$_SESSION["imageNo"],
              "inputCode"=>$inputcode
          ),
          'code' => 70100002,
          'foreEndType' =>4
      );
      //php 数组转化成json串 格式转化
      $json_string =json_encode($param);
      $result=parent::post_json($json_string);//请求
      //判断返回结果 必须写
      if($result->success){
        //这是给异步定义的成功
        $arr = array('success' => true,'message' =>"");
      }
      else{
        $arr = array('success' => false,'message' =>$result->message);
      }
      //返回数据  json_encode转化成json
      echo json_encode($arr);
    }
  }
  // --------------------------------------------------------------------
  /**
   * 手机号验证
   */
  public function asy_submit_phone_modify()
  {
    //参数验证
    if(!isset($_POST["Mobile"]) || !isset($_POST["Code_phone"])){
      $arr = array('success' => false,'message' =>"手机号和动态码不能为空！");
      echo json_encode($arr);
    }else {
      $Mobile = $_POST["Mobile"];
      $Code_p = $_POST["Code_phone"];//短信码
    }
//    var_dump($this->user_info->memberID);exit;
    $param = array(
        'Parameters' => array(
            "MemberID"=>$this->user_info->memberID,
            "Mobile"=>$Mobile,
            "Code"=>$Code_p
        ),
        'code' => 70100010,
        'foreEndType' =>4
    );
    $json_str =json_encode($param);
    $result=parent::post_json($json_str);
    //判断返回结果 必须写  ajax异步需要返回前端结果
    if($result->success){
      //这是给异步定义的成功
      $arr = array('success' => true,'message' =>"");
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);//返回数据  json_encode转化成json
  }

  // --------------------------------------------------------------------
  /**
   * 异步 asy 普通登录提交事件
   */
  public function asy_submit_login()
  {
    //参数验证
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
      $arr = array('success' => false,'message' =>"用户名和密码不能为空！");
      echo json_encode($arr);exit;
    }else{
      $username= $_POST["username"];
      $password= $_POST["password"];
      $noland = $_POST["noland"];
//      var_dump($noland);exit;
      //密码输入错误超过3次
      if(isset($_SESSION["error_count"]) && $_SESSION["error_count"] >3){
        if(!isset($_POST["imgCode"])){
          $arr = array('success' => false,'message' =>"请输入验证码");
          echo json_encode($arr);exit;
        } else{
          $param = array(
            'Parameters' => array(
              'Mobile'=>$username,
              'Password'=>$password,
              'ImageNo'=>$_SESSION["imageNo"],
              'InputCode'=>$_POST["imgCode"],
            ),
            'code' => 70100001,
            'foreEndType' =>4
          );
        }
      }else{
        $param = array(
          'Parameters' => array(
            'Mobile'=>$username,
            'Password'=>$password
          ),
          'code' => 70100001,
          'foreEndType' =>4
        );
      }
      $json_string =json_encode($param);
      $result=parent::post_json($json_string);
//      var_dump($result);exit();
      if($result->success){
        $_SESSION["error_count"]=0;
        if($noland == "true"){
          $this->session->set_tempdata('user_info', $result->data, 2592000);
        }
        $arr = array('success' => true,'message' =>$username,'error_count'=>1);
      }else{
//        $arr = array('success' => false,'message' =>$result->message);
        if($result->message != "获取信息出错"){
          $count=$this->get_login_error_count();
        }
        $arr = array('success' => false,'message' =>$result->message,'error_count'=>$count);
      }
      echo json_encode($arr);


    }

  }
  //普通登录密码输入错误的次数，超过三次出现图形验证码
  public function get_login_error_count(){
    if(!isset($_SESSION["error_count"])){
      $_SESSION["error_count"]=1;
    }else{
      $_SESSION["error_count"]+=1;
    }
    return  $_SESSION["error_count"];
  }
  // --------------------------------------------------------------------

  /**
   * 异步 asy 短信码动态登录
   */
  public function asy_submit_sms_login()
  {
    //参数验证
    if(!isset($_POST["username"]) || !isset($_POST["smcode"])){
      $arr = array('success' => false,'message' =>"用户名和密码不能为空！");
      echo json_encode($arr);
    }else{
      $username= $_POST["username"];
      $smcode= $_POST["smcode"];
      $noland = $_POST["noland"];
      //TODO 根据用户名和密码，查询用户信息
      $param = array(
          'Parameters' => array(
              'Mobile'=>$username,
              'VerificationCode'=>$smcode
          ),
          'code' => 70100020,
          'foreEndType' =>4
      );
      $json_string =json_encode($param);
      $result=parent::post_json($json_string);
      if($result->success){

        $customer_session_config = array(
            'sess_cookie_name' => 'customer_session_config',
            'sess_expiration' => 86400*30 // 保存 1 分钟
        );
        $this->load->library('session', $customer_session_config, 'customer_session');
        if($noland == "true"){
          $this->session->set_tempdata('user_info', $result->data, 86400*30);
        }
        $arr = array('success' => true,'message' =>$username);
      }
      else{
        $arr = array('success' => false,'message' =>$result->message);
      }
      echo json_encode($arr);
    }

  }

  // --------------------------------------------------------------------
  /**
   * 异步 asy退出登录
   */
  public function asy_quit_login()
  {
    $this->session->unset_userdata('user_info');
    $host='http://'.$_SERVER['HTTP_HOST'];
    redirect($host.'/user/login');
  }

  // --------------------------------------------------------------------
  /**
   * 安全中心
   */
  public function security()
  {
    $data['title']= '用户中心-安全中心';
    $data['left_menu_name']="security";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    /*view part*/
    $param = array(
      "Parameters"=>array(
        "Password"=>$this->user_info->password,
      ),
      "ForeEndType"=>3,
        "Code"=>70100024
    );
    $json_str =json_encode($param);
    $result=parent::post_json($json_str);
    $data['data'] = $result;
//    var_dump( $data['data']);exit;
    $data['order_list']=$this->load->view('user/template/order_list',$data,true);
    $this->load->view('user/security', $data);
  }

  // --------------------------------------------------------------------
  /**
   * 常旅查询
   */
  public function passenger()
  {
    $data['title']= '用户中心-安全中心';
    $data['left_menu_name']="passenger";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $errorDIY = array(
        'errorMsgTraveller' => '您还没有添加任何常旅客信息!', //自定义提示常旅信息
        'is_show_op' => true  //是否显示常旅类表操作项
    );
    $data['errorDIY'] = $errorDIY;
    if (isset($this->user_info)) {
      $param2 = array(
          'parameters' => array(
              'memberId' =>$this->user_info->memberID,
          ),
          'code' => 70100015,
          'foreEndType' =>4
      );
      $json_string2 =json_encode($param2);
      $resultTraveller=parent::post_json($json_string2);
    }else{
      $resultTraveller = new stdClass();
      $resultTraveller->success = false;
      $resultTraveller->message = '登录失效，请重新登录!';
    }
    /*travellerData*/
    /*获取常旅信息*/
    $data['travellerData'] = $resultTraveller;
    $data['o_travellers_list']=$this->load->view('user/template/travellers_list',$data,true);
    $this->load->view('user/passenger', $data);
  }

  // --------------------------------------------------------------------
  /**
   * 常旅添加初始化
   */
  public function passenger_add()
  {
    $data['title']= isset($_GET['travellerId'])?'用户中心-添加常旅客':'用户中心-修改常旅客';
    $paramNation = array(
        'parameters' => array(
            'lastUpdateTime' =>'2010-01-01'
        ),
        'code' => 70100008,
        'foreEndType' =>4
    );
    $resultNation = parent::post_json(json_encode($paramNation));
    $data['nationData'] = $resultNation;
    if(isset($_GET['travellerId'])){
      if (isset($this->user_info)){
        $param = array(
            'parameters' => array(
                'memberId' =>$this->user_info->memberID,
            ),
            'code' => 70100015,
            'foreEndType' =>4
        );
        $json_string =json_encode($param);
        $resultTraveller=parent::post_json($json_string);
        foreach($resultTraveller->data as $key=>$value){
                  if($value->traveller->travellerId == $_GET['travellerId']){
                      $curTraveller = $value;
                      $data['curTraveller'] = $curTraveller;
                      break;
                  }
        }
      }else{
        $resultTraveller = new stdClass();
        $resultTraveller->success = false;
        $resultTraveller->message = '登录失效，请重新登录!';
      }
    }
    $data['left_menu_name']="passenger";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);

    $this->load->view('user/passenger_add', $data);
  }

  // --------------------------------------------------------------------
  /**
   * 常旅添加异步
   */
  public function asy_passenger_add()
  {
    header("Content-Type: text/json; charset=utf-8");
    $param = array(
        'parameters' => array(
            'traveller' => $_POST['traveller'],
            'listTravellerIdInfo' => $_POST['listTravellerIdInfo']
        ),
        'code' => 70100012,
        'foreEndType' => 4
    );
    if (isset($this->user_info)){
      $param['parameters']['traveller']['memberId'] = $this->user_info->memberID;
      $json_string = json_encode($param);
      $result = parent::post_json($json_string);
         echo json_encode($result);
    }else{
       $result = array(
         'success' => false,
         'message' => '登录失效，请重新登录!',
       );
        echo json_encode($result);
    }
  }

  // --------------------------------------------------------------------
  /**
   * 常旅修改异步
   */
  public function asy_passenger_edit()
  {
    header("Content-Type: text/json; charset=utf-8");
    $param = array(
        'parameters' => array(
            'traveller' => $_POST['traveller'],
            'listTravellerIdInfo' => $_POST['listTravellerIdInfo']
        ),
        'code' => 70100013,
        'foreEndType' => 4
    );
    $param['parameters']['traveller']['memberId'] = $this->user_info->memberID;
    $json_string = json_encode($param);
    $result = parent::post_json($json_string);
    echo json_encode($result);
  }



  /**
   * 删除常旅
   */
  public function asy_passenger_delete()
  {
    header("Content-Type: text/json; charset=utf-8");
    $host='http://'.$_SERVER['HTTP_HOST'];
    $param = array(
        'parameters' => array(
            'travellerId' => $_POST['travellerId']
        ),
        'code' => 70100014,
        'foreEndType' => 4
    );
      $json_string = json_encode($param);
      $result = parent::post_json($json_string);
      if($result->success){
        $arr = array('success' => true,'message' =>"");
      }else{
        $arr = array('success' => true,'message' =>$result->message);
      }
       echo json_encode($arr);
  }

  // --------------------------------------------------------------------
  /**
   * 修改密码数据展示
   */
  public function modify_password()
  {
    $data['title']= '用户中心-修改密码';
    $data['left_menu_name']="security";
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $this->load->view('user/modify_password', $data);
  }
  // --------------------------------------------------------------------
  /**
   * 异步   修改密码
   */
  public function asy_modify_password()
  {
    $memberID = $this->user_info->memberID;
//    var_dump($memberID);exit;
    $password= $_POST["password"];
    $new_password = $_POST["new_p"];
    $param = array(
      'Parameters' => array(
        "MemberID"=>$memberID,
        "Password"=>$password,
        "NewPassword"=>$new_password
      ),
      'code' => 70100007,
      'foreEndType' =>4
    );

    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $this->session->set_userdata("user_info",$result->data);
      $arr = array('success' => true,'message' =>$new_password);
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);

  }
  // --------------------------------------------------------------------
  /**
   * success
   */
  public function success()
  {
    $data['title']= '用户中心-修改成功';
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);

    $this->load->view('user/template/success', $data);

  }
  // --------------------------------------------------------------------
  /**
   * 找回密码
   */
  public function modify_phone()
  {
    $data['title']= '用户中心-修改绑定手机号';
    $data['left_menu_name']="security";
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    //图片异步请求
    $param = array(
        'Parameters' => array(
        ),
        'code' => 70100022,
        'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $code=$result->data->imageNo;
      $_SESSION["imageNo"]=$result->data->imageNo;
      $data["code_image_url"]=$result->data->imageUrl;}
    $this->load->view('user/modify_phone', $data);

  }


    // --------------------------------------------------------------------
    /**
     * 手机验证修改密码
     */
    public function modify_password_by_phone()
    {
        $data['title']= '用户中心-修改密码';
        $data['user_info'] = $this->user_info;
        $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
        $data['header'] = $this->load->view('common/header_hide',$data,true);
        $data['footer'] = $this->load->view('common/footer',null,true);

        //获取图形验证码显示
        $param = array(
            'Parameters' => array(
            ),
            'code' => 70100022,
            'foreEndType' =>4
        );
        $json_string =json_encode($param);
        $result=parent::post_json($json_string);
        if($result->success){
            $_SESSION["imageNo"]=$result->data->imageNo;
            $data["code_image_url"]=$result->data->imageUrl;
        }
        $this->load->view('user/modify_password_by_phone', $data);//直接显示视图

    }

  // --------------------------------------------------------------------
  /**
   * 忘记密码
   */
  public function find_password()
  {
    $data['title']= '用户中心-找回密码';
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);

    //获取图形验证码显示
    $param = array(
      'Parameters' => array(
      ),
      'code' => 70100022,
      'foreEndType' =>4
    );
    $json_string =json_encode($param);
    $result=parent::post_json($json_string);
    if($result->success){
      $_SESSION["imageNo"]=$result->data->imageNo;
      $data["code_image_url"]=$result->data->imageUrl;
    }
    $this->load->view('user/find_password', $data);//直接显示视图

  }
  //异步  提交忘记密码
  public function submit_forget_password(){
    if(!isset($_POST["username"])||!isset($_POST["password"])){
      $arr = array('success' => false,'message' =>"手机号和动态码不能为空！");
      echo json_encode($arr);
    }else{
      $username = $_POST["username"];//手机号 -->用户名
      $password = $_POST["password"];
      $smcode = $_POST["smcode"];//短信码
    }
    $param = array(
        'Parameters' => array(
          "CultureName"=>"",
          "Email"=>"",
          "Mobile"=>$username,
          "NewPassword"=>$password,
          "Code"=>$smcode
        ),
        'code' => 70100006,
        'foreEndType' =>4
    );
    $json_str =json_encode($param);
    $result=parent::post_json($json_str);
    //判断返回结果 必须写  ajax异步需要返回前端结果
    if($result->success){
      //这是给异步定义的成功
      $arr = array('success' => true,'message' =>"");
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);//返回数据  json_encode转化成json

  }
  public function reset_password()
  {
    $data['title']= '用户中心-重置密码';
    $data['header'] = $this->load->view('common/header',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $this->load->view('user/reset_password', $data);
  }
  public function reset_result()
  {
    $data['title']= '用户中心-重置成功';
    $data['header'] = $this->load->view('common/header',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $this->load->view('user/reset_result', $data);
  }
  /**
   * 订单列表
   */
  public function order()
  {
    $data['title']= '用户中心-用户订单';
    $data['left_menu_name']="order";
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);
    $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
    $type=!isset($_GET["type"])?"":$_GET["type"];

    /*获取订单列表*/
    $param1 = array(
        'parameters' => array(
            'memberId' =>$this->user_info->memberID,
            'deviceId'=>"",
            'PageSize'=>99999,
            'PageSize'=>1,
            'ProductType'=>$type?$type:"",
            "BookingDateBegin"=>date('Y-m-d',strtotime("-3months",strtotime(date("Y-m-d")))),
            "BookingDateEnd"=>date("Y-m-d",strtotime("-1 day")),
            "BookingRefNo"=>""
        ),
        'code' => 70100025,
        'foreEndType' =>4
    );
    $errorDIY = array(
        'errorMsgOrder' => '没有找到符合条件的订单!', //自定义订单提示信息
    );
    $data['errorDIY'] = $errorDIY;


    $json_string =json_encode($param1);
    $resultOrder=parent::post_json($json_string);
    $data['orderData'] = $resultOrder;
//    var_dump($data['orderData']);exit();

    /*view part*/
    $data['order_list']=$this->load->view('user/template/order_list',$data,true);
    $data['o_travellers_list']=$this->load->view('user/template/travellers_list',$data,true);
    $this->load->view('user/order', $data);
  }

  /**
   * 订单列表
   */
  public function asy_order()
  {
    $type=!isset($_POST["type"])?"":$_POST["type"];
    $bookingDateBegin=!isset($_POST["bookingDateBegin"])?date('Y-m-d',strtotime("-3months",strtotime(date("Y-m-d")))):$_POST["bookingDateBegin"];
    $bookingDateEnd=!isset($_POST["bookingDateEnd"])?date('Y-m-d',strtotime("-3months",strtotime(date("Y-m-d")))):$_POST["bookingDateEnd"];
    $bookingRefNo=!isset($_POST["bookingRefNo"])?"":$_POST["bookingRefNo"];
//    echo json_encode($bookingDateBegin,$bookingDateEnd,$bookingRefNo);
    /*获取订单列表*/
    $param1 = array(
        'parameters' => array(
            'memberId' =>$this->user_info->memberID,
            'deviceId'=>"",
            'PageSize'=>99999,
            'PageSize'=>1,
            'ProductType'=>$type,
            "BookingDateBegin"=>$bookingDateBegin,
            "BookingDateEnd"=>$bookingDateEnd,
            "BookingRefNo"=>$bookingRefNo
        ),
        'code' => 70100025,
        'foreEndType' =>4
    );
    $errorDIY = array(
        'errorMsgOrder' => '没有找到符合条件的订单!', //自定义订单提示信息
    );
    $data['errorDIY'] = $errorDIY;
    $json_string =json_encode($param1);
//    var_dump($json_string);exit();
    $result=parent::post_json($json_string);
    if($result->success){
      /*view part*/
      $data['orderData']=$result;
      $html=$this->load->view('user/template/order_list',$data,true);
      $arr = array('success' => true,'message' =>$html);
    } else{
      $arr = array('success' => false,'message' =>$result->message);
    }
    echo json_encode($arr);
  }

  // ------------------------------------------------------------
  /**
   * 手机号查单未登录状态下订单列表
   * @type int $type查询订单类型   0：登录状态下；1：未登录状态。默认@type为0
   */
  public function search_order_list()
  {
    $data['title'] = '用户中心-查询订单';
    $data['header'] = $this->load->view('common/header_hide', $data, true);
    $data['footer'] = $this->load->view('common/footer', null, true);
    $errorDIY = array(
        'maxSize' => 2,//控制显示条数
        'errorMsg' => '没有找到符合条件的订单!' //自定义提示信息
    );
    $data['errorDIY'] = $errorDIY;
    $data['orderData'] = $data;

    $data['errorDIY'] = $errorDIY;
    $data['order_list'] = $this->load->view('user/template/order_list', $data, true);
    $this->load->view('user/search_order_phone', $data);

  }
  // --------------------------------------------------------------------
  /**
   * 订单号查单订单列表
   *  @type int $type 查询类型   0：手机号；1：订单号。默认@type为0
   */
  public function search_order($type=0)
  {
    $data['title']= '用户中心-查询订单';
    $data['header'] = $this->load->view('common/header_hide',$data,true);
    $data['footer'] = $this->load->view('common/footer',null,true);

    if(isset($this->user_info)){
      $data['menu_list']=$this->load->view('user/template/left_menu',$data,true);
      $data['order_list']=$this->load->view('user/template/order_list',$data,true);
      //图片异步请求
      $param = array(
          'Parameters' => array(
          ),
          'code' => 70100022,
          'foreEndType' =>4
      );
      $json_string =json_encode($param);
      $result=parent::post_json($json_string);
      if($result->success){
        $code=$result->data->imageNo;
        $_SESSION["imageNo"]=$result->data->imageNo;
        $data["code_image_url"]=$result->data->imageUrl;}
      //图片异步请求结束
      /*获取订单列表*/
      $memberID = isset($this->user_info->memberID)?$this->user_info->memberID:85078;
      $para = array(
          'parameters' => array(
              'memberId' =>$memberID,
          ),
          'code' => 70100017,
          'foreEndType' =>4
      );
      $errorDIY = array(
          'errorMsgOrder' => '没有找到符合条件的订单!', //自定义订单提示信息
      );
      $data['errorDIY'] = $errorDIY;

      $json_str =json_encode($para);
      $data_str=parent::post_json($json_str);
      $data['orderData'] = $data_str;

      /*view part*/
      $data['order_list']=$this->load->view('user/template/order_list',$data,true);


      $data['o_travellers_list']=$this->load->view('user/template/travellers_list',$data,true);
      $this->load->view('user/search_order', $data);
    }
    else{
      $param = array(
          'Parameters' => array(
          ),
          'code' => 70100022,
          'foreEndType' =>4
      );
      $json_string =json_encode($param);
      $result=parent::post_json($json_string);
      if($result->success){
        $code=$result->data->imageNo;

        $_SESSION["imageNo"]=$result->data->imageNo;
        $data["code_image_url"]=$result->data->imageUrl;


        $type=isset($_GET["type"])?$_GET["type"]:0;
        if($type==0){
          $this->load->view('user/search_order_unlogin_by_phone', $data);
        }
        else{
          $this->load->view('user/search_order_unlogin_by_order_number', $data);
        }
      }
    }

  }
  public function getBase64Bytes($file) {
    //header('Content-type:text/html;charset=utf-8');
   //读取图片文件，转换成base64编码格式
    $image_info = getimagesize($file);
    $base64_image_content =chunk_split(base64_encode(file_get_contents($file)));
    return $base64_image_content;
  }
  // --------------------------------------------------------------------
  /**
   * 头像上传-ajax 上传头像图片
   *
   */
  public function ajax_upload_avatar()
  {
    //$url=$this->config->item('resources_url')."/resources/images/tmp";

    $result = $this->uploader->upload( 'tmp'.DIRECTORY_SEPARATOR );	// 先保存到临时文件夹
    $reponse = new stdClass();
    if( isset($result['success']) && $result['success'] )
    {
      $src_path = 'tmp'.DIRECTORY_SEPARATOR.$this->uploader->get_real_name();
      $this->gd = new gd();
      $this->gd->open( $src_path );
      if( $this->gd->is_image() )
      {
        if( $this->gd->get_width() < $this->uploader->AVATAR_WIDTH )
        {
          $reponse->success = false;	// 传递给 file-uploader 表示服务器端已处理
          $reponse->description = '您上传的图片宽度('.$this->gd->get_width().'像素)过小！最小需要'.$this->uploader->AVATAR_WIDTH.'像素。';
        }
        else if( $this->gd->get_height() < $this->uploader->AVATAR_HEIGHT )
        {
          $reponse->success = false;	// 传递给 file-uploader 表示服务器端已处理
          $reponse->description = '您上传的图片高度('.$this->gd->get_height().'像素)过小！最小需要'.$this->uploader->AVATAR_HEIGHT.'像素。';
        }
        else
        {
          $reponse->success = true;
          $reponse->tmp_avatar = $this->uploader->get_real_name();

          if($this->gd->get_width()>$this->uploader->AVATAR_MAX_WIDTH || $this->gd->get_height() > $this->uploader->AVATAR_MAX_HEIGHT)
          {
            // 图片过大时按比例缩小，防止超大图片撑破页面
            $this->gd->resize_to($this->uploader->AVATAR_MAX_WIDTH, $this->uploader->AVATAR_MAX_HEIGHT, 'scale');
            $this->gd->save_to( $src_path );
          }
        }
      }
    }
    else if( isset($result['error']) )
    {
      $reponse->success = false;
      $reponse->description = $result['error'];
    }

//header('Content-type: application/json');
    echo json_encode($reponse);
  }

  // --------------------------------------------------------------------
  /**
   * ajax 裁切头像图片
   *
   */
  public function ajax_crop()
  {
    $tmp_avatar = $_POST['tmp_avatar'];
    $x1 = $_POST['x1'];
    $y1 = $_POST['y1'];
    $x2 = $_POST['x2'];
    $y2 = $_POST['y2'];
    $w = $_POST['w'];
    $h = $_POST['h'];

    $reponse = new stdClass();
    $host='http://'.$_SERVER['HTTP_HOST'];
    $src_path='./tmp/'.$tmp_avatar;
//    var_dump($src_path);exit;

    if(!file_exists($src_path))
    {
      $reponse->success = false;
      $reponse->description = '未找到图片文件';
    }
    else
    {

      $this->gd->open( $src_path );
      if( $this->gd->is_image() ) {
        $this->gd->crop($x1, $y1, $w, $h);
        $this->gd->resize_to($this->uploader->AVATAR_WIDTH, $this->uploader->AVATAR_HEIGHT, 'scale_fill');
        $avatar_name_big = date('YmdHis').'_'.md5(uniqid()).'_big.'.$this->gd->get_type();
        $this->gd->save_to( 'avatars'.DIRECTORY_SEPARATOR.$avatar_name_big );

        $this->gd->resize_to($this->uploader->AVATAR_S_WIDTH, $this->uploader->AVATAR_S_HEIGHT, 'scale_fill');
        $avatar_name_small = date('YmdHis').'_'.md5(uniqid()).'_small.'.$this->gd->get_type();
        $this->gd->save_to( 'avatars'.DIRECTORY_SEPARATOR.$avatar_name_small );
        //setcookie('avatar', $avatar_name, time()+86400*30);	// 本示例程序仅在 cookie 中保存
        /*
        实际应用中会有更多 保存头像代码
        ......
        */

        $param = array(
            'Parameters' => array(
                'MemberId' => $this->user_info->memberID,
                'SmallHeadImage'=>$this->getBase64Bytes('avatars'.DIRECTORY_SEPARATOR.$avatar_name_small),
                'BigHeadImage'=>$this->getBase64Bytes('avatars'.DIRECTORY_SEPARATOR.$avatar_name_big),
            ),
            'ForeEndType' => "4",
            'Code' => "70100018"
        );


        $json_string =json_encode($param);

        $result = parent::post_json($json_string);
        if($result->success){
          //这是给异步定义的成功
          $reponse->success = true;
        }
        else{
          $reponse->success = false;
           var_dump($result);exit;
        }
        @unlink($src_path);
        $reponse->avatar = $avatar_name_big;
        $reponse->avatar_small = $avatar_name_small;
        $reponse->description = '';
      }else{
        $reponse->success = false;
        $reponse->description = '该图片文件不是有效的图片';
      }
    }

//header('Content-type: application/json');
    echo json_encode($reponse);
  }


}
