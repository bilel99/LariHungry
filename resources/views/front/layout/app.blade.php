<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Font awesome cdn -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">
    <!-- Izitoast -->
    <script src="{{ asset('plugins/izitoast/iziToast.min.js') }}"></script>
    <!-- OWL Carousel -->
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.min.css') }}">
    <!-- Select2 -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <!-- Styles -->
    <link href="{{ mix('/front/css/app.css') }}" rel="stylesheet">

</head>
<body>
<main role="main">
    <div class="iziToast-message">
        @include('front/layout/success-alert')
        @include('front/layout/error-alert')
        @include('front/layout/warning-alert')
        @include('front/layout/info-alert')
    </div>

    @include('front/layout/nav')
    @yield('content')
    @include('front/layout/footer')
</main>

<script src="{{ asset('plugins/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<!-- Scripts -->
<script src="{{ asset('front/modules/owlCarouselFunction.js') }}"></script>
<script src="{{ asset('front/modules/select2Function.js') }}"></script>
<script src="{{ mix('js/app.js') }}" async defer></script>
<script src="{{ mix('/front/js/app.js') }}" async defer></script>

</body>
</html>
