<?php
require_once 'dir.func.php';
require_once 'file.func.php';
require_once 'common.func.php';
$path      = "file";
@$path     = $_REQUEST['path'] ? $_REQUEST['path'] : $path;
@$act      = $_REQUEST['act']; // 要执行的动作
@$filename = $_REQUEST['filename']; // 文件名，包括路径
// echo $filename;
@$dirname = $_REQUEST['dirname'];
@$info    = readDirectory($path); // 读目录
if (!$info) {
    echo "<script type='text/javascript'>alert('没有文件或目录！');location.href='index.php';</script>";
}
$redirect = "index.php?path={$path}"; // 跳转的地址
// var_dump($info);
if ($act == "创建文件") {
    // 创建文件
    // echo $path."--".$filename;
    $mes = createFile($path . "/" . $filename);
    alertMes($mes, $redirect);
} elseif ($act == "showContent") {
    // 查看文件内容
    // 高亮显示字符串中的PHP代码
    $content = file_get_contents($filename);
    if (strlen($content)) {
        // 文件不为空时才显示
        // 第二个参数true表示不显示，返回值
        $newContent = highlight_string($content, true);
        // 高亮显示文件中的PHP代码
        // highlight_file($filename);
        $str = <<<EOF
		<table width="80%" bgcolor="pink" cellspadding="5" cellspacing="0">
			<tr>
			<td>{$newContent}</td>
			</tr>
		</table>
EOF;
        echo $str;
    } else {
        alertMes("文件中没有内容，请编辑后再查看。", $redirect);
    }
} elseif ($act == "editContent") {
    // 编辑文件
    $content = file_get_contents($filename);
    $str     = <<<EOF
	<form action="index.php?act=doEdit" method="post">
		<textarea name="content" cols="200" rows="10">{$content}</textarea><br/>
		<input type="hidden" name="filename" value="{$filename}">
		<input type="submit" value="确认修改">
	</form>
EOF;
    echo $str;
} elseif ($act == "doEdit") {
    // 修改文件内容
    $content = $_REQUEST['content'];
    // echo $content . $filename;
    if (file_put_contents($filename, $content)) {
        $mes = "文件修改成功";
    } else {
        $mes = "文件修改失败";
    }
    alertMes($mes, $redirect);
} elseif ($act == "renameFile") {
    // 重命名文件
    $str = <<<EOF
	<form action="index.php?act=doRename" method="post">
		请输入新文件名：
		<input type="text" name="newname">
		<input type="hidden" name="filename" value="{$filename}">
		<input type="submit" value="重命名">
	</form>
EOF;
    echo $str;
} elseif ($act == "doRename") {
    // 执行重命名
    $newname = $_REQUEST['newname'];
    $mes     = renameFile($filename, $newname);
    alertMes($mes, $redirect);
} elseif ($act == "delFile") {
    // 删除文件
    $mes = delFile($filename);
    alertMes($mes, $redirect);
} elseif ($act == "downFile") {
    // 下载文件
    downFile($filename);
} elseif ($act == "copyFolder") {
    $str = <<<EOF
	<form action="index.php?act=doCopyFolder" method="post">
		把文件夹复制到：
		<input type="text" name="dstname">
		<input type="hidden" name="path" value="{$path}">
		<input type="hidden" name="dirname" value="{$dirname}">
		<input type="submit" value="复制文件夹">
	</form>
EOF;
    echo $str;
} elseif ($act == "doCopyFolder") {
    $dstname = $_REQUEST['dstname'];
    // echo $dstname;
    // 把文件夹复制到当前目录下的$dstname目录下的basename($dirname)中
    $mes = copyFolder($dirname, $path . "/" . $dstname . "/" . basename($dirname));
    alertMes($mes, $redirect);
} elseif ($act == "renameFolder") {
    $str = <<<EOF
	<form action="index.php?act=doRenameFolder" method="post">
		把文件夹重命名为：
		<input type="text" name="newdirname">
		<input type="hidden" name="path" value="{$path}">
		<input type="hidden" name="dirname" value="{$dirname}">
		<input type="submit" value="重命名">
	</form>
EOF;
    echo $str;
} elseif ($act == "doRenameFolder") {
    $newdirname = $_REQUEST['newdirname'];
    // $newdirname只是basename，不带路径
    $mes = renameFolder($dirname, $path . "/" . $newdirname);
    alertMes($mes, $redirect);
} elseif ($act == "创建文件夹") {
    $mes = createFolder($path . "/" . $dirname);
    alertMes($mes, $redirect);
} elseif ($act == "cutFolder") {
    $str = <<<EOF
	<form action="index.php?act=doCutFolder" method="post">
		把文件夹剪切到：
		<input type="text" name="dstname">
		<input type="hidden" name="path" value="{$path}">
		<input type="hidden" name="dirname" value="{$dirname}">
		<input type="submit" value="剪切">
	</form>
EOF;
    echo $str;
} elseif ($act == "doCutFolder") {
    $dstname = $_REQUEST['dstname'];
    // echo $dstname;exit;
    $mes = cutFolder($dirname, $path . "/" . $dstname);
    alertMes($mes, $redirect);
} elseif ($act == "delFolder") {
    // echo "文件夹已经删除了";
    $mes = delFolder($dirname);
    alertMes($mes, $redirect);
} elseif ($act == "copyFile") {
    $str = <<<EOF
	<form action="index.php?act=doCopyFile" method="post">
		把文件复制到：
		<input type="text" name="dstname">
		<input type="hidden" name="path" value="{$path}">
		<input type="hidden" name="filename" value="{$filename}">
		<input type="submit" value="复制">
	</form>
EOF;
    echo $str;
} elseif ($act == "doCopyFile") {
    $dstname = $_REQUEST['dstname'];
    $mes     = copyFile($filename, $path . "/" . $dstname);
    alertMes($mes, $redirect);
} elseif ($act == "cutFile") {
    $str = <<<EOF
	<form action="index.php?act=doCutFile" method="post">
		把文件剪切到：
		<input type="text" name="dstname">
		<input type="hidden" name="path" value="{$path}">
		<input type="hidden" name="filename" value="{$filename}">
		<input type="submit" value="剪切">
	</form>
EOF;
    echo $str;
} elseif ($act == "doCutFile") {
    $dstname = $_REQUEST['dstname'];
    $mes     = cutFile($filename, $path . "/" . $dstname);
    alertMes($mes, $redirect);
} elseif ($act == "上传文件") {
    // var_dump($_FILES);
    $fileInfo = $_FILES['myFile'];	// 将二维数组变成一维数组
    // var_dump($fileInfo);
    $mes = uploadFile($fileInfo, $path);
    alertMes($mes, $redirect);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>web在线文件管理器</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/cikonss.css">
	<link rel="stylesheet" type="text/css" href="./jquery-ui-1.12.1/jquery-ui.min.css">
	<script src="./jquery-ui-1.12.1/external/jquery/jquery.js"></script>
	<script src="./jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			margin: 0 auto;
			margin-top: 20px;
			width: 90%;
		}
		body h1{
			margin-bottom: 20px;
		}
		.first{
			width: 100%;
		}
		.first .second{
			height: 45px;
			padding: 10px 0;
			background: gray;
		}
		.first .second ul{
			list-style: none;
			padding-left: 20px;
		}
		.first .second ul li{
			margin-right: 10px;
			display: inline-block;
		}
		.third table{
			width: 100%;
			text-align: center;
			background: #abcdef;
		}
		.third tr td img{
			height: 30px;
			text-align: center;
		}
	</style>
	<script type="text/javascript">
		// 显示隐藏域
		function show(dis){
			document.getElementById(dis).style.display="table-row";
		}
		function showDetail(title,filename){
			$("#showImg").attr("src",filename);
			$("#showDetail").dialog({
				height:"auto",
				width:"auto",
				position:{ my: "center", at: "center", of: window },
				modal:false,//是否模式对话框
		      	draggable:true,//是否允许拖拽
		      	resizable:true,//是否允许拖动
		     	title:title,//对话框标题
		     	show: { effect: "blind", duration: 800 },
	     		hide:"explode"
			});
		}
		function delFile(filename){
			if (window.confirm("您确定要删除文件("+filename+")吗?删除后不可恢复哦！")) {
				location.href="index.php?act=delFile&path=<?php echo $path; ?>&filename="+filename;
			}
		}
		function delFolder(dirname){
			if (window.confirm("您确定要删除文件夹("+dirname+")吗?删除后不可恢复哦！")) {
				location.href="index.php?act=delFolder&path=<?php echo $path; ?>&dirname="+dirname;
			}
		}
		function goBack(path){
			location.href="index.php?path="+path;
		}

	</script>
