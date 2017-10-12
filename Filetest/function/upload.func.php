<?php
/**
 * 封装单文件上传函数
 * @param  array   $fileinfo [文件信息]
 * @param  string  $path     [保存路径]
 * @param  boolean $flag     [是否检测图片]
 * @param  array   $allowext [检测类型]
 * @param  integer $maxsize  [最大文件大小]
 * @return string  $destination  [返回完整文件路径名]
 */
function uploadFile($fileinfo, $path = "uploads", $flag = true, $allowext = array('jpg', 'jpeg', 'png', 'gif', 'wbmp'), $maxsize = 2097152) {
    // $fileinfo=$_FILES['myfile'];
    // $allowext=array('jpg','jpeg','png','gif','wbmp');
    // var_dump($fileinfo);exit;
    if ($fileinfo['error'] == 0) {
        // 限制文件上传大小
        // $maxsize=2097152;
        if ($fileinfo['size'] > $maxsize) {
            exit("文件大小不符合要求");
        }

        if (!is_array($allowext)) {
            exit("系统错误");
        }
        // 限制文件上传类型
        // $explo=explode('.', $fileinfo['name']);
        // $ext=strtolower(end($explo));
        $ext = pathinfo($fileinfo['name'], PATHINFO_EXTENSION);
        // echo $ext;
        if (!in_array($ext, $allowext)) {
            //判断$ext是否在数组$allowext中
            exit("文件类型不符合");
        }
        // 是否检测图片，默认true
        if ($flag) {
            // 检测图片是否为真实的图片
            // getimagesize() 如果是图片返回数组，否则返回false
            if (!getimagesize($fileinfo['name'])) {
                exit("文件不是真实的图片");
            }
        }

        // 检测是否为HTTP POST方式上传
        // $path="uploads";
        if (!file_exists($path)) {
            //如果目录不存在则创建
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        $uniName     = md5(uniqid(microtime(true), true)); //把当前的微秒生成唯一的id
        $destination = $path . "/" . $uniName . "." . $ext;
        // move_uploaded_file()  移动HTTP POST方式上传的文件
        if (@move_uploaded_file($fileinfo['tmp_name'], $destination)) {
            echo "文件上传成功";
        } else {
            exit("文件不是HTTP POST方式上传的");
        }

    } else {
        // 匹配错误信息
        switch ($fileinfo['error']) {
        case 1:
            $mes = "上传文件超过了upload_max_filesize限制的值";
            break;
        case 2:
            $mes = "上传文件超过了html表单中MAX_FILE_SIZE指定值";
            break;
        case 3:
            $mes = "文件只有部分被上传";
            break;
        case 4:
            $mes = "文件没有被上传";
            break;
        case 6:
            $mes = "找不到临时文件夹";
            break;
        case 7:
            $mes = "文件写入失败";
            break;
        case 8:
            $mes = "上传的文件被PHP扩展程序中断";
            break;
        }
        exit($mes);
    }
    return $destination;
}
?>