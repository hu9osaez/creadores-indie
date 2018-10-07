<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }} &#128736;&#128640;</title>
    @else
        <title>{{ config('app.name') }} &#128736;&#128640;</title>
    @endif

    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.4.1/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('custom-css')
</head>
<body>
@include('front.partials.navbar')

@yield('content')

@cache('front.partials.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('custom-js')
</body>
</html>
