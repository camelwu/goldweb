<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//include_once( BASEPATH . '/helpers/form_helper'.EXT);
date_default_timezone_set("PRC");//中华人民共和国时间

// ------------------------------------------------------------------------
if ( ! function_exists('get_user_info')) {
//当前时间转换格林威治时间戳
    function get_user_info()
    {
       if(isset($_SESSION["user_info"])){

           return  $_SESSION["user_info"][0];
       }
        else{
            return null;
        }
    }
   function get_deviceId(){
     if(!isset($_COOKIE['deviceId'])){
       $timestamp=microtime(true)*1000; //生成访问时间戳，精确到毫秒
       $timeBase64 = base64_encode($timestamp);
       $guid = md5($timestamp);
       setcookie("deviceId",$guid, time()+3600*24*7);
       return $guid;
     }
     else{
       $guid=$_COOKIE['deviceId'];
     }
     return $guid;

   }
}
// -------年龄获取函数-----------------------------------------------------

if ( ! function_exists('get_user_age')) {

    function get_user_age($par)
    {
      $nowDate = date('Y-m-d H:i:s');
      $opDate = str_replace("T"," ",$par);
      $second1 = strtotime($opDate);
      $second2 = strtotime($nowDate);
      $cle = $second2 - $second1;
      return floor(($cle/3600/24/365));
    }
}
// --------证件类型函数-------------------------------------------------------

if ( ! function_exists('get_id_type')) {

    function get_id_type($par)
    {
          $result = '身份证';
           switch($par){
              case 1:
              $result = '护照';
              break;
              case 2:
                  $result = '身份证';
                  break;
              case 3:
                  $result = '港澳通行证';
                  break;
              case 4:
                  $result = '台胞证';
                  break;
              case 5:
                  $result = '回乡证';
                  break;
              case 6:
                  $result = '台湾通行证';
                  break;
              case 7:
                  $result = '军官证';
                  break;
              case 8:
                  $result = '户口薄';
                  break;
              case 9:
                  $result = '出生证明';
                  break;
              case 10:
                  $result = '其他';
                  break;
              default:
                  $result = '护照';
          }
           return $result;
    }
}
// -----订单类型函数------------------------------------------------------------

if ( ! function_exists('get_order_type')) {

    function get_order_type($par)
    {
        $result = '';
        switch($par){
            case 'Flight' && 'Flight':
                $result = '机票';
                break;
            case 'Hotel'&& 'Hotel':
                $result = '酒店';
                break;
            case 'Package_T' && 'Tour':
                $result = '景点';
                break;
            case 'Package_HT'|| 'FlightHotle':
                $result = '酒+景';
                break;
            case 'Package_FHT' || "FlightHotleTour":
                $result = '机+酒+景';
                break;
            case 'Package_FH'|| 'FlightHotle':
                $result = '机+酒';
                break;
            default:
                $result = '';
        }
        return $result;
    }
}
// ---订单状态函数------------------------------------------------------------
if ( ! function_exists('get_order_status')) {

    function get_order_status($par)
    {
        $result = '';
        switch($par){
            case 'Pending':
                $result = '订单待支付';
                break;
            case 'Confirmed':
                $result = '订单已确认';
                break;
            case 'Canceled':
                $result = '订单已取消';
                break;
            case 'Abort':
                $result = '订单已中断';
                break;
            case 'Paid':
                $result = '订单已支付';
                break;
            default:
                $result = '';
        }
        return $result;
    }

    function get_order_Tstatus($par)
    {
        $result = '';
        switch($par){
            case '0':
                $result = '订单已取消';
                break;
            case '1':
                $result = '订单已中断';
                break;
            case '2':
                $result = '订单已确认';
                break;
            case '3':
                $result = '订单待支付';
                break;
            default:
                $result = '';
        }
        return $result;
    }
}
// ---数字隐藏函数------------------------------------------------------------
if ( ! function_exists('number_handler')) {
    function number_handler($par,$n)
    {
        $result = '';
        $n =$n?$n:9;
        if(strlen($par)<$n){
            $result = $par;
        }else{
            $result = substr($par,0,4).'****'.substr($par,-4,4);
        }
        return $result;
    }
}

// ---字符串截取函数------------------------------------------------------------
if ( ! function_exists('string_cut')) {
    function string_cut($par, $s, $n)  /*参数1：被截取的字符窜；参数2:截取开始位置，默认为0;参数3:长度；默认为2*/
    {
        $result = '';
        $s =$s?$s:0;
        $n =$n?$n:2;
        $result = substr($par,$s,$n);
        return $result;
    }
}