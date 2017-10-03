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
		if ($dest_dir && (!is_file($dest_dir))) {
			@mkdir($dest_dir,0777,true);
		}
		$destName=$pre.mt_rand(100000,999999).$fileinfo['ext'];
		$destination=$dest_dir?$dest_dir."/".$destName:$destName;
		// echo $destination;exit;
		$fileinfo['outFun']($dst_image,$destination);
		imagedestroy($dst_image);
		imagedestroy($src_image);
		if ($deleteSouce) {
			@unlink($filename);
		}
		return $destination;
	}
 ?>
