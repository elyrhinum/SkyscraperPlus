<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\HouseLandPlotCharacteristic;
use App\Models\ObjectAndCharacteristics;
use App\Models\PlotType;
use App\Models\RepairType;
use App\Models\ResidentialComplex;
use App\Models\RoomFlatCharacteristic;
use App\Models\Street;
use App\Models\UserBookmark;
use Illuminate\Http\Request;

class AdController extends Controller
{
    // INDEX PAGE
    public function index()
    {
        return view('index', [
            'ads' => Ad::onlyPublished(),
            'complexes' => ResidentialComplex::onlyPublished(),
        ]);
    }

    // REDIRECT TO PRE-CREATE PAGE
    public function preCreate()
    {
        return view('ads.preCreate');
    }

    // REDIRECT TO SALE PAGE
    public function sale()
    {
        return view('sale.index', ['ads' => Ad::onlyPublished()->where('contract_id', 1)->latest()->get()]);
    }

    // CATALOG METHOD
    public function catalog($object_type, $contract_id_1, $contract_id_2 = null)
    {
        if ($contract_id_2 != null) {
            $ads = Ad::onlyPublished()->where('object_type', $object_type)->whereIn('contract_id', [$contract_id_1, $contract_id_2])->latest()->get();
        } else {
            $ads = Ad::onlyPublished()->where('object_type', $object_type)->where('contract_id', $contract_id_1)->latest()->get();
        }

        $title = '';

        if ($object_type == '\App\Models\Flat' && $contract_id_1 == 1) {
            $title = 'Квартиры на продажу';
        } else if (($object_type == '\App\Models\Flat' && $contract_id_1 == 2)) {
            $title = 'Квартиры для аренды';
        } else if ($object_type == '\App\Models\Room' && $contract_id_1 == 1) {
            $title = 'Комнаты на продажу';
        } else if (($object_type == '\App\Models\Room' && $contract_id_1 == 2)) {
            $title = 'Комнаты для аренды';
        } else if ($object_type == '\App\Models\House' && $contract_id_1 == 1) {
            $title = 'Дома/коттеджи на продажу';
        } else if (($object_type == '\App\Models\House' && $contract_id_1 == 2)) {
            $title = 'Дома/коттеджи для аренды';
        } else if ($object_type == '\App\Models\LandPlot' && $contract_id_1 == 1) {
            $title = 'Земельные участки на продажу';
        } else if (($object_type == '\App\Models\LandPlot' && $contract_id_1 == 2)) {
            $title = 'Земельные участки для аренды';
        }

        return view('ads.catalog', ['ads' => $ads, 'title' => $title]);
    }

    // REDIRECT TO RENT PAGE
    public function rent()
    {
        return view('rent.index', ['ads' => Ad::onlyPublished()->whereIn('contract_id', [2, 3])->latest()->get()]);
    }

    // FILTRATION METHOD
    public function filtration(Request $request)
    {
        $ads = Ad::onlyPublished();
        $filters = [];

        $ads = $ads->where('contract_id', $request->contract_id);
        $ads = $ads->where('object_type', $request->object_type);
        $ads = $ads->where('district_id', $request->district_id);

        if ($request->price_from != null) {
            $ads = $ads::where('price', '>', $request->price_from);
        } else if ($request->price_to != null) {
            $ads = $ads::where('price', '<', $request->price_from);
        } else if ($request->price_from != null && $request->price_to != null) {
            $ads = $ads::where('price', '>', $request->price_from)->where('price', '<', $request->price_from);
        }

        // CONTRACT TYPE DEFINITION
        if ($request->contract_id == 1) {
            $filters[] = 'Продажа';
        } else if ($request->contract_id == 2) {
            $filters[] = 'Долгосрочная аренда';
        } else if ($request->contract_id == 3) {
            $filters[] = 'Посуточная аренда';
        }

        // OBJECT TYPE DEFINITION
        if ($request->object_type == '\App\Models\Flat') {
            $filters[] = 'Квартира';
        } else if ($request->object_type == '\App\Models\Room') {
            $filters[] = 'Комната';
        } else if ($request->object_type == '\App\Models\House') {
            $filters[] = 'Участок с домом';
        } else if ($request->object_type == '\App\Models\LandPlot') {
            $filters[] = 'Земельный участок';
        }

        // PRICE FROM DEFINITION
        if ($request->price_from != null) {
            $filters[] = 'Цена от ' . $request->price_from . ' ₽';
        }

        // PRICE TO DEFINITION
        if ($request->price_to != null) {
            $filters[] = 'Цена до ' . $request->price_to . ' ₽';
        }

        // DISTRICT
        $filters[] = District::find($request->district_id)->name;

        return view('ads.filtration', ['ads' => $ads->latest()->get(), 'filters' => $filters]);
    }

    // REDIRECT TO EDIT PAGE
    public function edit(Ad $ad)
    {
        if ($ad->object_type == '\App\Models\Flat' || $ad->object_type == '\App\Models\Room') {
            return view('ads.edit', [
                'ad' => $ad,
                'contract_types' => ContractType::all(),
                'complexes' => ResidentialComplex::onlyPublished()->get(),
                'repair_types' => RepairType::all(),
                'districts' => District::all(),
                'streets' => Street::all()
            ]);
        } else if ($ad->object_type == '\App\Models\House') {
            return view('ads.edit', [
                'ad' => $ad,
                'contract_types' => ContractType::all(),
                'characteristics' => HouseLandPlotCharacteristic::where('is_landplot', 0)->get(),
                'types' => PlotType::all(),
                'districts' => District::all(),
                'streets' => Street::all()
            ]);
        } else if ($ad->object_type == '\App\Models\LandPlot') {
            return view('ads.edit', [
                'ad' => $ad,
                'contract_types' => ContractType::all(),
                'characteristics' => HouseLandPlotCharacteristic::where('is_landplot', 1)->get(),
                'districts' => District::all(),
                'streets' => Street::all()
            ]);
        }
    }

    // ADD AD IN BOOKMARKS
    public function bookmark(Request $request)
    {

        $bookmark = auth()->user()->bookmarks()->where('ad_id', $request->data)->first();

        if ($bookmark != null) {
            $result = false;
        } else {
            $result = UserBookmark::create(['user_id' => auth()->id(), 'ad_id' => $request->data]);
        }

        return response()->json($result);
    }

    // DELETE AD FROM BOOKMARKS
    public function unbookmark(Request $request)
    {
        $bookmark = UserBookmark::where('ad_id', $request->data)->where('user_id', auth()->id());
        $result = $bookmark->delete();

        return response()->json($result);
    }

    // SHOW METHOD
    public function show(Ad $ad)
    {
        if ($ad->object_type == '\App\Models\Flat' || $ad->object_type == '\App\Models\Room') {
            $characteristics = RoomFlatCharacteristic::where('object_type', $ad->object_type)->where('object_id', $ad->object_id)->first();
            return view('ads.show.firstShow', [
                'ad' => $ad,
                'title' => $ad->getNameOfObject(),
                'complex' => $ad->object->residential_complex,
                'characteristics' => $characteristics
            ]);
        } else if ($ad->object_type == '\App\Models\House' || $ad->object_type == '\App\Models\LandPlot') {
            $characteristics = ObjectAndCharacteristics::where('object_type', $ad->object_type)->
            where('object_id', $ad->object()->first()->id)->get();
            return view('ads.show.secondShow', [
                'ad' => $ad,
                'title' => $ad->getNameOfObject(),
                'characteristics' => $characteristics
            ]);
        }
    }
}
