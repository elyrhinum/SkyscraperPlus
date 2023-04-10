@php
    use App\Models\Ad;
    use App\Models\User;
    use App\Models\ResidentialComplex;

    $ads = Ad::where('user_id', auth()->user()->id)->get();
@endphp

<div class="main-info__navigation">
    <a href="{{ route('users.onlySuggestedAds') }}" class="navigation__link">
        <img src="{{ asset('/media/icons/account/suggested.png') }}" alt="Предложенные">
        <div>
            <p>На рассмотрении</p>
            @if(count($ads->where('status_id', 2)) > 0)
                <span>{{ count($ads->where('status_id', 2)) }}</span>
            @endif
        </div>
    </a>
    <a href="{{ route('users.onlyPublishedAds') }}" class="navigation__link">
        <img src="{{ asset('/media/icons/account/published.png') }}" alt="Опубликованные">
        <div>
            <p>Опубликованные</p>
            @if(count($ads->where('status_id', 1)) > 0)
                <span>{{ count($ads->where('status_id', 1)) }}</span>
            @endif
        </div>
    </a>
    <a href="{{ route('users.onlyCancelledAds') }}" class="navigation__link">
        <img src="{{ asset('/media/icons/account/rejected.png') }}" alt="Отклоненные">
        <div>
            <p>Отклоненные</p>
            @if(count($ads->where('status_id', 3)) > 0)
                <span>{{ count($ads->where('status_id', 3)) }}</span>
            @endif
        </div>
    </a>
    <a href="{{ route('users.bookmarks') }}" class="navigation__link">
        <img src="{{ asset('/media/icons/account/saved.png') }}" alt="Закладки">
        <div>
            <p>Закладки</p>
        </div>
    </a>
</div>

<style>
    .main-info__navigation {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-content: center;
        gap: 10px;

        background-color: white;
        padding: 15px;

        border-radius: 3px;
        border: 1px solid rgba(211, 211, 211, 0.5);
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
        border-radius: 3px;

        padding: 8px;
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
