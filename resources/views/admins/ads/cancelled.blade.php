@extends('templates.admin')
@section('title', 'Отклоненные объявления')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <h5 id="title">Отклоненные объявления</h5>

            {{--MESSAGE--}}
            @include('inc.message')

            <table>
                <tr>
                    <th class="br">ID</th>
                    <th>Тип объекта</th>
                    <th>Договор</th>
                    <th>Район</th>
                    <th>Цена</th>
                    <th class="centered">Дата подачи</th>
                    <th class="centered">Дата обновления</th>
                    <th class="centered"></th>
                </tr>
                @forelse($ads as $ad)
                    <tr class="table__block">
                        <td class="br object-id">{{ $ad->id }}</td>
                        <td> {{ $ad->getCorrectObjectType() }}</td>
                        <td>{{ $ad->contract->name }}</td>
                        <td>{{ $ad->district->name }}</td>
                        <td>{{ $ad->price }} ₽</td>
                        <td class="centered">{{ $ad->dateOfCreating }}</td>
                        <td class="centered">{{ $ad->dateOfUpdating }}</td>
                        <td class="centered">

                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('admins.ads.show', $ad->id) }}"
                               class="btn btn-outlined btn-more">
                                Подробнее
                            </a>

                            {{--BUTTON TO PUBLISH--}}
                            <button class="btn btn-filled btn-publish"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"
                                    onclick="getId({{ $ad->id }})">
                                Опубликовать
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="7">Нет отклоненных объявлений</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>


    {{--MODAL WINDOW TO PUBLISH--}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Подтвердите действие</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите опубликовать объявление?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    {{--FORM--}}
                    <form action="{{ route('admins.ads.publish') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-filled">Опубликовать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // GET ID TO PUBLISH
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
