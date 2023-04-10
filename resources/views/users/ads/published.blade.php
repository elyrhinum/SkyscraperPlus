@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Ваши опубликованные объявления')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <div class="headers">
            <h3>Ваши опубликованные объявления</h3>
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

                        {{--BUTTON TO SHOW--}}
                        <div class="ad__buttons">
                            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет опубликованных объявлений</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
