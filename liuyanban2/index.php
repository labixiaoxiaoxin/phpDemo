<?php
	session_start();
	include('db_link.php');

	$sql="SELECT * FROM msg ORDER BY id DESC";
	$mysqli_result=$mysqli->query($sql);
	
	$rows=array();
	
	while($row=$mysqli_result->fetch_array()){
		$rows[]=$row;
	}
	//var_dump($rows);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言板</title>
	<style>
		.add{
			width: 600px;
			height: 150px;
			margin: 0 auto;
			overflow: hidden;
		}
		.add .content{
			width: 99%;
			height: 100px;
		}
		.add .username{
			float: left;
		}
		.add .btn{
			float: right;
		}
		.msg{
			width: 600px;
			margin: 0 auto;
			border: 1px solid #ccc;
		}
		.msg .item{
			width: 97%;
			height: 100px;
			border: 1px solid #eee;
			margin: 4px;
			padding: 4px;
			overflow: hidden;
		}
		.msg .item .username{
			float: left;		
		}
		.msg .item .time{
			float: right;
		}
	</style>
</head>
<body>
	<div class="add">
		<form action="save.php" method="post">
			<textarea class="content" name="msg" id="" cols="30" rows="10">留言内容</textarea>
			
			<?php
				if(isset($_SESSION['username'])){
			?>
					<input type="text" name="username" class="username" readonly="readonly" value="<?php echo $_SESSION['username'];?>">
					<a onclick="return confirm('你确定退出吗?')" href="logout.php">退出</a>
			<?php
				}else{
			?>
					<input type="text" name="username" class="username">
					<a href="login.php">请登录</a>
			<?php
				}
			?>
			<input type="submit" value="发表" class="btn">
		</form>
	</div>
	<div class="msg">
		<?php
			foreach ($rows as $key=>$row) {
				$t=date('Y-m-d',$row['intime']);
		?>
		<div class="item">
			<span class="username"><?php echo $row['username'];?></span>
			<span class="time"><?php echo $t;?></span>
			<br>
			<p>
				<?php echo $row['content'];?>
			</p>
			
			<?php
				if(isset($_SESSION['username'])){
			?>
					<div class="time">
						<a href="">编辑</a>
						<a onclick="return confirm('你确定删除吗?')" href="delete.php?id=<?php echo $row['id'];?>">删除</a>
					</div>
			<?php
				}
			?>
		</div>
		<?php
			}
		?>
		
	</div>
</body>
</html>