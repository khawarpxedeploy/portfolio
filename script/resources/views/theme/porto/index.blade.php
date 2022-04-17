

@extends('theme.porto.layouts.app')

@section('content')
@include('theme/porto/layouts/partials/header')
 <!-- slider area start -->
 <div class="slider-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="slider-profile-image f-right">
                    <img src="{{ asset($info->hero_img ?? '') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="slider-content">
                    <div class="author-position">
                        <h5>{{ $info->hero_description ?? '' }}</h5>
                    </div>
                    <div class="author-name">
                        <h2 class="cd-headline clip is-full-width">{{ $info->hero_title ?? '' }}
                            <span class="cd-words-wrapper">
                                @if (isset($info->tagline))
                                @foreach ($info->tagline as $key=> $value)
                                <b class="{{ $key == 0 ? 'is-visible' : '' }}">{{ $value }}</b>
                                @endforeach 
                                @endif
                            </span>
                        </h2>
                    </div>
                    <div class="slider-btn">
                        <a href="#portfolio">{{ __('My Portfolio') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider area end -->

<!-- about area start -->
<section class="skill-area" id="about">
    <div class="about-area pt-150 pb-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left-area">
                        <h3>{{ $info->title_about ?? '' }}</h3>
                        <p>{{ $info->about_description ?? '' }}</p>
                        <div class="about-skills">
                            <nav>
                                <ul>
                                    @foreach($info->social ?? [] as $row)
                                    <li><a target="_blank" href="{{ url($row->link) }}"><span class="{{ $row->icon }} iconify" data-icon="{{ $row->icon }}" data-inline="false"></span></a></li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                        @if(!empty($info->cv_url ?? ''))
                        <div class="about-btn">
                            <a href="{{ url($info->cv_url) }}"><span class="iconify" data-icon="akar-icons:download" data-inline="false"></span> Download CV</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="skills-area">
                        <div class="skill-header-title">
                            <h3>{{ __('My Skills') }}</h3>
                        </div>
                        <div class="skills-body skill_area">
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->

<!-- service area start -->
<section class="service-area" id="service">
    <div class="service-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-title text-center">
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
    <div class="portfolio-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-title text-center">
                        <h2>{{ $info->portoflio_title ?? '' }}</h2>
                        <p>{{ $info->portoflio_description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 grid portfolio_area">
                
            </div>
        </div>
    </div>
</section>
<!-- portfolio area end -->


<!-- education area start -->
<section class="experiance-area" id="education">
    <div class="education-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-title text-center">
                        <h2>{{ $info->education_title ?? '' }}</h2>
                        <p>{{ $info->education_description ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 experiance_area">
                
                
            </div>
        </div>
    </div>
</section>
<!-- education area end -->

<!-- blog area start -->
<section class="blog-area" id="blog">
    <div class="blog-area pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-title text-center">
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
    <div class="contact-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-title text-center">
                       <h2>{{ $info->contact_title ?? '' }}</h2>
                        <p>{{ $info->contact_description ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-main-area">
            <div class="container contact-bg">
                <div class="row align-items-center">
                    <div class="col-lg-6 contact-lg">
                        <div class="contact-left-form">
                            <div class="contact-form-header">
                                <h4>{{ __('Contact Us') }}</h4>
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
                                <h4 class="font-alt">Get in touch</h4>
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
<script src="{{ asset('theme/porto/js/index.js') }}"></script>
@endpush