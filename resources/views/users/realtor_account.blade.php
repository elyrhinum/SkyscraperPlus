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
                <a href="{{ route('users.realtor.edit', auth()->user()) }}" class="btn btn-filled">Редактировать данные</a>
            </div>

            {{--SIDEBAR WITH LINKS--}}
            @include('users.account_sidebar')
        </div>
    </div>

@endsection
