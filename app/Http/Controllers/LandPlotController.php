<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\HouseLandPlotCharacteristic;
use App\Models\ImagesAd;
use App\Models\LandPlot;
use App\Models\ObjectAndCharacteristics;
use App\Models\Street;
use Illuminate\Http\Request;

class LandPlotController extends Controller
{
    // METHOD TO REDIRECT TO CREATE VIEW
    public function create()
    {
        return view('ads.landplots.create', [
            'contract_types' => ContractType::all(),
            'characteristics' => HouseLandPlotCharacteristic::where('is_landplot', 1)->get(),
            'districts' => District::all(),
            'streets' => Street::all()
        ]);
    }

    // METHOD TO STORE THE LAND PLOT
    public function store(Request $request)
    {
        // GET STREET
        $street = Street::firstOrCreate(['name' => request('street')]);

        // STORE LAND PLOT
        $landplot = LandPlot::create($request->except('_token', 'images'));

        // STORE AD
        $ad = Ad::create(array_merge(
            [
                'street_id' => $street->id,
                'status_id' => 2,
                'object_type' => '\App\Models\LandPlot',
                'object_id' => $landplot->id,
                'user_id' => auth()->id()
            ],
            $request->only('contract_id', 'district_id', 'description', 'price')
        ));

        // UPLOADING IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/landplots');
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

        // STORE CHARACTERISTICS
        if ($request->checkboxes) {
            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $landplot->id,
                    'object_type' => '\App\Models\LandPlot',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $landplot;
        $result ? $request->session()->put(['success' => 'Объявление успешно подано на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось подать объявление']);

        return response()->json($result);
    }

    public function update(Request $request, Ad $ad)
    {
        // GET STREET
        $street = Street::firstOrCreate(['name' => request('street')]);

        // UPDATE AD
        $ad->update(array_merge([
            'street_id' => $street->id,
            'status_id' => 2
        ], $request->only('contract_id', 'district_id', 'description', 'price')));

        // UPDATE LAND PLOT
        $landplot = $ad->object->update($request->except('_token', 'images'));

        // UPDATE IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/landplots');
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
            foreach (ObjectAndCharacteristics::where('object_id', $ad->object->id)->where('object_type', '\App\Models\LandPlot')->get() as $cb) {
                $cb->delete();
            }

            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $ad->object->id,
                    'object_type' => '\App\Models\LandPlot',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $landplot;
        $result ? $request->session()->put(['success' => 'Объявление успешно отредактировано и подано на повторное рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось отредактировать объявление и подать его на повторное рассмотрение']);

        return response()->json($result);
    }
}
