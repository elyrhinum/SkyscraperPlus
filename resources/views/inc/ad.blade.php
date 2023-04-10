<div class="ad">
    {{--IMAGE--}}
    <div class="ad__image">
        <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
    </div>

    {{--AD INFO--}}
    <div class="ad__info">
        {{--INFO--}}
        <div class="ad__header">
            <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
            <div>
                <p>{{ $ad->getCorrectObjectType() }}</p>
                <p>{{ $ad->contract->name }}</p>
                <p>Дата публикации: {{ $ad->dateOfUpdating }}</p>
            </div>
            <p class="info__description">{{ $ad->description }}</p>
            <h5 class="info__price">{{ $ad->getCorrectPrice() }}</h5>
        </div>

        {{--BUTTONS--}}
        <div class="info__buttons">
            @if (auth()->user() !== null)
                <div class="btn btn-save" data-ad="{{ $ad->id }}"
                     data-bookmarked="{{ auth()->check() ? auth()->user()->isBookmarked($ad->id) : 'false' }}">
                    <img src="{{ auth()->user()->isBookmarked($ad->id) == 'true'?
                                asset('/media/icons/saved/filled.svg') :
                                asset('/media/icons/saved/outlined.svg')}}" alt="Избранное">
                </div>
            @endif
            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-filled">Посмотреть</a>
        </div>
    </div>

    {{--USER INFO--}}
    <div class="ad__user">
        <p class="user__full-name">{{ $ad->user->fullName }}</p>
        <p class="user__role">{{ $ad->user->role->name }}</p>
        <div class="user__contacts">
            <p>{{ $ad->user->telephone }}</p>
            <p>{{ $ad->user->email }}</p>
        </div>
    </div>
</div>

<style>
    .ad {
        display: grid;
        grid-template-columns: 250px 5fr 200px;
        gap: 10px;

        width: 100%;
        height: 272px;

        background-color: white;
        border: 1px solid rgba(211, 211, 211, 0.5);
        padding: 10px;
    }

    .ad__header > div {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 10px;

        width: fit-content;
        opacity: 70%;

        margin-bottom: 20px;
    }

    .info__header {
        margin-bottom: 0;
    }

    .info__description {
        width: 100%;
        margin-bottom: 20px !important;
    }

    .info__price {
        font-size: 26px;
    }

    .ad__image {
        width: fit-content;
        height: fit-content;
    }

    .ad__image > img {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 3px;
    }

    /*INFO*/
    .ad__info {
        display: grid;
        grid-auto-rows: 3fr 35px;
        gap: 10px;
    }

    /*BUTTONS*/
    .info__buttons {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

    .info__buttons > a {
        width: fit-content;
    }

    .btn-filled {
        height: 35px;
    }

    /*SAVE BUTTON*/
    .btn-save {
        padding: 0;
        border: 0;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn-save > img {
        height: 47px;
        object-fit: cover;

        margin-top: -7px;
    }

    /*USER INFO*/
    .ad__user {
        padding: 10px;
        border-left: 1px solid rgba(211, 211, 211, 0.5);
    }

    .user__full-name {
        font-size: 16px;
        font-weight: 500;

        margin: 0;
    }

    .user__role {
        opacity: 70%;
    }

    .user__contacts > p {
        margin: 0;
    }
</style>
