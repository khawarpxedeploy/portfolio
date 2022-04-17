@extends('layouts.backend.app')

@section('title','Order View')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Invoice No '.$data->invoice_no,'prev'=>
route('admin.order.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group text-sm">
                            <li class="list-group-item active">{{ __('Order Basic Info') }}</li>
                            
                            <li class="list-group-item">{{ __('Order Created Date : ') }}
                                {{$data->created_at->format('Y-m-d')}}
                            </li>
                            <li class="list-group-item">{{ __('Order Will Be Expired : ') }}
                                {{$data->will_expire}}
                            </li>

                            <li class="list-group-item">{{ __('Invoice No : ') }}
                                {{ $data->invoice_no }}
                            </li>
                            <li class="list-group-item">{{ __('Order Price : ') }}
                                {{$data->price}}
                            </li>
                             <li class="list-group-item">{{ __('Tax: ') }}
                                {{$data->tax}}
                            </li>
                            <li class="list-group-item">{{ __('Plan Name : ') }}
                                {{$data->plan->name}}
                            </li>
                            <li class="list-group-item">{{ __('Payment Mode : ') }}
                                {{$data->getway->name}}
                            </li>
                            <li class="list-group-item">{{ __('Trx Id : ') }}
                                {{$data->trx}}
                            </li>
                            <li class="list-group-item">{{ __('Status : ') }}
                                @php
                                $status = [
                                0 => ['class' => 'danger', 'text' => 'Rejected'],
                                1 => ['class' => 'primary', 'text' => 'Accepted'],
                                3 => ['class' => 'danger', 'text' => 'Expired'],
                                2 => ['class' => 'warning', 'text' => 'Pending'],
                                4 => ['class' => 'danger', 'text' => 'Trash'],
                                ][$data->status];
                                @endphp
                                <span
                                    class="badge badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                            </li>
                            <li class="list-group-item">{{ __('Payment Status : ') }}
                                
                                 @php
                                $payment_status = [
                                0 => ['class' => 'danger', 'text' => 'Rejected'],
                                1 => ['class' => 'primary', 'text' => 'Accepted'],
                                3 => ['class' => 'danger', 'text' => 'Expired'],
                                2 => ['class' => 'warning', 'text' => 'Pending'],
                                4 => ['class' => 'danger', 'text' => 'Trash'],
                                ][$data->payment_status];
                                @endphp
                                <span
                                    class="badge badge-{{ $payment_status['class'] }}">{{ $payment_status['text'] }}</span>
                            </li>
                            @if(!empty($data->ordermeta))
                            <li class="list-group-item">
                                {{ __('Attachment') }}
                                <a href="{{ asset($data->ordermeta->value) }}" target="_blank">{{ __('View') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('User Information') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="text-xs font-weight-bolder">{{ __('User Name') }}</td>
                                <td class="text-xs font-weight-bolder"><b><a
                                            href="{{ route('admin.customer.show',$data->user->id) }}">{{$data->user->name}}</a></b>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-xs font-weight-bolder">{{ __('User Email') }}</td>
                                <td class="text-xs font-weight-bolder"><a
                                        href="mailto:{{$data->user->email}}"><b>{{$data->user->email}}</b></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection