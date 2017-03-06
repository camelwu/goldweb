<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">
  <meta name="screen-orientation" content="portrait">
  <meta name="full-screen" content="yes">
  <meta name="browsermode" content="application">
  <meta name="x5-orientation" content="portrait">
  <meta name="x5-fullscreen" content="true">
  <meta name="x5-page-mode" content="app">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title></title>
  <style>
    body,ul,p,li{ margin: 0; padding:0;}
    a{
      text-decoration: none;
    }
    li{
      list-style: none;
    }
    .content{
      width:100%;
      height:120px;
      font-size:16px;;
      text-align: center;
      position: absolute;
      top:50%;
      left:0;
      margin-top: -70px;
    }
    .content p{
      padding:0 50px;
      line-height: 24px;
    }
    .content ul{
      padding-top:70px;
    }
    .content ul li{
      width:180px;
      height:40px;
      line-height: 40px;
      background: #8ace00;
      color:#fff;
      text-align: center;
      margin: 0 auto;
      font-size: 14px;
    }
  </style>
</head>
<body>

<!--内容区域-->
<div class="content" style="display: none" id="content">
  <p>亚程旅游网ios v1.0版本，即将发布。敬请期待！</p>
  <ul>
    <a href="http://m.atrip.com/index.html"><li id="href">点击返回下载页</li></a>
  </ul>
</div>

<script type="text/javascript">
  if(window.navigator.userAgent.indexOf("Android")>-1){
    window.location.href = "http://www.appchina.com/app/com.asiatravel.asiatravel";
  }else if(window.navigator.userAgent.indexOf("iPhone")>-1 || window.navigator.userAgent.indexOf("iOS")>-1){
    window.location.href = "https://itunes.apple.com/app/apple-store/id1134860224?pt=118317566&ct=atrip.com&mt=8";
  };

</script>
</body>
</html>