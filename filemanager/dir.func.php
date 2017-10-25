<?php
/**
 * 读目录，只读取目录中最外层的内容
 * @param  string $path [description]
 * @return array  $arr  [description]
 */
function readDirectory($path) {
    // 打开指定的目录
    $handle = opendir($path);
    // 读目录
    while (($item = readdir($handle)) !== false) {
        // .和..是两个特殊目录
        if ($item != "." && $item != "..") {
            // 如果目录下的item是文件
            if (is_file($path . "/" . $item)) {
                $arr['file'][] = $item;
            }
            // 如果目录下的item是目录
            if (is_dir($path . "/" . $item)) {
                $arr['dir'][] = $item;
            }
        }
    }
    closedir($handle);
    return $arr;
}
// $path = "file";
// var_dump(readDirectory($path));

/**
 * 创建文件夹
 * @param  [string] $dirname [description]
 * @return [string]          [description]
 */
function createFolder($dirname) {
    if (checkFilename(basename($dirname))) {
        if (!file_exists($dirname)) {
            if (mkdir($dirname, 0777, true)) {
                return "文件夹创建成功";
            } else {
                return "文件夹创建失败";
            }
        } else {
            return "存在同名文件夹";
        }
    } else {
        return "非法文件夹名";
    }
}

/**
 * 递归获取文件夹大小
 * @param  string $path [description]
 * @return number       [description]
 */
function dirSize($path) {
    $sum = 0;
    //定义全局变量，如果不定义，递归后会被释放掉
    global $sum;
    $handle = opendir($path);
    while (($item = readdir($handle)) !== false) {
        if ($item != "." && $item != "..") {
            if (is_file($path . "/" . $item)) {
                $sum += filesize($path . "/" . $item);
            }
            if (is_dir($path . "/" . $item)) {
                // __FUNCTION__ 获取当前函数名
                $func = __FUNCTION__;
                // 递归
                $func($path . "/" . $item);
            }
        }
    }
    closedir($handle);
    return $sum;
}

/**
 * 复制文件夹到指定目录
 * @param  string $src [description]
 * @param  string $dst [description]
 * @return string      [description]
 */
function copyFolder($src, $dst) {
    // 如果目标文件夹不存在则创建
    if (!file_exists($dst)) {
        mkdir($dst, 0777, true);
    }
    $handle = opendir($src);
    while (($item = readdir($handle)) !== false) {
        if ($item != "." && $item != "..") {
            if (is_file($src . "/" . $item)) {
                // 如果是文件，直接copy
                copy($src . "/" . $item, $dst . "/" . $item);
            }
            if (is_dir($src . "/" . $item)) {
                // 如果是目录，则递归
                $func = __FUNCTION__;
                $func($src . "/" . $item, $dst . "/" . $item);
            }
        }
    }
    closedir($handle);
    return "文件夹复制成功";
}

/**
 * 重命名文件夹
 * @param  [string] $oldname [description]
 * @param  [string] $newname [description]
 * @return [string]          [description]
 */
function renameFolder($oldname, $newname) {
    if (checkFilename(basename($newname))) {
        if (!file_exists($newname)) {
            if (rename($oldname, $newname)) {
                return "重命名成功";
            } else {
                return "重命名失败";
            }
        } else {
            return "存在同名文件夹";
        }
    } else {
        return "非法文件夹名称";
    }
}

/**
 * 剪切文件夹
 * @param  [string] $src [description]
 * @param  [string] $dst [description]
 * @return [string]      [description]
 */
function cutFolder($src, $dst) {
    // echo $dst;
    if (file_exists($dst)) {
        if (is_dir($dst)) {
            if (!file_exists($dst . "/" . basename($src))) {
                if (rename($src, $dst . "/" . basename($src))) {
                    return "剪切成功";
                } else {
                    return "剪切失败";
                }
            } else {
                return "存在同名文件夹";
            }
        } else {
            return "不是文件夹";
        }
    } else {
        return "目标文件夹不存在";
    }
}

/**
 * 删除文件夹
 * 1-递归删除所有文件  2-删除所有空文件夹
 * @param  [string] $dirname [description]
 * @return [string]          [description]
 */
function delFolder($dirname) {
    $handle = opendir($dirname);
    while (($item = readdir($handle)) !== false) {
        if ($item != "." && $item != "..") {
            if (is_file($dirname . "/" . $item)) {
                unlink($dirname . "/" . $item);
            }
            if (is_dir($dirname . "/" . $item)) {
                $func = __FUNCTION__;
                $func($dirname . "/" . $item);
            }
        }
    }
    closedir($handle);
    rmdir($dirname);	// 删除所有空文件夹
    return "文件夹删除成功";
}

?>