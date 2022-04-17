<!-- footer area start -->
<footer>
    <div class="footer-area pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="footer-content text-center">
                        <span>{{ __('Copyright © Website -') }} {{ Carbon\Carbon::now()->format('Y') }}.
                            {{ __('Powered By') }}
                            <a href="{{ url('/') }}">{{ config()->get('app.name') }}</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>