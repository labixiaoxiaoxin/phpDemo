<?php

require_once "function/common.func.php";
require_once "function/upload2.func.php";
// var_dump(getFiles($_FILES));
$files = getFiles();
foreach ($files as $fileinfo) {
    $res = uploadFile($fileinfo);
    echo $res['mes'] . "<br/>";
    //加@是因为当有文件上传失败时，$res['dest']就不存在了
    @$uploadfiles[] = $res['dest'];
}
// array_filter()不提供callback函数，将删除array中false的所有条目。其余项下标不变。
// array_filter()返回array中所有值，并建立数字索引。下标从0开始排列。
// 获得文件名数组，可以写进数据库
$uploadfiles = array_values(array_filter($uploadfiles));

var_dump($uploadfiles);

?>