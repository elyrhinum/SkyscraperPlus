@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
<link rel="stylesheet" href="{{ asset('css/complexes/create.css') }}">
@section('title', 'Добавить жилой комплекс')
@section('content')
    <div class="main-container pd">
        {{--HEADERS WITH INSTRUCTIONS--}}
        <div class="headers">
            <h3>Добавить жилой комплекс</h3>
            <p>Ниже представлена форма, поля которой необходимо заполнить для того, чтобы в дальнейшем отправить
                объявление добавление нового жилого комплекса.</p>
            <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
        </div>

        {{--FORM--}}
        <div class="forms">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--ADDRESS--}}
                <fieldset>
                    <h5>Район жилого комплекса</h5>

                    {{--DISTRICTS--}}
                    <div id="districts" class="labels">
                        <p class="districts__title">Район <span class="sign-required">*</span></p>
                        <select class="form-select districts__select"
                                name="district_id">
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district') == $district->name ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>

                {{--RESIDENTIAL COMPLEX NAME--}}
                <fieldset>
                    <h5>Информация о жилом комплексе</h5>

                    {{--NAME--}}
                    <div id="complex-name" class="labels">
                        <p class="complex-name__title">Наименование <span class="sign-required">*</span></p>
                        <input type="text" name="name" id="name" class="form-control" min="1" required>
                    </div>
                    {{--CLASSES--}}
                    <div id="complex-classes" class="labels">
                        <p class="complex-classes__title">Класс <span class="sign-required">*</span></p>
                        <select class="form-select complex-classes__select"
                                name="class_id" required>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class') == $class->name ? 'selected' : '' }}>{{ $class->name }}</option>
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
                        <h5>Фотографии</h5>
                        <p>Объявления с фотографиями привлекают больше потенциальных покупателей. Не допускаются к
                            размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные баннер.
                            Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ. Главным изображением
                            будет являтся первое загруженное, поэтому
                            будьте внимательнее!</p>
                        <label for="images" class="label-images">
                            <p>ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                            <input type="file" name="images" id="images" class="form-control"
                                   accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)" multiple>
                            <div id="images-prev"></div>
                        </label>
                        <span id="images-error" style="color: red;"></span>
                    </div>
                </fieldset>

                <button class="btn btn-filled btn-submit">Добавить жилой комплекс</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/images-uploading.js') }}"></script>

    <script>
        const btnSubmit = document.querySelector(".btn-submit");

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
                if ({{ auth()->user()->role_id }} === 1) {
                    location = "{{ route('users.user.account') }}";
                } else if ({{ auth()->user()->role_id }} === 2) {
                    location = "{{ route('users.realtor.account') }}";
                }
            }
        })
    </script>
@endpush
