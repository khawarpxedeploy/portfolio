
@extends('theme.default.layouts.app')

@section('content')
@include('theme.default.layouts.header',['hire_link'=>$info->hire ?? ''])
<!-- slider area start -->
<section>
    <div class="slider-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="slider-content">
                        <h2 class="cd-headline clip is-full-width"> {{ $info->hero_title ?? '' }} <br>
                            <span class="cd-words-wrapper">
                                @if (isset($info->tagline))
                                @foreach ($info->tagline as $key=>$value)
                                <b class="{{ $key == 0 ? 'is-visible' : '' }}">{{ $value }}</b>
                                @endforeach  
                                @endif
                            </span>
                        </h2>
                        <p>{{ $info->hero_description ?? '' }}</p>
                        @if(!empty($info->cv_url ?? ''))
                        <div class="slider-btn">
                            <a target="_blank" href="{{ url($info->cv_url) }}">{{ __('Download CV') }} <span class="iconify" data-icon="akar-icons:download" data-inline="false"></span></a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slider-img">
                        <img src="{{ asset($info->hero_img ?? '') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider area end -->


<!-- about area start -->
<section id="about">
    <div class="about-area pt-150 pb-150 mb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img class="img-fluid" src="{{ asset($info->about_img ?? '') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-section-content">
                        <h2>{{ $info->title_about ?? '' }}</h2>
                        <p>{{ $info->about_description ?? '' }}</p>
                        <div class="personal-list">
                            <div class="list-item wrap-middle">
                                <span class="desc">{{ __('Full Name:') }}</span>
                                <span>{{ $info->full_name ?? '' }}</span>
                            </div>
                            <div class="list-item wrap-middle">
                                <span class="desc">{{ __('Age:') }}</span>
                                <span>{{ $info->age ?? '' }}</span>
                            </div>
                            <div class="list-item wrap-middle">
                                <span class="desc">{{ __('Experience:') }}</span>
                                <span>{{ $info->experience ?? '' }}</span>
                            </div>
                            <div class="list-item wrap-middle">
                                <span class="desc">{{ __('Email:') }}</span>
                                <span>{{ $info->email ?? '' }}</span>
                            </div>
                        </div>
                        <div class="about-bottom-area">
                             @if(!empty($info->cv_url ?? ''))
                            <a href="{{ url($info->cv_url) }}" class="btn"><span class="iconify" data-icon="akar-icons:download" data-inline="false"></span> {{ __('Download CV') }}</a>
                            @endif
                            <div class="user-social-links">
                                @foreach($info->social ?? [] as $row)
                                <a target="_blank" href="{{ url($row->link) }}"><span class="{{ $row->icon }}"></span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</section>
<!-- about area end -->

<!-- services area start -->
<section id="service">
    <div class="service-area pt-50 pb-150">
        <div class="container">
           
            <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-left-area">
                            <div class="services-solution">
                                <h2>{{ strtoupper($info->service_title ?? '') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-header-right-area">
                            <p>{{ $info->service_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
            <div class="row mt-5 services">
            </div>
        </div>
    </div>
</section>
<!-- services area end -->

<!-- education & experience area start -->
<section id="education">
    <div class="education-experience-area mb-100">
        <div class="container">
          
            <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-left-area">
                            <div class="services-solution">
                                <h2>{{ strtoupper($info->education_title ?? '') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-header-right-area">
                            <p>{{ $info->education_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
            <div class="row mt-5 education-section-start">
                <div class="col-lg-6 mb-30">
                    <div class="single-education-experience experience">

                    </div>
                </div>
                <div class="col-lg-6 mb-30">
                    <div class="single-education-experience education">

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- education & experience area end -->

 <!-- counter area start -->
    <section id="counter">
        <div class="counter-area pt-150 pb-150">
            <div class="container">
                <div class="row">
                    @foreach($info->counter ?? [] as $row)
                    <div class="col-lg-4">
                        <div class="single-counter">
                            <div class="counter-icon">
                                <span class="{{ $row->icon }} iconify"  data-inline="false"></span>
                            </div>
                            <div class="counter-content">
                                <div class="counter-num">
                                    <strong>{{ $row->count }}</strong>
                                    <p>{{ $row->label }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- counter area end -->

<!-- project area start -->
<section id="project">
    <div class="project-area mt-150 mb-150">
        <div class="container">
         
            <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-left-area">
                            <div class="services-solution">
                                <h2>{{ strtoupper($info->portoflio_title ?? '') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-header-right-area">
                            <p>{{ $info->portoflio_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
            <div class="row mt-5 projects">
            </div>
        </div>
    </div>
</section>
<!-- project area end -->

<!-- client review area start -->
<section id="testimonial">
    <div class="client-review pt-150 pb-200 mb-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-left-area">
                            <div class="services-solution">
                                <h2>{{ strtoupper($info->testimonial_title ?? '') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-header-right-area">
                            <p>{{ $info->testimonial_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-header-right-area">
                        <p class="review-des"></p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 reviews">
            </div>
        </div>
    </div>
</section>
<!-- client review area end -->

<!-- blog area start -->
<section id="blog">
    <div class="blog-area mt-150 mb-150">
        <div class="container">
            <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-left-area">
                            <div class="services-solution">
                                <h2>{{ strtoupper($info->blog_title ?? '') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-header-right-area">
                            <p>{{ $info->blog_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
            <div class="row mt-5 blogs">
            </div>
        </div>
    </div>
</section>
<!-- blog area end -->

<!-- contact area start -->
<section id="contact">
    <div class="subscribe-area pt-150 pb-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="service-left-area">
                        <div class="services-solution">
                            <h2>{{ strtoupper($info->contact_title ?? '') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-header-right-area">
                        <p>{{ $info->contact_description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form action="{{ url(my_url().'/contact-mail') }}" method="POST" class="basicform_with_reset">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="{{ __('Enter Your Name') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{ __('Enter Your Email') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" placeholder="{{ __('Enter Your Subject') }}" name="subject" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="message" cols="30" rows="10" placeholder="{{ __('Message') }}" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="submit-btn">
                                <button type="submit" class="basicbtn">{{ __('Send Message') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->
@include('theme.default.layouts.footer')
@endsection

@push('js')
<script src="{{ asset('theme/default/js/welcome.js') }}"></script>
@endpush
