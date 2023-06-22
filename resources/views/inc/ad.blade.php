<div class="ad common">
    {{--IMAGE--}}
    <div class="ad__image">
        <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
    </div>

    {{--AD INFO--}}
    <div class="ad__info">
        {{--INFO--}}
        <div class="ad__header">
            <div>
                <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
                <div>
                    <p>{{ $ad->getCorrectObjectType() }}</p>
                    <p>{{ $ad->contract->name }}</p>
                    <p>Дата публикации: {{ $ad->dateOfUpdating }}</p>
                </div>
                <p class="info__description">{{ $ad->description }}</p>
            </div>

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
        <a href="{{ route('users.ads', $ad->user->id) }}" class="user__full-name">{{ $ad->user->fullName }}</a>
        <p class="user__role">{{ $ad->user->role->name }}</p>
        <div class="user__contacts">
            <p>{{ $ad->user->telephone }}</p>
            <p>{{ $ad->user->email }}</p>
        </div>
    </div>
</div>

<style>
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

    /*BUTTONS*/
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
        height: 47px;
        width: 47px !important  ;
    }

    .btn-save > img {
        height: 47px;
        width: 47px;
        object-fit: cover;

        margin-top: -7px;
    }

    /*USER INFO*/
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

    /*PC STYLES*/
    @media (min-width: 1200px) {
        /*AD*/
        .ad {
            display: grid;
            grid-template-columns: 250px 5fr 200px;
            gap: 10px;

            width: 100%;
            height: 272px;
            padding: 10px;
        }

        .ad__image > img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 3px;
        }

        .ad__header > div > div {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;

            width: fit-content;
            opacity: 70%;

            margin-bottom: 20px;
        }

        .ad__info {
            display: grid;
            grid-auto-rows: 3fr 35px;
            gap: 10px;
        }

        /*USER INFO*/
        .ad__user {
            padding: 10px;
            border-left: 1px solid rgba(211, 211, 211, 0.5);
        }
        
        /*BUTTONS*/
        .info__buttons {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        }
    }
    
    /*TABLET STYLES*/
    @media (max-width: 1200px) {
        /*AD*/
        .ad {
            width: 100%;
        }

        .ad__image {
            width: 100%;
        }

        .ad__image > img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 3px;
        }

        .ad__header > div > div {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 10px;

            width: fit-content;
            margin-bottom: 20px;
            opacity: 70%;
            font-size: 12px;
        }

        .info__buttons > a {
            width: 100%;
        }

        .ad__info {
            display: grid;
            grid-auto-rows: 3fr 35px;
            gap: 10px;

            margin-top: 20px;
        }

        .info__buttons > .btn {
            width: 100% !important;
        }
        
        /*BUTTONS*/
        .info__buttons {
            display: grid;
            grid-template-columns: 47px 3fr;
        }

        /*USER INFO*/
        .ad__user {
            margin-top: 20px;
        }

        .user__contacts {
            margin-top: 10px;
        }
    }

    /*PHONE STYLES*/
    @media (max-width: 770px) {
        /*AD*/
        .ad {
            width: 100%;
        }

        .ad__image {
            width: 100%;
        }

        .ad__image > img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 3px;
        }

        .ad__header > div > div {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 10px;

            width: fit-content;
            margin-bottom: 20px;
            opacity: 70%;
            font-size: 12px;
        }

        .info__description {
            display: none;
        }

        .info__buttons > a {
            width: 100%;
        }

        .ad__info {
            display: grid;
            grid-auto-rows: 3fr 35px;
            gap: 10px;

            margin-top: 20px;
        }

        .info__buttons > .btn {
            width: 100% !important;
        }
        
        /*BUTTONS*/
        .info__buttons {
            display: grid;
            grid-template-columns: 47px 3fr;
        }

        /*USER INFO*/
        .ad__user {
            margin-top: 20px;
        }

        .user__contacts {
            margin-top: 10px;
        }
    }
</style>
