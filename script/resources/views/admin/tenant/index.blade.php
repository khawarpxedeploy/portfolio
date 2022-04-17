@extends('layouts.backend.app')

@section('title','Manage Profiles')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Profiles'])
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
                        <a class="nav-link {{ $st == "" ? "active" : "" }}" href="{{ url('/admin/tenant') }}">{{ __('All') }} <span class="badge badge-white">{{$all}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == 1 ? "active" : "" }}" href="{{ url('/admin/tenant?1') }}">{{ __('Active') }} <span class="badge badge-primary">{{ $active }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "2" ? "active" : "" }}" href="{{ url('/admin/tenant?2') }}">{{ __('Pending') }} <span class="badge badge-primary">{{ $pending }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $st == "0" ? "active" : "" }}" href="{{ url('/admin/tenant?0') }}">{{ __('Inactive') }} <span class="badge badge-primary">{{ $inactive }}</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="row mt-4">
                    <div class="col-md-3">
                        <form id="status_form" action="{{ route('admin.tenant.status') }}" method="post">
                            @csrf
                            <div id="ids"></div>
                            <div class="input-group mb-3">
                                <select class="form-control selectric" id="status" name="status" aria-describedby="button-addon2">
                                    <option value="">{{ __('Select Action') }}</option>
                                    <option value="1">{{ __('Move To Active') }}</option>
                                    <option value="0">{{ __('Move To Inactive') }}</option>
                                    <option value="2">{{ __('Move To Pending') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-5">
                        <form action="{{ route('admin.tenant.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search " aria-label="Search "
                                    aria-describedby="button-addon2" name="q" value="{{ $request->q ?? '' }}">
                                <select class="form-control selectric" id="type" name="type" aria-describedby="button-addon2">
                                    <option value="" selected disabled>{{ __('Select Option') }}</option>
                                    <option value="user">{{ __('User') }}</option>
                                    <option value="tenant">{{ __('Profile Id') }}</option>
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
                                <th width="10%">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                        <label class="custom-control-label checkAll" for="selectAll"></label>
                                    </div>
                                </th>
                                
                                <th>{{ __('Profile Id') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Expire Date') }}</th>    
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants ?? [] as $tenant)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" value="{{ $tenant->id }}" name="ids[]"
                                            class="custom-control-input" id="customCheck{{ $tenant->id }}"
                                            value="{{ $tenant->id }}">
                                        <label class="custom-control-label" for="customCheck{{ $tenant->id }}"></label>
                                    </div>
                                </td>
                               
                                 <td><a href="{{ url(env('APP_URL_WITH_TENANT').$tenant->id) }}">{{ $tenant->id }}</a></td>
                                <td>
                                    <a href="{{ route('admin.customer.show',$tenant->user_id) }}">{{ $tenant->user->name }}</a>
                                </td>
                                <td>{{ $tenant->orderwithplan->plan->name ?? '' }}</td>
                                <td>{{ $tenant->will_expire }}</td>
                                <td class="align-middle text-center text-sm">
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Inactive'],
                                    1 => ['class' => 'primary', 'text' => 'Active'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                    ][$tenant->status];
                                    @endphp
                                    <span class="badge badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                                <td>{{ $tenant->created_at->diffForHumans() }}</td>
                                <td>
                                     <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.tenant.show', $tenant->id) }}"><i class="fas fa-user-edit"></i>{{ __('Edit Profile') }}</a> 
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.tenant.edit',$tenant->id) }}"><i
                                                class="fa fa-edit"></i>{{ __('Edit Plan Data') }}</a>
                                               
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.tenant.config', $tenant->id) }}"><i class="fas fa-globe"></i>{{ __('Config Domain') }}</a>
                                    </div>   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $tenants->links('vendor.pagination.bootstrap-4') }}
                    </div>
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