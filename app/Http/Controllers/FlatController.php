<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\Flat;
use App\Models\ImagesAd;
use App\Models\ObjectAndCharacteristics;
use App\Models\RepairType;
use App\Models\ResidentialComplex;
use App\Models\RoomFlatCharacteristic;
use App\Models\Street;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    // REDIRECT TO CREATE PAGE
    public function create()
    {
        return view('ads.flats.create', [
            'contract_types' => ContractType::all(),
            'complexes' => ResidentialComplex::onlyPublished()->get(),
            'repair_types' => RepairType::all(),
            'districts' => District::all(),
            'streets' => Street::all()
        ]);
    }

    // STORE METHOD
    public function store(Request $request)
    {
        // GET STREETS
        $street = Street::firstOrCreate(['name' => request('street')]);

        // UPLOAD IMAGES
        $layout_path = FileServiceForObjects::upload($request->file('layout'), '/layouts');

        // CREATE FLAT
        if ($request->residential_complex_id != 'Не выбрано') {
            $flat = Flat::create(array_merge(['layout' => $layout_path],
                $request->except('_token', 'images', 'layout')));
        } else {
            $flat = Flat::create(array_merge(
                ['layout' => $layout_path],
                $request->except('_token', 'images', 'layout', 'residential_complex_id')));
        }

        // CREATE AD
        $ad = Ad::create(array_merge(
            [
                'street_id' => $street->id,
                'status_id' => 2,
                'object_type' => '\App\Models\Flat',
                'object_id' => $flat->id,
                'user_id' => auth()->id()
            ],
            $request->only('contract_id', 'district_id', 'description', 'price')
        ));

        // UPLOAD CHARACTERISTICS
        $characteristics = RoomFlatCharacteristic::create(array_merge(
            [
                'object_type' => '\App\Models\Flat',
                'object_id' => $flat->id,
                'ceiling_height' => $request->ceiling_height,
                'building_year' => $request->building_year,
                'building_type' => 'building_type'
            ],
            $request->only('ceiling_height	', 'floors', 'living_rooms_amount', 'bathrooms_amount',
                'bathroom_type', 'living_area', 'total_area', 'kitchen_area', 'building_year', 'building_type')
        ));

        // UPLOAD IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/flats');
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

        $result = $flat;
        $result ? $request->session()->put(['success' => 'Объявление успешно подано на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось подать объявление']);

        return response()->json($result);
    }

    // UPDATE METHOD
    public function update(Request $request, Ad $ad)
    {
        // GET STREET
        $street = Street::firstOrCreate(['name' => request('street')]);

        // UPLOAD LAYOUT
        $layout_path = FileServiceForObjects::update($request->file('layout'), '/layouts');

        // UPDATE AD
        $ad->update(array_merge([
            'street_id' => $street->id,
            'status_id' => 2
        ], $request->only('contract_id', 'district_id', 'description', 'price')));

        // UPDATE FLAT
        if ($request->residential_complex_id != 'Не выбрано') {
            $flat = $ad->object->update($request->except('_token', 'images'));
        } else {
            $flat = $ad->object->update($request->except('_token', 'images', 'residential_complex_id'));
        }

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
            foreach (RoomFlatCharacteristic::where('object_id', $ad->object->id)->where('object_type', '\App\Models\Flat')->get() as $cb) {
                $cb->delete();
            }

            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $ad->object->id,
                    'object_type' => '\App\Models\Flat',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $flat;
        $result ? $request->session()->put(['success' => 'Объявление успешно отредактировано и подано на повторное рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось отредактировать объявление и подать его на повторное рассмотрение']);

        return response()->json($result);
    }
}
