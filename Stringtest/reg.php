<?php
	$string="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	//echo $string{mt_rand(0,strlen($string)-1)};// { }可以实现字符串查找等操作
	$code='';
	for ($i=0; $i < 4; $i++) { //随机选取$string中的字母，并且rgb颜色随机
		$code.='<span style="color:rgb('.mt_rand(0,255).','.mt_rand(0,255).','.mt_rand(0,255).')">'.$string{mt_rand(0,strlen($string)-1)}.'</span>';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>注册练习</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="doAction.php" method="post">
	<table cellpadding="1" cellspacing="0" border="1" width="80%">
		<tr>
			<td align="right">用户名</td>
			<td><input type="text" name="username" placeholder="请输入合法用户名...">用户以首字母开始，长度6~10</td>
		</tr>

		<tr>
			<td align="right">密码</td>
			<td><input type="password" name="password" placeholder="请输入密码...">密码不能为空且长度6~10</td>
		</tr>

		<tr>
			<td align="right">确认密码</td>
			<td><input type="password" name="password1" placeholder="请输入确认密码...">两次密码必须一致</td>
		</tr>

		<tr>
			<td align="right">邮箱</td>
			<td><input type="text" name="email" placeholder="请输入邮箱...">邮箱必须包含@</td>
		</tr>

		<tr>
			<td align="right">兴趣爱好</td>
			<td>
				<input type="checkbox" name="fav[]" value="php">PHP
				<input type="checkbox" name="fav[]" value="java">JAVA
				<input type="checkbox" name="fav[]" value="ios">IOS
				<input type="checkbox" name="fav[]" value="c">C语言<br/>
				<input type="checkbox" name="fav[]" value="c++">C++
				<input type="checkbox" name="fav[]" value="swift">Swift
				<input type="checkbox" name="fav[]" value="meteor">Meteor
				<input type="checkbox" name="fav[]" value="nodejs">NodeJS
			</td>
		</tr>

		<tr>
			<td align="right">验证码</td>
			<td>
				<input type="text" name="verify" placeholder="请输入验证码..."><?php echo $code;?>
				<input type="hidden" name="verify1" value='<?php echo strip_tags($code);?>'>
			</td>
		</tr>

		<tr>
			<td colspan="2"><input type="submit" value ="立即注册"></td>
		</tr>

	</form>
	</table>
</body>
</html>