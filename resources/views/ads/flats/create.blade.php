@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/ads/landplots/create.css') }}">
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
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset>
                    <h5>Адрес земельного участка</h5>

                    {{--DISTRICTS--}}
                    <div id="districts" class="labels">
                        <p class="districts__title">Район <span class="sign-required">*</span></p>
                        <select class="form-select districts__select" aria-label="Default select example"
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
                        <input type="text" list="streets-list" class="form-select" name="street">
                        <datalist id="streets-list">
                            @foreach($streets as $street)
                                <option>{{ $street->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    {{--NUBMER--}}
                    <div id="plot-number" class="labels">
                        <p class="plot-number__title">Номер участка <span class="sign-required">*</span></p>
                        <input type="number" name="number" id="number" class="form-control" min="1">
                    </div>
                </fieldset>

                <fieldset>
                    <h5>Информация о участке</h5>

                    {{--AREA--}}
                    <div id="plot-area" class="labels">
                        <p class="plot-area__title">Площадь участка <span class="sign-required">*</span></p>
                        <div>
                            <input type="number" name="area" id="area" class="form-control" min="1">
                            <p>сот.</p>
                        </div>

                    </div>

                    {{--STATUS--}}
                    <div id="plot-status" class="labels">
                        <p class="plot-status__title">Состояние участка <span class="sign-required">*</span></p>
                        <textarea name="status" id="status" cols="30" rows="5" class="form-control"
                                  placeholder="Кратко опишите в каком состоянии сейчас находится участок."></textarea>
                    </div>
                </fieldset>

                <fieldset>
                    {{--DESCRIPTION--}}
                    <div id="plot-description">
                        <h5>Описание <span class="sign-required">*</span></h5>
                        <textarea name="description" id="description" rows="10" class="form-control"
                                  placeholder="Опишите все детали, например, для чего использовался участок или какие соседи. Также, можно описать ближайшую инфраструктуру, транспортную доступность, указать на преимущества или особенности объекта недвижимости. Если есть особые условия для сделки, сообщите о них. Запрещается указывать контактные данные и ссылки на другие ресурсы."></textarea>
                    </div>

                    {{--IMAGES--}}
                    <div id="plot-images">
                        <h5>Фотографии</h5>
                        <p>Объявления с фотографиями привлекают больше потенциальных покупателей. Не допускаются к
                            размещению фотографии с водяными знаками, чужих объектов недвижимости и рекламные баннер.
                            Разрешенные форматы: JPG, JPEG, PNG. Главным изображением будет первое загруженное, поэтому будьте внимательнее!</p>
                        <label for="images" class="label-images">
                            <p>ЗАГРУЗИТЕ ИЗОБРАЖЕНИЯ</p>
                            <input type="file" name="images" id="images" class="form-control" accept="image/jpg, image/jpeg, image/png" multiple>
                            <div id="images-prev"></div>
                        </label>

                    </div>
                </fieldset>

                <fieldset>
                    <h5>Удобства на участке</h5>

                    <div id="characteristics">
                        <label>
                            <input type="checkbox" name="sewerage" id="sewerage"
                                   class="form-check-input"
                                   value="sewerage"
                                {{ old('sewerage') ? 'checked' : '' }}>
                            Канализация
                        </label>

                        <label>
                            <input type="checkbox" name="water_supply" id="water_supply"
                                   class="form-check-input"
                                   value="water_supply"
                                {{ old('water_supply') ? 'checked' : '' }}>
                            Водоснабжение
                        </label>

                        <label>
                            <input type="checkbox" name="gas" id="gas"
                                   class="form-check-input"
                                   value="gas"
                                {{ old('gas') ? 'checked' : '' }}>
                            Газ
                        </label>

                        <label>
                            <input type="checkbox" name="electricity" id="electricity"
                                   class="form-check-input"
                                   value="electricity"
                                {{ old('electricity') ? 'checked' : '' }}>
                            Электричество
                        </label>
                    </div>
                </fieldset>

                <div id="set-price">
                    <h5>Цена <span class="sign-required">*</span></h5>
                    <p>Укажите реальную цену объекта. Занижение цены является серьезным нарушением правил публикации.
                        Бонус, который оплачивается риелтору в случае успешной сделки необходимо обсуждать лично, так
                        как у каждого из риелторов свой тариф.</p>

                    <div class="labels">
                        <p class="se-price__title">Цена</p>
                        <div class="set-price__input">
                            <input type="number" name="price" id="price" class="form-control" min="1000000">
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
    <script src="{{ asset('/js/preview-images.js') }}"></script>
@endpush
