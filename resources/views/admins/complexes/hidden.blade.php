@extends('templates.admin')
@section('title', 'Скрытые жилые комплексы')
@section('content')
    <div class="main-container">
        <h5 id="title">Скрытые жилые комплексы</h5>

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
                <tr>
                    <td class="br object-id">{{ $object->id }}</td>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->district->name }}</td>
                    <td class="date-column">{{ $object->dateOfCreating }}</td>
                    <td class="date-column">{{ $object->dateOfUpdating }}</td>
                    <td class="td-btn">
                        {{--SHOW BUTTON--}}
                        <a href="{{ route('admins.complexes.show', $object->id) }}" class="btn btn-outlined btn-more">Подробнее</a>

                        {{--MAKE INACTIVE BUTTON--}}
                        <button class="btn btn-filled btn-confirm"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"
                                data-id="{{ $object->id }}"
                                onclick="getId({{ $object->id }})">Вернуть в каталог
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Скрыть жилой комплекс из каталога</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите скрыть жилой комплекс из каталога?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.complexes.confirm') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-danger">Вернуть в каталог</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // MODAL WINDOW
        const myModal = document.querySelectorAll('.btn-confirm'),
            myInput = document.getElementById('myInput');

        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
