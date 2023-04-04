<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    // REDIRECT TO INDEX PAGE
    public function index()
    {
        return view('admins.districts.index', ['districts' => District::all()]);
    }

    // STORE METHOD
    public function store(Request $request)
    {
        $result = District::create(['name' => $request->name]);

        return $result ? to_route('admins.districts.index')->with(['success' => 'Район успешно добавлен в каталог']) :
            to_route('admins.districts.index')->withErrors(['error' => 'Не удалось добавить район в каталог']);
    }

    // UPDATE METHOD
    public function update(Request $request)
    {
        $district = District::find($request->id);
        $result = $district->update($request->only(['name']));

        return $result ? to_route('admins.districts.index')->with(['success' => 'Район был успешно обновлен']) :
            to_route('admins.districts.index')->withErrors(['error' => 'Не удалось обновить район']);
    }

    // DELETE METHOD
    public function delete(Request $request)
    {
        $district = District::find($request->id);
        $result = $district->delete();

        return $result ? to_route('admins.districts.index')->with(['success' => 'Район успешно удален из каталога']) :
            to_route('admins.districts.index')->withErrors(['error' => 'Не удалось удалить район из каталога']);
    }
}
