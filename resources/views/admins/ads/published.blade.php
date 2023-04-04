@extends('templates.admin')
@section('title', 'Опубликованные объявления')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <h5 id="title">Опубликованные объявления</h5>

            {{--MESSAGE--}}
            @include('inc.message')

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

                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('admins.ads.show', $ad->id) }}"
                               class="btn btn-outlined btn-more">
                                Подробнее
                            </a>

                            {{--BUTTON TO CANCEL--}}
                            <button class="btn btn-danger btn-cancel"
                                    onclick="getId({{ $ad->id }})">
                                Отклонить
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="6">Нет опубликованных объявлений</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{--MODAL WINDOW TO CANCEL--}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Подствердите действие</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите отклонить публикацию?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    {{--FORM--}}
                    <form action="{{ route('admins.ads.cancel') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-danger">Отклонить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // GET ID TO CANCEL
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
