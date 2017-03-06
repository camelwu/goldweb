<!--筛选主题-->

<?php if($results->success):?>
    <div class="filter_wrap clearfix">
        <?php if(count($results->data->themes)==0):?>
            11
        <?php else:?>
            <span class="filter_title">套餐主题&nbsp;:</span>
            <?php foreach ($results->data->themes as $k1 => $v1):?>
                <span class="filter_cell" data-id="<?php echo $v1->themeID;?>">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                         <b class="tip_word"><?php echo $v1->themeName;?></b>
                     </span>
            <?php endforeach;?>
        <?php endif?>
    </div>
<?php else:?>
 <div class="filter_wrap_">
    <P class="no_get_data"><?php echo $results->message?></P>
 </div>
<?php endif?>

