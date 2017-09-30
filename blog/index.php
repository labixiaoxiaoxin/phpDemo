<?php
	include('config.php');
	$sql="SELECT * FROM page ORDER BY pid DESC LIMIT 0,10";
	$blogs=$db->query($sql);
	
	$rows=array();
	while ($row=$blogs->fetch_array(MYSQLI_ASSOC)) {
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
			<li class="active"><a href="/">首页</a></li>
		</ol>


		<div class="row">
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
					  	<a href="read.php?pid=<?php echo $row['pid']?>"><?php echo $row['title'];?></a>
					  </div>
					  <div class="panel-body">
					    <?php echo mb_substr( $row['content'], 0, 200);?>...
					  </div>
					</div>
				<?php endforeach;?>

			</div>
		</div>

	</div>
</body>
</html>