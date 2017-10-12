<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<!-- method="post" enctype="multipart/form-data"  二者缺一不可 -->
	<form action="doAction_5.php" method="post" enctype="multipart/form-data">
		<!-- 单文件上传 -->
		请选择您要上传的文件：
		<input type="file" name="myfile1"><br/>
		请选择您要上传的文件：
		<input type="file" name="myfile2"><br/>

		<!-- 多个单文件上传 -->
		请选择您要上传的文件：
		<input type="file" name="myfile[]"><br/>
		请选择您要上传的文件：
		<input type="file" name="myfile[]"><br/>

		<!-- 多文件上传 按ctrl多选-->
		请选择您要上传的文件：
		<input type="file" name="myfile[]" multiple="multiple"><br/>

		<input type="submit" value="上传文件">
	</form>
</body>
</html>