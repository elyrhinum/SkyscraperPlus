<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--CSS--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admins/main.css') }}">

    {{--SCRIPT--}}
    <script defer src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    {{-- FAVICON --}}
    <link type="image/x-icon" href="{{asset('/media/icons/favicon.svg') }}" rel="shortcut icon">
    <link type="Image/x-icon" href="{{asset('/media/icons/favicon.svg')}}" rel="icon">

    <title>@yield('title')</title>

</head>
<body>

@php
    use App\Models\Ad;
    use App\Models\User;
    use App\Models\ResidentialComplex;

    $ads = Ad::all();
    $complexes = ResidentialComplex::all();
    $moderators = User::all();
@endphp

{{--HEADER--}}
<header>
    <div class="header__main-block">
        <a href="{{ route('admins.index') }}">
            <img src="{{ asset('/media/icons/logo.svg') }}" alt="Логотип" id="logo">
        </a>
        <div class="header__navigation">
            <ul>
                <p class="list-title">Объявления</p>
                <li>
                    <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Новые объявления">
                    <div>
                        <a href="{{ route('ads.suggested') }}">Новые объявления</a>
                        <sup>{{ count($ads->where('status_id', 2)) }}</sup>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные объявления">
                    <div>
                        <a href="{{ route('ads.published') }}">Опубликованные объявления</a>
                        <sup>{{ count($ads->where('status_id', 1)) }}</sup>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/all.png') }}" alt="Все объявления">
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
            </ul>
            <ul>
                <p class="list-title">Жилые комплексы</p>
                <li>
                    <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Новые жилые комплексы">
                    <div>
                        <a href="{{ route('complexes.suggested') }}">Новые жилые комплексы</a>
                        <sup>{{ count($complexes->where('status_id', 2)) }}</sup>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные жилые комплексы">
                    <div>
                        <a href="{{ route('complexes.published') }}">Опубликованные жилые комплексы</a>
                        <sup>{{ count($complexes->where('status_id', 1)) }}</sup>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/inactive.png') }}" alt="Неактивные жилые комплексы">
                    <div>
                        <a href="">Неактивные жилые комплексы</a>
                        <sup>{{ count($complexes->where('status_id', 3)) }}</sup>
                    </div>
                </li>
                <li>
                    <img src="{{ asset('/media/icons/admin/all.png') }}" alt="Все жилые комплексы">
                    <a href="">Все жилые комплексы</a>
                </li>
            </ul>
            @if(auth()->user()->role_id == 3)
                <ul>
                    <p class="list-title">Модераторы</p>
                    <li>
                        <img src="{{ asset('/media/icons/admin/moderators.png') }}" alt="Новые жилые комплексы">
                        <div>
                            <a href="{{ route('moderators.index') }}">Список модераторов</a>
                            <sup>{{ count($moderators->where('role_id', 4)) }}</sup>
                        </div>
                    </li>
                </ul>
            @endif
            <ul>
                <li>
                    <img src="{{ asset('/media/icons/admin/logout.png') }}" alt="Выйти">
                    <a href="{{ route('users.logout') }}">Выйти</a>
                </li>
            </ul>
        </div>
    </div>
    <p class="header__user">Вы вошли как: {{ auth()->user()->shortName }}</p>
</header>

@yield('content')

</body>
</html>

@stack('script')
