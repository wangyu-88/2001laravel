@foreach($brand as $v)
        <tr brand_id={{$v->brand_id}}>
          <td> 
            <input type="checkbox" name="brandcheck[]" lay-skin="primary" value="{{$v->brand_id}}">
          </td>
          <td>{{$v->brand_id}}</td>
          <td  field="brand_name">
            <span class="span_test">{{$v->brand_name}}</span>
            <input class="changeValue" type="text" value="{{$v->brand_name}}" style="display:none;">
          </td>
          <td>
            @if($v->brand_logo)
            <img src="{{$v->brand_logo}}" alt="" width="120px">
            @endif
          </td>
          <td field="brand_url">
            <span class="span_test">{{$v->brand_url}}</span>
            <input class="changeValue" type="text" value="{{$v->brand_url}}" style="display:none;">
          </td>
          <td field="brand_desc">
            <span class="span_test">{{$v->brand_desc}}</span>
            <input class="changeValue" type="text" value="{{$v->brand_desc}}" style="display:none;">
          </td>
          <td>
            <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="layui-btn layui-btn-normal">修改</a>

            <!-- 普通删除 -->
            <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除吗?')){location.href='{{url('/brand/delete/'.$v->brand_id)}}';}" class="layui-btn layui-btn-danger">删除</a> -->

            <!-- ajax删除 -->
            <a href="javascript:void(0)" onclick="deleteById({{$v->brand_id}},this)" class="layui-btn layui-btn-danger">删除</a>
          </td>
        </tr>
        @endforeach

      <tr>
        <td colspan="7">
          {{$brand->appends($query)->links('vendor.pagination.adminshop')}}
           <button type="button" class="layui-btn layui-btn-normal moredel">批量删除</button>
        </td>
      </tr>