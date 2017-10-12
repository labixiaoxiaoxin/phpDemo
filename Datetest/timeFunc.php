<?php

header("content-type:text/html;charset=utf-8");

// getdate() 获取当前日期信息
var_dump(getdate());
var_dump(getdate(time()));
$today = getdate();
echo $today['year'] . "-" . $today['mon'] . "-" . $today['mday'] . "<hr/>";

// gettimeofday() 得到当前时间，包括秒和微秒
var_dump(gettimeofday());
$timeofday = gettimeofday();
echo $timeofday['sec'] . "." . $timeofday['usec'] . "<hr/>";

// checkdate($month,$day,$year) 检测日期合法性
var_dump(checkdate(9, 30, 2017));
var_dump(checkdate(2, 29, 2017));
?>