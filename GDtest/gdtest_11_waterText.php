<?php
/**
 * 添加文字水印
 * 其实就是把图片作为画布资源，在上面写字
 * @var string
 */
$filename = "images/thum_xx.jpg";
$fileinfo = getimagesize($filename);
$mime     = $fileinfo['mime'];
// var_dump($mime);exit;
$createFun = str_replace("/", "createfrom", $mime);
$outFun    = str_replace("/", "", $mime);
$image     = $createFun($filename);
// alpha是透明度(0-127)：imagecolorallocatealpha(image, red, green, blue, alpha)
$red      = imagecolorallocatealpha($image, 255, 0, 0, 60);
$fontfile = "fonts/simsun.ttc";
$text     = "Xiao xin's cat";
imagettftext($image, 20, 0, 10, $fileinfo['1'] - 10, $red, $fontfile, $text);
header("content-type:" . $mime);
$outFun($image);
imagedestroy($image);
?>