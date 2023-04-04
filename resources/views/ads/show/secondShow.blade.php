@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/show/secondShow.css') }}">
@section('title', 'Просмотр объявления')
@section('content')
    <div class="main-container pd">
        <div class="container__main-body">
            {{--ABOUT OBJECT--}}
            <div class="body__ad">
                {{--SLIDER--}}
                <div class="body__carousel col">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($ad->images as $key=>$item)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                        data-bs-slide-to="{{ $key }}" class="active"
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
                    <div>
                        <div class="info__title">
                            <h5>{{ $ad->getNameOfObject() }}</h5>
                        </div>
                        <p class="info__description">{{ $ad->description }}</p>
                        <div class="info__price">
                            <h5>{{ $ad->getCorrectPrice() }}</h5>
                        </div>
                    </div>
                    <div class="info__tags">
                        <p>{{ $ad->getCorrectObjectType() }}</p>
                        <p>{{ $ad->contract->name }}</p>
                        <p>Дата публикации: {{ $ad->dateOfUpdating }}</p>
                    </div>
                </div>
            </div>

            {{--ABOUT USER--}}
            <div class="body__user">
                {{--IMAGE--}}
                @if ($ad->user->role == 'Риелтор')
                    <img src="{{ $ad->user->image }}" alt="{{ $ad->user->shortName }}">
                @endif

                {{--ABOUT USER--}}
                <div class="user__info">
                    <p class="user__full-name">{{ $ad->user->fullName }}</p>
                    <p class="user__role">{{ $ad->user->role->name }}</p>
                    <div class="user__contacts">
                        <p>{{ $ad->user->telephone }}</p>
                        <p>{{ $ad->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container__second-body">
            <div>
                @if ($ad->object_type == '\App\Models\House')
                    <div>
                        <div class="infographics">
                            <img src="{{ asset('/media/icons/ads/living_area.svg') }}" alt="Площадь здания">
                            <div>
                                <p class="infographics__title">Площадь здания</p>
                                <p class="infographics__value">{{ $ad->object->building_area }} м<sup>2</sup></p>
                            </div>
                        </div>
                    </div>
                @elseif ($ad->object_type == '\App\Models\LandPlot')
                    <div>
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

        <div class="container__second-body">
            <div>
                <div>
                    <h5>Об участке</h5>

                    {{--FOR LANDPLOT--}}
                    @if ($ad->object_type == '\App\Models\LandPlot')
                        <div>
                            <p>Состояние участка: {{ $ad->object->status }}</p>
                        </div>
                    @elseif ($ad->object_type == '\App\Models\House')
                        <div>
                            <p>Площадь участка составляет {{ $ad->object->plot_area }} сот.</p>
                            <p>Состояние участка: {{ $ad->object->plot_status }}</p>
                        </div>
                    @endif

                    <div>
                        <h5>Удобства</h5>

                        <div>
                            <p>На объекте недвижимости присутствуют следующие удобства:</p>
                            <ul class="ad__characteristics">
                                @if (App\Models\ObjectAndCharacteristics::where('object_id', $ad->object()->first()->id)->get() != null)
                                    @foreach(App\Models\ObjectAndCharacteristics::where('object_id', $ad->object()->first()->id)->get() as $item)
                                        <li>{{ $item->characteristic->name }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const userInfo = document.querySelector('.body__user'),
            header = document.getElementById("header");

        window.onscroll = () => {
            let headerHeight = header.clientHeight;

            if (window.scrollY >= headerHeight) {
                userInfo.classList.add("change-fixed");
            } else {
                userInfo.classList.remove("change-fixed");
            }
        };
    </script>
@endpush
