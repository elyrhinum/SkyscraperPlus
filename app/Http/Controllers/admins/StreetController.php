<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\StreetRequest;
use App\Models\Street;
use Illuminate\Http\Request;

class StreetController extends Controller
{
    // REDIRECT TO INDEX PAGE
    public function index()
    {
        return view('admins.streets.index', ['streets' => Street::orderBy('name', 'asc')->get()]);
    }

    // STORE METHOD
    public function store(StreetRequest $request)
    {
        $result = Street::create(['name' => $request->name]);

        return $result ? to_route('admins.streets.index')->with(['success' => 'Улица успешно добавлена в каталог']) :
            to_route('admins.streets.index')->withErrors(['error' => 'Не удалось добавить улицу в каталог']);
    }

    // UPDATE METHOD
    public function update(Request $request)
    {
        $street = Street::find($request->id);

        if (Street::where('name', $request->name)->first() == $street || Street::where('name', $request->name)->first() == null) {
            $result = $street->update($request->only(['name']));
        } else {
            $result = false;
        }

        return $result ? to_route('admins.streets.index')->with(['success' => 'Улица успешно обновлена']) :
            to_route('admins.streets.index')->withErrors(['error' => 'Не удалось обновить улицу. Проверьте, что наименование не повторяется']);
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
