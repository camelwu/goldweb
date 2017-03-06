<!--左侧导航-->
    <div class="clearfix margin_top_down">
        <h4 class="fl title_fix">筛选条件</h4>
        <p class="fr clear_filter grey add_line_height">清空</p>
    </div>
    <ul class="clearfix filter_ul">
        <?php $val1 = $lists->data->filters;;foreach($val1 as $k3 => $v3): ?>
            <li data-mapkey="<?php echo $v3->filterType;?>">
                <p class="title background filter_part"><?php echo $v3->title;?></p>
                <div class="<?php echo count($v3->item)>6?'height_pre':'';?>">
                <?php foreach($v3->item as $k4 => $v4): ?>
                    <p class="li clearfix" data-mapkeyvalue="<?php echo $v4->filterText;?>">
                        <i class="icon">
                            <a href="javascript:void(0);" class="checkbox_icon"> <!--checkbox_cur-->
                                <input type="checkbox" class="filter_input">
                            </a>
                        </i>
                        <span class="word"><?php echo $v4->filterValue;?></span>
                        <!--<span class="price">￥1092</span>-->
                    </p>
                <?php endforeach; ?>
                </div>
            </li>
            <?php if(count($v3->item)>6): ?>
                <p class="li clearfix more_li">更多</p>
            <?php endif;?>
        <?php endforeach; ?>
    </ul>
