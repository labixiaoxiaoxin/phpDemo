<?php

header("content-type:text/html;charset=utf-8");

/**
 * strtotime();
 */
echo "现在是：" . time() . "<br/>";
echo "现在是：" . strtotime("now") . "<br/>";
echo "现在是：" . date("Y-m-d H:i:s", time()) . "<br/>";
echo "1天后：" . date("Y-m-d H:i:s", time() + 24 * 3600) . "<br/>";
echo "现在是：" . date("Y-m-d H:i:s", strtotime("now")) . "<br/>";
echo "1天后 ：" . date("Y-m-d H:i:s", strtotime("+1 day")) . "<br/>";
echo "15天后：" . date("Y-m-d H:i:s", strtotime("+15 days")) . "<br/>";
echo "2周后 ：" . date("Y-m-d H:i:s", strtotime("+2 weeks")) . "<br/>";
echo "3个月后：" . date("Y-m-d H:i:s", strtotime("+3 months")) . "<br/>";
echo "本月最后一个周一：" . date("Y-m-d H:i:s", strtotime("last Monday")) . "<br/>";
?>