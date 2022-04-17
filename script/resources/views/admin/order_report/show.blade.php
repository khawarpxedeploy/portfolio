@extends('layouts.backend.app')

@section('title','Order View')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Order Details','button_name'=>'Order Lists','button_link'=> route('admin.report.index')])
@endsection

@section('content')

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h6>{{ __('Order Details') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody class="text-sm">
                            <tr>
                                <td>{{ __('Payment Status') }}</td>
                                <td>@if($data->payment_status ==1)
                                    <span class="badge badge-sm bg-success text-light">{{ __('Done') }}</span>
                                    @else
                                    <span class="badge badge-sm bg-warning">{{ __('Pending') }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Order Created Date') }}</td>
                                <td><b>{{$data->created_at->format('d.m.Y')}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Order Created At') }}</td>
                                <td><b>{{$data->created_at->diffForHumans()}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Order Will Be Expired') }}</td>
                                <td><b>{{$data->will_expire}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Order Price') }}</td>
                                <td><b>{{$data->price}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Plan Name') }}</td>
                                <td><b>{{$data->plan->name}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Payment Mode') }}</td>
                                <td><b>{{$data->getway->name}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Trx Id') }}</td>
                                <td><b>{{$data->trx}}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('Status') }}</td>
                                <td>
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Rejected'],
                                    1 => ['class' => 'primary', 'text' => 'Accepted'],
                                    3 => ['class' => 'danger', 'text' => 'Expired'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                    4 => ['class' => 'danger', 'text' => 'Trash'],
                                    ][$data->status];
                                    @endphp
                                    <span class="badge badge-sm bg-gradient-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Download Invoice') }}</td>
                                <td><b> <a href="{{ url('admin/report-invoice',$data->id)}}" class="btn btn-icon btn-primary">{{ __('Download PDF') }}</a></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h6>{{ __('User Information') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody class="text-sm">
                            <tr>
                                <td>{{ __('User Name') }}</td>
                                <td><b><a href="{{ route('admin.customer.show',$data->id) }}">{{$data->user->name}}</a></b></td>
                            </tr>
                            <tr>
                                <td>{{ __('User Email') }}</td>
                                <td><a href="mailto:{{$data->user->email}}"><b>{{$data->user->email}}</b></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
