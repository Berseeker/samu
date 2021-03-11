<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAMU.APP</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" >

    <!-- Styles -->
{{--        <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">--}}


<!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
</head>
<body>
<div id="app">

</div>
</body>
</html>
