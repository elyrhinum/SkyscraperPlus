<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ContractType;
use App\Models\District;
use App\Models\House;
use App\Models\ImagesAd;
use App\Models\ObjectAndCharacteristics;
use App\Models\RepairType;
use App\Models\ResidentialComplex;
use App\Models\Room;
use App\Models\Street;
use Illuminate\Http\Request;

class RoomController extends Controller
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
        return view('ads.rooms.create', [
            'contract_types' => ContractType::all(),
            'complexes' => ResidentialComplex::onlyPublished()->get(),
            'repair_types' => RepairType::all(),
            'districts' => District::all(),
            'streets' => Street::all()
        ]);
    }

    public function store(Request $request)
    {
        // ПОЛУЧЕНИЕ УЛИЦЫ
        $street = Street::firstOrCreate(['name' => request('street')]);

        // ЗАГРУЗКА ПЛАНИРОВКИ
        $layout_path = FileServiceForObjects::upload($request->file('layout'), '/layouts');

        // СОЗДАНИЕ КОМНАТЫ
        if($request->residential_complex_id != 'Не выбрано') {
            $room = Room::create(array_merge(
                ['layout' => $layout_path],
                $request->except('_token', 'images', 'layout')));
        } else {
            $room = Room::create(array_merge(
                ['layout' => $layout_path],
                $request->except('_token', 'images', 'layout', 'residential_complex_id')));
        }


        // СОЗДАНИЕ ОБЪЯВЛЕНИЯ
        $ad = Ad::create(array_merge(
            [
                'street_id' => $street->id,
                'status_id' => 2,
                'object_type' => '\App\Models\Room',
                'object_id' => $room->id,
                'user_id' => auth()->id()
            ],
            $request->only('contract_id', 'district_id', 'description', 'price')
        ));

        // ЗАГРУЗКА ИЗОБРАЖЕНИЙ
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/rooms');
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

        $result = $room;
        $result ? $request->session()->put(['success' => 'Объявление успешно подано на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось подать объявление']);

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
