<?php

$fileinfo = $_FILES['myfile'];
$filename = $fileinfo['name'];
$filetype = $fileinfo['type'];
$tmp_name = $fileinfo['tmp_name'];
$error    = $fileinfo['error'];
$filesize = $fileinfo['size'];

if ($error == UPLOAD_ERR_OK) {
    if (move_uploaded_file($tmp_name, "uploads/" . $filename)) {
        echo "文件" . $filename . "上传成功";
    } else {
        echo "文件上传失败";
    }
} else {
    // 匹配错误信息
    switch ($error) {
    case 1:
        echo "上传文件超过了upload_max_filesize限制的值";
        break;
    case 2:
        echo "上传文件超过了html表单中MAX_FILE_SIZE指定值";
        break;
    case 3:
        echo "文件只有部分被上传";
        break;
    case 4:
        echo "文件没有被上传";
        break;
    case 6:
        echo "找不到临时文件夹";
        break;
    case 7:
        echo "文件写入失败";
        break;
    case 8:
        echo "上传的文件被PHP扩展程序中断";
        break;
    }
}
?>