<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>添加博客</title>
	<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap-3.3.7/css/bootstrap.css">
	<script type="text/javascript" src="/Public/bootstrap-3.3.7/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="/Public/simditor-2.3.6/styles/simditor.css" />
	<script type="text/javascript" src="/Public/simditor-2.3.6/scripts/module.js"></script>
	<script type="text/javascript" src="/Public/simditor-2.3.6/scripts/hotkeys.js"></script>
	<script type="text/javascript" src="/Public/simditor-2.3.6/scripts/uploader.js"></script>
	<script type="text/javascript" src="/Public/simditor-2.3.6/scripts/simditor.js"></script>
</head>
<body>
	<?php include(THEME_PATH.'nav.inc.php');?>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>添加博客 <a href="<?php echo U("/Admin/Blog/index");?>" class="btn btn-default pull-right">返回到列表</a></h1>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form-horizontal" action="<?php echo U('Admin/Blog/save');?>?pid=<?php echo $blog['pid'];?>" method="post">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="title" placeholder="请输入标题" value="<?php echo $blog['title'];?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">作者</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="author" placeholder="请输入作者" value="<?php echo $blog['author'];?>">
				    </div>
				  </div>
				    <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">正文</label>
				    <div class="col-sm-10">
				      <textarea id="editor" class="form-control" name="content" placeholder="请输入作者"><?php echo $blog['content'];?></textarea>
				      <script type="text/javascript">
				      	var editor = new Simditor({
						  textarea: $('#editor'),
						  //optional options
						   upload: {
						   	 url:'<?php echo U("/Admin/Blog/upload");?>',
						   	 fileKey: 'file2'
						   }
						});
				      </script>
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