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
    <!-- Quill editor wisywig -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <!-- Style -->
    <link href="{{ mix('/admin/css/app.css') }}" rel="stylesheet">

</head>
<body>
<main role="main">
    <div class="iziToast-message">
        @include('admin/layout/success-alert')
        @include('admin/layout/error-alert')
        @include('admin/layout/warning-alert')
        @include('admin/layout/info-alert')
    </div>


    @include('admin/layout/nav')
    @include('admin/layout/sidebar')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="offset-1 col-sm-11 col-md-11">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

@include('admin/layout/footer')
</main>

<!-- Plugins -->
<script src="{{ asset('plugins/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<!-- Modules Js -->
<script src="{{ asset('admin/modules/select2Function.js') }}"></script>
<script src="{{ asset('admin/modules/quillFunction.js') }}"></script>
<!-- Script -->
<script src="{{ mix('js/app.js') }}" async defer></script>
<script src="{{ mix('/admin/js/app.js') }}" async defer></script>

</body>
</html>
