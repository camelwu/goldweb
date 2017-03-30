<?php
define("CON_number", 6);
define("CON_image_string", "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email'])) {
	if ($_POST['code'] != $_SESSION['num'] || empty($_SESSION['num'])) {
		print "<script language=javascript>window.alert('验证码错误!');location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
	} else {
		if (isemail($_POST["email"])) {
			$email = $_POST["email"];
			$query = "SELECT `username` FROM cg_client WHERE email = '$email'";
			$data = $db -> getOneInfo($query);
			if (!empty($data)) {
				$pass = randomkey();
				$status = resetkey($email, $pass);
				sendmail(array($email), '重置密码邮件', '您的密码已经重置<br>请及时登录并进行重置<br><strong>' . $pass . '</strong>');
				print "<script>window.alert('新密码已经发送到您的邮箱，请注意查收！');location.href='./login';</script>";
			} else {
				print "<script>alert('该邮箱用户不存在，请核实！');location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
			}
		} else {
			print "<script>alert('请输入邮箱！');location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
		}
	}
	exit ;
} else {
	$smarty -> display(V_ROOT . './templates/' . $enname . '.html', $cache_id);
}
/*
 *发送邮件
 */
function sendmail($emails = '', $subject = '', $content = '', $tag = 'mail1', $echo = 0) {
	include_once ("./admin/includes/class.phpmailer.php");
	$configIni = './admin/data/mail.ini';
	$config = parse_ini_file($configIni, true);
	$mailconfig = $config[$tag];
	//print_r($mailconfig);
	$emailSuccess = $emailInvalid = $emailFail = array();
	$strSuccess = $strInvalid = $strFail = $strJump = '';

	if ($emails != '') {
		$emailPubHead = "亲爱的<FONT color='red'>%s</font>：<br><br>
			这是系统自动发送的密码重置邮件，请勿回复！<br>
			谢谢～<br><br><br>";
		$emailPubFoot = "<br><br>敬礼<br><br>金桥服务系统。";
		if (is_array($emails)) {
			$emailArr = $emails;
		} else {
			if (substr($emailArr, -1) === '|')
				$emailArr = substr($emailArr, 0, -1);
			$emailArr = explode('|', $emails);
		}
		$count = count($emailArr);
		for ($i = 0; $i < $count; $i++) {
			$cur_email = trim($emailArr[$i]);
			if (ckEmail($cur_email)) {
				$mail = new PHPMailer();
				$mail -> IsSMTP();
				$mail -> IsHTML($mailconfig['IsHTML']);
				$mail -> CharSet = $mailconfig['CharSet'];
				// 设置字符集编码
				$mail -> Encoding = $mailconfig['Encoding'];
				//设置文本编码方式
				$mail -> Host = $mailconfig['Host'];
				$mail -> SMTPAuth = $mailconfig['SMTPAuth'];
				$mail -> WordWrap = $mailconfig['WordWrap'];
				$mail -> Username = $mailconfig['Username'];
				$mail -> Password = $mailconfig['Password'];
				//$mail->From =	$mailconfig['From'];
				//$mail->FromName = $mail->Username;
				$mail -> SetFrom($mailconfig['From'], '金桥修改密码邮件');
				$subject = $subject != '' ? $subject : $mailconfig['Subject'];
				if (function_exists("iconv")) { $subject = iconv("UTF-8", "GBK", $subject);
				}
				$subject = "=?GBK?B?" . base64_encode($subject) . "?=";

				$mail -> Subject = $subject;
				$emailContent = $mailconfig['Body'];

				$emailContent = str_replace('_EMAIL', $cur_email, $emailContent);
				$emailContent = str_replace('_DATETIME', date('Y-m-d h:i'), $emailContent);
				$emailContent = $content != '' ? $content : $emailContent;
				$emailContent = sprintf($emailPubHead, $cur_email) . $emailContent . $emailPubFoot;

				//if (function_exists("iconv")) { $emailContent = iconv("UTF-8","GBK",$emailContent); }
				//die($emailContent);
				$mail -> Body = $emailContent;
				$mail -> AddAddress($cur_email);
				if (!$mail -> Send()) {
					$count3 = count($emailFail);
					$emailFail[$count3] = $cur_email;
					$strFail .= $cur_email . '<br>';
					continue;
				} else {
					$count1 = count($emailSuccess);
					$emailSuccess[$count1] = $cur_email;
					$strSuccess .= $cur_email . '<br>';
				}
			} else {echo "status";
				exit ;
				$count2 = count($emailInvalid);
				$emailInvalid[$count2] = $cur_email;
				$strInvalid .= $cur_email . '<br>';
			}
		}
	}
	if ($strSuccess != '')
		$result .= '<p>下面Email地址发送成功：<br>' . $strSuccess . '</p>';
	if ($strInvalid != '')
		$result .= '<p>下面Email地址格式错误：<br>' . $strInvalid . '</p>';
	if ($strFail != '')
		$result .= '<p>下面Email地址发送失败：<br>' . $strFail . '</p>';
	if ($echo === 1)
		echo($result);
}

/*
 *随机密码
 */
function randomkey() {
	$key = '';
	for ($i = 0; $i < CON_number; $i++) {
		$key .= substr(CON_image_string, rand(0, 61), 1);
	}
	return $key;
}

/*
 * 修改数据库
 */
function resetkey($email = '', $pass = '') {
	global $db;
	//state == 3 修改密码
	if ($email === '') {
		return FALSE;
	} else {
		$sqlstr = "update cg_client set password='" . md5($pass) . "' where email='" . $email . "'";
		$info = $db -> query($sqlstr);
		return TRUE;
	}
}
echo ckEmail("camelwu963@12.cn");
function ckEmail($email) {
	if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
		return TRUE;
	} else {
		if (preg_match('|^[1-9]\d{4,10}@qq\.com$|i', $email)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>