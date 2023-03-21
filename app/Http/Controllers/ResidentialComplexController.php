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
    // USER ROUTES METHODS
    public function index()
    {
        return view('complexes.index');
    }

    // ADMIN ROUTES METHODS
    public function suggested()
    {
        return view('admins.complexes.suggested', ['objects' => ResidentialComplex::onlySuggested()->get()]);
    }

    public function published()
    {
        return view('admins.complexes.published', ['objects' => ResidentialComplex::onlyPublished()->get()]);
    }

    public function create()
    {
        return view('complexes.create', [
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

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
                    'complex_id' => $complex->id,
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
        $result ? $request->session()->put(['success' => 'Запрос на добавление жилого комплекса отправлен на рассмотрение.']) :
            $request->session()->put(['error' => 'Не удалось отправить запрос на добавление жилого комплекса.']);

        return response()->json($result);
    }

    public function show(ResidentialComplex $complex)
    {
        return view('complexes.show', [
            'complex' => $complex
        ]);
    }

    public function showAdminPanel(ResidentialComplex $complex)
    {
        return view('admins.complexes.show', [
            'ads' => Ad::all(),
            'complexes' => ResidentialComplex::all(),
            'complex' => $complex
        ]);
    }

    public function edit(ResidentialComplex $complex)
    {
        return view('complexes.update', [
            'complex' => $complex,
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResidentialComplex $complex)
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

    // STATUSES METHODS
    public function confirm(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Жилой комплекс был успешно опубликован']) :
            back()->withErrors(['error' => 'Не удалось опубликовать жилой комплекс']);
    }

    public function cancel(ResidentialComplex $complex, Request $request)
    {
        $result = $complex->update(['status_id' => 3, 'comment' => $request->comment]);

        return $result ? back()->with(['success' => 'Заявление о добавлении жилого комплекса было отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить заявление о добавлении жилого комплекса']);
    }

    public function inactive(ResidentialComplex $complex)
    {
        $result = $complex->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Жилой комплекс скрыт']) :
            back()->withErrors(['error' => 'Не удалось скрыть жилой комплекс']);
    }

    // METHOD TO GET DISTRICT BY COMPLEX
    public function getDistrictByComplex(Request $request)
    {
        $complex = ResidentialComplex::find($request->data);
        $result = District::find($complex->district_id);
        return response()->json($result);
    }
}
