<!--遮罩-->
<div id="loading"  style="display: none;" loading>
  <div id="preloader" >
    <div id="status" ></div>
  </div>
</div>
<!--topper  begin-->
<div top-box top-other>
  <p class="bg0"></p>
  <div class="topper clearfix">
    <!--左侧-->
    <div class="top_left fl">
      <?php if(!isset($this->user_info) ): ?>
        <span class="cl_green">欢迎来到 Atrip.com</span>
        <a href="javascript:;">收藏本站</a>
        <i>|</i>
        <a href="/user/login">登录</a>
        <i>|</i>
        <a href="/user/register">注册</a>
      <?php else: ?>
        <span class="cl_green pdr0"><a href="/user/info">您好,<?php echo $this->user_info->mobile ?></a></span>
        <i>|</i>
        <a href="/user/asy_quit_login">退出</a>
      <?php endif;?>
    </div>

    <!--右侧-->
    <div class="top_right fr">
      <dl class="order_center">
        <dt>我的亚程<i class="top_icon"></i></dt>
        <dd>
          <?php if(!isset($this->user_info) ): ?>
            <p onclick="javascript:window.location.href='/user/order'">全部订单</p>
          <?php else: ?>
            <p onclick="javascript:window.location.href='/user/search_order'">全部订单</p>
            <p onclick="javascript:window.location.href='/user/search_order'">我的机票</p>
            <p onclick="javascript:window.location.href='/user/search_order'">我的酒店</p>
            <p onclick="javascript:window.location.href='/user/search_order'">我的门票</p>
          <?php endif;?>
        </dd>
      </dl>
      <dl class="top_app">
        <dt>手机APP<i class="top_icon"></i></dt>
        <dd class="pr">
          <img src="../../../resources/images/qr_code.jpg">
          <p class="pa code_close"></p>
        </dd>
      </dl>
      <dl class="center_wx">
        <dt>微信微博</dt>
      </dl>
    </div>
  </div>
</div>
<!--topper  end-->
<!--导航-->
<div nav_boxs nav_other>
  <div class="nav_bg bg"></div>
  <div class="contents clearfix">
    <h1 class="logo fl"><a class="logo_bd" href="/index">亚洲旅游</a></h1>
    <dl class="nav fl">
      <dd class="header_drop first_page">
        <a class="a_index" href="/index">首页</a>
      </dd>
      <dd class="header_drop hotel">
        <a class="a_index" href="/hotel/index">酒店<i></i></a>
        <ol class="drop">
          <li><a href="/hotel/index?hotelType=inter">国际酒店</a></li>
          <li><a href="/hotel/index?hotelType=dom">国内酒店</a></li>
        </ol>
        <i class="icon"></i>
      </dd>
      <dd class="header_drop ticket">
        <a class="a_index" href="/ticket/index">海外景点</a>
        <i class="icon"></i>
      </dd>
      <dd class="header_drop hotelticket <?php if(isset($top_menu_name) && $top_menu_name=="hotel_ticket" ): ?>cur<?php endif?>">
        <a class="a_index" href="javascript:;">出境游<i class="depart"></i></a>
        <ol class="drop">
          <li><a href="/Expect/index">机+酒+景</a></li>
          <li><a href="/Expect/index">机+酒</a></li>
          <li><a href="/hotelticket/index">酒+景</a></li>
        </ol>
        <i class="icon"></i>
      </dd>
      <dd class="header_drop flight <?php if(isset($top_menu_name) && $top_menu_name=="flight" ): ?>cur<?php endif?>">
        <a class="a_index" href="/Flight/index">机票<i></i></a>
        <ol class="drop">
          <li><a href="/Expect/index">国内机票</a></li>
          <li><a href="/Expect/index">国际·港澳台机票</a></li>
        </ol>
        <i class="icon"></i>
      </dd>
      <dd class="header_drop limousine_service">
        <a class="a_index" href="javascript:;">接送服务</a>
      </dd>
    </dl>
    <div class="photo_top fr">
      <p>4008-058-888</p>
    </div>
  </div>
</div>
<script type="text/javascript" src="../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script>
  ;(function($){
    $(document).ready(function(){
      var moduleType = /\/(\S+)\//.exec(window.location.pathname)[1].toLowerCase();
      var makeDir = function(op){
        $(op).addClass('cur').siblings(".header_drop").removeClass('cur');
        $(op).find('i.icon').show().parent().siblings().find('i.icon').hide();
        $(op).find('ol').show().parent().siblings().find('ol').hide();
      };
      var resetStatus = function(){
        var targetOut = $("."+moduleType).eq(0);
        makeDir(targetOut);
      };
      resetStatus();
      $('dd.header_drop').each(function(){
        $(this).hover(function(){
          makeDir(this);
        }, function(){
          resetStatus();
          if(this.className.indexOf(moduleType) === -1){
            $(this).removeClass('cur');
            $(this).find('i.icon').hide();
            $(this).find('ol').hide();
          }
        })
      });
      /*右侧*/
      $('.top_right dl').hover(function(){
        $(this).find('dd').show();
      },function(){
        $(this).find('dd').hide();
      });
      $('.code_close').click(function(){
        $(this).parent().hide();
      });
    })
  })(jQuery);
</script>
