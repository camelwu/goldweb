<!--筛选主题-->
<div class="filter_wrap clearfix">
  <span class="filter_title">套餐主题&nbsp;:</span>
  <?php if($results->success):
    if(count($results->data->themes)>0):?>
      <!-- add select all -->
        <span class="filter_cell<?php if($themeID==''){echo ' cur';}?>" data-id="">
          <i class="icon">
            <a href="javascript:void(0);" class="checkbox_icon">
              <input type="checkbox" class="filter_input">
            </a>
          </i>
          <b class="tip_word">全部</b>
        </span>
      <?php foreach($results->data->themes as $k1=>$v1):?>
       <span class="filter_cell<?php if($themeID==$v1->themeID){echo ' cur';}?>" data-id="<?php echo $v1->themeID;?>">
          <i class="icon">
            <a href="javascript:void(0);" class="checkbox_icon">
              <input type="checkbox" class="filter_input">
            </a>
          </i>
          <b class="tip_word"><?php echo $v1->themeName;?></b>
        </span>
      <?php endforeach;?>

    <?php endif; ?>
  <?php else:?>
    <P class="no_get_data"><?php echo $results->message;?></P>
  <?php endif?>
</div>