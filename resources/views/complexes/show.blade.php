@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/complexes/show.css') }}">
@section('title', $title )
@section('content')
    <div class="main-container pd ">
        <div class="container__main-body">
            {{--ABOUT OBJECT--}}
            <div class="body__object common">
                <div class="object__inner">
                    {{--SLIDER--}}
                    <div class="body__carousel col">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($complex->images as $key=>$item)
                                    <button type="button" data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                            aria-current="true" aria-label="Slide {{$key}}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @if(count($complex->images) > 0)
                                    @foreach($complex->images as $key=>$item)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="carousel-item__gradient"></div>
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
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                        </div>
                    </div>

                    {{--NAME--}}
                    <div class="body__title">
                        <h5>ЖК "{{ $complex->name }}"</h5>
                        <span>{{ $complex->district->name }}</span>
                    </div>
                </div>
            </div>

            {{--DESCRIPTION--}}
            <div class="container__secondary-body">
                <div class="common">
                    <h5>Описание</h5>
                    <p>{{ $complex->description }}</p>
                </div>
            </div>
        </div>

        {{--FLATS IN THIS COMPLEX--}}
        @if (count($flats) > 0)
            <div class="container__secondary-body objects-in-complex">
                <div>
                    <h5>
                        <a href="{{ route('complexes.flatsInResidentialComplex', $complex->id) }}">Квартиры в этом жилом комплексе</a>
                    </h5>

                    <a href="{{ route('complexes.flatsInResidentialComplex', $complex->id) }}" class="btn btn-filled">Подробнее</a>
                </div>


                @foreach($flats as $ad)
                    @include('inc.ad')
                @endforeach
            </div>
        @endif

        {{--ROOMS IN THIS COMPLEX--}}
        @if (count($rooms) > 0)
            <div class="container__secondary-body objects-in-complex">
                <div>
                    <h5>
                        <a href="{{ route('complexes.roomsInResidentialComplex', $complex->id) }}">Комнаты в этом жилом комплексе</a>
                    </h5>

                    <a href="{{ route('complexes.flatsInResidentialComplex', $complex->id) }}" class="btn btn-filled">Подробнее</a>
                </div>

                @foreach($rooms as $ad)
                    @include('inc.ad')
                @endforeach
            </div>
        @endif
    </div>
@endsection
