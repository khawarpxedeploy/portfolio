@extends('theme.porto.layouts.app')

@section('content')
@include('theme/porto/layouts/partials/header2')
{{-- breadcrumb area start --}}
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="breadcrumb-content text-center">
                    <h4>{{ __('All Blogs') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- breadcrumb area end --}}

{{-- blog details area start --}}
<section>
    <div class="main-area">
        <div class="container">
            <div class="row blog_area">
                
            </div>
             <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center pagination_links">
                
              </ul>
         </nav>
        </div>
    </div>
</section>
{{-- blog details area end --}}  
@endsection

@push('js')
<script src="{{ asset('theme/porto/js/blog.js') }}"></script>
@endpush
