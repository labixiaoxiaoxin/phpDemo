<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>添加管理员</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
	<?php include(THEME_PATH.'nav.inc.php');?>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>添加管理员 <a href="<?php echo U("/Admin/Auser/index");?>" class="btn btn-default pull-right">返回到列表</a></h1>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-top: 100px;">
				<form class="form-horizontal" action="<?php echo U('Admin/Auser/save');?>?aid=<?php echo $auser['aid'];?>" method="post">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="auser" placeholder="请输入账号" value="<?php echo $auser['auser'];?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name="apass" placeholder="请输入密码" value="<?php echo $auser['apass'];?>">
				    </div>
				  </div>
				 
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