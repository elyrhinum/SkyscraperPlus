@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
@section('title', 'Добавить новый жилой комплекс')
@section('content')
    <div class="main-container pd">
        {{--HEADER WITH INSTRUCTION--}}
        <div class="headers">
            <div class="headers__inner">
                <h3>Добавить новый жилой комплекс</h3>
                <p>Ниже представлена форма, поля которой необходимо заполнить для того, чтобы в дальнейшем отправить
                    заявление на добавление жилого комплекса.</p>
                <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                    для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
            </div>
        </div>

        <div class="common">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--ADDRESS--}}
                <fieldset>
                    <h5>Район жилого комплекса</h5>

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
                    <h5 id="complex-info-title">Информация о жилом комплексе</h5>

                    {{--NAME--}}
                    <div id="complex-name">
                        <p class="mb-3">Если наименование состоит из английского алфавита, то необходимо в скобках
                            написать его
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
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control" required
                                  placeholder="Опишите все детали: какая отделка в квартирах, какие стены, полы и так далее."></textarea>
                    </div>

                    {{--IMAGES--}}
                    <div id="complex-images">
                        <div class="mb-3">
                            <h5 class="mb-1">Фотографии</h5>
                            <p>Не допускаются к размещению фотографии с водяными знаками, чужих объектов недвижимости и
                                рекламные баннер. Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ.
                                Главным изображением будет являтся первое загруженное, поэтому будьте внимательнее!</p>
                        </div>

                        <div class="label-images">
                            <label for="images">
                                <p class="label-images__title">ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                                <input type="file" name="images" id="images" class="form-control"
                                       accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)"
                                       multiple>
                            </label>
                            <div id="images-prev"></div>
                            <span id="images-error" style="color: red;"></span>
                        </div>
                    </div>
                </fieldset>

                <button class="btn btn-filled btn-submit">Добавить жилой комплекс</button>
            </form>
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

            let res = await postJSON('{{ route("complexes.store") }}', formData, "{{ csrf_token() }}");
            if (res != null) {
                location = "{{ route('users.account') }}";
            }
        })
    </script>
@endpush
