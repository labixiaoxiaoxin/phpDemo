<?php 
	// 1. 创建画布   imagecreatetruecolor($width, $height);
	$width=500;
	$height=400;
	$image=imagecreatetruecolor($width, $height);

	// 2. 创建颜色   imagecolorallocate($image, red, green, blue);
	$red=imagecolorallocate($image, 255, 0, 0);
	$green=imagecolorallocate($image, 0, 255, 0);
	$blue=imagecolorallocate($image, 0, 0, 255);
	$white=imagecolorallocate($image, 255, 255, 255);
 
 	// 3. 开始绘画
	// 水平输出一个字符
	imagechar($image, 5, 50, 100, "L", $red);
	// 垂直输出一个字符
	imagecharup($image, 5, 100, 130, "X", $green);
	// 水平输出一个字符串
	imagestring($image, 5, 150, 160, "Xiao", $blue);
	// 垂直输出一个字符串
	imagestringup($image, 5, 200, 300, "xin", $white);

	// 4. 告诉浏览器以图片形式显示
	header("content-type:image/png");

	// 5. 输出图像    imagepng($image)  imagejpeg($image)  imagegif($image)
	imagepng($image);

	// 6. 销毁资源
	imagedestroy($image);

 ?>