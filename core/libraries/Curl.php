<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//php aes加密类
//desc 中间层服务接口过滤
//    1.1、Http Head
//     a、当前时间戳+Json(现在传输的数据)，当前时间戳以毫秒为单位，可以有小数部分，长度尽可能长点。
//          以上拼成一个字符串做MD5加密，放在Http Head里面，Head的key=Sign,Head的Value=MD5加密过后的数据。
//     b、Http的Head里面添加Key=Token，Value=上面时间戳的Base64编码。
//
//    1.2、Http Body
//       Json(现在没加密的数据)做AES加密再做Base64编码，AES的Key=YWJjZGVmZ2hpamtsbW5vcHFyc3R1dnd4(256位，Base64加密，暂定)     AES的偏移量IV=YWJjZGVmZ2hpamts(128位，base64加密，暂定)
//       以上是具体的加密规则。
//
//    2、为了方便前端调用测试，现暂定在Http的Head加上key=flag，Vaue=1(传的是加密数据，按照既定的加密规则传输)，Value=0(传的是非加密数据，按照现有的方式传输)，
//     该规则只适合测试环境，生产环境所有的方法调用都需要加密。


class Curl
{
  function  post_json( $postData)
  {
    $url= config_item('api_url');
    $timestamp=microtime(true)*1000; //生成访问时间戳，精确到毫秒

    //头部签名用
    $timeBase64 = base64_encode($timestamp);
    $sign = md5($timestamp.$postData);

    //加密
    //$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
    $aes = new AESMcript();
    $aec_postdata =$aes->encryptToken($postData);
    $ch = curl_init();
     $tt=base64_encode($aec_postdata);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$tt);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT,60*30);   //只需要设置一个秒的数量就可以
    curl_setopt($ch, CURLOPT_HEADER, False);	//表示需要response header
    curl_setopt($ch, CURLOPT_NOBODY, False);	//表示需要response body
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Expect:',//解决超过1024分批发，后台api报错问题
            'Content-Type:application/json;charset=UTF-8',
            "Sign:".$sign,
            "flag:1",
            "Token:".$timeBase64)
    );

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($httpCode!=200){
      return array("success" => false,"message" => "服务器连接不上，网络错误！");
    }
    else{
      return json_decode($response);
    }
    curl_close($ch);
  }

}

class AESMcript
{
  var $key = 'YWJjZGVmZ2hpamtsbW5vcHFyc3R1dnd4';
  var $iv = 'YWJjZGVmZ2hpamts';

  function _cypher()
  {
    return mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
  }

  function encryptToken($data)
  {
    $padding = 16 - (strlen($data) % 16);
    $data .= str_repeat(chr($padding), $padding);
    return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_CBC, $this->iv);
  }

  function decryptToken($data)
  {
    $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, base64_decode($data), MCRYPT_MODE_CBC, $this->iv);
    $padding = ord($data[strlen($data) - 1]);
    return substr($data, 0, -$padding);
  }

}