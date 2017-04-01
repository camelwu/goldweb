<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//include_once( BASEPATH . '/helpers/form_helper'.EXT);

date_default_timezone_set("PRC");//中华人民共和国时间
// ------------------------------------------------------------------------
if (!function_exists('get_gmtime')) {
//当前时间转换格林威治时间戳
  function get_gmtime()
  {
    return (time() - date('Z'));
  }
}

//将时间戳转换成日期类型
if ( ! function_exists('formate_date')) {
  function formate_date($utc_time, $format = 'Y-m-d H:i:s',$diffday=0)
  {
    if (empty ($utc_time)) {
      return '';
    }
    else{
      $utc_time=str_replace('T',' ',$utc_time);
    }
    //return  date($format,strtotime( $utc_time. $diffday." day"));
    if($diffday==0){
      return  date($format,strtotime($utc_time));
    }else{
      return date($format,(strtotime($utc_time) +3600*24*$diffday));
    }


  }

  //计算剩余时间
  function remain_date($remain_date)
  {
    $day_time = date('y-m-d h:i:s',time());
    $creat_date=str_replace('T',' ',$remain_date);
    $rem_date = 30*1000*60;//30分钟
    $nimute =floor($day_time-( $creat_date+$rem_date)%86400/60);//分钟
    $second =floor($day_time-( $creat_date+$rem_date)%86400%60);//秒
    if (empty ($remain_date)) {
      return '';
    }
    else{
      if($nimute>0 && $second > 0){
        return  ($nimute."分钟".$second."秒");
      }else{
        return ("0分钟0秒");
      }
      }
  }

  //计算时间差
  function diff_date($formdate, $todate,$format="hm")
  {
    if ( $formdate < $todate ) {
      $formdat = $formdate;
      $todat = $todate;
    } else {
      $formdat = $todate;
      $todat = $formdate;
    }
    $star_str =str_replace('T',' ',$formdat);
    $end_str = str_replace('T',' ',$todat);
    $datediff = strtotime($end_str)-strtotime($star_str);
    $date=floor($datediff/86400);//天
    $hour=floor($datediff%86400/3600);//小时
    $minute=floor($datediff%86400%3600/60);//分钟
    $second=floor($datediff%86400%3600%60);//秒
//    var_dump($date); exit;
    if (empty ($formdate)||empty ($todate)) {
      return '';
    }
    else{
      if($format=="hm"){
        return  ($hour."h".$minute."m");//小时分钟:5h5m
      }elseif($format=="ms"){
        return  ($minute."m".$second."s");//分秒:5m5s
      }elseif($format=="h-m"){
        return  ($hour."-".$minute."m");//小时分钟5h-5m
      }elseif($format=="m-s"){
        return  ($minute."-".$second."");//分秒:5m-5s
      }elseif($format=="D"){
        return ($date);//5天
      }else{
        return  ($hour."分钟".$minute."秒");//分秒:5分钟5秒
      }
    }

  }
}

//将时间戳转换成日期类型
if ( ! function_exists('to_timespan')) {
//将任何时间类型转换为时间戳
  function to_timespan($str)
  {
    $timezone = intval(8);
    $time = intval(strtotime($str));
    if ($time != 0)
      $time = $time - $timezone * 3600;  //转换为格林威治时间
    return $time;
  }
}

//获得指定日期的周几
if ( ! function_exists('get_week')) {
  function get_week($date)
  {
    $date_str=date('Y-m-d',strtotime($date));
    $arr=explode("-", $date_str);

    //参数赋值
    $year=$arr[0];
    $month=sprintf('%02d',$arr[1]);
    $day=sprintf('%02d',$arr[2]);
    $hour = $minute = $second = 0;
    $strap = mktime($hour,$minute,$second,$month,$day,$year);
    $number_wk=date("w",$strap);
    $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
    return $weekArr[$number_wk];
  }
}
