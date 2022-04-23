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
                    <div class="row blog_area">
                        
                    </div>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center pagination_links">

                      </ul>
                  </nav>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- blog details area end --}} 
@endsection

@push('js')
<script src="{{ asset('theme/arafa/js/blog.js') }}"></script>
@endpush