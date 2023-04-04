@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/complexes/show.css') }}">
@section('title', 'Просмотр жилого комплекса')
@section('content')
    <div class="main-container">
        {{--ЗАГОЛОВОК--}}
        <div id="title">
            <h5>Жилой комплекс "{{ $complex->name }}"</h5>
        </div>

        <div class="container__body">
            <div class="row">
                {{--СЛАЙДЕР--}}
                <div class="body__carousel col">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($complex->images as $key=>$item)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                        data-bs-slide-to="{{ $key }}" class="active"
                                        aria-current="true" aria-label="Slide {{$key}}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @if(count($complex->images) > 0)
                                @foreach($complex->images as $key=>$item)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ $item->image }}" class="d-block w-100 slider-image"
                                             alt="{{ $item->name }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="{{ asset('/media/images/default/default.png') }}"
                                         class="d-block w-100 slider-image" alt="Изображение жилого комплекса">
                                </div>
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Предыдущий</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Следующий</span>
                        </button>
                    </div>
                </div>

                {{--ИНФОРМАЦИЯ--}}
                <div class="body__info col">
                    <div class="info__title">
                        <h3>ЖК "{{ $complex->name }}"</h3>
                        <p>Дата подачи: {{ $complex->dateOfCreating }}</p>
                    </div>
                    <div class="info__description">
                        <h5>Описание</h5>
                        <p class="mb-2">Класс комплекса: {{ $complex->class->name }}</p>
                        <p class="mb-2">Район: {{ $complex->district->name }}</p>
                        <p>{{ $complex->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
