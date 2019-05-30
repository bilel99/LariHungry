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
    <!-- Styles -->
    <link href="{{ mix('/admin/css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ mix('/admin/js/app.js') }}" async defer></script>
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />

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

<script src="{{ asset('plugins/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    /**
     * Select2 plugins
     */
    $('select').select2({
        placeholder: 'Selected the elements',
        tags: true
    });
</script>

</body>
</html>
