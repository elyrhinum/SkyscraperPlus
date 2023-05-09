@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/streetsAndDistricts/index.css') }}">
@section('title', 'Документация')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            <div id="title">
                <h5>Документация</h5>

                {{--BUTTON TO ADD DOCUMENT--}}
                <button data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop1"
                        class="btn btn-filled">Добавить документ
                </button>
            </div>

            {{--MESSAGE--}}
            @include('inc.message')

            @error('name')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @enderror

            {{--TABLE--}}
            <table>
                <tr>
                    <th class="br object-id">ID</th>
                    <th>Наименование</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                    <th></th>
                </tr>
                @forelse($documents as $document)
                    <tr>
                        <td class="br object-id">{{ $document->id }}</td>
                        <td>{{ $document->name }}</td>
                        <td>{{ $document->dateOfCreating }}</td>
                        <td>{{ $document->dateOfUpdating }}</td>
                        <td class="td-btn">
                            {{--BUTTON TO READ DOCUMENT--}}
                            <button class="btn btn-outlined">
                                <a href="{{ $document->document }}">Скачать</a>
                            </button>

                            {{--BUTTON TO UPDATE DOCUMENT--}}
                            <button data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2"
                                    data-id="{{ $document->id }}"
                                    data-name="{{ $document->name }}"
                                    data-document="{{ $document->document }}"
                                    class="btn btn-filled btn-update-document">Редактировать
                            </button>

                            {{--BUTTON TO DELETE DOCUMENT--}}
                            <button data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3"
                                    data-id="{{ $document->id }}"
                                    class="btn btn-danger btn-delete"
                                    onclick="getIdToDelete({{ $document->id }})">Удалить
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="4">Нет документов</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{--MODAL WINDOW TO ADD DOCUMENT--}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить документ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--FORM--}}
                    <form action="{{ route('admins.documents.store') }}" method="post"
                          enctype="multipart/form-data" class="modal-body__form">
                        @csrf
                        <div class="m-3">
                            <p>Введите наименование документа</p>
                            <input type="text" name="name" id="name-store" class="form-control">
                        </div>

                        <div class="m-3">
                            <p>Вставьте файл</p>
                            <input type="file" name="document" id="document-store" class="form-control"
                                   accept=".doc, .docx, .pdf">
                        </div>

                        <div class="form__buttons">
                            <div class="m-3">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button class="btn btn-filled">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW TO UPDATE DOCUMENT--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Изменить документ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--FORM--}}
                    <form action="{{ route('admins.documents.update') }}" method="post" enctype="multipart/form-data"
                          class="modal-body__form">
                        @csrf
                        <input type="hidden" name="id" id="id-update">

                        <div class="m-3">
                            <p>Введите наименование документа</p>
                            <input type="text" name="name" id="name-update" class="form-control">
                        </div>

                        <div class="m-3">
                            <a href="" id="document-update">Посмотреть текущий файл</a>
                        </div>

                        <div class="m-3">
                            <p>Вставьте новый файл, если необходимо</p>
                            <input type="file" name="document" id="document-update" class="form-control"
                                   accept=".doc, .docx, .pdf">
                        </div>

                        <div class="form__buttons">
                            <div class="m-3">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button class="btn btn-filled">Обновить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW TO DELETE DOCUMENT--}}
    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Удалить документ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body__text-delete">
                        <p class="m-2">Вы действительно хотите удалить документ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.documents.delete') }}">
                        <input type="hidden" id="id-delete" name="id">
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // GET DATA TO UPDATE
        document.querySelector('.btn-update-document').addEventListener('click', (e) => {
            document.getElementById('id-update').value = e.target.dataset.id;
            document.getElementById('name-update').value = e.target.dataset.name;
            document.getElementById('document-update').href = e.target.dataset.document;
        });

        function getIdToDelete(id) {
            document.getElementById("id-delete").value = id
        }
    </script>
@endpush

<style>
    .modal-body {
        padding: 0 !important;
    }

    .form__buttons {
        width: 100%;
        border-top: 1px solid lightgray;
        margin-top: 30px;
    }

    .form__buttons > div {
        text-align: right;
    }

    #document-update {
        text-decoration: underline;
    }

    .modal-body__text-delete {
        margin: 20px 0 20px 10px;
    }
</style>
