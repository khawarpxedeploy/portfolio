

@extends('theme.maru.layouts.app')
@include('theme.maru.layouts.partials.header')
@section('content')
<!-- slider area start -->
<section>
    <div class="slider-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slider-content">
                        <div class="slider-main-content">
                            <span>{{ $info->hero_title ?? '' }}</span>
                            <h2 class="cd-headline clip is-full-width"> 
                                <span class="cd-words-wrapper">
                                    @if (isset($info->tagline))
                                    @foreach ($info->tagline as $key=>$value)
                                    <b class="{{ $key == 0 ? 'is-visible' : '' }}">{{ $value }}</b>
                                    @endforeach
                                    @endif
                                </span>
                            </h2>
                            <p>{{ $info->hero_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slider-img">
                        <div class="slider-img-background" style="background-image: url('{{ asset($info->hero_img ?? '') }}');">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider area end -->


<!-- about area start -->
<section id="about">
    <div class="about-area pt-150 pb-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left-area">
                        <div class="about-img">
                            <img class="img-fluid" src="{{ asset($info->about_img ?? '') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right-area">
                        <div class="about-content">
                            <div class="about-badge">
                                <span>{{ __('About Me') }}</span>
                            </div>
                            <div class="about-title">
                                <h2>{{ $info->title_about ?? '' }}
                                </h2>
                            </div>
                            <div class="about-des">
                                <p>{{ $info->about_description ?? '' }}</p>
                            </div>
                             @if(!empty($info->cv_url ?? ''))
                            <div class="about-btn">
                                <a href="{{ url($info->cv_url) }}">{{ __('Download CV') }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->


<!-- service area start -->
<section id="service">
    <div class="service-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="service-header-area text-center">
                        <h2>{{ $info->service_title ?? '' }}</h2>
                        <p>{{ $info->service_description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 service_area">
            
            </div>
        </div>
    </div>
</section>
<!-- service area end -->

<!-- portfolio area start -->
<section id="portfolio">
    <div class="portfolio-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="portfolio-header-title text-center">
                     <h2>{{ $info->portoflio_title ?? '' }}</h2>
                     <p>{{ $info->portoflio_description ?? '' }}</p>
                    </div>
                </div>
            </div>
           
            <div class="row grid portfolio_section">
               
                
            </div>
        </div>
    </div>
</section>
<!-- portfolio area end -->


<!-- blog area start -->
<section id="blogs">
    <div class="blog-area pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="blog-header-title text-center">
                      <h2>{{ $info->blog_title ?? '' }}</h2>
                      <p>{{ $info->blog_description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 blog_area">
                
                
            </div>
        </div>
    </div>
</section>
<!-- blog area end -->

<!-- contact area start -->
<section id="contact">
    <div class="contact-area pb-150">
        <div class="contact-main-area">
            <div class="container contact-bg">
                <div class="row align-items-center">
                    <div class="col-lg-6 contact-lg">
                        <div class="contact-left-form">
                            <div class="contact-form-header">
                                <h4>{{ $info->contact_title ?? '' }}</h4>
                            </div>
                            <div class="contact-form-body">
                                <form action="{{ url(my_url().'/contact-mail') }}" method="POST" class="basicform_with_reset">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Subject" name="subject">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea class="form-control" cols="30" rows="10" placeholder="Message" name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-btn">
                                                <button type="submit" class="basicbtn">{{ __('Send Your Message') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ml-auto">
                        <div class="contact-info">
                            <div class="sm-title">
                                <h4 class="font-alt">{{ __('Get in touch') }}</h4>
                                <p>{{ $info->contact_short_description ?? '' }}</p>
                            </div>
                            <div class="media">
                                <div class="icon">
                                    <span class="iconify" data-icon="clarity:map-outline-alerted" data-inline="false"></span>
                                </div>
                                <span class="media-body">{{ $info->contact_address ?? '' }}</span>
                            </div>
                            <div class="media">
                                <div class="icon">
                                    <span class="iconify" data-icon="carbon:email" data-inline="false"></span>
                                </div>
                                <span class="media-body">{{ $info->contact_email ?? '' }}</span>
                            </div>
                            <div class="media">
                                <div class="icon">
                                    <span class="iconify" data-icon="akar-icons:phone" data-inline="false"></span>
                                </div>
                                <span class="media-body">{{ $info->contact_phone ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->
@endsection

@push('js')
<script src="{{ asset('theme/maru/js/index.js') }}"></script>
@endpush

