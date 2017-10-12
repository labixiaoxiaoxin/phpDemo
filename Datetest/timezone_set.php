<?php

header("content-type:text/html;charset=utf-8");
/**
 * 设置时区
 * 1. 通过修改 php.ini 中的 date.timezone="xxx" ，所有脚本有效
 * 2. 通过 date_default_timezone_set($timezone) 修改，该脚本当前位置开始才有效
 * 3. 通过 ini_set("date.timezone","xxx") 修改，该脚本当前位置开始才有效
 */
//1
echo "当前时区为：" . date_default_timezone_get() . "<br/>";
echo "<hr/>";

//2
date_default_timezone_set("Asia/Shanghai");
echo "当前时区为：" . date_default_timezone_get() . "<br/>";
echo "<hr/>";

//3
echo "当前时区为：" . ini_get("date.timezone") . "<br/>";
ini_set("date.timezone", "Asia/Shanghai");
echo "当前时区为：" . ini_get("date.timezone") . "<br/>";
echo "<hr/>";
?>