<?php
	include('input.class.php');
	include('db_link.php');

	$input=new input();
	$id=$input->get('id');
	//var_dump($id);
	$sql="DELETE FROM msg WHERE id={$id}";
	$mysqli->query($sql);
	header('location:index.php');
?>