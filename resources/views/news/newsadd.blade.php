<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻添加</title>
</head>
<body>
	<h3 style="color:red">添加新闻</h3>
	<form action="{{url('news/newsaddDo')}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>新闻标题</td>
				<td><input type="text" name="new_title"></td>
			</tr>
			<tr>
				<td>新闻分类</td>
				<td>
					<select name="type_id" id="">
						<option value="">--请选择--</option>
						@foreach($type as $v)
						<option value="{{$v->type_id}}">{{$v->type_name}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td>新闻图片</td>
				<td><input type="file" name="new_img"></td>
			</tr>
			<tr>
				<td>新闻简介</td>
				<td>
					<textarea name="new_desc" id="" cols="30" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td>新闻内容</td>
				<td>
					<textarea name="new_content" id="" cols="30" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>