<li class="breadcrumb-item{{ isset($item['active']) ? ' active' : null }}">
    @isset($item['active'])
    {{ $item['title'] }}
    @else
    <a href="{{ $item['href'] }}">
        {{ $item['title'] }}
    </a>
    @endisset
</li>
