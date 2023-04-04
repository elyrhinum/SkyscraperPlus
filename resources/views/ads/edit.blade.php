@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/create.css') }}">
@section('title', 'Редактирование объявления')
@section('content')
    <div class="main-container pd">
        {{--ЗАГОЛОВОК С ИНСТРУКЦИЕЙ--}}
        <div class="headers">
            <h3>Редактирование объявления</h3>
            <p>Ниже представлена форма, поля которой вы можете отредактировать, если это необходимо, для того, чтобы в
                дальнейшем отправить объявление на рассмотрение модераторам.</p>
            <p>Поля помеченые звездочкой (<span class="sign-required">*</span>) являются обязательными
                для заполнения. Рассмотрение объявления может занять около 7 дней.</p>
        </div>

        {{--ФОРМА РЕДАКТИРОВАНИЯ--}}
        <div class="forms">
            <form method="post" enctype="multipart/form-data" id="form">

                @if ($ad->object_type == '\App\Models\House')
                    {{--ТИП ОБЪЕКТА НЕДВИЖИМОСТИ--}}
                    <div id="type">
                        <h5>Тип объекта</h5>
                        <p>Необходимо выбрать более конкретный тип объекта недвижимости: коттедж или дачный
                            участок. </p>
                        <div class="labels">
                            <p>Тип объекта <span class="sign-required">*</span></p>
                            <select class="form-select type__select" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                {{--ТИП ДОГОВОРА--}}
                <div id="contract-types">
                    <h5>Вид договора</h5>

                    <div class="labels">
                        <p class="contract-types__title">Вид договора <span class="sign-required">*</span></p>
                        <select class="form-select contract-types__select"
                                name="contract_id">
                            @foreach($contract_types as $contract)
                                <option value="{{ $contract->id }}"
                                    {{ old('contract') == $contract->id || $ad->contract_id == $contract->id ? 'selected' : '' }}>
                                    {{ $contract->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if ($ad->object_type == '\App\Models\Flat' || $ad->object_type == '\App\Models\Room')
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
                                        {{ old('complex') == $complex->id || $ad->residential_complex_id == $complex->id ? 'selected' : ''}}>
                                        {{ $complex->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

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
                                        {{ old('district') == $district->name || $ad->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--УЛИЦА--}}
                    <div id="streets" class="labels">
                        <p class="streets__title">Улица <span class="sign-required">*</span></p>
                        <input type="text" list="streets-list" class="form-select" name="street"
                               {{ $ad->street->name }} required
                               placeholder="В формате ул. Гагарина или пр. Ленина">
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option>{{ $street->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--НОМЕР УЛИЦЫ--}}
                    <div id="street-number" class="labels">
                        <p class="building-number__title">Номер улицы <span class="sign-required">*</span></p>
                        <input type="number" name="street_number" id="street_number" class="form-control" min="1"
                               {{ old('street_number') ?? $ad->street_number }} required>
                    </div>

                    @if ($ad->object_type == '\App\Models\Flat' || $ad->object_type == '\App\Models\Room')
                        {{--НОМЕР ПОДЪЕЗДА--}}
                        <div id="entrance-number" class="labels">
                            <p class="entrance-number__title">Номер подъезда <span class="sign-required">*</span></p>
                            <input type="number" name="entrance" id="entrance" class="form-control" min="1"
                                   {{ old('entrance') ?? $ad->entrance }} required>
                        </div>

                        {{--ИНФОРМАЦИЯ ОБ ЭТАЖАХ--}}
                        <div id="building-floors" class="labels">
                            <p class="floors__title">Этаж <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="floor" id="floor" class="form-control" min="1"
                                       {{ old('floor') ?? $ad->floor }} required>
                                <p>из</p>
                                <input type="number" name="floors" id="floors" class="form-control" min="1"
                                       {{ old('floors') ?? $ad->floors }} required>
                            </div>
                            <p id="floor-error"></p>
                        </div>
                    @endif

                    @if ($ad->object_type == '\App\Models\Room')
                        {{--НОМЕР КОМНАТЫ--}}
                        <div id="number" class="labels">
                            <p class="number__title">Номер комнаты <span class="sign-required">*</span></p>
                            <input type="number" name="number" id="number" class="form-control" min="1"
                                   {{ old('number') ?? $ad->number }} required>
                        </div>
                    @endif

                    @if ($ad->object_type == '\App\Models\House' || $ad->object_type == '\App\Models\LandPlot')
                        {{--НОМЕР УЧАСТКА--}}
                        <div id="plot-number" class="labels">
                            <p class="plot-number__title">Номер участка</p>
                            <input type="number" name="plot_number" id="plot_number" class="form-control"
                                   min="1" {{ old('plot_number') }}>
                        </div>
                    @endif
                </fieldset>

                {{--ИНФОРМАЦИЯ О ЗДАНИИ НА УЧАСТКЕ, ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ С ДОМОМ--}}
                @if ($ad->object_type == '\App\Models\House')
                    <fieldset>
                        <h5>Информация о здании на участке</h5>

                        {{--ПЛОЩАДЬ ЗДАНИЯ--}}
                        <div id="plot-area" class="labels">
                            <p class="plot-area__title">Площадь дома <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="building_area" id="building_area" class="form-control"
                                       min="1" {{ old('building_area') }} required>
                                <p>м<sup>2</sup></p>
                            </div>
                        </div>

                        {{--КОЛИЧЕСТВО ЭТАЖЕЙ--}}
                        <div id="floors-amount" class="labels">
                            <p class="floors-amount__title">Количество этажей</p>
                            <input type="number" name="floors" id="floors" class="form-control"
                                   min="1" {{ old('floors') }}>
                        </div>

                        {{--КОЛИЧЕСТВО СПАЛЬНЫХ КОМНАТ--}}
                        <div id="bedrooms-amount" class="labels">
                            <p class="bedrooms-amount__title">Количество спален</p>
                            <input type="number" name="bedrooms" id="bedrooms" class="form-control"
                                   min="1" {{ old('bedrooms') }}>
                        </div>

                        {{--КОЛИЧЕСТВО САНУЗЛОВ--}}
                        <div id="bathrooms-amount" class="labels">
                            <p class="bathrooms-amount__title">Количество санузлов</p>
                            <input type="number" name="bathrooms" id="bathrooms" class="form-control"
                                   min="1" {{ old('bathrooms') }}>
                        </div>

                        {{--РАСПОЛОЖЕНИЕ САНУЗЛА--}}
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

                        {{--ГОД ПОСТРОЙКИ ЗДАНИЯ НА УЧАСТКЕ--}}
                        <div id="building-year" class="labels">
                            <p class="building-year__title">Год постройки</p>
                            <input type="number" name="building_year" id="building_year" class="form-control"
                                   min="1700" {{ old('building_year') }}>
                            <p id="year-error"></p>
                        </div>

                        {{--МАТЕРИАЛ ЗДАНИЯ--}}
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
                                    {{ old('building_material') == 'Газосиликатный блок' ? 'selected' : '' }}>
                                    Газосиликатный
                                    блок
                                </option>
                                <option value="Пенобетонный блок"
                                    {{ old('building_material') == 'Пенобетонный блок' ? 'selected' : '' }}>Пенобетонный
                                    блок
                                </option>
                            </select>
                        </div>

                        {{--СОСТОЯНИЕ ЗДАНИЯ--}}
                        <div id="building-status" class="labels">
                            <p class="building-status__title">Состояние участка <span class="sign-required">*</span></p>
                            <textarea name="building_status" id="building_status" cols="30" rows="5"
                                      class="form-control"
                                      placeholder="Кратко опишите в каком состоянии сейчас находится здание на участке."
                                      required></textarea>
                        </div>
                    </fieldset>
                @endif

                {{--ИНФОРМАЦИЯ ОБ УЧАСТКЕ ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ С ДОМОМ--}}
                @if ($ad->object_type == '\App\Models\House')
                    <fieldset>
                        <h5>Информация об участке</h5>

                        {{--ПЛОЩАДЬ УЧАСТКА--}}
                        <div id="plot-area" class="labels">
                            <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="plot_area" id="plot_area" class="form-control"
                                       {{ old('plot_area') }} min="1" required>
                                <p>сот.</p>
                            </div>
                        </div>

                        {{--СОСТОЯНИЕ УЧАСТКА--}}
                        <div id="plot-status" class="labels">
                            <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                            <textarea name="plot_status" id="plot_status" cols="30" rows="5" class="form-control"
                                      placeholder="Кратко опишите в каком состоянии сейчас находится участок."
                                      required></textarea>
                        </div>
                    </fieldset>
                @endif

                {{--ИНФОРМАЦИЯ ОБ УЧАСТКЕ ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ ЗЕМЕЛЬНЫЙ УЧАСТОК--}}
                @if ($ad->object_type == '\App\Models\LandPlot')
                    <fieldset>
                        <h5>Информация об объекте</h5>

                        {{--ПЛОЩАДЬ УЧАСТКА--}}
                        <div id="plot-area" class="labels">
                            <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="area" id="area" class="form-control"
                                       {{ old('area') }} min="1" required>
                                <p>сот.</p>
                            </div>
                        </div>

                        {{--СОСТОЯНИЕ УЧАСТКА--}}
                        <div id="plot-status" class="labels">
                            <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                            <textarea name="status" id="status" cols="30" rows="5" class="form-control" required
                                      placeholder="Кратко опишите в каком состоянии сейчас находится участок."></textarea>
                        </div>
                    </fieldset>
                @endif

                {{--ИНФОРМАЦИЯ ОБ УЧАСТКЕ ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ КВАРТИРА ИЛИ КОМНАТА--}}
                @if ($ad->object_type == '\App\Models\Flat')
                    {{--ИНФОРМАЦИЯ ОБ ОБЪЕКТЕ НЕДВИЖИМОСТИ--}}
                    <fieldset>
                        <h5>Информация об объекте</h5>

                        {{--LIVING AREA--}}
                        <div id="living-area" class="labels">
                            <p class="living-area__title">Жилая площадь <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="living_area" id="living_area" class="form-control" min="1"
                                       required>
                                <p>м<sup>2</sup></p>
                            </div>
                        </div>

                        {{--TOTAL AREA--}}
                        <div id="total-area" class="labels">
                            <p class="total-area__title">Общая площадь <span class="sign-required">*</span></p>
                            <div>
                                <input type="number" name="total_area" id="total_area" class="form-control" min="1"
                                       required>
                                <p>м<sup>2</sup></p>
                            </div>
                        </div>

                        {{--KITCHEN AREA--}}
                        <div id="kitchen-area" class="labels">
                            <p class="kitchen-area__title">Площадь кухни</p>
                            <div>
                                <input type="number" name="kitchen_area" id="kitchen_area" class="form-control" min="1">
                                <p>м<sup>2</sup></p>
                            </div>
                        </div>

                        {{--CEILING HEIGHT--}}
                        <div id="ceiling-height" class="labels">
                            <p class="ceiling-height__title">Высота потолков</p>
                            <div>
                                <input type="number" name="ceiling_height" id="ceiling_height" class="form-control"
                                       min="1">
                                <p>м</p>
                            </div>
                        </div>

                        {{--LIVING ROOMS AMOUNT--}}
                        <div id="living-rooms-amount" class="labels">
                            <p class="living-rooms-amount__title">Количество жилых комнат <span
                                    class="sign-required">*</span></p>
                            <input type="number" name="living_rooms_amount" id="living_rooms_amount"
                                   class="form-control"
                                   min="1" required>
                        </div>

                        {{--BATHROOMS AMOUNT--}}
                        <div id="bathrooms-amount" class="labels">
                            <p class="bathrooms-amount__title">Количество санузлов <span class="sign-required">*</span>
                            </p>
                            <input type="number" name="bathrooms_amount" id="bathrooms_amount" class="form-control"
                                   min="1"
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
                @endif

                {{--ИНФОРМАЦИЯ О ЗДАНИИ ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ КВАРТИРА ИЛИ КОМНАТА--}}
                @if ($ad->object_type == '\App\Models\Flat')
                    <fieldset>
                        <h5>Информация о здании</h5>

                        {{--YEAR OF BUILDING--}}
                        <div id="building-year" class="labels">
                            <p class="building-year__title">Год постройки</p>
                            <input type="number" name="building_year" id="building_year" class="form-control"
                                   min="1700">
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
                @endif

                {{--ОПИСАНИЕ И ФОТОГРАФИИ--}}
                <fieldset>
                    {{--ОПИСАНИЕ--}}
                    <div id="room-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control" required
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."></textarea>
                    </div>

                    {{--ПЛАНИРОВКА, ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ КВАРТИРА ИЛИ КОМНАТА--}}
                    @if ($ad->object_type == '\App\Models\Flat' || $ad->object_type == '\App\Models\Room')
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
                    @endif

                    {{--ИЗОБРАЖЕНИЯ--}}
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

                {{--ХАРАКТЕРИСТИКИ, ЕСЛИ ОБЪЕКТ НЕДВИЖИМОСТИ ЗЕМЕЛЬНЫЙ УЧАСТОК ИЛИ УЧАСТОК С ДОМОМ--}}
                @if ($ad->object_type == '\App\Models\LandPlot' || $ad->object_type == '\App\Models\House')
                    <fieldset>
                        <h5>Удобства на объекте</h5>

                        <div id="characteristics">
                            @foreach($characteristics as $charact)
                                <label>
                                    <input type="checkbox" name="checkboxes[]" id="{{ $charact->id }}"
                                           class="form-check-input"
                                           value="{{ $charact->id }}"
                                        {{ old($charact->id) ? 'checked' : '' }}>
                                    {{ $charact->name }}
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endif

                {{--ЦЕНА--}}
                <div id="set-price">
                    <h5>Цена</h5>
                    <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил публикации.
                        Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать
                        непосредственно с самим риелтором, так
                        как у каждого свой тариф.</p>

                    <div class="labels">
                        <p class="se-price__title">Цена <span class="sign-required">*</span></p>
                        <div class="set-price__input">
                            <input type="number" name="price" id="price" class="form-control"
                                   {{ old('price') }} required>
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
                submitError.textContent = 'Проверьте объявление на наличие ошибок и исправьте их';
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

            let res = await postJSON('{{ route("flats.store") }}', formData, "{{ csrf_token() }}");
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
