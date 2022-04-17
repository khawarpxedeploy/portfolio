@extends('layouts.backend.app')

@section('title','Site Settings')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Site Settings'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('Site Settings') }}</h4>
            </div>
            <div class="card-body">
             <form method="POST" action="{{ route('user.site.settings.update') }}" enctype="multipart/form-data"
             class="basicform">
             @csrf
            
             @php $value = json_decode($user->value ?? ''); @endphp
             
             <div class="row">
              <div class="col-12 col-sm-12 col-md-4">
                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">{{ __('Hero Settings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">{{ __('About Me') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#social" role="tab" aria-controls="profile" aria-selected="false">{{ __('Social Links') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#counter" role="tab" aria-controls="contact" aria-selected="false">{{ __('Counter') }}</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#css-js" role="tab" aria-controls="contact" aria-selected="false">{{ __('Css Js') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#titles" role="tab" aria-controls="profile" aria-selected="false">{{ __('Title & Description') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-8">
            <div class="tab-content no-padding" id="myTab2Content">
              <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                <div class="form-group">
                    <label>{{ __('Hero Image') }}</label>
                    <input type="file" class="form-control" name="hero_img" >
                    {{ __('Current Hero Image') }}: <br><img class="mt-2"
                    src="{{ asset($value->hero_img ?? '') }}" alt="" height="50">
                </div>
                <div class="form-group">
                    <label>{{ __('Hero Title') }}</label>
                    <input type="text" placeholder="{{ __('Hero Title') }}" class="form-control" value="{{ $value->hero_title ?? '' }}" name="hero_title">
                </div>
                <div class="form-group">
                    <label>{{ __('Hero Description') }}</label>
                    <textarea name="hero_description" id="" cols="30" rows="10" class="form-control">{{ $value->hero_description ?? '' }}</textarea>
                </div>
               
                <div class="form-group">
                    <label>{{ __('Logo (.png)') }}</label>
                    <input type="file" class="form-control" name="logo" >
                    {{ __('Current Logo') }}: <br>
                   <img class="mt-2" src="{{ asset('uploads/'.Auth::id().'/logo.png?r='.rand(10,5)) }}" alt="" height="20">
                </div>
                <div class="form-group">
                    <label>{{ __('Favicon (ico)') }}</label>
                   <input type="file" class="form-control" name="favicon" >
                    {{ __('Current Favicon') }}: <br><img class="mt-2"
                    src="{{ asset('uploads/'.Auth::id().'/favicon.ico?r='.rand(10,5)) }}" alt="" height="20">
                </div>
                <div class="form-group">
                    <label>{{ __('Hire Url') }}</label>
                   <input type="text" class="form-control" name="hire" value="{{ $value->hire ?? '' }}">
                   
                </div>
                <div class="field_wrapper">
                    <div class="row mt-4">
                        <div class="col-md-11">
                            <label for="">{{ __('Tagline') }}</label> <br>
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:"
                            class="add_button text-xxs mr-2 btn btn-primary mb-0 btn-md  text-xxs "><i
                            class="fas fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    @foreach ($value->tagline ?? [] as $key => $item)
                    <div class="row">
                        <div class="col-sm-11">
                            <br>
                            <input type="text" class="form-control" name="title[]"
                            value="{{ old('title')?? $item }}">
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:void(0);"
                            class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-md text-xxs mt-4"
                            title="Remove"> <i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <br>
                   <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                   
                </div>
            </div>
            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                <div class="form-group">
                    <label>{{ __('About Section Image') }}</label>
                    <input type="file" class="form-control" name="about_img" >
                    {{ __('Prev photo') }} : <br>
                    <img class="mt-2" src="{{ asset($value->about_img ?? '') }}" alt="" height="50">
                </div>
                <div class="form-group">
                    <label>{{ __('Title') }}</label>
                   <input type="text" class="form-control" name="title_about" value="{{ $value->title_about ?? ''  }}" maxlength="100">
                </div>
                <div class="form-group">
                    <label>{{ __('Description') }}</label>
                   <textarea class="form-control" name="about_description"  maxlength="400">{{  $value->about_description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ __('CV Url') }}</label>
                    <input type="text" class="form-control" name="cv_url" value="{{  $value->cv_url ?? '' }}" maxlength="100">
                </div>
                <div class="form-group">
                    <label>{{ __('Your Full Name') }}</label>
                    <input type="text" class="form-control" name="full_name" value="{{  $value->full_name ?? '' }}" maxlength="100">
                </div>
                <div class="form-group">
                    <label>{{ __('Your Experience') }}</label>
                    <input type="text" class="form-control" name="experience" value="{{  $value->experience ?? '' }}" maxlength="100">
                </div>
                <div class="form-group">
                    <label>{{ __('Your Age') }}</label>
                    <input type="text" class="form-control" name="age" value="{{  $value->age ?? '' }}" maxlength="100">
                </div>
                <div class="form-group">
                    <label>{{ __('Your Email') }}</label>
                    <input type="email" class="form-control" name="email" value="{{  $value->email ?? '' }}" maxlength="100">
                </div>
                <div class="form-group">
                   
                   <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                   
                </div>
            </div>
            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="contact-tab4">
                <div class="row">
                    <div class="col-md-5">
                        <label for="">{{ __('Select Icon') }}</label> <br>
                    </div>
                    <div class="col-md-6">
                        <label for="">{{ __('Link') }}</label><br>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:"
                        class="add_button2 text-xxs mr-2 btn btn-primary mb-0 btn-md  text-xxs "><i
                        class="fas fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-group field_wrapper2">
                
                    @foreach ($value->social ?? [] as $key => $item)

                            <div class="row">
                                <div class="col-md-5"><br>
                                    <div class="input-group form-group">
                                        <input required readonly type="text" class="form-control icon_{{ $key }}"
                                            aria-describedby="button-addon2{{ $key }}" value="{{ $item->icon }}"
                                            data-key="{{ $key }}" name="social[{{ $key }}][icon]" height="40">
                                        <button class="btn btn-outline-primary mb-0 iconpicker"
                                            data-counter="{{ $key }}" data-icon="{{ $item->icon }}" role="iconpicker"
                                            type="button" id="button-addon2{{ $key }}" ></button>
                                    </div>

                                </div>
                                <div class="col-md-6"><br>
                                    <input required type="text" value="{{ $item->link }}" class="form-control"
                                        name="social[{{ $key }}][link]" class="">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);"
                                        class="remove_button2 text-xxs mr-2 btn btn-danger mb-0 btn-md  text-xxs mt-4"
                                        title="Remove"> <i class="fas fa-times"></i></a>
                                </div>
                            </div>
                            @endforeach
                <div class="row" id="append_loop">
                </div>
               </div>
                 <div class="form-group">
                   
                   <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                   
                </div>
            </div>
            
            <div class="tab-pane fade" id="counter" role="tabpanel" aria-labelledby="contact-tab4">
                <div class="form-group field_wrapper3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">{{ __('Select Icon') }}</label> <br>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ __('Label') }}</label><br>
                                </div>
                                <div class="col-md-4">
                                    <label for="">{{ __('Counter') }}</label><br>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:"
                                        class="add_button3 text-xxs mr-2 btn btn-primary mb-0 btn-lg  text-xxs "><i
                                            class="fas fa-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @foreach ($value->counter ?? [] as $key => $item)
                            <div class="row">
                                <div class="col-md-4"><br>
                                    <div class="input-group form-group">
                                        <input required readonly type="text" class="form-control icon2_{{ $key }}"
                                            aria-describedby="button-addon3{{$key}}" value="{{ $item->icon }}"
                                            data-key2="{{ $key }}" name="counter[{{ $key }}][icon]"
                                            height="40">
                                        <button class="btn btn-outline-primary mb-0 iconpicker2"
                                            data-counter2="{{ $key }}" data-icon="{{ $item->icon }}" role="iconpicker"
                                            type="button" id="button-addon3{{$key}}"></button>
                                    </div>

                                </div>
                                <div class="col-md-3"><br>
                                    <input required type="text" value="{{ $item->label }}" class="form-control"
                                        name="counter[{{ $key }}][label]" class="">
                                </div>
                                <div class="col-md-4"><br>
                                    <input required type="text" value="{{ $item->count }}" class="form-control"
                                        name="counter[{{ $key }}][count]" class="">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);"
                                        class="remove_button3 text-xxs mr-2 btn btn-danger mb-0 btn-lg text-xxs mt-4"
                                        title="Remove"> <i class="fas fa-times"></i></a>
                                </div>
                            </div>
                            @endforeach
                </div>
                <div class="form-group">
                   
                   <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                   
                </div>
            </div>
            <div class="tab-pane fade" id="titles" role="tabpanel" aria-labelledby="contact-tab4">
              
                <div class="form-group">
                    <label>{{ __('Service Section Title') }}</label>
                   <input type="text" maxlength="25" class="form-control" name="service_title" value="{{ $value->service_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Service Section Description') }}</label>
                    <textarea class="form-control" name="service_description" maxlength="200">{{ $value->service_description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ __('Education Title') }}</label>
                   <input type="text" maxlength="25" class="form-control" name="education_title" value="{{ $value->education_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Education Description') }}</label>
                    <textarea class="form-control" name="education_description" maxlength="200">{{ $value->education_description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ __('Portfolio Section Title') }}</label>
                   <input type="text" maxlength="20" class="form-control" name="portoflio_title" value="{{ $value->portoflio_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Portfolio Section Description') }}</label>
                    <textarea class="form-control" name="portoflio_description" maxlength="200">{{ $value->portoflio_description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ __('Testimonial Title') }}</label>
                   <input type="text" maxlength="25" class="form-control" name="testimonial_title" value="{{ $value->testimonial_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Testimonial Description') }}</label>
                    <textarea class="form-control" name="testimonial_description" maxlength="200">{{ $value->testimonial_description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ __('Blog Section Title') }}</label>
                   <input type="text" maxlength="20" class="form-control" name="blog_title" value="{{ $value->blog_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Blog Section Description') }}</label>
                    <textarea class="form-control" name="blog_description" maxlength="200">{{ $value->blog_description ?? '' }}</textarea>
                </div>

                 <div class="form-group">
                    <label>{{ __('Contact Section Title') }}</label>
                   <input type="text" maxlength="20" class="form-control" name="contact_title" value="{{ $value->contact_title ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Contact Section Description') }}</label>
                    <textarea class="form-control" name="contact_description" maxlength="200">{{ $value->contact_description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ __('Contact Section Short Description') }}</label>
                    <textarea class="form-control" name="contact_short_description" maxlength="200">{{ $value->contact_short_description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ __('Contact Section Address') }}</label>
                    <textarea class="form-control" name="contact_address" maxlength="100">{{ $value->contact_address ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ __('Contact Section Email') }}</label>
                   <input type="text" maxlength="40" class="form-control" name="contact_email" value="{{ $value->contact_email ?? '' }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Contact Section Phone Number') }}</label>
                   <input type="text" maxlength="20" class="form-control" name="contact_phone" value="{{ $value->contact_phone ?? '' }}">
                </div>
                 <div class="form-group">
                   
                   <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                   
                </div>
            </div>

        </form>

                <div class="tab-pane fade" id="css-js" role="tabpanel" aria-labelledby="contact-tab4">
                 <form method="post" action="{{ route('user.update.cssjs') }}" class="basicform">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Additional Css') }}</label>
                        <textarea class="form-control" maxlength="1000" name="css">{{ $css }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Additional JS') }}</label>
                        <textarea class="form-control" maxlength="1000" name="js">{{ $js }}</textarea>
                    </div>
                    <div class="form-group">
                     <button class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Save') }}</button>
                 </div>
             </form>
         </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>


@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/user-site-settings.js') }}"></script>
@endpush