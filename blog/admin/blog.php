<?php
	include('check.php');
	//echo "123";

	//删除操作
	if($input->get('do')=='delete'){
		$pid=$input->get('pid');
		$sql="DELETE FROM page WHERE pid='{$pid}'";
		$is=$db->query($sql);
		if ($is) {
			header('location:blog.php');
		}else{
			die("删除失败！");
		}
	}

	//每页数量（从config.php中获取系统设置pagenum数据）
	$pageNum=$setting['pagenum'];

	//获取总数量
	$sql="SELECT count(*) AS total FROM page";
	$tatal=$db->query($sql)->fetch_array(MYSQLI_ASSOC)['total'];
	//计算总页数
	$maxPage=ceil($tatal/$pageNum);
	//var_dump($maxPage);

	//获取当前页
	$page=(int)$input->get('page');
	$page=$page<1?1:$page;
	$page=$page>$maxPage?$maxPage:$page;
	//var_dump($page);



	//设置偏移量
	$offset=($page-1)*$pageNum;


	$sql="SELECT * FROM page ORDER BY pid ASC limit {$offset},{$pageNum} ";
	$result=$db->query($sql);
	$rows = array();
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$rows[]=$row;
	}
	//var_dump($rows);
?>
<!DOCTYPE html>
<html>
<head>
	<title>博客管理</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.inc.php');?>

	<div class="container">
		<div class="row">
			<div class="page-header">
			  	<h1>博客管理 <a class="pull-right btn btn-primary" href="blog_add.php">添加博客</a></h1>
			</div>

			<table class="table table-striped">
		      <thead>
		        <tr>
		          <th>PID</th>
		          <th>标题</th>
		          <th>作者</th>
		          <th>插入时间</th>
		          <th>修改时间</th>
		          <th>管理</th>     
		        </tr>
		      </thead>
		      <tbody>
		      	<?php foreach($rows as $row):?>
		        <tr>
		          <th scope="row"><?php echo $row['pid'];?> </th>
		          <td><?php echo $row['title'];?></td>
		          <td><?php echo $row['author'];?></td>
		          <td><?php echo date('Y-m-d H:i:s',$row['intime']);?></td>
		          <td><?php echo date('Y-m-d H:i:s',$row['uptime']);?></td>
		          <td>
		          	<a class="btn btn-info btn-xs" href="blog_add.php?pid=<?php echo $row['pid'];?>">修改</a>
		          	<a class="btn btn-danger btn-xs" href="blog.php?do=delete&pid=<?php echo $row['pid'];?>">删除</a>
		          </td>
		        </tr>
			   <?php endforeach;?>

			   
		      </tbody>
		    </table>
		    <ul class="pagination pull-right">
				    <li>
				      <a href="blog.php?page=<?php echo $page-1;?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				   
			   <?php
			   		$hrefTpl="<li><a href='blog.php?page=%d'>%s</a></li>";
			   		/*
			   		for ($i=1; $i <= $maxPage; $i++) { 
			   			echo sprintf($hrefTpl,$i,"第{$i}页");
			   		}*/

			   		for ($i=1; $i <= $maxPage; $i++) { 
			   			
			   			echo sprintf($hrefTpl,$i,"第{$i}页");
			   			
			   		}
			   		
			   ?> 
			   		 <li>
				      <a href="blog.php?page=<?php echo $page+1;?>" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
			    </ul>
		</div>
	</div>
</body>
</html>