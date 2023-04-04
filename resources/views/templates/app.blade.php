<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- SCRIPTS --}}
    <script defer src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    {{-- FAVICON --}}
    <link type="image/x-icon" href="{{asset('/media/icons/favicon.svg') }}" rel="shortcut icon">
    <link type="Image/x-icon" href="{{asset('/media/icons/favicon.svg')}}" rel="icon">

    <title>@yield('title')</title>

</head>
<body>
    @include('inc.header')

    @yield('content')

    @include('inc.footer')

@stack('script')
</body>
</html>
