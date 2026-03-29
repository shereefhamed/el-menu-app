<div class="dashboard-trashed-filter">
    <a href="{{ route($route, [ 'filter' => 'all']) }}"
        class="{{ request('filter') === null || request('filter') === 'all' ? 'active' : ''}}">
        All ({{ $model::all()->count() }}) |
    </a>
    <a href="{{ route($route, [ 'filter' => 'trashed']) }}"
        class="{{request('filter') === 'trashed' ? 'active' : ''}}">
        Trashed ({{ $model::onlyTrashed()->get()->count()}})
    </a>
</div>