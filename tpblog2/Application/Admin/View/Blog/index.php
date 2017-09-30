<!DOCTYPE html>
<html>
<head>
	<title>博客管理</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>
</head>
<body>
	<?php include(THEME_PATH.'nav.inc.php');?>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>博客管理 <a href="<?php echo U("/Admin/Blog/add");?>" class="btn btn-primary pull-right">添加博客</a></h1>
			</div>
			
			<table class="table table-striped">
		      <thead>
		        <tr>
		          <th class="col-md-2">PID</th>
		          <th class="col-md-2">标题</th>
		          <th class="col-md-2">作者</th>	 
		          <th class="col-md-2">插入时间</th>
		          <th class="col-md-2">修改时间</th>
		          <th class="col-md-2">管理</th>	      
		        </tr>
		      </thead>
		      <tbody>
		      	<?php foreach($blogs as $blog):?>
			        <tr>
			          <th scope="row"><?php echo $blog['pid'];?></th>
			          <td><?php echo $blog['title'];?></td>
			          <td><?php echo $blog['author'];?></td>
			          <td><?php echo date('Y-m-d H:i:s',$blog['intime']);?></td>
			          <td><?php echo date('Y-m-d H:i:s',$blog['uptime']);?></td>
			          <td>
			          	<a href="<?php echo U("/Admin/Blog/add");?>?pid=<?php echo $blog['pid'];?>" class="btn btn-xs btn-info">修改</a>
			          	<a href="<?php echo U("/Admin/Blog/delete");?>?pid=<?php echo $blog['pid'];?>" class="btn btn-xs btn-danger">删除</a>
			          </td>
			        </tr>
		     	<?php endforeach;?>
		      </tbody>
		    </table>
		    <?php echo $show;?>
		</div>
	</div>
	
</body>
</html>