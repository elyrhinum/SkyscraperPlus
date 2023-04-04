<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\HouseLandPlotCharacteristic;
use App\Models\PlotType;
use App\Models\RepairType;
use App\Models\ResidentialComplex;
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

    // FILTRATION
    public function filtration(Request $request)
    {
        $ads = Ad::onlyPublished();

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

        return to_route('ads.filtration')->withInput($request->all() + ['ads' => $ads->get()]);
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
            return view('ads.show.firstShow', ['ad' => $ad]);
        } else if ($ad->object_type == '\App\Models\House' || $ad->object_type == '\App\Models\LandPlot') {
            return view('ads.show.secondShow', ['ad' => $ad]);
        }
    }
}
