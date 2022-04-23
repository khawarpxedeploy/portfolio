@extends('layouts.backend.app')

@section('title','Dashboard')



@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats">
          <div class="card-stats-title">{{ __('Order Statistics') }} -
            <div class="dropdown d-inline">
              <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month" id="orders-month">{{ Date('F') }}</a>
              <ul class="dropdown-menu dropdown-menu-sm">
                <li class="dropdown-title">{{ __('Select Month') }}</li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='January') active @endif" data-month="January" >{{ __('January') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='February') active @endif" data-month="February" >{{ __('February') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='March') active @endif" data-month="March" >{{ __('March') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='April') active @endif" data-month="April" >{{ __('April') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='May') active @endif" data-month="May" >{{ __('May') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='June') active @endif" data-month="June" >{{ __('June') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='July') active @endif" data-month="July" >{{ __('July') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='August') active @endif" data-month="August" >{{ __('August') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='September') active @endif" data-month="September" >{{ __('September') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='October') active @endif" data-month="October" >{{ __('October') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='November') active @endif" data-month="November" >{{ __('November') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='December') active @endif" data-month="December" >{{ __('December') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="card-stats-items">
        <div class="card-stats-item">
          <div class="card-stats-item-count" id="pending_order"></div>
          <div class="card-stats-item-label">{{ __('Pending') }}</div>
      </div>

      <div class="card-stats-item">
          <div class="card-stats-item-count" id="completed_order"></div>
          <div class="card-stats-item-label">{{ __('Completed') }}</div>
      </div>

      <div class="card-stats-item">
          <div class="card-stats-item-count" id="shipping_order"></div>
          <div class="card-stats-item-label">{{ __('Expired') }}</div>
      </div>
  </div>
</div>
<div class="card-icon shadow-primary bg-primary">
  <i class="fas fa-archive"></i>
</div>
<div class="card-wrap">
  <div class="card-header">
    <h4>{{ __('Total Orders') }}</h4>
</div>
<div class="card-body" id="total_order">

</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12">
  <div class="card card-statistic-2">
    <div class="card-chart">
      <canvas id="sales_of_earnings_chart" height="80"></canvas>
  </div>
  <div class="card-icon shadow-primary bg-primary">
      <i class="fas fa-dollar-sign"></i>
  </div>
  <div class="card-wrap">
      <div class="card-header">
        <h4>Total Sales Of Earnings - {{ date('Y') }}</h4>
    </div>
    <div class="card-body" id="sales_of_earnings">
        <img height="40" src="{{ asset('backend/admin/assets/loader.gif') }}">
    </div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12">
  <div class="card card-statistic-2">
    <div class="card-chart">
      <canvas id="total_sales_chart" height="80"></canvas>
  </div>
  <div class="card-icon shadow-primary bg-primary">
      <i class="fas fa-shopping-bag"></i>
  </div>
  <div class="card-wrap">
      <div class="card-header">
        <h4>Total Sales - {{ date('Y') }}</h4>
    </div>
    <div class="card-body" id="total_sales">
        <img height="40" src="{{ asset('backend/admin/assets/loader.gif') }}" class="loads">
    </div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Subscribers') }}</h4>
        </div>
        <div class="card-body" id="total_subscribers">
            <img height="40" src="{{ asset('backend/admin/assets/loader.gif') }}">
        </div>
    </div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon bg-danger">
      <i class="far fa-newspaper"></i>
  </div>
  <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Domain Request') }}</h4>
    </div>
    <div class="card-body" id="total_domain_requests">
        <img height="40" src="{{ asset('backend/admin/assets/loader.gif') }}">
    </div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon bg-warning">
      <i class="far fa-file"></i>
  </div>
  <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Total Earnings') }}</h4>
    </div>
    <div class="card-body" id="total_earnings">
        <img height="40" src="{{ asset('backend/admin/assets/loader.gif') }}">
    </div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon bg-success">
      <i class="fas fa-circle"></i>
  </div>
  <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Expired Subscriptions') }}</h4>
    </div>
    <div class="card-body" id="total_expired_subscriptions">
        <img  height="40" src="{{ asset('backend/admin/assets/loader.gif') }}">
    </div>
</div>
</div>
</div>
</div>

<div class="row my-4">
  <div class="col-lg-8 col-md-12 col-12 col-sm-12">
   <div class="card">
      <div class="card-header">

        <h4 class="card-header-title">{{ __('Earnings performance') }} <img src="{{ asset('backend/admin/assets/loader.gif') }}" height="40" id="earning_performance"></h4>
        <div class="card-header-action">
          <select class="form-control" id="perfomace">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="15">{{ __('Last 15 Days') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
            <option value="365">{{ __('Last 365 Days') }}</option>
        </select>
    </div>
</div>
<div class="card-body">
    <canvas id="myChart" height="150"></canvas> 
</div>
</div>
</div>
<div class="col-lg-4">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6><a href="{{ route('admin.order.index') }}">{{ __('Latest Orders') }}</a></h6>
        </div>
        <div class="card-body">             
            <ul class="list-unstyled list-unstyled-border">
             @foreach ($orders ?? [] as $order)
             <li class="media d-flex justify-content-center align-items-center">
                <h6 class="text-dark text-sm font-weight-bold mb-0">
                    
                   <img height="40" src="{{ asset(!empty($order->user->image) ? $order->user->image : 'https://ui-avatars.com/api/?name='.$order->user->name  ) }}" alt="{{ $order->user->name }}">
                   
                    <a href="{{ route('admin.order.show', $order->id) }}">{{ $order->invoice_no }}</a> <br>
                    {{ $order->plan->name }}</h6>
                    <div class="media-body">
                      <div class="float-right"><p class="text-dark font-weight-bold text-xs mt-1 mb-0">
                        {{ $order->created_at->diffForHumans() }}</p></div>
                    </div>
                </li>
                @endforeach
            </ul>

        </div>

    </div>
</div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Site Analytics</h4>
        <div class="card-header-action">
          <select class="form-control" id="days"> 
            <option value="7">Last 7 Days</option>
            <option value="15">Last 15 Days</option>
            <option value="30">Last 30 Days</option>
            <option value="180">Last 180 Days</option>
            <option value="365">Last 365 Days</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <canvas id="google_analytics" height="120"></canvas>
        <div class="statistic-details mt-sm-4">
          <div class="statistic-details-item">

            <div class="detail-value" id="total_visitors"></div>
            <div class="detail-name">Total Vistors</div>
          </div>
          <div class="statistic-details-item">

            <div class="detail-value" id="total_page_views"></div>
            <div class="detail-name">Total Page Views</div>
          </div>

          <div class="statistic-details-item">

            <div class="detail-value" id="new_vistors"></div>
            <div class="detail-name">New Visitor</div>
          </div>

          <div class="statistic-details-item">

            <div class="detail-value" id="returning_visitor"></div>
            <div class="detail-name">Returning Visitor</div>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4>Referral URL</h4>
          </div>
          <div class="card-body refs" id="refs" >



          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Top Browser</h4>
          </div>
          <div class="card-body">
            <div class="row" id="browsers"></div>
          </div>
        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ __('Top Most Visit Pages') }}</h4>
          </div>
          <div class="card-body tmvp" id="table-body">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="site_url" value="{{ url('/') }}">
<input type="hidden" id="dashboard_static" value="{{ url('/admin/dashboard/static') }}">
<input type="hidden" id="dashboard_perfomance" value="{{ url('/admin/dashboard/perfomance') }}">
<input type="hidden" id="dashboard_order_statics" value="{{ url('/admin/dashboard/order_statics') }}">
<input type="hidden" id="gif_url" value="{{ asset('backend/admin/assets/loader.gif') }}">
<input type="hidden" id="month" value="{{ date('F') }}">

@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/chart.js') }}"></script>
<script src="{{ asset('main/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/admin-dashboard.js') }}"></script>
@endpush