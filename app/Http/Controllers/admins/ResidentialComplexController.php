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
    // МЕТОДЫ ПО СТАТУСАМ
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

    public function onlyCancelled()
    {
        return view('admins.complexes.cancelled', ['objects' => ResidentialComplex::onlyCancelled()->get()]);
    }

    // МЕТОД ДЛЯ ДОБАВЛЕНИЯ ЖК В КАТАЛОГ
    public function confirm(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Жилой комплекс был успешно добавлен в каталог']) :
            back()->withErrors(['error' => 'Не удалось добавить жилой комплекс в каталог']);
    }

    // МЕТОД ДЛЯ ОТКЛОНЕНИЯ ЗАЯВЛЕНИЯ
    public function cancel(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 3, 'comment' => $request->comment]);

        return $result ? back()->with(['success' => 'Заявление о добавлении жилого комплекса в каталог было отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить заявление о добавлении жилого комплекса в каталог']);
    }

    // МЕТОД ДЛЯ СКРЫТИЯ
    public function hide(Request $request)
    {
        $complex = ResidentialComplex::find($request->id);
        $result = $complex->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Жилой комплекс скрыт из каталога']) :
            back()->withErrors(['error' => 'Не удалось скрыть жилой комплекс из каталога']);
    }

    // МЕТОД ДЛЯ ПРОСМОТРА
    public function show(ResidentialComplex $complex)
    {
        return view('admins.complexes.show', ['complex' => $complex]);
    }
}
