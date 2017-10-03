<?php
	/**
	 * 等比例缩放
	 */
	$filename="images/2.jpg";	
	if ($fileinfo=getimagesize($filename)) {
		list($src_w,$src_h)=$fileinfo;
	}else{
		exit("文件不是图片");
	}
	//设置最大宽和高
	$dst_w=600;
	$dst_h=300;

	//等比例缩放算法
	$ratio_orig = $src_w/$src_h;
	if ($dst_w/$dst_h > $ratio_orig) {
	   $dst_w = $dst_h*$ratio_orig;
	} else {
	   $dst_h = $dst_w/$ratio_orig;
	}

	$dst_image=imagecreatetruecolor($dst_w, $dst_h);
	$src_image=imagecreatefromjpeg($filename);
	imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
	imagepng($dst_image,'images/thum_xx.png');
	imagedestroy($dst_image);
	imagedestroy($src_image);
 ?>