<div class="related-items mt-5">
    <h4>Related items</h4>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($related as $menuItem)
                <div class="swiper-slide">
                    @include('front.menu-items.partials.menu-item-card')
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-scrollbar"></div>
    </div>
</div>