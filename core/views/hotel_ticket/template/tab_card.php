<?php
/**
 * Created by PhpStorm.
 * User: yyc
 * Date: 2016/8/31
 * Time: 14:15
 */
?>
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/plugin/tab_card.css" />
<div tab-card>
    <div class="tab_title">
        <ul class="clearfix">
            <?php
                foreach ($tab_card_array['titles'] as $title) {
                    echo '<li>'.$title.'</li>';
                }
            ?>
        </ul>
    </div>
    <div class="tab_content">
        <ul>
            <?php
            foreach ($tab_card_array['contents'] as $content) {
                echo '<li class="clearfix">'.$content.'</li>';
            }
            ?>
        </ul>
    </div>
</div>
<script>
    ;(function () {
        function show(index) {
            $('[tab-card] .tab_title li').removeClass('cur').eq(index).addClass('cur');
            $('[tab-card] .tab_content li').removeClass('cur').eq(index).addClass('cur');
        }
        $('[tab-card] .tab_title li').on('click', function (e) {
            show($(this).index());
        });
        show(<?php echo $tab_card_index ?>);
    })();
</script>