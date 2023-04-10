@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/complexes/create.css') }}">
@section('title', 'Добавить новый жилой комплекс')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <div id="title">
                <h5>Добавить жилой комплекс</h5>
            </div>

            <div class="common">
                <form method="post" enctype="multipart/form-data" id="form">
                    {{--ADDRESS--}}
                    <fieldset>
                        <h5 class="complex-info-title">Район</h5>

                        {{--DISTRICT--}}
                        <div id="districts" class="labels">
                            <p class="districts__title">Район <span class="sign-required">*</span></p>
                            <select class="form-select districts__select"
                                    name="district_id">
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>

                    {{--ABOUT COMPLEX--}}
                    <fieldset>
                        <h5 class="complex-info-title mb-1">Информация</h5>

                        {{--NAME--}}
                        <div id="complex-name">
                            <p class="mb-3">Если наименование состоит из английского алфавита, то необходимо в скобках написать его
                                транскрипцию</p>
                            <div class="labels">
                                <p class="complex-name__title">Наименование <span class="sign-required">*</span></p>
                                <input type="text" name="name" id="name" class="form-control"
                                       {{ old('name') }} min="1" placeholder="Name (Нейм)" required>
                            </div>
                        </div>

                        {{--CLASS--}}
                        <div id="complex-classes" class="labels">
                            <p class="complex-classes__title">Класс <span class="sign-required">*</span></p>
                            <select class="form-select complex-classes__select"
                                    name="class_id" required>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </fieldset>

                    {{--DESCRIPTION AND IMAGES--}}
                    <fieldset>
                        {{--DESCRIPTION--}}
                        <div id="complex-description">
                            <h5 class="complex-info-title">Описание <span class="sign-required">*</span></h5>
                            <textarea name="description" id="description" rows="10" class="form-control" required
                                      placeholder="Опишите все детали: какая отделка в квартирах, какие стены, полы и так далее."></textarea>
                        </div>

                        {{--IMAGES--}}
                        <div id="complex-images">
                            <div class="mb-3">
                                <h5 class="mb-1 complex-info-title ">Фотографии</h5>
                                <p>Жилые комплексы с фотографиями привлекают больше потенциальных покупателей. Не
                                    допускаются к
                                    размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные
                                    баннер.
                                    Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ. Главным
                                    изображением
                                    будет являтся первое загруженное, поэтому
                                    будьте внимательнее!</p>
                            </div>

                            <label for="images" class="label-images">
                                <p>ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                                <input type="file" name="images" id="images" class="form-control"
                                       accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)"
                                       multiple>
                                <div id="images-prev"></div>
                            </label>
                            <span id="images-error" style="color: red;"></span>
                        </div>
                    </fieldset>

                    <p class="required-instruction"><sup class="sign-required">*</sup> - поле обязательно для заполнения</p>

                    <button class="btn btn-filled btn-submit">Добавить в каталог</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/form-uploading.js') }}"></script>

    <script>
        const btnSubmit = document.querySelector(".btn-submit");

        // UPLOADING IMAGES AND REDIRECT
        btnSubmit.addEventListener('click', async e => {
            e.preventDefault()
            const formData = getFilesFormData(filesStore);

            function getFilesFormData(files) {
                const formData = new FormData(form);

                if (files != []) {
                    files.map((file) => {
                        formData.append('images[]', file);
                    });
                }

                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                return formData;
            }

            let res = await postJSON('{{ route("admins.complexes.store") }}', formData, "{{ csrf_token() }}");
            if (res != null) {
                location = "{{ route('admins.complexes.onlyPublished') }}";
            }
        })
    </script>
@endpush
