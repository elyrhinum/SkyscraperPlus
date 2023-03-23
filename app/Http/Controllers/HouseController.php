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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
        // ПОЛУЧЕНИЕ УЛИЦЫ
        $street = Street::firstOrCreate(['name' => request('street')]);

        // СОЗДАНИЕ УЧАСТКА С ДОМОМ
        $house = House::create(array_merge(
            [
                'street_id' => $street->id,
                'type_id' => $request->type_id,
            ],
            $request->except('_token', 'images')));

        // СОЗДАНИЕ ОБЪЯВЛЕНИЯ
        $ad = Ad::create(array_merge(
            [
                'status_id' => 2,
                'contract_id' => $request->contract_id,
                'object_type' => '\App\Models\House',
                'object_id' => $house->id,
                'user_id' => auth()->id()
            ],
            $request->only('description', 'price')
        ));

        // ЗАГРУЗКА ИЗОБРАЖЕНИЙ
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

        // ЗАПОЛНЕНИЕ ХАРАКТЕРИСТИК
        if ($request->checkboxes) {
            foreach ($request->checkboxes as $cb) {
                $characteristics = ObjectAndCharacteristics::create([
                    'object_id' => $house->id,
                    'object_type' => 'land_plots',
                    'characteristic_id' => $cb
                ]);
            }
        }

        $result = $house;
        $result ? $request->session()->put(['success' => 'Объявление успешно подано на рассмотрение.']) :
            $request->session()->put(['error' => 'Не удалось подать объявление.']);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
