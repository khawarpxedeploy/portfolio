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
                        <h2>{{ __('Blog Details') }}</h2>
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
                        <div class="blog-share-area">
                            <div class="share-icon">
                                <nav>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"><span class="iconify" data-icon="brandico:facebook" data-inline="false"></span></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text={{ url()->full() }}"><span class="iconify" data-icon="akar-icons:twitter-fill" data-inline="false"></span></a></li>
                                       
                                        <li><a href="http://pinterest.com/pin/create/link/?url={{ url()->full() }}"><span class="iconify" data-icon="bx:bxl-pinterest" data-inline="false"></span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="blog-date">
                            <span>{{ $info->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="blog-title">
                            <h4>{{ $info->title }}</h4>
                        </div>
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset($info->thum_image->value ?? '') }}" alt="">
                        </div>
                        <div class="blog-des">
                            <p>{{ content($info->description->value ?? '') }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- main area end --}}
@endsection