@extends('templates.admin')
@section('title', 'Заявления на добавление нового жилого комплекса')
@section('content')
    <div class="main-container">
        <h5 id="title">Заявления на добавление нового жилого комплекса</h5>

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
                <tr class="table__block">
                    <td class="br object-id">{{ $object->id }}</td>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->district->name }}</td>
                    <td class="date-column">{{ $object->dateOfCreating }}</td>
                    <td class="date-column">{{ $object->dateOfUpdating }}</td>
                    <td class="td-btn">
                        {{--КНОПКА ПРОСМОТРА--}}
                        <a href="{{ route('admins.complexes.show', $object->id) }}" class="btn btn-outlined btn-more">Подробнее</a>

                        {{--КНОПКА ПУБЛИКОВАНИЯ--}}
                        <button href="" class="btn btn-filled btn-publish"
                           data-bs-toggle="modal"
                           data-bs-target="#staticBackdrop1"
                           onclick="getId({{ $object->id }})">
                            Добавить в каталог
                        </button>

                        {{--КНОПКА ОТКЛОНЕНИЯ--}}
                        <button
                           data-bs-toggle="modal"
                           data-bs-target="#staticBackdrop2"
                           class="btn btn-danger btn-cancel"
                        onclick="getIdToCancel({{ $object->id }})">
                            Отклонить
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="centered">
                    <td colspan="6">Нет заявлений на добавление нового ЖК</td>
                </tr>
            @endforelse
        </table>
    </div>

    {{--МОДАЛЬНОЕ ОКНО ДЛЯ ДОБАВЛЕНИЯ ЖК--}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить новый жилой комплекс</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите добавить новый жилой комплекс в каталог?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.complexes.publish') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-filled" id="btn-confirm">
                            Добавить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--МОДАЛЬНОЕ ОКНО ДЛЯ ОТКЛОНЕНИЯ ДОБАВЛЕНИЯ ЖИЛОГО КОМПЛЕКСА В КАТАЛОГ--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Отклонить добавление нового ЖК</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Для отклонения заявления необходимо ввести причину, по которой этот жилой комплекс не может быть добавлен в каталог</p>
                    <textarea class="form-control" name="comment" id="pre-comment" rows="7"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.complexes.cancel') }}">
                        <input type="hidden" id="input-comment-modal" name="id">
                        <textarea class="form-control" name="comment" id="comment" placeholder="Введите причину отклонения добавления нового жилого комплекса в каталог" hidden></textarea>
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

        // ВЫКЛЮЧЕНИЕ КНОПКИ ДО ВВОДА КОММЕНТАРИЯ
        document.getElementById('btn-cancel').disabled = true;

        document.getElementById('pre-comment').addEventListener('input', (e) => {
            console.log(e.target.value)
            document.getElementById('btn-cancel').disabled = e.target.value === '';
        });

        // ПЕРЕДАЧА VALUE ДЛЯ ОТКЛОНЕНИЯ ОБЪЯВЛЕНИЯ
        document.getElementById('pre-comment').addEventListener('input', (e) => {
            document.getElementById('comment').value = e.target.value;
        });

        // ПЕРЕДАЧА ID ДЛЯ ОТКЛОНЕНИЯ ОБЪЯВЛЕНИЯ
        function getIdToCancel(id) {
            document.getElementById("input-comment-modal").value = id
        }

        // ПЕРЕДАЧА ID ДЛЯ ОПУБЛИКОВАНИЯ ОБЪЯВЛЕНИЯ
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
