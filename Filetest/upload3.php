<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<!-- method="post" enctype="multipart/form-data"  二者缺一不可 -->
	<form action="doAction_6.php" method="post" enctype="multipart/form-data">
		<!-- 通过隐藏域来限制文件上传大小  审查元素可解除限制-->
		<!-- <input type="hidden" name="MAX_FILE_SIZE" value="28167"> -->
		请选择您要上传的文件：
		<!-- 通过accept属性来限制文件类型  审查元素可解除限制-->
		<!-- <input type="file" name="myfile" accept="image/png,image/jpeg,image/gif"><br/> -->
		<input type="file" name="myFile1"><br/>
		<input type="submit" value="上传文件">
	</form>
</body>
</html>