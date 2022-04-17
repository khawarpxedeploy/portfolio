@extends('layouts.backend.app')

@section('title','Customers')

@section('head')
@include('layouts.backend.partials.headersection',['button_name'=>'Create Customer','button_link'=>route('admin.customer.create'),'title'=>'All Customers'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "" ? 'active' : '' }}" href="{{ url('/admin/customer') }}"> {{ __('All') }} <span class="badge badge-white"> {{$all}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "1" ? 'active' : '' }}" href="{{ url('/admin/customer?1') }}">  {{ __('Active') }} <span class="badge badge-success">{{$active}}</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "3" ? 'active' : '' }}" href="{{ url('/admin/customer?0') }}">{{ __('Disabled') }} <span class="badge badge-danger">{{$inactive}}</span></a>
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
                <h4>{{ __('Manage Customers') }}</h4>
              </div>
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <form id="status_form" action="{{ route('admin.customer.status') }}" method="post">
                            @csrf
                            <div id="ids"></div>
                            <div class="input-group mb-3">
                                <select class="form-control selectric" id="status" name="status" aria-describedby="button-addon2">
                                    <option value="">{{ __('Select Action') }}</option>
                                    <option value="1">{{ __('Move To Active') }}</option>
                                    <option value="0">{{ __('Move To Inactive') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form method="get">
                            <div class="input-group mb-3">
                               <input type="text" class="form-control" placeholder="Search " aria-label="Search "
                                    aria-describedby="button-addon2" name="q">
                                <select class="form-control" name="type" aria-describedby="button-addon2">
                                   
                                    <option value="email">{{ __('Email') }}</option>
                                    <option value="name">{{ __('Name') }}</option>
                                    <option value="tenant">{{ __('Username') }}</option>
                                </select>

                                <button class="btn btn-primary mb-0 " type="submit"
                                    id="button-addon2">
                                    <i class="fas fa-search"></i>
                                    {{__('Search')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                   <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase  text-xxs font-weight-bolder opacity-7"
                                    width="10%">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                        <label class="custom-control-label checkAll" for="selectAll"></label>
                                    </div>
                                </th>
                               
                                <th class="text-uppercase  ">
                                    {{ __('Name') }}</th>
                                <th class="text-uppercase  ">
                                    {{ __('Email') }}</th>
                                <th class="text-uppercase  ">
                                    {{ __('Username') }}</th>
                                <th class="text-uppercase  ">
                                    {{ __('Orders') }}</th>
                                <th class="text-uppercase  ">
                                    {{ __('Order Amount') }}</th>     
                                <th class="text-uppercase  ">
                                    {{ __('Status') }}</th>
                                <th>{{ __('Registered At') }}</th>    
                                <th class="text-uppercase  ">
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users ?? [] as $user)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" value="{{ $user->id }}" name="ids[]"
                                            class="custom-control-input" id="customCheck{{ $user->id }}"
                                            value="{{ $user->id }}">
                                        <label class="custom-control-label" for="customCheck{{ $user->id }}"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <p>{{ $user->name }}</p>
                                </td>
                                <td>
                                    <p>{{ $user->email }}
                                    </p>
                                </td>
                                <td>
                                    <a href="{{ url(env('APP_URL_WITH_TENANT').$user->tenant->id ?? '') }}">{{ $user->tenant->id ?? '' }}</a>
                                   
                                </td>
                                <td>{{ $user->orders_count }}</td>
                                <td>{{ number_format($user->orders_sum_price,2) }}</td>
                                <td class="align-middle text-center text-sm">
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Inactive'],
                                    1 => ['class' => 'success', 'text' => 'Active'],
                                    ][$user->status];
                                    @endphp
                                    <span
                                        class="badge badge-sm badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.customer.edit',$user->id) }}"><i
                                                class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.customer.show',$user->id) }}"><i
                                                class="fa fa-eye"></i>{{ __('View') }}</a>
                                         <a class="dropdown-item has-icon"
                                            href="{{ route('admin.customer.login',$user->id) }}"><i
                                                class="fa fa-key"></i>{{ __('Login') }}</a>        

                                        <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                            data-id={{ $user->id }}><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                        
                                        <form class="d-none" id="delete_form_{{ $user->id }}"
                                        action="{{ route('admin.customer.destroy',$user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush