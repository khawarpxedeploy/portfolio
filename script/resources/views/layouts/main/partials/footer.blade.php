<footer>
    <div class="footer-area footer-demo-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="footer-left-area">
                        <div class="footer-logo">
                            <div class="header-logo">
                                <img class="img-fluid" src="{{ asset('uploads/logo.png')}}" alt="">
                            </div>
                            <div class="footer-content">
                                <p>{{ __('footer_description') }}</p>
                            </div>
                            @php
                                $languages = App\Models\Language::where([
                                    ['type','web'],
                                    ['status',1]
                                ])->get();
                               
                            @endphp
                            <div class="footer-lang">
                                <input type="hidden" id="language_url" value="{{ route('lang.set') }}">
                                <select class="form-select" id="language_switch">
                                    @foreach ($languages as $lang)
                                    <option {{ Session::get('locale') == $lang->name ? 'selected' : '' }} value="{{ $lang->name }}">{{ $lang->data }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="agent-social-links">
                                <nav>
                                    <ul>
                                        <!--chache data form AppServiceProvidor -->
                                        @foreach ($basic_settings->social ?? [] as $key => $item)
                                        <li><a href="{{ $item->link ?? '#'}}"><span class="iconify" data-icon="{{ $item->icon }}" data-inline="false"></span></a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-menu">
                         {{ footer_menu('footer_left') }}
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-menu">
                        {{ footer_menu('footer_right') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-newsletter">
                        <div class="footer-menu-title">
                            <h4>{{ __('Newsletter') }}</h4>
                        </div>
                        <div class="footer-content">
                            <!--chache data form AppServiceProvidor -->
                            <p>{{ $basic_settings->address ?? null }}
                            </p>
                        </div>
                        <div class="footer-newsletter-input">
                            <form action="{{ route('newsletter') }}" id="newsletter" method="post"
                                class="basicform_with_reset">
                                @csrf
                                <input type="email" name="email" placeholder="{{ __('Enter Your Email Address') }}"
                                    id="subscribe_email">
                                <button type="submit" class="basicbtn">{{ __('Subscribe') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area footer-demo-1">
        <div class="footer-bottom-content text-center">
            <span>{{ __('Copyright © Website -') }} {{ Carbon\Carbon::now()->format('Y') }}. {{ __('Powered By') }}
                <a href="{{ url('/') }}">{{ config()->get('app.name') }}</a></span>
        </div>
    </div>
</footer>