@extends('layouts.main.app')

@section('content')

@include('layouts.main.partials.header')
{{-- breadgrump area start --}}
<section>
    <div class="breadgreamup-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="breadgrump-content text-center">
                        <h3>{{ $info->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- breadgrump area end --}}

{{-- main area start --}}
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="blog-details">
                        <div class="blog-des">
                           {{ content($info->description->value ?? '') }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- main area end --}}
@endsection