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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.2.2/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
@include('front.partials.navbar')

@yield('content')

@include('front.partials.footer')
</body>
</html>