<?php
header("content-type:text/html;charset=utf-8");
/**
 * include/include_once或者require/require_once可以把文件包含进来
 *
 * include和include_once的区别（require和require_once同理）：
 * include用多少次就包含多少次，include_once只包含一次。
 */
// include_once "common.func.php";
require "common.func.php";
$filename = "123.html.php";
echo getExt($filename);
echo "<hr/>";

/**
 * include和require的区别：
 * include包含不存在的文件时，会报2个警告，程序继续执行。
 * require包含不存在的文件时，会报1个警告和1个致命错误，程序终止执行。
 */
include "notExist.php";
echo "It is a test"; //程序继续，这里会被输出

echo "<hr/>";

require "notExist.php";
echo "It is a test"; //程序终止，这里不会输出
echo "It is a test";

?>