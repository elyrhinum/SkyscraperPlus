<header class="pd">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="background-color: white">
            <a class="navbar-brand" href="{{ route('ads.index') }}">
                <img src="{{ asset('/media/icons/logo.svg') }}" alt="Логотип" id="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Продажа</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Аренда</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rcs.index') }}">Жилые комплексы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Риелторы</a>
                    </li>
                </ul>
                @guest
                    <div class="buttons">
                        <span class="navbar-text">
                            <a class="btn btn-outlined" href="{{ route('users.create') }}">Зарегистрироваться</a>
                        </span>
                        <span class="navbar-text" style="margin-left: 10px">
                            <a class="btn btn-filled" href="{{ route('users.login') }}">Войти</a>
                        </span>
                    </div>
                @endguest
                @auth
                    <div class="buttons">
                        <span class="navbar-text">
                            <a class="btn btn-filled" href="{{ route('ads.preCreate') }}">Подать объявление</a>
                        </span>
                        @if(auth()->user()->role_id == 1)
                            <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-outlined" href="{{ route('users.user.account') }}">Мой аккаунт</a>
                            </span>
                        @elseif(auth()->user()->role_id == 2)
                            <span class="navbar-text">
                            <a class="btn btn-filled" style="margin-left: 10px" href="{{ route('complexes.create') }}">Добавить ЖК</a>
                        </span>
                            <span class="navbar-text" style="margin-left: 10px">
                                <a class="btn btn-outlined" href="{{ route('users.realtor.account') }}">Мой аккаунт</a>
                            </span>
                        @endif
                        <span class="navbar-text" style="margin-left: 10px">
                            <a class="btn btn-outlined" href="{{ route('users.logout') }}">Выйти</a>
                        </span>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>

