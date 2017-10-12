<?php

/**
 * 封装图片处理类：
 * 1-获取图片信息        getImageInfo();
 * 2-获得缩略图        thumbImage();
 * 3-设置文字水印        setWatertext();
 * 4-设置图片水印        setWaterpic();
 */
class Image {
    /**
     * 获取图片信息
     * @param  [string] $filename [源文件名]
     * @return [string] $info     [返回数组]
     */
    public function getImageInfo($filename) {
        if (@!$info = getimagesize($filename)) {
            exit("文件不是真实的图片");
        }
        $info = array(
            'width'     => $info['0'],
            'height'    => $info['1'],
            'createFun' => str_replace('/', 'createfrom', $info['mime']),
            'outFun'    => str_replace('/', '', $info['mime']),
            'ext'       => strtolower(image_type_to_extension($info['2'])),
            'mime'      => $info['mime'],
        );
        return $info;
    }

    /**
     * 命名文件并返回完整路径
     * @param  [string] $dest_dir     [文件存放目录]
     * @param  [string] $pre          [文件名前缀]
     * @param  [string] $dstinfo       [文件信息数组]
     * @return [string] $destination [完整文件名]
     */
    private function getDestination($dest_dir, $pre, $dstinfo) {
        if ($dest_dir && !file_exists($dest_dir)) {
            @mkdir($dest_dir, 0777, true);
        }
        $randnum     = mt_rand(100000, 999999);
        $destName    = $pre . $randnum . $dstinfo['ext'];
        $destination = $dest_dir ? $dest_dir . "/" . $destName : $destName;
        return $destination;
    }

    /**
     * 按等比例缩放图片/按倍数缩放图片
     * @param  string  $filename    [源文件名]
     * @param  string  $dst_w       [最大宽度]
     * @param  string  $dst_h       [最大高度]
     * @param  float   $score       [缩放倍数]
     * @param  string  $dest_dir    [存放目录]
     * @param  string  $pre         [文件名前缀]
     * @param  boolean $deleteSouce [是否删除源文件]
     * @return string  $destination [返回完整文件名]
     */
    public function thumbImage($filename, $dst_w = null, $dst_h = null, $score = 0.5, $dest_dir = "thumb", $pre = "thumb_", $deleteSouce = false) {
        $fileinfo  = $this->getImageInfo($filename);
        $src_w     = $fileinfo['width'];
        $src_h     = $fileinfo['height'];
        $arr       = $this->getMultiple($dst_w, $dst_h, $src_w, $src_h);
        $dst_w     = $arr['0'];
        $dst_h     = $arr['1'];
        $dst_image = imagecreatetruecolor($dst_w, $dst_h);
        $src_image = $fileinfo['createFun']($filename);
        imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        $destination = $this->getDestination($dest_dir, $pre, $fileinfo);
        $fileinfo['outFun']($dst_image, $destination);
        imagedestroy($dst_image);
        imagedestroy($src_image);
        if ($deleteSouce) {
            @unlink($filename);
        }
        return $destination;
    }

    /**
     * 等比例缩放/倍数缩放
     * @param  [string] $dst_w [最大宽度]
     * @param  [string] $dst_h [最大高度]
     * @param  [string] $src_w [源文件宽度]
     * @param  [string] $src_h [源文件高度]
     * @return [array]  array  [返回缩放后的宽高]
     */
    private function getMultiple($dst_w, $dst_h, $src_w, $src_h) {
        // 如果指定最大宽高，则按比例缩放
        if (is_numeric($dst_w) && is_numeric($dst_h)) {
            // 等比例缩放算法
            $ratio_orig = $src_w / $src_h;
            if ($dst_w / $dst_h > $ratio_orig) {
                $dst_w = $dst_h * $ratio_orig;
            } else {
                $dst_h = $dst_w / $ratio_orig;
            }
        } else {
            // 如果不指定，则按照指定倍数缩放
            $dst_w = $src_w * $score;
            $dst_h = $src_h * $score;
        }
        return array($dst_w, $dst_h);
    }

