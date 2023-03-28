@extends('templates.admin')
@section('title', 'Новые объявления')
@section('content')
    <div class="main-container">
        {{--ЗАГОЛОВОК--}}
        <h5 id="title">Новые объявления</h5>

        {{--СООБЩЕНИЕ--}}
        @include('inc.message')

        {{--ТАБЛИЦА--}}
        <table>
            <tr>
                <th class="br">ID</th>
                <th>Тип объекта</th>
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
                    <td>{{ $ad->district->name }}</td>
                    <td>{{ $ad->price }} ₽</td>
                    <td class="centered">{{ $ad->dateOfCreating }}</td>
                    <td class="centered">{{ $ad->dateOfUpdating }}</td>
                    <td class="centered">

                        {{--КНОПКА ДЛЯ ПРОСМОТРА--}}
                        <a href="{{ route('admins.ads.show', $ad->id) }}"
                           class="btn btn-outlined btn-more">Подробнее</a>

                        {{--КНОПКА ДЛЯ ПУБЛИКАЦИИ--}}
                        <button class="btn btn-filled btn-publish"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop1" onclick="getId({{ $ad->id }})">
                            Опубликовать
                        </button>

                        {{--КНОПКА ДЛЯ ОТКЛОНЕНИЯ--}}
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
                    <td colspan="6">Нет новых объявлений</td>
                </tr>
            @endforelse
        </table>
    </div>

    {{--МОДАЛЬНОЕ ОКНО ДЛЯ ПОДТВЕРЖДЕНИЯ ПУБЛИКАЦИИ--}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Опубликовать объявление</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите опубликовать объявление?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.ads.confirm') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-filled" id="btn-confirm">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--МОДАЛЬНОЕ ОКНО ДЛЯ ОТКЛОНЕНИЯ--}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Отклонить объявление</h1>
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

        // ВЫКЛЮЧЕНИЕ КНОПКИ ДО ВВОДА КОММЕНТАРИЯ
        document.getElementById('btn-cancel').disabled = true;

        document.getElementById('pre-comment').addEventListener('input', (e) => {
            console.log(e.target.value)
            if (e.target.value !== '') {
                document.getElementById('btn-cancel').disabled = false;
            } else {
                document.getElementById('btn-cancel').disabled = true;
            }
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
