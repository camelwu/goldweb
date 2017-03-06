
<!--遮罩-->
<div id="loading"  style="display:none;" loading>
  <div id="preloader" >
    <div id="status" ></div>
  </div>
</div>

<!--topper  begin-->
<div class="pa" top-box top-index>
  <p class="bg0"></p>
  <div class="topper clearfix">

    <!--左侧-->
    <div class="top_left fl">
      <?php if(!isset($this->user_info)): ?>
        <span class="cl_green">欢迎来到Atrip.com</span>
        <a href="javascript:;">收藏本站</a>
        <i>|</i>
        <a href="/user/login">登录</a>
        <i>|</i>
        <a href="/user/register">注册</a>
      <?php else: ?>
        <a href="/user/info"><span class="cl_green pdr0">您好,<?php echo $this->user_info->mobile ?></span></a>
        <i>|</i>
        <a href="/user/asy_quit_login">退出</a>
      <?php endif;?>
    </div>

    <!--右侧-->
    <div class="top_right fr">
      <dl class="order_center">
        <?php if(!isset($this->user_info) ): ?>
          <dt onclick="javascript:window.location.href='/user/login'">我的亚程<i class="top_icon"></i></dt>
        <?php else: ?>
          <dt onclick="javascript:window.location.href='/user/index'">我的亚程<i class="top_icon"></i></dt>
        <?php endif;?>
        <dd>
          <?php if(!isset($this->user_info) ): ?>
            <p onclick="javascript:window.location.href='/user/search_order'">全部订单</p>
          <?php else: ?>
            <p onclick="javascript:window.location.href='/user/order'">全部订单</p>
            <p onclick="javascript:window.location.href='/user/order?type=Flight'">我的机票</p>
            <p onclick="javascript:window.location.href='/user/order?type=Hotle'">我的酒店</p>
            <p onclick="javascript:window.location.href='/user/order?type=Tour'">我的门票</p>
          <?php endif;?>
        </dt>
      </dl>
      <dl class="top_app">
        <dt>手机APP<i class="top_icon"></i></dt>
        <dd class="pr">
          <img src="../../../resources/images/qr_code.jpg">
          <p class="pa code_close"></p>
        </dd>
      </dl>
      <dl>
        <dt>微信微博</dt>
      </dl>
    </div>
  </div>
</div>
<!--topper  end-->

<!--导航-->
<div class="pa" nav_boxs nav_index>
  <div class="contents">
    <h1 class="logo fl"><a class="logo_bd" href="/index">亚洲旅游</a></h1>
    <dl class="nav fl">
      <dd>
        <a class="a_index" href="/index">首页<span class="icon"></span></a>
      </dd>
      <dd <?php if(isset($top_menu_name) && $top_menu_name=="hotel" ): ?>class="cur"<?php endif?>">
      <a class="a_index a_hotel" href="javascript:;">酒店<i></i></a>
      <ol>
        <li><a href="/hotel/index?hotelType=inter">国际酒店</a></li>
        <li><a href="/hotel/index?hotelType=dom">国内酒店</a></li>
      </ol>
      </dd>
      <dd <?php if(isset($top_menu_name) && $top_menu_name=="ticket" ): ?>class="cur"<?php endif?>">
      <a class="a_index" href="/ticket/index">海外景点</a>
      </dd>
      <dd <?php if(isset($top_menu_name) && $top_menu_name=="hotel_ticket" ): ?>class="cur"<?php endif?>">
      <a class="a_index" href="javascript:;">出境游<i class="depart"></i></a>
      <ol>
        <li><a href="/Expect/index">机+酒+景</a></li>
        <li><a href="/Expect/index">机+酒</a></li>
        <li><a href="/hotelticket/index">酒+景</a></li>
      </ol>
      </dd>
      <dd <?php if(isset($top_menu_name) && $top_menu_name=="flight" ): ?>class="cur"<?php endif?>">
      <a class="a_index a_flight" href="javascript:;">机票<i></i></a>
      <ol>
        <li><a href="/Expect/index">国际机票</a></li>
        <li><a href="/Expect/index">国内机票</a></li>
      </ol>
      </dd>
      <dd>
        <a class="a_index" href="/Expect/index">接送服务</a>
      </dd>
    </dl>
  </div>
</div>
<script type="text/javascript" src="../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script>
  $(function(){
    $('.nav dd').hover(function(){
      $(this).find('ol').show();
    },function(){
      $(this).find('ol').hide();
    })
    /*右侧*/
    $('.top_right dl').hover(function(){
      $(this).find('dd').show();
    },function(){
      $(this).find('dd').hide();
    })
    $('.code_close').click(function(){
      $(this).parent().hide();
    })
  })
</script>