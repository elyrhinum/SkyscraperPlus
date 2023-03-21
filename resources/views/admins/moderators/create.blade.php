@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/moderators/create.css') }}">
@section('title', 'Список модераторов')
@section('content')
    <div class="main-container">
        <h5>Регистрация модератора</h5>

        <form action="{{ route('moderators.store') }}" method="post">
            @csrf

            <div class="inputs input-name">
                <label for="name">Имя <sup class="required-mark">*</sup>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Иван"
                           class="form-control name @error('name') is-invalid @enderror">
                </label>
                <span>Кириллица, пробелы и тире</span>
                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputs input-surname">
                <label for="surname">Фамилия <sup class="required-mark">*</sup>
                    <input type="text" name="surname" value="{{ old('surname') }}" placeholder="Иванов"
                           class="form-control surname @error('surname') is-invalid @enderror">
                </label>
                <span>Кириллица, пробелы и тире</span>
                @error('surname')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputs input-patronymic">
                <label for="patronymic">Отчество
                    <input type="text" name="patronymic" value="{{ old('patronymic') }}" placeholder="Иванович"
                           class="form-control patronymic @error('patronymic') is-invalid @enderror">
                </label>
                <span>Кириллица, пробелы и тире</span>
                @error('patronymic')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputs input-login">
                <label for="login">Логин <sup class="required-mark">*</sup>
                    <input type="text" name="login" value="{{ old('login') }}" placeholder="eXampl3"
                           class="form-control login @error('login') is-invalid @enderror">
                </label>
                <span>Английский алфавит и цифры</span>
                @error('login')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputs input-password">
                <label for="password">Пароль <sup class="required-mark">*</sup>
                    <input type="password" name="password"
                           class="form-control password @error('password') is-invalid @enderror">
                </label>
                <span>Должен содержать минимум одну заглавную и прописную буквы, цифру</span>
                @error('password')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputs input-confirmation">
                <label for="password">Повторите пароль <sup class="required-mark">*</sup>
                    <input type="password" name="password_confirmation"
                           class="form-control password_confirmation @error('password_confirmation') is-invalid @enderror">
                </label>
                @error('password_confirmation')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <p class="required-instruction"><sup class="required-mark">*</sup> - поле обязательно для заполнения</p>

            <button class="btn btn-filled" id="btn-create-moder">Зарегистрировать</button>
        </form>
    </div>
@endsection
