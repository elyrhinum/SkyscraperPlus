@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/create.css') }}">
@section('title', 'Регистрация')
@section('content')
    <div class="main-container pd common mt-4">
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

                <div class="checkboxes">
                    <label for="agreement">
                        <input type="checkbox" name="agreement" id="agreement">Я согласен(-на) с&nbsp;<a href="{{ $agreement != null ? $agreement->document : '#' }}">пользовательским соглашением</a>
                    </label>
                    <label for="personal-data">
                        <input type="checkbox" name="politics" id="politics">Я согласен(-на) с&nbsp;<a href="{{ $politics != null ? $politics->document : '#' }}">политикой конфиденциальности</a>
                    </label>
                </div>

                <div class="btn-signup">
                    <button class="btn btn-filled" id="btn-signup-user">Зарегистрироваться</button>
                </div>
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
                    <p>Фотография</p>
                    <label for="image" class="label-image">
                        <p>ЗАГРЗУИТЕ ФОТОГРАФИЮ</p>
                        <input type="file" name="image" id="image"
                            accept="image/jpg, image/jpeg, image/png"
                            class="form-control image @error('image') is-invalid @enderror">
                        <p id="image-prev"></p>
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

                <div class="checkboxes">
                    <label for="agreement">
                        <input type="checkbox" name="agreement" id="agreement">Я согласен(-на) с&nbsp;<a href="{{ $agreement->document }}" class="checkboxes__link">пользовательским соглашением</a>
                    </label>
                    <label for="personal-data">
                        <input type="checkbox" name="politics" id="politics">Я согласен(-на) с&nbsp;<a href="{{ $politics->document }}" class="checkboxes__link">политикой конфиденциальности</a>
                    </label>
                </div>

                <div class="btn-signup">
                    <button class="btn btn-filled" id="btn-signup-realtor">Зарегистрироваться</button>
                </div>
            </form>`,
                target: 'tab-2'
            }
        ];

        const tabHeader = document.querySelector('.tab-header'),
            tabBody = document.querySelector('.tab-body__item');

        let count = 0;

        if (sessionStorage.getItem('currentTab') == null) {
            sessionStorage.setItem('currentTab', 0);
        }

        // TELEPHONE MASK
        const telephoneMask = (element) => {
            const maskOptions_1 = {
                mask: '+{7}(000)000-00-00'
            };
            IMask(element, maskOptions_1);
        }

        // IMAGE PREVIEW
        const imagePreview = () => {
            const imageInput = document.getElementById('image'),
                imagePrev = document.getElementById('image-prev');

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

        }

        const disableButton = () => {
            let signupBtn;
            if (sessionStorage.getItem('currentTab') == 0) {
                signupBtn = document.querySelector('#btn-signup-user');
            } else if (sessionStorage.getItem('currentTab') == 1) {
                signupBtn = document.querySelector('#btn-signup-realtor');
            }
            signupBtn.disabled = true;

            document.getElementById('politics').addEventListener('input', (e) => {
                if (document.getElementById('politics').checked === true && document.getElementById('agreement').checked === true) {
                    signupBtn.disabled = false;
                }
            });

            document.getElementById('agreement').addEventListener('input', (e) => {
                if (document.getElementById('politics').checked === true && document.getElementById('agreement').checked === true) {
                    signupBtn.disabled = false;
                }
            });
        }

        const start = () => {
            tabHeader.children[sessionStorage.getItem('currentTab')].classList.add('active');
            tabBody.innerHTML = `${tabs[sessionStorage.getItem('currentTab')].body}`;
            const element_1 = document.querySelector(".telephone");

            disableButton();
            telephoneMask(element_1);
            imagePreview();
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

            sessionStorage.setItem('currentTab', currentHeader.dataset.target);

            const element_1 = document.querySelector(".telephone");

            disableButton();
            telephoneMask(element_1);
            imagePreview();
        }

        tabs.forEach(tab => {
            let divHeader = createElement('div', ['tab-header__item'], `<span>${tab.header}</span>`)
            divHeader.dataset.target = count;
            divHeader.addEventListener('click', doActiveTab)
            tabHeader.append(divHeader);
            count++;
        })

        start();
    </script>
@endpush
