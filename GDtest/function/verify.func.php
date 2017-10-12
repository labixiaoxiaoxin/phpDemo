<?php
/**
 * @param  string   $fontfile  字体文件(注意路径)
 * @param  integer  $type      1:数字 2:字母 3:数字+字母 4:汉字
 * @param  integer  $length    验证码长度
 * @param  integer  $pixel     像素点个数
 * @param  integer  $line      线段数
 * @param  integer  $arc       圆弧数
 * @param  integer  $width     宽度
 * @param  integer  $heiht     高度
 * @return void
 */
function getVerify($fontfile = '../fonts/simsun.ttc', $type = 3, $length = 4, $VerifyCode = 'verifycode', $pixel = 100, $line = 3, $arc = 0, $width = 200, $height = 50) {
    //创建画布
    // $width=200;
    // $height=50;
    $image = imagecreatetruecolor($width, $height);
    //创建填充颜色
    $white = imagecolorallocate($image, 255, 255, 255);
    //创建填充矩形
    imagefilledrectangle($image, 0, 0, $width, $height, $white);
    //画笔颜色
    function getRandColor($image) {
        return imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    }
    /**
     * 绘制随机字符
     * 1-数字
     * 2-字母
     * 3-数字+字母
     * 4-汉字
     */
    // $type=4;
    // $length=4;
    switch ($type) {
    case 1:
        // 1-数字
        $string = join('', array_rand(range('0', '9'), $length));
        break;
    case 2:
        // 2-字母    array_rand():取数组下标
        //            array_merge():合并数组
        //            array_flip():键和值互换
        $string = join('', array_rand(array_flip(array_merge(range('a', 'z'), range('A', 'Z'))), $length));
        break;
    case 3:
        // 3-数字+字母
        $string = join('', array_rand(array_flip(array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'))), $length));
        break;
    case 4:
        // 4-汉字   explode(",", $str):以逗号分隔字符串，返回数组
        $str    = "在,十,九,大,代,表,选,举,中,党,和,国,家,领,导,人,参,选,当,选,的,过,程,充,分,体,现,了,以,习,近,平,同,志,为,核,心,的,党,中,央,着,眼,长,远,立,足,实,践,的,战,略,眼,光,和,历,史,担,当,展,示,了,党,和,国,家,领,导,人,率,先,垂,范,心,系,基,层,推,动,形,成,良,好,政,治,生,态,的,实,际,行,动";
        $arr    = explode(",", $str);
        $string = join('', array_rand(array_flip($arr), $length));
        //echo $string;
        break;
    default:
        exit("非法参数");
        break;
    }

    $_SESSION[$VerifyCode] = $string;
    //随机颜色
    for ($i = 0; $i < $length; $i++) {
        $size  = mt_rand(18, 23);
        $angle = mt_rand(-20, 20);
        $x     = ($width / $length) * $i + imagefontwidth($size);
        $y     = mt_rand(ceil($height / 2), $height - imagefontheight($size));
        // $fontfile='../fonts/simsun.ttc';
        $text = mb_substr($string, $i, 1, 'utf-8');
        imagettftext($image, $size, $angle, $x, $y, getRandColor($image), $fontfile, $text);
    }

    // $pixel=100;
    // $line=3;
    // $arc=2;
    //添加像素干扰元素
    if ($pixel > 0) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, 255), mt_rand(0, 255), getRandColor($image));
        }
    }
    //添加线段干扰元素
    if ($line > 0) {
        for ($i = 0; $i < $line; $i++) {
            imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), getRandColor($image));
        }
    }
    //添加圆弧干扰元素
    if ($arc > 0) {
        for ($i = 0; $i < $arc; $i++) {
            imagearc($image, mt_rand(0, $width / 2), mt_rand(0, $height / 2), mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, 360), mt_rand(0, 360), getRandColor($image));
        }
    }

    header("content-type:image/png");
    imagepng($image);
    imagedestroy($image);
}; //getVerify(4,4);
?>