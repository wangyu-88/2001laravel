<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>新闻展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<center>
	<h1>新闻展示
		<a href="{{url('news/newsadd')}}" style="float:right;">
			<button type="button" class="btn btn-success">添加</button>
		</a>
	</h1>
</center><hr/>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>id</th>
			<th>新闻标题</th>
			<th>新闻分类</th>
			<th>新闻图片</th>
			<th>新闻简介</th>
			<th>前往详情页</th>
		</tr>
	</thead>
	<tbody>
		@foreach($news as $v)
		<tr>
			<td>{{$v->n_id}}</td>
			<td>{{$v->new_title}}</td>
			<td>{{$v->type_name}}</td>
			<td>
				<img src="{{env('UPLOADS_URL')}}{{$v->new_img}}" width='50px' height='50px'>
			</td>
			<td>{{$v->new_desc}}</td>
			<td>
				<a href="{{url('news/details/'.$v->n_id)}}" >详情页</a>
			</td>
		</tr>
		@endforeach

		<tr>
			<td colspan="9">{{$news->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>
<script>
	$(document).on('click','.page-item a',function(){
		// alert(1233);
		var url=$(this).attr('href');
		// alert(url);
		$.get(url,function(res){
			$('tbody').html(res);
		})
		return false;
	})


</script>