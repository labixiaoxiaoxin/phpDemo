<?php
	include('input.class.php');
	include('db_link.php');

	$input=new input();
	$username=$input->post('username');
	$msg=$input->post('msg');
	//echo $username.$msg;
	
	$t=time();
	$sql="INSERT INTO msg(`username`,`content`,`intime`) VALUES('{$username}','{$msg}','{$t}')";
	$is=$mysqli->query($sql);
	if($is==true){
		header('location:index.php');
	}else{
		echo "发表失败。";
	}
?>