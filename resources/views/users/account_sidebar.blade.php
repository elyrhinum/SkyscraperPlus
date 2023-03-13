<div class="main-info__navigation">
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/suggested.png') }}" alt="Предложенные">
        <div>
            <p>На рассмотрении</p>
            <span>8</span>
        </div>
    </a>
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/published.png') }}" alt="Опубликованные">
        <div>
            <p>Опубликованные</p>
            <span>18</span>
        </div>
    </a>
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/rejected.png') }}" alt="Отклоненные">
        <div>
            <p>Отклоненные</p>
            <span>2</span>
        </div>
    </a>
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/saved.png') }}" alt="Избранное">
        <div>
            <p>Избранное</p>
            <span>56</span>
        </div>
    </a>
</div>

<style>
    .main-info__navigation {
        background-color: white;
        border-radius: 5px;
        padding: 15px;
    }

    .navigation__link {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;

        font-family: HelveticaNeueCyr;
        font-size: 14px;
        font-weight: 500;
        color: black;
        text-decoration: none;

        border: 1px solid #384F66;
        border-radius: 5px;

        padding: 8px;
        margin-bottom: 10px;
    }

    .navigation__link > div {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
    }

    .navigation__link > div > p {
        padding-right: 10px;
        margin: 0 !important;
    }

    .navigation__link > div > span {
        font-size: 10px;
        opacity: 50%;
    }

    .navigation__link > img {
        width: 18px;
        height: 18px;
        object-fit: cover;

        margin-right: 10px;
    }
</style>
