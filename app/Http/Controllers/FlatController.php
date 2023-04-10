<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\Flat;
use App\Models\ImagesAd;
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
            $flat = Flat::create(array_merge(
                ['layout' => $layout_path],
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
                'object_id' => $flat->id
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
}
