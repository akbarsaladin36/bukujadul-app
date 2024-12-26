<?php

namespace App\Repositories\Auth;

use App\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function GetUsername($username)
    {
        return User::where('user_username', $username)->first();
    }

    public function Create(array $data)
    {
        return User::create($data);
    }
}