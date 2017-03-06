<div hotel_list_searchbox>
    <div class="clearfix search_item_main">
        <div class="search_term fl">
            <div id="ui-datepicker">
                <input type="text" id="startdate" placeholder="开始日期"><input type="text" id="enddate" placeholder="结束日期">
            </div>
            <div class="clearfix">
                <div select-div class="fl">
                    <div class="select_unit">
                        <p class="select_btn">客房数<span id="hotel_room_number">1</span><i></i></p>
                        <ul class="select_ul">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                </div>
                <div select-div class="fl">
                    <div class="select_unit">
                        <p class="select_btn">成人<span id="hotel_adult_number">1</span><i></i></p>
                        <ul class="select_ul">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                </div>
                <div select-div class="fl">
                    <div class="select_unit">
                        <p class="select_btn">儿童<span id="hotel_child_number">1</span><i></i></p>
                        <ul class="select_ul">
                            <li>0</li>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div btn-default class="fl">
            <p class="search btn1_hover" id="search_hotel">搜索</p>
        </div>
    </div>
    <?php if($results->success): ?>
        <div class="search_item_sub">
        <div class="filter_wrap filter_warps">
            <div class="search_term search_package">
                <div class="hotel_choose_price clearfix">
                    <div class="fl clearfix">
                        <span class="filter_title fl">酒店价格&nbsp;:</span>

                        <div class="fl hotel_sel_wrap" id="hotel_price">
                        <span class="filter_cell cur" data-range="不限" data-selType="noControl">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input name="js_hotelprice" type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">不限</b>
                        </span>
                            <?php $val=$results->data[0]->hotelPriceList?>
                            <?php for($i=0,$j=1; $i<count($val); $i++,$j++){ ?>
                                <?php if ($i != count($val) - 1): ?>
                                <span class="filter_cell" data-range="<?php echo ($val[$i]->hotelPriceKey).'-'.($val[$j]->hotelPriceKey)?>" data-chooseType="<?php echo 'sel_price'.$i ?>">
                                    <i class="icon">
                                        <a href="javascript:void(0);" class="checkbox_icon">
                                           <input name="js_hotelprice" type="checkbox" class="filter_input">
                                        </a>
                                    </i>
                                    <b class="tip_word"><?php echo ($val[$i]->hotelPriceValue).'-'.($val[$j]->hotelPriceValue) ?></b>
                                </span>
                                <?php endif ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="fl clearfix">
                        <span class="search_price_label">自定义</span>

                        <div class="search_price">
                            <div class="input_line">
                                <input type="text" id="price_start" name="price_start" class="price_input"/>
                                <i></i>
                                <input type="text" id="price_end"  name="price_end" class="price_input"/>
                            </div>
                            <p>
                                <a href="javascript:void(0);" class="clear_price">清空价格</a>
                                <button class="sure">确定</button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hotel_choose_level clearfix">
                    <div class="fl clearfix">
                        <span class="filter_title fl">酒店星级&nbsp;:</span>

                        <div class="fl hotel_sel_wrap" id="hotel_star">
                        <span class="filter_cell cur" data-selType="noControl" data-stars="">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">不限</b>
                        </span>
                        <span class="filter_cell" data-stars="2" data-chooseType="sel_star0">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">二星级/经济型</b>
                        </span>
                        <span class="filter_cell" data-stars="3" data-chooseType="sel_star1">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">三星级/舒适型</b>
                        </span>
                        <span class="filter_cell" data-stars="4" data-chooseType="sel_star2">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">四星级/高等型</b>
                        </span>
                        <span class="filter_cell" data-stars="5" data-chooseType="sel_star3">
                           <i class="icon">
                               <a href="javascript:void(0);" class="checkbox_icon">
                                   <input type="checkbox" class="filter_input">
                               </a>
                           </i>
                           <b class="tip_word">五星级/豪华型</b>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="hotel_classify_wrap">
                    <div class="hotel_choose_classify clearfix">
                        <div class="fl clearfix">
                            <span class="filter_title fl">酒店类型&nbsp;:</span>

                            <div class="hotel_sel_wrap fl" id="hotel_type">
                           <span class="filter_cell cur" data-selType="noControl" id="js_hotel_type">
                               <i class="icon">
                                   <a href="javascript:void(0);" class="checkbox_icon">
                                       <input type="checkbox" class="filter_input">
                                   </a>
                               </i>
                               <b class="tip_word">不限</b>
                            </span>
                                <?php foreach ($results->data[0]->hotelTypeList as $k2 => $v2): ?>
                                    <?php if ($k2 != 0): ?>
                                    <span class="filter_cell" data-chooseType="<?php echo 'sel_type'.$k2 ?>" data-cate="<?php echo $k2 ?>" >
                                       <i class="icon">
                                           <a href="javascript:void(0);" class="checkbox_icon">
                                               <input type="checkbox" class="filter_input">
                                           </a>
                                       </i>
                                       <b class="tip_word"><?php echo $v2->hotelTypeValue ?></b>
                                    </span>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hot_search_res clearfix">
                <span class="num_plass fl"><strong><?echo $results->data[0]->hotelCount?></strong>家酒店满足条件</span>

                <div class="fl clearfix">
                    <div class="term_wrap fl"></div>
                    <a href="javascript:;" class="clear_all_choice fl">清除全部</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>