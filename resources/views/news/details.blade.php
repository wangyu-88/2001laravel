<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻详情页</title>
</head>
<body>
	<h1>新闻详情页-新闻标题</h1>
	<p>作者：{{$user}}</p>
	<p>发布时间：{{date('Y-m-d H:i:s',$news->new_time)}}</p>
	<p>访问量：{{$count}}</p>
	<p>详情：{{$news->new_desc}}</p>
</body>
</html>