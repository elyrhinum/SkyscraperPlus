<footer>
    <div class="footer__inner">
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
                    <a class="nav-link" href="{{ route('users.realtors.index') }}">Риелторы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('documents.index') }}">Юридические документы</a>
                </li>
            </ul>
        </div>

        {{--CONTACTS--}}
        <div class="footer__contacts">
            <span>Контактные данные:</span>
            <span>Рахимьянова Мария Юрьевна</span>
            <span>Телефон: +7(900)000-00-00</span>
            <span>E-mail: oktiabor.82@mail.ru</span>
        </div>
    </div>
    <p>2023 ВысоткаПлюс © Все права защищены</p>
</footer>

<style>
    /*FOOTER*/
    footer {
        flex: 0 0 auto;

        font-size: 14px;
        font-weight: 500;
        font-family: var(--main-font);

        margin: 30px 10% 0 10%;
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
        height: fit-content;
        list-style: none;
    }
    
    /*PC STYLES*/
    @media (min-width: 1200px) {
        /*FOOTER*/
        .footer__inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    /*TABLET STYLES*/
    @media (max-width: 1200px) {
        /*FOOTER*/
        .footer__inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /*PHONE STYLES*/
    @media (max-width: 770px) {
        /*FOOTER*/
        .footer__inner {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>
