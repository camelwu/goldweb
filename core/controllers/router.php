<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$optype = "1";
$perpage = 8;
$q = $_GET['q'];
$page = isset($_GET['page'])?$_GET['page']:1;
$start = ($page -1) * $perpage;
/*-------------------------------------------------------------*/

/*if ($bid)
	$sqlwhere = " where bid=$bid and locate('1',op_type)";
	else*/
$sqlwhere = " where 1=1 and locate('1',op_type)";
/*根据栏目enname判断*/
switch($enname){
	case "tours"://线路
		$classid=112;

		if (empty ($id)) {//list
			$smarty->assign('data',wx_route($perpage,$optype,$classid,0,$start));
			$sqladd = " where 1=1 and locate('1',optype)";
			if($optype!=='1')
				$sqladd .= " and locate('" . $optype . "',optype)";
			if ($classid)
				$sqladd .= " and classid=" . $classid;
			if ($classid2)
				$sqladd .= " and classid2=" . $classid2;

				$orderbysql = ' order by hid desc';
			$sqlfrom = "from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id) result";
			$sql = "select * " . $sqlfrom . $sqladd . $orderbysql . $limitsql;

			$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqladd), 0); //总数;
			$pagecount = ceil($totalnum/8); //页数
			$smarty->assign('pagecount',$pagecount);
			$smarty->assign('totalnum',$totalnum);
			$smarty->assign('classid',$classid);
			$smarty->assign('cnname','出境游');$smarty->assign('cnword','美丽的线路');
			$smarty->display(V_ROOT.'./'.$template.'/tour.html',$cache_id);exit;
		}else{
			$sqlfrom = "from (select p.*,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid as bid2 from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id=$id) result";
			$info = $db->getOneInfo("select * ".$sqlfrom);
			if (!empty ($info)) {
				$info['go_time'] = go_tim($info['go_type'],$info['go_time']);
				$info['ro_type'] = strpos($info['ro_type'],',')?explode(',',$info['ro_type']):$info['ro_type'];
				$info['addr'] = strpos($info['addr'],',')?explode(',',$info['addr']):$info['addr'];
				$info['tim'] = strpos($info['tim'],',')?explode(',',$info['tim']):$info['tim'];
				$query = $db->query("select title,url from cg_product_route_do where id=".$id." and ctype=1 and url is not Null and url!='' order by hid asc");
				while ($data = $db->fetch_array($query)) {
					$pic[] = $data;
				}
				$smarty->assign('pic', $pic);
				//day
				$query = $db->query("select * from cg_product_route_stroke where routeid=".$id." order by num asc limit ".$info['go_day']);
				while ($data = $db->fetch_array($query)) {
					$data['eats'] = go_eat($data['eats']);
					$data['scenics'] = go_sight($data['scenic']);
					$day[] = $data;
				}
				$smarty->assign('stroke', $day);
			}else{
				$smarty->assign('error', "请正确访问！");
			}
			$smarty->assign('info', $info);
			$smarty->display(V_ROOT.'./'.$template.'/details.html',$cache_id);exit;
		}
	break;
	case "free"://自由行
		$classid=117;

		if (empty ($id)) {
			$smarty->assign('data',wx_route($perpage,$optype,$classid,0,$start));
			$sqladd = " where 1=1 and locate('1',optype)";
			if($optype!=='1')
				$sqladd .= " and locate('" . $optype . "',optype)";
			if ($classid)
				$sqladd .= " and classid=" . $classid;
			if ($classid2)
				$sqladd .= " and classid2=" . $classid2;

				$orderbysql = ' order by hid desc';
			$sqlfrom = "from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.url is not Null and p.id) result";
			$sql = "select * " . $sqlfrom . $sqladd . $orderbysql . $limitsql;

			$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqladd), 0); //总数;
			$pagecount = ceil($totalnum/8); //页数
			$smarty->assign('pagecount',$pagecount);
			$smarty->assign('totalnum',$totalnum);
			$smarty->assign('classid',$classid);
			$smarty->assign('cnname','自由行');$smarty->assign('cnword','牛人的线路');
			$smarty->display(V_ROOT.'./'.$template.'/tour.html',$cache_id);exit;
		}else{
			$sqlfrom = "from (select p.*,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid as bid2 from cg_product_route_sale t,cg_product_route p where t.id=p.id and p.id=$id) result";
			$info = $db->getOneInfo("select * ".$sqlfrom);
			if (!empty ($info)) {
				$info['go_time'] = go_tim($info['go_type'],$info['go_time']);
				$info['ro_type'] = strpos($info['ro_type'],',')?explode(',',$info['ro_type']):$info['ro_type'];
				$info['addr'] = strpos($info['addr'],',')?explode(',',$info['addr']):$info['addr'];
				$info['tim'] = strpos($info['tim'],',')?explode(',',$info['tim']):$info['tim'];
				$query = $db->query("select title,url from cg_product_route_do where id=".$id." and ctype=1 and url is not Null and url!='' order by hid asc");
				while ($data = $db->fetch_array($query)) {
					$pic[] = $data;
				}
				$smarty->assign('pic', $pic);
				//day
				$query = $db->query("select * from cg_product_route_stroke where routeid=".$id." order by num asc limit ".$info['go_day']);
				while ($data = $db->fetch_array($query)) {
					$data['eats'] = go_eat($data['eats']);
					$data['scenics'] = go_sight($data['scenic']);
					$day[] = $data;
				}
				$smarty->assign('stroke', $day);
			}else{
				$smarty->assign('error', "请正确访问！");
			}
			$smarty->assign('info', $info);
			$smarty->display(V_ROOT.'./'.$template.'/details.html',$cache_id);exit;
		}
	break;
	case "visa"://签证
		$sqlfrom = "from cg_scenic";
		$types = 2;

		if (empty ($id)){
			$area = array();
			$query = $db->query("select title,hots from cg_class where classtype=5 and pid=0 order by hots limit 8");
			while ($row = $db->fetch_array($query)) {

				$cid = (int)$row['hots']+1;
				$sql = "select t.aid as id,p.title from cg_area p,cg_scenic t where t.types=2 and t.cid=$cid and p.id=t.aid group by t.aid ";
				$query1 = $db->query($sql);
				$res = array();

				while ($val = $db->fetch_array($query1)) {
					$res[] = $val;
				}

				if(count($res)){$stat[] = $row['title'];$area[] = $res;}
			}
			$smarty->assign('stat', $stat);
			$smarty->assign('area', $area);
		}else{
			$sql = "select title from cg_area where id=" . $id;
			$country = $db->getOneInfo($sql);
			$smarty->assign('country',$country);

			$sqlwhere = " where 1=1 and locate('$optype',op_type)";
			$sqladd = " and types=$types";
			$sqldataid = " and aid=$id";
			$orderbysql = ' order by id desc,hots desc';
			$sqlstr = "select * ".$sqlfrom. $sqlwhere. $sqladd. $sqldataid . $orderbysql;
			$query = $db->query($sqlstr);
			$data = array();
			while ($row = $db->fetch_array($query)) {
				if($row['ctype']){
					$val = $db->getOneInfo("select title from cg_class where id=" . $row['ctype']);
					$row['tname'] = $val['title'];
				}else{
					$row['tname'] = '';
				}
				$data[] = $row;
			}
			$smarty->assign('data',$data);
		}
	break;
	case "scenic"://门票
		$sqlfrom = "from cg_scenic";
		$types = 3;
		if (empty ($id)){
			$smarty->assign('data',wx_product($perpage,$optype,$types,0,0,$start));

			$sqladd = " and types=$types";
			$sqldataid = '';
			$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqlwhere. $sqladd. $sqldataid), 0); //总数;
			$pagecount = ceil($totalnum/8); //页数
			$smarty->assign('pagecount',$pagecount);
			$smarty->assign('totalnum',$totalnum);
		}else{
			$sqlstr = "select * $sqlfrom where id=" . $id;
			$info = $db->getOneInfo($sqlstr);
			if (!empty ($info)) {
				$query = $db->query("select title,url from cg_hotel where id=".$id." and ctype=1 and url is not Null and url!='' order by hid asc");
				while ($data = $db->fetch_array($query)) {
					$pic[] = $data;
				}
				$smarty->assign('pic', $pic);
			}else{
				$smarty->assign('error', "请正确访问！");
			}
			$smarty->assign('product', 'product');
			$smarty->assign('info', $info);
			$smarty->display(V_ROOT.'./'.$template.'/details.html',$cache_id);exit;
		}
	break;
	case "blog"://攻略
		$sqlfrom = "from cg_scenic";$types = 5;
		if (empty ($id)){
			$smarty->assign('news',wx_product($perpage,$optype,$types,98,0,$start));

			$sqladd = " and types=$types";
			$sqldataid = ' and ctype=98';
			$totalnum = $db->result($db->query("select count(*) " . $sqlfrom. $sqlwhere. $sqladd. $sqldataid), 0); //总数;
			$pagecount = ceil($totalnum/8); //页数
			$smarty->assign('pagecount',$pagecount);
			$smarty->assign('totalnum',$totalnum);
		}else{
			$sqlstr = "select * $sqlfrom where id=" . $id;
			$info = $db->getOneInfo($sqlstr);
			if (!empty ($info)) {
				$smarty->assign('info', $info);
			}else{
				$smarty->assign('info', '');$smarty->assign('error', "请正确访问！");
			}
			$smarty->assign('product', 'blog');

			$smarty->display(V_ROOT.'./'.$template.'/blog-detail.html',$cache_id);exit;
		}
	break;
	case "about"://介绍
		if($_SERVER['REQUEST_METHOD']=="POST"){
			if(empty($_POST['contactNameField'])||empty($_POST['contactEmailField'])||empty($_POST['contactMessageTextarea'])){//anyone is empty
				echo "信息输入不全，请输入！";
			}else{
				if(!i_isEmail($_POST['contactEmailField'])){
					echo "请输入可用的Email！";
				}else{
					$name = $_POST['contactNameField'];
					$emails = $_POST['contactEmailField'];
					$content = $_POST['contactMessageTextarea'];
					$subject = "用户留言";
					echo sendmail2($emails,$subject,$content,$name);
				}
			}


		}
	break;
	case "user"://用户
		if (isset($_SESSION['user'])) {//had login
			$smarty->display(V_ROOT.'./'.$template.'/'.$enname.'.html',$cache_id);
		}else{
			$smarty->display(V_ROOT.'./'.$template.'/login.html',$cache_id);
		}
	break;
	case "sigin":
		$smarty->display(V_ROOT.'./'.$template.'/sigin.html',$cache_id);
	break;
	case "forgot":
		$smarty->display(V_ROOT.'./'.$template.'/forgot.html',$cache_id);
	break;
	case "cart"://购物
		if (empty ($id)) {

		}else{

		}
	break;
	default://默认，首页？
		$enname = 'index';
		//当季最热
		$smarty->assign('hots',wx_route(6,"2"));
		//自由行
		$smarty->assign('cjfree',wx_route(6,"3",117));
		//专题
		$smarty->assign('project',$cjline);
		//游记
		$smarty->assign('news',wx_product(8,"3",5,98));
		//门票
		$smarty->assign('scenic',sel_product(8,"3",3));
	break;
}

