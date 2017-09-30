<?php
	include('check.php');
	//echo "123";
	/*
	if($input->get('do')=='delete'){
		$aid=$input->get('aid');
		if ($aid==$session_aid) {
			die("不能删除自己");
		}
		$sql="DELETE FROM admin WHERE aid='{$aid}'";
		$is=$db->query($sql);
		if ($is) {
			header('location:auser.php');
		}else{
			die("删除失败！");
		}
	}*/
	$aid=$input->get('aid');
	//初始值设为空
	$auser = array('auser' =>'' ,'apass'=>'', );
	//var_dump($aid);

	//点击修改传过来aid，如果存在则获取该aid的内容
	if ($aid>0) {
		$sql="SELECT * FROM admin WHERE aid='{$aid}'";
		$res=$db->query($sql);
		$auser=$res->fetch_array(MYSQLI_ASSOC);
	}

	//点击添加管理员传过来do动作
	if ($input->get('do')=='add') {
		$auser=$input->post('auser');
		$apass=$input->post('apass');
		//var_dump($auser);
		//不允许添加空的账号密码
		if(empty($auser)||empty($apass)){
			die("账号或密码不能为空");
		}

		//检查用户名是否重复
		$sql="SELECT * FROM admin WHERE auser='{$auser}' and aid <>'{$aid}'";
		$res=$db->query($sql);
		if ($res->fetch_array()) {
			die("用户名不能重复。");
		}

		//$aid<1表示没有传递aid过来，此时执行的是插入操作，否则执行修改操作
		if ($aid<1) {
			//插入数据
			$sql="INSERT INTO admin (`auser`,`apass`) VALUES('{$auser}','{$apass}')";
		}else{
			//修改数据
			$sql="UPDATE admin SET auser='{$auser}',apass='{$apass}' WHERE aid='{$aid}'";
		}
		
		$is=$db->query($sql);
		if($is){
				header('location:auser.php');
			}else{
				die("执行失败!");
		}
	}
	
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加管理员</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

	<div class="container">
		<div class="row">
			<div class="page-header">
			  	<h1>添加管理员 <a class="pull-right btn btn-default" href="auser.php">返回</a></h1>
			</div>
			
			<!--点击提交时，如果有do动作，则表示是添加；如果有aid，则表示是修改。-->
			<!--此处传递aid是为了点击提交之后仍然可以传递aid执行修改操作。第一次由上个页面传过来的aid是执行获取数据动作，第二次传给自身是执行修改动作。-->
			<form class="form-horizontal" action="auser_add.php?do=add&aid=<?php echo $aid;?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-3 control-label">账号</label>
			    <div class="col-sm-6">
			    	<!--用户名预设为空，插入操作时生效；如果是修改操作，则获取对应值-->
			      <input type="text" class="form-control" name="auser" placeholder="请输入账号" value="<?php echo $auser['auser'];?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-3 control-label">密码</label>
			    <div class="col-sm-6">
			      <input type="password" class="form-control" name="apass" placeholder="请输入密码" value="<?php echo $auser['apass'];?>">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-6">
			      <input type="submit" class="btn btn-success" value="确定提交"></input>
			    </div>
			  </div>
			</form>
			
		</div>
	</div>
</body>
</html>