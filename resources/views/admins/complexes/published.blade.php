@extends('templates.admin')
@section('title', 'Каталог жилых комплексов')
@section('content')
    <div class="main-container">
        <h5>Каталог жилых комплексов</h5>
        {{--MESSAGE--}}
        @include('inc.message')

        {{--BLOCKS WITH COMPLEXES--}}
        <table>
            <tr>
                <th class="br">Наименование</th>
                <th class="br">Дата подачи</th>
                <th class="br">Дата обновления</th>
                <th>Действия</th>
            </tr>
            @foreach($objects as $object)
                <tr>
                    <td class="br">{{ $object->name }}</td>
                    <td class="td-date br">{{ $object->dateOfCreating }}</td>
                    <td class="td-date br">{{ $object->dateOfUpdating }}</td>
                    <td class="td-btn">
                        {{--SHOW BUTTON--}}
                        <a href="{{ route('complexes.show', $object->id) }}" class="btn btn-outlined btn-more">Подробнее</a>

                        {{--MAKE INACTIVE BUTTON--}}
                        <button class="btn btn-danger btn-cancel"
                                data-id="{{ $object->id }}">Скрыть
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@push('script')
    <script>
        // MODAL WINDOW
        const myModal = document.querySelectorAll('.btn-publish'),
            myInput = document.getElementById('myInput'),
            modalFade = document.getElementsByClassName('modal-footer');

        function getId(id) {
            document.getElementById("modal-object-id").value = id
        }
    </script>
@endpush
