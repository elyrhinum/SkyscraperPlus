@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
<link rel="stylesheet" href="{{ asset('css/ads/houses/create.css') }}">
@section('title', 'Подать объявление об участке с домом')
@section('content')
    <div class="main-container pd">
        {{--HEADERS WITH INSTRUCTIONS--}}
        <div class="headers">
            <h3>Подать новое объявление об участке с домом</h3>
            <p>Ниже представлена форма, поля которой необходимо заполнить для того, чтобы в дальнейшем отправить
                объявление на рассмотрение модераторам.</p>
            <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
        </div>

        {{--FORM--}}
        <div class="forms">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--TYPE OF OBJECT--}}
                <div id="type">
                    <h5>Тип объекта</h5>
                    <p>Необходимо выбрать более конкретный тип объекта недвижимости: коттедж или дачный участок. </p>
                    <div class="labels">
                        <p>Тип объекта <span class="sign-required">*</span></p>
                        <select class="form-select type__select" name="type_id">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('type') == $type->name ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
                        <select class="form-select districts__select" name="district_id">
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district') == $district->name ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--STREETS--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street" required>
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

                {{--ABOUT BUILDING--}}
                <fieldset>
                    <h5>Информация о здании на участке</h5>

                    {{--AREA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь дома <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="building_area" id="building_area" class="form-control" min="1"
                                   required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--AMOUNT OF FLOORS--}}
                    <div id="floors-amount" class="labels">
                        <p class="floors-amount__title">Количество этажей</p>
                        <input type="number" name="floors" id="floors" class="form-control" min="1">
                    </div>

                    {{--AMOUNT OF BEDROOMS--}}
                    <div id="bedrooms-amount" class="labels">
                        <p class="bedrooms-amount__title">Количество спален</p>
                        <input type="number" name="bedrooms" id="bedrooms" class="form-control" min="1">
                    </div>

                    {{--AMOUNT OF BATHROOMS--}}
                    <div id="bathrooms-amount" class="labels">
                        <p class="bathrooms-amount__title">Количество санузлов</p>
                        <input type="number" name="bathrooms" id="bathrooms" class="form-control" min="1">
                    </div>

                    {{--BATHROOMS PLACE--}}
                    <div id="bathrooms-place" class="labels">
                        <p class="bathrooms-place__title">Санузел</p>
                        <select class="form-select bathrooms-place__select" name="bathrooms_place">
                            <option value="На улице"
                                {{ old('bathrooms_place') == 'На улице' ? 'selected' : '' }}>На улице
                            </option>
                            <option value="В доме"
                                {{ old('bathrooms_place') == 'В доме' ? 'selected' : '' }}>В доме
                            </option>
                        </select>
                    </div>

                    {{--YEAR OF BUILDING THE HOUSE--}}
                    <div id="building-year" class="labels">
                        <p class="building-year__title">Год постройки</p>
                        <input type="number" name="building_year" id="building_year" class="form-control" min="1337">
                    </div>

                    {{--HOUSE MATERIAL--}}
                    <div id="house-material" class="labels">
                        <p class="house-material__title">Материал здания</p>
                        <select class="form-select house-material__select" name="building_material">
                            <option value="Кирпичный"
                                {{ old('building_material') == 'Кирпичный' ? 'selected' : '' }}>Кирпичный
                            </option>
                            <option value="Монолитный"
                                {{ old('building_material') == 'Монолитный' ? 'selected' : '' }}>Монолитный
                            </option>
                            <option value="Деревянный"
                                {{ old('building_material') == 'Деревянный' ? 'selected' : '' }}>Деревянный
                            </option>
                            <option value="Щитовой"
                                {{ old('building_material') == 'Щитовой' ? 'selected' : '' }}>Щитовой
                            </option>
                            <option value="Каркасный"
                                {{ old('building_material') == 'Каркасный' ? 'selected' : '' }}>Каркасный
                            </option>
                            <option value="Газобетонный блок"
                                {{ old('building_material') == 'Газобетонный блок' ? 'selected' : '' }}>Газобетонный
                                блок
                            </option>
                            <option value="Газосиликатный блок"
                                {{ old('building_material') == 'Газосиликатный блок' ? 'selected' : '' }}>Газосиликатный
                                блок
                            </option>
                            <option value="Пенобетонный блок"
                                {{ old('building_material') == 'Пенобетонный блок' ? 'selected' : '' }}>Пенобетонный
                                блок
                            </option>
                        </select>
                    </div>

                    {{--STATUS--}}
                    <div id="building-status" class="labels">
                        <p class="building-status__title">Состояние участка <span class="sign-required">*</span></p>
                        <textarea name="building_status" id="building_status" cols="30" rows="5" class="form-control"
                                  placeholder="Кратко опишите в каком состоянии сейчас находится здание на участке."
                                  required></textarea>
                    </div>
                </fieldset>

                {{--INFO ABOUT OBJECT--}}
                <fieldset>
                    <h5>Информация об участке</h5>

                    {{--PLOT AREA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="plot_area" id="plot_area" class="form-control" min="1" required>
                            <p>сот.</p>
                        </div>

                    </div>

                    {{--STATUS--}}
                    <div id="plot-status" class="labels">
                        <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                        <textarea name="plot_status" id="plot_status" cols="30" rows="5" class="form-control"
                                  placeholder="Кратко опишите в каком состоянии сейчас находится участок."
                                  required></textarea>
                    </div>
                </fieldset>

                <fieldset>
                    {{--DESCRIPTION--}}
                    <div id="plot-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control"
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."
                                  required></textarea>
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

                <fieldset>
                    <h5>Удобства на участке</h5>

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

                <div id="set-price">
                    <h5>Цена <span class="sign-required">*</span></h5>
                    <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил публикации.
                        Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать лично, так
                        как у каждого из риелторов свой тариф.</p>

                    <div class="labels">
                        <p class="set-price__title">Цена</p>
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
    <script src="{{ asset('/js/image-uploading.js') }}"></script>

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

            let res = await postJSON('{{ route("houses.store") }}', formData, "{{ csrf_token() }}");
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
