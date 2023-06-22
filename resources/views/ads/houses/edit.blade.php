@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
<link rel="stylesheet" href="{{ asset('css/ads/houses/create.css') }}">
@section('title', 'Редактировать объявление об участке с домом')
@section('content')
    <div class="main-container pd">
        {{--HEADER WITH INSTRUCTION--}}
        <div class="headers">
            <div class="headers__inner">
                <h3>Редактировать объявление об участке с домом</h3>
                <p>Ниже представлена форма, поля которой необходимо заполнить или изменить для того, чтобы в дальнейшем
                    отправить объявление на повторное рассмотрение модераторам.</p>
                <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                    для заполнения. Повторное рассмотрение объявления может занять около 7 дней.</p>
            </div>
        </div>

        <div class="common">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--PLOT TYPE--}}
                <div id="type">
                    <div class="mb-3">
                        <h5 class="mb-1">Тип объекта</h5>
                        <p>Необходимо выбрать более конкретный тип объекта недвижимости: коттедж или дачный
                            участок. </p>
                    </div>

                    <div class="labels">
                        <p>Тип объекта <span class="sign-required">*</span></p>
                        <select class="form-select type__select" name="type_id">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ $type->id == $ad->object->type_id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--CONTRACT TYPE--}}
                <div id="contract-types">
                    <h5>Вид договора</h5>

                    <div class="labels">
                        <p class="contract-types__title">Вид договора <span class="sign-required">*</span></p>
                        <select class="form-select contract-types__select"
                                name="contract_id">
                            @foreach($contract_types as $contract)
                                <option value="{{ $contract->id }}"
                                    {{ $contract->id == $ad->contract_id ? 'selected' : '' }}>
                                    {{ $contract->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--ADDRESS--}}
                <fieldset>
                    <h5>Адрес объекта</h5>

                    {{--DISTRICT--}}
                    <div id="districts" class="labels">
                        <p class="districts__title">Район <span class="sign-required">*</span></p>
                        <select class="form-select districts__select" name="district_id">
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district') ?? $ad->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{--STREET--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street"
                               value="{{ $ad->street->name }}" required>
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option {{ old('street') ?? $ad->street_id == $street->id ? 'selected' : '' }}>
                                    {{ $street->name }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--STREET'S NUMBER--}}
                    <div id="plot-number" class="labels">
                        <p class="plot-number__title">Номер здания <span class="sign-required">*</span></p>
                        <input type="number" name="street_number" id="street_number" class="form-control"
                               min="1" value="{{ old('street_number') ?? $ad->object->street_number }}" required>
                    </div>

                    {{--PLOT'S NUMBER--}}
                    <div id="plot-number" class="labels">
                        <p class="plot-number__title">Номер участка</p>
                        <input type="number" name="plot_number" id="plot_number" class="form-control"
                               min="1" value="{{ old('plot_number') ?? $ad->object->plot_number }}">
                    </div>
                </fieldset>

                {{--ABOUT BUILDING--}}
                <fieldset>
                    <h5>Информация о здании на участке</h5>

                    {{--PLOT AREA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь дома <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="building_area" id="building_area" class="form-control"
                                   min="1" value="{{ old('building_area') ?? $ad->object->building_area }}" required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--FLOORS AMOUNT--}}
                    <div id="floors-amount" class="labels">
                        <p class="floors-amount__title">Количество этажей</p>
                        <input type="number" name="floors" id="floors" class="form-control"
                               min="1" value="{{ old('floors') ?? $ad->object->floors }}">
                    </div>

                    {{--BEDROOMS AMOUNT--}}
                    <div id="bedrooms-amount" class="labels">
                        <p class="bedrooms-amount__title">Количество спален</p>
                        <input type="number" name="bedrooms" id="bedrooms" class="form-control"
                               min="1" value="{{ old('bedrooms') ?? $ad->object->bedrooms }}">
                    </div>

                    {{--BATHROOMS AMOUNT--}}
                    <div id="bathrooms-amount" class="labels">
                        <p class="bathrooms-amount__title">Количество санузлов</p>
                        <input type="number" name="bathrooms" id="bathrooms" class="form-control"
                               min="1" value="{{ old('bathrooms') ?? $ad->object->bathrooms }}">
                    </div>

                    {{--BATHROOMS PLACE--}}
                    <div id="bathroom-place" class="labels">
                        <p class="bathroom-place__title">Санузел</p>
                        <select class="form-select bathroom-place__select" name="bathroom_place">
                            <option value="На улице"
                                {{ old('bathroom_place') ?? $ad->object->bathroom_place == 'На улице' ? 'selected' : '' }}>
                                На улице
                            </option>
                            <option value="В доме"
                                {{ old('bathroom_place') ?? $ad->object->bathroom_place == 'В доме' ? 'selected' : '' }}>
                                В доме
                            </option>
                        </select>
                    </div>

                    {{--BUILDING'S YEAR--}}
                    <div id="building-year" class="labels">
                        <p class="building-year__title">Год постройки</p>
                        <input type="number" name="building_year" id="building_year" class="form-control"
                               min="1700" value="{{ old('building_year') ?? $ad->object->building_year }}">
                        <p id="year-error"></p>
                    </div>

                    {{--BUILDING'S MATERIAL--}}
                    <div id="house-material" class="labels">
                        <p class="house-material__title">Материал здания</p>
                        <select class="form-select house-material__select" name="building_material">
                            <option value="Кирпичный"
                                {{ old('house_material') ?? $ad->object->house_material == 'Кирпичный' ? 'selected' : '' }}>
                                Кирпичный
                            </option>
                            <option value="Монолитный"
                                {{ old('house_material') ?? $ad->object->house_material == 'Монолитный' ? 'selected' : '' }}>
                                Монолитный
                            </option>
                            <option value="Деревянный"
                                {{ old('house_material') ?? $ad->object->house_material == 'Деревянный' ? 'selected' : '' }}>
                                Деревянный
                            </option>
                            <option value="Щитовой"
                                {{ old('house_material') ?? $ad->object->house_material == 'Щитовой' ? 'selected' : '' }}>
                                Щитовой
                            </option>
                            <option value="Каркасный"
                                {{ old('house_material') ?? $ad->object->house_material == 'Каркасный' ? 'selected' : '' }}>
                                Каркасный
                            </option>
                            <option value="Газобетонный блок"
                                {{ old('house_material') ?? $ad->object->house_material == 'Газобетонный блок' ? 'selected' : '' }}>
                                Газобетонный
                                блок
                            </option>
                            <option value="Газосиликатный блок"
                                {{ old('house_material') ?? $ad->object->house_material == 'Газосиликатный блок' ? 'selected' : '' }}>
                                Газосиликатный
                                блок
                            </option>
                            <option value="Пенобетонный блок"
                                {{ old('house_material') ?? $ad->object->house_material == 'Пенобетонный блок' ? 'selected' : '' }}>
                                Пенобетонный
                                блок
                            </option>
                        </select>
                    </div>

                    {{--BUILDING'S STATUS--}}
                    <div id="building-status" class="labels">
                        <p class="building-status__title">Состояние здания <span class="sign-required">*</span></p>
                        <textarea name="building_status" id="building_status" cols="30" rows="5" class="form-control"
                                  placeholder="Кратко опишите в каком состоянии сейчас находится здание на участке"
                                  required>{{ $ad->object->building_status }}</textarea>
                    </div>
                </fieldset>

                {{--ABOUT PLOT--}}
                <fieldset>
                    <h5>Информация об участке</h5>

                    {{--PLOT'S ATEA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="plot_area" id="plot_area" class="form-control"
                                   value="{{ old('plot_area') ?? $ad->object->plot_area }}" min="1" required>
                            <p>сот.</p>
                        </div>
                    </div>

                    {{--PLOT'S AREA--}}
                    <div id="plot-status" class="labels">
                        <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                        <textarea name="plot_status" id="plot_status" cols="30" rows="5" class="form-control"
                                  placeholder="Кратко опишите в каком состоянии сейчас находится участок"
                                  required>{{ $ad->object->plot_status }}</textarea>
                    </div>
                </fieldset>

                {{--DESCRIPTION AND IMAGES--}}
                <fieldset>
                    {{--DESCRIPTION--}}
                    <div id="plot-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control"
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."
                                  required>{{ $ad->description }}</textarea>
                    </div>

                    {{--IMAGES--}}
                    <div id="plot-images">
                        <div class="mb-3">
                            <h5 class="mb-1">Фотографии</h5>
                            <p>Объявления с фотографиями привлекают больше потенциальных покупателей. Не допускаются к
                                размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные
                                баннер.
                                Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ. Можно загрузить до
                                десяти изображений. Первое из них будет являтся главным в объявлении.</p>
                        </div>

                        <div class="label-images">
                            <label for="images">
                                <p class="label-images__title">ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                                <input type="file" name="images" id="images" class="form-control"
                                       accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)"
                                       multiple>
                            </label>
                            <div>
                                <div id="old-images-prev">
                                    @foreach($ad->images as $image)
                                        <div class="images-block">
                                            <img src="{{ $image->image }}" alt="{{ $ad->getNameOfObject() }}">
                                            <p data-index="{{ $image->id }}" onclick="deleteCurrentImg(event)">×</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="images-prev"></div>
                            </div>
                            <p id="images-error"></p>
                        </div>
                    </div>
                </fieldset>

                {{--CHARACTERISTICS--}}
                <fieldset>
                    <h5>Удобства на участке</h5>

                    <div id="characteristics">
                        @foreach($characteristics as $charact)
                            <label>
                                <input type="checkbox" name="checkboxes[]" id="{{ $charact->id }}"
                                       class="form-check-input"
                                       value="{{ $charact->id }}"
                                    {{ old($charact->name) ?? count($ad_characteristics->where('characteristic_id', $charact->id)) > 0 ? 'checked' : '' }}>
                                {{ $charact->name }}
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                {{--PRICE--}}
                <div id="set-price">
                    <div class="mb-3">
                        <h5 class="mb-1">Цена</h5>
                        <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил
                            публикации.
                            Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать лично,
                            так
                            как у каждого из риелторов свой тариф.</p>
                    </div>

                    <div class="labels">
                        <p class="set-price__title">Цена<span class="sign-required">*</span></p>
                        <div class="set-price__input">
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{ old('price') ?? $ad->price }}" required>
                            <p>₽</p>
                        </div>
                    </div>
                </div>

                <p id="submit-error"></p>
                <button class="btn btn-filled btn-submit">Подать объявление</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/form-uploading.js') }}"></script>

    <script>
        const btnSubmit = document.querySelector('.btn-submit'),
            buildingYear = document.getElementById('building_year'),
            submitError = document.getElementById('submit-error'),
            yearError = document.getElementById('year-error'),
            oldCont = document.querySelector('#old-images-prev'),
            form = document.querySelector('#form'),
            imagesError = document.querySelector('#images-error');

        // UPLOADING IMAGES
        function handleChange(e) {
            if (!e.target.files.length) {
                return;
            }

            let oldLength = filesStore.length;

            [...e.target.files].forEach(item => {
                if (item.size / 1024 > 10) {
                    filesStore.push(item);
                }
            })

            let newLength = filesStore.length;
            let amountLoaded = newLength - oldLength;
            let imagesAmount = document.querySelectorAll('.images-block').length;
            let imagesInOldCont = oldCont.querySelectorAll('.images-block').length;

            if (imagesAmount > 10 || amountLoaded > 10 - imagesAmount) {
                imagesError.textContent = 'Изображений должно быть меньше 10!';
                filesStore.splice(10 - imagesInOldCont,
                    imagesAmount + amountLoaded - 10);
            }

            cont.textContent = '';

            filesStore.forEach((item, key) => {
                cont.insertAdjacentHTML('beforeend', `
                <div class="images-block">
                    <img src="${URL.createObjectURL(item)}" alt="Фотография">
                    <p data-index="${key}" onclick="deleteImg(event)">×</p>
                </div>`);
            })
            e.target.value = '';
        }

        // CHECKING THAT YEAR DON'T EXCEED CURRENT YEAR
        buildingYear.addEventListener('input', () => {
            const year = new Date().getFullYear(),
                buildingYear = document.getElementById('building_year');

            if ((buildingYear.value < 1700 || buildingYear.value > year) && buildingYear.value.length > 0) {
                btnSubmit.disabled = true;
                yearError.textContent = 'Год постройки не может быть меньше 1700 и больше нынешнего';
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их';
            } else if (buildingYear.value.length === 0) {
                yearError.textContent = '';
                submitError.textContent = '';
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = false;
                yearError.textContent = '';
                submitError.textContent = '';
            }
        });

        // DELETING IMAGE
        async function deleteCurrentImg(e) {
            let result = await dataPostJSON('{{ route("ads.deleteImg")}}', e.target.dataset.index, "{{ csrf_token() }}");
            e.target.parentNode.textContent = '';
            console.log(result)
        }

        // UPLOADING IMAGES AND REDIRECT TO METHOD
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

                return formData;
            }

            let res = await postJSON('{{ route("houses.update", $ad->id) }}', formData, "{{ csrf_token() }}");
            if (res != null) {
                location = "{{ route('users.account') }}";
            }
        })
    </script>
@endpush
