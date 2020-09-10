<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	{{session('msg')}}
	<form action="{{url('news/logindo')}}" method="post">
		@csrf
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="u_name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name='u_pwd'></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value='登录'></td>
			</tr>
		</table>
	</form>

</body>
</html>