$smarty->display(V_ROOT.'./'.$template.'/'.$enname.'.html',$cache_id);
/*
*function list
*/
function sel_detail($from="",$id=0){
	global $db, $picserver, $siteurl, $bid;
	if($from===""||$id===0){return "";}


}
/*
 *获取出团时间
*/
function go_tim($t,$v){
	switch ($t){
	case 0:
		return "每天发团";
		break;
	case 1:
		return "每周".$v;
		break;
	case 2:
		return "每月".$v;
		break;
	default:
		return $v;
		break;
	}
}
/*
 *获取每日餐饮
*/
function go_eat($v){
	if(empty($v)||$v===''){
		return '无餐';
	}else{
		$go_eat = '';
		if(strpos($v,'1')>-1){
			$go_eat .= '含早餐 ';
		}else{
			$go_eat .= '早餐请自理 ';
		}
		if(strpos($v,'2')){
			$go_eat .= '含午餐 ';
		}else{
			$go_eat .= '午餐请自理 ';
		}
		if(strpos($v,'3')){
			$go_eat .= '含晚餐 ';
		}else{
			$go_eat .= '晚餐请自理 ';
		}
		return $go_eat;
	}
}
/*城市 查询 酒店、餐厅、景点、新闻等*/
function go_sight($c = '',$types = 3) {
	global $db;
	if(empty($c)) return '';
	if(strpos($c,"'")) $c = str_replace("'","",$c);
	if(preg_replace("/([u4e00-u9fa5])/","",$c)) return $c;
	$sqlstr = "select id,title,url from cg_scenic where types=$types and id in($c)";

	$query = $db->query($sqlstr);
	$res = array ();
	while ($row = $db->fetch_array($query)) {
		$res[$row['id']] = $row['title'];
	}
	return $res;
}
/*
 * 获取产品数据
 * */
