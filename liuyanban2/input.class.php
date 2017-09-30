<?php
	class input{
		function __construct(){
			
		}
		function post($key){
			if(isset($_POST[$key])){
				$var = $_POST[$key];
				return $var;
			}else{
				return false;
			}
			
		}
		function get($key){
			if(isset($_GET[$key])){
				$var = $_GET[$key];
				return $var;
			}else{
				return false;
			}
		}
	}
?>