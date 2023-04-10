@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/create.css') }}">
@section('title', 'Регистрация')
@section('content')
    <div class="main-container common pd mt-4">
        <h3>Редактирование профиля</h3>

        <form action="{{ route('users.update', auth()->user()) }}" method="post" enctype="multipart/form-data">
            @csrf

            {{--NAME--}}
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

            {{--SURNAME--}}
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

            {{--PATRONYMIC--}}
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

            {{--EMAIL--}}
            <div class="inputs input-email">
                <label for="email">E-mail <sup class="required-mark">*</sup>
                    <input type="email" name="email" value="{{ old('email') ?? $user->email }}"
                           placeholder="example@gmail.com"
                           class="form-control email @error('email') is-invalid @enderror">
                </label>
                @error('email')
                <span>{{ $message }}</span>
                @enderror
            </div>

            {{--TELEPONE--}}
            <div class="inputs input-telephone">
                <label for="telephone">Телефон <sup class="required-mark">*</sup>
                    <input type="text" name="telephone" value="{{ old('telephone') ?? $user->telephone }}"
                           placeholder="+7(000)000-00-00"
                           id="telephone" class="form-control telephone @error('telephone') is-invalid @enderror">
                </label>
                @error('telephone')
                <span>{{ $message }}</span>
                @enderror
            </div>

            {{--IMAGE--}}
            @if($user->role->name == 'Риелтор')
                <div class="inputs input-image">
                    <p>Фотография</p>
                    <label for="image" class="label-image">
                        <p>ЗАГРУЗИТЕ ФОТОГРАФИЮ</p>
                        <input type="file" name="image" id="image"
                               accept="image/jpg, image/jpeg, image/png"
                               class="form-control image @error('image') is-invalid @enderror">
                        <div id="image-prev">
                            <img src="{{ $user->image }}" alt="{{ $user->name }}">
                        </div>
                    </label>
                    @error('image')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            @endif

            {{--LOGIN--}}
            <div class="inputs input-login">
                <label for="login">Логин <sup class="required-mark">*</sup>
                    <input type="text" name="login" value="{{ old('login') ?? $user->login }}" placeholder="eXampl3"
                           class="form-control login @error('login') is-invalid @enderror">
                </label>
                <span>Английский алфавит и цифры</span>
                @error('login')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <p class="required-instruction"><sup class="required-mark">*</sup> - поле обязательно для заполнения</p>

            <button class="btn brn-filled btn-signup">Редактировать</button>
        </form>
    </div>
@endsection
@push('script')
    <script src="{{ asset('/js/mask-connection.js') }}"></script>

    <script>
        const element = document.getElementById('telephone'),
            imageInput = document.getElementById('image'),
            imagePrev = document.getElementById('image-prev');

        // TELEPHONE MASK
        const maskOptions = {
            mask: '+{7}(000)000-00-00'
        };
        const mask_1 = IMask(element, maskOptions);

        // RENDERING IMAGE PREVIEW
        imageInput.addEventListener('change', (e) => {
            imagePrev.innerHTML = ''
            let image = document.createElement('img')
            image.style.display = 'block'
            image.style.width = '350px'
            image.style.height = '350px'
            image.style.objectFit = 'cover'
            image.src = URL.createObjectURL(e.target.files[0])
            image.alt = "img"
            imagePrev.append(image)
        })
    </script>
@endpush
