<?php
if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['email'])){
	if ($_POST['code']!=$_SESSION['num'] || empty($_SESSION['num'])){
			print "<script language=javascript>window.alert('验证码错误!');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	}else{
		if (isemail($_POST["email"])&&!empty($_POST["password"])) {
			$email = $_POST["email"];
			$password = md5($_POST["password"]);
			$query = "SELECT * FROM cg_client WHERE email = '$email'";
			$data = $db->getOneInfo($query);
			if (!empty($data)){
				if ($data['password'] == $password) {
					$_SESSION["uid"] = $data['id'];
					$_SESSION["email"] = $data['email'];
					$_SESSION["user"] = $data['username'];
					$_SESSION["names"] = $data['name'];
					$_SESSION["tel"] = $data['tel'];
					$_SESSION["birth"] = $data['birthday'];
					$_SESSION["idtype"] = $data['idtype'];
					$_SESSION["idnumber"] = $data['idnumber'];
					vheader("/MemberCenter");
				} else {
					print "<script language=javascript>window.alert('密码错误！');location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
				}
			} else {
				print "该邮箱用户不存在，请核实！";
			}
		}else{
			print"信息输入不完全，请核实！";
		}
	}
	exit;
}else{
	$smarty->display(VIEWPATH.'/login.html',$cache_id);
}
?>
