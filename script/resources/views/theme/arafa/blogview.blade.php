@extends('theme.arafa.layouts.app')

@section('content')
{{-- blog details area start --}}
<section>
    <div class="main-area">
        <div class="container-fluid pl-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- sidebar area start -->
                    @include('theme.arafa.layouts.sidebar2')
                    <!-- sidebar area end -->
                </div>
                <div class="col-lg-9 p-5">
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
                            <span>{{ $info->created_at->format('d F, Y') }}</span>
                        </div>
                        <div class="blog-title">
                            <h4>{{ $info->title }}</h4>
                        </div>
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset($info->thum_image->value ?? '') }}" alt="">
                        </div>
                        <div class="blog-des">
                           {{ content($info->description->value ?? '') }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- blog details area end --}} 
@endsection