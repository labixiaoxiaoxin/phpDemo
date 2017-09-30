<?php
	//配置文件
	define("PATH",dirname(__FILE__));

	include(PATH.'/core/db.class.php');
	$db=new db();

	include(PATH.'/core/input.class.php');
	$input=new input();

	//获取系统配置信息
	$sql="SELECT * FROM setting";
	$set_result=$db->query($sql);
	$setting = array();
	while ( $row=$set_result->fetch_array(MYSQLI_ASSOC)) {
		$setting[$row['skey']]=$row['sval'];	
	}
	//var_dump($setting);

?>