</head>
<body>
	<div id="showDetail" style="display: none;">
		<img src="" id="showImg">
	</div>
	<h1>web在线文件管理器</h1>
	<hr>
	<div class="first">

		<div class="second">
			<ul>
				<li><a href="index.php" title="主目录"><span class="icon icon-small icon-square"><span class="icon-home"></span></span></a></li>
				<li><a href="#" onclick="show('createFile')" title="新建文件"><span class="icon icon-small icon-square"><span class="icon-file"></span></span></a></li>
				<li><a href="#" onclick="show('createFolder')" title="新建文件夹"><span class="icon icon-small icon-square"><span class="icon-folder"></span></span></a></li>
				<li><a href="#" onclick="show('uploadFile')" title="上传文件"><span class="icon icon-small icon-square"><span class="icon-upload"></span></span></a></li>
				<?php
					$back = ($path == "file") ? "file" : dirname($path);
				?>
				<li><a href="#" onclick="goBack('<?php echo $back; ?>')" title="返回上级目录"><span class="icon icon-small icon-square"><span class="icon-arrowLeft"></span></span></a></li>
			</ul>
		</div>
		<hr>
		<div class="third">
			<form action="index.php" method="post" enctype="multipart/form-data">
				<table cellspacing="0" cellpadding="0" border="1">
					<tr id="createFolder" style="display: none;">
						<td>请输入文件夹名称</td>
						<td>
							<input type="text" name="dirname">
							<input type="hidden" name="path" value="<?php echo $path; ?>">
							<!-- <input type="hidden" name="act" value="doCreateFolder"> -->
							<!-- 此处注释不行的原因是???submit会把hidden的内容都提交，所以点击一次就把两个隐藏域单独的act提交了，而act放在按钮处则点击才会提交按钮的act -->
							<input type="submit" name="act" value="创建文件夹">
						</td>
					</tr>
					<tr id="createFile" style="display: none;">
						<td>请输入文件名称</td>
						<td>
							<input type="text" name="filename">
							<input type="hidden" name="path" value="<?php echo $path; ?>">
							<!-- <input type="hidden" name="act" value="doCreateFile"> -->
							<input type="submit" name="act" value="创建文件">
						</td>
					</tr>
					<tr id="uploadFile" style="display: none;">
						<td>请选择上传文件</td>
						<td>
							<input type="file" name="myFile">
							<input type="hidden" name="path" value="<?php echo $path; ?>">
							<!-- <input type="hidden" name="act" value="doCreateFile"> -->
							<input type="submit" name="act" value="上传文件">
						</td>
					</tr>

					<tr>
						<td>编号</td>
						<td>名称</td>
						<td>类型</td>
						<td>大小</td>
						<td>可读</td>
						<td>可写</td>
						<td>可执行</td>
						<td>创建时间</td>
						<td>修改时间</td>
						<td>访问时间</td>
						<td>操作</td>
					</tr>
					<?php
					$i = 1;
					if (@$info['file']) {
					    foreach ($info['file'] as $value) {
			        		$p = $path . "/" . $value;
			        ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value; ?></td>
						<td><?php $src = filetype($p) == "file" ? "file_ico.png" : "folder_ico.png";?><img src="./images/<?php echo $src; ?>" alt="" title="文件"></td>
						<td><?php echo transByte(filesize($p)); ?></td>
						<td><?php $src = is_readable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php $src = is_writable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php $src = is_executable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php echo date("Y-m-d H:i:s", filectime($p)); ?></td>
						<td><?php echo date("Y-m-d H:i:s", filemtime($p)); ?></td>
						<td><?php echo date("Y-m-d H:i:s", fileatime($p)); ?></td>
						<td>
							<?php
								$explode  = explode(".", $value);
						        $ext      = strtolower(end($explode));
						        $allowExt = array('jpg', 'jpeg', 'gif', 'png');
						        if (in_array($ext, $allowExt)) {	//如果是图片
				            ?>
									<a href="#" onclick="showDetail('<?php echo $value; ?>','<?php echo $p; ?>')"><img src="./images/show.png" alt="" title="查看"></a>
							<?php
								} else {							//如果不是图片
            				?>
									<a href="index.php?act=showContent&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/show.png" alt="" title="查看"></a>
							<?php
								}
						    ?>
							<a href="index.php?act=editContent&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/edit.png" alt="" title="修改"></a>
							<a href="index.php?act=renameFile&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/rename.png" alt="" title="重命名"></a>
							<a href="index.php?act=copyFile&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/copy.png" alt="" title="复制"></a>
							<a href="index.php?act=cutFile&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/cut.png" alt="" title="剪切"></a>
							<a href="#" onclick="delFile('<?php echo $p; ?>')"><img src="./images/delete.png" alt="" title="删除"></a>
							<a href="index.php?act=downFile&path=<?php echo $path; ?>&filename=<?php echo $p; ?>"><img src="./images/download.png" alt="" title="下载"></a>
						</td>
					</tr>
					<?php
						$i++;
						    }
						}
					?>

					<?php
					// $i = 1;
					if (@$info['dir']) {
					    foreach ($info['dir'] as $value) {
					        $p = $path . "/" . $value;
       				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value; ?></td>
						<td><?php $src = filetype($p) == "file" ? "file_ico.png" : "folder_ico.png";?><img src="./images/<?php echo $src; ?>" alt="" title="文件"></td>
						<!-- $sum是global变量，foreach每循环一次就累加，需要重新置0才能正常显示当前文件夹的大小，否则是总大小 -->
						<td><?php $sum = 0;echo transByte(dirSize($p));?></td>
						<td><?php $src = is_readable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php $src = is_writable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php $src = is_executable($p) ? "correct.png" : "error.png";?><img src="./images/<?php echo $src; ?>" alt=""></td>
						<td><?php echo date("Y-m-d H:i:s", filectime($p)); ?></td>
						<td><?php echo date("Y-m-d H:i:s", filemtime($p)); ?></td>
						<td><?php echo date("Y-m-d H:i:s", fileatime($p)); ?></td>
						<td>
							<!-- 此处是$path的关键 path=<?php echo $p; ?> 使当前目录更进一层 -->
							<a href="index.php?path=<?php echo $p; ?>&dirname=<?php echo $p; ?>"><img src="./images/show.png" alt="" title="查看"></a>
							<a href="index.php?act=renameFolder&path=<?php echo $path; ?>&dirname=<?php echo $p; ?>"><img src="./images/rename.png" alt="" title="重命名"></a>
							<a href="index.php?act=copyFolder&path=<?php echo $path; ?>&dirname=<?php echo $p; ?>"><img src="./images/copy.png" alt="" title="复制"></a>
							<a href="index.php?act=cutFolder&path=<?php echo $path; ?>&dirname=<?php echo $p; ?>"><img src="./images/cut.png" alt="" title="剪切"></a>
							<a href="#" onclick="delFolder('<?php echo $p; ?>')"><img src="./images/delete.png" alt="" title="删除"></a>
							<a href="index.php?act=downFolder&path=<?php echo $path; ?>&dirname=<?php echo $p; ?>"><img src="./images/download.png" alt="" title="下载"></a>
						</td>
					</tr>
					<?php
						$i++;
						    }
						}
					?>
				</table>
			</form>
		</div>
	</div>
</body>
</html>