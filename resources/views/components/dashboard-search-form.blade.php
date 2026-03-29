<div class="dashboard-search-form">
    <form action="{{ route($route) }}" method="GET">
        <input type="text" class="form-control" name="search" id="search"
            value="{{ request()->has('search') ? request()->input('search') : '' }}">
        <button type="submit" class="btn btn-dark">Search</button>
        @foreach ($filters as $filter)
            @if (request()->input($filter))
                <input type="hidden" name="{{ $filter }}" value="{{ request()->input($filter) }}">
            @endif
        @endforeach
    </form>
</div>