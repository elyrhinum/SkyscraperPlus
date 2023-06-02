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

<style>
    /*PC STYLES*/
    @media (min-width: 1200px) {
        /*FOOTER*/
        .footer__inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        footer {
            margin: 0 10% !important;
        }
    }

    /*PHONE STYLES*/
    @media (max-width: 770px) {
        /*FOOTER*/
        .footer__inner {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(2, 1fr);
        }
    }

    /*FOOTER*/
    footer {
        flex: 0 0 auto;

        font-size: 14px;
        font-weight: 500;
        font-family: var(--main-font);

        margin-top: 30px !important;
        padding-top: 30px !important;
        padding-bottom: 30px !important;

        border-top: 1px solid rgba(0, 0, 0, 0.6);

        opacity: 60%;
    }

    footer > a {
        font-size: 14px;
        font-weight: 600;
        font-family: var(--main-font);
        color: #212529;
    }

    footer > p {
        margin-top: 20px !important;
    }

     .footer__contacts {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;

        list-style: none;
        padding: 0 !important;
    }
</style>
