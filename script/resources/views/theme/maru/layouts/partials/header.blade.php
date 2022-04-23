<header>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <img class="img-fluid" src="{{ asset('uploads/'.Tenant('user_id').'/logo.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="mobile-menu f-right">
                        <a class="toggle f-right" href="#" role="button" aria-controls="hc-nav-1"><span class="iconify" data-icon="bi:grid-3x3-gap-fill" data-inline="false"></span></a>
                    </div>
                    <div class="header-btn f-right">
                        @if(!empty($info->hire ?? ''))
                        <a href="{{ url($info->hire) }}" target="_blank">{{ __('Hire Now') }}</a>
                        @endif
                    </div>
                    <div class="header-menu f-right">
                        <nav id="main-nav">
                            <ul>
                                <li><a href="{{ my_url() }}">{{ __('Home') }}</a></li>
                                <li><a href="#about">{{ __('About') }}</a></li>
                                <li><a href="#service">{{ __('Services') }}</a></li>
                                <li><a href="#portfolio">{{ __('Portfolio') }}</a></li>
                                <li><a href="{{ my_url() . '/blog' }}">{{ __('Blogs') }}</a></li>
                                <li><a href="#contact">{{ __('Contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>