@extends('layouts.main.app')

@section('content')

@include('layouts.main.partials.header')
<!-- slider area start -->
<section>
    <div class="slider-area" style="background-image: url('{{ asset('uploads/header_image.png') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="slider-content text-center">
                        <h2>{{ __('hero_title') }}</h2>
                        <p>{{ __('hero_des') }}</p>
                        <div class="slider-btn">
                            <a href="#templates">{{ __('hero_btn_text') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider area end -->

<!-- benefit section start -->
<section>
    <div class="benefit-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="benefit-header-content text-center">
                        <h2>{{ __('benefit_title') }}</h2>
                        <p>{{ __('benefit_des') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 benefit"></div>
        </div>
    </div>
</section>
<!-- benefit section end -->

<!-- choice area start -->
<section>
    <div class="choice-area pb-150" id="templates">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="choice-header-content text-center">
                        <h2>{{ __('choice_title') }}</h2>
                        <p>{{ __('choice_des') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 choice-image"></div>
        </div>
    </div>
</section>
<!-- choice area end -->

<!-- pricing area start -->
<div class="pricing-area mb-100 pt-150 pb-150" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="pricing-header-area text-center">
                    <div class="pricing-header">
                        <h2>{{ __('pricing_title') }}</h2>
                        <p>{{ __('pricing_des') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pricing-table">
        </div>
    </div>
</div>
<!-- pricing area end -->

<!-- promo area start -->
<section>
    <div class="promo-area" style="background-image: url('{{ asset('main/assets/img/bg/1.png')}}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="promo-content text-center">
                        <h2>{{ __('promo_title') }}</h2>
                        <p>{{ __('promo_des') }}</p>
                        <div class="promo-btn">
                            <a href="{{ route('register') }}">{{ __('promo_btn_text') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- promo area end -->

<!-- faq area start -->
<section>
    <div class="faq-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="faq-header-title text-center">
                        <h2>{{ __('faq_title') }}</h2>
                        <p>{{ __('faq_des') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 asked-html"></div>
        </div>
    </div>
</section>
<!-- faq area end -->

<!-- blog area start -->
<section>
    <div class="blog-area mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="pricing-header-area text-center">
                        <div class="pricing-header">
                            <h2>{{ __('news_title') }}</h2>
                            <p>{{ __('news_des') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 blog_area">
                
            </div>
        </div>
    </div>
</section>
<!-- blog area end -->

<!-- client-logo area start -->
<section>
    <div class="client-logo pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="faq-header-title text-center">
                        <h2>{{ __('company_title') }}</h2>
                        <p>{{ __('company_des') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 align-items-center companey-section owl-carousel"></div>
        </div>
    </div>
</section>
<!-- client-logo area end -->
@endsection

@push('js')
<script src="{{ asset('main/assets/js/welcome.js') }}"></script>
@endpush