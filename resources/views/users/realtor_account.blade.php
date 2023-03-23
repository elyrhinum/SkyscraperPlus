@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/realtor_account.css') }}">
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
            <h5 class="title">Последние предложенные объявления</h5>

            <div class="last-suggested-ads__inner">
                @foreach($suggested_ads as $ad)
                <div class="ad">
{{--                    <p class="ad__header">{{ $ad->getNameOfAd }}</p>--}}
                </div>
                @endforeach
            </div>
        </div>

        {{--LAST THREE PUBLISHED ADS--}}
        <div class="last-published-ads">
            <h5 class="title">Последние опубликованные объявления</h5>

            @foreach($published_ads as $ad)
                <div class="ad">

                </div>
            @endforeach
        </div>

        {{--LAST THREE CANCELLED ADS--}}
        <div class="last-cancelled-ads">
            <h5 class="title">Последние отклоненные объявления</h5>

            @foreach($cancelled_ads as $ad)
                <div class="ad">

                </div>
            @endforeach
        </div>
    </div>

@endsection
