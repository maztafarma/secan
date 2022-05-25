<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Content Management</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/cms.css') }}" rel="stylesheet">
</head>
@guest
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@else
<body class="nav-md">
    <div class="container body" id="app">
        <div class="main_container">
            @include('cms.partials.sidebar')
            <div class="right_col" role="main">
                @yield('content')
            </div>
            @include('cms.partials.footer')
        </div>
    </div>
        
</body>
@endguest

<!-- Scripts -->
<script>
    var token = {!! json_encode(csrf_token()) !!}
    var appDomain = {!! json_encode(env('APP_URL')) !!}
    var supported_language = {!! json_encode(LaravelLocalization::getSupportedLocales()) !!}
</script>
<script src="{{ asset('js/cms.js') }}" defer></script>
<script src="{{ asset('js/laroute.js') }}" defer></script>

<!-- PNotify -->
<script src="{{ asset('js/external/Pnotify/dist/pnotify.js') }}" defer></script>
<script src="{{ asset('js/external/Pnotify/dist/pnotify.buttons.js') }}" defer></script>
<script src="{{ asset('js/external/Pnotify/dist/pnotify.nonblock.js') }}" defer></script>
</html>
