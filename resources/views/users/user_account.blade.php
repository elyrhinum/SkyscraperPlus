@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/user_account.css') }}">
@section('title', 'Аккаунт')
@section('content')
    <h3>Личный аккаунт</h3>

    <div class="container">
        <div class="container__personal-info">
            @foreach($users as $user)
                <div class="personal-info__text">
                    <h3>{{ $user->fullName }}</h3>
                    <p>E-mail: {{ $user->email }}</p>
                    <p>Телефон: {{ $user->telephone }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection
