@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/moderators/index.css') }}">
@section('title', 'Список модераторов')
@section('content')
    <div class="main-container">
        <div class="title">
            <h5>Список модераторов</h5>

            {{--BUTTON TO SIGNUP MODERATOR--}}
            <a href="{{ route('moderators.create') }}" class="btn btn-filled btn-create-moder">Добавить модератора</a>
        </div>

        {{--MESSAGE--}}
        @include('inc.message')

        <div class="cards">
            @foreach($moderators as $moderator)
                <div class="cards__card">
                    <div class="card__header">
                        <p>{{ $moderator->fullName }}</p>
                    </div>
                    <div class="card__info">
                        <p>Логин: {{ $moderator->login }}</p>
                    </div>
                    <div class="card__footer">
                        <button class="btn btn-filled">Редактировать</button>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
