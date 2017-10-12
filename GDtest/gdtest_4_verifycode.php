<?php

/**
 * 利用GD库实现 验证码 (4位 数字)
 */

//创建画布
$width  = 150;
$height = 60;
$image  = imagecreatetruecolor($width, $height);

//创建填充颜色
$white = imagecolorallocate($image, 255, 255, 255);

//创建画笔颜色
$randColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));

//开始绘画
$size     = mt_rand(20, 30);
$angle    = mt_rand(-15, 15);
$x        = 50;
$y        = 30;
$fontfile = 'fonts/jdd.ttf';
$text     = mt_rand(1000, 9999);
imagettftext($image, $size, $angle, $x, $y, $randColor, $fontfile, $text);

//输出图像
header("content-type:image/png");
imagepng($image);
//销毁资源
imagedestroy($image);
?>