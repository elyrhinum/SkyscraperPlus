@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
@section('title', 'Редактировать объявление о квартире')
@section('content')
    <div class="main-container pd">
        {{--HEADERS WITH INSTRUCTIONS--}}
        <div class="headers">
            <div class="headers__inner">
                <h3>Редактировать объявление о квартире</h3>
                <p>Ниже представлена форма, поля которой необходимо заполнить или изменить для того, чтобы в дальнейшем
                    отправить объявление на повторное рассмотрение модераторам.</p>
                <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                    для заполнения. Повторное рассмотрение объявления может занять около 7 дней.</p>
            </div>
        </div>

        <div class="common">
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
                                    {{ $contract->id == $ad->contract_id ? 'selected' : '' }}>
                                    {{ $contract->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--RESIDENTIAL COMPLEXES--}}
                <div id="residential-complexes">
                    <h5>Жилой комплекс</h5>

                    <div class="labels">
                        <p class="residential-complexes__title">Жилой комплекс</p>
                        <select class="form-select residential-complexes__select"
                                id="residential_complex_id" name="residential_complex_id">
                            <option value="Не выбрано">Не выбрано</option>
                            @foreach($complexes as $complex)
                                <option value="{{ $complex->id }}"
                                    {{ $complex->id == $ad->object->resident_complex_id ? 'selected' : '' }}>
                                    {{ $complex->name }}
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
                        <div id="rendering-select">
                            <select class="form-select districts__select"
                                    id="district_id" name="district_id">
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ old('district') ?? $ad->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{--STREET--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street" required
                               value="{{ $ad->street->name }}" placeholder="В формате ул. Гагарина или пр. Ленина">
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option {{ old('street') ?? $ad->street_id == $street->id ? 'selected' : '' }}>
                                    {{ $street->name }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--STREET NUBMER--}}
                    <div id="street-number" class="labels">
                        <p class="building-number__title">Номер улицы <span class="sign-required">*</span></p>
                        <input type="number" name="street_number" id="street_number" class="form-control" min="1"
                               value="{{ old('street_number') ?? $ad->object->street_number }}" required>
                    </div>

                    {{--ENTRANCE--}}
                    <div id="entrance-number" class="labels">
                        <p class="entrance-number__title">Номер подъезда <span class="sign-required">*</span></p>
                        <input type="number" name="entrance" id="entrance" class="form-control" min="1"
                               value="{{ old('entrance') ?? $ad->object->entrance }}" required>
                    </div>

                    {{--FLOORS--}}
                    <div id="building-floors" class="labels">
                        <p class="floors__title">Этаж <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="floor" id="floor" class="form-control" min="1"
                                   value="{{ old('floor') ?? $ad->object->floor }}" required>
                            <p>из</p>
                            <input type="number" name="floors" id="floors" class="form-control" min="1"
                                   value="{{ old('floors') ?? $characteristics->floors }}" required>
                        </div>
                        <p id="floor-error"></p>
                    </div>

                    {{--FLAT NUMBER--}}
                    <div id="number" class="labels">
                        <p class="number__title">Номер квартиры <span class="sign-required">*</span></p>
                        <input type="number" name="number" id="number" class="form-control" min="1"
                               value="{{ old('number') ?? $ad->object->number }}" required>
                    </div>
                </fieldset>

                {{--ABOUT OBJECT--}}
                <fieldset>
                    <h5>Информация об объекте</h5>

                    {{--LIVING AREA--}}
                    <div id="living-area" class="labels">
                        <p class="living-area__title">Жилая площадь <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="living_area" id="living_area" class="form-control" min="1"
                                   value="{{ old('living_area') ?? $characteristics->living_area }}" required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--TOTAL AREA--}}
                    <div id="total-area" class="labels">
                        <p class="total-area__title">Общая площадь <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="total_area" id="total_area" class="form-control" min="1"
                                   value="{{ old('total_area') ?? $characteristics->total_area }}" required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--KITCHEN AREA--}}
                    <div id="kitchen-area" class="labels">
                        <p class="kitchen-area__title">Площадь кухни</p>
                        <div>
                            <input type="number" name="kitchen_area" id="kitchen_area" class="form-control"
                                   value="{{ old('kitchen_area') ?? $characteristics->kitchen_area }}" min="1">
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--CEILING HEIGHT--}}
                    <div id="ceiling-height" class="labels">
                        <p class="ceiling-height__title">Высота потолков</p>
                        <div>
                            <input type="number" name="ceiling_height" id="ceiling_height" class="form-control"
                                   value="{{ old('ceiling_height') ?? $characteristics->ceiling_height }}" min="1">
                            <p>м</p>
                        </div>
                    </div>

                    {{--LIVING ROOMS AMOUNT--}}
                    <div id="living-rooms-amount" class="labels">
                        <p class="living-rooms-amount__title">Количество жилых комнат <span
                                class="sign-required">*</span></p>
                        <select name="living_rooms_amount" class="form-control" id="living_rooms_amount">
                            <option
                                value="1" {{ old('living_rooms_amount') ?? $characteristics->living_rooms_amount == '1' ? 'selected' : '' }}>
                                1
                            </option>
                            <option
                                value="2" {{ old('living_rooms_amount') ?? $characteristics->living_rooms_amount == '2' ? 'selected' : '' }}>
                                2
                            </option>
                            <option
                                value="3" {{ old('living_rooms_amount') ?? $characteristics->living_rooms_amount == '3' ? 'selected' : '' }}>
                                3
                            </option>
                            <option
                                value="4+" {{ old('living_rooms_amount') ?? $characteristics->living_rooms_amount == '4+' ? 'selected' : '' }}>
                                4+
                            </option>
                        </select>
                    </div>

                    {{--BATHROOMS AMOUNT--}}
                    <div id="bathrooms-amount" class="labels">
                        <p class="bathrooms-amount__title">Количество санузлов <span class="sign-required">*</span></p>
                        <select name="bathrooms_amount" class="form-control" id="bathrooms_amount">
                            <option
                                value="1" {{ old('bathrooms_amount') ?? $characteristics->bathrooms_amount == '1' ? 'selected' : '' }}>
                                1
                            </option>
                            <option
                                value="2" {{ old('bathrooms_amount') ?? $characteristics->bathrooms_amount == '2' ? 'selected' : '' }}>
                                2
                            </option>
                            <option
                                value="3" {{ old('bathrooms_amount') ?? $characteristics->bathrooms_amount == '3' ? 'selected' : '' }}>
                                3
                            </option>
                            <option
                                value="4+" {{ old('bathrooms_amount') ?? $characteristics->bathrooms_amount == '4+' ? 'selected' : '' }}>
                                4+
                            </option>
                        </select>
                    </div>

                    {{--BATHROOM TYPE--}}
                    <div id="bathroom-type" class="labels">
                        <p class="bathroom-type__title">Санузел</p>
                        <select class="form-select bathroom-type__select" name="bathroom_type">
                            <option value="Раздельный"
                                {{ old('bathrooms_type') ?? $characteristics->bathrooms_type == 'Раздельный' ? 'selected' : '' }}>
                                Раздельный
                            </option>
                            <option value="Совмещенный"
                                {{ old('bathrooms_type') ?? $characteristics->bathrooms_type == 'Совмещенный' ? 'selected' : '' }}>
                                Совмещенный
                            </option>
                        </select>
                    </div>

                    {{--REPAIR TYPES--}}
                    <div id="repair-types">
                        <h5>Вид ремонта</h5>

                        <div class="labels">
                            <p class="repair-types__title">Вид ремонта <span class="sign-required">*</span></p>
                            <select class="form-select repair-types__select"
                                    name="repair_id">
                                @foreach($repair_types as $repair)
                                    <option value="{{ $repair->id }}" {{ old('repair_id') ?? $ad->repair_id == $repair->id ? 'selected' : '' }}>
                                        {{ $repair->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>

                {{--ABOUT BUILDING--}}
                <fieldset>
                    <h5>Информация о здании</h5>

                    {{--YEAR OF BUILDING--}}
                    <div id="building-year" class="labels">
                        <p class="building-year__title">Год постройки</p>
                        <input type="number" name="building_year" id="building_year" class="form-control" min="1700"
                               value="{{ old('building_year') ?? $characteristics->building_year }}">
                        <p id="year-error"></p>
                    </div>

                    {{--BUILDING TYPE--}}
                    <div id="building-type" class="labels">
                        <p class="building-type__title">Материал здания</p>
                        <select class="form-select building-type__select" name="building_type">
                            <option value="Кирпичный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Кирпичный' ? 'selected' : '' }}>
                                Кирпичный
                            </option>
                            <option value="Монолитный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Монолитный' ? 'selected' : '' }}>
                                Монолитный
                            </option>
                            <option value="Панельный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Панельный' ? 'selected' : '' }}>
                                Панельный
                            </option>
                            <option value="Блочный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Блочный' ? 'selected' : '' }}>
                                Блочный
                            </option>
                            <option value="Деревянный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Деревянный' ? 'selected' : '' }}>
                                Деревянный
                            </option>
                            <option value="Монолитно-кирпичный"
                                {{ old('building_type') ?? $characteristics->building_type == 'Монолитно-кирпичный' ? 'selected' : '' }}>
                                Монолитно-кирпичный
                                блок
                            </option>
                            <option value="Сталинский"
                                {{ old('building_type') ?? $characteristics->building_type == 'Сталинский' ? 'selected' : '' }}>
                                Сталинский
                                блок
                            </option>
                        </select>
                    </div>
                </fieldset>

                {{--DESCRIPTION AND IMAGES--}}
                <fieldset>
                    {{--DESCRIPTION--}}
                    <div id="room-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control" required
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также,
                                  можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности
                                  объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные
                                  данные и ссылки на другие ресурсы.">{{ $ad->description }}</textarea>
                    </div>

                    {{--LAYOUT--}}
                    <div id="layout-image">
                        <div class="mb-3">
                            <h5 class="mb-1">Планировка</h5>
                            <p>Объявления с планирвкой привлекают больше потенциальных покупателей. Не допускаются к
                                размещению изображения планировки с водяными знаками, чужих объектов недвижимости и
                                рекламные баннер.
                                Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ.</p>
                        </div>

                        <div class="label-layout">
                            <label for="layout">
                                <p class="label-layout__title">ЗАГРУЗИТЕ ПЛАНИРОВКУ</p>
                                <input type="file" name="layout" id="layout" class="form-control"
                                       accept="image/jpg, image/jpeg, image/png">
                            </label>
                            <div id="layout-prev">
                                <img src="{{ $ad->object->layout }}" alt="{{ $ad->getNameOfObject() }}">
                            </div>
                        </div>
                    </div>

                    {{--IMAGES--}}
                    <div id="room-images">
                        <div class="mb-3">
                            <h5 class="mb-1">Фотографии</h5>
                            <p>Объявления с фотографиями привлекают больше потенциальных покупателей. Не допускаются к
                                размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные
                                баннер. Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ. Можно загрузить до
                                десяти изображений. Первое из них будет являтся главным в объявлении.</p>
                        </div>

                        <div class="label-images">
                            <label for="images">
                                <p class="label-images__title">ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                                <input type="file" name="images" id="images" class="form-control"
                                       accept="image/jpg, image/jpeg, image/png" onchange="handleChange(event)"
                                       multiple>
                            </label>
                            <div id="images-prev">
                                @foreach($ad->images as $image)
                                    <div class="images-block">
                                        <img src="{{ $image->image }}" alt="{{ $ad->getNameOfObject() }}">
                                        <p data-index="{{ $image->id }}" onclick="deleteCurrentImg(event)">×</p>
                                    </div>
                                @endforeach
                            </div>
                            <p id="images-error"></p>
                        </div>
                    </div>
                </fieldset>

                {{--PRICE--}}
                <div id="set-price">
                    <div class="mb-3">
                        <h5 class="mb-1">Цена</h5>
                        <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил
                            публикации.
                            Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать
                            непосредственно с самим риелтором, так
                            как у каждого свой тариф.</p>
                    </div>

                    <div class="labels">
                        <p class="se-price__title">Цена <span class="sign-required">*</span></p>
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
        const btnSubmit = document.querySelector(".btn-submit"),
            layout = document.querySelector('#layout'),
            layoutPrev = document.querySelector('#layout-prev'),
            floor = document.getElementById('floor'),
            floors = document.getElementById('floors'),
            floorError = document.getElementById('floor-error'),
            submitError = document.getElementById('submit-error'),
            complexSelect = document.getElementById('residential_complex_id'),
            district = document.getElementById('district_id'),
            renderSelect = document.getElementById('rendering-select'),
            buildingYear = document.getElementById('building_year'),
            yearError = document.getElementById('year-error');

        // RENDER LAYOUT PREVIEW
        layout.addEventListener('change', (e) => {
            layoutPrev.innerHTML = ''
            let image = document.createElement('img')
            image.src = URL.createObjectURL(e.target.files[0])
            image.alt = "Планировка"
            layoutPrev.append(image)
        })

        // DELETING IMAGE
        async function deleteCurrentImg(e) {
            let result = await dataPostJSON('{{ route("ads.deleteImg")}}', e.target.dataset.index, "{{ csrf_token() }}");
            e.target.parentNode.textContent = '';
            console.log(result)
        }

        // CHECKING FOR COMPLIANCE OF FLOORS
        floor.addEventListener('input', (e) => {
            const floors = document.getElementById('floors');

            if (e.target.value - floors.value < 0) {
                floorError.textContent = 'Этаж квартиры не должен превышать общее количество этажей';
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их'
                btnSubmit.disabled = true;
            } else if (e.target.value - floors.value > 0) {
                floorError.textContent = '';
                submitError.textContent = '';
                btnSubmit.disabled = false;
            }
        });

        floors.addEventListener('input', (e) => {
            const floor = document.getElementById('floor');

            if (e.target.value - floor.value < 0) {
                floorError.textContent = 'Этаж квартиры не должен превышать общее количество этажей';
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их'
                btnSubmit.disabled = true;
            } else if (e.target.value - floor.value > 0) {
                floorError.textContent = '';
                submitError.textContent = '';
                btnSubmit.disabled = false;
            }
        });

        // CHECKING FOR MATCH OF RESIDENTIAL COMPLEX AND DISTRICT
        complexSelect.addEventListener('input', async () => {
            const complex_district = complexSelect.value;

            if (complex_district !== 'Не выбрано') {
                let res = await dataPostJSON('{{ route('complexes.get-district') }}', complex_district, '{{ csrf_token() }}');
                renderSelect.inerrHTML = '';
                renderSelect.innerHTML = `<select class="form-select districts__select"
                                id="district_id" name="district_id">
                <option value="${res.id}">${res.name}</option>
                </select>`;
            } else {
                renderSelect.inerrHTML = '';
                renderSelect.innerHTML = `<select class="form-select districts__select"
                                    id="district_id" name="district_id">
                                @foreach($districts as $district)
                <option value="{{ $district->id }}"
                                        {{ old('district') == $district->name ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                </select>`;
            }
        });

        // CHECKING THAT YEAR DO NOT EXCEED CURRENT YEAR
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

        // UPLOADING IMAGES AND REDIRECT TO METHOD
        btnSubmit.addEventListener('click', async e => {
            e.preventDefault();
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

            let res = await postJSON('{{ route("flats.update", $ad->id) }}', formData, "{{ csrf_token() }}");
            if (res != null) {
                location = "{{ route('users.account') }}";
            }
        })
    </script>
@endpush
