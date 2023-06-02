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
use Nette\Utils\Image;

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

    // STORE METHOD
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

    // UPDATE METHOD
    public function update(Request $request, Ad $ad)
    {
        // GET STREET
        $street = Street::firstOrCreate(['name' => request('street')]);

        // UPDATE AD
        $ad->update(array_merge([
            'street_id' => $street->id,
            'status_id' => 2
        ], $request->only('contract_id', 'district_id', 'description', 'price')));

        // UPDATE HOUSE
        $house = $ad->object->update($request->except('_token', 'images'));

        // UPDATE IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/houses');
                $images = ImagesAd::create([
                    'ad_id' => $ad->id,
                    'image' => $path
                ]);
            }
        } else {
            if (count(ImagesAd::where('ad_id', $ad->id)->get()) == 0) {
                $path = FileServiceForObjects::uploadRedirect(null, '');
                $images = ImagesAd::create([
                    'ad_id' => $ad->id,
                    'image' => $path
                ]);
            }
        }

        // UPDATE CHARACTERISTICS
        if ($request->checkboxes) {
            foreach (ObjectAndCharacteristics::where('object_id', $ad->object->id)->where('object_type', '\App\Models\House')->get() as $cb) {
                $cb->delete();
            }

            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $ad->object->id,
                    'object_type' => '\App\Models\House',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $house;
        $result ? $request->session()->put(['success' => 'Объявление успешно отредактировано и подано на повторное рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось отредактировать объявление и подать его на повторное рассмотрение']);

        return response()->json($result);
    }
}
