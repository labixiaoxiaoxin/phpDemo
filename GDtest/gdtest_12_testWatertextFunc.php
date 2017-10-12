<?php

/**
 * 文字水印函数测试
 */
require_once "function/image.func.php";
$filename = "images/thum_xx.jpg";
$fontfile = "fonts/simsun.ttc";
$text     = "xiaoxin";
setWatertext($filename, $fontfile, $text);
?>