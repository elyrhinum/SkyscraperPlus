<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForRealtors;
use App\Http\Requests\ModeratorSignUpRequest;
use App\Http\Requests\ModeratorUpdateRequest;
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
    // METHODS TO GET ACCOUNTS
    public function userAccount()
    {
        return view('users.user_account');
    }

    public function realtorAccount()
    {
        return view('users.realtor_account', [
            'suggested_ads' => Ad::onlySuggested()->where('user_id', auth()->user()->id)->latest()->take(3)->get(),
            'published_ads' => Ad::onlyPublished()->where('user_id', auth()->user()->id)->latest()->take(3)->get(),
            'cancelled_ads' => Ad::onlyCancelled()->where('user_id', auth()->user()->id)->latest()->take(3)->get(),
        ]);
    }

    // CREATE METHOD
    public function create()
    {
        return view('users.create');
    }

    // LOGIN METHOD
    public function login()
    {
        return view('users.login');
    }

    // VERIFICATION METHOD
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

    // EDIT METHODS
    public function editRealtor(User $realtor)
    {
        return view('users.realtor_edit', ['realtor' => $realtor]);
    }

    // UPDATE METHODS
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
