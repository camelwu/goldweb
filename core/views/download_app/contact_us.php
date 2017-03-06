<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="resources/css/normalize.css">
    <link rel="stylesheet" href="resources/css/module_global.css">
    <link rel="stylesheet" href="resources/css/module_reset.css">
    <link rel="stylesheet" href="resources/css/module_base.css">
    <link rel="stylesheet" href="resources/css/footer/css/index.css">
    <link rel="stylesheet" href="resources/css/nav/css/index.css">
    <link rel="stylesheet" href="resources/css/nav/css/indexex.css">
    <link rel="stylesheet" href="resources/css/contact_us.css">
</head>
<body id="mainbody">
    <!--header区域-->
    <?php echo $header; ?>
    <!--内容区域-->
    <div module-css-reset module-css-base  module-css-conctact>
        <div class="banner_png">
            <h1>成为我们的合作伙伴</h1>
        </div>
        <div class="input-zone">
            <h3>酒店登记</h3>
            <form action="http://fp1.formmail.com/cgi-bin/fm192" name="contact_form" id="contact_form" method = "post" onsubmit="return validate_form(this);">
                <input type="hidden" name="_pid" value="113709">
                <input type="hidden" name="_fid" value="FJ1UKPU3">
                <input type="hidden" name="redirect" value="http://www.Asiatravel.com/success.html">
                <input type="hidden" name="recipient" value="95">
                <input type="hidden" name="subject" value="cn.asiatravel.com - 成为我们的酒店合作伙伴">
                <input type="hidden" name="required" value="">
                <input type="hidden" name="print_config" value="email,subject">
                <input type="hidden" name="missing_fields_redirect" value="http://www.Asiatravel.com/error/error.html">
                <div class="role">
                    <h4 class="title_item">商业信息</h4>
                    <div class="clearfix">
                        <div class="role_sub">
                            <label for="LegalPropertyName"><span>*</span>酒店名称：</label><input id="LegalPropertyName" class="I" name="LegalPropertyName" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="TradingName">交易名称：</label><input id="TradingName" name="TradingName" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="BusinessAddress">公司地址：</label><input id="BusinessAddress" name="BusinessAddress" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="SalesOfficeAddress">销售办事处：</label><input id="SalesOfficeAddress" name="SalesOfficeAddress" type="text" />
                        </div>
                    </div>
                </div>
                <div class="role">
                    <h4 class="title_item">酒店信息</h4>
                    <div class="clearfix">
                        <div class="role_sub">
                            <label for="StarRating">星级：</label><input id="StarRating" name="StarRating" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="PropertyType">酒店类型：</label><input id="PropertyType" name="PropertyType" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="ChainAffiliation">连锁所属：</label><input id="ChainAffiliation" name="ChainAffiliation" type="text" />
                        </div>
                        <div class="role_sub">
                            <label for="NumberofRooms">房间数量：</label><input id="NumberofRooms" name="NumberofRooms" type="text" />
                        </div>
                        <div class="role_sub last">
                            <label for="OfficialWebsite">官方网站：</label><input id="OfficialWebsite" class="big" name="OfficialWebsite" type="text" />
                        </div>
                    </div>
                </div>
                <div class="role s_role">
                    <h4 class="title_item">联系信息</h4>
                    <div class="sub_role">
                        <h5 class="">A销售/市场联系方式</h5>
                        <div class="sub_rol clearfix">
                            <div class="role_sub">
                                <label for="SalesMarketingContactName"><span>*</span>联系人姓名：</label><input id="SalesMarketingContactName" class="I" name="SalesMarketingContactName" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="SalesMarketingDesignation">称号：</label><input id="SalesMarketingDesignation" name="SalesMarketingDesignation" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="SalesMarketingTelephone"><span>*</span>联系电话：</label><input id="SalesMarketingTelephone"class="I" name="SalesMarketingTelephone" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="SalesMarketingFax">传真：</label><input id="SalesMarketingFax" name="SalesMarketingFax" type="text" />
                            </div>
                            <div class="role_sub last">
                                <label for="email"><span>*</span>邮件：</label><input id="email" name="email" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="sub_role">
                        <h5 class="">B预定联系方式</h5>
                        <div class="sub_rol clearfix">
                            <div class="role_sub">
                                <label for="ReservationContactName">联系人姓名：</label><input id="ReservationContactName" name="ReservationContactName" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="ReservationDesignation">称号：</label><input id="ReservationDesignation" name="ReservationDesignation" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="ReservationTelephone">联系电话：</label><input id="ReservationTelephone" name="ReservationTelephone" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="ReservationFax">传真：</label><input id="ReservationFax" name="ReservationFax" type="text" />
                            </div>
                            <div class="role_sub last">
                                <label for="ReservationEmail">邮件：</label><input id="ReservationEmail"  name="ReservationEmail" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="sub_role ">
                        <h5 class="">C客户联系方式</h5>
                        <div class="sub_rol clearfix" style="padding-bottom: 0">
                            <div class="role_sub">
                                <label for="AccountsContactName">联系人姓名：</label><input id="AccountsContactName" name="AccountsContactName" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="AccountsDesignation">称号：</label><input id="AccountsDesignation" name="AccountsDesignation" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="AccountsTelephone">联系电话：</label><input id="AccountsTelephone" name="AccountsTelephone" type="text" />
                            </div>
                            <div class="role_sub">
                                <label for="AccountsFax">传真：</label><input id="AccountsFax" name="AccountsFax" type="text" />
                            </div>
                            <div class="role_sub last">
                                <label for="AccountsEmail">邮件：</label><input id="AccountsEmail" name="AccountsEmail" type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <p class="word_tip">
                    <span>*</span>填写完此申请表并成功提交后，我们的合同代表人员将与您取得联系，给您提供一份酒店加盟协议和酒店和客房功能汇总，并与您协商价格细节。非常感谢，我们期待与您合作。
                </p>
                <div class="button_zone">
                    <input type="submit" class="submit" value="发送" />
                    <input type="reset" class="reset" value="重置" />
                </div>
            </form>
        </div>
        <div class="detail_word_outer">
            <div class="detail_sub">
                <br>
                <h3 style="color:#000;">关于我们</h3>
                <p>Asiatravel.com是亚洲领先的在线旅行公司，提供全球范围内800万个旅行产品。它的在线预订全包套餐以其即时确认、额外节省和方便的特征强烈地吸引着旅游者。 以套餐的价格提供全部旅行服务的能力使其在在线旅行行业占据独特的地位。</p>
                <p>Asiatravel.com通过13种主要语言的网站为旅客提供服务，分布在亚洲、中东和欧洲的19间办公室提供7天24小时的客户服务。凭借其全面的实地经验、供应商关系、专有系统和操作知识，Asiatravel.com获得了消费者和合作伙伴的一致好评，并一直保持可靠、诚信和正直的旅游品牌。最近获得的由TTG颁发的2015年亚太地区旅行大奖是其连续3年获得此奖项。</p>
                <p>Asiatravel.com成立于1995年，2001年于新加坡证券交易所上市。最新成立的B2B部门TAcentre.com 和 Savio-Staff-Travel分别为旅行行业和企业部门提供服务。请登录<a href="http://www.asiatravel.com" target="_blank">www.asiatravel.com</a>获取更多信息。</p>
                <h3 style="color:#000;">为什么要成为Atrip.com的合作伙伴?</h3>
                <p class="fs16" style="color:#0099FF;">I.&nbsp; 灵活的客人付款选择</p>
                <p>我们的网站提供2种付款方式:-</p>
                <ol class="list">
                    <li><i>1</i><span>前台付款</span> - 酒店合作伙伴制定房价，客人到酒店登记入住时付款。</li>
                    <li><i>2</i><span>预付费</span> - 酒店合作伙伴制定房价，客人入住前全额付费给Asiatravel.com。</li>
                </ol>
                <p class="fs16" style="color:#0099FF;">II.&nbsp; 多渠道分销</p>
                <p>您的酒店将出现在我们的各种分销渠道:-</p>
                <ol class="list">
                    <li><i>1</i>B2C网站</li>
                    <li><i>2</i>B2B预订引擎</li>
                    <li><i>3</i>附属/联合品牌网站</li>
                    <li><i>4</i>当地营销活动 -线上营销，如信用卡绑定、有线电视频道广告或印刷媒体、当地广告、零售网点和大型展览</li>
                </ol>
                <p class="fs16" style="color:#0099FF;">III.&nbsp; 本地客户服务和销售支持</p>
                <p>我们横跨亚洲、中东和欧洲的19家办事处的当地销售支持团队确保您多元化的商业机会充分发挥和赚取最大的利润。</p>
                <p class="fs16" style="color:#0099FF;">IV.&nbsp; 值得信赖的旅行和酒店住宿服务提供商</p>
                <p>我们拥有超过20年的行业经验，一直是很多酒店、旅游经营者和航空公司值得信赖的合作伙伴。我们大部分的顾客都是回头客，多年来一直使用Asiatravel.com满足其旅行需求。因此您可以放心我们承诺给您的最大的客户群曝光率。</p>
                <p>凭借可靠、诚意和诚信，Asiatravel已经成为一个公认的旅游品牌，赢得了消费者和合作伙伴的一致好评，并赢得了2013年、2014和2015年TTG亚太最佳在线旅行机构的殊荣。</p>
            </div>
        </div>
    </div>
    <!--footer区域-->
    <?php echo $footer; ?>
    <?php echo $form; ?>
