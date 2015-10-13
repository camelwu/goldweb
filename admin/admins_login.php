<?php
require_once ('includes/init.php');
$errors = isset($_GET['errors'])?$_GET['errors']:"";
$action = isset($_GET['action'])?$_GET['action']:"";

switch ($action) {
	case "login" :
		/*if (killbad($_POST['code'])!=$_SESSION['num'] || empty($_SESSION['num'])){
			print "<script language=javascript>window.alert('验证码错误!');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			exit;
		}else */
		if (!empty($_POST["username"])) {
			//$password = md5($posts["password"]);
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
		}
		break;
	case "logout" :
		unset ($_SESSION['admin']);
		unset ($_SESSION['username']);
		unset ($_SESSION['password']);
		vheader("./");
		break;
	default:
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理后台</title>
<style type="text/css">
<!--
body {
	background-color: #d4d0c8;
	margin: 0;
	padding: 0;
	text-align: center;
	background-image: url(css/images/back.gif);
	font-size:9pt;
}
th {FONT-SIZE: 20px;  COLOR: #033292; LINE-HEIGHT:25PX; PADDING-TOP: 2px; TEXT-DECORATION: none; font-weight: bold}
td {font-size:12px;}
.input_login{border:0px;height:16px;}
.input_val{border: 0px;border-bottom: #c0c0c0 1px solid; height: 16px;background-color: #fdfdfd;}
-->
</style>
<script language="javascript">
var validate = true;
function get_code(){
	if(validate==true){
		document.getElementById("findcode").src="include/scode.php?"+Math.random();
		validate = false;
		return false;
	}else{
		document.getElementById("findcode").src="include/scode.php?"+Math.random();
		validate = true;
		return false;
	}
}
function checkfrm(){
 if(document.admin_frm.username.value==""){
	alert("请输入用户名");
	document.admin_frm.username.focus();
	return false;
 }else if(document.admin_frm.password.value==""){
	alert("请输入密码");
	document.admin_frm.password.focus();
	return false;
 }/*else if(document.admin_frm.code.value==""){
	alert("请输入验证");
	document.admin_frm.code.focus();
	return false;
 }*/else{
	return true;
 }
}
</script>
</head>

<body>

<div style="background-color:#FBFBFB;margin:200px auto;width:533px;padding:10px;border:#e9e9e9 solid 2px"> 
	<form name="admin_frm" action="?action=login" method="post" onSubmit="return checkfrm();">
	<table width="493" border="0" cellpadding="0" cellspacing="0" bgcolor="#FBFBFB">
        <tr>
          <th colspan="5" height="35">旅游管理系统<?php echo VER;?></th>
        </tr>
         <tr>
          <td colspan="5" height="10"></td>
        </tr>
        <tr>
          <td width="130"><img src='css/images/al_username.gif' width="130" height="50" border="0" /></td>
          <td width="126" background='css/images/al_body_bg.gif'><input type="text" name="username" size="15" maxlength="20" class="input_login" /></td>
          <td width="93"><img src='css/images/al_password.gif' border="0" /></td>
          <td width="105" background='css/images/al_body_bg.gif'><input type="password" name="password" size="15" maxlength="20" class="input_login" onMouseOver="this.focus()" /></td>
          <td width="39"><img src="css/images/al_body_right.gif" width="39" height="50" /></td>
        </tr>
        <tr>
          <td height="40" align="right" style="color:#163575">验证码：</td>
          <td colspan="3"><input type="text" name="code" size="6" maxlength=4 class="input_val"><img src="includes/scode.php" name="findcode" width="70" height="17" border="0" id="findcode" style="cursor:pointer;" onClick="return get_code();"></td>
          <td></td>
        </tr>
        <tr>
          <td height="30"></td>
          <td><input type="submit" name="Submit" value="进入管理"></td>
          <td><input type="reset" name="Reset" value="重新填写"></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="5" height="10"></td>
        </tr>
	</table>
	</form>
</div>
</body>
</html>
<?php	break;
}?>