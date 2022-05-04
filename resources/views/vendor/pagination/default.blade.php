@if ($paginator->hasPages())
    <div class="pagination__option" role="navigation">
        <a href="{{ $paginator->url(1) }}" rel="prev">
            <i class="fa fa-angle-double-left"></i>
        </a>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="fa fa-angle-left"></i>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="fa fa-angle-left"></i>
            </a>
        @endif

        @if($paginator->currentPage() > 3)
            <a href="{{ $paginator->url(1) }}">1</a>
        @endif
        @if($paginator->currentPage() > 4)
            <a class="disabled" aria-disabled="true">...</a>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <a class="active pagination__option__active" aria-current="page">{{ $i }}</a>
                @else
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <a  class="disabled" aria-disabled="true">...</a>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="fa fa-angle-right"></i>
            </a>
        @else
            <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="fa fa-angle-right"></i>
            </a>
        @endif
        <a href="{{ $paginator->url($i) }}" rel="next">
            <i class="fa fa-angle-double-right"></i>
        </a>
    </div>
@endif
