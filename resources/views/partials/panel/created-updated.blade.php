<div class="dropdown" data-toggle="tooltip" title="Informationen">
    <button class="btn btn-transparent" data-toggle="dropdown">
        <span class="fas fa-info-circle"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-item">
            <div class="p-2">
                <strong>Erstellt:</strong> {{ $item->created_at->format('d.m.Y - H:i') }} Uhr<br>
                <strong>von:</strong> {{ is_null($item->createdBy) ? 'Installation' : $item->createdBy->email_encrypted }}
            </div>
            <div class="p-2">
                <strong>Bearbeitet:</strong> {{ $item->updated_at->format('d.m.Y - H:i') }} Uhr<br>
                <strong>von:</strong> {{ is_null($item->createdBy) ? 'Installation' : $item->createdBy->email_encrypted }}
            </div>
        </div>
    </div>
</div>
