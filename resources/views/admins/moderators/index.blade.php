@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/moderators/index.css') }}">
@section('title', 'Список модераторов')
@section('content')
    <div class="main-container">
        <div id="title">
            <h5>Список модераторов</h5>

            {{--BUTTON TO SIGNUP MODERATOR--}}
            <a href="{{ route('admins.moderators.create') }}" class="btn btn-filled btn-create-moder">Добавить модератора</a>
        </div>

        {{--MESSAGE--}}
        @include('inc.message')

        {{--CARDS--}}
        <table>
            <tr>
                <th class="br object-id">ID</th>
                <th>ФИО</th>
                <th>Логин</th>
                <th></th>
            </tr>
            @foreach($moderators as $moderator)
                <tr>
                    <td class="br object-id">{{ $moderator->id }}</td>
                    <td>{{ $moderator->fullName }}</td>
                    <td>{{ $moderator->login }}</td>
                    <td class="td-btn">
                        <a href="{{ route('admins.moderators.edit', $moderator->id) }}" class="btn btn-filled">Редактировать</a>
                        <button data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"
                                data-id="{{ $moderator->id }}"
                                class="btn btn-danger btn-delete"
                                onclick="getId({{ $moderator->id }})">Удалить</button>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Удалить модератора</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить модератора?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                    <form action="{{ route('admins.moderator.delete') }}">
                        <input type="hidden" id="modal-object-id" name="id">
                        <button class="btn btn-danger" id="btn-confirm">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // MODAL WINDOW
        const myModal = document.querySelectorAll('.btn-delete'),
            myInput = document.getElementById('myInput');

        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
