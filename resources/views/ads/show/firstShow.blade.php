@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/show/show.css') }}">
@section('title', 'Просмотр объявления')
@section('content')
    <div class="main-container pd ">
        <div class="container__main-body">
            {{--ABOUT OBJECT--}}
            <div class="body__ad common">
                {{--SLIDER--}}
                <div class="body__carousel col">
                    <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($ad->images as $key=>$item)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                        data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                        aria-label="Slide {{$key}}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @if(count($ad->images) > 0)
                                @foreach($ad->images as $key=>$item)
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

                {{--INFORMATION--}}
                <div class="body__info">
                    <div class="info__main">
                        <div>
                            <div class="info__title">
                                <h5>{{ $ad->getNameOfObject() }}</h5>
                            </div>
                            <div class="info__tags">
                                <p>{{ $ad->getCorrectObjectType() }}</p>
                                <p>{{ $ad->contract->name }}</p>
                                <p>Дата публикации: {{ $ad->dateOfUpdating }}</p>
                            </div>
                        </div>
                        <div class="info__price">
                            <h5>{{ $ad->getCorrectPrice() }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            {{--ABOUT USER--}}
            <div class="body__user common">
                {{--ABOUT USER--}}
                <div class="user__info">
                    <div class="user__name">
                        <h5 class="user__full-name"><a href="{{ route('users.ads', $ad->user->id) }}">{{ $ad->user->fullName }}</a></h5>
                        <p class="user__role">{{ $ad->user->role->name }}</p>
                    </div>
                    <div class="user__contacts">
                        <p>{{ $ad->user->telephone }}</p>
                        <p>{{ $ad->user->email }}</p>
                    </div>
                </div>
            </div>

            {{--WARNING--}}
            <div class="alert alert-warning mb-0">
                <p>При необходимости вы можете нанять любого доступного риелтора от агентства недвижимости на странице <a href="{{ route('users.realtors.index') }}">"Риелторы".</a></p>
            </div>
        </div>

        {{--INFOGRAPHICS--}}
        <div class="container__secondary-body">
            <div class="common">
                <div class="container__infographics">
                    {{--ROOM AREA--}}
                    @if($ad->object_type == '\App\Models\Room')
                        <div class="infographics">
                            <img src="{{ asset('/media/icons/ads/room_area.svg') }}" alt="Площадь комнаты">
                            <div>
                                <p class="infographics__title">Площадь комнаты</p>
                                <p class="infographics__value">{{ $ad->object->area }} м<sup>2</sup></p>
                            </div>
                        </div>
                    @endif

                    {{--TOTAL AREA--}}
                    <div class="infographics">
                        <img src="{{ asset('/media/icons/ads/total_area.svg') }}" alt="Общая площадь">
                        <div>
                            <p class="infographics__title">Общая площадь</p>
                            <p class="infographics__value">{{ $characteristics->total_area }} м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--LIVING AREA--}}
                    <div class="infographics">
                        <img src="{{ asset('/media/icons/ads/living_area.svg') }}" alt="Жилая площадь">
                        <div>
                            <p class="infographics__title">Жилая площадь</p>
                            <p class="infographics__value">{{ $characteristics->living_area }} м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--KITCHEN AREA--}}
                    @if ($characteristics->kitchen_area)
                        <div class="infographics">
                            <img src="{{ asset('/media/icons/ads/kitchen_area.svg') }}" alt="Площадь кухни">
                            <div>
                                <p class="infographics__title">Площадь кухни</p>
                                <p class="infographics__value">{{ $characteristics->kitchen_area }} м<sup>2</sup></p>
                            </div>
                        </div>
                    @endif

                    {{--REPAIR--}}
                    <div class="infographics">
                        <img src="{{ asset('/media/icons/ads/repair.svg') }}" alt="Ремонт">
                        <div>
                            <p class="infographics__title">Ремонт</p>
                            <p class="infographics__value">{{ $ad->object->repair->name }}</p>
                        </div>
                    </div>

                    {{--FLOORS--}}
                    <div class="infographics">
                        <img src="{{ asset('/media/icons/ads/floors.svg') }}" alt="Этаж">
                        <div>
                            <p class="infographics__title">Этаж</p>
                            <div class="floors">
                                <p class="infographics__value">{{ $ad->object->floor }}</p>
                                <p class="infographics__value">из</p>
                                <p class="infographics__value">{{ $characteristics->floors }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--DESCRIPTION--}}
        <div class="container__secondary-body">
            <div class="common">
                <h5>Описание</h5>
                @if ($complex)
                    <p class="padding-bottom">Находится в жилом комплексе "{{ $complex->name ?? '' }}".</p>
                @endif
                <p class="padding-bottom">{{ $ad->description }}</p>
                @if ($characteristics->ceiling_height)
                    <p>Высота потолков – {{ $characteristics->ceiling_height }}</p>
                @endif
                <p class="padding-bottom">Количество жилых комнат – {{ $characteristics->living_rooms_amount }}
                    ком.</p>
                <p class="padding-bottom">Количество санузлов – {{ $characteristics->bathrooms_amount }} ком.
                    Санузел {{ $characteristics->bathroom_type }}.</p>
                @if ($characteristics->building_year)
                    <p>Год постройки здания – {{ $characteristics->building_year }}.
                        @if($characteristics->building_material)
                            Тип дома: {{ $characteristics->building_material }}
                        @endif
                    </p>
                @endif
            </div>
        </div>

        {{--LAYOUT--}}
        <div class="container__secondary-body">
            <div class="common layout">
                <h5>Планировка</h5>
                <div>
                    <img src="{{ $ad->object->layout }}" alt="{{ $ad->getNameOfObject() }}" class="layout-image">
                </div>
            </div>
        </div>

        {{--RESIDENTIAL COMPLEX--}}
        @if ($complex)
            <div class="container__secondary-body">
                @include('inc.complex')
            </div>
        @endif
    </div>
@endsection
