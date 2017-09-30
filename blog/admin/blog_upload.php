<?php
	include('check.php');
	//var_dump($_FILES);

	$key="upload_file";
	//上传文件保存目录
	$dir="../upfiles/";

	//判断上传文件传过来的key字段
	if (isset($_FILES[$key])) {
		//key字段对应的是一个数组
		$file=$_FILES[$key];
		if ($file['error']==0) {
			//文件的保存路径
			$pathName=$dir.$file['name'];
			//文件的访问地址
			$urlName='http://blog.com/upfiles/'.$file['name'];
			//从 临时文件夹 中把 上传的文件 转移到 保存目录
			$is=move_uploaded_file($file['tmp_name'], $pathName);
			if (!$is) {
				echo "上传失败";
			}

			//让编辑器识别上传成功
			$json = array(
				'success' => true, 
				'msg' => '',
				'file_path' => $urlName);
			//数组转换为json
			echo json_encode($json);

		}
		
	}
?>