@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        @if($paginator->onFirstPage())
            <a class="pagination-previous" disabled>@lang('pagination.previous')</a>
        @else
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" >@lang('pagination.next')</a>
        @else
            <a class="pagination-next" disabled>@lang('pagination.next')</a>
        @endif
    </nav>
@endif
