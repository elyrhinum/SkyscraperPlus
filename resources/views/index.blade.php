@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'Высотка Плюс')
@section('content')
    <!-- баннер -->
    <div class="main-banner">
        <img src="{{ asset('/media/images/banner.jpg') }}" alt="Основной баннер">
    </div>

    <!-- форма поиска объявлений -->
    <div class="search pd">

    </div>

    <!-- рекламный баннер -->
    <div id="advertise-banner-1 pd"></div>

    <!-- список объявлений -->
    <div class="ads pd">
        <h1>ОБЪЯВЛЕНИЯ</h1>

        <div class="ads__blocks">
            <div class="blocks__img-block"></div>

            <div class="blocks__info-block">

            </div>

            <div class="blocks__img-block"></div>

            <div class="blocks__info-block">

            </div>

            <div class="blocks__img-block"></div>

            <div class="blocks__info-block">

            </div>

            <div class="blocks__img-block"></div>

            <div class="blocks__info-block">

            </div>
        </div>
    </div>

    <!-- рекламный баннер -->
    <div id="advertise-banner-2 pd"></div>

    <!-- последние объявления -->
    <div class="latest-ads pd">

    </div>

    <!-- список жк -->
    <div class="rcs-list pd">

    </div>

    <!-- список риелторов -->
    <div class="realtors-list pd">

    </div>
@endsection
