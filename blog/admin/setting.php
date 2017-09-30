<?php
	include('check.php');
	
	//点击传过来do动作
	if ($input->get('do')=='set') {
		$update_setting=$input->post();
		foreach ($update_setting as $key => $value) {
			$sql="UPDATE setting set sval='{$value}' WHERE skey='{$key}'";
			$is=$db->query($sql);
			if($is){
					//echo "<script>alert('文本');</script>";
					header('location:setting.php');
				}else{
					die("执行失败!");
			}
		}
	}
	
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title>系统设置</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

	<div class="container">
		<div class="row">
			<div class="page-header">
			  	<h1>系统设置</h1>
			</div>
			
			<!--点击提交时，如果有do动作，则表示是添加；如果有aid，则表示是修改。-->
			<!--此处传递aid是为了点击提交之后仍然可以传递aid执行修改操作。第一次由上个页面传过来的aid是执行获取数据动作，第二次传给自身是执行修改动作。-->
			<form class="form-horizontal" action="setting.php?do=set" method="post">
			  <?php foreach($setting as $key=>$val):?>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $key;?></label>
			    <div class="col-sm-6">
			    	<!--用户名预设为空，插入操作时生效；如果是修改操作，则获取对应值-->
			      <input type="text" class="form-control" name="<?php echo $key;?>" value="<?php echo $val;?>">
			    </div>
			  </div>
			<?php endforeach;?>

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