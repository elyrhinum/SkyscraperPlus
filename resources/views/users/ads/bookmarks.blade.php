@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Ваши закладки')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <div class="headers">
            <h3>Ваши закладки</h3>
            <a href="{{ route('users.account') }}" class="btn btn-filled">Назад</a>
        </div>

        <div class="last-suggested-ads">
            <div class="last-suggested-ads__inner">
                @forelse($bookmarks as $bookmark)
                    <div class="ad">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $bookmark->ad->images[0]->image }}" alt="{{ $bookmark->ad->id }}">
                        </div>

                        {{--AD INFO--}}
                        <div class="ad__info">
                            {{--INFO--}}
                            <div class="ad__header">
                                <h5 class="info__header">{{ $bookmark->ad->getNameOfObject() }}</h5>
                                <div>
                                    <p>{{ $bookmark->ad->getCorrectObjectType() }}</p>
                                    <p>{{ $bookmark->ad->contract->name }}</p>
                                </div>
                                <p class="info__description">{{ $bookmark->ad->description }}</p>
                                <h5 class="info__price">{{ $bookmark->ad->getCorrectPrice() }}</h5>
                            </div>

                            {{--BUTTONS--}}
                            <div class="info__buttons">
                                @if (auth()->user() !== null)
                                    <div class="btn btn-save" data-ad="{{ $bookmark->ad->id }}"
                                         data-bookmarked="{{ auth()->check() ? auth()->user()->isBookmarked($bookmark->ad->id) : 'false' }}">
                                        <img src="{{ auth()->user()->isBookmarked($bookmark->ad->id) == 'true'?
                                asset('/media/icons/saved/filled.svg') :
                                asset('/media/icons/saved/outlined.svg')}}" alt="Избранное">
                                    </div>
                                @endif
                                <a href="{{ route('ads.show', $bookmark->ad->id) }}" class="btn btn-filled">Посмотреть</a>
                            </div>
                        </div>

                        {{--USER INFO--}}
                        <div class="ad__user">
                            <p class="user__full-name">{{ $bookmark->ad->user->fullName }}</p>
                            <p class="user__role">{{ $bookmark->ad->user->role->name }}</p>
                            <div class="user__contacts">
                                <p>{{ $bookmark->ad->user->telephone }}</p>
                                <p>{{ $bookmark->ad->user->email }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет закладок</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('/js/form-uploading.js') }}"></script>

    <script>
        const btnSave = document.getElementsByClassName('btn-save');

        // BOOKMARKS
        [...btnSave].forEach(item => {
            item.addEventListener('click', async (e) => {
                if ({{ auth()->user() !== null }}) {
                    if (item.dataset.bookmarked === 'false') {
                        let result = await dataPostJSON("{{ route('ads.bookmark') }}", e.currentTarget.dataset.ad, `{{ csrf_token() }}`);
                        if (result) {
                            item.children[0].src = "{{ asset('/media/icons/saved/filled.svg') }}";
                            item.dataset.bookmarked = 'true';
                        }
                    } else {
                        let result = await dataPostJSON("{{ route('ads.unbookmark') }}", e.currentTarget.dataset.ad, `{{ csrf_token() }}`);
                        if (result) {
                            item.children[0].src = "{{ asset('/media/icons/saved/outlined.svg') }}";
                            item.dataset.bookmarked = 'false';
                        }
                    }
                } else {
                    location = '{{ route('users.login') }}';
                }
            });
        });
    </script>
@endpush

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
    }

    .info__header {
        margin-bottom: 0;
    }

    .info__description {
        width: 100%;
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

    .btn-filled {
        height: 35px;
    }

    /*SAVE BUTTON*/
    .btn-save {
        padding: 0 !important;
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
