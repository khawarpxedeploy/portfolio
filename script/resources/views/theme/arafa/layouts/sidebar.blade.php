<section>
    <div class="sidebar-area">
        <div class="sidebar-main-content">
            <div class="slider-logo">
                <a href="{{ my_url() }}">
                    <img class="img-fluid" src="{{ asset('uploads/'.Tenant('user_id').'/logo.png') }}" alt="">
                </a>
            </div>
            <div class="sidebar-menu">
                <nav>
                    <ul>
                        <li><a href="{{ my_url() }}">{{ __('Home') }}</a></li>
                        <li><a href="#about">{{ __('About') }}</a></li>
                        <li><a href="#portfolio">{{ __('Portfolio') }}</a></li>
                        <li><a href="{{ my_url(). '/blog' }}">{{ __('Blogs') }}</a></li>
                        <li><a href="#contact">{{ __('Contact') }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="copyright-area">
                <p>© {{ Carbon\Carbon::now()->format('Y') }} <br> {{ __('Created by') }} {{ config()->get('app.name') }}
                </p>
            </div>
        </div>
    </div>
</section>