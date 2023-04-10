@extends('templates.admin')
@section('title', 'Опубликованные жилые комплексы')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <div id="title">
                <h5>Опубликованные жилые комплексы</h5>
                <a href="{{ route('admins.complexes.create') }}" class="btn btn-filled">Добавить жилой комплекс</a>
            </div>

            {{--MESSAGE--}}
            @include('inc.message')

            <table>
                <tr>
                    <th class="br">ID</th>
                    <th>Наименование</th>
                    <th>Район</th>
                    <th class="date-column">Дата подачи</th>
                    <th class="date-column">Дата обновления</th>
                    <th></th>
                </tr>
                @forelse($complexes as $complex)
                    <tr>
                        <td class="br object-id">{{ $complex->id }}</td>
                        <td>{{ $complex->name }}</td>
                        <td>{{ $complex->district->name }}</td>
                        <td class="date-column">{{ $complex->dateOfCreating }}</td>
                        <td class="date-column">{{ $complex->dateOfUpdating }}</td>
                        <td class="td-btn">
                            {{--BUTTON TO SHOW--}}
                            <a href="{{ route('complexes.show', $complex->id) }}"
                               class="btn btn-outlined btn-more">Подробнее</a>

                            {{--BUTTON TO HIDE--}}
                            <button class="btn btn-danger btn-hide"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"
                                    data-id="{{ $complex->id }}"
                                    onclick="getId({{ $complex->id }})">Скрыть
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="centered">
                        <td colspan="6">Нет опубликованных жилых комплексов</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{--MODAL WINDOW TO HIDE--}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Подтвердите действие</h1>
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
        // GET ID TO HIDE
        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
