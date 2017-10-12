<?php

require_once "extend/Captcha.class.php";
$config = array(
    'fontfile' => 'fonts/simsun.ttc',
    //'snow'=>25,   //有雪花就没有像素和线段干扰元素
    'line'     => 3,
    'pixel'    => 50,
);
$captcha = new Captcha($config);
session_start();
$_SESSION['captcha'] = $captcha->getCaptcha();
?>