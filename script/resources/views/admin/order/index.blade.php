@extends('layouts.backend.app')

@section('title','Manage Order')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Order','button_name'=> 'Add New','button_link'=>
route('admin.order.create')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "" ? 'active' : '' }}" href="{{ url('/admin/order') }}"> {{ __('All') }} <span class="badge badge-white"> {{$all}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "1" ? 'active' : '' }}" href="{{ url('/admin/order?1') }}">  {{ __('Active') }} <span class="badge badge-primary">{{$active}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "2" ? 'active' : '' }}" href="{{ url('/admin/order?2') }}">{{ __('Pending') }} <span class="badge badge-primary">{{$pending}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "0" ? 'active' : '' }}" href="{{ url('/admin/order?0') }}">{{ __('Inactive') }} <span class="badge badge-primary">{{$inactive}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "3" ? 'active' : '' }}" href="{{ url('/admin/order?3') }}">{{ __('Expired') }} <span class="badge badge-primary">{{$expired}}</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('Manage Order') }}</h4>
              </div>
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <form id="status_form" action="{{ route('admin.order.status') }}" method="post">
                            @csrf
                            <div id="ids"></div>
                            <div class="input-group mb-3">
                                <select class="form-control selectric" id="status" name="status" aria-describedby="button-addon2">
                                    <option value="">{{ __('Select Action') }}</option>
                                    <option value="2">{{ __('Move To Pending') }}</option>
                                    <option value="1">{{ __('Move To Active') }}</option>
                                    <option value="3">{{ __('Move To Expired') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form action="{{ url('/admin/order') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search " aria-label="Search "
                                    aria-describedby="button-addon2" name="q" value="{{ $request->q ?? '' }}">
                                <select class="form-control selectric" id="type_src" name="type" aria-describedby="button-addon2">
                                    <option value="" selected disabled>{{ __('Select Option') }}</option>
                                    <option value="user">{{ __('User') }}</option>
                                    <option value="plan">{{ __('Plan') }}</option>
                                    <option value="getway">{{ __('Getway') }}</option>
                                    <option value="invoice_no">{{ __('Order Id') }}</option>
                                </select>
                                <button class="btn btn-primary mb-0 btn-lg text-xs" type="submit"
                                    id="button-addon2">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table-2">
                        <thead>
                            <tr>
                                <th >
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                        <label class="custom-control-label checkAll" for="selectAll"></label>
                                    </div>
                                </th>
                                <th>{{ __('Order No') }}
                                </th>
                                <th>
                                    {{ __('User') }}</th>
                                <th>
                                    {{ __('Plan') }}</th>
                                <th>
                                    {{ __('Price') }}</th>
                                 <th>
                                    {{ __('Tax') }}</th>    
                                <th>
                                    {{ __('Getway') }}</th>
                                <th>
                                    {{ __('Status') }}</th>
                                <th>
                                    {{ __('Payment Status') }}</th>    
                                <th>
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders ?? [] as $order)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" value="{{ $order->id }}" name="ids[]"
                                            class="custom-control-input" id="customCheck{{ $order->id }}"
                                            value="{{ $order->id }}">
                                        <label class="custom-control-label" for="customCheck{{ $order->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $order->invoice_no }}</td>
                                <td><a href="{{ route('admin.customer.show',$order->user_id) }}">{{ $order->user->name }}</a></td>
                                <td><a
                                        href="{{ url('admin/order/plan-name',$order->plan->id)}}">{{ $order->plan->name }}</a>
                                </td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->getway->name }}</td>
                                <td>
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Rejected'],
                                    1 => ['class' => 'primary', 'text' => 'Accepted'],
                                    3 => ['class' => 'danger', 'text' => 'Expired'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                    4 => ['class' => 'danger', 'text' => 'Trash'],
                                    ][$order->status];
                                    @endphp
                                    <span class="badge badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                                <td>
                                     @php
                                    $payment_status = [
                                    0 => ['class' => 'danger', 'text' => 'Rejected'],
                                    1 => ['class' => 'primary', 'text' => 'Accepted'],
                                    3 => ['class' => 'danger', 'text' => 'Expired'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                  
                                    ][$order->payment_status];
                                    @endphp
                                    <span class="badge badge-{{ $payment_status['class'] }}">{{ $payment_status['text'] }}</span>
                                    </td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.order.edit',$order->id) }}"><i
                                                class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.order.show',$order->id) }}"><i
                                                class="fas fa-eye"></i>{{ __('View') }}</a>
                                        <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                            data-id={{ $order->id }}><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                        <!-- Delete Form -->
                                        <form class="d-none" id="delete_form_{{ $order->id }}"
                                            action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="type" value="{{ $request->type ?? '' }}">
@endsection

@push('js')
    <script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/admin-plan.create.js') }}"></script>
    <script>
        "use strict";
        var type =$('#type').val();

        if (type != '') {
        $('#type_src').val(type);
        }
    </script>
@endpush