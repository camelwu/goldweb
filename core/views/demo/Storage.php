<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $title; ?></title>
    <style type="text/css">
            .outer{
                margin: 0 auto;
                width: 100px;
                border:1px solid red
             }
            .outer button{
                height: 40px;
                line-height: 40px;
                margin: 2px 11px;
                border: 1px solid blue;
                background: yellow;
            }
    </style>
</head>
<body>
 <div class="outer">
        <button class="add" onclick="add1('name', '中国人')">存取值</button>
        <button class="add" onclick="read1('name')">读取值</button>
        <button class="add" onclick="clear1('name')">移除值</button>
        <button class="add" onclick="read2('name')">读取值</button>
 </div>

</body>
<script type="text/javascript" src="../../../resources/js/lib/help.js"></script>
<script>
      var Storage = new help.Storage('local');
      function add1(key, value){
          Storage.set(key, value);
          console.log("存取key为: "+key+     "值为: "+value)
      }
      function read1(key){
          var name = Storage.get(key);
          console.log("读取key为: "+key+     "值为: "+name);
          alert(name);
      }
      function clear1(key){
          Storage.remove(key);
          console.log("清空key为: "+key+"的值")
      }
      function read2(key){
          var name = Storage.get(key);
          console.log("读取key为: "+key+      "值为: "+name);
          alert(name);
      }
</script>
</html>