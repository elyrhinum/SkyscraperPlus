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
use Illuminate\Http\Request;

class AdController extends Controller
{
    // INDEX METHOD
    public function index()
    {
        return view('index');
    }

    // REDIRECT TO PRE-CREATE VIEW
    public function preCreate()
    {
        return view('ads.preCreate');
    }

    // FILTRATION METHOD
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

    // EDIT METHOD
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
}
