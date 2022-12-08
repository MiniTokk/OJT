<?php

namespace App\Dao\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Contracts\Dao\Auth\AuthDaoInterface;

class AuthDao implements AuthDaoInterface
{
    /**
     * Register To Create user
     * @param mixed $request
     * @return mixed
     */
    public function registerToCreateUser($request)
    {
        $user = $request->all();
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password'])
        ]);
    }

    /**
     * Logout User
     * @return void
     */
    public function signOut()
    {
        Session::flush();
        return Auth::logout();
    }
}
