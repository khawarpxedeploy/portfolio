@extends('layouts.backend.app')

@section('title', 'Select Payment Getway')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Select Payment Getway'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('alert'))
                <div class="alert {{ Session::get('type') }}">
                    {{ Session::get('alert') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card w-100">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" id="myTab3" role="tablist">
                        @foreach ($gateways as $gateway)
                        <li class="nav-item">
                            <a class="nav-link {{ $gateway->first()->id == $gateway->id ? 'active' : '' }}"
                                id="pills-home-tab" data-toggle="pill" data-target="#pills-{{ $gateway->id }}"
                                type="button" role="tab" aria-controls="pills-{{ $gateway->id }}" aria-selected="true">
                                <div class="card-body">
                                    <img class="payment-img" src="{{ asset($gateway->logo) }}"
                                        alt="{{ $gateway->name }}" width="100">
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        <div class="tab-content" id="myTabContent2">
                            @foreach ($gateways as $key => $gateway)
                            @php $data = json_decode($gateway->data) @endphp
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                id="pills-{{ $gateway->id }}" role="tabpanel"
                                aria-labelledby="pills-{{ $gateway->id }}">
                                <table class="table table-hover">
                                    <tr>
                                        <td><strong>{{ __('Amount') }}</strong></td>
                                        <td class="float-right">{{ number_format($plan->price,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Currency') }}</strong></td>
                                        <td class="float-right">
                                            {{ strtoupper($curency_name->value) }}</td>
                                    </tr>
                                    

                                    <tr>
                                        <td><strong>{{ __('Currency Rate') }}</strong></td>
                                        <td class="float-right">{{ number_format($gateway->rate,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Tax - In ').'('.strtoupper($curency_name->value).')' }}</strong></td>
                                        <td class="float-right">{{ number_format(($plan->price / 100) * $tax->value,2). " ($tax->value %)" }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Tax - In ').'('.strtoupper($gateway->currency_name).')' }}</strong></td>
                                        <td class="float-right">{{ number_format(($plan->price / 100) * $tax->value * $gateway->rate,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Transaction Fee') }}</strong></td>
                                        <td class="float-right">{{ number_format($gateway->charge,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Total Price Without Tax') }}
                                                ({{ $gateway->currency_name }})</strong></td>
                                        <td class="float-right">
                                            {{ number_format($gateway->rate * $plan->price+$gateway->charge,2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Total Payable Amount') }}
                                                ({{ $gateway->currency_name }})</strong>
                                        </td>
                                        <td class="float-right">
                                            {{ number_format((($plan->price + ($plan->price / 100) * $tax->value) * $gateway->rate)  + $gateway->charge,2) }}
                                        </td>
                                    </tr>
                                </table>
                                <form action="{{ route('user.plan.deposit') }}" method="post" class="paymentform"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        @if ($gateway->phone_required == 1)
                                        <table class="table">
                                            <tr>
                                                <td><label for="">{{ __('Phone') }}</label></td>
                                                <td>
                                                    <input type="text" class="form-control" name="phone" required
                                                        {{ Session::has('phone_error') ? 'is-invalid' : '' }}>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        @if($gateway->is_auto == 0)
                                        <table class="table">
                                            
                                            <tr>
                                                <td>
                                                    <strong>{{ __('Payment Instruction') }}</strong>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                   <strong>{{ $gateway->data }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        @if ($gateway->image_accept == 1)
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <label for="screenshot">{{ __('Upload Attachment') }}</label>
                                                    <input type="file" accept="image/*" name="attachment" class="form-control"
                                                        required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="comment">{{ __('Comments') }}</label>
                                                    <textarea class="form-control h-100" name="comment" maxlength="100" id="" cols="30" rows="10"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        <input type="hidden" name="id" value="{{ $gateway->id }}">
                                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                        <button type="submit"
                                            class="btn btn-primary paymentbtn btn-lg w-100">{{ __('Submit Payment') }}</button>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/user-payment_gateway.js') }}"></script>
@endpush