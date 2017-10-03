<?php 
	/**
	 * 缩略图
	 */
	$filename="images/2.jpg";
	// 获取图片信息  getimagesize($filename)
	$fileinfo=getimagesize($filename);
	// var_dump($fileinfo);
	// list($src_w,$src_h) 把数组元素赋给一组变量
	list($src_w,$src_h)=$fileinfo;  //$fileinfo中第0和1个元素分别是宽和高
	$dst_w=400;
	$dst_h=300;
	$dst_image=imagecreatetruecolor($dst_w, $dst_h);
	// 通过文件创建画布资源  imagecreatefromjpeg($filename)
	$src_image=imagecreatefromjpeg($filename);
	$dst_x=0;
	$dst_y=0;
	$src_x=0;
	$src_y=0;
	// 重采样拷贝部分图像并调整大小  imagecopyresampled()
	imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
	header("content-type:image/jpg");
	// imagejpeg($src_image);
	imagejpeg($dst_image);
	// imagejpeg($dst_image,'images/thumbimage_2.jpg');
	imagedestroy($src_image);
	imagedestroy($dst_image);
 ?>