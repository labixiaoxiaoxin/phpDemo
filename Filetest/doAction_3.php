<?php

require_once "function/upload.func.php";
$fileinfo = $_FILES['myfile'];
var_dump($fileinfo);
$path = "uploads";
// $path="pics";
// $allowext="txt";
$allowext = array('jpg', 'jpeg', 'png', 'gif', 'txt', 'html');
// $result=uploadFile($fileinfo);
// $result=uploadFile($fileinfo,$path);
$result = uploadFile($fileinfo, $path, false, $allowext);
var_dump($result);
?>