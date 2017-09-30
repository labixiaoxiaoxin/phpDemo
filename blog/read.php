<?php
	include('config.php');

	$pid=(int)$input->get('pid');
	$sql="SELECT * FROM page WHERE pid='{$pid}'";
	$res=$db->query($sql);
	
	$rows=array();
	while ($row=$res->fetch_array(MYSQLI_ASSOC)) {
		$rows[]=$row;
	}
	
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $setting['title']?></title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="jumbotron">
			  <h1><?php echo $setting['title']?></h1>
			  <p><?php echo $setting['intro']?></p>
			</div>
		</div>

		<ol class="breadcrumb">
			<li><a href="/">首页</a></li>
			<li class="active">博客详情</li>
		</ol>

		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-heading">作者简介</div>
			  <div class="panel-body">
			    Panel content
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">数据统计</div>
			  <div class="panel-body">
			    Panel content
			  </div>
			</div>
		</div>

		<div class="col-md-9">
			<?php foreach($rows as $row):?>
				<div class="panel panel-default">
				  <div class="panel-heading">
				  	<?php echo $row['title'];?>
				  </div>
				  <div class="panel-body">
				    <?php echo $row['content'];?>
				  </div>
				</div>
			<?php endforeach;?>

		</div>

	</div>
</body>
</html>