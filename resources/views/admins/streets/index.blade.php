@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/streetsAndDistricts/index.css') }}">
@section('title', 'Каталог улиц')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            <div id="title">
                <h5>Каталог улиц</h5>

                {{--BUTTON TO ADD STREET--}}
                <button data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop1"
                        class="btn btn-filled">Добавить улицу в каталог
                </button>
            </div>

            {{--MESSAGE--}}
            @include('inc.message')

            {{--TABLE--}}
            <table>
                <tr>
                    <th class="br object-id">ID</th>
                    <th>Наименование</th>
                    <th></th>
                </tr>
                @foreach($streets as $street)
                    <tr>
                        <td class="br object-id">{{ $street->id }}</td>
                        <td>{{ $street->name }}</td>
                        <td class="td-btn">

                            {{--BUTTON TO EDIT STREET--}}
                            <button data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2"
                                    data-id="{{ $street->id }}"
                                    data-name="{{ $street->name }}"
                                    onclick="getId({{ $street->id }})"
                                    class="btn btn-filled btn-update-street">Редактировать
                            </button>

                            {{--BUTTON TO DELETE STREET--}}
                            <button data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3"
                                    data-id="{{ $street->id }}"
                                    class="btn btn-danger btn-delete"
                                    onclick="getIdToDelete({{ $street->id }})">Удалить
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{--MODAL WINDOW TO ADD STREET--}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить улицу в каталог</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Введите наименование улицы</p>
                    <input type="text" name="name" id="name-store" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.streets.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="name" id="name-store-street">
                        <button class="btn btn-filled" id="btn-confirm">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW TO UPDATE STREET--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Изменить наименование улицы</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Введите наименование улицы</p>
                    <input type="text" name="name" id="name-update" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.streets.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="name" id="name-update-street">
                        <input type="hidden" id="modal-street-id" name="id">
                        <button class="btn btn-filled" id="btn-confirm">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL WINDOW TO DELETE STREET--}}
    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Удалить улицу из каталога</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить улицу из каталога?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.streets.delete') }}">
                        <input type="hidden" id="modal-street-delete-id" name="id">
                        <button class="btn btn-danger" id="btn-confirm">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const btnUpdateStreet = document.getElementsByClassName('btn-update-street');

        document.getElementById('name-store').addEventListener('input', (e) => {
            document.getElementById('name-store-street').value = e.target.value;
        });

        document.getElementById('name-update').addEventListener('input', (e) => {
            document.getElementById('name-update-street').value = e.target.value;
        });

        [...btnUpdateStreet].forEach((item) => {
            item.addEventListener('click', (e) => {
                document.getElementById('name-update').value = e.target.dataset.name;
                document.getElementById('name-update-street').value = e.target.dataset.name;
            });
        });

        function getId(id) {
            document.getElementById("modal-street-id").value = id
        }

        function getIdToDelete(id) {
            document.getElementById("modal-street-delete-id").value = id
        }
    </script>
@endpush
