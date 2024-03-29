<?php

namespace App\Http\Controllers;

use App\Http\FileServiceForRealtors;
use App\Http\Requests\ModeratorSignUpRequest;
use App\Http\Requests\ModeratorUpdateRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Ad;
use App\Models\Document;
use App\Models\ResidentialComplex;
use App\Models\User;
use App\Models\UserBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isFalse;

class UserController extends Controller
{
    // METHOD TO REDIRECT TO USER'S ACCOUNT
    public function account()
    {
        return view('users.account', [
            'suggested_ads' => Ad::onlySuggested()->where('user_id', auth()->user()->id)->latest()->take(3)->get(),
            'published_ads' => Ad::onlyPublished()->where('user_id', auth()->user()->id)->latest()->take(3)->get(),
            'cancelled_ads' => Ad::onlyCancelled()->where('user_id', auth()->user()->id)->latest()->take(3)->get()
        ]);
    }

    // METHOD TO REDIRECT TO USER'S SUGGESTED ADS
    public function onlySuggestedAds()
    {
        return view('users.ads.suggested', [
            'ads' => Ad::onlySuggested()->where('user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    // METHOD TO REDIRECT TO USER'S PUBLISHED ADS
    public function onlyPublishedAds()
    {
        return view('users.ads.published', [
            'ads' => Ad::onlyPublished()->where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    // METHOD TO REDIRECT TO USER'S PUBLISHED ADS
    public function onlyCancelledAds()
    {
        return view('users.ads.cancelled', [
            'ads' => Ad::onlyCancelled()->where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    // METHOD TO REDIRECT TO USER'S BOOKMARKS
    public function bookmarks()
    {
        return view('users.ads.bookmarks', [
            'bookmarks' => UserBookmark::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    // METHOD TO REDIRECT TO SIGN UP FORM
    public function create()
    {
        return view('users.create', [
            'agreement' => Document::where('name', 'Пользовательское соглашение')->first(),
            'politics' => Document::where('name', 'Политика конфиденциальности')->first()
        ]);
    }

    // METHOD TO LOGIN IN ACCOUNT
    public function login()
    {
        return view('users.login');
    }

    // VERIFICATION METHOD
    public function verification(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            return to_route('users.account');
        }
        return back()->withErrors(['errorLogin' => 'Проверьте логин и пароль']);
    }

    // METHOD TO LOGOUT FROM ACCOUNT
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('index');
    }

    // USER STORE METHOD
    public function storeUser(SignUpRequest $request)
    {
        $user = User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 1],
            $request->only(['name', 'surname', 'patronymic', 'login', 'email', 'telephone'])
        ));

        auth()->login($user);

        return to_route('users.account');
    }

    // REALTOR STORE METHOD
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

        return to_route('users.account');
    }

    // METHOD TO REDIRECT TO EDIT FORM
    public function edit()
    {
        return view('users.edit', ['user' => auth()->user()]);
    }

    // UPDATE METHOD
    public function update(Request $request, User $user)
    {
        $result = false;

        if ($user->role->name == 'Пользователь') {
            $result = $user->update($request->except(['_token', 'image', 'email']));
        } else if ($user->role->name == 'Риелтор') {
            $path = FileServiceForRealtors::update('/realtors', $user->image, $request->file('image'));

            if ($path) {
                $result = $user->update(array_merge(['image' => $path],
                    $request->except(['_token', 'image', 'email'])));
            } else {
                $result = $user->update($request->except(['_token', 'image', 'email']));
            }
        }

        if (User::where('email', $request->email)->first()->id == auth()->id()){
            $result = $user->update(['email'=>$request->email]);
        }
        else{
            return back()->withErrors(['error'=>'Электронная почта занята']);
        }

        return $result ? to_route('users.account')->with(['success' => 'Аккаунт успешно обновлен']) :
            to_route('users.account')->withErrors(['error' => 'Не удалось обновить аккаунт']);
    }

    // METHOD TO REDIRECT TO PAGE WITH REALTORS
    public function realtorsIndex()
    {
        return view('realtors.index', ['realtors' => User::where('role_id', 2)->get()]);
    }

    public function usersAds(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'ads' => Ad::onlyPublished()->where('user_id', $user->id)
        ]);
    }
}
