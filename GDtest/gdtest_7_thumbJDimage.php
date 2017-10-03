<?php 
	$filename='images/jdimage.jpg';
	$fileinfo=getimagesize($filename);
	if ($fileinfo) {
		list($src_w,$src_h)=$fileinfo;
	}else{
		exit("文件不是图片");
	}
	$dst_image_50=imagecreatetruecolor(50, 50);
	$dst_image_270=imagecreatetruecolor(270, 270);
	$src_image=imagecreatefromjpeg($filename);
	imagecopyresampled($dst_image_50, $src_image, 0,0,0,0, 50, 50, $src_w, $src_h);
	imagecopyresampled($dst_image_270, $src_image, 0,0,0,0, 270, 270, $src_w, $src_h);
	imagejpeg($dst_image_50,'images/thumb_50x50.jpg');
	imagejpeg($dst_image_270,'images/thumb_270x270.jpg');
	imagedestroy($dst_image_50);
	imagedestroy($dst_image_270);
 ?>