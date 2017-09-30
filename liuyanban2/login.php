<?php
	session_start();
	include('input.class.php');
	include('db_link.php');

	$input=new input();
	$username=$input->post('username');
	$password=$input->post('password');
	//echo $username.$password;
	$sql="SELECT * FROM adm WHERE username='{$username}' and password='{$password}'";
	$mysqli_result=$mysqli->query($sql);
	//var_dump($mysqli_result);
	if($row=$mysqli_result->fetch_array()){
		$_SESSION['username']=$username;
		header('location:index.php');
	}else{
		echo "no";
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	<form action="login.php" method="post">
		<input type="text" name="username">
		<input type="password" name="password">
		<input type="submit" value="登录">
	</form>
</body>
</html>