function wx_product($count, $optype = "1", $types = 0, $ctype = 0, $ctype1 = 0, $start = 0) {
	global $db, $picserver, $siteurl, $bid;
	;
	/*if ($bid)
		$sqlwhere = " where bid=$bid and locate('1',op_type)";
	else*/
		$sqlwhere = " where locate('1',op_type)";
	if ($types == 0 || !empty ($types)) {
		$sqlwhere .= " and types=" . $types;
	}
	if ($ctype) {
		$sqlwhere .= ' and ctype=' . $ctype;
	}
	if ($ctype1) {
		$sqlwhere .= ' and ctype1=' . $ctype1;
	}
	if (!empty($optype)&&"1"!==$optype) {
		$sqlwhere .= " and locate('" . $optype . "',op_type)";
	}
	if ($count == 1)
		$orderbysql = ' order by rand()';
	else
		$orderbysql = ' order by id desc';
	if ($count)
		$limitsql = ' limit '.$start.','.$count;

	$sql = "select * from cg_scenic" . $sqlwhere . $orderbysql . $limitsql;
	$query = $db->query($sql);
	while ($row = $db->fetch_array($query)) {
		if (!empty ($row['url'])) {
			$row['url'] = (stristr($row["url"], "http://") == '') ? $picserver . replaceSeps($row["url"]) : $row["url"];
		}
		$row['word'] = cut_utf8(str_replace("&nbsp;", "", strip_tags($row['word'])), 270, '...');
		$data[] = $row;
	}
	return $count == 1 ? $data[0] : $data;
}
/*
 * 获取线路数据
 * */
