<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя.
     *
     * @return Responsable
     */
    public function register(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'role_id' => RoleEnum::ROLE_USER->value,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('auth-token');


        return $this->success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }

    /**
     * Авторизация и создания токена аутентификации.
     *
     * @return Responsable
     */
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            abort(401, trans('auth.failed'));
        }

        $token = Auth::user()->createToken('auth-token');

        return $this->success([
            'avatarUrl' => Auth::user()->avatar,
            'email' => Auth::user()->email,
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'token' => $token->plainTextToken
        ]);
    }

    //ваще хз правильно ли сделано
    public function get_login(Request $request)
    {
        if ($token = PersonalAccessToken::findToken($request->header('Authorization'))) {

            $user = $token->tokenable;

            return $this->success([
                'user' =>  Auth::user(),
                'avatarUrl' => $user->avatar,
                'email' => $user->email,
                'id' => $user->id,
                'name' => $user->name,
                'token' => $request->header('Authorization')
            ]);
        }
        abort(403);
    }

    /**
     * Удаление токена аутентификации.
     *
     * @return Responsable
     */
    // тоже не работало на фронте
    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this->success(null, 204);
    }
}
