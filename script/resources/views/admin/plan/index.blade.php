@extends('layouts.backend.app')

@section('title','Manage Plan')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Plan','button_name'=> 'Add New','button_link'=>route('admin.plan.create')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="col-sm-8">
                    <a href="{{ url('/admin/plan?all') }}"
                        class="mr-2 btn btn-outline-primary  {{ $status ==  "all" ? 'active' : '' }} ">{{ __('All') }}
                        ({{$all}})</a>

                    <a href="{{ url('/admin/plan?active') }}"
                        class="mr-2 btn btn-outline-primary  {{ $status ==  "active" ? 'active' : '' }} ">{{ __('Active') }}
                        ({{$active}})</a>

                    <a href="{{ url('/admin/plan?inactive') }}"
                        class="mr-2 btn btn-outline-primary  {{ $status ==  "inactive" ? 'active' : '' }} ">{{ __('Inactive') }}
                        ({{$inactive}})</a>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table" id="table-2">
                        <thead>
                            <tr>
                                <th>{{ __('SL.') }}</th>
                                <th>{{ __('Plan Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Total Order') }}</th>
                                <th>{{ __('Total Earn') }}</th>
                                <th>{{ __('Active Orders') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Is Trial') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $i = ($data->currentpage()-1)* $data->perpage() + 1
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->orders_count}}</td>
                                <td>{{ $item->orders_sum_price }}</td>
                                <td>{{ $item->activeorders_count }}</td>
                                <td>@if($item->status ==1)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>@if($item->is_trial ==1)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>

                               
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ url('admin/order/plan-name',$item->id) }}"><i
                                                class="fa fa-eye"></i>{{ __('Report') }}</a>
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.plan.edit',$item->id) }}"><i
                                                class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                        @if($item->is_trial == 0)  
                                        @if($item->activeorders_count == 0)      
                                        <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                            data-id={{ $item->id }}><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                        @endif    
                                        @endif    
                                        <!-- Delete Form -->
                                        <form class="d-none" id="delete_form_{{ $item->id }}"
                                            action="{{ route('admin.plan.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
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