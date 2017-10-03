<?php 
	/**
	* 利用GD库实现 验证码 (6位 字母+数字)
	*/

	// 1. 创建画布
	$width=200;
	$height=60;
	$image=imagecreatetruecolor($width, $height);

	// 2. 创建填充颜色
	$white=imagecolorallocate($image, 255, 255, 255);
	imagefilledrectangle($image, 0, 0, 200, 60, $white);

	// 3. 创建画笔颜色
	function getRandColor($image){
		
		return imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	}
	
	//$codestr="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	//range(start,end)：范围创建数组
	//array_merge(array1,array2...)：合并数组
	//join():数组转化为字符串
	$codestr=join('',array_merge(range('0', '9'),range('a', 'z'),range('A', 'Z')));
	//echo $codestr;

	$length=6;
	// 4. 开始绘画
	for ($i=0; $i < $length; $i++) { 	
		$randColor=getRandColor($image);
		$size=mt_rand(20,30);
		$angle=mt_rand(-15,15);
		// $x=40+$i*20;
		// $y=40;
		// 得到字体宽度：imagefontwidth($size)
		$x=($width/$length)*$i+imagefontwidth($size); // 第一个字符=(200/6)*0+字体宽度
		// 得到字体高度：imagefontheight($size)
		$y=mt_rand($height/2,$height-imagefontheight($size));
		$fontfile='fonts/AdobeMyungjoStd-Medium.otf';
		//$text=$codestr{mt_rand(0,strlen($codestr)-1)};
		//str_shuffle($string)：打乱字符串
		$text=str_shuffle($codestr);
		//imagettftext($image, $size, $angle, $x, $y, $randColor, $fontfile, $text);
		imagettftext($image, $size, $angle, $x, $y, $randColor, $fontfile, $text{0});
	}

	// 添加干扰元素
	// 添加像素当做干扰元素  imagesetpixel();
	for ($i=0; $i < 100; $i++) { 
		imagesetpixel($image, mt_rand(0,$width), mt_rand(0,$height), getRandColor($image));
	}
	// 添加线段当做干扰元素  imageline();
	for ($i=0; $i < 3; $i++) { 
		imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), getRandColor($image));
	}
	// 添加圆弧当做干扰元素  imagearc();
	for ($i=0; $i < 2; $i++) { 
		imagearc($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width/2), mt_rand(0,$height/2), mt_rand(0,360), mt_rand(0,360), getRandColor($image));
	}

	// 5. 输出图像
	header("content-type:image/png");
	imagepng($image);
	// 6. 销毁资源
	imagedestroy($image);
 ?>