<?php
	header('Content-type:text/html;charset=utf-8');

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	$email=$_POST['email'];
	$fav=$_POST['fav'];
	if(!empty($fav)){			//检测数组是否为空
		$favstr=join(",",$fav);	//将数组$fav转化为字符串并且以逗号分隔
	}
	$verify=strtolower($_POST['verify']);			//转化为小写
	$verify1=trim(strtolower($_POST['verify1']));	//去掉首尾空格并且转化为小写
	//echo $verify."---------".$verify1;

	//检测用户名是否规范
	//echo $username;
	$char=substr($username, 0,1);
	//$char=$username{0};
	//echo $char;
	$ascii=ord($char);
	//echo $ascii;
	if(!(($ascii>=65&&$ascii<=90)||($ascii>=97&&$ascii<=122))){
		exit('用户名首字母不是字母<a href="reg.php">重新注册</a>');
	}
	$userlen=strlen($username);
	if(!($userlen>5&&$userlen<11)){
		exit('用户名长度不符合规范<a href="reg.php">重新注册</a>');
	}


	//检测密码是否规范
	$passlen=strlen($password);
	if($passlen==0){
		exit('密码不能为空<a href="reg.php">重新注册</a>');
	}
	if($passlen<6||$passlen>10){
		exit('密码长度不符合规范<a href="reg.php">重新注册</a>');
	}

	//检测密码是否一致
	if(strcmp($password, $password1)!==0){
		exit('两次密码不一致<a href="reg.php">重新注册</a>');
	}

	//检测邮箱是否合法
	if(strpos($email, '@')==false){//0==false
		exit('邮箱不合法<a href="reg.php">重新注册</a>');
	}

	//检测验证码是否正确
	if(strcmp($verify, $verify1)!=0){
		exit('验证码错误<a href="reg.php">重新注册</a>');
	}

	$password=md5($password);	//密码md5加密
	echo "恭喜您注册成功,用户信息如下：";
	echo "<table border='1' width='80%'>
	<tr>
		<td>用户名</td>
		<td>密码</td>
		<td>邮箱</td>
		<td>兴趣爱好</td>
	</tr>
	<tr>
		<td>$username</td>
		<td>$password</td>
		<td>$email</td>
		<td>$favstr</td>
	</tr>
</table>";
?>
