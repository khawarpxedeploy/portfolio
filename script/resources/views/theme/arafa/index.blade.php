@extends('theme.arafa.layouts.app')

@section('content')
<!-- main area start -->
<section>
    <div class="main-area pb-0">
        <div class="container-fluid pl-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- sidebar area start -->
                    @include('theme.arafa.layouts.sidebar')
                    <!-- sidebar area end -->
                </div>
                <div class="col-lg-9">
                <!-- sider area start -->
                   <div class="main-container">
                        <div class="slider-content">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="slider-content">
                                        <h3>{{ strtoupper($info->hero_title ?? '') }}</h3>
                                        <h2 class="cd-headline clip is-full-width">
                                            <span class="cd-words-wrapper">
                                                @if (isset($info->tagline))
                                                @foreach ($info->tagline as $key=> $value)
                                                <b class="{{ $key == 0 ? 'is-visible' : '' }}">{{ $value }}</b>
                                                @endforeach  
                                                @endif
                                            </span>
                                        </h2>
                                        <p>{{ $info->hero_description ?? '' }}</p>
                                            <div class="slider-btn">
                                                <a href="#portfolio">{{ __('View My Works') }}</a>
                                                <a href="#contact">{{ __('Contact Me') }} <span class="iconify" data-icon="bi:arrow-down-circle" data-inline="false"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-6">
                                    <div class="slider-img f-right">
                                        <img src="{{ asset($info->hero_img ?? '') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slider area end -->

                    <!-- about-area-start -->
                     <div class="about-main-area" id="about">
                            <div class="about-content">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="about-img">
                                            <img class="img-fluid" src="{{ asset($info->about_img ?? '') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="about-right-content">
                                            <div class="user-name">
                                                <h4>{{ $info->title_about ?? '' }}</h4>
                                            </div>
                                           
                                            <div class="user-des">
                                                <p>{{ $info->about_description ?? '' }}</p>
                                            </div>
                                            <div class="user-btn">
                                                <a href="#contact">{{ __('Contact Us') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- about area end -->


                    <!-- service area start -->
                    <section id="service">
                        <div class="service-area pt-100 pb-100">
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="service-header-content text-center">
                                                <h3>{{ $info->service_title ?? '' }}</h3>
                                                <p>{{ $info->service_description ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row mt-5 services"></div>
                            </div>
                        </div>
                    </section>
                    <!-- service area end -->


                    <!-- portfolio area start -->
                    <section id="portfolio">
                        <div class="portfolio-area pt-100 pb-100">
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="portfolio-header-section text-center">
                                                <h4>{{ $info->portoflio_title ?? '' }}</h4>
                                                <p>{{ $info->portoflio_description ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row mt-5" id="portfolio-section"></div>
                            </div>
                        </div>
                    </section>
                    <!-- portfolio area end -->
                    <!-- news area start -->
                    <section id="news">
                        <div class="news-area pt-100 pb-100">
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="news-header-section text-center">
                                                <h4>{{ $info->blog_title ?? '' }}</h4>
                                                <p>{{ $info->blog_description ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row mt-5 blogs">
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- news area end -->
                    <!-- contact area start -->
                    <section id="contact">
                        <div class="contact-area pt-100 pb-100">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="contact-header-area text-center">
                                            <h4>{{ $info->contact_title ?? '' }}</h4>
                                            <p>{{ $info->contact_description ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-lg-12">
                                        <div class="contact-form">
                                            <form action="{{ url(my_url().'/contact-mail') }}" method="POST"
                                                class="basicform_with_reset">@csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Name') }}</label>
                                                            <input type="text" placeholder="Name" class="form-control"
                                                                name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Email') }}</label>
                                                            <input type="text" placeholder="Email" name="email"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Subject') }}</label>
                                                            <input type="text" placeholder="Subject" name="subject"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Message') }}</label>
                                                            <textarea placeholder="Message" name="message"
                                                                class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="button-btn">
                                                            <button
                                                                class="w-100 basicbtn bg-transparent border-0 text-light h-100"
                                                                type="submit">{{ __('Send Message') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- contact area end -->
                    <!-- footer area start -->
                    @include('theme.arafa.layouts.footer')
                    <!-- footer area end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->
@endsection

@push('js')
<script src="{{ asset('theme/arafa/js/index.js') }}"></script>
@endpush