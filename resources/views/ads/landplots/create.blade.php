@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
@section('title', 'Подать объявление о земельном участке')
@section('content')
    <div class="main-container pd">
        {{--HEADERS WITH INSTRUCTIONS--}}
        <div class="headers">
            <h3>Подать новое объявление о земельном участке</h3>
            <p>Ниже представлена форма, поля которой необходимо заполнить для того, чтобы в дальнейшем отправить
                объявление на рассмотрение модераторам.</p>
            <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
        </div>

        {{--FORM--}}
        <div class="forms">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--CONTRACT TYPES--}}
                <div id="contract-types">
                    <h5>Вид договора</h5>

                    <div class="labels">
                        <p class="contract-types__title">Вид договора <span class="sign-required">*</span></p>
                        <select class="form-select contract-types__select"
                                name="contract_id">
                            @foreach($contract_types as $contract)
                                <option value="{{ $contract->id }}"
                                    {{ old('contract') == $contract->name ? 'selected' : '' }}>{{ $contract->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--ADDRESS--}}
                <fieldset>
                    <h5>Адрес объекта</h5>

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

                    {{--STREETS--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street" required
                               placeholder="В формате ул. Гагарина или пр. Ленина">
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option>{{ $street->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--STREET NUBMER--}}
                    <div id="plot-number" class="labels">
                        <p class="plot-number__title">Номер улицы <span class="sign-required">*</span></p>
                        <input type="number" name="street_number" id="street_number" class="form-control" min="1"
                               required>
                    </div>

                    {{--PLOT NUBMER--}}
                    <div id="plot-number" class="labels">
                        <p class="plot-number__title">Номер участка</p>
                        <input type="number" name="plot_number" id="plot_number" class="form-control" min="1">
                    </div>
                </fieldset>

                {{--ABOUT LAND PLOT--}}
                <fieldset>
                    <h5>Информация об объекте</h5>

                    {{--AREA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="area" id="area" class="form-control" min="1" required>
                            <p>сот.</p>
                        </div>
                    </div>

                    {{--STATUS--}}
                    <div id="plot-status" class="labels">
                        <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                        <textarea name="status" id="status" cols="30" rows="5" class="form-control" required
                                  placeholder="Кратко опишите в каком состоянии сейчас находится участок."></textarea>
                    </div>
                </fieldset>

                {{--DESCRIPTION AND IMAGES--}}
                <fieldset>
                    {{--DESCRIPTION--}}
                    <div id="plot-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control" required
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."></textarea>
                    </div>

                    {{--IMAGES--}}
                    <div id="plot-images">
                        <h5>Фотографии</h5>
                        <p>Объявления с фотографиями привлекают больше потенциальных покупателей. Не допускаются к
                            размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные баннер.
                            Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ. Можно загрузить до
                            десяти изображений. Первое из них будет являтся главным в объявлении.</p>
                        <label for="images" class="label-images">
                            <p>ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                            <input type="file" name="images" id="images" class="form-control"
                                   accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)" multiple>
                            <div id="images-prev"></div>
                        </label>
                        <p id="images-error"></p>
                    </div>
                </fieldset>

                {{--CHARACTERISTICS--}}
                <fieldset>
                    <h5>Удобства на объекте</h5>

                    <div id="characteristics">
                        @foreach($characteristics as $charact)
                            <label>
                                <input type="checkbox" name="checkboxes[]" id="{{ $charact->id }}"
                                       class="form-check-input"
                                       value="{{ $charact->id }}"
                                    {{ old($charact->name) ? 'checked' : '' }}>
                                {{ $charact->name }}
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                {{--PRICE--}}
                <div id="set-price">
                    <h5>Цена</h5>
                    <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил публикации.
                        Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать
                        непосредственно с самим риелтором, так
                        как у каждого свой тариф.</p>

                    <div class="labels">
                        <p class="se-price__title">Цена <span class="sign-required">*</span></p>
                        <div class="set-price__input">
                            <input type="number" name="price" id="price" class="form-control" required>
                            <p>₽</p>
                        </div>
                    </div>
                </div>

                <button class="btn btn-filled btn-submit">Подать объявление</button>
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

            let res = await postJSON('{{ route("landplots.store") }}', formData, "{{ csrf_token() }}");
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
