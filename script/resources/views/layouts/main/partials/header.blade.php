<header>
    <div class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="/"><img class="img-fluid" src="{{ asset('uploads/logo.png')}}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="mobile-menu f-right">
                        <a class="toggle f-right" href="#" role="button" aria-controls="hc-nav-1"><span class="iconify" data-icon="bi:grid-3x3-gap-fill" data-inline="false"></span></a>
                    </div>
                    <div class="header-btn f-right">
                        <a href="{{ url('login') }}">{{ __('Login') }}</a>
                        <a href="{{ url('register') }}">{{ __('Create Your Account') }}</a>
                    </div>
                    <div class="header-menu f-right">
                        <nav id="main-nav">
                            <ul>
                                {{ header_menu('header') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>