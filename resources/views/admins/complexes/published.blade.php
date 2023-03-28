@extends('templates.admin')
@section('title', 'Опубликованные жилые комплексы')
@section('content')
    <div class="main-container">
        <h5 id="title">Опубликованные жилые комплексы</h5>

        {{--СООБЩЕНИЕ--}}
        @include('inc.message')

        {{--ТАБЛИЦА--}}
        <table>
            <tr>
                <th class="br">ID</th>
                <th>Наименование</th>
                <th>Район</th>
                <th class="date-column">Дата подачи</th>
                <th class="date-column">Дата обновления</th>
                <th></th>
            </tr>
            @forelse($objects as $object)
                <tr>
                    <td class="br object-id">{{ $object->id }}</td>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->district->name }}</td>
                    <td class="date-column">{{ $object->dateOfCreating }}</td>
                    <td class="date-column">{{ $object->dateOfUpdating }}</td>
                    <td class="td-btn">
                        {{--КНОПКА ПРОСМОТРА--}}
                        <a href="{{ route('admins.complexes.show', $object->id) }}" class="btn btn-outlined btn-more">Подробнее</a>

                        {{--КНОПКА СКРЫТИЯ--}}
                        <button class="btn btn-danger btn-hide"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"
                                data-id="{{ $object->id }}"
                                onclick="getId({{ $object->id }})">Скрыть
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="centered">
                    <td colspan="6">Нет заявлений на добавление жилого комплекса</td>
                </tr>
            @endforelse
        </table>
    </div>

    {{--МОДАЛЬНОЕ ОКНО ДЛЯ СКРЫТИЯ ЖИЛОГО КОМПЛЕКСА--}}
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

                    <form action="{{ route('admins.complexes.hide') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-danger">Скрыть</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // ПЕРЕДАЧА ID ДЛЯ ОПУБЛИКОВАНИЯ ОБЪЯВЛЕНИЯ
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
