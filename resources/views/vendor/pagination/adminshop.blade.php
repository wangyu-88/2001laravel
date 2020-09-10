@if ($paginator->hasPages())
<div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
            {{-- Previous Page Link --}}
            <!-- 上一页 -->
            @if ($paginator->onFirstPage())
                <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev" data-page="0">上一页</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!-- 当前页 -->
                            <span class="layui-laypage-curr">
                              <em class="layui-laypage-em"></em>
                              <em>{{ $page }}</em>
                            </span>
                        @else
                            <!-- 页数 -->
                            <a href="{{ $url }}" data-page="2">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <!-- 下一页 -->
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next" data-page="2">下一页</a>
            @else
                <a href="javascript:;" class="layui-laypage-next layui-disabled" data-page="2">下一页</a>
            @endif
        </div>
@endif
