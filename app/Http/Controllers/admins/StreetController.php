<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Street;
use Illuminate\Http\Request;

class StreetController extends Controller
{
    // REDIRECT TO INDEX
    public function index()
    {
        return view('admins.streets.index', ['streets' => Street::all()]);
    }

    // STORE METHODS
    public function store(Request $request)
    {
        $result = Street::create(['name' => $request->name]);

        return $result ? to_route('admins.streets.index')->with(['success' => 'Улица успешно добавлена в каталог']) :
            to_route('admins.streets.index')->withErrors(['error' => 'Не удалось добавить улицу в каталог']);
    }

    // UPDATE METHOD
    public function update(Request $request)
    {
        $street = Street::find($request->id);
        $result = $street->update($request->only(['name']));

        return $result ? to_route('admins.streets.index')->with(['success' => 'Улица успешно обновлена']) :
            to_route('admins.streets.index')->withErrors(['error' => 'Не удалось обновить улицу']);
    }

    // DELETE METHOD
    public function delete(Request $request)
    {
        $street = Street::find($request->id);
        $result = $street->delete();

        return $result ? to_route('admins.streets.index')->with(['success' => 'Улица успешно удалена из каталога']) :
            to_route('admins.streets.index')->withErrors(['error' => 'Не удалось удалить улицу из каталога']);
    }
}
