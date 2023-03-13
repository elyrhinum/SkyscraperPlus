<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admins/main.css') }}">
    <script defer src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    <title>@yield('title')</title>

</head>
<body>

{{--    HEADER--}}
    <header>
        <div class="info">
            <a href="{{ route('users.indexAdmin') }}">
                <img src="{{ asset('/media/icons/logo.svg') }}" alt="Логотип" id="logo">
            </a>
            <div class="header__block">
                {{--            @foreach($realtor as $user)--}}
                <p>fgsdf</p>
                <button>fgd</button>
                {{--                <p>Вы вошли как: {{ $user->fullName }}</p>--}}
                {{--                <form action="{{ route('users.logoutAdmin') }}" method="post">--}}
                {{--                    <button class="btn btn-logout">Выйти</button>--}}
                {{--                </form>--}}
                {{--            @endforeach--}}
            </div>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <img src="{{ asset('/media/icons/admin/new_ads.png') }}" alt="Новые объявления">
                    <a href="">Новые объявления</a>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/published_ads.png') }}" alt="Опубликованные объявления">
                    <a href="">Опубликованные объявления</a>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/all_ads.png') }}" alt="Все объявления">
                    <a href="">Все объявления</a>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/streets.png') }}" alt="Улицы">
                    <a href="">Улицы</a>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/districts.png') }}" alt="Районы">
                    <a href="">Районы</a>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/realtors.png') }}" alt="Риелторы">
                    <a href="">Риелторы</a>
                </li>
            </ul>
        </div>
    </header>

@yield('content')

</body>
</html>
