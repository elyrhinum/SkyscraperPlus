@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'ВысоткаПлюс')
@section('content')
    <!-- BANNER -->
    <div class="main-banner">
        <img src="{{ asset('/media/images/banner.jpg') }}" alt="Баннер">
    </div>

    <!-- SEARCH FORM -->
    <div class="search pd">
        @include('inc.filter')
    </div>

    <!-- LIST OF ADS CATEGORIES -->
    <div class="ads pd">
        <h3>Категории объявлений</h3>

        <div class="ads__blocks">
            {{-- BLOCK 1 --}}
            <div>
                <img class="blocks__img-block" src="{{ asset('/media/images/index/img-1.jpg') }}" alt="Изображение 1">

                <div class="blocks__info-block">
                    <h5>Купить квартиру</h5>

                    <div class="info-block__list">

                    </div>
                </div>
            </div>

            {{-- BLOCK 2 --}}
            <div>
                <img class="blocks__img-block" src="{{ asset('/media/images/index/img-2.jpg') }}" alt="Изображение 2">

                <div class="blocks__info-block">
                    <h5>Снять квартиру</h5>

                    <div class="info-block__list">

                    </div>
                </div>
            </div>

            {{-- BLOCK 3 --}}
            <div class="blocks__info-block-reverse">
                <div class="blocks__info-block">
                    <h5>Снять другую недвижимость</h5>

                    <div class="info-block__list">

                    </div>
                </div>

                <img class="blocks__img-block" src="{{ asset('/media/images/index/img-3.jpg') }}" alt="Изображение 3">
            </div>

            {{-- BLOCK 4 --}}
            <div class="blocks__info-block-reverse">
                <div class="blocks__info-block">
                    <h5>Купить другую недвижимость</h5>

                    <div class="info-block__list">

                    </div>
                </div>

                <img class="blocks__img-block" src="{{ asset('/media/images/index/img-4.jpg') }}" alt="Изображение 4">
            </div>
        </div>
    </div>

    <!-- LATEST ADS -->
    <div class="latest-ads pd">
        <h3>Последние объявления</h3>
    </div>

    <!-- LIST OF RESIDENTIAL COMPLEXES -->
    <div class="rcs-list pd">
        <h3>Жилые комплексы</h3>
    </div>
@endsection
