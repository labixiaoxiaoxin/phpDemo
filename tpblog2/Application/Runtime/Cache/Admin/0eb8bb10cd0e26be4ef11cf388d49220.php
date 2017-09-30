<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>管理员登录</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="panel panel-primary" style="margin-top: 200px;">
			  <div class="panel-heading">管理员登录</div>
			  <div class="panel-body">
			    <form class="form-horizontal" action="<?php echo U('Admin/Login/index');?>?do=chk" method="post">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="auser" placeholder="请输入账号">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name="apass" placeholder="请输入密码">
				    </div>
				  </div>
				 
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-primary">点击登录</button>
				    </div>
				  </div>
				</form>
			  </div>
			  <div class="panel-footer text-right">版权所有 盗版必究</div>
			</div>
		</div>
	</div>

</div>
</body>
</html>