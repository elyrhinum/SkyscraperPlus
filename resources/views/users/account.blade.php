@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Личный аккаунт')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <h3 id="main-header">Личный аккаунт</h3>

        {{--ABOUT USER--}}
        <div class="main-info">
            <div class="main-info__personal {{ auth()->user()->role->name == 'Риелтор' ? 'for-realtor-account' : 'for-user-account' }}">
                {{--IMAGE--}}
                @if(auth()->user()->role->name == 'Риелтор')
                    <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->shortName }}">
                @endif

                {{--PERSONAL INFO--}}
                <div class="personal__blocks">
                    <div class="blocks__info">
                        <h3>{{ auth()->user()->fullName }}</h3>
                        <div>
                            <span>E-mail: {{ auth()->user()->email }}</span>
                            <span>Телефон: {{ auth()->user()->telephone }}</span>
                        </div>
                    </div>
                </div>
                <div class="main-info__button">
                    <a href="{{ route('users.edit', auth()->user()) }}" class="btn btn-outlined">Редактировать</a>
                </div>
            </div>

            {{--SIDEBAR--}}
            @include('inc.users.sidebar')
        </div>

        {{--LAST SUGGESTED ADS--}}
        <div class="last-suggested-ads">
            <h5 class="title">Последние объявления на рассмотрении</h5>

            <div class="last-suggested-ads__inner">
                @forelse($suggested_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__header">
                                <h5>{{ $ad->getNameOfObject() }}</h5>
                                <p>{{ $ad->getCorrectObjectType() }}</p>
                            </div>

                            <p class="info__description">{{ $ad->description }}</p>

                            <div class="info__price">
                                <h5>{{ $ad->getCorrectPrice() }}</h5>
                            </div>
                        </div>

                        {{--BUTTON TO SHOW--}}
                        <div class="ad__buttons">
                            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <div class="message-empty">
                        <p>Нет последних объявлений на рассмотрении</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{--LAST PUBLISHED ADS--}}
        <div class="last-published-ads">
            <h5 class="title">Последние опубликованные объявления</h5>

            <div class="last-published-ads__inner">
                @forelse($published_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__header">
                                <h5>{{ $ad->getNameOfObject() }}</h5>
                                <p>{{ $ad->getCorrectObjectType() }}</p>
                            </div>

                            <p class="info__description">{{ $ad->description }}</p>

                            <div class="info__price">
                                <h5>{{ $ad->getCorrectPrice() }}</h5>
                            </div>
                        </div>

                        {{--BUTTONS--}}
                        <div class="ad__buttons">
                            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <div class="message-empty">
                        <p>Нет последних опубликованных объявлений</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{--LAST CANCELLED ADS--}}
        <div class="last-cancelled-ads">
            <h5 class="title">Последние отклоненные объявления</h5>

            <div class="last-cancelled-ads__inner">
                @forelse($cancelled_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__header">
                                <h5>{{ $ad->getNameOfObject() }}</h5>
                                <p>{{ $ad->getCorrectObjectType() }}</p>
                            </div>

                            <p class="info__description">{{ $ad->description }}</p>
                            <p>{{ $ad->getCorrectObjectType() }}</p>

                            <div class="info__price">
                                <h5>{{ $ad->getCorrectPrice() }}</h5>
                            </div>
                        </div>

                        {{--BUTTONS--}}
                        <div class="ad__buttons">
                            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <div class="message-empty">
                        <p>Нет последних отклоненных объявлений</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{--LAST SUGGESTED COMPLEXES--}}
        <div class="last-suggested-complexes">
            <h5 class="title">Последние заявления на добавление жилого комплекса</h5>

            <div class="last-suggested-complexes__inner">
{{--                @forelse($suggested_complexes as $complex)--}}

{{--                @empty--}}
{{--                    <div class="message-empty">--}}
{{--                        <p>Нет последних заявлений на добавление жилого комплекса</p>--}}
{{--                    </div>--}}
{{--                @endforelse--}}
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        const description = document.querySelectorAll('.info__description')

        // CHARACTERS LIMIT
        description.forEach(elem => {
            elem.textContent = limitStr(elem.textContent, 200)
        })

        function limitStr(str, n, symb) {
            if (!n && !symb) return str;
            if (str.length < n) return str;
            symb = symb || '...';
            return str.substr(0, n - symb.length) + symb;
        }
    </script>
@endpush
