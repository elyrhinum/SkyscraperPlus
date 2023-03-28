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
    // МЕТОД ДЛЯ ИНДЕКСНОЙ СТРАНИЦЫ
    public function index()
    {
        return view('complexes.index');
    }

    // МЕТОД ДЛЯ ПЕРЕНАПРАВЛЕНИЯ НА СТРАНИЦУ СОЗДАНИЯ
    public function create()
    {
        return view('complexes.create', [
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

    // МЕТОД НА СОЗДАНИЕ ОБЪЕКТА
    public function store(Request $request)
    {
        // СОЗДАНИЕ ЖИЛОГО КОМПЛЕКСА
        $complex = ResidentialComplex::create(array_merge(
            ['status_id' => 2],
            $request->except('_token', 'images')));

        // ЗАГРУЗКА ИЗОБРАЖЕНИЙ
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

    // МЕТОД ДЛЯ ПРОСМОТРА
    public function show(ResidentialComplex $complex)
    {
        return view('complexes.show', [
            'complex' => $complex
        ]);
    }

    // МЕТОД ДЛЯ ПОЛУЧЕНИЯ РАЙОНА КОМПЛЕКСА
    public function getDistrictByComplex(Request $request)
    {
        $complex = ResidentialComplex::find($request->data);
        $result = District::find($complex->district_id);
        return response()->json($result);
    }
}
