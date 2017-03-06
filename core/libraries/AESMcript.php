<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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