<!DOCTYPE html>
<html>
<head>
	<title>文件下载</title>
</head>
<body>
	<a href="real_pic.png">下载real_pic.png</a>（直接显示图片）
	<br/>
	<a href="false_pic.txt">下载false_pic.txt</a>（直接显示文本内容）
	<br/>
	<a href="testdownload.rar">下载testdownload.rar</a>（正常下载）
	<br/>
	<a href="doDownload.php?filename=testdownload.rar">下载testdownload.rar</a>（通过程序下载）
	<br/>
	<a href="doDownload.php?filename=./uploads/5f735c09a66bebcd551a59f25d101f30.png">下载png</a>（文件名 会/不会 带路径）
	<br/>
</body>
</html>