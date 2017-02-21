<?php
require_once ('includes/init.php');
$errors = isset($_GET['errors'])?$_GET['errors']:"";
$action = isset($_GET['action'])?$_GET['action']:"";
if (function_exists("iconv")) { $errors = iconv("UTF-8","GBK",$errors); }
switch ($action) {
	case "login" :
		/*if (killbad($_POST['code'])!=$_SESSION['num'] || empty($_SESSION['num'])){
			vheader("admins_login.php?errors=验证码错误 ！");
			//print "<script language=javascript>window.alert('验证码错误!');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			exit;
		}else{*/
			if (!empty($_POST["username"])) {
			//
			$username = killbad($_POST["username"]);
			$password = md5(killbad($_POST["password"]));
			$query = "SELECT * FROM " . DBFIX . "user WHERE username = '$username'";
			$data = $db->getOneInfo($query);
			
			if (!empty($data)) {
				if ($data['password'] == trim($password)) {
					$_SESSION["admin"] = true;
					$_SESSION["id"] = $data['id'];
					//echo $data['bid'];
					$_SESSION["bid"] = $data['bid'];
					$_SESSION["allowstr"] = $data['allowstr'];
					$_SESSION["name"] = $data['name'];
					$_SESSION["username"] = $data['username'];
					$sqlstr = "update " . DBFIX . "user set login_num=login_num+1,login_ip='" . $_SERVER["REMOTE_ADDR"] . "',time2='" . date("Y-m-d H:i:s") . "' where id=" . $data['id'];
					$db->query($sqlstr);
					if ($_SERVER['HTTP_REFERER'] == "" || strpos($_SERVER['HTTP_REFERER'], "admins_login") > 1) {
						vheader("admin.php");
					} else {
						vheader($_SERVER['HTTP_REFERER']);
					}
					
				} else {
					vheader("admins_login.php?errors=用户名密码不匹配！");
				}
			} else {
				vheader("admins_login.php?errors=无此用户，请确认输入的用户名！");
			}
			@ mysql_free_result($data);
			}
		//}
		break;
	case "logout" :
		unset ($_SESSION['admin']);
		unset ($_SESSION['username']);
		unset ($_SESSION['id']);
		vheader("./");
		break;
	default:
		$smarty->assign('version',	VER);
		$smarty->assign('error',$errors);
		$smarty->display('./admins_login.html');
	break;
}

?>
