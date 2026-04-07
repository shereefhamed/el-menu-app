@php
    $allCount = $model::all()->count();
    $trashedCount = $model::onlyTrashed()->get()->count();

 

    if (auth()->user()->isOwner()) {
        if ($model === 'App\Models\Category') {
            $allCount = auth()->user()->restaurant->categories()->count();
            $trashedCount = auth()->user()->restaurant->categories()->onlyTrashed()->count();
        }

        if ($model === 'App\Models\MenuItem') {
            $allCount = auth()->user()->restaurant->menuItems()->count();
            $trashedCount = auth()->user()->restaurant->menuItems()->onlyTrashed()->count();
        }
    }
@endphp

<div class="dashboard-trashed-filter">
    <a href="{{ route($route, ['filter' => 'all']) }}"
        class="{{ request('filter') === null || request('filter') === 'all' ? 'active' : ''}}">
        Published ({{ $allCount }}) |
    </a>
    <a href="{{ route($route, ['filter' => 'trashed']) }}" class="{{request('filter') === 'trashed' ? 'active' : ''}}">
        Trashed ({{ $trashedCount}})
    </a>
</div>