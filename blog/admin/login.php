<?php
	session_start();

	include('../config.php');
	
	/*
	$mysqli = new mysqli('localhost', 'root', '', 'blog');

	if ($mysqli->connect_error) {
	    die('Connect Error (' . $mysqli->connect_errno . ') '
	            . $mysqli->connect_error);
	}*/
	//var_dump($mysqli);
	if ($input->get('do')=='check') {
		$auser = $input->post('auser');
		$apass = $input->post('apass');
		//echo $auser.$apass;
		$sql="SELECT * FROM admin WHERE auser='{$auser}' && apass='{$apass}'";
		$mysqli_result=$db->query($sql);
		$row=$mysqli_result->fetch_array(MYSQLI_ASSOC);
		//var_dump($row);
		if(is_array($row)){
			$_SESSION['aid']=$row['aid'];
			header('location:home.php');
		}else{
			die("账号或密码错误!");
		}
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>管理员登录</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<div class="container">
		<div class="col-md-3"></div>
		<div class="row col-md-6" style="margin-top: 200px;">
			<div class="panel panel-primary">
				  <div class="panel-heading">管理员登录</div>
				  <div class="panel-body">
				  		<form class="form-horizontal" action="login.php?do=check" method="post">
				  			<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
							    <div class="col-sm-10">
							     	<input type="text" class="form-control" id="auser" name="auser" placeholder="请输入账号">
							    </div>
							</div>

							<div class="form-group">
							    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
							    <div class="col-sm-10">
							     	<input type="password" class="form-control" id="apass" name="apass" placeholder="请输入密码">
							    </div>
							</div>

							<div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-primary">点击登录</button>
							    </div>
							</div>
				  		</form>
				  </div>
				  <div class="panel-footer text-right">版权所有 翻版必究</div>
				</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</body>
</html>