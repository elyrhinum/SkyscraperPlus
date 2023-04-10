@php
    use App\Models\ContractType;
    use App\Models\Ad;
    use App\Models\District;

    $contractTypes = ContractType::all();
    $ads = Ad::all();
    $districts = District::all();
@endphp

<form action="{{ route('ads.filtration') }}" class="common">
    <div class="filters">
        {{--SELECTING CONTRACT TYPE--}}
        <div class="filters__contract-type">
            <select name="contract_id" id="contract_id" class="form-control">
                @foreach($contractTypes as $contractType)
                    <option value="{{ $contractType->id }}">
                        {{ $contractType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{--SELECTING OBJECT TYPE--}}
        <div class="filters__object-type">
            <select name="object_type" id="object_type" class="form-control">
                <option value="\App\Models\Room">
                    Комната
                </option>
                <option value="\App\Models\Flat">
                    Квартира
                </option>
                <option value="\App\Models\LandPlot">
                    Земельный участок
                </option>
                <option value="\App\Models\House">
                    Участок с домом
                </option>
            </select>
        </div>

        {{--SELECTING PRICE FROM AND TO--}}
        <div class="filters__prices">
            <div class="prices__from">
                <input type="number" name="price_from" id="price_from" class="form-control" placeholder="Цена от">
                <span>₽</span>
            </div>
            <div class="prices__to">
                <input type="number" name="price_to" id="price_to" class="form-control" placeholder="Цена до">
                <span>₽</span>
            </div>
        </div>

        {{--SELECTING DISTRICT--}}
        <div class="filters__districts">
            <select name="district_id" id="district_id" class="form-control">
                @foreach($districts as $district)
                    <option value="{{ $district->id }}">
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-outlined">Найти</button>
</form>

<style>
    form {
        display: grid;
        grid-template-columns: 7fr 1fr;
        gap: 10px;

        padding: 20px !important;
        margin: 30px 0;
    }
    .filters {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .filters__prices {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    #price_from, #price_to {
        padding-right: 20px !important;
    }

    .filters__prices > div {
        position: relative;
    }

    .filters__prices > div > span {
        position: absolute;
        top: 7px;
        right: 5px;

        opacity: 70%;
    }

    .btn {
        height: 35px;
    }

    /*DISABLING ARROWS IN INPUT:NUMBER*/
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
