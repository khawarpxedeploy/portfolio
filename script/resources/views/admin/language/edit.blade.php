@extends('layouts.backend.app')

@section('title','Edit Value')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Langauage'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">{{ __('Edit Langauage') }}</h6>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn bg-primary text-light mb-0"
                            href="{{ route('admin.language.index') }}">&nbsp;&nbsp;{{ __('Language Lists') }}</a>
                        <button type="button" class="btn text-light bg-info mb-0 text-xxs" data-toggle="modal"
                            data-target="#add_key">
                            <i class="fas fa-pencil-alt text-light mr-2"></i>{{ __('Add Key') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table_append">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        {{ __('Key') }}</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        {{ __('Value') }}</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        {{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($langs as $key=>$lang)
                                                <tr>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $key }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $lang }}</p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-block mb-3"
                                                            data-toggle="modal"
                                                            data-target="#lang_model_{{ Str::slug($lang)}}">
                                                            <i class="fas fa-pencil-alt text-light mr-2"></i>Edit
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Add New Key -->
<div class="modal fade" id="add_key" tabindex="-1" role="dialog" aria-labelledby="add_key" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Key') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.key_store') }}" method="POST" class="langform basicform">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $name }}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('Key') }}</label>
                        <input type="text" name="key" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">{{ __('Value') }}</label>
                        <input type="text" name="value" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn bg-primary">{{ __('Apply') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@foreach($langs as $key=>$lang)
<!-- Modal  For Edit-->
<div class="modal fade langmodel" id="lang_model_{{ Str::slug($lang)}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Value') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.language.update',$id) }}" method="POST" class="langform basicform">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="key" value="{{ $key }}">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">{{ __('Value') }}</label>
                        <textarea class="form-control text-lg" name="value">{{ $lang }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-language-edit.js') }}"></script>
@endpush