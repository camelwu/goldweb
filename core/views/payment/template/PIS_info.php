<div PISInfo>
    <h3  class = "order_title">乘客信息</h3>
    <?php $i=1;foreach ($lists->data->travelers as $item):?>
        <div class="p_order">
            <i class = "icon_num"><?php echo $i; ?></i>
            <ul class="p_list">
                <li><span class = "p_title">姓名 </span><span><?php echo $item->travelerName; ?><?php echo $item->lastName; ?></span></li>
                <?php if($item->idType === 1):  ?>
                    <li><span class = "p_title">证件信息</span><span>护照</span></li>
                <?php elseif ($item->idType === 2):  ?>
                    <li><span class = "p_title">证件信息</span><span>身份证</span></li>
                <?php else:  ?>
                    <li><span class = "p_title">证件信息</span><span>港澳通行证</span></li>
                <?php endif;  ?>
                <?php if($item->sexCode === 1): ?>
                    <li><span class = "p_title">性别</span><span>男</span></li>
                <?php else: ?>
                    <li><span class = "p_title">性别</span><span>女</span></li>
                <?php endif; ?>
                <!--                    <li><span class = "p_title">国籍 </span><span>中国大陆</span></li>-->
                <li><span class = "p_title">出生日期</span><span>1990-08-04</span></li>
            </ul>
        </div>
        <?php $i=$i+1; endforeach;?>
</div>