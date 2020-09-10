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