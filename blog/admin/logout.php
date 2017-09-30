<?php
	include('check.php');	//用户才能退出
	$_SESSION = array();   //把session置为空
	header('location:login.php');
?>