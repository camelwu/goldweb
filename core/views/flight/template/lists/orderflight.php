<!--右侧的排序内容-->
        <div class="filter_sort_left fl">
            <ul class="order_ul clearfloat">
                <?php foreach($lists->data->sortTypes as $k5 => $v5): ?>
                    <li class="order_li <?php echo $k5==4?'cur up':'' ?>" data-key="<?php echo $v5->sortValue ?>" data-value="0"><span><?php echo $v5->sortText ?></span><i></i></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="filter_sort_right fr">
            <ul class="tax_ul">
                <li class="fr cur" data-value ="0"><span>不含税</span></li>
                <li class="fr" data-value ="1"><span>含税</span></li>
            </ul>
        </div>
