@extends('layouts.backend.app')

@section('title', 'Select your plan')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Select your plan'])
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('type') }}">
            {{ Session::get('message') }}
        </div>
        @endif
    </div>
    @foreach ($plans ?? [] as $plan)
    <div class="col-lg-4">
        <div class="pricing {{ $plan->is_featured == 1 ? 'pricing-highlight' : '' }}">
            <div class="pricing-title">
                {{ $plan->name }}
            </div>
            @php
            if ($plan->duration == 30) {
                $duration = 'Monthly';
            } elseif ($plan->duration == 365) {
                $duration = 'Yearly';
            } else {
                $duration = $plan->duration . ' Days';
            }
            @endphp
            <div class="pricing-padding">
              <div class="pricing-price">
                <div>$ {{ number_format($plan->price, 2) }}</div>
                <div>{{ $duration }}</div>
              </div>
              <div class="pricing-details">
                <div class="pricing-item">
                  <div class="pricing-item-icon {{ $plan->resume_builder ? '' : 'bg-danger text-white' }}"><i class="fas fa-{{ $plan->resume_builder ? 'check' : 'times' }}"></i></div>
                  <div class="pricing-item-label">{{ __('Resume Builder') }}</div>
                </div>
                <div class="pricing-item">
                  <div class="pricing-item-icon {{ $plan->portfolio_builder ? '' : 'bg-danger text-white' }}"><i class="fas fa-{{ $plan->portfolio_builder ? 'check' : 'times' }}"></i></div>
                  <div class="pricing-item-label">{{ __('Portfolio Builder') }}</div>
                </div>
                <div class="pricing-item">
                  <div class="pricing-item-icon {{ $plan->custom_domain ? '' : 'bg-danger text-white' }}"><i class="fas fa-{{ $plan->custom_domain ? 'check' : 'times' }}"></i></div>
                  <div class="pricing-item-label">{{ __('Custom Domain') }}</div>
                </div>
                <div class="pricing-item">
                  <div class="pricing-item-icon {{ $plan->sub_domain ? '' : 'bg-danger text-white' }}"><i class="fas fa-{{ $plan->sub_domain ? 'check' : 'times' }}"></i></div>
                  <div class="pricing-item-label">{{ __('Sub Domain') }}</div>
                </div>
                <div class="pricing-item">
                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                    <div class="pricing-item-label">{{ __('Storage Limit: ') }}{{ $plan->storage_size }} {{ __('GB') }}</div>
                </div>
                <div class="pricing-item">
                  <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                  <div class="pricing-item-label">{{ __('Post Limit: ') }}{{ $plan->postlimit }}</div>
                </div>
                <div class="pricing-item">
                    <div class="pricing-item-icon {{ $plan->online_businesscard ? '' : 'bg-danger text-white' }} {{ $plan->online_businesscard ? 'check' : 'times' }}"><i class="fas fa-{{ $plan->online_businesscard ? 'check' : 'times' }}"></i></div>
                    <div class="pricing-item-label">{{ __('Online Businesscard') }}</div>
                </div>
                <div class="pricing-item">
                    <div class="pricing-item-icon {{ $plan->qrcode ? '' : 'bg-danger text-white' }} {{ $plan->qrcode ? 'check' : 'times' }}"><i class="fas fa-{{ $plan->qrcode ? 'check' : 'times' }}"></i></div>
                    <div class="pricing-item-label">{{ __('QR Code') }}</div>
                </div>
                <div class="pricing-item">
                    <div class="pricing-item-icon {{ $plan->online_cv ? '' : 'bg-danger text-white' }} {{ $plan->online_cv ? 'check' : 'times' }}"><i class="fas fa-{{ $plan->online_cv ? 'check' : 'times' }}"></i></div>
                    <div class="pricing-item-label">{{ __('Online CV') }}</div>
                </div>
               
              </div>
            </div>
            <div class="pricing-cta">
              <a href="{{ route('user.plan.gateways', $plan->id) }}">{{ $plan->is_trial == 0 ? __('Activate') : __('Free Trial') }} <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h4>{{ __('User Transactions') }}</h4>
    </div>
    <div class="card-body">
        <table class="table mt-2">
            <thead>
                <tr>
                    
                    <th>{{ __('Trx Id') }}</th>
                    <th>{{ __('Plan') }}</th>
                    <th>{{ __('Getway') }}</th>
                    <th>{{ __('Amount') }}</th>
                    
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders ?? [] as $order)
                    <tr>
                        
                        <td>{{ $order->trx }}</td>
                        <td>{{ $order->plan->name }}</td>
                        <td>{{ $order->getway->name }}</td>
                        <td>{{ $order->price }}</td>
                        @php
                        $status = [
                        0 => ['class' => 'badge-danger', 'text' => 'Rejected'],
                        1 => ['class' => 'badge-primary', 'text' => 'Accepted'],
                        2 => ['class' => 'badge-danger', 'text' => 'Pending'],
                        3 => ['class' => 'badge-warning', 'text' => 'Expired'],
                        ][$order->status];
                        @endphp
                        <td><span class="badge badge-sm {{ $status['class'] }}">{{ $status['text'] }}</span></td>
                        <td>{{ $order->created_at->isoFormat('LL') }}</td>
                        <td><a class="btn btn-primary" href="{{ route('user.plan.show', $order->id) }}"><i
                                    class="fa fa-eye"></i> {{ __('View') }}</a>
                            <a href="{{ url('user/plan-invoice', $order->id) }}"
                                class="btn btn-icon btn-info ml-2">{{ __('PDF') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
