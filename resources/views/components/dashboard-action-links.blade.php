<div class="action-links">
    @if (method_exists($model, 'trashed') && $model->trashed() )
        @if ($restoreRoute)
            <a href="#" class="dashboard-restore-action-link" data-formid="{{ $model->id }}">Restore</a> 
        @endif
        @if ($forceDeleteRoute)
            | <a href="#" class="dashboard-force-delete-action-link" data-formid="{{ $model->id }}">Delete</a>
        @endif
    @else
        @if ($viewRoute)
            <a href="{{ route($viewRoute,$viewParams ??  $model) }}" target="_blank">View</a> |
        @endif
            <a href="{{ route($editRoute, $model) }}">Edit</a> 
        @if($deleteRoute)
            | <a href="#" class="dashboard-delete-action-link" data-formid="{{ $model->id }}">Delete</a>
        @endif
    @endif

    @if (method_exists($model, 'trashed') && $model->trashed())
        @if ($forceDeleteRoute)
            <form action="{{ route($forceDeleteRoute, $model) }}" method="POST" class="dashboard-action-from"
                id="dashboard-force-delete-action-form-{{ $model->id }}">
                @csrf
                @method('Delete')
            </form>
        @endif

        @if ($restoreRoute)
            <form action="{{ route($restoreRoute, $model) }}" method="POST" class="dashboard-action-from"
                id="dashboard-restore-action-form-{{ $model->id }}">
                @csrf
                @method('PUT')
            </form>
        @endif
    @else
        @if ($deleteRoute)
            <form action="{{ route($deleteRoute, $model) }}" method="POST" class="dashboard-action-from"
                id="dashboard-delete-action-form-{{ $model->id }}">
                @csrf
                @method('Delete')
            </form>
        @endif
    @endif
</div>