<div class="action-links">
    @if (!$model->trashed())
        @if ($viewRoute)
            <a href="{{ route($viewRoute, $model) }}">View</a> |
        @endif
        <a href="{{ route($editRoute, $model) }}">Edit</a> |
        <a href="#" class="dashboard-delete-action-link" data-formid="{{ $model->id }}">Delete</a>
    @else
        <a href="#" class="dashboard-restore-action-link" data-formid="{{ $model->id }}">Restore</a> |
        <a href="#" class="dashboard-force-delete-action-link" data-formid="{{ $model->id }}">Delete</a>
    @endif

    @if (!$model->trashed())
        <form action="{{ route($deleteRoute, $model) }}" method="POST" class="dashboard-action-from"
            id="dashboard-delete-action-form-{{ $model->id }}">
            @csrf
            @method('Delete')
        </form>
    @else
        <form action="{{ route($forceDeleteRoute, $model) }}" method="POST" class="dashboard-action-from"
            id="dashboard-force-delete-action-form-{{ $model->id }}">
            @csrf
            @method('Delete')
        </form>

        <form action="{{ route($restoreRoute, $model) }}" method="POST" class="dashboard-action-from"
            id="dashboard-restore-action-form-{{ $model->id }}">
            @csrf
            @method('PUT')
        </form>
    @endif
</div>