@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Личный аккаунт')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <div class="headers">
            <h3>Личный аккаунт</h3>
        </div>

        {{--ABOUT USER--}}
        <div class="main-info">
            <div
                class="main-info__personal common {{ auth()->user()->role->name == 'Риелтор' ? 'for-realtor-account' : 'for-user-account' }}">
                {{--IMAGE--}}
                @if(auth()->user()->role->name == 'Риелтор')
                    <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->shortName }}">
                @endif

                {{--PERSONAL INFO--}}
                <div class="personal__blocks">
                    <div class="blocks__info">
                        <h3>{{ auth()->user()->fullName }}</h3>
                        <div>
                            <span>E-mail: {{ auth()->user()->email }}</span>
                            <span>Телефон: {{ auth()->user()->telephone }}</span>
                        </div>
                    </div>
                </div>
                <div class="main-info__button">
                    <a href="{{ route('users.edit', auth()->user()) }}" class="btn btn-outlined">Редактировать</a>
                </div>
            </div>

            {{--SIDEBAR--}}
            @include('inc.users.sidebar')
        </div>

        {{--LAST SUGGESTED ADS--}}
        <div class="last-suggested-ads">
            {{--TITLE--}}
            <div class="titles">
                <h5>Последние объявления на рассмотрении</h5>
                <a href="{{ route('users.onlySuggestedAds') }}" class="btn btn-filled">Подробнее</a>
            </div>

            <div class="last-suggested-ads__inner">
                @forelse($suggested_ads as $ad)
                    <div class="ad common">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__inner">
                                <div class="info__header">
                                    <h5>{{ $ad->getNameOfObject() }}</h5>
                                    <div>
                                        <p>{{ $ad->getCorrectObjectType() }}</p>
                                        <p>{{ $ad->contract->name }}</p>
                                    </div>
                                </div>

                                <p class="info__description">{{ $ad->description }}</p>

                                <div class="info__price">
                                    <h5>{{ $ad->getCorrectPrice() }}</h5>
                                </div>
                            </div>

                            {{--BUTTONS--}}
                            <div class="ad__buttons">
                                {{--BUTTON TO SHOW--}}
                                <a href="{{ route('ads.show', $ad->id) }}"
                                   class="btn btn-outlined btn-edit">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет последних объявлений на рассмотрении</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{--LAST PUBLISHED ADS--}}
        <div class="last-published-ads">
            {{--TITLE--}}
            <div class="titles">
                <h5>Последние опубликованные объявления</h5>
                <a href="{{ route('users.onlyPublishedAds') }}" class="btn btn-filled">Подробнее</a>
            </div>

            <div class="last-published-ads__inner">
                @forelse($published_ads as $ad)
                    <div class="ad common">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
                            <div class="info__inner">
                                <div class="info__header">
                                    <h5>{{ $ad->getNameOfObject() }}</h5>
                                    <div>
                                        <p>{{ $ad->getCorrectObjectType() }}</p>
                                        <p>{{ $ad->contract->name }}</p>
                                    </div>
                                </div>

                                <p class="info__description">{{ $ad->description }}</p>

                                <div class="info__price">
                                    <h5>{{ $ad->getCorrectPrice() }}</h5>
                                </div>
                            </div>

                            {{--BUTTONS--}}
                            <div class="ad__buttons">
                                {{--BUTTON TO SHOW--}}
                                <a href="{{ route('ads.show', $ad->id) }}"
                                   class="btn btn-outlined btn-edit">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет последних опубликованных объявлений</p>
                    </div>
                @endforelse
            </div>

            {{--LAST CANCELLED ADS--}}
            <div class="last-cancelled-ads">
                {{--TITLE--}}
                <div class="titles">
                    <h5>Последние отклоненные объявления</h5>
                    <a href="{{ route('users.onlyCancelledAds') }}" class="btn btn-filled">Подробнее</a>
                </div>

                <div class="last-cancelled-ads__inner">
                    @forelse($cancelled_ads as $ad)
                        <div class="ad common">
                            {{--IMAGE--}}
                            <div class="ad__image">
                                <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                            </div>

                            {{--INFO--}}
                            <div class="ad__info">
                                <div class="info__inner">
                                    <div class="info__header">
                                        <h5>{{ $ad->getNameOfObject() }}</h5>
                                        <div>
                                            <p>{{ $ad->getCorrectObjectType() }}</p>
                                            <p>{{ $ad->contract->name }}</p>
                                        </div>
                                    </div>

                                    <p class="info__description">{{ $ad->description }}</p>

                                    <div class="info__price">
                                        <h5>{{ $ad->getCorrectPrice() }}</h5>
                                    </div>
                                </div>

                                {{--BUTTONS--}}
                                <div class="ad__buttons">
                                    {{--BUTTON TO SHOW--}}
                                    <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined btn-edit">Посмотреть</a>

                                    {{--BUTTON TO SEE REASON--}}
                                    <button class="btn btn-danger btn-reason"
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            onclick="getIdToSeeReason('{{ $ad->comment }}')">
                                        Причина отклонения
                                    </button>

                                    {{--BUTTON TO EDIT--}}
                                    <a href="{{ route('ads.edit', $ad->id) }}"
                                       class="btn btn-filled btn-edit">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="message-empty common">
                            <p>Нет последних отклоненных объявлений</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{--MODAL WINDOW WITH REASON--}}
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Причина отклонения</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p id="pre-comment"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-filled" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection

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

                // GET COMMENT
                function getIdToSeeReason(comment) {
                    document.getElementById('pre-comment').textContent = comment
                }
            </script>
    @endpush
