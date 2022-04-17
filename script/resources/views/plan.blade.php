@extends('layouts.app')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
@endpush
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @foreach ($plans ?? [] as $plan)
                    <div class="card single-pricing {{ $plan->is_featured == 1 ? 'active' : '' }}">
                        <div class="card-header">
                            @php
                            if ($plan->duration == 30) {
                                $duration = 'Monthly';
                            } elseif ($plan->duration == 365) {
                                $duration = 'Yearly';
                            } else {
                                $duration = $plan->duration . ' Days';
                            }
                            @endphp
                            <div class="pricing-type">
                                <h4><span class="badge badge-primary">{{ $plan->name }}</span></h4>
                            </div>
                            <div class="pricing-price">
                                <sub>$</sub> {{ number_format($plan->price, 2) }}
                                <sub>/ {{ $duration }}</sub>
                            </div>
                        </div>
                        <div>
                            
                            <div class="pricing-list">
                                <ul class="list-group">
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->resume_builder ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Resume Builder') }}</li>

                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->portfolio_builder ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Portfolio Builder') }}</li>

                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->custom_domain ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Custom Domain') }}</li>
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->sub_domain ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Sub Domain') }}</li>
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->post_limit ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Post Limit') }}</li>
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->online_businesscard ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Online Business Card') }}</li>
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->qrcode ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('QR Code') }}</li>
                                    <li class="list-group-item border-0"><i class="fas fa-{{ $plan->analytics ? 'check-circle text-primary' : 'times-circle text-danger' }}"></i>
                                        {{ __('Analytics') }}</li>
                                </ul>
                            </div>
                            <div class="">
                                <a class="btn btn-primary w-100 p-2 rounded-0" href="{{ route('register', ['plan'=>$plan->id]) }}">{{ __('Get Started') }}</a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
