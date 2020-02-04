@can('create', $item)
<div class="col-6 text-right ml-lg-auto">
    <a href="{{ route($section . '-create') }}" class="btn btn-primary">
        <span class="fas fa-plus"></span> {{ $text }}
    </a>
</div>
@endcan
