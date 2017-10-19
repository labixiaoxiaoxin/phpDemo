<?php
/**
 * 得到文件扩展名
 * @param  [string] $filename [文件名]
 * @return [string]           [返回扩展名]
 */
function getExt($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * 产生唯一字符串
 * @return [string] [唯一的id，可作为唯一文件名]
 */
function getUniname() {
    return md5(uniqid(microtime(true), true));
}

