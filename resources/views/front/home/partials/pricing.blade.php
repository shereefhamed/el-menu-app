<section id="pricing">
    <div class="container">
        <h3 class="text-center">{{ __('Pricing') }}</h3>
        <p class="text-center">{{ __('Choose from these plans') }}</p>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center mt-5">
            @foreach ($plans as $plan)
                @php
                    $actionButtonTitle = $plan->isFree() ? 'Sign up for free' : 'Get started';
                    $buttonClass = $plan->isFree() ? 'btn-outline-success' : 'btn-success';
                    if ($plan->isFree()) {
                        $fade = 'right';
                    } else if ($plan->isPro()) {
                        $fade = 'up';
                    } else if ($plan->isEnterprise()) {
                        $fade = 'left';
                    }
                @endphp
                <div class="col">
                    <div 
                        class="card mb-4 rounded-3 shadow-sm {{ $plan->isEnterprise() ? 'border-success' : '' }}"
                        data-aos="fade-{{ $fade }}">
                        <div class="card-header py-3 {{ $plan->isEnterprise() ? 'border-success text-bg-success' : '' }}">
                            <h4 class="my-0 fw-normal">{{ Str::ucfirst($plan->name) }}

                            @if ($plan->isFree())
                                <small class="free-trial"> / {{ __('1 month trial') }} </small>
                            @endif
                            </h4>
                            
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">
                                ${{ $plan->price }}
                                <small class="text-body-secondary fw-light">/mo</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                @if ($plan->canCreateQrCode())
                                    <li>{{ __('Create QR code') }}</li>
                                @endif
                                <li>
                                    
                                    {{ 
                                        $plan->landingpageCategoriesPrashe() 
                                    }}
                                </li>
                                <li>
                                    {{
                                        $plan->landingpageItemsPrashe()
                                    }}
                                </li>
                            </ul>
                            <a 
                                href="{{ route('register', ['locale' => app()->getLocale()]) }}"
                                type="button"
                                class="w-100 btn btn-lg {{ $buttonClass }}">
                                {{ __($actionButtonTitle) }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>