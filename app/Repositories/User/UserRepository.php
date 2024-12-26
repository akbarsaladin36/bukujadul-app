<?php

namespace App\Repositories\User;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function GetAll()
    {
        return User::all();
    }

    public function GetOne($username)
    {
        return User::where('user_username', $username)->first();
    }

    public function Create(array $data)
    {
        return User::create($data);
    }

    public function Update($username, array $data)
    {
        return User::where('user_username', $username)->update($data);
    }

    public function Delete($username)
    {
        return User::where('user_username', $username)->delete();
    }
}