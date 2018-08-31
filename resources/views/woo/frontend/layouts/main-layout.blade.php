<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}"/>
    <script src="{{asset('/js/app.js')}}"></script>
{{--    <style>
        html, body {
            height: 100%;
        }
    </style>--}}
</head>
<body>
<div class="uk-container">
<div class="uk-section-primary uk-preserve-color">

    @yield('navbar')
    @yield('content')
    @yield('footer')
</div>
</div>
</body>
</html>
