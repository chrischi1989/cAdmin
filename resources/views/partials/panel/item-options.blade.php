<form action="{{ route($section . '-destroy') }}" enctype="multipart/form-data" method="post" class="form-inline justify-content-end options">
    @csrf
    <input id="uuid" name="uuid" value="{{ $item->uuid }}" type="hidden">
    <div class="form-row align-items-center">
        @include('partials.panel.created-updated', ['item' => $item])
        @can('edit', $item)
        <a href="{{ route($section . '-edit', ['uuid' => $item->uuid]) }}" class="btn btn-transparent" data-toggle="tooltip" data-title="Bearbeiten">
            <span class="far fa-edit"></span>
        </a>
        @endcan
        @can('destroy', $item)
        <button class="btn btn-transparent delete" data-toggle="tooltip" data-title="Löschen" data-message="{{ $deleteMessage }}">
            <span class="far fa-trash-alt"></span>
        </button>
        @endcan
    </div>
</form>
