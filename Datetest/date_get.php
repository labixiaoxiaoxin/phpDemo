<?php

header("content-type:text/html;charset=utf-8");

//获取当前时间
function getNowTime() {
    $dayarr = array("日", "一", "二", "三", "四", "五", "六");
    $now    = date("Y年m月d日 H:i:s 星期") . $dayarr[date("w")];
    echo $now;
}
getNowTime();

?>