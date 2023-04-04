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
    // REDIRECT TO PAGE WITH SUGGESTED COMPLEXES
    public function onlySuggested()
    {
        return view('admins.complexes.suggested', ['objects' => ResidentialComplex::onlySuggested()->get()]);
    }

    // REDIRECT TO PAGE WITH PUBLISHED COMPLEXES
    public function onlyPublished()
    {
        return view('admins.complexes.published', ['objects' => ResidentialComplex::onlyPublished()->get()]);
    }

    // REDIRECT TO PAGE WITH CANCELLED COMPLEXES
    public function onlyCancelled()
    {
        return view('admins.complexes.cancelled', ['objects' => ResidentialComplex::onlyCancelled()->get()]);
    }

    // REDIRECT TO PAGE WITH HIDDEN COMPLEXES
    public function onlyHidden()
    {
        return view('admins.complexes.hidden', ['objects' => ResidentialComplex::onlyHidden()->get()]);
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

        return $result ? back()->with(['success' => 'Заявление о добавлении жилого комплекса в каталог было отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить заявление о добавлении жилого комплекса в каталог']);
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
}
