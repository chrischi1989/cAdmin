<li class="breadcrumb-item{{ isset($item['active']) ? ' active' : null }}">
    @isset($item['active'])
    <span class="fa-fw {{ $item['icon'] }}"></span> {{ $item['title'] }}
    @else
    <a href="{{ $item['href'] }}">
        <span class="fa-fw {{ $item['icon'] }}"></span> {{ $item['title'] }}
    </a>
    @endisset
</li>
