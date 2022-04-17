@extends('layouts.backend.app')

@section('title', 'Plan View')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Plan View'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2">
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Details') }}</th>
                            </tr>
                            <tr>
                                <td>{{ __('Plan') }}</td>
                                <td>{{ $order->plan->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Geteway') }}</td>
                                <td>{{ $order->getway->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Amount') }}</td>
                                <td>{{ $order->price }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Transaction ID') }}</td>
                                <td>{{ $order->trx }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Status') }}</td>
                                @php
                                    $status = [
                                        0 => ['class' => 'badge-danger', 'text' => 'Rejected'],
                                        1 => ['class' => 'badge-primary', 'text' => 'Accepted'],
                                        2 => ['class' => 'badge-danger', 'text' => 'Pending'],
                                        3 => ['class' => 'badge-warning', 'text' => 'Expired'],
                                    ][$order->status];
                                @endphp
                                <td>
                                    <span class="badge badge-sm {{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Payment Status') }}</td>
                                @php
                                    $pstatus = [
                                        0 => ['class' => 'badge-danger', 'text' => 'Rejected'],
                                        1 => ['class' => 'badge-primary', 'text' => 'Accepted'],
                                        2 => ['class' => 'badge-warning', 'text' => 'Pending'],
                                    ][$order->payment_status];
                                @endphp
                                <td>
                                    <span class="badge badge-sm {{ $pstatus['class'] }}">{{ $pstatus['text'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Created At') }}</td>
                                <td>{{ $order->created_at->isoFormat('LL') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Expire At') }}</td>
                                <td class="text-danger">
                                    <strong>{{ \Carbon\Carbon::parse($order->exp_date)->isoFormat('LL') }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
