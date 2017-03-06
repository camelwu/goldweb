

<!--菜单列表-->
<ul menu_left>
    <li><i class="icon"></i><a <?php if(isset($left_menu_name) && $left_menu_name=="index"):?> class="highlight"<?php endif ?>  href="/user/index">我的亚程首页</a></li>
    <li><i class="icon"></i><a href="/user/order" <?php if(isset($left_menu_name) && $left_menu_name=="order"):?> class="highlight"<?php endif ?>>我的订单</a></li>
    <li><i class="icon"></i><a href="#">优惠券</a></li>
    <li>
        <p class="li_title"><i class="icon"></i><a href="#"><span>个人中心</span><i class="arrow arrow_up"></i></a></p>
        <ul class="sub_ul">
            <li class="sub_li"><a <?php if(isset($left_menu_name) && $left_menu_name=="info"):?> class="highlight"<?php endif ?> href="/user/info">我的信息</a></li>
            <li class="sub_li cur"><a <?php if(isset($left_menu_name) && $left_menu_name=="security"):?> class="highlight"<?php endif ?> href="/user/security">账户安全</a></li>
        </ul>
    </li>
    <li>
        <p class="li_title"><i class="icon"></i><a href="#"><span>常用信息</span><i class="arrow arrow_up"></i></a></p>
        <ul class="sub_ul">
            <li class="sub_li"><a <?php if(isset($left_menu_name) && $left_menu_name=="passenger"):?> class="highlight"<?php endif ?>  href="/user/passenger">常用旅客</a></li>
        </ul>
    </li>
</ul>
<script type="application/javascript">
    var scrollHeight=$(window).height();
    var width=30+100+42+160+40;
    $(".left_part").css("min-height",scrollHeight-width);

    $(".li_title").on("click",function(){
        var a = $(this).children()[1];
        var arrow = $(a).children()[1];
        $(this).next(".sub_ul").toggle(200);
        $(arrow).toggleClass("arrow_up");
    })
</script>