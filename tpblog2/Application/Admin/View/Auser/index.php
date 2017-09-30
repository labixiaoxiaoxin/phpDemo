<!DOCTYPE html>
<html>
<head>
	<title>管理员管理</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
	<?php include(THEME_PATH.'nav.inc.php');?>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>管理员管理 <a href="<?php echo U("/Admin/Auser/add");?>" class="btn btn-primary pull-right">添加管理员</a></h1>
			</div>
			
			<table class="table table-striped">
		      <thead>
		        <tr>
		          <th class="col-md-4">AID</th>
		          <th class="col-md-4">用户名</th>
		          <th class="col-md-4">管理</th>	      
		        </tr>
		      </thead>
		      <tbody>
		      	<?php foreach($users as $user):?>
			        <tr>
			          <th scope="row"><?php echo $user['aid'];?></th>
			          <td><?php echo $user['auser'];?></td>
			          <td>
			          	<a href="<?php echo U("/Admin/Auser/add");?>?aid=<?php echo $user['aid'];?>" class="btn btn-xs btn-info">修改</a>
			          	<a href="<?php echo U("/Admin/Auser/delete");?>?aid=<?php echo $user['aid'];?>" class="btn btn-xs btn-danger">删除</a>
			          </td>
			        </tr>
		     	<?php endforeach;?>
		      </tbody>
		    </table>
		</div>
	</div>
	
</body>
</html>