<?php

namespace App\Repositories\Profile;

use App\User;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function GetOne($username)
    {
        return User::where('user_username', $username)->first();
    }

    public function Update($username, array $data)
    {
        return User::where('user_username', $username)->update($data);
    }
}