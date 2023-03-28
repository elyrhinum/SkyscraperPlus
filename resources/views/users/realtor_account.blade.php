@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/realtor_account.css') }}">
<link rel="stylesheet" href="{{ asset('css/users/ads_in_account.css') }}">
@section('title', 'Личный аккаунт')
@section('content')
    <div class="main-container pd">
        <h3 id="main-header">Личный аккаунт</h3>

        {{--MESSAGE--}}
        @include('inc.message')

        {{--INFORMATION ABOUT REALTOR--}}
        <div class="main-info">
            <div class="main-info__personal">
                <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->shortName }}">
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
                    <a href="{{ route('users.realtor.edit', auth()->user()) }}" class="btn btn-filled">Редактировать</a>
                </div>
            </div>

            {{--SIDEBAR WITH LINKS--}}
            @include('users.account_sidebar')
        </div>

        {{--LAST THREE SUGGESTED ADS--}}
        <div class="last-suggested-ads">
            <h5 class="title">Последние объявления на рассмотрении</h5>

            <div class="last-suggested-ads__inner">
                @forelse($suggested_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>
                        <div class="ad__info">
                            <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
                            <p class="info__description">{{ $ad->description }}</p>
                            <h5 class="info__price">{{ $ad->price }} ₽</h5>
                        </div>
                    </div>
                @empty
                    <p class="message-empty">Пока что нет последних объявлений на рассмотрении</p>
                @endforelse
            </div>
        </div>

        {{--LAST THREE PUBLISHED ADS--}}
        <div class="last-published-ads">
            <h5 class="title">Последние опубликованные объявления</h5>

            <div class="last-published-ads__inner">
                @forelse($published_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>
                        <div class="ad__info">
                            <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
                            <p class="info__description">{{ $ad->description }}</p>
                            <h5 class="info__price">{{ $ad->price }} ₽</h5>
                        </div>
                        <div class="ad__buttons">
                            <a href="" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <p class="message-empty">Пока что нет последних опубликованных объявлений</p>
                @endforelse
            </div>
        </div>

        {{--LAST THREE CANCELLED ADS--}}
        <div class="last-cancelled-ads">
            <h5 class="title">Последние отклоненные объявления</h5>

            <div class="last-cancelled-ads__inner">
                @forelse($cancelled_ads as $ad)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>
                        <div class="ad__info">
                            <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
                            <p class="info__description">{{ $ad->description }}</p>
                            <p>{{ $ad->getCorrectObjectType() }}</p>
                            <h5 class="info__price">{{ $ad->price }} ₽</h5>
                        </div>
                        <div class="ad__buttons">
                            <a href="" class="btn btn-outlined">Посмотреть</a>
                            <a href="" class="btn btn-danger">Скрыть</a>
                        </div>
                    </div>
                @empty
                    <p class="message-empty">Пока что нет последних отклоненных объявлений</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        const description = document.querySelectorAll('.info__description')

        description.forEach(elem=>{
            elem.textContent = limitStr(elem.textContent, 200)
        })
        function limitStr(str, n, symb) {
            if (!n && !symb ) return str;
            if (str.length<n) return str;
            symb = symb || '...';
            return str.substr(0, n - symb.length) + symb;
        }
    </script>
@endpush
