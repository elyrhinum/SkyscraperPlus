@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
@section('title', 'Подать объявление о комнате')
@section('content')
    <div class="main-container pd">
        {{--ЗАГОЛОВОК С ИНСТРУКЦИЕЙ--}}
        <div class="headers">
            <h3>Подать объявление о комнате</h3>
            <p>Ниже представлена форма, поля которой необходимо заполнить для того, чтобы в дальнейшем отправить
                объявление на рассмотрение модераторам.</p>
            <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
        </div>

        {{--ФОРМА--}}
        <div class="forms">
            <form method="post" enctype="multipart/form-data" id="form">
                {{--ТИПЫ ДОГОВОРА--}}
                <div id="contract-types">
                    <h5>Вид договора</h5>

                    <div class="labels">
                        <p class="contract-types__title">Вид договора <span class="sign-required">*</span></p>
                        <select class="form-select contract-types__select"
                                name="contract_id">
                            @foreach($contract_types as $contract)
                                <option value="{{ $contract->id }}"
                                    {{ old('contract') == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--ЖИЛОЙ КОМПЛЕКС--}}
                <div id="residential-complexes">
                    <h5>Жилой комплекс</h5>

                    <div class="labels">
                        <p class="residential-complexes__title">Жилой комплекс</p>
                        <select class="form-select residential-complexes__select"
                                id="residential_complex_id" name="residential_complex_id">
                            <option value="Не выбрано">Не выбрано</option>
                            @foreach($complexes as $complex)
                                <option value="{{ $complex->id }}"
                                    {{ old('complex') == $complex->id ? 'selected' : '' }}>{{ $complex->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--МЕСТОПОЛОЖЕНИЕ--}}
                <fieldset>
                    <h5>Адрес объекта</h5>

                    {{--РАЙОН--}}
                    <div id="districts" class="labels">
                        <p class="districts__title">Район <span class="sign-required">*</span></p>
                        <div id="rendering-select">
                            <select class="form-select districts__select"
                                    id="district_id" name="district_id">
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{--УЛИЦА--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street"
                               placeholder="В формате ул. Гагарина или пр. Ленина"
                               {{ old('street') }} required>
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option>{{ $street->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--НОМЕР УЛИЦЫ--}}
                    <div id="street-number" class="labels">
                        <p class="building-number__title">Номер улицы <span class="sign-required">*</span></p>
                        <input type="number" name="street_number" id="street_number" class="form-control"
                               min="1" {{ old('street_number') }} required>
                    </div>

                    {{--ПОДЪЕЗД--}}
                    <div id="entrance-number" class="labels">
                        <p class="entrance-number__title">Номер подъезда <span class="sign-required">*</span></p>
                        <input type="number" name="entrance" id="entrance" class="form-control"
                               min="1" {{ old('entrance') }} required>
                    </div>

                    {{--ИНФОРМАЦИЯ ОБ ЭТАЖАХ--}}
                    <div id="building-floors" class="labels">
                        <p class="floors__title">Этаж <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="floor" id="floor" class="form-control" min="1"
                                   {{ old('floor') }} required>
                            <p>из</p>
                            <input type="number" name="floors" id="floors" class="form-control" min="1"
                                   {{ old('floors') }} required>
                        </div>
                        <p id="floor-error"></p>
                    </div>

                    {{--НОМЕР КОМНАТЫ--}}
                    <div id="number" class="labels">
                        <p class="number__title">Номер комнаты <span class="sign-required">*</span></p>
                        <input type="number" name="number" id="number" class="form-control"
                               min="1" {{ old('number') }} required>
                    </div>
                </fieldset>

                {{--ИНФОРМАЦИЯ ОБ ОБЪЕКТЕ НЕДВИЖИМОСТИ--}}
                <fieldset>
                    <h5>Информация об объекте</h5>

                    {{--ПЛОЩАДЬ КОМНАТЫ--}}
                    <div id="room-area" class="labels">
                        <p class="room-area__title">Площадь комнаты <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="area" id="area" class="form-control"
                                   min="1" {{ old('area') }} required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--ЖИЛАЯ ПЛОЩАДЬ--}}
                    <div id="living-area" class="labels">
                        <p class="living-area__title">Жилая площадь <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="living_area" id="living_area" class="form-control"
                                   {{ old('living_area') }} min="1" required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--ОБЩАЯ ПЛОЩАДЬ--}}
                    <div id="total-area" class="labels">
                        <p class="total-area__title">Общая площадь <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="total_area" id="total_area" class="form-control"
                                   {{ old('total_area') }} min="1" required>
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--ПЛОЩАДЬ КУХНИ--}}
                    <div id="kitchen-area" class="labels">
                        <p class="kitchen-area__title">Площадь кухни</p>
                        <div>
                            <input type="number" name="kitchen_area" id="kitchen_area" class="form-control"
                                   {{ old('kitchen_area') }} min="1">
                            <p>м<sup>2</sup></p>
                        </div>
                    </div>

                    {{--ВЫСОТА ПОТОЛКОВ--}}
                    <div id="ceiling-height" class="labels">
                        <p class="ceiling-height__title">Высота потолков</p>
                        <div>
                            <input type="number" name="ceiling_height" id="ceiling_height" class="form-control"
                                   {{ old('ceiling_height') }} min="1">
                            <p>м</p>
                        </div>
                    </div>

                    {{--КОЛИЧЕСТВО ЖИЛЫХ КОМНАТ--}}
                    <div id="living-rooms-amount" class="labels">
                        <p class="living-rooms-amount__title">Количество жилых комнат <span
                                class="sign-required">*</span></p>
                        <input type="number" name="living_rooms_amount" id="living_rooms_amount" class="form-control"
                               min="1" required>
                    </div>

                    {{--BATHROOMS AMOUNT--}}
                    <div id="bathrooms-amount" class="labels">
                        <p class="bathrooms-amount__title">Количество санузлов <span class="sign-required">*</span></p>
                        <input type="number" name="bathrooms_amount" id="bathrooms_amount" class="form-control" min="1"
                               required>
                    </div>

                    {{--BATHROOM TYPE--}}
                    <div id="bathroom-type" class="labels">
                        <p class="bathroom-type__title">Санузел</p>
                        <select class="form-select bathroom-type__select" name="bathroom_type">
                            <option value="Раздельный"
                                {{ old('bathroom_type') == 'Раздельный' ? 'selected' : '' }}>Раздельный
                            </option>
                            <option value="Совмещенный"
                                {{ old('bathroom_type') == 'Совмещенный' ? 'selected' : '' }}>Совмещенный
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
                                    <option value="{{ $repair->id }}"
                                        {{ old('repair') == $repair->name ? 'selected' : '' }}>{{ $repair->name }}</option>
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
                        <input type="number" name="building_year" id="building_year" class="form-control" min="1700">
                        <p id="year-error"></p>
                    </div>

                    {{--BUILDING TYPE--}}
                    <div id="building-type" class="labels">
                        <p class="building-type__title">Материал здания</p>
                        <select class="form-select building-type__select" name="building_type">
                            <option value="Кирпичный"
                                {{ old('building_type') == 'Кирпичный' ? 'selected' : '' }}>Кирпичный
                            </option>
                            <option value="Монолитный"
                                {{ old('building_type') == 'Монолитный' ? 'selected' : '' }}>Монолитный
                            </option>
                            <option value="Панельный"
                                {{ old('building_type') == 'Панельный' ? 'selected' : '' }}>Панельный
                            </option>
                            <option value="Блочный"
                                {{ old('building_type') == 'Блочный' ? 'selected' : '' }}>Блочный
                            </option>
                            <option value="Деревянный"
                                {{ old('building_type') == 'Деревянный' ? 'selected' : '' }}>Деревянный
                            </option>
                            <option value="Монолитно-кирпичный"
                                {{ old('building_type') == 'Монолитно-кирпичный' ? 'selected' : '' }}>
                                Монолитно-кирпичный
                                блок
                            </option>
                            <option value="Сталинский"
                                {{ old('building_type') == 'Сталинский' ? 'selected' : '' }}>Сталинский
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
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."></textarea>
                    </div>

                    {{--LAYOUT--}}
                    <div id="layout-image">
                        <h5>Планировка</h5>
                        <p>Объявления с планирвкой привлекают больше потенциальных покупателей. Не допускаются к
                            размещению изображения планировки с водяными знаками, чужих объектов недвижимости и
                            рекламные баннер.
                            Разрешенные форматы: JPG, JPEG, PNG. Максимальный размер файла 10 МБ.</p>
                        <label for="layout" class="label-layout">
                            <p>ЗАГРУЗИТЕ ПЛАНИРОВКУ</p>
                            <input type="file" name="layout" id="layout" class="form-control"
                                   accept="image/jpg, image/jpeg, image/png">
                            <div id="layout-prev"></div>
                        </label>
                    </div>

                    {{--IMAGES--}}
                    <div id="room-images">
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

                <p id="submit-error"></p>
                <button class="btn btn-filled btn-submit">Подать объявление</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/formform-uploading.js') }}"></script>

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

        // ПРЕВЬЮ ПЛАНИРОВКИ
        layout.addEventListener('change', (e) => {
            layoutPrev.innerHTML = ''
            let image = document.createElement('img')
            image.style.display = 'block'
            image.style.width = '150px'
            image.style.height = '150px'
            image.style.objectFit = 'cover'
            image.src = URL.createObjectURL(e.target.files[0])
            image.alt = "img"
            layoutPrev.append(image)
        })

        // ПРОВЕРКА НА СОВМЕСТИМОСТЬ ЭТАЖЕЙ
        floor.addEventListener('input', (e) => {
            const floors = document.getElementById('floors');

            if (e.target.value > floors.value) {
                floorError.textContent = 'Этаж квартиры не должен превышать общее количество этажей';
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их'
                btnSubmit.disabled = true;
            } else {
                floorError.textContent = '';
                submitError.textContent = '';
                btnSubmit.disabled = false;
            }
        });

        floors.addEventListener('input', (e) => {
            const floor = document.getElementById('floor');

            if (e.target.value < floor.value) {
                floorError.textContent = 'Этаж квартиры не должен превышать общее количество этажей';
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их'
                btnSubmit.disabled = true;
            } else {
                floorError.textContent = '';
                submitError.textContent = '';
                btnSubmit.disabled = false;
            }
        });

        // ПРОВЕРКА НА СОВПАДЕНИЕ РАЙОНА ЖИЛОГО КОМПЛЕКСА И ОБЪЕКТА
        complexSelect.addEventListener('input', async () => {
            const complex_district = complexSelect.value;

            if (complex_district !== 'Не выбрано') {
                let res = await districtPostJSON('{{ route('complexes.get-district') }}', complex_district, '{{ csrf_token() }}');
                renderSelect.inerrHTML = '';
                renderSelect.innerHTML = `<select class="form-select districts__select"
                                id="district_id" name="district_id">
                <option value="${ res.id}">${ res.name }</option>
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

        // ПРОВЕРКА НА ПРЕВЫШЕНИЕ НЫНЕШНЕГО ГОДА
        buildingYear.addEventListener('input', () => {
            const year = new Date().getFullYear(),
                buildingYear = document.getElementById('building_year');

            if (buildingYear.value < 1700 || buildingYear.value > year) {
                btnSubmit.disabled = true;
                yearError.textContent = 'Год постройки не может быть меньше 1700 и больше нынешнего'
            } else {
                yearError.textContent = '';
                btnSubmit.disabled = false;
            }
        });

        // ОТПРАВКА ИЗОБРАЖЕНИЙ И ПЕРЕНАПРАВЛЕНИЕ
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

                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                return formData;
            }

            let res = await postJSON('{{ route("rooms.store") }}', formData, "{{ csrf_token() }}");
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
