<!--酒景列表-->
<ul>
  <?php if ($results->success): ?>
    <!--如果没有数据-->
    <?php if (count($results->data->lists) == 0): ?>
      <P class="no_get_data"><?php echo $results->message?$results->message:'未能搜索到数据，<br/>请更换条件再试试!'; ?></P>
    <? endif; ?>
    <?php foreach($results->data->lists as $k1=>$v1 ):?>
    <li class="list_item clearfix">
      <div class="img_wrap">
        <img src="<?php echo $v1->pictureURL?>" />
      </div>
      <div class="p_wrap">
        <h2><?php echo $v1->packageName?></h2>
        <div class="container_div clearfix">
          <span class="container_title fl">套餐包括</span>
          <div class="container_detail fl">
            <?php echo $v1->inclusiveItems; ?>
          </div>
        </div>
        <p>
          <span class="includes">旅行日期</span>
          <span class="from_date"><?php echo string_cut($v1->salesFrom, 0, 4) . '年' . string_cut($v1->salesFrom, 5, 2) . '月' . string_cut($v1->salesFrom, 8, 2) . '日'; ?>至 <span
              class="to_date"><?php echo string_cut($v1->salesTo, 0, 4) . '年' . string_cut($v1->salesTo, 5, 2) . '月' . string_cut($v1->salesTo, 8, 2) . '日'; ?></span>
        </p>
        <p>
          <span class="includes">套餐限制</span>
          <span><?php echo $v1->minPax; ?>人起订</span>
        </p>
        <p>
          <span class="includes"> 产品编号</span>
          <span><?php echo $v1->packageRefNo; ?></span>
        </p>
<!--        <p class="sp">-->
<!--          <a href="javascript:void(0)">自然搜索</a>-->
<!--          <a href="javascript:void(0)">接送服务</a>-->
<!--          <a href="javascript:void(0)">文化历史</a>-->
<!--        </p>-->
      </div>
      <div class="price_num">
        <div class="mon_tag">
          ￥<span class="price_value"><?php echo $v1->leadinPrice;?></span>起/人
        </div>
        <button class="search_detail" onclick="vlm.Utils.OpenWin('/hotelticket/detail?packageID=<?php echo $v1->packageID; ?>&leadinPrice=<?php echo $v1->leadinPrice; ?>')">查看详情</button>
      </div>
    </li>
    <?php endforeach; ?>
  <?php else: ?>
    <P class="no_get_data"><?php echo $results->message; ?></P>
  <?php endif ?>
</ul>
<?php if (count($results->data->lists) != 0): ?>
  <div page class="index_num_wrap clearfix">
    <div class="fr">
      <input type="hidden" id="pageTotal" value="<?php echo $results->data->totalCount?>">
      <?php echo $pager_html;?>
    </div>
  </div>
<?php endif ?>