    /**
     * 设置文字水印
     * @param string  $filename    [源文件名]
     * @param string  $fontfile    [字体文件]
     * @param string  $text        [水印内容]
     * @param integer $red         [r]
     * @param integer $green       [g]
     * @param integer $blue        [b]
     * @param integer $alpha       [水印透明度]
     * @param integer $size        [文字大小]
     * @param integer $angle       [倾斜角度]
     * @param integer $x           [位置x]
     * @param integer $y           [位置y]
     * @param string  $dest_dir    [存放目录]
     * @param string  $pre         [文件名前缀]
     * @param boolean $deleteSouce [是否删除资源]
     * @return string $destination [返回完整文件名]
     */
    public function setWatertext($filename, $fontfile, $text, $red = 255, $green = 0, $blue = 0, $alpha = 60, $size = 30, $angle = 0, $x = 0, $y = 30, $dest_dir = "water", $pre = "water_text_", $deleteSouce = false) {
        $fileinfo  = $this->getImageInfo($filename);
        $createFun = $fileinfo['createFun'];
        $outFun    = $fileinfo['outFun'];
        $image     = $createFun($filename);
        $color     = imagecolorallocatealpha($image, $red, $green, $blue, $alpha);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        $destination = $this->getDestination($dest_dir, $pre, $fileinfo);
        $outFun($image, $destination);
        imagedestroy($image);
        if ($deleteSouce) {
            @unlink($filename);
        }
        return $destination;
    }

    /**
     * 设置图片水印
     * @param string  $filename    [源文件名]
     * @param string  $logo        [水印图片]
     * @param integer $pos         [九宫格位置]
     * @param integer $pct         [透明度]
     * @param string  $dest_dir    [存放目录]
     * @param string  $pre         [文件名前缀]
     * @param boolean $deleteSouce [是否删除资源]
     * @return string $destination [返回完整文件名]
     */
    public function setWaterpic($filename, $logo, $pos = 1, $pct = 50, $dest_dir = "water", $pre = "water_pic_", $deleteSouce = false) {
        $dstinfo = $this->getImageInfo($filename);
        $srcinfo = $this->getImageInfo($logo);
        $dst_im  = $dstinfo['createFun']($filename);
        $src_im  = $srcinfo['createFun']($logo);
        $src_x   = 0;
        $src_y   = 0;
        $dst_w   = $dstinfo['width'];
        $dst_h   = $dstinfo['height'];
        $src_w   = $srcinfo['width'];
        $src_h   = $srcinfo['height'];
        $arr     = $this->getPosition($pos, $dst_w, $dst_h, $src_w, $src_h);
        $dst_x   = $arr['0'];
        $dst_y   = $arr['1'];
        imagecopymerge($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct);
        $destination = $this->getDestination($dest_dir, $pre, $dstinfo);
        $dstinfo['outFun']($dst_im, $destination);
        imagedestroy($dst_im);
        imagedestroy($src_im);
        if ($deleteSouce) {
            @unlink($filename);
        }
        return $destination;
    }

    /**
     * 图片水印九宫格位置
     * @param  [string] $pos   [位置选择1-9]
     * @param  [string] $dst_w [目标文件宽度]
     * @param  [string] $dst_h [目标文件高度]
     * @param  [string] $src_w [水印文件宽度]
     * @param  [string] $src_h [水印文件高度]
     * @return [array]  array  [返回水印位置]
     */
    private function getPosition($pos, $dst_w, $dst_h, $src_w, $src_h) {
        switch ($pos) {
        case 1:
            $dst_x = 0;
            $dst_y = 0;
            break;
        case 2:
            $dst_x = ($dst_w - $src_w) / 2;
            $dst_y = 0;
            break;
        case 3:
            $dst_x = $dst_w - $src_w;
            $dst_y = 0;
            break;
        case 4:
            $dst_x = 0;
            $dst_y = ($dst_h - $src_h) / 2;
            break;
        case 5:
            $dst_x = ($dst_w - $src_w) / 2;
            $dst_y = ($dst_h - $src_h) / 2;
            break;
        case 6:
            $dst_x = $dst_w - $src_w;
            $dst_y = ($dst_h - $src_h) / 2;
            break;
        case 7:
            $dst_x = 0;
            $dst_y = $dst_h - $src_h;
            break;
        case 8:
            $dst_x = ($dst_w - $src_w) / 2;
            $dst_y = $dst_h - $src_h;
            break;
        case 9:
            $dst_x = $dst_w - $src_w;
            $dst_y = $dst_h - $src_h;
            break;
        default:
            $dst_x = 0;
            $dst_y = 0;
            break;
        }
        return array($dst_x, $dst_y);
    }
}
?>