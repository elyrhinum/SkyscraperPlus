@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/user_account.css') }}">
@section('title', 'Аккаунт')
@section('content')
    <h3>Личный аккаунт</h3>

    <div class="main-container pd">
        <h3 id="main-header">Личный аккаунт</h3>

        @include('inc.message')

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

                    <div class="blocks__links">

                    </div>
                </div>
            </div>

            @include('users.account_sidebar')
        </div>
    </div>
@endsection
