@php use psnXT\Modules\Navigation\Models\Item; @endphp
<li class="dd-item{{ !$item->childItems->isEmpty() ? ' has-children' : '' }}" data-id="{{ $item->uuid }}">
    <div class="dd-handle"></div>
    <div class="dd-content">
        <div class="d-flex justify-content-between align-items-center">
            <span>{{ $item->title }}</span>
            <form action="{{ route('navigation-destroy') }}" enctype="multipart/form-data" method="post">
                @csrf

                <input type="hidden" name="uuid" id="uuid" value="{{ $item->uuid }}">
                <div class="form-row align-items-center">
                <div class="dropdown" data-toggle="tooltip" title="Informationen">
                    <button class="btn btn-transparent" data-toggle="dropdown">
                        <span class="fas fa-info-circle"></span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-item">
                            <div>
                                <strong>Erstellt:</strong> {{ $item->created_at->format('d.m.Y - H:i') }} Uhr<br><strong>von:</strong> {{ is_null($item->createdBy) ? 'Installation' : $item->createdBy->email }}
                            </div>
                            <div>
                                <strong>Bearbeitet:</strong> {{ $item->updated_at->format('d.m.Y - H:i') }} Uhr<br><strong>von:</strong> {{ is_null($item->createdBy) ? 'Installation' : $item->createdBy->email }}
                            </div>
                        </div>
                    </div>
                </div>
                @can('edit', Item::class)

                <a href="{{ route('navigation-edit', ['uuid' => $item->uuid]) }}" class="btn btn-transparent" data-toggle="tooltip" title="Bearbeiten">
                    <span class="far fa-edit"></span>
                </a>
                @endcan
                @can('destroy', Item::class)
                @if($item->deleteable && $item->childItems->isEmpty())

                <button class="btn btn-transparent delete" data-message="Wollen Sie dieses Navigationselement wirklich löschen?" data-toggle="tooltip" title="Löschen">
                    <span class="far fa-trash-alt"></span>
                </button>
                @else

                <span class="btn btn-transparent disabled" data-toggle="tooltip" title="Dieses Navigationselement kann nicht gelöscht werden">
                    <span class="far fa-trash-alt"></span>
                </span>
                @endif
                @endcan
                </div>
            </form>
        </div>
    </div>
    @if(!$item->childItems->isEmpty())
    <ol class="dd-list">
        @each('navigation::partials.navigation-item', $item->childItems, 'item')
    </ol>
    @endif
</li>
