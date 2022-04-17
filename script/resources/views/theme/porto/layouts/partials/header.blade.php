<!-- header area start -->
<header>
    <div class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="{{ my_url() }}"><img class="img-fluid" src="{{ asset('uploads/'.Tenant('user_id').'/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="header-menu text-center">
                        <nav id="main-nav">
                            <ul>
                                <li><a href="{{ my_url() }}">{{ __('Home') }}</a></li>
                                <li><a href="#about">{{ __('About') }}</a></li>
                                <li><a href="#portfolio">{{ __('Portfolio') }}</a></li>
                                <li><a href="{{ my_url() . '/blog' }}">{{ __('Blogs') }}</a></li>
                                <li><a href="#contact">{{ __('Contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mobile-menu f-right">
                        <a class="toggle f-right" href="#" role="button" aria-controls="hc-nav-1"><span class="iconify" data-icon="bi:grid-3x3-gap-fill" data-inline="false"></span></a>
                    </div>
                    @if(!empty($info->hire ?? ''))
                    <div class="header-btn f-right">
                        <a href="{{ url($info->hire ?? '') }}" target="_blank"><span class="iconify" data-icon="akar-icons:circle-plus" data-inline="false"></span> {{ __('Hire Me') }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->