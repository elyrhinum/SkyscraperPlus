<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--CSS--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admins/login.css') }}">

    {{-- FAVICON --}}
    <link type="image/x-icon" href="{{asset('/media/icons/favicon.svg') }}" rel="shortcut icon">
    <link type="Image/x-icon" href="{{asset('/media/icons/favicon.svg')}}" rel="icon">

    <title>Вход в панель администратора</title>
    <style>
        #password {
            margin-bottom: 0 !important;
        }

        .btn-login {
            margin-top: 20px !important;
        }
    </style>
</head>
<body style="background-image: url({{asset('/media/images/admin_login_banner.jpg')}});">
<div class="main-container">
    <form action="{{ route('admins.verification') }}" method="post" class="common">
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

        <button class="btn btn-filled btn-login">Войти</button>
    </form>
</div>
</body>
</html>
