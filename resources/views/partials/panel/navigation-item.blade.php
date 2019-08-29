@if(!is_null($item->module))
@if(isset($currentUser->permissions->{strtolower($item->module->module)}, $currentUser->permissions->{strtolower($item->module->module)}->read))
<li>
    @if(!$item->childItems->isEmpty())
    <span data-backhtml="<span class='fas fa-angle-left fa-fw'></span> {{ $item->title }}">{{ $item->title }}</span>
    <ul>
        @each('partials.panel.navigation-item', $item->childItems, 'item')
    </ul>
    @else
    <a href="{!! !is_null($item->href) ? $item->href : '#' !!}">
        <span class="{{ $item->icon }} fa-fw"></span> {{ $item->title }}
    </a>
    @endif
</li>
@endif
@else
<li>
    @if(!$item->childItems->isEmpty())
    <span data-backhtml="<span class='fas fa-angle-left fa-fw'></span> {{ $item->title }} ">
        <span class="{{ $item->icon }} fa-fw"></span> {{ $item->title }} <span class="fas fa-angle-right fa-fw"></span>
    </span>
    <ul>
        @each('partials.panel.navigation-item', $item->childItems, 'item')
    </ul>
    @else
    <a href="{!! !is_null($item->href) ? $item->href : '#' !!}">
        <span class="{{ $item->icon }} fa-fw"></span> {{ $item->title }}
    </a>
    @endif
</li>
@endif
