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

{{--VARS FOR AMOUNT OF ADS AND COMPLEXES IN HEADER--}}
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
                <p class="navigation__ul-title">Объявления</p>
                <li>
                    <a href="{{ route('admins.ads.onlySuggested') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Новые объявления">
                        <div>
                            <span>Новые объявления</span>
                            <sup>{{ count($ads->where('status_id', 2)) }}</sup>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admins.ads.onlyPublished') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные объявления">
                        <div>
                            <span>Опубликованные объявления</span>
                            <sup>{{ count($ads->where('status_id', 1)) }}</sup>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/streets.png') }}" alt="Улицы">
                        <span>Улицы</span>
                    </a>
                </li>
                <li>
                    <a href="" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/districts.png') }}" alt="Районы">
                        <span>Районы</span>
                    </a>
                </li>
            </ul>
            <ul>
                <p class="navigation__ul-title">Жилые комплексы</p>
                <li>
                    <a href="{{ route('admins.complexes.onlySuggested') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Новые жилые комплексы">
                        <div>
                            <span>Новые жилые комплексы</span>
                            <sup>{{ count($complexes->where('status_id', 2)) }}</sup>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admins.complexes.onlyPublished') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные жилые комплексы">
                        <div>
                            <span>Опубликованные жилые комплексы</span>
                            <sup>{{ count($complexes->where('status_id', 1)) }}</sup>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admins.complexes.onlyHidden') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/inactive.png') }}" alt="Неактивные жилые комплексы">
                        <div>
                            <span>Неактивные жилые комплексы</span>
                            <sup>{{ count($complexes->where('status_id', 4)) }}</sup>
                        </div>
                    </a>
                </li>
            </ul>
            @if(auth()->user()->role_id == 3)
                <ul>
                    <p class="navigation__ul-title">Модераторы</p>
                    <li>
                        <a href="{{ route('admins.moderators.index') }}" class="navigation__ul-link">
                            <img src="{{ asset('/media/icons/admin/moderators.png') }}" alt="Новые жилые комплексы">
                            <div>
                                <span>Список модераторов</span>
                                <sup>{{ count($moderators->where('role_id', 4)) }}</sup>
                            </div>
                        </a>
                    </li>
                </ul>
            @endif
            <ul>
                <li>
                    <a href="{{ route('users.logout') }}" class="navigation__ul-link">
                        <img src="{{ asset('/media/icons/admin/logout.png') }}" alt="Выйти">
                        <span>Выйти</span>
                    </a>
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
