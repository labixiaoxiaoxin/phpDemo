<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
			  <li><a href="/">首页</a></li>
			  <li><span class="active"><?php echo $read['title'];?></span></li>
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
			
				<div class="panel panel-default">
				  <div class="panel-heading"><b><?php echo $read['title'];?></b>&nbsp;&nbsp;（于 <?php echo date("Y-m-d H:i:s",$read['uptime']);?> 编辑）<p class="pull-right">作者：<?php echo $read['author'];?></p></div>
				  <div class="panel-body">
				    <?php echo html_entity_decode($read['content']);?>
				  </div>
				</div>
			
			</div>
		</div>	
	</div>
</body>
</html>