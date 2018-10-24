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

    <meta name="description" content="Conecta, comparte y aprende de otros creadores indie que tienen sus negocios y proyectos en el mundo digital.">

    @yield('seo')

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') . '?v=' . Version::build() }}" rel="stylesheet">
    @stack('custom-css')

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
@include('front.partials.navbar')

@yield('content')

@cache('front.partials.footer')

@if (config('app.env') == 'production')
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-117343241-3', 'auto');
    ga('send', 'pageview');
</script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('custom-js')
</body>
</html>
