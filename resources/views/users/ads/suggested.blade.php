@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Ваши объявления на рассмотрении')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <div class="headers">
            <h3>Ваши объявления на рассмотрении</h3>
            <a href="{{ route('users.account') }}" class="btn btn-filled">Назад</a>
        </div>

        <div class="last-suggested-ads">
            <div class="last-suggested-ads__inner">
                @forelse($ads as $ad)
                    <div class="ad common">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__inner">
                                <div class="info__header">
                                    <h5>{{ $ad->getNameOfObject() }}</h5>
                                    <div>
                                        <p>{{ $ad->getCorrectObjectType() }}</p>
                                        <p>{{ $ad->contract->name }}</p>
                                    </div>
                                </div>

                                <p class="info__description">{{ $ad->description }}</p>

                                <div class="info__price">
                                    <h5>{{ $ad->getCorrectPrice() }}</h5>
                                </div>
                            </div>

                            {{--BUTTONS--}}
                            <div class="ad__buttons">
                                {{--BUTTON TO SHOW--}}
                                <a href="{{ route('ads.show', $ad->id) }}"
                                   class="btn btn-outlined btn-edit">Посмотреть</a>
                                   
                                {{--BUTTON TO DELETE--}}
                                <a href="{{ route('ads.delete', $ad->id) }}"
                                class="btn btn-danger">Удалить</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет последних объявлений на рассмотрении</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
<style>
    footer {
        margin: 30px 10% 0 10% !important;
    }
</style>