<?php
/**
 * 构建上传文件的信息
 * @return [array] [返回一个包含文件信息的数组]
 */
function getFiles() {
    $i = 0;
    foreach ($_FILES as $file) {
        //foreach消掉一层数组
        if (is_string($file['name'])) {
            //当$file['name']是string时，为单文件上传
            $files[$i] = $file;
            $i++;
        } else if (is_array($file['name'])) {
            //当$file['name']是array时，为多文件
            foreach ($file['name'] as $key => $value) {
                // $files[$i]['name']=$value;
                $files[$i]['name']     = $file['name'][$key];
                $files[$i]['type']     = $file['type'][$key];
                $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                $files[$i]['error']    = $file['error'][$key];
                $files[$i]['size']     = $file['size'][$key];
                $i++;
            }
        }
    }
    return $files;
}

/**
 * 单文件、多个单文件、多文件上传函数
 * @param  array   $fileinfo [文件信息数组]
 * @param  string  $path     [保存路径]
 * @param  boolean $flag     [是否检测真实图片]
 * @param  integer $maxsize  [最大文件大小]
 * @param  array   $allowExt [允许上传类型]
 * @return array             [返回数组，mes和dest]
 */
function uploadFile($fileinfo, $path = "./uploads", $flag = true, $maxsize = 2097152, $allowExt = array('jpg', 'jpeg', 'png', 'gif')) {
    // $maxsize=2097152;
    // $flag=true;
    // $allowExt=array('jpg','jpeg','png','gif');
    // 判断错误号
    if ($fileinfo['error'] === UPLOAD_ERR_OK) {
        // 判断上传文件大小
        if ($fileinfo['size'] > $maxsize) {
            $res['mes'] = $fileinfo['name'] . "上传文件过大";
        }
        // 检测上传文件类型
        $ext = getExt($fileinfo['name']);
        if (!in_array($ext, $allowExt)) {
            $res['mes'] = $fileinfo['name'] . "非法文件类型";
        }
        // 检测是否为真实图片类型
        if ($flag) {
            if (!getimagesize($fileinfo['tmp_name'])) {
                $res['mes'] = $fileinfo['name'] . "不是真实图片类型";
            }
        }
        // 检测文件是否是通过HTTP POST上传的
        if (!is_uploaded_file($fileinfo['tmp_name'])) {
            $res['mes'] = $fileinfo['name'] . "文件不是通过HTTP POST上传的";
        }
        if (@$res) {
            return $res;
        }
        // 如果$res存在，证明就已经出错了，不用继续执行下去
        // $path="./uploads";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        $uniName     = getUniname();
        $destination = $path . '/' . $uniName . '.' . $ext;
        if (!move_uploaded_file($fileinfo['tmp_name'], $destination)) {
            $res['mes'] = $fileinfo['name'] . "文件上传失败";
        }
        $res['mes']  = $fileinfo['name'] . "文件上传成功";
        $res['dest'] = $destination;
        return $res;
    } else {
        // 匹配错误信息
        switch ($fileinfo['error']) {
        case 1:
            $res['mes'] = "上传文件超过了upload_max_filesize限制的值";
            break;
        case 2:
            $res['mes'] = "上传文件超过了html表单中MAX_FILE_SIZE指定值";
            break;
        case 3:
            $res['mes'] = "文件只有部分被上传";
            break;
        case 4:
            $res['mes'] = "文件没有被上传";
            break;
        case 6:
            $res['mes'] = "找不到临时文件夹";
            break;
        case 7:
            $res['mes'] = "文件写入失败";
            break;
        case 8:
            $res['mes'] = "上传的文件被PHP扩展程序中断";
            break;
        }
        return $res;
    }
}
