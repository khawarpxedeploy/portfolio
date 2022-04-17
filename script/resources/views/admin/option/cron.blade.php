@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit Page') }}</h4>
                </div>
                <form method="POST" action="{{ route('admin.option.update', $option->key) }}"
                      class="basicform_with_reload">
                    @csrf
                    @php
                        $option = json_decode($option->value)
                    @endphp
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="on" {{ $option->status == 'on' ? 'selected' : '' }}>ON</option>
                                        <option value="off" {{ $option->status == 'off' ? 'selected' : '' }}>OFF
                                        </option>
                                    </select>
                                    @error('status')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Days</label>
                                    <input class="form-control @error('days') is-invalid @enderror" name="days"
                                           type="text" value="{{ $option->days }}">
                                    @error('days')
                                    {{ $message }}
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Assign Default Plan</label>
                                    <select name="assign_default_plan" class="form-control">
                                        <option value="on" {{ $option->assign_default_plan == 'on' ? 'selected' : '' }}>
                                            ON
                                        </option>
                                        <option
                                            value="off" {{ $option->assign_default_plan == 'off' ? 'selected' : '' }}>
                                            OFF
                                        </option>
                                    </select>
                                    @error('assign_default_plan')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alert message</label>
                            <textarea class="form-control @error('alert_message') is-invalid @enderror"
                                      name="alert_message" cols="30" rows="10">{{ $option->alert_message }}</textarea>
                            @error('alert_message')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Expire message</label>
                            <textarea class="form-control @error('expire_message') is-invalid @enderror"
                                      name="expire_message" cols="30" rows="10">{{ $option->expire_message }}</textarea>
                            @error('expire_message')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-lg float-right w-100 basicbtn">Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

