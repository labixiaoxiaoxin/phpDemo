<?php
/**
 * 提示操作信息的，并且跳转
 * @param  string $mes [description]
 * @param  string $url [description]
 * @return [type]      [description]
 */
function alertMes($mes, $url) {
    echo "<script type='text/javascript'>alert('{$mes}');location.href='{$url}'</script>";
}

/**
 * 获取文件扩展名
 * @param  string $filename [description]
 * @return string           [description]
 */
function getExt($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * 获取唯一字符串
 * @param  integer $length [description]
 * @return [type]          [description]
 */
function getUniqidName($length = 10) {
    return substr(md5(uniqid(microtime(true), true)), 0, $length);
    // return date("YmdHis");  //也可以以日期命名
}
?>