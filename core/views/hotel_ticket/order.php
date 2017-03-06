<?php
/**
 * Created by PhpStorm.
 * User: zhouwei
 * Date: 2016/8/29
 * Time: 23:32
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/jquery-ui-1.10.3.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/plugin/validate.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/hotel_ticket/order.css">
</head>
<body>
<div class="all" fill>
    <div class="shdow_circle">
        <img class="load_img order_bg"
             src="<?php echo $this->config->item('resources_url') ?>/resources/images/bg_loading.gif"/>
    </div>
    <!--topper  begin-->
    <?php echo $header; ?>

    <div class="contents">
        <form>
            <!--填写流程图  4个步骤  begin-->
            <div step-flow step-num3 step-fill>
                <div class="step_flow_img clearfix">
                    <i class="cur">1</i>
                    <span></span>
                    <i>2</i>
                    <span></span>
                    <i>3</i>
                </div>
                <div class="step_flow_word clearfix">
                    <p class="cur">信息填写</p>
                    <p class="pd">支付</p>
                    <p class="pd2">完成</p>
                </div>
            </div>
            <!--填写流程图  3个步骤  end-->

            <!--右侧导航+左侧   begin-->
            <div class="clearfix" container_rl order-mess>
                <!--左侧内容-->
                <div class="content fl">
                    <!--预订信息-->
                    <div reserve-info>
                        <div class="info_title">预订信息</div>
                        <h2><?php echo $PackageName ?></h2>
                        <ul class="info">
                            <li class="clearfix">
                                <div class="info_left">酒店</div>
                                <div class="info_right">
                                    <p><?php echo $hotelName ?></p>
                                    <p>
                                        入住 <?php echo formate_date($checkinDate, 'Y-m-d') ?>
                                        离店 <?php echo formate_date($checkoutDate, 'Y-m-d')?>
                                        共<?php echo $dayCount ?>晚
                                        <?php echo $roomCount ?>间房
                                        <?php echo $adultCount ?>成人
                                        <?php echo $childCount ?>儿童
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="info_left">景点</div>
                                <div class="info_right">
                                    <?php foreach($tours as $tour) {
                                        if($tour['travelDate'] !='undefinedT00:00:00'){
                                            echo '<p>' . $tour['tourName'] . '&nbsp;&nbsp;&nbsp;&nbsp; ' . formate_date($tour['travelDate'], 'Y-m-d') . '</p>';
                                        }
                                        else {
                                            echo '<p>' . $tour['tourName']  . '</p>';
                                        }
                                    } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--出游人信息-->
                    <div person_info>
                        <div class="info_title">出游人信息<span><?php echo $adultCount ?>成人 <?php echo $childCount ?>儿童</span></div>
                        <?php echo $userlist_html ?>
                        <?php echo $add_user_html ?>
                    </div>
                    <!--联系方式-->
                    <div contact_info>
                        <div class="info_title">
                            联系方式
                            <span>
                                <i class="icon" checkbox-icon>
                                    <a href="javascript:void(0);" class="checkbox_icon">
                                        <input type="checkbox">
                                    </a>
                                </i>
                                与第一出游人相同
                            </span>
                        </div>
                        <ul class="contact_ul clearfix" input-prompt>
                            <li class="clearfix">
                                <div class="label fl">姓</div>
                                <div class="fl">
                                    <input type="text" name="contact_last_name" class="public short_input" placeholder="如Li">
                                </div>
                                <div class="center_label fl">名</div>
                                <div class="fl">
                                    <input type="text" name="contact_first_name" class="public short_input" placeholder="如Shimin">
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="label fl">国籍</div>
                                <div class="fl" select-div>
                                    <div class="select_unit nationality_select">
                                        <p class="select_btn">
                                            <span>中国</span>
                                            <i></i>
                                            <input type="hidden" name="contact_nationality" value="CN">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($countryData as $cv): ?>
                                                <li data-value='<?php echo $cv['countryCode'] ?>'><?php echo $cv['chineseName'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="label fl">手机号</div>
                                <div class="fl" select-div>
                                    <div class="select_unit nationality_select phone_code">
                                        <p class="select_btn">
                                            <span>+86</span>
                                            <i></i>
                                            <input type="hidden" name="phone_code" value="86">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($countryData as $cv): ?>
                                                <li data-value='<?php echo $cv['phoneCode'] ?>'>+<?php echo $cv['phoneCode'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="fl"><input type="text" name="contact_no" class="public phone" placeholder=""></div>
                            </li>
                            <li class="clearfix">
                                <div class="label fl">邮箱</div>
                                <div class="fl"><input type="text" class="public" name="email" placeholder=""></div>
                            </li>
                        </ul>
                    </div>
                    <!--航班接送信息-->
                    <div flight_info>
                        <div class="info_title">航班接送信息</div>
                        <ul class="flight_ul" input-prompt>
                            <li class="clearfix">
                                <div class="label fl">到达</div>
                                <div class="flight_num fl">
                                    <input type="text" class="public" name="arrival_flight_no" placeholder="输入到达的航班号">
                                </div>
                                <div class="flight_date fl">
                                    <input type="text" class="public checkindata" name="arrive_date" value="<?php echo substr($checkinDate, 0, 10) ?>" readonly>
                                </div>
                                <div class="flight_hour fl" select-div>
                                    <div class="select_unit">
                                        <p class="select_btn">
                                            <span>12h</span>
                                            <i></i>
                                            <input type="hidden" name="arrive_hour" value="12">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($hourArray as $cv): ?>
                                                <li data-value='<?php echo $cv ?>'><?php echo $cv ?>h</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flight_minute fl" select-div>
                                    <div class="select_unit">
                                        <p class="select_btn">
                                            <span>35m</span>
                                            <i></i>
                                            <input type="hidden" name="arrive_minute" value="35">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($minuteArray as $cv): ?>
                                                <li data-value='<?php echo $cv ?>'><?php echo $cv ?>m</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="label fl">离开</div>
                                <div class="flight_num fl">
                                    <input type="text" class="public" name="leave_flight_no" placeholder="输入离开的航班号">
                                </div>
                                <div class="flight_date fl">
                                    <input type="text" class="public arrivedata" name="leave_date" value="<?php echo substr($checkoutDate, 0, 10) ?>" readonly>
                                </div>
                                <div class="flight_hour fl" select-div>
                                    <div class="select_unit">
                                        <p class="select_btn">
                                            <span>12h</span>
                                            <i></i>
                                            <input type="hidden" name="leave_hour" value="12">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($hourArray as $cv): ?>
                                                <li data-value='<?php echo $cv ?>'><?php echo $cv ?>h</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flight_minute fl" select-div>
                                    <div class="select_unit">
                                        <p class="select_btn">
                                            <span>35m</span>
                                            <i></i>
                                            <input type="hidden" name="leave_minute" value="35">
                                        </p>
                                        <ul class="select_ul">
                                            <?php foreach ($minuteArray as $cv): ?>
                                                <li data-value='<?php echo $cv ?>'><?php echo $cv ?>m</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix read_treaty">
                                <div class="label fl">&nbsp;</div>
                                <div class="fl">
                                    <i class="icon" checkbox-icon>
                                        <a href="javascript:void(0);" class="checkbox_icon">
                                            <input type="checkbox" name="agree">
                                        </a>
                                    </i>
                                    我已阅读并接受<a href="javascript:void(0);"class = "agree">亚程服务协议条款</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--下一步,去支付-->
                    <div class="next_btn" btn-default>
                        <p class="next btn1_hover" id="next_btn">下一步，去支付</p>
                    </div>
                </div>
                <!--右侧导航-->
                <div class="contain_screen_r fr" cost_detail>
                    <!--费用明细-->
                    <div class="border">
                        <div class="detail_title">费用明细</div>
                        <!--景点-->
                        <div class="detail_item clearfix">
                            <i class="hotel_icon"></i>
                            <div>
                                <p><?php echo $PackageName ?></p>
                            </div>
                        </div>
                        <!--酒店-->
                        <div class="detail_item clearfix">
                            <i class="spot_icon"></i>
                            <div>
                                <p><?php echo $hotelName ?></p>
                                <p><?php echo $roomName ?></p>
                                <p>入住: <?php echo $roomCount ?>间/<?php echo $dayCount ?>晚</p>
                            </div>
                        </div>
                        <ul class="person_list">
                            <li class="clearfix">
                                <div class="person_type">成人</div>
                                <div class="person_price">￥<?php echo $adultPrice ?> * <?php echo $adultCount ?>人</div>
                            </li>
                            <li class="clearfix">
                                <div class="person_type">儿童</div>
                                <div class="person_price">￥<?php echo $childPrice ?> * <?php echo $childCount ?>人</div>
                            </li>
                        </ul>
                        <div class="pay clearfix">
                            <span>应付总金额:</span>
                            <span class="money">￥<span><?php echo $totalPrice ?></span></span>
                            <div btn-default class="pay_btn"><p class="btn btn1_hover cur" id="next_btn2">去支付</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--右侧导航+左侧   end-->
    </div>
    <!--topper  begin-->
    <?php echo $footer; ?>

    <!--弹框-->
    <div class="reg_pop_box"data-pop="reg_pop" reg_pop>
        <p class="reg_pop_bg"></p>
        <div class="reg_pop">
            <div class="reg_tit">亚程用户服务协议<i></i></div>
            <div class="reg_content">
                <h3>《 亚程用户服务协议 》</h3>
                <div class="reg_font">
                    <p>亚程旅游网（www.atrip.com）所提供的各项服务和内容的所有权和运作权均归北京畅旅科技有限公司及其关联公司（以下简称“亚旅”）所有。如果您在本网站、亚旅关联公司网站或其他亚旅提供的移动应用或软件上访问、预定或使用我们的产品或服务（以上统称为“服务”），即表示您同意并接受了以下服务协议，请仔细阅读以下内容。如果您不同意以下任何内容，请立刻停止访问本网站或使用本网站服务。</p>
                    <br/>
                    <p>一、协议总则</p>
                    <p>1.本协议内容包括协议正文、亚旅子频道各单项服务协议及其他亚旅已经发布的或将来可能发布的各类规则，包括但不限于 隐私政策、 免责声明、 知识产权声明、 权利声明、 旅游度假预订须知、 亚旅用户协议、 亚旅个人账户协议等其他协议（“其他条款”）。如果本协议与“其他条款”有不一致之处，则以“其他条款”为准。</p>
                    <br/>
                    <p>2.亚旅有权根据需要不时地制订、修改本协议及/或各类规则向用户提供基于互联网以及移动网的相关服务，并在本页面及其相应页面进行公布，但不再另行通知您，您应该定期登陆本页面及其他相关页面，了解最新的协议内容。变更后的协议和规则一经在本页面及相关页面公布后，立即自动生效。如您不同意相关变更，应当立即停止访问亚旅或使用亚旅服务。若您继续使用亚旅服务的，即表示您同意并接受相关修订的协议和规则。</p>
                    <br/>
                    <p>3.若您作为亚旅的关联公司或合作公司的用户登陆亚旅平台，访问亚旅站或使用亚旅服务，即表示您同意并接受本协议的所有条款及亚旅公布的其他规则、说明和操作指引。</p>
                    <br/>
                    <p>二、用户权利</p>
                    <p>1您在使用亚旅服务时，必须遵守中华人民共和国相关法律法规的规定，您应同意将不会利用该服务进行任何违法或不正当的活动，包括但不限于下列行为:

                        1.1上载、展示、张贴、传播或以其它方式传送含有下列内容之一的信息：
                        1) 反对宪法所确定的基本原则的；
                        2) 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；
                        3) 损害国家荣誉和利益的；
                        4) 煽动民族仇恨、民族歧视、破坏民族团结的；
                        5) 破坏国家宗教政策，宣扬邪教和封建迷信的；
                        6) 散布谣言，扰乱社会秩序，破坏社会稳定的；
                        7) 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的
                        8) 侮辱或者诽谤他人，侵害他人合法权利的；
                        9) 含有虚假、有害、胁迫、侵害他人隐私、骚扰、侵害、中伤、粗俗、猥亵、或其它道德上令人反感的内容；
                        10) 含有中国法律、法规、规章、条例以及任何具有法律效力之规范所限制或禁止的其它内容的。

                        1.2为任何非法目的而使用网络服务系统。

                        1.3利用亚旅网络服务从事以下活动：
                        1) 未经允许，进入计算机信息网络或者使用计算机信息网络资源的； 未经允许，对计算机信息网络功能进行删除、修改或者增加的；未经允许，对进入计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加的；故意制作、传播计算机病毒等破坏性程序的；其他危害计算机信息网络安全的行为。
                        2)对亚旅网站上的任何数据作商业性利用，包括但不限于在未经亚旅事先书面同意的情况下，以复制、传播等任何方式使用亚旅网站上展示的资料。
                        3) 使用任何装置、软件或例行程序等其他方式干预或试图干预亚旅网站的正常运作或正在亚旅网站上进行的任何交易、活动，或采取任何将导致不合理的庞大数据负载加诸亚旅网络设备的行动。
                        4) 违反诚实信用原则的不正当竞争行为，或恶意下订单或虚假交易等其他恶意扰乱亚旅交易秩序的行为。
                        5) 与网上交易无关的其他行为。

                        2.对于您违反本服务协议，导致或产生的任何第三方主张的任何索赔、要求或损失，包括合理的律师费，您同意赔偿亚旅与合作公司，并使之免受损害。同时，亚旅有权视您的行为性质，采取包括但不限于删除您发布信息内容、暂停使用许可、终止服务、限制使用、回收亚旅账号、追究法律责任等措施，因亚旅采取上述合理措施给您造成的损失，亚旅不承担任何责任。对恶意注册亚旅账号或利用亚旅账号进行违法活动、捣乱、骚扰、欺骗其他用户以及其他违反本协议的行为，亚旅有权回收其账号。同时，亚旅会视司法部门的要求，协助调查。

                        3.您须对自己在使用亚旅网络服务过程中的行为承担法律责任，包括但不限于：对受到侵害者进行赔偿，以及在亚旅在先承担了因您的行为导致的行政处罚或侵权损害赔偿责任后，您应给予亚旅等额的赔偿。
                        四、服务的变更、中断或终止
                        1.您完全理解并同意，本服务涉及到互联网及移动通讯等服务，可能会受到各个环节不稳定因素的影响。因此任何因不可抗力、计算机病毒或黑客攻击、系统不稳定、用户所在位置、用户关机、GSM网络、互联网络、通信线路等其他亚旅无法预测或控制的原因，造成的服务中断、取消或终止的风险。您须自行承担以上风险，亚旅对服务之及时性、安全性、准确性不做任何保证。

                        2.亚旅需要定期或不定期地对提供网络服务的平台或相关的设备进行检修或者维护，如因此类情况而造成网络服务（包括收费网络服务）在合理时间内的中断，亚旅无需为此承担任何责任。亚旅保留不经事先通知为维修保养、升级或其它目的暂停全部或部分的网络服务的权利。

                        3.您完全理解并同意，除本服务协议另有规定外，鉴于网络服务的特殊性，亚旅有权随时变更、中断或终止部分或全部的网络服务，且无需通知您，也无需对您或任何第三方承担任何责任。</p>
                    <br/>
                    <p>二、知识产权和其他合法权益</p>
                    <p>1.知识产权权属

                        1.1对于您通过亚旅或其他亚旅移动终端而上传的任何在公开区域可获取的并受著作权保护的内容，用户应对该等内容的真实性、合法性负责，保证对该等内容拥有完整的、无瑕疵的所有权和知识产权或拥有完整的授权，并不存在任何侵犯第三方合法权益的情形，包括但不限于著作权、肖像权、商标权、专利权、企业名称权、商号权、商业秘密、个人隐私、合同权利等权利。所有因用户非法上传内容而给任何第三方或亚旅造成的损害均由用户个人承担全部的责任，亚旅不承担任何责任，且亚旅有义务配合第三方、司法机关或行政机关完成相关的取证，并根据法律、主管部门或司法部门的要求将用户注册信息给予披露。 对于您通过互联网或移动终端等设备访问亚旅及其关联公司网站时发表的任何形式的文字、图片等知识产权信息，您在此授权并同意将其著作财产权，包括并不限于：复制权、发行权、出租权、展览权、表演权、放映权、广播权、信息网络传播权、摄制权、改编权、翻译权、汇编权等，以及应当由著作权人享有的其他可转让权利，无偿独家转让给亚旅所有，许可亚旅有权利就任何主体侵权而单独提起诉讼，并获得全部赔偿。本协议已经构成《著作权法》第二十五条所规定的书面协议，其效力及于用户通过互联网或移动终端等设备访问亚旅发布的任何受著作权法保护的作品内容，无论该内容形成于本协议签订前还是本协议签订后。对于您提供的其他资料及数据信息，您授予亚旅及其关联公司独家的、全球通用的、永久的、免费的许可使用权利 (并有权在多个层面对该权利进行再授权)。此外，亚旅及其关联公司有权(全部或部份地) 使用、复制、修订、改写、发布、翻译、分发、执行和展示您的全部资料数据（包括但不限于注册资料、交易行为数据及全部展示于亚旅平台的各类信息）或制作其派生作品，并以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入亚旅作品内。

                        1.2用户浏览、复制、打印和传播亚旅其他用户上传到亚旅网站的内容，应保证仅用于个人欣赏之目的，不得用于商业目的，不得侵犯权利人的合法权益以及亚旅的合法权益和商业利益。任何用户违反此条规定的，亚旅均有权以自身名义利用法律手段寻求权利救济或据本协议追究您的违约责任。

                        2.亚旅专属权利

                        2.1除明显归属于合作伙伴、第三方所有的信息资料外，亚旅拥有网络服务内所有内容，包括但不限于文字、图片、图形、表格、动画、程序、软件等单独或组合的版权。任何被授权的浏览、复制、打印和传播属于本网站内的内容必须符合以下条件：
                        1) 所有的资料和图象均以获得信息为目的；
                        2) 所有的资料和图象均不得用于商业目的；
                        3) 所有的资料、图象及其任何部分都必须包括此版权声明。未经亚旅许可，任何人不得擅自，包括但不限于以非法的方式复制、传播、展示、镜像、上载、下载使用。否则，亚旅将依法追究法律责任。

                        2.2亚旅为提供网络服务而自行开发的软件，包括不限于无线客户端应用等，拥有完整的知识产权。亚旅在此授予您个人非独家、不可转让、可撤销的，并通过在一部拥有所有权或使用权的手机或计算机上使用亚旅软件的权利，且该使用仅限于个人非商业性使用之合法目的。

                        2.3亚旅有权对该等软件进行不时的修订、扩展、升级等更新措施，而无需提前通知用户，但您有权选择是否使用更新后的软件。

                        2.4您应当保证合法使用该等软件，任何用户不得对该等软件进行如下违法行为:
                        1) 开展反向工程、反向编译或反汇编，或以其他方式发现其原始编码，以及实施任何涉嫌侵害著作权等其他知识产权的行为；
                        2) 以出租、租赁、销售、转授权、分配或其他任何方式向第三方转让该等软件或利用该等软件为任何第三方提供相似服务；
                        3) 任何复制该等软件的行为；
                        4) 以移除、规避、破坏、损害或其他任何方式干扰该等软件的安全功能；
                        5) 以不正当手段取消该等软件上权利声明或权利通知的；
                        6) 其他违反法律规定的行为。

                        2.3“亚旅”、“亚程旅游网”、“yazhoulvyou.cn”、“atrip.com”和亚旅网络服务LOGO等为亚旅的注册商标，受法律的保护。任何用户不得侵犯亚旅的注册商标权。
                        六、其他
                        1.本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。
                        2.如双方就本协议内容或其执行发生任何争议，双方应尽量友好协商解决；协商不成时，任何一方均可向北京趣拿信息技术有限公司所在地的人民法院提起诉讼。
                        3.亚旅未行使或执行本服务协议任何权利或规定，不构成对前述权利或权利之放弃。
                        4.如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。 </p>
                    <br/>
                    <p>权利声明</p>
                    <p>亚旅尊重他人知识产权和合法权益，呼吁用户也要同样尊重知识产权和他人合法权益。若您认为您的知识产权或其他合法权益被侵犯，可以向亚旅发出权利声明。为有效处理您的投诉，请按照以下说明向亚旅提供资料:
                        1) 权利人对涉嫌侵权内容拥有知识产权或其他合法权益和/或依法可以行使知识产权或其他合法权益的权属证明；
                        2) 请充分、明确地描述被侵犯知识产权或其他合法权益的情况；
                        3) 请详细指明涉嫌侵权的哪些内容侵犯了2）中列明的权利；
                        4) 请提供权利人具体的联络信息，包括姓名、身份证或护照复印件（对自然人）、单位登记证明复印件（对单位）、通信地址、联系人、电话号码、传真和电子邮件；
                        5) 请提供涉嫌侵权内容在网络服务上的位置（如指明您举报的含有侵权内容的出处，即：指网页地址及网页内的位置）以便我们与您举报的含有侵权内容的网页的所有权人或管理人联系；
                        6) 请在权利声明中加入如下关于通知内容真实性的声明：“我保证，本通知中所述信息是充分、真实、准确的，如果本权利声明内容不完全属实，本人将承担由此产生的一切法律责任”。
                        您可以通过如下联络方式同亚旅联系：
                        北京市朝阳区五里桥一街1号32号楼
                        北京畅旅科技有限公司 法务部
                        邮政编码：100024
                        一旦收到符合上述要求之通知，亚旅将采取相应措施（包括删除）；如不符合上述条件，亚旅会请您提供相应信息，且暂不采取措施。
                        亚旅提请您注意：如果您的权利声明的陈述失实，您将承担对由此造成的全部法律责任（包括但不限于赔偿各种费用及律师费）。如果您不确定网络上可获取的资料是否侵犯了您的知识产权和其他合法权益，亚旅建议您首先咨询专业人士。</p>

                    <p>权利声明</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loading-div" style="display: none;">
    <img src="../../../resources/images/ico_loading.gif" alt="">
</div>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/assembly.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/vlm.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/calendar_v1.0.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/plugin/jquery.validate-1.13.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/lib/jquery-ui-1.10.3.datepicker-zh-cn.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('resources_url') ?>/resources/js/hotel_ticket/order.js"></script>
</body>
</html>
