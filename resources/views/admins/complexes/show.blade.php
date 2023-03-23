@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/complexes/show.css') }}">
@section('title', 'Просмотр жилого комплекса')
@section('content')
    <div class="main-container">
        <div id="title">
            <h5>Жилой комплекс "{{ $complex->name }}"</h5>
        </div>

        <div class="container__body">
            <div class="body__grid">
                {{--SLIDER--}}
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($complex->images as $key=>$item)
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" class="active"
                                    aria-current="true" aria-label="Slide {{$key}}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($complex->images as $key=>$item)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ $item->image }}" class="d-block w-100 slider-image" alt="{{ $item->name }}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $item->name }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Предыдущий</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Следующий</span>
                    </button>
                </div>

                {{--INFORMATION--}}
                <div class="grid__info">
                    <h5>{{ $complex->name }}</h5>
                    <p>Класс: {{ $complex->class->name }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
