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
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($ad->images as $key=>$item)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                        data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                        aria-current="true" aria-label="Slide {{$key}}"></button>
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
                        <h5 class="user__full-name">{{ $ad->user->fullName }}</h5>
                        <p class="user__role">{{ $ad->user->role->name }}</p>
                    </div>
                    <div class="user__contacts">
                        <p>{{ $ad->user->telephone }}</p>
                        <p>{{ $ad->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container__secondary-body">
            <div class="common">
                @if ($ad->object_type == '\App\Models\House')
                    <div class="container__infographics">
                        <div class="infographics">
                            <img src="{{ asset('/media/icons/ads/living_area.svg') }}" alt="Площадь здания">
                            <div>
                                <p class="infographics__title">Площадь здания</p>
                                <p class="infographics__value">{{ $ad->object->building_area }} м<sup>2</sup></p>
                            </div>
                        </div>
                        @if($ad->object->floors)
                            <div class="infographics">
                                <img src="{{ asset('/media/icons/ads/floors.svg') }}" alt="Этажей">
                                <div>
                                    <p class="infographics__title">Этажей</p>
                                    <p class="infographics__value">{{ $ad->object->floors }}</p>
                                </div>
                            </div>
                        @endif
                        @if($ad->object->building_material)
                            <div class="infographics">
                                <img src="{{ asset('/media/icons/ads/repair.svg') }}" alt="Материал">
                                <div>
                                    <p class="infographics__title">Материал</p>
                                    <p class="infographics__value">{{ $ad->object->building_material }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif ($ad->object_type == '\App\Models\LandPlot')
                    <div class="container__infographics">
                        <div class="infographics">
                            <img src="{{ asset('/media/icons/ads/total_area.svg') }}" alt="Площадь участка">
                            <div>
                                <p class="infographics__title">Площадь участка</p>
                                <p class="infographics__value">{{ $ad->object->area }} сот.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{--DESCRIPTION--}}
        <div class="container__secondary-body">
            <div class="common">
                <h5>Описание</h5>
                <p>{{ $ad->description }}</p>
            </div>
        </div>

        <div class="container__secondary-body">
            <div class="common">

                {{--ABOUT HOUSE--}}
                @if ($ad->object_type == '\App\Models\House')
                    <div class="secondary-body__inner">
                        <h5>О здании</h5>

                        <div>
                            {{--BEDROOMS--}}
                            @if($ad->object->bedrooms)
                                <div class="padding-bottom">
                                    <p>Количество спальных комнат – {{ $ad->object->bedrooms }} ком.</p>
                                </div>
                            @endif

                            {{--BATHROOMS AND BATHROOM PLACE--}}
                            @if($ad->object->bathrooms)
                                <div class="padding-bottom">
                                    <p>Количество санузлов – {{ $ad->object->bathrooms }} ком.
                                        Находится {{ $ad->object->bathroom_place }}.</p>
                                </div>
                            @endif

                            {{--BUILDING YEAR--}}
                            @if($ad->object->building_year)
                                <div class="padding-bottom">
                                    <p>Год постройки здания – {{ $ad->object->building_year }} г.</p>
                                </div>
                            @endif

                            {{--BUILDING STATUS--}}
                            @if($ad->object->building_status)
                                <div class="padding-bottom">
                                    <p>Состояние здания:</p>
                                    <p> {{ $ad->object->building_status }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{--ABOUT PLOT--}}
                <div class="secondary-body__inner">
                    <h5>Об участке</h5>

                    {{--FOR LANDPLOT--}}
                    @if ($ad->object_type == '\App\Models\LandPlot')
                        <div>
                            <p>Состояние участка: {{ $ad->object->status }}</p>
                        </div>
                    @elseif ($ad->object_type == '\App\Models\House')
                        <div>
                            <p class="padding-bottom">Площадь участка составляет {{ $ad->object->plot_area }} сот.</p>
                            <div>
                                <p>Состояние участка:</p>
                                <p> {{ $ad->object->plot_status }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{--CHARACTERISTICS--}}
                <div class="secondary-body__inner mb-0">
                    <h5>Удобства</h5>

                    <div>
                        <p>На объекте недвижимости присутствуют следующие удобства:</p>
                        <ul class="ad__characteristics mb-0">
                            @if ($characteristics != null)
                                @foreach($characteristics as $charact)
                                    <li>{{ $charact->characteristic->name }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
