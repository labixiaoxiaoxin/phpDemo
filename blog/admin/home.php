<?php
	include('check.php');
	//echo "123";
	$sql="SELECT * FROM admin";
	$result=$db->query($sql);
	$rows = array();
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$rows[]=$row;
	}
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title>后台</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

</body>
</html>