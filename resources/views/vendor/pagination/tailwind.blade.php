@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1.5 text-sm text-gray-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 text-sm font-semibold text-white bg-blue-700 rounded-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Next
            </a>
        @else
            <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                Next
            </span>
        @endif
    </nav>
@endif