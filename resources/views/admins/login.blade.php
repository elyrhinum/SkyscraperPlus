@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('title', 'ВысоткаПлюс')
@section('content')
    <h3>Войдите в аккаунт</h3>

    <form action="#" method="post" class="login-form">
        @csrf

        {{-- INPUTS --}}
        <label for="login">Логин:
            <input type="text" name="login" id="login" @error('login') is-invalid @enderror>
        </label>
        <label for="login">Пароль:
            <input type="password" name="password" id="password" @error('password') is-invalid @enderror>
        </label>

        {{-- ERRORS --}}
        @error('errorLogin')
        <span>{{ $message }}</span>
        @enderror
        @error('login')
        <span>{{ $message }}</span>
        @enderror

        <button class="btn btn-signup">Войти</button>
    </form>
@endsection
