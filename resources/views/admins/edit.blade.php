@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/moderators/create.css') }}">
@section('title', 'Редактирование данных пользователя')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <div id="title">
                <h5>Редактирование данных пользователя</h5>
            </div>


            <form action="{{ route('admins.user.update', $user->id) }}" method="post">
                @csrf

                <div class="inputs input-name">
                    <label for="name">Имя <sup class="required-mark">*</sup>
                        <input type="text" name="name" value="{{ old('name') ?? $user->name }}" placeholder="Иван"
                               class="form-control name @error('name') is-invalid @enderror">
                    </label>
                    <span>Кириллица, пробелы и тире</span>
                    @error('name')
                    <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputs input-surname">
                    <label for="surname">Фамилия <sup class="required-mark">*</sup>
                        <input type="text" name="surname" value="{{ old('surname') ?? $user->surname }}"
                               placeholder="Иванов"
                               class="form-control surname @error('surname') is-invalid @enderror">
                    </label>
                    <span>Кириллица, пробелы и тире</span>
                    @error('surname')
                    <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputs input-patronymic">
                    <label for="patronymic">Отчество
                        <input type="text" name="patronymic" value="{{ old('patronymic') ?? $user->patronymic }}"
                               placeholder="Иванович"
                               class="form-control patronymic @error('patronymic') is-invalid @enderror">
                    </label>
                    <span>Кириллица, пробелы и тире</span>
                    @error('patronymic')
                    <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputs input-login">
                    <label for="login">Логин <sup class="required-mark">*</sup>
                        <input type="text" name="login" value="{{ old('login') ?? $user->login }}"
                               placeholder="eXampl3"
                               class="form-control login @error('login') is-invalid @enderror">
                    </label>
                    <span>Английский алфавит и цифры</span>
                    @error('login')
                    <span>{{ $message }}</span>
                    @enderror
                </div>

                <p class="required-instruction"><sup class="required-mark">*</sup> - поле обязательно для заполнения</p>

                <button class="btn btn-filled">Обновить</button>
            </form>
        </div>
    </div>
@endsection
