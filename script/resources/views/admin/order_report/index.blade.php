@extends('layouts.backend.app')

@section('title','Order Report')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Order Report'])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-list"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>{{ __('Total Orders') }}</h4>
              </div>
              <div class="card-body">
                {{ $total_orders }}
              </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>{{ __('Total Earnings') }}</h4>
              </div>
              <div class="card-body">
                {{ \App\Models\Option::where('key','currency_symbol')->pluck('value')->first() ?? "$" }}
                {{ $total_earning }}
              </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-clock"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>{{ __('Total Pendings') }}</h4>
              </div>
              <div class="card-body">
                {{ $total_pending }}
              </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-clock"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>{{ __('Total Expired Orders') }}</h4>
              </div>
              <div class="card-body">
                {{ $total_expired }}
              </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('admin.report.index') }}" type="get">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="start_date" required="" />
                                <input type="date" class="form-control" name="end_date" required="" />
                                <button class="btn btn-primary mb-0 btn-lg" type="submit"
                                    id="button-addon2">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.report.index') }}" type="get">
                            <div class="input-group mb-3">
                                <select class="form-control selectric" name="day" aria-describedby="button-addon2">
                                    <option value="today">{{ __('Today') }}</option>
                                    <option value="thisWeek">{{ __('This Week') }}</option>
                                    <option value="thisMonth">{{ __('This Month') }}</option>
                                    <option value="thisYear">{{ __('This Year') }}</option>
                                </select>
                                <button class="btn btn-primary mb-0 btn-lg" type="submit"
                                    id="button-addon2">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ route('admin.report.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search " aria-label="Search "
                                    aria-describedby="button-addon2" name="q">
                                <select class="form-control selectric" name="type" aria-describedby="button-addon2">
                                    <option value="" selected disabled>{{ __('Select Option') }}</option>
                                    <option value="user">{{ __('User') }}</option>
                                    <option value="plan">{{ __('Plan') }}</option>
                                    <option value="getway">{{ __('Getway') }}</option>
                                    <option value="trx">{{ __('Trx ID') }}</option>
                                </select>
                                <button class="btn btn-primary mb-0 btn-lg" type="submit"
                                    id="button-addon2">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 text-right">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="card-header pb-0">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="header-title">
                        <h4>{{ __('Order Report') }}</h4>
                    </div>
                    <div class="buttons">
                       
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead class="text-xs">
                            <tr>
                                
                                <th
                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-left">
                                    {{ __('Trx') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('User') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('Plan') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('Price') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('Getway') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ __('Order Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $order)
                         
                            <tr>
                               
                                <td class="text-left">
                                    <a href="{{ route('admin.order.show',$order->id) }}" class="text-xs font-weight-bold mb-0">{{ $order->trx }}</a>
                                </td>
                                <td>
                                    <a class="text-xs font-weight-bold mb-0" href="{{ route('admin.customer.show',$order->user_id) }}">{{ $order->user->name }}</a>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->plan->name }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->price }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->getway->name }}
                                    </p>
                                </td>
                                <td class="align-middle text-sm">
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Rejected'],
                                    1 => ['class' => 'primary', 'text' => 'Accepted'],
                                    3 => ['class' => 'danger', 'text' => 'Expired'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                    4 => ['class' => 'danger', 'text' => 'Trash'],
                                    ][$order->status];
                                    @endphp
                                    <div
                                        class="badge badge-{{ $status['class'] }}">{{ $status['text'] }}</div>
                                </td>
                                <td class="align-middle">
                                   {{ $order->created_at->format('d-F-Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
@endpush