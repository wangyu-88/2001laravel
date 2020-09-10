  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        @php $name=Route::currentRouteName();@endphp;
        <!-- 判断展开 -->
        <li @if(strpos($name,'goods')!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item" @endif>
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <!-- 判断选中颜色 -->
            <dd @if($name=='goods.create') class="layui-this" @endif><a href="javascript:;">添加商品</a></dd>
            <dd @if($name=='goods') class="layui-this" @endif><a href="javascript:;">商品列表</a></dd>
          </dl>
        </li>
        <!-- 判断展开 -->
        <li @if(strpos($name,'brand')!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item" @endif>
          <a href="javascript:;">商品品牌</a>
          <dl class="layui-nav-child">
            <!-- 判断选中颜色 -->
            <dd @if($name=='brand.create') class="layui-this" @endif><a href="{{url('brand/create')}}">添加品牌</a></dd>
            <dd @if($name=='brand') class="layui-this" @endif><a href="{{url('brand')}}">品牌列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="">云市场</a></li>
        <li class="layui-nav-item"><a href="">发布商品</a></li>
      </ul>
    </div>
  </div>