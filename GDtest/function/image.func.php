<?php 
	/**
	 * 获取图片文件信息
	 * @param  [type] $filename 文件名
	 * @return [type] 返回包括文件宽度、高度、crateFun、outFun和后缀名的数组          
	 */
	function getFileinfo($filename){
		if (@!$info=getimagesize($filename)) {
			exit("文件不是真实的图片");
		}
		// var_dump($info);
		$fileinfo['width']=$info['0'];
		// var_dump($fileinfo['width']);
		$fileinfo['height']=$info['1'];
		// 通过类型标记获得mime字段  image_type_to_mime_type()
		$mime=image_type_to_mime_type($info['2']);
		$fileinfo['createFun']=str_replace('/', 'createfrom', $mime);
		$fileinfo['outFun']=str_replace('/', '', $mime);
		// 通过类型标记获得后缀名    image_type_to_extension()
		$fileinfo['ext']=strtolower(image_type_to_extension($info['2']));
		return $fileinfo;
	}

	/**
	 * 取得保存文件完整路径
	 * @param  string $dest_dir [保存目录]
	 * @param  string $pre      [文件前缀]
	 * @param  string $dstinfo  [文件信息数组]
	 * @return string $destination     [返回文件完整路径]
	 */
	function getDestination($dest_dir,$pre,$dstinfo){
		if ($dest_dir && !file_exists($dest_dir)) {
				@mkdir($dest_dir,0777,true);
			}
		$randnum=mt_rand(100000,999999);
		$destName=$pre.$randnum.$dstinfo['ext'];
		$destination=$dest_dir?$dest_dir."/".$destName:$destName;
		return $destination;
	}

	/**
	 * 缩放图片：
	 * 指定最大宽和高，按比例缩放；不指定按默认倍数缩放
	 * 可以指定文件存放目录
	 * 可以指定文件命名前缀
	 * 可以指定是否删除源图片文件
	 * @param  [type]  $filename    源图片文件名
	 * @param  [type]  $dst_w       指定最大宽度
	 * @param  [type]  $dst_h       指定最大高度
	 * @param  float   $scare       指定缩放倍数
	 * @param  string  $dest_dir    指定文件存放目录，默认thumb
	 * @param  string  $pre         指定文件前缀，默认thumb_
	 * @param  boolean $deleteSouce 是否删除源文件，默认false
	 * @return [type]               返回文件路径
	 */
	function thumbImage($filename,$dst_w=null,$dst_h=null,$scare=0.5,$dest_dir="thumb",$pre="thumb_",$deleteSouce=false){

		// $filename="../images/2.jpg";
		// $pre="thumb_"; // 指定前缀
		// $dest_dir="thumb";
		// $deleteSouce=false;
		
		// var_dump(getFileinfo($filename));
		$fileinfo=getFileinfo($filename);
		$src_w=$fileinfo['width'];
		$src_h=$fileinfo['height'];

		// 指定最大宽高和缩放比例
		// $scare=0.5;
		// $dst_w=600;
		// $dst_h=300;
		
		// 如果指定最大宽高，则按比例缩放
		if (is_numeric($dst_w)&&is_numeric($dst_h)) {
			// 等比例缩放算法
			$ratio_orig = $src_w/$src_h;
			if ($dst_w/$dst_h > $ratio_orig) {
			   $dst_w = $dst_h*$ratio_orig;
			} else {
			   $dst_h = $dst_w/$ratio_orig;
			}
		}else{
			// 如果不指定，则按照指定倍数缩放
			$dst_w=$src_w*$scare;
			$dst_h=$src_h*$scare;
		}
		$dst_image=imagecreatetruecolor($dst_w, $dst_h);
		$src_image=$fileinfo['createFun']($filename);
		imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
		// 此处封装为函数
		// if ($dest_dir && (!is_file($dest_dir))) {
		// 	@mkdir($dest_dir,0777,true);
		// }
		// $destName=$pre.mt_rand(100000,999999).$fileinfo['ext'];
		// $destination=$dest_dir?$dest_dir."/".$destName:$destName;
		$destination=getDestination($dest_dir,$pre,$fileinfo);
		// echo $destination;exit;
		$fileinfo['outFun']($dst_image,$destination);
		imagedestroy($dst_image);
		imagedestroy($src_image);
		if ($deleteSouce) {
			@unlink($filename);
		}
		return $destination;
	}

	/**
	 * 添加文字水印
	 * @param string  $filename    [源文件名]
	 * @param string  $fontfile    [字体文件]
	 * @param string  $text        [水印文字]
	 * @param integer $red         [r]
	 * @param integer $green       [g]
	 * @param integer $blue        [b]
	 * @param integer $alpha       [水印透明度]
	 * @param integer $size        [文字大小]
	 * @param integer $angle       [角度]
	 * @param integer $x           [位置x]
	 * @param integer $y           [位置y]
	 * @param string  $dest_dir    [保存目录]
	 * @param string  $pre         [文件名前缀]
	 * @param boolean $deleteSouce [是否删除源文件]
	 * @return string               返回文件路径
	 */
	function setWatertext($filename,$fontfile,$text,$red=255,$green=0,$blue=0,$alpha=60,$size=30,$angle=0,$x=0,$y=30,$dest_dir="water",$pre="water_text_",$deleteSouce=false){
		// $filename="../images/2.jpg";
		// $fileinfo=getimagesize($filename);
		$fileinfo=getFileinfo($filename);
		// $mime=$fileinfo['mime'];
		// $createFun=str_replace("/", "createfrom", $mime);
		$createFun=$fileinfo['createFun'];
		// $outFun=str_replace("/", "", $mime);
		$outFun=$fileinfo['outFun'];
		$image=$createFun($filename);
		// $red=255;
		// $green=0;
		// $blue=0;
		// $alpha=60;
		$color=imagecolorallocatealpha($image, $red, $green, $blue, $alpha);
		// $size=30;
		// $angle=0;
		// $x=0;
		// $y=30;
		// $fontfile="../fonts/simsun.ttc";
		// $text="xiaoxin";
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
		// $dest_dir="water";
		// $pre="water_text";
		
		// // 此处封装为函数
		// if ($dest_dir && !file_exists($dest_dir)) {
		// 	@mkdir($dest_dir,0777,true);
		// }
		// $randnum=mt_rand(100000,999999);
		// $destName=$pre.$randnum.$fileinfo['ext'];
		// // $destination=$dest_dir."/".$destName;
		// $destination=$dest_dir?$dest_dir."/".$destName:$destName;
		$destination=getDestination($dest_dir,$pre,$fileinfo);
		$outFun($image,$destination);
		imagedestroy($image);
		// $deleteSouce=false;
		if ($deleteSouce) {
				@unlink($filename);
			}
		return $destination;
	}

	/**
	 * 添加图片水印
	 * @param string  $filename    [源文件名]
	 * @param string  $logo        [水印文件名]
	 * @param integer $pos         [位置选择]
	 * @param integer $pct         [水印透明度]
	 * @param string  $dest_dir    [保存目录]
	 * @param string  $pre         [文件名前缀]
	 * @param boolean $deleteSouce [是否删除源文件]
	 * @return string               返回文件路径
	 */
	function setWaterpic($filename,$logo,$pos=1,$pct=50,$dest_dir="water",$pre="water_pic_",$deleteSouce=false){
		// $logo="../images/php_logo.png";
		// $filename="../images/thum_xx.jpg";
		// $dest_dir="water";
		// $pre="water_pic_";
		// $pos=1;
		// $pct=50;
		$dstinfo=getFileinfo($filename);
		$srcinfo=getFileinfo($logo);
		$dst_im=$dstinfo['createFun']($filename);
		$src_im=$srcinfo['createFun']($logo);
		$src_x=0;
		$src_y=0;
		$dst_w=$dstinfo['width'];
		$dst_h=$dstinfo['height'];
		$src_w=$srcinfo['width'];
		$src_h=$srcinfo['height'];
		switch ($pos) {
			case 1:
				$dst_x=0;
				$dst_y=0;
				break;
			case 2:
				$dst_x=($dst_w-$src_w)/2;
				$dst_y=0;
				break;
			case 3:
				$dst_x=$dst_w-$src_w;
				$dst_y=0;
				break;
			case 4:
				$dst_x=0;
				$dst_y=($dst_h-$src_h)/2;
				break;
			case 5:
				$dst_x=($dst_w-$src_w)/2;
				$dst_y=($dst_h-$src_h)/2;
				break;
			case 6:
				$dst_x=$dst_w-$src_w;
				$dst_y=($dst_h-$src_h)/2;
				break;
			case 7:
				$dst_x=0;
				$dst_y=$dst_h-$src_h;
				break;
			case 8:
				$dst_x=($dst_w-$src_w)/2;
				$dst_y=$dst_h-$src_h;
				break;
			case 9:
				$dst_x=$dst_w-$src_w;
				$dst_y=$dst_h-$src_h;
				break;
			default:
				$dst_x=0;
				$dst_y=0;
				break;
		}
		imagecopymerge($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct);
		// 此处封装为函数
		// if ($dest_dir && !file_exists($dest_dir)) {
		// 		@mkdir($dest_dir,0777,true);
		// 	}
		// $randnum=mt_rand(100000,999999);
		// $destName=$pre.$randnum.$dstinfo['ext'];
		// $destination=$dest_dir?$dest_dir."/".$destName:$destName;
		$destination=getDestination($dest_dir,$pre,$dstinfo);
		$dstinfo['outFun']($dst_im,$destination);
		imagedestroy($dst_im);
		imagedestroy($src_im);
		if ($deleteSouce) {
				@unlink($filename);
			}
		return $destination;
	}

 ?>
