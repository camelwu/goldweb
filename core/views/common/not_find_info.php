<div class="not_find_wrap" not_find_wrap>
    <p class="list_top">
        <span class="traveller_name">订单信息</span>
        <span class="traveller_age">订单号</span>
        <span class="id_type">订单时间</span>
        <span class="id_no">订单金额</span>
        <span class="tel_value">订单状态</span>
    </p>
     <div class="content_wrap">
          <div class="img_out">
              <i></i>
               <span class="tip_word"><?php echo empty($orderDataErrorInfo)?"没有找到符合条件的订单":$orderDataErrorInfo;?></span>
          </div>
     </div>
</div>