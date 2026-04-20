<div class="header-icon {{ $desktopOnly? 'desktop-only' : '' }} favorites-icon">
    <a href="{{ route('favorites.index') }}">
        <i class="fa-regular fa-heart"></i>
    </a>
    <span class="favorites-number"></span>
</div>