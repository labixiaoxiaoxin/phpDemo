<?php

require_once "extend/image.class.php";
$filename = "images/thum_xx.jpg";
$logo     = "images/php_logo.png";
$fontfile = "fonts/simsun.ttc";
$text     = "测试一下";
$image    = new Image();
var_dump($image->getImageInfo($filename));
$image->thumbImage($filename, 50, 60);
// $image->setWatertext($filename,$fontfile,$text);
// $image->setWaterpic($filename,$logo,3);
?>