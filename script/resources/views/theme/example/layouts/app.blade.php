<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- generate seo info --}}
      {{--   {!! SEO::generate() !!}
        {!! JsonLdMulti::generate() !!} --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE ICON -->
        
         @stack('css')
        <!-- FOR STYLE -->
        
    </head>
<body>
 


{{-- load partials views --}}      
@include('frontend/example/layouts/header')
@yield('content')
@include('frontend/example/layouts/footer')

{{-- end load --}}






  @stack('js')
 <!-- FOR INTERACTION -->
<!--=====================================
    JS LINK PART END
=======================================-->
    </body>
</html>