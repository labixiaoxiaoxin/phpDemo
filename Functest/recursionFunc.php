<?php
	header("content-type:text/html;charset=utf-8");
/**
 * 递归函数
 * 注意：不能无限递归
 */
	function test1($i){
		echo $i."<br/>";	//陆续显示 4 3 2 1 0
		--$i;
		//echo $i."<br/>";
		if ($i>=0) {
			test1($i);
		}
		echo $i."<br/>";	//陆续显示 -1 0 1 2 3
	}
	test1(4);	//结果为 4 3 2 1 0 -1 0 1 2 3
	echo "<hr/>";
/**
 * __FUNCTION__ :获得当前函数名
 */
	function test2($i){
		echo $i."<br/>";
		--$i;
		//echo $i."<br/>";
		if ($i>=0) {
			$func=__FUNCTION__;
			$func($i);
		}
		echo $i."<br/>";
	}
	test2(4);	//结果为 4 3 2 1 0 -1 0 1 2 3
?>