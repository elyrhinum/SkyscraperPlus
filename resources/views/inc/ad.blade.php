<div class="ad">
    {{--IMAGE--}}
    <div class="ad__image">
        <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
    </div>

    {{--AD INFO--}}
    <div class="ad__info">
        {{--INFO--}}
        <div>
            <h5 class="info__header">{{ $ad->getNameOfObject() }}</h5>
            <p class="info__object-type">{{ $ad->getCorrectObjectType() }}</p>
            <p class="info__description">{{ $ad->description }}</p>
            <h5 class="info__price">{{ $ad->price }} руб.</h5>
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

    .info__description {
        width: 100%;
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

    .btn-filled {
        margin-left: 10px;
        height: 35px;
    }

    /*SAVE BUTTON*/
    .btn-save {
        width: 40px;
        padding: 0;

        border: 1px solid #356089;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn-save:hover {
        border: 1px solid #EEA444;
    }

    .btn-save > img {
        width: 35px;
        height: 35px;
        object-fit: cover;
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

@push('script')
    <script>
        const description = document.querySelectorAll('.info__description')

        // CHARACTERS LIMIT
        description.forEach(elem => {
            elem.textContent = limitStr(elem.textContent, 200)
        })

        function limitStr(str, n, symb) {
            if (!n && !symb) return str;
            if (str.length < n) return str;
            symb = symb || '...';
            return str.substr(0, n - symb.length) + symb;
        }
    </script>
@endpush

