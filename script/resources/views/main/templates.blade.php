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
                        <h3> {{ ucfirst($key) }} {{ __(' - Templates') }}</h3>
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
         <div class="row mt-5 choice-image">
        @foreach($posts as $row)
        <div class="col-lg-3">
          <div class="single-choice mb-30">
              <div class="choice-img">
                  <a href="{{ url($row->slug) }}"><img class="img-fluid" src="{{ asset($row->title) }}" alt="template image"></a>
              </div>
              <div class="choice-btn">
                  <a href="{{ url($row->slug) }}"><span class="iconify" data-icon="akar-icons:link-chain" data-inline="false"></span></a>
              </div>
          </div>
      </div>
      @endforeach
     </div>
  </div>
</div>
</section>
{{-- main area end --}}
@endsection