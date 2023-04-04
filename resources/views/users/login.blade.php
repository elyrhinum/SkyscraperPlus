@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/login.css') }}">
@section('title', 'Войти')
@section('content')
    <div class="main-container pd">
        <form action="{{ route('users.verification') }}" method="post">
            @csrf

            <h3>Войдите в аккаунт</h3>

            {{-- INPUTS --}}
            <label for="login">
                <input type="text" name="login" id="login" placeholder="Логин"
                       class="form-control @error('login') is-invalid @enderror">
            </label>
            <label for="password">
                <input type="password" name="password" id="password" placeholder="Пароль"
                       class="form-control @error('password') is-invalid @enderror">
            </label>

            {{-- ERRORS --}}
            @error('errorLogin')
            <span>{{ $message }}</span>
            @enderror
            @error('login')
            <span>{{ $message }}</span>
            @enderror

            <div class="buttons-login">
                <button class="btn btn-filled btn-login">Войти</button>
                <p class="mt-2 mb-2">или</p>
                <a class="btn btn-outlined" href="{{ route('users.create') }}">Зарегистрироваться</a>
            </div>
        </form>
    </div>
@endsection
