@extends('templates.admin')
@section('title', 'Предложенные объявления')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <div id="title">
                <h5>Предложенные объявления</h5>
            </div>

            {{--MESSAGE--}}
            @include('inc.message')

            <table>
                <tr>
                    <th class="br object-id">ID</th>
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
                        <td>{{ $ad->getCorrectPrice() }}</td>
                        <td class="centered">{{ $ad->dateOfCreating }}</td>
                        <td class="centered">{{ $ad->dateOfUpdating }}</td>
                        <td class="td-btn">

                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('ads.show', $ad->id) }}"
                               class="btn btn-outlined btn-more">Подробнее</a>

                            {{--BUTTON TO PUBLISH--}}
                            <button class="btn btn-filled btn-publish"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop1" onclick="getId({{ $ad->id }})">
                                Опубликовать
                            </button>

                            {{--BUTTON TO CANCEL--}}
                            <button class="btn btn-danger btn-cancel"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2"
                                    onclick="getIdToCancel({{ $ad->id }})">
                                Отклонить
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="7">Нет предложенных объявлений</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>


    {{--MODAL WINDOW TO PUBLISH--}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <button class="btn btn-filled" id="btn-confirm">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW TO CANCEL--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Подтвердите действие</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Для отклонения объявления необходимо ввести причину, по которой это объявление не может быть
                        опубликовано</p>
                    <textarea class="form-control" name="comment" id="pre-comment" rows="7"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.ads.cancel') }}">
                        <input type="hidden" id="input-comment-modal" name="id">
                        <textarea class="form-control" name="comment" id="comment"
                                  placeholder="Введите причину отклонения объявления" hidden></textarea>
                        <button class="btn btn-danger" id="btn-cancel">Отклонить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const btnCancel = document.getElementsByClassName('btn-cancel');

        // DISABLING BUTTON IF COMMENT IS EMPTY
        document.getElementById('btn-cancel').disabled = true;

        document.getElementById('pre-comment').addEventListener('input', (e) => {
            document.getElementById('btn-cancel').disabled = e.target.value === '';
        });

        // GET VALUE TO CANCEL
        document.getElementById('pre-comment').addEventListener('input', (e) => {
            document.getElementById('comment').value = e.target.value;
        });

        // GET ID TO CANCEL
        function getIdToCancel(id) {
            document.getElementById("input-comment-modal").value = id
        }

        // GET ID TO PUBLISH
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
