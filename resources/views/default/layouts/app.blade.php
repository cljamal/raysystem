<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@stack('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('ray/css/ray.css' ) }}" rel="stylesheet">
    <script src="{{ asset('ray/js/top.js') }}"></script>
    @stack('header')
</head>
<body id="{{ $page_name }}" class="{{ $body_class }}">

    <div id="app">
        @yield("content")
    </div>

    @stack('footer')
    <script src="{{ asset('ray/js/ray.js') }}"></script>
    <script src="{{ asset('ray/js/bottom.js') }}"></script>
</body>
</html>
