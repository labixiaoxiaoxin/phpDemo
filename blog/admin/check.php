<?php
	include('../config.php');
	
	session_start();

	$session_aid=$input->session('aid');
	if(!$session_aid){
		header('location:login.php');
	}

	$sql="SELECT * FROM admin WHERE aid='{$session_aid}'";
	$session_auser_result=$db->query($sql);
	$session_auser=$session_auser_result->fetch_array(MYSQLI_ASSOC);
	//var_dump($auser);
?>