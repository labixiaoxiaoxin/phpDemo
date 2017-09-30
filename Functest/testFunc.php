<?php 
	header("content-type:text/html;charset=utf-8");
	include_once "common.func.php";

	//获取文件扩展名
	$filename="xiaoxin.php.html";
	echo getExt($filename);
	echo "<hr/>";

	//简易计算器
	echo calc(1,2,"+")."<br/>";
	echo calc(2,3)."<br/>";
	echo calc(8,1.6,"/")."<br/>";
	echo calc(2,4,"%")."<br/>";
	//echo calc("a","b")."<br/>";
	echo "<hr/>";

	//获取当前日期星期
	echo getToday();
	echo "<br/>";
	echo getToday("-","-",null);
	echo "<hr/>";

	//获取验证码
	verify();
	echo "<br/>";
	verify(2,6);
	echo "<br/>";
	verify(1,4);
	echo "<br/>";
 ?>