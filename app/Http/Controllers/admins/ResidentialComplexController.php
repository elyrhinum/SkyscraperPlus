<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\ComplexClass;
use App\Models\District;
use App\Models\ResidentialComplex;
use Illuminate\Http\Request;

class ResidentialComplexController extends Controller
{
    // REDIRECT METHODS
    public function onlySuggested()
    {
        return view('admins.complexes.suggested', ['objects' => ResidentialComplex::onlySuggested()->get()]);
    }

    public function onlyPublished()
    {
        return view('admins.complexes.published', ['objects' => ResidentialComplex::onlyPublished()->get()]);
    }

    public function onlyHidden()
    {
        return view('admins.complexes.hidden', ['objects' => ResidentialComplex::onlyHidden()->get()]);
    }

    // STATUSES CHSNGING METHODS
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

    public function hide(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Жилой комплекс скрыт']) :
            back()->withErrors(['error' => 'Не удалось скрыть жилой комплекс']);
    }

    // SHOW METHOD
    public function show(ResidentialComplex $complex)
    {
        return view('admins.complexes.show', [
            'ads' => Ad::all(),
            'complexes' => ResidentialComplex::all(),
            'complex' => $complex
        ]);
    }

    // REDIRECT TO EDIT
    public function edit(ResidentialComplex $complex)
    {
        return view('complexes.update', [
            'complex' => $complex,
            'classes' => ComplexClass::all(),
            'districts' => District::all(),
        ]);
    }

    // UPDATE METHOD
    public function update(Request $request, ResidentialComplex $complex)
    {
        //
    }
}
