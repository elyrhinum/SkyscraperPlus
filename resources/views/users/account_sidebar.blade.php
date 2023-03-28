@php
    use App\Models\Ad;
    use App\Models\User;
    use App\Models\ResidentialComplex;

    $ads = Ad::where('user_id', auth()->user()->id)->get();
@endphp

<div class="main-info__navigation">
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/suggested.png') }}" alt="Предложенные">
        <div>
            <p>На рассмотрении</p>
            @if(count($ads->where('status_id', 2)) > 0)
                <span>{{ count($ads->where('status_id', 2)) }}</span>
            @endif
        </div>
    </a>
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/published.png') }}" alt="Опубликованные">
        <div>
            <p>Опубликованные</p>
            @if(count($ads->where('status_id', 1)) > 0)
                <span>{{ count($ads->where('status_id', 1)) }}</span>
            @endif
        </div>
    </a>
    <a href="" class="navigation__link">
        <img src="{{ asset('/media/icons/realtor_account/rejected.png') }}" alt="Отклоненные">
        <div>
            <p>Отклоненные</p>
            @if(count($ads->where('status_id', 3)) > 0)
                <span>{{ count($ads->where('status_id', 3)) }}</span>
            @endif
        </div>
    </a>
</div>

<style>
    .main-info__navigation {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-content: center;

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
        margin-bottom: 10px !important;
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

        margin-top: 1px !important;
    }

    .navigation__link > img {
        width: 18px;
        height: 18px;
        object-fit: cover;

        margin-right: 10px;
    }
</style>
