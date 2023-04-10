<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\FileServiceForObjects;
use App\Models\Ad;
use App\Models\ComplexClass;
use App\Models\District;
use App\Models\ImagesComplex;
use App\Models\ResidentialComplex;
use Illuminate\Http\Request;

class ResidentialComplexController extends Controller
{
    // REDIRECT TO PAGE WITH SUGGESTED COMPLEXES
    public function onlySuggested()
    {
        return view('admins.complexes.suggested', ['complexes' => ResidentialComplex::onlySuggested()->latest()->get()]);
    }

    // REDIRECT TO PAGE WITH PUBLISHED COMPLEXES
    public function onlyPublished()
    {
        return view('admins.complexes.published', ['complexes' => ResidentialComplex::onlyPublished()->latest()->get()]);
    }

    // REDIRECT TO PAGE WITH CANCELLED COMPLEXES
    public function onlyCancelled()
    {
        return view('admins.complexes.cancelled', ['complexes' => ResidentialComplex::onlyCancelled()->latest()->get()]);
    }

    // REDIRECT TO PAGE WITH HIDDEN COMPLEXES
    public function onlyHidden()
    {
        return view('admins.complexes.hidden', ['complexes' => ResidentialComplex::onlyHidden()->latest()->get()]);
    }

    // PUBLISH METHOD
    public function publish(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Жилой комплекс был успешно добавлен в каталог']) :
            back()->withErrors(['error' => 'Не удалось добавить жилой комплекс в каталог']);
    }

    // CANCEL METHOD
    public function cancel(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 3, 'comment' => $request->comment]);

        return $result ? back()->with(['success' => 'Заявление было отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить заявление']);
    }

    // HIDE METHOD
    public function hide(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Жилой комплекс скрыт из каталога']) :
            back()->withErrors(['error' => 'Не удалось скрыть жилой комплекс из каталога']);
    }

    // SHOW METHOD
    public function show(ResidentialComplex $complex)
    {
        return view('admins.complexes.show', ['complex' => $complex]);
    }

    // REDIRECT TO CREATE PAGE
    public function create()
    {
        return view('admins.complexes.create', [
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

    // STORE METHOD
    public function store(Request $request)
    {
        // CREATING RESIDENTIAL COMPLEX
        $complex = ResidentialComplex::create(array_merge(
            ['status_id' => 1],
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

        return response()->json($result);
    }
}
