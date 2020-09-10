@extends('admin.layouts.adminshop')
@section('title','品牌添加')
@section('content')
  

    <!-- 面包屑导航 -->
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>
	  		<span class="layui-breadcrumb">
			  <a href="/">后台首页</a>
			  <a href="/demo/">商品品牌</a>
			  <a><cite>添加品牌</cite></a>
			</span>
	  </legend>
	</fieldset>

	
		<!-- 内容主体区域 -->
    <div style="padding: 15px;">

      <!-- 表单验证提示信息 -->
<!--       @if ($errors->any())
      <div class="alert alert-danger" style="padding-bottom:20px; padding-left:20px;">
        <ul>
          @foreach ($errors->all() as $error)
          <li style="margin-top:10px; color:#ff0000;">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif -->

    	<form class="layui-form" action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
    		@csrf
		  <div class="layui-form-item">
		    <label class="layui-form-label">品牌名称:</label>
		    <div class="layui-input-block">
		      <input type="text" name="brand_name" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" class="layui-input">
          <!-- 验证提示信息 -->
          <span style="margin-top:10px; color:#ff0000;">{{ $errors->first('brand_name') }}</span>
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">品牌网址:</label>
		    <div class="layui-input-block">
		      <input type="text" name="brand_url" lay-verify="title" autocomplete="off" placeholder="请输入品牌网址" class="layui-input">
          <!-- 验证提示信息 -->
          <span style="margin-top:10px; color:#ff0000;">{{ $errors->first('brand_url') }}</span>
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">品牌LOGO:</label>
		    <div class="layui-input-block">
          <!-- 文件上传 -->
		      <div class="layui-upload-drag" id="test10">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
              <hr>
              <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
          </div>
          <!-- 隐藏域 -->
          <input type="hidden" name="brand_logo">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">品牌简介:</label>
		    <div class="layui-input-block">
		      <input type="text" name="brand_desc" lay-verify="title" autocomplete="off" placeholder="请输入品牌简介" class="layui-input">
          <!-- 验证提示信息 -->
          <span style="margin-top:10px; color:#ff0000;">{{ $errors->first('brand_desc') }}</span>
		    </div>
		  </div>
		  <div class="layui-form-item" align="center">
		  	<button type="submit" class="layui-btn">添加</button>
		  	<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		  </div>
		   
		</form>
    </div>
  </div>
  

@include('admin.public.footer')
<script src="/static/admin/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});

// 引入组件
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;

  //拖拽上传
  upload.render({
    elem: '#test10',
    url: 'http://www.laravel01.com/brand/upload', //改成您自己的上传接口
    done: function(res){
      layer.msg(res.msg);
      layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
      layui.$('input[name="brand_logo"]').attr('value',res.data);
    }
  });

  // 令牌
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});


</script>
@endsection
