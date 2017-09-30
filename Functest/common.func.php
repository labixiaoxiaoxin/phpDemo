<?php 
	/**
	 * 封装截取文件扩展名的函数：
	 */
	function getExt($filename){
		return pathinfo($filename,PATHINFO_EXTENSION);
	}

	/**
	 * 封装简易计算器：
	 */
	function calc($num1,$num2,$op="+"){
		if (!(is_numeric($num1)||is_numeric($num2))) {
			exit("非法输入。。。");
		}
		switch ($op) {
			case '+':
				$res=$num1+$num2;
				break;
			case '-':
				$res=$num1-$num2;
				break;
			case '*':
				$res=$num1*$num2;
				break;
			case '/':
				if ($num2==0) {
					exit("除数不能为0");
				}
				$res=$num1/$num2;
				break;
			case '%':
				$res=$num1%$num2;
				break;
		}
		return $num1.$op.$num2."=".$res;
	}

	/**
	 * 封装获取当前日期星期的函数：
	 * 要求：可以自定义分隔符
	 */
	function getToday($del1="年",$del2="月",$del3="日"){
		$dayArr=array("日","一","二","三","四","五","六");
		$day=date("w");
		return date("Y{$del1}m{$del2}d{$del3} 星期").$dayArr[$day];
	}

	/**
	 * 封装验证码函数：
	 * 1--数字   2--字母   3--数字+字母 ，默认是3
	 * 可以自定义验证码位数，默认4位
	 */
	function verify($select=3,$times=4){
		// $select=3;
		// $times=4;
		switch ($select) {
			case 1:
				$string="1234567890";
				break;
			case 2:
				$string="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
				break;	
			case 3:
				$string="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
				break;
		}
		$code='';
		for ($i=0; $i < $times; $i++) { 
			$code.='<span style="color:rgb('.mt_rand(0,255).','.mt_rand(0,255).','.mt_rand(0,255).')">'.$string{mt_rand(0,strlen($string)-1)}.'</span>';
			// $code.=mt_rand(0,strlen($string)-1);
		}
		echo $code;
	}
 ?>