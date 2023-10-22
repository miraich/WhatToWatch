<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Получение профиля пользователя.
     *
     * @return Responsable
     */
    public function show()
    {
        dd(Auth::user());
    }

    /**
     * Обновление профиля пользователя.
     *
     * @return Responsable
     */
    public function update(UpdateUserRequest $request)
    {
        Auth::user()->update($request->all());

        return $this->success(['user' => Auth::user()]);
    }
}
