<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
</head>
<body>
	<form action="doAction.php" method="post">
		<table border="1" cellspacing="0" cellpadding="0" width="70%">
			<tr>
				<td align="right">用户名：</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td align="right">密码：</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td align="right">验证码：</td>
				<td><input type="text" name="verify"><img id="verifyImage" src="getVerify.php"><a onclick="document.getElementById('verifyImage').src='getVerify.php?r='+Math.random()" href="javascript:void(0)">看不清,换一张</a></td>
			</tr>
			<tr>
				<td colspan="2"><input style="margin-left:150px;" type="submit" value="立即注册" name=""></td>
			</tr>
		</table>
	</form>
</body>
</html>