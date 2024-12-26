<?php

namespace App\Repositories\Auth;

interface AuthRepositoryInterface
{
    public function GetUsername($username);
    public function Create(array $data);
}