<!-- footer area start -->
<footer>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-left-area">
                        <p>© {{ date('Y') }} {{ strtoupper(env('APP_NAME')) }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-right-area f-right">
                        <div class="footer-menu">
                            <nav>
                                <ul>
                                    <li><a href="{{ my_url() }}">{{ __('Home') }}</a></li>
                                    <li><a href="{{my_url()}}#about">{{ __('About') }}</a></li>
                                    <li><a href="{{my_url()}}#service">{{ __('Services') }}</a></li>
                                    <li><a href="{{ my_url() . '/blog' }}">{{ __('Blogs') }}</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->