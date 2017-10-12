<?php 
	// 检测是否为真实图片
	// 如果是则返回数组，如果不是则返回false
	$filename="false_pic.jpg";
	$filename1="real_pic.png";
	var_dump(getimagesize($filename));
	var_dump(getimagesize($filename1));
 ?>