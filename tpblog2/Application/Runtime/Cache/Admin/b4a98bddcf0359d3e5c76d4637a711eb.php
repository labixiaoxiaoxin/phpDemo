<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>系统管理</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
	<?php include(THEME_PATH.'nav.inc.php');?>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>系统管理 </h1>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-top: 100px;">
				<form class="form-horizontal" action="<?php echo U('Admin/Setting/save');?>" method="post">

				<?php foreach($settings as $key=>$val):?>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $key;?></label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="<?php echo $key;?>" placeholder="请输入账号" value="<?php echo $val;?>">
				    </div>
				  </div>
				<?php endforeach;?>

				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success">点击提交</button>
				    </div>
				  </div>
				</form>
			</div>
		
		</div>
	</div>
	
</body>
</html>