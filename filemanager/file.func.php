<?php
/**
 * 转换字节大小
 * @param  int    $size [description]
 * @return float        [description]
 */
function transByte($size) {
    // $size=1825000;
    $arr = array("B", "KB", "MB", "GB", "TB", "EB");
    $i   = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $i++;
    }
    // 取2位小数
    return round($size, 2) . $arr[$i];
}

/**
 * 创建文件
 * @param  string $filename [description]
 * @return string           [description]
 */
function createFile($filename) {
    // 验证文件名的合法性，是否包含/，*，<,>,?,|
    // 正则表达式
    $pattern = "/[\/,\*,<>,\?\|]/";
    // preg_match 匹配正则表达式
    // basename(path) 返回文件名部分
    if (!preg_match($pattern, basename($filename))) {
        // 检测当前目录下是否存在同名文件
        if (!file_exists($filename)) {
            // 通过touch函数创建
            if (touch($filename)) {
                return "文件创建成功";
            } else {
                return "文件创建失败";
            }
        } else {
            return "文件已存在，请重命名后创建";
        }
    } else {
        return "非法文件名";
    }
}

/**
 * 重命名文件
 * @param  string $oldname [description]
 * @param  string $newname [description]
 * @return string          [description]
 */
function renameFile($oldname, $newname) {
    // 获取目录
    $path = dirname($oldname);
    // 检测文件名合法性
    if (checkFilename($newname)) {
        // 检测该目录下是否存在同名文件
        if (!file_exists($path . "/" . $newname)) {
            // 重命名文件
            if (rename($oldname, $path . "/" . $newname)) {
                return "重命名成功";
            } else {
                return "重命名失败";
            }
        } else {
            return "已存在同名文件，请重新命名";
        }
    } else {
        return "非法文件名";
    }
}

/**
 * 检测文件名合法性
 * @param  string $filename [description]
 * @return boolean          [description]
 */
function checkFilename($filename) {
    // 验证文件名的合法性，是否包含/，*，<,>,?,|
    // 正则表达式
    $pattern = "/[\/,\*,<>,\?\|]/";
    // preg_match 匹配正则表达式
    // basename(path) 返回文件名部分
    if (!preg_match($pattern, basename($filename))) {
        // 检测当前目录下是否存在同名文件
        return true;
    } else {
        return false;
    }
}

/**
 * 删除文件
 * @param  string $filename [description]
 * @return string           [description]
 */
function delFile($filename) {
    if (unlink($filename)) {
        $mes = "文件删除成功";
    } else {
        $mes = "文件删除失败";
    }
    return $mes;
}

/**
 * 下载文件
 * @param  string $filename [description]
 * @return [type]           [description]
 */
function downFile($filename) {
    header("content-disposition:attachment;filename=" . basename($filename));
    header("content-length:" . filesize($filename));
    readfile($filename); // 输出一个文件
}

/**
 * 复制文件
 * @param  [string] $filename [description]
 * @param  [string] $dstname  [description]
 * @return [string]           [description]
 */
function copyFile($filename, $dstname) {
    if (file_exists($dstname)) {
        if (!file_exists($dstname . "/" . basename($filename))) {
            if (copy($filename, $dstname . "/" . basename($filename))) {
                return "文件复制成功";
            } else {
                return "文件复制失败";
            }
        } else {
            return "目标目录下存在同名文件";
        }
    } else {
        return "目标目录不存在";
    }
}

/**
 * 剪切文件
 * @param  [string] $filename [description]
 * @param  [string] $dstname  [description]
 * @return [string]           [description]
 */
function cutFile($filename, $dstname) {
    if (file_exists($dstname)) {
        if (!file_exists($dstname . "/" . basename($filename))) {
            if (rename($filename, $dstname . "/" . basename($filename))) {
                return "文件剪切成功";
            } else {
                return "文件剪切失败";
            }
        } else {
            return "目标目录下存在同名文件";
        }
    } else {
        return "目标目录不存在";
    }
}

/**
 * 上传文件
 * @param  array   $fileInfo [description]
 * @param  string  $path     [description]
 * @param  integer $maxSize  [description]
 * @param  array   $allowExt [description]
 * @return string            [description]
 */
function uploadFile($fileInfo, $path, $maxSize = 2097152, $allowExt = array('jpg', 'jpeg', 'png', 'gif', 'txt')) {
    if ($fileInfo['error'] == 0) {
        if (is_uploaded_file($fileInfo['tmp_name'])) {
            // $maxSize=2097152;
            if ($fileInfo['size'] <= $maxSize) {
                $ext = getExt($fileInfo['name']);
                // $allowExt=array('jpg','jpeg','png','gif','txt');
                if (in_array($ext, $allowExt)) {
                    $uniName     = getUniqidName();
                    $destination = $path . "/" . pathinfo($fileInfo['name'], PATHINFO_FILENAME) . "_" . $uniName . "." . $ext;
                    if (move_uploaded_file($fileInfo['tmp_name'], $destination)) {
                        $mes = "文件上传成功";
                    } else {
                        $mes = "文件移动失败";
                    }
                } else {
                    $mes = "非法文件类型";
                }
            } else {
                $mes = "文件过大";
            }
        } else {
            $mes = "文件不是通过HTTP POST上传上来的";
        }
    } else {
        // 匹配错误信息
        switch ($fileInfo['error']) {
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
        return $mes;
    }
    return $mes;
}
?>