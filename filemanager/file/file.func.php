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
    return round($size, 2) . $arr[$i];
}

function createFile($filename) {
    // 验证文件名的合法性，是否包含/，*，<,>,?,|
    $pattern="/[\/,\*,<>,\?\|]/";
    if (!preg_match($pattern, basename($filename))) {
    	// 检测当前目录下是否存在同名文件
    	// 检测当前目录下是否存在同名文件
    	if (!file_exists($filename)) {
    		// 通过touch函数创建
    		if (touch($filename)) {
    			return "文件创建成功";
    		}else{
    			return "文件创建失败";
    		}
    	}else{
    		return "文件已存在，请重命名后创建";
    	}
    }else{
    	return "非法文件名";
    }
}

?>