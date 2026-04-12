<script src="https://www.google.com/recaptcha/api.js"
    async defer>
</script>
<section id="contact">
    <div class="container">
        <h3 class="text-center">{{ __('Get in touch') }}</h3>
        <p class="text-center">{{ __('Drop any message and we will contact you') }}</p>
        <div class="row align-items-center">
            <div class="col-md-6">
                <form action="{{ route('send-mail') }}" method="POST" id="contact-form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone number') }}</label>
                        <input type="tel" name="phone" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">{{ __('Message') }}</label>
                        <textarea name="message" id="message" class="form-control" id="message"></textarea>
                    </div>
                    <div id="success-message"></div>
                    <!-- <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div> -->
                    <button type="submit" class="btn btn-success w-100" id="contact-form-submit-btn">{{ __('Send') }}</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="contact-info" data-aos="flip-left">
                    <ul class="contact-info-list">
                        <li class="contact-info-item">
                            <i class="contact-info-icon fa-solid fa-location-dot"></i>
                            <div class="contact-info-item-data">
                                <h5>{{ __('Location') }}</h5>
                                <p>Cairo, Egypt</p>
                            </div>
                        </li>
                        <li class="contact-info-item">
                            <i class="contact-info-icon fa-solid fa-phone"></i>
                            <div class="contact-info-item-data">
                                <h5>{{ __('Phone number') }}</h5>
                                <p><a href="tel:+20 100 275 7080" class="text-white">+20 100 275 7080</a></p>
                            </div>
                        </li>
                        <li class="contact-info-item">
                            <i class="contact-info-icon fa-solid fa-envelope"></i>
                            <div class="contact-info-item-data">
                                <h5>{{ __('Email') }}</h5>
                                <p><a href="mailto:info@el-menu.net" class="text-white">info@el-menu.net</a></p>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</section>