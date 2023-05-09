<footer>
    <div class="footer__inner">
        {{--CONTACTS--}}
        <div class="footer__contacts">
            <span>Контактные данные:</span>
            <span>Рахимьянова Мария Юрьевна</span>
            <span>Телефон: +7(900)000-00-00</span>
            <span>E-mail: oktiabor.82@mail.ru</span>
        </div>

        {{--NAVBAR--}}
        <div class="footer__navbar">
            <ul class="navbar__list">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ads.sale') }}">Продажа</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ads.rent') }}">Аренда</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('complexes.index') }}">Жилые комплексы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('documents.index') }}">Юридические документы</a>
                </li>
            </ul>
        </div>
    </div>
    <p>2023 ВысоткаПлюс © Все права защищены</p>
</footer>