</body>
<script type="text/javascript">
    function validate_LegalPropertyName(field,alerttxt)
    {
        with (field)
        {
            if (value == "")
            {alert(alerttxt);return false}
            else {return true}
        }
    }
    function validate_SalesMarketingContactName(field,alerttxt)
    {
        with (field)
        {
            if (value == "")
            {alert(alerttxt);return false}
            else {return true}
        }
    }
    function validate_SalesMarketingTelephone(field,alerttxt)
    {
        with (field)
        {
            if (!/\d{1,}$/.test(value))
            {alert(alerttxt);return false}
            else {return true}
        }
    }
    function validate_email(field,alerttxt)
    {
        with (field)
        {
            if (!/^(\w-*_*\.*)+@(\w-?)+(\.\w{2,})+$/.test(value))
            {alert(alerttxt);return false}
            else {return true}
        }
    }
    function validate_form(thisform)
    {
        with (thisform)
        {
            if (validate_LegalPropertyName(LegalPropertyName,"Not a legal name of the hotel!")==false)
            {LegalPropertyName.focus();return false}
            if (validate_SalesMarketingContactName(SalesMarketingContactName,"Not a legal name for contact !")==false)
            {SalesMarketingContactName.focus();return false}
            if (validate_SalesMarketingTelephone(SalesMarketingTelephone,"Not a valid telephone number!")==false)
            {SalesMarketingTelephone.focus();return false}
            if (validate_email(email,"Not a valid email address!")==false)
            {email.focus();return false}
        }
    }
</script>
</html>


