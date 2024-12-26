<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function GetAll();
    public function GetOne($username);
    public function Create(array $data);
    public function Update($username, array $data);
    public function Delete($username);
}