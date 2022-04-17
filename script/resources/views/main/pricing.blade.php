@extends('layouts.main.app')

@section('content')

@include('layouts.main.partials.header')
{{-- breadgrump area start --}}
<section>
  <div class="breadgreamup-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="breadgrump-content text-center">
            <h2>{{ __('Pricing') }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>

    {{-- main area start --}}
    <section>
      <div class="main-area pt-150 pb-150 blog-list">
        <div class="container">
          <div class="row">
            @foreach ($pricings as $row)
            <div class="col-lg-3">
              <div class="single-pricing">
                <div class="pricing-type">
                  <h6>{{ $row->name }}</h6>
                </div>
                <div class="pricing-price">
                  <sub>{{ $currency_symbol }}</sub> {{ $row->price }} <sub>/ {{ $row->duration }} {{ __('Days') }}</sub>
                </div>
                <div class="pricing-list">
                  <ul>
                    <li class="{{ $row->resume_builder == 0 ? 'active' : ''  }}">
                      <span class="iconify" data-icon="akar-icons:{{ $row->resume_builder === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                      {{ __('Resume Builder') }}
                    </li>

                    <li class="{{ $row->portfolio_builder == 0 ? 'active' : ''  }}">
                      <span class="iconify" data-icon="akar-icons:{{ $row->portfolio_builder === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                      {{ __('Portfolio Builder') }}
                    </li>

                    <li class="{{ $row->custom_domain == 0 ? 'active' : ''  }}">
                     <span class="iconify" data-icon="akar-icons:{{ $row->custom_domain === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                     {{ __('Custom Domain') }}
                   </li>

                   <li class="{{ $row->sub_domain == 0 ? 'active' : ''  }}">
                     <span class="iconify" data-icon="akar-icons:{{ $row->sub_domain === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                     {{ __('Sub Domain') }}
                   </li>

                   <li>
                    <span class="iconify" data-icon="akar-icons:check" data-inline="false"></span>
                    {{ __('Storage Limit:') }} {{ number_format($row->storage_size,2) }} MB
                  </li>
                  <li>
                   <span class="iconify" data-icon="akar-icons:check" data-inline="false"></span>
                   {{ __('Post Limit:') }} {{ number_format($row->postlimit) }}
                 </li>

                 <li class="{{ $row->vcard == 0 ? 'active' : ''  }}">
                   <span class="iconify" data-icon="akar-icons:{{ $row->vcard === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                   {{ __('Online Business Card (VCard)') }}
                 </li>

                 <li class="{{ $row->online_cv == 0 ? 'active' : ''  }}">
                   <span class="iconify" data-icon="akar-icons:{{ $row->online_cv === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                   {{ __('Online CV') }}
                 </li>

                 <li class="{{ $row->qrcode == 0 ? 'active' : ''  }}">
                  <span class="iconify" data-icon="akar-icons:{{ $row->qrcode === 1 ? 'check' : 'cross'}}" data-inline="false"></span>
                  {{ __('QR Code') }}
                </li>
              </ul>
            </div>
            <div class="pricing-btn">
              <a href="{{ route('register') }}">{{ __('Get Started') }}</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>


    </div>
  </div>
</section>
{{-- main area end --}}
@endsection