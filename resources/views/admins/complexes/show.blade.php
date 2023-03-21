@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/complexes/show.css') }}">
@section('title', 'Просмотр жилого комплекса')
@section('content')
    <div class="main-container">
        <div class="container__header">
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

                        {{--                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"--}}
                        {{--                        aria-label="Slide 2"></button>--}}
                        {{--                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"--}}
                        {{--                        aria-label="Slide 3"></button>--}}
                        {{--                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"--}}
                        {{--                        aria-label="Slide 4"></button>--}}
                        {{--                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"--}}
                        {{--                        aria-label="Slide 5"></button>--}}
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
                    <p>{{ $complex->description }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
