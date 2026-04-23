<section id="hero" class="bg-body-tertiary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-3">EL-MENU APP</h2>
                <p class="mb-0">{{ __('Create Free QR Code for Restaurant Menu') }}</p>
                <p>{{ __('Convert your menu into a QR Code with our App, and then share it with customers.') }}</p>
                <div class="d-flex align-items-center mt-5">
                    <a href="{{ route('register', ['signup-as' => 'restaurant-owner']) }}" class="btn btn-success">{{ __('Register Now') }}</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <span class="hero-video-icon"><i class="fa-solid fa-play"></i></span> 
                        {{ __('Watch Video') }}
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="hero-image" data-aos="fade-left" data-aos-offset="0">
                    <img src="{{ asset('images/hero.png') }}" alt="mobile">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body ">
        <iframe 
            id="youtubeVideo" 
            width="100%" 
            height="600" 
            src="https://www.youtube.com/embed/IJX9bm1xtM4?si=jOKrR4DXTtSZqDjy" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; 
            autoplay; 
            clipboard-write; 
            encrypted-media; 
            gyroscope; 
            picture-in-picture; web-share" 
            referrerpolicy="strict-origin-when-cross-origin" 
            allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>
</div>