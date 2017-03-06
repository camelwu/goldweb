<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/flight/flight.css" />
<link rel="stylesheet" href="<?php echo $this->config->item("resources_url")?>/resources/css/index/ticket_tab.css" />
<div banner-index search-index input-prompt style="display: none">
    <div class="search_index_box pa">
        <div class="search_font pa">
            <h3>国际·港澳台机票</h3>
            <div class="type">
                航程类型<span data-routeType ="oneway" class="tab_oneway"><i class="tab_way curs"></i>单程</span><span data-routeType ="return" class="tab_route"><i class="tab_way"></i>往返</span>
            </div>
            <div class="search_tab">
                <div class="tab_font" id="tab1">
                    <!--城市-->
                    <div class="city clearfix" id="ui-datepicker">
                        <p class="fl leave_city">
                            <input id="city" class="public cityCodeFrom" type="text" placeholder="选择出发城市" value="北京" data-code="BJS" data-name="北京" readonly>
                        </p>
                        <i class="icon_center icon_city"></i>
                        <p class="fl arrive_city">
                            <input id="city2" class="public cityCodeTo" type="text" placeholder="选择到达城市" value="新加坡" data-code="SIN"  data-name="新加坡" readonly>
                        </p>
                    </div>
                    <!--日期-->
                    <div class="date clearfix">
                        <p class="fl pr">
                            <i class="icon_date"></i>
                            <input id="startdate" class="public departDate" type="text" placeholder="选择出发日期" readonly="readonly" date-full-value="2016-08-07" value=" " >
                        </p>
                        <i class="icon_center"></i>
                        <p class="fl pr">
                            <i class="icon_date"></i>
                            <input id="readonly" class="public" type="text" placeholder="YYYY-MM-DD" date-full-value="2016-08-11"  readonly>
                            <input id="enddate" class="public returnDate" type="text" placeholder="选择返回日期" readonly="readonly" date-full-value="2016-08-11" value=" "  style="display: none;">
                        </p>
                    </div>
                    <!--成人，儿童，仓位-->
                    <div class="attr clearfix">
                        <p class="adult">成人</p>
                        <p class="child">儿童</p>
                        <p class="position">舱位等级</p>
                    </div>
                    <div class="num clearfix" select-div>
                        <div class="select_unit fl">
                            <p class="select_btn"><span id="numofAdult">1</span><i></i></p>
                            <ul class="select_ul">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                            </ul>
                        </div>
                        <div class="select_unit fl">
                            <p class="select_btn"><span id="numofChild">0</span><i></i></p>
                            <ul class="select_ul">
                                <li>0</li>
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                            </ul>
                        </div>
                        <div class="select_unit select_last fl">
                            <p class="select_btn"><span data-type="eonomy" class="cabinClass">经济舱</span><i></i></p>
                            <ul class="select_ul">
                                <li data-type="eonomy">经济舱</li>
                                <li data-type="economyPremium">超级经济舱</li>
                                <li data-type="business">商务舱</li>
                                <li data-type="first">头等舱</li>
                            </ul>
                        </div>
                    </div>
                    <div class="button clearfix">
                        <a href="javascript:;" class="search_button" id="flight_search" data-way="0">搜索</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>