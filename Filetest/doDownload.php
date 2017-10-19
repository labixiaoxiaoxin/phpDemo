<?php
	/**
	 * 下载文件
	 * @var [type]
	 */
	$filename=$_GET['filename'];
	// 文件名如果有路径，则下载时也会带路径
	// header('content-disposition:attachment;filename=2333_'.$filename);
	// Content-Disposition:attachment 就是当用户想把请求所得的内容存为一个文件的时候提供一个默认的文件名
	header('content-disposition:attachment;filename=2333_'.basename($filename));
	// content-length 告诉浏览器文件大小
	header('content-length:'.filesize($filename));
	// readfile() 函数输出一个文件
	readfile($filename);
?>