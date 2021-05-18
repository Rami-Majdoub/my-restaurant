<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace('_', ' ', config('app.name', 'Laravel')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

    <!-- select2 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script></head> -->
    <!-- <link href="https://cdn.bootcss.com/select2/4.0.0/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.bootcss.com/select2/4.0.0/js/select2.min.js"></script> -->
<body>
    <div id="app">
        @include("components.navbar")
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('components.messages')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
