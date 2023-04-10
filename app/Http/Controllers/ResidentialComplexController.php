<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ComplexClass;
use App\Models\District;
use App\Models\Flat;
use App\Models\ImagesComplex;
use App\Models\ResidentialComplex;
use App\Models\Room;
use Illuminate\Http\Request;

class ResidentialComplexController extends Controller
{
    // INDEX PAGE
    public function index()
    {
        return view('complexes.index', [
            'complexes' => ResidentialComplex::all()
        ]);
    }

    // REDIRECT TO CREATE PAGE
    public function create()
    {
        return view('complexes.create', [
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

    // STORE METHOD
    public function store(Request $request)
    {
        // CREATE RESIDENTIAL COMPLEX
        $complex = ResidentialComplex::create(array_merge(
            ['status_id' => 2],
            $request->except('_token', 'images')));

        // UPLOADING IMAGES
        if ($request->images) {
            foreach ($request->files->all()['images'] as $file) {
                $path = FileServiceForObjects::uploadRedirect($file, '/complexes');
                $images = ImagesComplex::create([
                    'residential_complex_id' => $complex->id,
                    'image' => $path
                ]);

            }
        } else {
            $path = FileServiceForObjects::uploadRedirect(null, '');
            $images = ImagesComplex::create([
                'residential_complex_id' => $complex->id,
                'image' => $path
            ]);
        }

        $result = $complex;
        $result ? $request->session()->put(['success' => 'Заявление на добавление нового жилого комплекса отправлено на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось отправить заявление на добавление нового жилого комплекса']);

        return response()->json($result);
    }

    // SHOW METHOD
    public function show(ResidentialComplex $complex)
    {
        $flats = Ad::onlyPublished()->where('object_type', '\App\Models\Flat')->whereIn('object_id', Flat::where('residential_complex_id', $complex->id)->get()->pluck('id'))->get();
        $rooms = Ad::onlyPublished()->where('object_type', '\App\Models\Room')->whereIn('object_id', Room::where('residential_complex_id', $complex->id)->get()->pluck('id'))->get();

        return view('complexes.show', [
            'complex' => $complex,
            'title' => 'ЖК "' . $complex->name . '"',
            'flats' => $flats,
            'rooms' => $rooms,
        ]);
    }

    // GET DISTRICT BY COMPLEX
    public function getDistrictByComplex(Request $request)
    {
        $complex = ResidentialComplex::find($request->data);
        $result = District::find($complex->district_id);
        return response()->json($result);
    }

    // FLATS IN COMPLEX
    public function flatsInResidentialComplex(ResidentialComplex $complex)
    {
        $ads = Ad::onlyPublished()->where('object_type', '\App\Models\Flat')->whereIn('object_id', Flat::where('residential_complex_id', $complex->id)->get()->pluck('id'))->get();

        return view('complexes.objects.flats', [
            'complex' => $complex,
            'title' => 'Квартиры в ЖК "' . $complex->name .'"',
            'ads' => $ads
        ]);
    }

    // ROOMS IN COMPLEX
    public function roomsInResidentialComplex(ResidentialComplex $complex)
    {
        $ads = Ad::onlyPublished()->where('object_type', '\App\Models\Room')->whereIn('object_id', Room::where('residential_complex_id', $complex->id)->get()->pluck('id'))->get();

        return view('complexes.objects.rooms', [
            'complex' => $complex,
            'title' => 'Комнаты в ЖК "' . $complex->name .'"',
            'ads' => $ads
        ]);
    }
}
