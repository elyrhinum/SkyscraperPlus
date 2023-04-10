@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/users/accounts/main.css') }}">
@section('title', 'Ваши отклоненные объявления')
@section('content')
    <div class="main-container pd">
        {{--HEADER--}}
        <div class="headers">
            <h3>Ваши отклоненные объявления</h3>
            <a href="{{ route('users.account') }}" class="btn btn-filled">Назад</a>
        </div>

        <div class="last-suggested-ads">
            <div class="last-suggested-ads__inner">
                @forelse($ads as $ad)
                    <div class="ad common">
                        {{--IMAGE--}}
                        <div class="ad__image">
                            <img src="{{ $ad->images[0]->image }}" alt="{{ $ad->id }}">
                        </div>

                        {{--INFO--}}
                        <div class="ad__info">
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

                        {{--BUTTON TO SHOW--}}
                        <div class="ad__buttons">
                            {{--BUTTON TO SEE REASON--}}
                            <button class="btn btn-danger btn-reason"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"
                                    onclick="getIdToSeeReason('{{ $ad->comment }}')">
                                Причина отклонения
                            </button>

                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-outlined">Посмотреть</a>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет отклоненных объявлений</p>
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
        // GET COMMENT
        function getIdToSeeReason(comment) {
            document.getElementById('pre-comment').textContent = comment
        }
    </script>
@endpush
