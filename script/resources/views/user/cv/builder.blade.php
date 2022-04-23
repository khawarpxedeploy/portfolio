@extends('layouts.builder.app')

@section('content')
<!-- resume area start -->
<section>
    <div class="resume-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="resume-main-area mt-5 mb-150 p-0">
                        <form id="cvform" action="{{ route('user.cv.store') }}" method="POST"
                        class="basicform" enctype="multipart/form-data">
                        @csrf
                        <input type="color" class="ajaxinput" id="color-picker" value="">
                        <input type="hidden" class="ajaxinput" name="theme" id="theme" value="">
                        <input type="hidden" class="ajaxinput" name="color" id="color" value="">
                        <input type="hidden" class="ajaxinput" name="mode" id="mode" value="">
                        <input type="hidden" class="ajaxinput" name="cvlanguage" id="language" value="en">
                            <img src="{{ asset('backend/admin/assets/loader.gif') }}" class="loader">
                        
                        <div id="renderform" class="m-2">
                            {{-- Dynamic Form will be rendered here with ajax and js  --}}
                        </div>
                            <button type="submit" class="btn btn-danger btn-lg cv-savebtn px-5 py-3 basicbtn">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="cvstoreurl" value="{{ route('user.cv.ajaxstore') }}">
<input type="hidden" id="cvfetchurl" value="{{ route('user.cv.fetch') }}">
<input type="hidden" id="cvreseturl" value="{{ route('user.cv.reset') }}">
<input type="hidden" id="cvdownload" value="{{ url('user/cv/download') }}">
<input type="hidden" id="cvlanguageurl" value="{{ route('user.cv.language') }}">
<input type="hidden" id="cvformtheme" value="{{ route('user.cv.formtheme') }}">

@endsection

