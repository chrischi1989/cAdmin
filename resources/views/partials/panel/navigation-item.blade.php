@if(!is_null($item->module))
@if($currentUser->permissions->get(strtolower($item->module->module))->contains('show'))
<li{!! isset($active) && strtolower($item->module->module) == $active ? ' class="active"' : null !!}>
    @if(!$item->childItems->isEmpty())
    <span data-backhtml="<span class='fas fa-angle-left fa-fw mr-0'></span> {{ $item->title }}">
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
@else
<li>
    @if(!$item->childItems->isEmpty())
    <span data-backhtml="<span class='fas fa-angle-left fa-fw mr-0'></span> {{ $item->title }} ">
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
