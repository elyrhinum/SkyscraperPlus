<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeratorSignUpRequest;
use App\Http\Requests\ModeratorUpdateRequest;
use App\Models\Ad;
use App\Models\ResidentialComplex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admins.index', [
            'ads' => Ad::all(),
            'complexes' => ResidentialComplex::all()
        ]);
    }

    public function login()
    {
        return view('admins.login');
    }

    public function verification(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            return to_route('admins.index');

        }
        return back()->withErrors(['errorLogin' => 'Проверьте логин и пароль']);
    }

    public function moderatorIndex()
    {
        return view('admins.moderators.index', ['moderators' => User::where('role_id', 4)->get()]);
    }
    public function create()
    {
        return view('admins.moderators.create');
    }
    public function store(ModeratorSignUpRequest $request)
    {
        User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 4],
            $request->only(['name', 'surname', 'patronymic', 'login'])
        ));

        return to_route('admins.moderators.index');
    }

    public function edit(User $moderator)
    {
        return view('admins.moderators.edit', ['moderator' => $moderator]);
    }

    // UPDATE MODERATOR
    public function update(ModeratorUpdateRequest $request, User $moderator)
    {
        $result = $moderator->update($request->only(['name', 'surname', 'patronymic', 'login']));

        return $result ? to_route('admins.moderators.index')->with(['success' => 'Аккаунт успешно обновлен']) :
            to_route('admins.moderators.index')->withErrors(['error' => 'Не удалось обновить аккаунт']);
    }

    // DELETE MODERATOR
    public function delete(Request $request)
    {
        $moderator = User::find($request->id);
        $result = $moderator->delete();

        return $result ? to_route('admins.moderators.index')->with(['success' => 'Модератор успешно удален']) :
            to_route('admins.moderators.index')->withErrors(['error' => 'Не удалось удалить модератора']);
    }
}
