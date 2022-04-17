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
                        <h2>{{ __('All Blogs') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- breadgrump area end --}}

{{-- main area start --}}
<section>
    <div class="main-area pt-150 pb-150 blog-list">
        <div class="container">
            <div class="row">
                @foreach($posts as $row)
                <div class="col-lg-4">
                    <div class="single-news">
                        <div class="news-img">
                            <a href="{{ url('/blog',$row->slug) }}"><img class="img-fluid" src="{{ asset($row->thum_image->value ?? '')}}" alt="{{ $row->title }}"></a>
                        </div>
                        <div class="news-content">
                            <div class="news-date">
                                <span><span class="iconify" data-icon="fontisto:date" data-inline="false"></span> {{ $row->created_at->format('d F, Y') }}</span>
                            </div>
                            <div class="news-title">
                                <a href="{{ url('/blog',$row->slug) }}"><h4>{{ $row->title }}</h4></a>
                            </div>
                            <div class="news-des">
                                <p>{{ $row->excerpt->value ?? '' }}</p>
                            </div>
                            <div class="news-action">
                                <a href="{{ url('/blog',$row->slug) }}">{{ __('Read More') }} <span class="iconify" data-icon="bytesize:arrow-right" data-inline="false"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</section>
{{-- main area end --}}
@endsection