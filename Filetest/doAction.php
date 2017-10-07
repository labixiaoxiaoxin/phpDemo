<?php 
	// print_r($_FILES);
	var_dump($_FILES);

	// $_FILES 二维数组
	$filename=$_FILES['myfile']['name'];
	$filetype=$_FILES['myfile']['type'];
	$tmp_name=$_FILES['myfile']['tmp_name'];
	$error=$_FILES['myfile']['error'];
	$filesize=$_FILES['myfile']['size'];

	/**
	 * 上传文件
	 * （1）move_uploaded_file($tmp_name, $destination)：将临时文件转移到指定位置
	 * （2）copy($tmp_name, $destination)：将临时文件拷贝到指定位置
	 */
	$destination="uploads/".$filename;
	move_uploaded_file($tmp_name, $destination);

	// copy($tmp_name, $destination);
	// rename($destination, "uploads/".mt_rand(100000,999999)."_".$filename);
 ?>