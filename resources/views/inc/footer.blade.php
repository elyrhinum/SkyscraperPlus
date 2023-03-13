<footer>
    <div class="footer__inner">
        <div class="footer__navbar">
            <ul class="navbar__list">
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
        </div>
        <div class="footer__contacts">
            <span>Контактные данные:</span>
            <span>Рахимьянова Мария Юрьевна</span>
            <span>Телефон: +7(900)000-00-00</span>
            <span>E-mail: oktiabor.82@mail.ru</span>
        </div>
    </div>
    <a href="{{ route('users.indexAdmin') }}">Перейти в панель администратора</a>
    <p>2023 ВысоткаПлюс © Все права защищены</p>
</footer>
