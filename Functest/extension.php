<?php
/**
 *根据文件名，返回文件扩展名
 *@param string $name
 *@return string $result
 */
function extension($name) {
    $last   = strrpos($name, ".");
    $result = "扩展名为：" . substr($name, $last);
    return $result;
}
echo extension("123.php");
echo "<br/>";
echo extension("sdfsfsdf.html.css");
echo "<br/>";

/**
 *根据文件名，返回文件扩展名
 *@param string $filename
 *@return string $ext
 *标准做法:
 */
function getExtension($filename) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return $ext;
}
$filename = "123.html.css.js.php";
echo getExtension($filename);
?>