<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="jumbotron">
			  <h3><?php echo $cfg['title'];?></h3>
			  <p><?php echo $cfg['intro'];?></p>
			</div>

			<ol class="breadcrumb">
			  <li><a href="#">首页</a></li>

			</ol>

			<div class="left col-md-3">
				<div class="panel panel-default">
				  <div class="panel-heading">Panel heading without title</div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>

				<div class="panel panel-default">
				  <div class="panel-heading">Panel heading without title</div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
			<div class="right col-md-9">
			<?php foreach($blogs as $blog):?>
				<div class="panel panel-default">
				  <div class="panel-heading"><a href="<?php echo U('Home/Index/read');?>?pid=<?php echo $blog['pid'];?>"><?php echo $blog['title'];?></a></div>
				  <div class="panel-body">
				    <?php echo html_entity_decode($blog['content']);?>
				  </div>
				</div>
			<?php endforeach;?>
			</div>
		</div>	
	</div>
</body>
</html>