@extends('cv.theme3.layouts.app')

@section('content')
<!-- main area start -->
<div class="main-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="melement-to-printain-page-area" id="element-to-print">
                    <div class="row layout" style="background:{{ $data->mode == 'dark' ? '#434343' : "#ffffff" }}">
                        <div class="col-lg-8 left-main-section">
                            <div class="left-section">
                                <div class="user-top-section">
                                    <div class="postition-area">
                                        <h5>{{ $data->role ?? '' }}</h5>
                                    </div>
                                    <div class="user-info">
                                        <h2>{{ __("Hello I'm") }} <br> {{ $data->name }}</h2>
                                        <p>{{ $data->about ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="expreience-area">
                                    <div class="expreience-header-title">
                                        <h2>{{ cvtitle('Experience') }}</h2>
                                    </div>
                                    <div class="expreience-card-body">
                                            @foreach ($data->experience ?? [] as $key => $item)
                                        <div class="single-expreience-area">
                                            <div class="expreience-postion">
                                                <h6>{{ $item->company ?? '' }}</i></h6>
                                                <h2>{{ $item->role ?? '' }} <small>({{ $item->duration ?? '' }})</small></h2>
                                                <p>{!! $item->description ?? '' !!}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="expreience-area">
                                    <div class="expreience-header-title">
                                        <h2>{{ cvtitle('References') }}</h2>
                                    </div>
                                    <div class="expreience-card-body">
                                            @foreach ($data->reference ?? [] as $key => $item)
                                        <div class="single-expreience-area">
                                            <div class="expreience-postion">
                                                <h2>{{ $item->name }}</i></h6>
                                                <p>{{ $item->role }}</p>
                                                <p>Phone: </strong>{{ $item->phone ?? ''}}</p>
                                                <p>Email: </strong>{{ $item->email ?? '' }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 sidebar"  style="background:{{ $data->mode == 'dark' ? '#434343' : '' }};">
                            <div class="contact-card">
                                <div class="postition-area">
                                    <h5>{{ cvtitle('Contact') }}</h5>
                                </div>
                                <div class="contact-card-body">
                                    
                                    @foreach ($data->contact ?? [] as $key => $item)
                                    <p><strong>
                                        {{ ucwords($item->key) ?? '' }}</strong>
                                    </p>
                                    <p>{{ $item->value ?? '' }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="postition-area">
                                    <h5>{{ cvtitle('Education') }}</h5>
                                </div>
                                <div class="contact-card-body">
                                    @foreach ($data->education ?? [] as $item)
                                    <div class="single-education">
                                        <span>{{ $item->duration }}</span>
                                        <div class="education-name">
                                            <h6><i>{{ $item->degree }}</i></h6>
                                        </div>
                                        <div class="university-name">
                                            <span>{{ $item->institute }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="postition-area">
                                    <h5>{{ cvtitle('Skills') }}</h5>
                                </div>
                                <div class="contact-card-body">
                                    <div class="skills-nav">
                                        <ul>
                                            @foreach ($data->skill ?? [] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="postition-area">
                                    <h5>{{ cvtitle('Accomplishments') }}</h5>
                                </div>
                                <div class="contact-card-body">
                                    @foreach ($data->accomplishment ?? [] as $key => $item)
                                    <div class="single-certification-name">
                                        <div class="certificate-name">
                                            <h6>{{ $item->description ?? '' }}</h6>
                                            <p><i>{{ $item->duration ?? '' }}</i></p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="postition-area">
                                    <h5>{{ cvtitle('language') }}</h5>
                                </div>
                                <div class="contact-card-body">
                                    <div class="language-area">
                                        <h6>
                                            {{ $data->language ?? "" }}
                                        </h6>
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
<!-- main area end -->
@endsection
