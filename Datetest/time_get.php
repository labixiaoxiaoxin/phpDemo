<?php

header("content-type:text/html;charset=utf-8");

// echo mktime(0,0,0,5,19,1995);
echo date("Y-m-d H:i:s", mktime(0, 0, 0, 5, 19, 1995)) . "<br/>";

/**
 * 两个时间之差（当前时间戳-目标时间戳）
 */
$birth = mktime(0, 0, 0, 5, 19, 1995);
$now   = time();
echo $now . "----" . $birth . "<br/>";
echo $now - $birth . "<br/>";
$age = floor(($now - $birth) / (24 * 3600 * 365));
echo "我今年" . $age . "岁了<br/>";
$days = floor(($now - $birth) / (24 * 3600));
echo "我活了" . $days . "天了<br/>";

?>