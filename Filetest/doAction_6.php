<?php 
	header("content-type:text/html;charset=utf-8");
	require './class/upload.class.php';
	$upload=new upload("myFile1","./newUploads");
	$dest=$upload->uploadFile();
	echo $dest;
?>