<?php
	include('check.php');
	
	$pid=$input->get('pid');
	//初始值设为空
	$blog = array('title' =>'' ,'author'=>'','content'=>'', );
	//var_dump($aid);

	//点击修改传过来aid，如果存在则获取该aid的内容
	if ($pid>0) {
		$sql="SELECT * FROM page WHERE pid='{$pid}'";
		$res=$db->query($sql);
		$blog=$res->fetch_array(MYSQLI_ASSOC);
	}
	

	//点击添加管理员传过来do动作
	if ($input->get('do')=='add') {
		$title=$input->post('title');
		$author=$input->post('author');
		$content=$input->post('content');
		//var_dump($auser);
		//不允许添加空的账号密码
		if(empty($title)||empty($author)||empty($content)){
			die("标题、作者、内容不能为空");
		}

		/*
		//检查用户名是否重复
		$sql="SELECT * FROM admin WHERE auser='{$auser}' and aid <>'{$aid}'";
		$res=$db->query($sql);
		if ($res->fetch_array()) {
			die("用户名不能重复。");
		}*/

		
		//$aid<1表示没有传递aid过来，此时执行的是插入操作，否则执行修改操作
		
		if ($pid<1) {
			//插入数据
			$intime=time()+8*60*60;
			$sql="INSERT INTO page (`title`,`author`,`content`,`intime`,`uptime`) VALUES('{$title}','{$author}','{$content}','{$intime}','{$intime}')";
		
		}else{
			//修改数据
			$uptime=time()+8*60*60;
			$sql="UPDATE page SET title='{$title}',author='{$author}',content='{$content}',uptime='{$uptime}' WHERE pid='{$pid}'";
		}
		var_dump($sql);
		$is=$db->query($sql);
		if($is){
				header('location:blog.php');
			}else{
				die("执行失败!");
		}
	}
	
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加博客</title>
	<?php include(PATH.'/header.inc.php');?>

	<!--Simditor编辑器-->
	<link rel="stylesheet" type="text/css" href="../themes/simditor-2.3.6/styles/simditor.css" />
	<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/module.js"></script>
	<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/hotkeys.js"></script>
	<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/uploader.js"></script>
	<script type="text/javascript" src="../themes/simditor-2.3.6/scripts/simditor.js"></script>

</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

	<div class="container">
		<div class="row">
			<div class="page-header">
			  	<h1>添加博客 <a class="pull-right btn btn-default" href="blog.php">返回</a></h1>
			</div>
			
			<!--点击提交时，如果有do动作，则表示是添加；如果有aid，则表示是修改。-->
			<!--此处传递aid是为了点击提交之后仍然可以传递aid执行修改操作。第一次由上个页面传过来的aid是执行获取数据动作，第二次传给自身是执行修改动作。-->
			<form class="form-horizontal" action="blog_add.php?do=add&pid=<?php echo $pid;?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
			    <div class="col-sm-6">
			    	
			      <input type="text" class="form-control" name="title" placeholder="请输入标题" value="<?php echo $blog['title'];?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" name="author" placeholder="请输入作者" value="<?php echo $blog['author'];?>">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
			    <div class="col-sm-8">
			      <textarea  class="form-control" id="editor" name="content" placeholder="请输入内容" style="height: 200px;"><?php echo $blog['content'];?></textarea>
			      
			      <!--Simditor编辑器的配置-->
			      <script type="text/javascript">
			      	var editor = new Simditor({
					  textarea: $('#editor'),
					  upload:{
					  	url: 'blog_upload.php',
					    params: null,
					    fileKey: 'upload_file'
					  } 
					   	
					});
			      </script>

			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-6">
			      <input type="submit" class="btn btn-success" value="确定提交"></input>
			    </div>
			  </div>
			</form>
			
		</div>
	</div>
</body>
</html>