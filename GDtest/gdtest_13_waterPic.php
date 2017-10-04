<?php 
	/**
	 * 添加图片水印
	 * @var string
	 */
	$logo="images/php_logo.png";
	$filename="images/thum_xx.jpg";
	$dst_im=imagecreatefromjpeg($filename);
	$src_im=imagecreatefrompng($logo);
	imagecopymerge($dst_im, $src_im, 0,0,0,0, 121, 64, 50);
	header("content-type:image/jpeg");
	imagejpeg($dst_im);
	imagedestroy($dst_im);
	imagedestroy($src_im);
 ?>