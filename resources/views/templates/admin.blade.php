<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--CSS--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admins/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{--SCRIPT--}}
    <script defer src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    {{-- FAVICON --}}
    <link type="image/x-icon" href="{{asset('/media/icons/favicon.svg') }}" rel="shortcut icon">
    <link type="Image/x-icon" href="{{asset('/media/icons/favicon.svg')}}" rel="icon">

    <title>@yield('title')</title>

</head>
<body>

{{--HEADER--}}
<header>
    {{--LOGO--}}
    <a href="{{ route('admins.index') }}">
        <img src="{{ asset('/media/icons/logo.svg') }}" alt="Логотип" id="logo">
    </a>

    {{--INFO ABOUT USER--}}
    <div>
        <p class="header__user">Вы вошли как: {{ auth()->user()->shortName }}</p>

        <a href="{{ route('admins.user.edit', auth()->id()) }}" class="btn btn-filled">Редактировать профиль</a>
        <a href="{{ route('users.logout') }}" class="btn btn-outlined">Выйти</a>
    </div>
</header>

@yield('content')

</body>
</html>

@stack('script')
