@extends('templates.admin')
@section('title', 'Отклоненные заявления на добавление жилого комплекса')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <div id="title">
                <h5>Отклоненные заявления на добавление жилого комплекса</h5>
                <a href="{{ route('admins.complexes.create') }}" class="btn btn-filled">Добавить жилой комплекс</a>
            </div>

            {{--MESSAGE--}}
            @include('inc.message')

            <table>
                <tr>
                    <th class="br object-id">ID</th>
                    <th>Наименование</th>
                    <th>Район</th>
                    <th class="date-column">Дата подачи</th>
                    <th class="date-column">Дата обновления</th>
                    <th></th>
                </tr>
                @forelse($complexes as $complex)
                    <tr class="table__block">
                        <td class="br object-id">{{ $complex->id }}</td>
                        <td>{{ $complex->name }}</td>
                        <td>{{ $complex->district->name }}</td>
                        <td class="date-column">{{ $complex->dateOfCreating }}</td>
                        <td class="date-column">{{ $complex->dateOfUpdating }}</td>
                        <td class="td-btn">
                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('complexes.show', $complex->id) }}"
                               class="btn btn-outlined btn-more">Подробнее</a>

                            {{--BUTTON TO PUBLISH--}}
                            <a href="" class="btn btn-filled btn-publish"
                               data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop1" onclick="getId({{ $complex->id }})">
                                Добавить в каталог
                            </a>

                            {{--BUTTON TO SEE REASON--}}
                            <button class="btn btn-danger btn-reason"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2"
                                    onclick="getIdToSeeReason('{{ $complex->comment }}')">
                                Причина отклонения
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="6">Нет отклоненных жилых комплексов</td>
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
                    <p>Вы действительно хотите добавить жилой комплекс в каталог?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    {{--FORM--}}
                    <form action="{{ route('admins.complexes.publish') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-filled" id="btn-confirm">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW WITH REASON--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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

        // GET COMMENT
        function getIdToSeeReason(comment) {
            document.getElementById('pre-comment').textContent = comment
        }
    </script>
@endpush
