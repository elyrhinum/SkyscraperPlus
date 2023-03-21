<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForRealtors;
use App\Http\Requests\ModerSignUpRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Ad;
use App\Models\ResidentialComplex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isFalse;

class UserController extends Controller
{
    // METHODS TO ACCOUNTS AND ADMIN METHODS
    public function accountUser()
    {
        return view('users.user_account');
    }

    public function accountRealtor()
    {
        return view('users.realtor_account');
    }

    public function indexAdminPanel()
    {
        return view('admins.index', [
            'ads' => Ad::all(),
            'complexes' => ResidentialComplex::all()
        ]);
    }

    public function moderatorsIndex()
    {
        return view('moderators.index', ['moderators' => User::where('role_id', 4)->get()]);
    }

    // CREATE METHODS
    public function create()
    {
        return view('users.create');
    }

    public function createModerator()
    {
        return view('moderators.create');
    }

    // LOGIN METHODS
    public function login()
    {
        return view('users.login');
    }

    public function loginAdminPanel()
    {
        return view('admins.login');
    }

    // VERIFICATION METHODS
    public function verification(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            if (auth()->user()->role_id == 1) {
                return to_route('users.user.account');
            } else if (auth()->user()->role_id == 2) {
                return to_route('users.realtor.account');
            }
        }
        return back()->withErrors(['errorLogin' => 'Проверьте логин и пароль']);
    }

    public function verificationAdminPanel(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            return to_route('admins.index');

        }
        return back()->withErrors(['errorLogin' => 'Проверьте логин и пароль']);
    }

    // LOGOUT METHOD
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('ads.index');
    }

    // STORE METHODS
    public function storeUser(SignUpRequest $request)
    {
        $user = User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 1],
            $request->only(['name', 'surname', 'patronymic', 'login', 'email', 'telephone'])
        ));

        auth()->login($user);

        return to_route('users.user.account');
    }

    public function storeRealtor(SignUpRequest $request)
    {
        $path = FileServiceForRealtors::upload($request->file('image'), '/realtors');

        $user = User::create(array_merge(
            [
                'password' => Hash::make($request->password),
                'image' => $path,
                'role_id' => 2
            ],
            $request->only(['name', 'surname', 'patronymic', 'login', 'email', 'telephone'])
        ));

        auth()->login($user);

        return to_route('users.realtor.account');
    }

    public function storeModerator(ModerSignUpRequest $request)
    {
        User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 4],
            $request->only(['name', 'surname', 'patronymic', 'login'])
        ));

        return to_route('moderators.index');
    }

    public function editRealtor(User $realtor)
    {
        return view('users.realtor_edit', ['realtor' => $realtor]);
    }

    public function updateRealtor(Request $request, User $realtor)
    {
        $path = FileServiceForRealtors::update('/realtors', $realtor->image, $request->file('image'));

        if ($path) {
            $result = $realtor->update(array_merge(['image' => $path],
                $request->except(['_token', 'image'])));
        } else {
            $result = $realtor->update($request->except(['_token', 'image']));
        }

        return $result ? to_route('users.realtor.account')->with(['success' => 'Аккаунт успешно обновлен']) :
            to_route('users.realtor.account')->withErrors(['error' => 'Не удалось обновить аккаунт']);
    }
}
