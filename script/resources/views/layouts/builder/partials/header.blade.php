<!-- header area start -->
<header>
    <div class="header-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="back-btn">
                        <a href="{{ route('user.dashboard') }}"><span class="iconify"
                                data-icon="fluent:ios-arrow-left-24-filled"
                                data-inline="false"></span>{{ __('Back') }}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-menu">
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                                <div class="single-menu">
                                    <div class="menu-header">
                                        <span>{{ __('Select Theme') }}</span>
                                    </div>
                                    <div class="menu-body">
                                        <div class="theme-name selected-item theme">
                                            <a href="#">
                                                <h5><span class="iconify" data-icon="akar-icons:file"
                                                        data-inline="false"></span> <span class="name value"></span>
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="single-menu">
                                    <div class="menu-header">
                                        <span>{{ __('Select Color') }}</span>
                                    </div>
                                    <div class="menu-body">
                                        <div class="custom-select">
                                            <span class="iconify" data-icon="akar-icons:light-bulb"
                                                data-inline="false"></span>
                                            <select class="form-control" id="select-color">
                                                <option value="" selected disabled>{{ __('Select Color') }}</option>
                                                <option value="#ff0000">{{ __('Red') }}</option>
                                                <option value="#008000">{{ __('Green') }}</option>
                                                <option value="#0000ff">{{ __('Blue') }}</option>
                                                <option value="custom">{{ __('Pick a Color') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="single-menu">
                                    <div class="menu-header">
                                        <span>{{ __('Select Mode') }}</span>
                                    </div>
                                    <div class="menu-body">
                                        <div class="custom-select">
                                            <span class="iconify" data-icon="codicon:color-mode"
                                                data-inline="false"></span>
                                            <select class="form-control" id="select-mode">
                                                <option selected disabled value="en">{{ __('Select Mode') }}</option>
                                                <option value="light">{{ __('Light') }}</option>
                                                <option value="dark">{{ __('Dark') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="single-menu">
                                    <div class="menu-header">
                                        <span>{{ __('Select Language') }}</span>
                                    </div>
                                    <div class="menu-body">
                                        <div class="custom-select">
                                            <span class="iconify" data-icon="bx:bx-world" data-inline="false"></span>
                                            <select class="form-control" name="cvlanguage" id="select-language">
                                                <option value="en">{{ __('English') }}</option>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->name }}">{{ $language->data }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-download-btn f-right {{ !planData('resume_builder') ? 'cvbutton-disabled' : '' }}">
                        @php
                            $tenant = App\Models\Tenant::where([
                                ['user_id',Auth::User()->id],
                                ['status',1]
                            ])->first();
                        @endphp
                        <a id="downloadURL" target="_blank" href="{{ url('profile/'.$tenant->id.'/cv') }}">
                            @if (!planData('resume_builder'))
                            <span class="iconify" data-icon="fa-solid:lock" data-inline="false"></span>
                            @else 
                            <span class="iconify" data-icon="carbon:view-filled"></span>
                            @endif
                            {{ __('View CV') }}</a>
                    </div>
                    <div class="header-btn f-right">
                        <a id="resetform" class="text-light"><span class="iconify" data-icon="fluent:delete-24-filled"
                                data-inline="false"></span> {{ __('Clear All') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->


<div class="themes shadow-sm bg-body rounded">
    <ul class="navbar-nav cv-theme-section mx-auto mb-lg-0">
        @foreach ($themes ?? [] as $theme)
        <li class="nav-item custom-select me-4  my-2">
            <div class="card single-theme">
                <div class="card-body theme-preview" data-name='{{ $theme->name }}' data-theme='{{ $theme->view_path }}'>
                    <img class="theme-img" src="{{ asset($theme->asset_path.'/img/screenshot.png') }}" alt="">
                    <br>
                    <div class="text-center theme_name">{{ ucwords($theme->name) }}</div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>