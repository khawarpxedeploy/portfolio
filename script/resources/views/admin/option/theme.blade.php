@extends('layouts.backend.app')

@section('title','Theme Settings')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Theme Settings'])
@endsection

@section('content')
<div class="col-12">
    <div class="card mb-4">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.theme-settings.update') }}"
                    enctype="multipart/form-data" class="basicform_with_reload">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        @if (Session::has('message'))
                        <div class="alert alert-danger">
                        </div>
                        @endif
                        <div class="card-header">
                            <h4>{{ __('Tamplate Settings') }}</h4>
                        </div>
                        <div class="card-body">
                            @php $theme = json_decode($theme->value ?? '') @endphp
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>{{ __('Whoops!') }}</strong>
                                {{ __('There were some problems with your input.') }}<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Logo (png type file)') }}</label>
                                        <input type="file" class="form-control" name="logo" id="">
                                       
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Favicon (ico type file)') }}</label>
                                        <input type="file" class="form-control" name="favicon" id="">
                                        
                                    </div>
                                </div>
                                 <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Header Image (png type file)') }}</label>
                                        <input type="file" class="form-control" accept="image/.png" name="header_image" id="">
                                      
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('Theme Base Color') }}</label>
                                        <input type="color" name="theme_color"
                                            value="{{ $basic_settings->theme_color ?? '' }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{  $basic_settings->email ?? '' }}">
                                    </div>
                                </div>
                               
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Address') }}</label>
                                        <textarea name="address"
                                            class="form-control">{{ $basic_settings->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('Custom Js') }}</label>
                                        <textarea name="js"
                                            class="form-control">{{ $js ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('Custom Css') }}</label>
                                        <textarea name="css"
                                            class="form-control">{{ $css ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>{{ __('Footer Social Links') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group field_wrapper">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">{{ __('Iconify Icon') }}</label> <br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">{{ __('Link') }}</label><br>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:"
                                                    class="add_button text-xxs mr-2 btn btn-primary mb-0 btn-sm  text-xxs ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        @foreach ($basic_settings->social ?? [] as $key => $item)
                                        <div class="row">
                                            <div class="col-md-5"><br>
                                                <input type="text" value="{{ $item->icon }}" data-key="{{ $key }}"
                                                    class="form-control" name="social[{{ $key }}][icon]"
                                                    placeholder="icon here">
                                            </div>
                                            <div class="col-md-6"><br>
                                                <input type="text" value="{{ $item->link }}" class="form-control"
                                                    name="social[{{ $key }}][link]" class="" placeholder="link here">
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);"
                                                    class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-sm  text-xxs mt-4"
                                                    title="Remove"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-x-circle"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Frequently Asked Questions Section.') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group field_wrapper2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">{{ __('question "?"') }}</label> <br>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">{{ __('Answer') }}</label><br>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="javascript:"
                                            class="add_button2 text-xxs mr-2 btn btn-primary mb-0 btn-sm text-xxs ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($theme->asked ?? [] as $key => $item)
                                <div class="row">
                                    <div class="col-md-5"><br>
                                        <textarea required class="form-control" name="asked[{{ $key }}][question]"
                                            placeholder="Can I cancel my subscription?" cols="30"
                                            rows="4">{{ $item->question }}</textarea>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <textarea required class="form-control" name="asked[{{ $key }}][answer]"
                                            placeholder="Looked up one of the more obscure Latin words, consecttur, from a Lorem Ipsum passage, and going through the."
                                            cols="30" rows="4">{{ $item->answer }}</textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="javascript:void(0);"
                                            class="remove_button2 text-xxs mr-2 btn btn-danger mb-0 btn-sm  text-xxs mt-4"
                                            title="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div> 
                            <button type="submit" class="btn btn-primary text-center basicbtn btn-lg w-100">
                                {{ __('Submit') }}
                            </button>   
                        </div>    
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-theme-settings.js') }}"></script>
@endpush