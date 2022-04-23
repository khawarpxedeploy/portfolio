@if($user == !null)
@php $setting = json_decode($user->value); @endphp
@else
@php $setting = null; @endphp
@endif

<header class="navigation fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand font-tertiary h3" href="{{ my_url('/') }}"><img src="{{ asset($setting->logo_url ?? null)}}"
                height="50" alt="Myself"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ my_url('/') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ my_url('/about') }}">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ my_url('/blog') }}">{{ __('Blog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ my_url('/portfoliohel') }}">{{ __('Portfolio') }}</a>
                </li>
            </ul>
        </div>
    </nav>
</header>