function wx_route($count, $type = '1', $classid = 0, $classid2 = 0, $start = 0) {
	global $db, $picserver, $siteurl, $bid, $enname;

	/*if ($bid)
		$sqladd = " where bid=$bid and locate('1',optype)";
	else*/
		$sqladd = " where 1=1 and locate('1',optype)";
	if($type!=='1')
		$sqladd .= " and locate('" . $type . "',optype)";
	if ($classid)
		$sqladd .= " and classid=" . $classid;
	if ($classid2)
		$sqladd .= " and classid2=" . $classid2;
	if ($type == '1,2,3' && $classid == 0 && $classid2 == 0)
		$orderbysql = ' order by rand()';
	else
		$orderbysql = ' order by hid desc';
	if ($count)
		$limitsql = ' limit ' . $start . ',' .$count;
	$sql = "select * from (select p.id,p.title,p.info_id,p.classid,p.classid2,p.go_day,p.go_num,p.keywords,p.price2,p.url,p.city2,p.remark,p.feature,p.info,t.hid,t.title name,t.departure,t.price1 price_1,t.price2 price_2,t.userid uid,t.op_type optype,t.op_user opuser,t.bid from cg_product_route_sale t,cg_product_route p where t.id=p.id  and p.id) result" . $sqladd . $orderbysql . $limitsql;
	//return $sql;
	$query = $db->query($sql);
	while ($value = $db->fetch_array($query)) {
		if (!empty ($value['url'])) {
			$value['url'] = (stristr($value["url"], "http://") == '') ? $picserver . replaceSeps($value["url"]) : $value["url"];
		}
		$price = $db->getOneInfo("select price from cg_product_route_do where id=" . $value['id'] . " and pass=0 order by price desc limit 0,1");
		if (!empty ($price)) {
			$value['price_2'] = (int) $value['price_2'] - (int) $price['price'];
		}
		$value['feature'] = $enname==="index"?cut_utf8(str_replace("&nbsp;", "", strip_tags($value['feature'])), 50, '...'):$value['feature'];
		$re[] = $value;
	}
	return $count == 1 ? $re[0] : $re;
}
/*根据id,table查到title*/
function cg_gettit($myid=0,$tab = '') {
	global $db;
	if($myid==0||$tab==''){
		return '无';
	}else{
		$res = $db->getOneInfo("select title from ".DBFIX.$tab." where id=$myid");
		return $res['title'];
	}
}
function sendmail2($emails = '',$subject='',$content='',$names='用户',$echo=1){
	include_once(V_ROOT."/common/lib/class.phpmailer.php");
	$configIni = './data/mail.ini';
	$config    =   parse_ini_file($configIni,true);
	$mailconfig = $config['mail1'];
	$mail2 = $config['mail2']['Username'];
	//print_r($mailconfig);
	$emailSuccess = $emailInvalid = $emailFail = array();
	$strSuccess = $strInvalid = $strFail = $strJump = '';

	if($emails != ''){
		$emailPubHead = "<FONT color='red'>%s</font>：<br><br>
			发送如下邮件<br><br><br>";
		$emailPubFoot = "<br><br>来自手机用户的邮件。";

		$cur_email = trim($emails);

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML($mailconfig['IsHTML']);
		$mail->CharSet =  $mailconfig['CharSet']; // 设置字符集编码
		$mail->Encoding = $mailconfig['Encoding'];//设置文本编码方式
		$mail->Host = 	  $mailconfig['Host'];
		$mail->SMTPAuth = $mailconfig['SMTPAuth'];
		$mail->WordWrap = $mailconfig['WordWrap'];
		$mail->Username = $mailconfig['Username'];
		$mail->Password = $mailconfig['Password'];
		//$mail->From =	$mailconfig['From'];
		//$mail->FromName = $mail->Username;
		$mail->SetFrom($cur_email,$names);
		$subject = $subject != '' ? $subject : $mailconfig['Subject'];
		if (function_exists("iconv")) { $subject = iconv("UTF-8","GBK",$subject); }
		$subject = "=?GBK?B?".base64_encode($subject)."?=";

		$mail->Subject = $subject;
		$emailContent = $mailconfig['Body'];

		$emailContent = str_replace('_EMAIL',	$cur_email,	$emailContent);
		$emailContent = str_replace('_DATETIME',date('Y-m-d h:i'),	$emailContent);
		$emailContent = $content != '' ? $content : $emailContent;
		$emailContent = sprintf($emailPubHead, $cur_email).$emailContent.$emailPubFoot;

		//if (function_exists("iconv")) { $emailContent = iconv("UTF-8","GBK",$emailContent); }
		//die($emailContent);
		$mail->Body = $emailContent;
		$mail->AddAddress("xiaohua@xiaohua.net");
		if(!$mail->Send()){
			$result = "发送失败： " . $mail->ErrorInfo;
		}else{
			$result = "发送成功！ ";
		}

	}

	if($echo===1) return $result;
}

?>
