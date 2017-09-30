<?php
	include('check.php');
	//echo "123";

	if($input->get('do')=='delete'){
		$aid=$input->get('aid');
		if ($aid==$session_aid) {
			die("不能删除自己");
		}
		$sql="DELETE FROM admin WHERE aid='{$aid}'";
		$is=$db->query($sql);
		if ($is) {
			header('location:auser.php');
		}else{
			die("删除失败！");
		}
	}
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
	<title>管理员管理</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

	<div class="container">
		<div class="row">
			<div class="page-header">
			  	<h1>管理员管理 <a class="pull-right btn btn-primary" href="auser_add.php">添加管理员</a></h1>
			</div>

			<table class="table table-striped">
		      <thead>
		        <tr>
		          <th>ID</th>
		          <th>用户名</th>
		          <th>管理</th>
		        </tr>
		      </thead>
		      <tbody>

		      	<?php foreach($rows as $row):?>
		        <tr>
		          <th scope="row"><?php echo $row['aid'];?> </th>
		          <td><?php echo $row['auser'];?></td>
		          <td>
		          	<a class="btn btn-info btn-xs" href="auser_add.php?aid=<?php echo $row['aid'];?>">修改</a>
		          	<a class="btn btn-danger btn-xs" href="auser.php?do=delete&aid=<?php echo $row['aid'];?>">删除</a>
		          </td>
		        </tr>
			   <?php endforeach;?>   
			   
		      </tbody>
		    </table>
		</div>
	</div>
</body>
</html>