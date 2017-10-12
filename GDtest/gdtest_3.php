<?php

// 1. 创建画布
$image = imagecreatetruecolor(500, 300);
// 2. 创建颜色
$white     = imagecolorallocate($image, 255, 255, 255);
$randColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
//       填充颜色：把黑色画布填充为白色
imagefilledrectangle($image, 0, 0, 500, 300, $white);
// 3. 开始绘画：用本地字体  随机颜色
imagettftext($image, 20, 20, 100, 50, $randColor, 'fonts/jdd.ttf', 'hello123');
imagettftext($image, 30, 30, 200, 200, $randColor, 'fonts/jdd.ttf', 'world456');
// 4. 告诉浏览器以图片形式显示
header("content-type:image/png");
// 5. 输出图像
imagepng($image);
imagepng($image, "images/1.png");
// 6. 销毁资源
imagedestroy($image);
?>