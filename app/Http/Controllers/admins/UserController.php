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
    // REDIRECT TO INDEX PAGE
    public function index()
    {
        return view('admins.index', [
            'ads' => Ad::latest()->get(),
            'complexes' => ResidentialComplex::latest()->get()
        ]);
    }

    // LOGIN
    public function login()
    {
        return view('admins.login');
    }

    // VERIFICATION
    public function verification(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            return to_route('admins.index');

        }
        return back()->withErrors(['errorLogin' => 'Проверьте логин и пароль']);
    }

    // REDIRECT TO MODERATORS INDEX PAGE
    public function moderatorIndex()
    {
        return view('admins.moderators.index', ['moderators' => User::where('role_id', 4)->orderBy('surname', 'asc')->get()]);
    }

    // REDIRECT TO CREATE MODERATORS PAGE
    public function create()
    {
        return view('admins.moderators.create');
    }

    // STORE MODERATOR
    public function store(ModeratorSignUpRequest $request)
    {
        $result = User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 4],
            $request->only(['name', 'surname', 'patronymic', 'login'])
        ));

        return $result ? to_route('admins.moderators.index')->with(['success' => 'Аккаунт модератора успешно создан']) :
            to_route('admins.moderators.index')->withErrors(['error' => 'Не удалось создать аккаунт модератора']);
    }

    // REDIRECT TO EDIT MODERATOR PAGE
    public function edit(User $moderator)
    {
        return view('admins.moderators.edit', ['moderator' => $moderator]);
    }

    // REDIRECT TO EDIT USER PAGE
    public function editUser(User $user)
    {
        return view('admins.edit', ['user' => $user]);
    }

    // UPDATE MODERATOR
    public function update(ModeratorUpdateRequest $request, User $moderator)
    {
        $result = $moderator->update($request->only(['name', 'surname', 'patronymic', 'login']));

        return $result ? to_route('admins.moderators.index')->with(['success' => 'Данные модератора успешно обновлены']) :
            to_route('admins.moderators.index')->withErrors(['error' => 'Не удалось обновить данные модератора']);
    }

    // UPDATE USER
    public function updateUser(ModeratorUpdateRequest $request, User $user)
    {
        $result = $user->update($request->only(['name', 'surname', 'patronymic', 'login']));

        return $result ? to_route('admins.index')->with(['success' => 'Данные успешно обновлены']) :
            to_route('admins.index')->withErrors(['error' => 'Не удалось обновить данные']);
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
