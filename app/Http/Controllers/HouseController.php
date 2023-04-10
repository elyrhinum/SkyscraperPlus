<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\House;
use App\Models\HouseLandPlotCharacteristic;
use App\Models\ImagesAd;
use App\Models\ObjectAndCharacteristics;
use App\Models\PlotType;
use App\Models\Street;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    // REDIRECT TO CREATE PAGE
    public function create()
    {
        return view('ads.houses.create', [
            'contract_types' => ContractType::all(),
            'characteristics' => HouseLandPlotCharacteristic::where('is_landplot', 0)->get(),
            'types' => PlotType::all(),
            'districts' => District::all(),
            'streets' => Street::all()
        ]);
    }

    public function store(Request $request)
    {
        // GET STREETS
        $street = Street::firstOrCreate(['name' => request('street')]);

        // CREATE HOUSE
        $house = House::create(array_merge(
            ['type_id' => $request->type_id,],
            $request->except('_token', 'images')));

        // CREATE AD
        $ad = Ad::create(array_merge(
            [
                'street_id' => $street->id,
                'status_id' => 2,
                'object_type' => '\App\Models\House',
                'object_id' => $house->id,
                'user_id' => auth()->id()
            ],
            $request->only('contract_id', 'district_id', 'description', 'price')
        ));

        // UPLOAD IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/houses');
                $images = ImagesAd::create([
                    'ad_id' => $ad->id,
                    'image' => $path
                ]);

            }
        } else {
            $path = FileServiceForObjects::uploadRedirect(null, '');
            $images = ImagesAd::create([
                'ad_id' => $ad->id,
                'image' => $path
            ]);
        }

        // UPLOAD CHARACTERISTICS
        if ($request->checkboxes) {
            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $house->id,
                    'object_type' => '\App\Models\House',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $house;
        $result ? $request->session()->put(['success' => 'Объявление успешно подано на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось подать объявление']);

        return response()->json($result);
    }
}
