<header class="pd" id="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="background-color: white">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('/media/icons/logo.svg') }}" alt="Логотип" id="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ads.sale') }}">Продажа</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ads.rent') }}">Аренда</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('complexes.index') }}">Жилые комплексы</a>
                    </li>
                </ul>
                @guest
                    <div class="buttons">
                        <span class="navbar-text">
                            <a class="btn btn-outlined" href="{{ route('users.create') }}">Зарегистрироваться</a>
                        </span>
                        <span class="navbar-text">
                            <a class="btn btn-filled" href="{{ route('users.login') }}">Войти</a>
                        </span>
                    </div>
                @endguest
                @auth
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <div class="buttons">
                            <span class="navbar-text">
                                <a class="btn btn-filled" href="{{ route('ads.preCreate') }}">Подать объявление</a>
                            </span>
                            <span class="navbar-text">
                                <a class="btn btn-filled" style="margin-left: 10px"
                                   href="{{ route('complexes.create') }}">Добавить ЖК</a>
                            </span>
                            <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-outlined" href="{{ route('users.account') }}">Мой аккаунт</a>
                            </span>
                            <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-outlined" href="{{ route('users.logout') }}">Выйти</a>
                            </span>
                        </div>
                    @elseif (auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                        <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-filled" href="{{ route('admins.index') }}">Вернуться на панель администратора</a>
                            </span>
                        <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-outlined" href="{{ route('users.logout') }}">Выйти</a>
                            </span>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
</header>

