@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'SEO'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <form method="POST" action="{{ route('user.seo.update',$data->id) }}"
                        class="basicform_with_reload">
                        @method("PUT")
                        @csrf
                        @php $seo_info = json_decode($data->value)  @endphp
                        <div class="card-body">
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
                            @foreach ($seo_info ?? [] as $key => $seo)
                            <h5>{{ ucwords(basename(str_replace('_','/',$key))) }}</h5>
                            <div class="form-group row mb-4">
                                <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Site Name') }}
                                    <sup>*</sup></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="{{ $key }}[site_name]"
                                        value="{{$seo->site_name ?? ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Meta Tag Name') }}
                                    <sup>*</sup></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="{{ $key }}[metatag]"
                                        value="{{$seo->metatag ?? ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Twitter Site Title') }}
                                    <sup>*</sup></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="{{ $key }}[twitter_site_title]"
                                        value="{{$seo->twitter_site_title}}">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Meta Description') }}
                                    <sup>*</sup></label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="{{ $key }}[metadescription]" id="" cols="30" rows="10"
                                        class="form-control">{{ $seo->metadescription ?? null }}</textarea>
                                </div>
                            </div>
                            
                            
                            @if ($loop->iteration != count((array) $seo_info))
                                <hr>
                            @endif
                            @endforeach

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary basicbtn"
                                        type="submit">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
