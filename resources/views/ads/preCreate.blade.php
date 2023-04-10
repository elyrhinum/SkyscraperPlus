@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/pre-create.css') }}">
@section('title', 'Выбор объекта недвижимости')
@section('content')
    <div class="main-container pd">
        {{--HEADERS WITH INSTRUCTIONS--}}
        <div class="headers">
            <div class="headers__inner">
                <h3>Новое объявление</h3>
                <p>Для начала необходимо выбрать тип объекта недвижимости, на который Вы хотите подать объявление.</p>
                <p>Выбор типов объекта недвижимости представлен ниже.</p>
            </div>
        </div>

        {{--BUTTONS WITH TYPES OF OBJECTS--}}
        <div class="blocks">
            <a href="{{ route('flats.create') }}" class="blocks__block">
                <img src="{{ asset('/media/images/pre-create/flat.jpg') }}" alt="Квартира">
                <div class="block__text">
                    <p>Квартира</p>
                </div>
            </a>
            <a href="{{ route('rooms.create') }}" class="blocks__block">
                <img src="{{ asset('/media/images/pre-create/room.jpg') }}" alt="Комната">
                <div class="block__text">
                    <p>Комната</p>
                </div>
            </a>
            <a href="{{ route('houses.create') }}" class="blocks__block">
                <img src="{{ asset('/media/images/pre-create/house.jpg') }}" alt="Коттедж/дача">
                <div class="block__text">
                    <p>Коттедж или дача</p>
                </div>
            </a>
            <a href="{{ route('landplots.create') }}" class="blocks__block">
                <img src="{{ asset('/media/images/pre-create/land_plot.jpg') }}" alt="Земельный участок">
                <div class="block__text">
                    <p>Земельный участок</p>
                </div>
            </a>
        </div>
    </div>
@endsection
