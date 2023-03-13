<?php

namespace App\Http\Controllers;

use App\Http\FileService;
use App\Http\FileServiceForRealtors;
use App\Http\Requests\RealtorLoginRequest;
use App\Http\Requests\RealtorSignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isFalse;

class UserController extends Controller
{
    // INDEX
    public function indexUser()
    {
        return view('users.user_account');
    }
    public function indexRealtor()
    {
        return view('users.realtor_account');
    }

    public function indexAdmin()
    {
        return view('admins.index');
    }

    // CREATE
    public function create()
    {
        return view('users.create');
    }

    // LOGIN
    public function login()
    {
        return view('users.login');
    }

    // VERIFICATION
    public function verification(Request $request)
    {
        if (Auth::attempt($request->only(['login', 'password']))) {
            $request->session()->regenerate();

            if (auth()->user()->role_id == 1) {
                return to_route('users.accountUser');
            } else if (auth()->user()->role_id == 2) {
                return to_route('users.accountRealtor');
            }

        }
        return back()->withErrors(['errorLogin' => 'Пользователь не найден']);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('ads.index');
    }

    // STORE
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(SignUpRequest $request)
    {
        $user = User::create(array_merge(
            ['password' => Hash::make($request->password), 'role_id' => 1],
            $request->only(['name', 'surname', 'patronymic', 'login', 'email', 'telephone'])
        ));

        auth()->login($user);

        return to_route('users.accountUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

        return to_route('users.accountRealtor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
