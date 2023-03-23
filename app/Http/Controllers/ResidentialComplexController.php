<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ComplexClass;
use App\Models\District;
use App\Models\ImagesComplex;
use App\Models\ResidentialComplex;
use Illuminate\Http\Request;

class ResidentialComplexController extends Controller
{
    // INDEX METHOD
    public function index()
    {
        return view('complexes.index');
    }

    // REDIRECT TO CREATE
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
        // CREATING RESIDENTIAL COMPLEX
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
                'complex_id' => $complex->id,
                'image' => $path
            ]);
        }

        $result = $complex;
        $result ? $request->session()->put(['success' => 'Запрос на добавление жилого комплекса в каталог отправлен на рассмотрение']) :
            $request->session()->put(['error' => 'Не удалось отправить запрос на добавление жилого комплекса в каталог']);

        return response()->json($result);
    }

    // SHOW METHOD
    public function show(ResidentialComplex $complex)
    {
        return view('complexes.show', [
            'complex' => $complex
        ]);
    }

    // METHOD TO GET DISTRICT BY COMPLEX
    public function getDistrictByComplex(Request $request)
    {
        $complex = ResidentialComplex::find($request->data);
        $result = District::find($complex->district_id);
        return response()->json($result);
    }
}
