@extends('admin.layouts.adminshop')
@section('title','品牌列表')
@section('content')
    <!-- 面包屑导航 -->
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>
        <span class="layui-breadcrumb">
        <a href="/">后台首页</a>
        <a href="/demo/">商品品牌</a>
        <a><cite>品牌列表</cite></a>
      </span>
    </legend>
  </fieldset>
<!-- 搜索 -->
<form class="layui-form" action="">
<div class="layui-form-item">
    <div class="layui-inline">
      <div class="layui-input-inline" style="padding-left:16px;">
        <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-inline">
      <div class="layui-input-inline">
        <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入品牌网址" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-inline">
      <div class="layui-input-inline">
        <button class="layui-btn layui-btn-normal">搜索</button>
      </div>
    </div>
  </div>
</form>

    <!-- 内容主体区域 -->
    <div class="layui-form" style="padding-left: 15px; padding-right: 15px; padding-bottom: 15px;">
    <table class="layui-table">
      <colgroup>
        <col width="150">
        <col width="150">
        <col width="200">
        <col>
      </colgroup>
      <thead>
        <tr>
          <th width="5%"> 
            <input type="checkbox" name="allcheckbox" lay-skin="primary">
          </th>
          <th>品牌ID</th>
          <th>品牌名称</th>
          <th>品牌LOGO</th>
          <th>品牌网址</th>
          <th>品牌简介</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>
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
          <td   field="brand_url">
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
    </tbody>
    </table>
</div>


<script src="/static/admin/layui/layui.js"></script>
<!-- 引入jquery -->
<script src="/static/admin/js/jquery.js"></script>
<script>
//JavaScript代码区域
layui.use(['element','form'], function(){
  var element = layui.element;
  var form=layui.form;


//即点即改
  //span标签绑定点击事件
  layui.$(document).on('click','.span_test',function(){
  // layui.$(".span_test").click(function(){
    // alert(11);
    // 获取当前点击的这个对象
    var _this=layui.$(this);
    //点击让span标签隐藏
    _this.hide();
    // 显示文本框
    _this.next('input').show();
  })

  // input框失去焦点事件
  layui.$(document).on('blur','.changeValue',function(){
  // layui.$('.changeValue').blur(function(){
    //获取当前点击对象
    var _this=layui.$(this);
    //获取值
    var _value=_this.val();
    if(!_value){
      alert('不能为空');
    }
    // 获取字段
    var _field=_this.parent().attr('field');
    // console.log(_field);
    // 获取id
    var _brand_id=_this.parents("tr").attr("brand_id");
    // ajax传值
    layui.$.ajax({
      url:"{{url('brand/brand_name')}}",
      type:'post',
      data:{_value:_value,_field:_field,_brand_id:_brand_id},
      async:true,
      success:function(res){
        // console.log(res);
        if(res!='ok'){
          // 让input上一个兄弟节点显示
          _this.prev('span').text(_value).show();
          // 让input隐藏
          _this.hide();
        }else{
          alert('操作有误');
        }
      }

    })
    //0秒刷新  用来完成失去焦点之后自动刷新值
    // location.reload(0);
  })

  
});

// 全选
$(document).on('click','.layui-form-checkbox:eq(0)',function(){
  // alert(11);
  var checkedval=$('input[name="allcheckbox"]').prop('checked');
  $('input[name="brandcheck[]"]').prop('checked',checkedval);
  if(checkedval){
    $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
  }else{
    $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
  }
})
// 批量删除
$(document).on('click','.moredel',function(){
// $('.moredel').click(function(){
  var ids=new Array();
  $('input[name="brandcheck[]"]:checked').each(function(i,k){
    ids.push($(this).val());
  })
  $.get('brand/delete',{id:ids},function(res){
    alert(res.msg);
    // $(obj).parents('tr').hide();
    location.reload();
  },'json')
})

//ajax删除
function deleteById(brand_id,obj){
  // alert(brand_id);
  if(!brand_id){
    return ;
  }

  $.get('brand/delete/'+brand_id,function(res){
    alert(res.msg);
    // $(obj).parents('tr').hide();
    location.reload();
  },'json')
}

//ajax分页
$(document).on('click','.layui-laypage a',function(){
  // alert(123);
  var url=$(this).attr('href');
  $.get(url,function(res){
    // alert(res);
    $('tbody').html(res);
    layui.use(['element','form'], function(){
      var element = layui.element;
      var form=layui.form;
      form.render();
    })
    // 批量删除
    $(document).on('click','.moredel',function(){
    // $('.moredel').click(function(){
      var ids=new Array();
      $('input[name="brandcheck[]"]:checked').each(function(i,k){
        ids.push($(this).val());
      })
      $.get('brand/delete',{id:ids},function(res){
        alert(res.msg);
        // $(obj).parents('tr').hide();
        location.reload();
      },'json')
    })
  })
  return false;
})


</script>

@endsection  

