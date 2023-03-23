@extends('templates.admin')
@section('title', 'Предложенные жилые комплексы')
@section('content')
    <div class="main-container">
        <h5 id="title">Заявления на добавление жилого комплекса в каталог</h5>
        {{--MESSAGE--}}
        @include('inc.message')

        {{--BLOCKS WITH COMPLEXES--}}
        <table>
            <tr>
                <th class="br">ID</th>
                <th>Наименование</th>
                <th>Район</th>
                <th class="date-column">Дата подачи</th>
                <th class="date-column">Дата обновления</th>
                <th></th>
            </tr>
            @foreach($objects as $object)
                <tr class="table__block">
                    <td class="br object-id">{{ $object->id }}</td>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->district->name }}</td>
                    <td class="date-column">{{ $object->dateOfCreating }}</td>
                    <td class="date-column">{{ $object->dateOfUpdating }}</td>
                    <td class="td-btn">
                        {{--SHOW BUTTON--}}
                        <a href="{{ route('admins.complexes.show', $object->id) }}" class="btn btn-outlined btn-more">Подробнее</a>

                        {{--CONFIRM BUTTON--}}
                        <a href="" class="btn btn-filled btn-publish"
                           data-bs-toggle="modal"
                           data-bs-target="#staticBackdrop" onclick="getId({{ $object->id }})">Добавить в каталог</a>

                        {{--CANCEL BUTTON--}}
                        <button class="btn btn-danger btn-cancel"
                                data-id="{{ $object->id }}">Отклонить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{--MODAL WINDOW--}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить жилой комплекс в каталог</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите добавить жилой комплекс в каталог?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.complexes.confirm') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-filled" id="btn-confirm">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // MODAL WINDOW
        const myModal = document.querySelectorAll('.btn-publish'),
            myInput = document.getElementById('myInput');

        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
