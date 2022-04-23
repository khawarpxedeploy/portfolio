@extends('layouts.backend.app')
@section('title','Cron Jobs')
@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Cron Jobs'])
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Make Expired Membership') }} <code>{{ __('Once/day') }}</code>
                </h6>
            </div>
            <div class="card-body">
                <div class="code">
                    <p>curl -s {{ route('alert.after.order.expired') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i>{{__(' Membership Will Expiration Alert')}}
                    <code>{{ __('Once/day') }}</code></h6>
            </div>
            <div class="card-body">
                <div class="code">
                     <p>curl -s {{ route('alert.before.order.expired') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Send Mail with Queue') }}</h6>
            </div>
            <div class="card-body">
                <span>{{ __('Note:') }} <span
                        class="text-danger">{{ __('You Need Add This Command In Your Supervisor And Also Make QUEUE_MAIL On From System Settings To Mail Configuration.') }}</span></span><br />
                <span>{{ __('Command Path:') }} <span
                        class="text-danger">{{ base_path() }}</span></span>
                <div class="code">
                    <p>{{ __('php artisan queue:work') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Customize Cron Jobs') }}</h4>
            </div>
            <form class="basicform" method="post" accept="{{ route('admin.cron.store') }}">
                <div class="card-body">
                    <div class="row">
                       

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Make Alert To Customer The Subscription Will Ending Soon') }}</label><br />
                                <span>
                                    {{ __('Note:') }} <span
                                        class="text-danger"><small>{{ __('It Will Send Notification Everyday Within The Selected Days') }}</small></span>
                                </span>
                                <select class="form-control" name="days">
                                    <option value="7"  @if($cron_option->days == '7' || $cron_option->days == 7) @endif selected="">{{ __('7 Days') }}</option>
                                    <option value="6" @if($cron_option->days == '6' || $cron_option->days == 6) @endif >{{ __('6 Days') }}</option>
                                    <option value="5" @if($cron_option->days == '5' || $cron_option->days == 5) @endif >{{ __('5 Days') }}</option>
                                    <option value="4" @if($cron_option->days == '4' || $cron_option->days == 4) @endif >{{ __('4 Days') }}</option>
                                    <option value="3" @if($cron_option->days == '3' || $cron_option->days == 3) @endif >{{ __('3 Days') }}</option>
                                    <option value="2" @if($cron_option->days == '2' || $cron_option->days == 2) @endif >{{ __('2 Days') }}</option>
                                    <option value="1" @if($cron_option->days == '1' || $cron_option->days == 1) @endif >{{ __('1 Days') }}</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Auto Approve To Plan After Successfull Payment') }}</label>

                                <select class="form-control mt-4" name="auto_enroll_after_payment">
                                    <option value="yes" @if($auto_enroll_after_payment->value == 'yes') selected @endif>{{ __('Yes') }}</option>
                                    <option value="no" @if($auto_enroll_after_payment->value == 'no') selected @endif>{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Alert Message Before Expire Subscription') }}</label>

                                <textarea class="form-control" name="alert_message">{{ $cron->alert_message ?? '' }}</textarea>
                                <small>Html supported</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('After Subscription Expire Message') }}</label>

                                <textarea class="form-control" name="expire_message">{{ $cron->expire_message ?? '' }}</textarea>
                                 <small>Html supported</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Trial Expire Message') }}</label>

                                <textarea class="form-control" name="trial_expired_message">{{ $cron->trial_expired_message ?? '' }}</textarea>
                                 <small>Html supported</small>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection