@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/create.css') }}">
@section('title', 'Регистрация')
@section('content')
    <div class="main-container pd mt">
        <h3>Зарегистрироваться как</h3>

        {{-- TABS --}}
        <div class="tabs">
            <span id="word">или</span>
            <div class="tab-header"></div>
        </div>


        {{-- FORMS --}}
        <div class="tab-body">
            <div class="tab-body__item"></div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('/js/mask-connection.js') }}"></script>

    <script>
        // FORM RENDERING
        let tabs = [
            {
                header: 'Пользователь',
                body: `<form action="{{ route('users.storeUser') }}" method="post">
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

                <div class="inputs input-email">
                    <label for="email">E-mail <sup class="required-mark">*</sup>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                                   class="form-control email @error('email') is-invalid @enderror">
                        </label>
                        @error('email')
                <span>{{ $message }}</span>
                        @enderror
                </div>

                <div class="inputs input-telephone">
                    <label for="telephone">Телефон <sup class="required-mark">*</sup>
                        <input type="text" name="telephone" value="{{ old('telephone') }}" placeholder="+7(000)000-00-00"
                                   class="form-control telephone @error('telephone') is-invalid @enderror">
                        </label>
                        @error('telephone')
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

                <button class="btn btn-filled btn-signup">Зарегистрироваться</button>
            </form>`,
                target: 'tab-1'
            },
            {
                header: 'Риелтор',
                body: `<form action="{{ route('users.storeRealtor') }}" method="post" enctype="multipart/form-data">
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

                <div class="inputs input-email">
                    <label for="email">E-mail <sup class="required-mark">*</sup>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                                   class="form-control email @error('email') is-invalid @enderror">
                        </label>
                        @error('email')
                <span>{{ $message }}</span>
                        @enderror
                </div>

                <div class="inputs input-telephone">
                    <label for="telephone">Телефон <sup class="required-mark">*</sup>
                        <input type="text" name="telephone" value="{{ old('telephone') }}" placeholder="+7(000)000-00-00"
                                   class="form-control telephone @error('telephone') is-invalid @enderror">
                        </label>
                        @error('telephone')
                <span>{{ $message }}</span>
                        @enderror
                </div>

                <div class="inputs input-image">
                    <label for="name">Фотография
                        <input type="file" name="image"
                               class="form-control image @error('image') is-invalid @enderror">
                        </label>
                        @error('image')
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

                <button class="btn brn-filled btn-signup">Зарегистрироваться</button>
            </form>`,
                target: 'tab-2'
            }
        ];

        const tabHeader = document.querySelector('.tab-header'),
            tabBody = document.querySelector('.tab-body__item');

        let count = 0;

        // TELEPHONE MASK
        const telephoneMask = (element) => {
            const maskOptions_1 = {
                mask: '+{7}(000)000-00-00'
            };
            IMask(element, maskOptions_1);
        }

        const start = () => {
            tabHeader.firstChild.classList.add('active');
            tabBody.innerHTML = `${tabs[0].body}`;
            const element_1 = document.querySelector(".telephone");
            telephoneMask(element_1);
        }

        const createElement = (item, classes, template) => {
            let element = document.createElement(item);
            element.classList.add(...classes);
            element.innerHTML = template;
            return element;
        }

        const clearTab = () => {
            [...tabHeader.children].forEach(item => {
                item.classList.remove('active')
            });
        }

        const doActiveTab = (e) => {
            clearTab();
            let currentHeader = e.target.closest('div.tab-header__item');
            currentHeader.classList.add('active');
            let currentBody = tabs[currentHeader.dataset.target];
            tabBody.innerHTML = `<div>${currentBody.body}</div>`;

            const element_1 = document.querySelector(".telephone");
            telephoneMask(element_1);
        }

        tabs.forEach(tab => {
            let divHeader = createElement('div', ['tab-header__item'], `<span>${tab.header}</span>`)
            divHeader.dataset.target = count;
            divHeader.addEventListener('click', doActiveTab)
            tabHeader.append(divHeader);
            count++;
        })

        start();
        telephoneMask();
    </script>
@endpush
